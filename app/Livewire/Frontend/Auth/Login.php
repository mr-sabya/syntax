<?php

namespace App\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    // New property to accept the JSON string from LocalStorage
    public $localCartData = null;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            // === SYNC LOGIC START ===
            if ($this->localCartData) {
                $this->syncGuestCart();
            }
            // === SYNC LOGIC END ===

            // Flash a session key to tell the frontend to clear localStorage
            session()->flash('clear_guest_cart', true);

            return redirect()->intended(route('home'));
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    protected function syncGuestCart()
    {
        // 1. Decode JSON
        $guestItems = json_decode($this->localCartData, true);

        if (!is_array($guestItems)) return;

        $userId = Auth::id();

        foreach ($guestItems as $guestItem) {
            // Security: Always verify product exists in DB
            $product = Product::find($guestItem['id']);

            if ($product) {
                // 2. Check if user already has this item in DB
                $existingCart = Cart::where('user_id', $userId)
                    ->where('product_id', $product->id)
                    ->first();

                if ($existingCart) {
                    // Update Quantity
                    $existingCart->quantity += $guestItem['quantity'];
                    $existingCart->save();
                } else {
                    // Create New Item
                    Cart::create([
                        'user_id'    => $userId,
                        'product_id' => $product->id,
                        'quantity'   => $guestItem['quantity'],
                        // If your cart table stores price, use $product->price from DB, NOT from JSON
                    ]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.frontend.auth.login');
    }
}

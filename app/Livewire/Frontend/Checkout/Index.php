<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order; // Ensure you have this model
use App\Models\OrderItem; // Ensure you have this model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    // Form Fields
    public $fullname;
    public $email;
    public $phone;
    public $address;
    public $city;
    public $zip;
    public $payment_method = 'cod'; // Default to Cash on Delivery

    public function mount()
    {
        $user = Auth::user();
        $this->fullname = $user->name;
        $this->email = $user->email;
        // Check if cart is empty
        if (Cart::where('user_id', Auth::id())->count() == 0) {
            return redirect()->route('cart.index');
        }
    }

    protected $rules = [
        'fullname' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'city' => 'required',
        'zip' => 'required',
        'payment_method' => 'required'
    ];

    public function placeOrder()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $totalAmount = 0;

            foreach ($cartItems as $item) {
                $totalAmount += $item->product->price * $item->quantity;
            }

            // 1. Create Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'fullname' => $this->fullname,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'city' => $this->city,
                'zip_code' => $this->zip,
                'payment_method' => $this->payment_method,
                'payment_status' => 'pending',
                'grand_total' => $totalAmount,
                'status' => 'pending',
            ]);

            // 2. Create Order Items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            // 3. Clear Cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // 4. Dispatch events & Redirect
            $this->dispatch('cart-updated');
            session()->flash('success', 'Order placed successfully!');
            return redirect()->to('/'); // Or redirect to an order success page

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', type: 'error', message: 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = 0;
        foreach ($cartItems as $item) $total += $item->product->price * $item->quantity;

        return view('livewire.frontend.checkout.index', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }
}

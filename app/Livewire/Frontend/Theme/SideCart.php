<?php

namespace App\Livewire\Frontend\Theme;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class SideCart extends Component
{
    // 1. Listen for the event dispatched from RecommendedSection
    #[On('cart-updated')]
    public function refreshCart()
    {
        // This method exists just to trigger a re-render
    }

    // 2. Increment Quantity (DB)
    public function increment($cartId)
    {
        $item = Cart::where('user_id', Auth::id())->find($cartId);
        if ($item) {
            $item->increment('quantity');
            $this->dispatch('cart-updated'); // Update self and header
        }
    }

    // 3. Decrement Quantity (DB)
    public function decrement($cartId)
    {
        $item = Cart::where('user_id', Auth::id())->find($cartId);
        if ($item) {
            if ($item->quantity > 1) {
                $item->decrement('quantity');
            } else {
                $item->delete();
            }
            $this->dispatch('cart-updated');
        }
    }

    // 4. Remove Item (DB)
    public function remove($cartId)
    {
        Cart::where('user_id', Auth::id())->where('id', $cartId)->delete();
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $cartItems = [];
        $total = 0;

        if (Auth::check()) {
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();

            // Calculate Total
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }
        }

        return view('livewire.frontend.theme.side-cart', [
            'cartItems' => $cartItems,
            'subTotal' => $total
        ]);
    }
}

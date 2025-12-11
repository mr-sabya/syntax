<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    #[On('cart-updated')]
    public function refreshCart() {}

    public function increment($cartId)
    {
        $item = Cart::where('user_id', Auth::id())->find($cartId);
        if ($item) {
            $item->increment('quantity');
            $this->dispatch('cart-updated');
        }
    }

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

    public function remove($cartId)
    {
        Cart::where('user_id', Auth::id())->where('id', $cartId)->delete();
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $cartItems = [];
        $subtotal = 0;

        if (Auth::check()) {
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            foreach ($cartItems as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }
        }

        return view('livewire.frontend.cart.index', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal
        ]);
    }

}

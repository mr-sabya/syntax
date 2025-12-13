<?php

namespace App\Livewire\Frontend\Theme;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->updateCartCount();
    }

    #[On('cart-updated')]
    public function updateCartCount()
    {
        if (Auth::check()) {
            // Sum the quantity column for the authenticated user
            $this->cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            // For guests, we rely on AlpineJS in the view, so we set this to 0 initially
            $this->cartCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.frontend.theme.header');
    }
}

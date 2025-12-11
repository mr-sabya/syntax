<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Product;
use App\Models\Cart; // Ensure you have this model
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecommendedSection extends Component
{
    public function render()
    {
        $products = Product::where('is_active', 1) // Assuming active() scope does this
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('livewire.frontend.home.recommended-section', [
            'products' => $products
        ]);
    }
}

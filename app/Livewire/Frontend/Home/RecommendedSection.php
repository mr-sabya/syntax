<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Product;
use Livewire\Component;

class RecommendedSection extends Component
{
    public function render()
    {
        // Fetch 10 random active products to show as "Recommended"
        $products = Product::active()
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('livewire.frontend.home.recommended-section', [
            'products' => $products
        ]);
    }
}

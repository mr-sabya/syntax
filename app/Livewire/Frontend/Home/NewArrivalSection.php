<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Product;
use Livewire\Component;

class NewArrivalSection extends Component
{
    public function render()
    {
        // Fetch active products marked as 'is_new', limited to 8 items
        $products = Product::active()
            ->where('is_new', true)
            ->latest() // Orders by created_at desc
            ->take(8)
            ->get();

        return view('livewire.frontend.home.new-arrival-section', [
            'products' => $products
        ]);
    }
}

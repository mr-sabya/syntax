<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Related extends Component
{
    public $relatedProducts = [];

    public function mount($productId)
    {
        // 1. Find the current product to get its categories
        $currentProduct = Product::with('categories')->find($productId);

        if ($currentProduct && $currentProduct->categories->isNotEmpty()) {

            // Get Category IDs
            $categoryIds = $currentProduct->categories->pluck('id');

            // 2. Query products in the same categories
            $this->relatedProducts = Product::active()
                ->whereHas('categories', function ($query) use ($categoryIds) {
                    $query->whereIn('id', $categoryIds);
                })
                ->where('id', '!=', $productId) // Exclude the product currently being viewed
                ->inRandomOrder() // Shuffle them
                ->take(6) // Limit to 6 items to fit the layout (col-lg-2 * 6 = 12)
                ->get();
        } else {
            // Fallback: If no categories, maybe show random active products
            $this->relatedProducts = Product::active()
                ->where('id', '!=', $productId)
                ->inRandomOrder()
                ->take(6)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.related');
    }
}

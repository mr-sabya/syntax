<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    public $product;
    public $relatedProducts;

    // UI States
    public $quantity = 1;
    public $selectedImage; // To handle the main image display
    public $activeTab = 'description'; // To handle the tabs (Description, Reviews, etc.)

    public function mount($productId)
    {
        // 1. Fetch Product with Relationships
        $this->product = Product::with(['images', 'reviews', 'vendor', 'attributeValues', 'categories'])
            ->findOrFail($productId);

        // 2. Set Default Main Image
        $this->selectedImage = $this->product->thumbnail_url
            ?? asset('assets/frontend/images/no-image.png');

        // 3. Fetch Related Products (e.g., from same category)
        $categoryIds = $this->product->categories->pluck('id');
        $this->relatedProducts = Product::active()
            ->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('id', $categoryIds);
            })
            ->where('id', '!=', $productId) // Exclude current product
            ->inRandomOrder()
            ->take(6)
            ->get();
    }

    // Handle Image Click in Gallery
    public function changeImage($imageUrl)
    {
        $this->selectedImage = $imageUrl;
    }

    // Handle Tab Switching
    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    // Quantity Logic
    public function incrementQty()
    {
        // Check stock limit if managed
        if ($this->product->is_manage_stock && $this->quantity >= $this->product->quantity) {
            return; // Or dispatch an alert
        }
        $this->quantity++;
    }

    public function decrementQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.show');
    }
}

<?php

namespace App\Livewire\Frontend\Shop;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Filter Properties
    public $selectedCategories = [];
    public $selectedBrands = [];
    public $selectedRating = null; // New Property for Rating
    public $priceMin = 0;
    public $priceMax = 5000;
    public $sortBy = 'latest';
    public $perPage = 9;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->priceMin = 0;
        $this->priceMax = ceil(Product::max('price') ?? 5000);
    }

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['selectedCategories', 'selectedBrands', 'selectedRating', 'sortBy']);
        
        $this->priceMin = 0;
        $this->priceMax = ceil(Product::max('price') ?? 5000);
        
        $this->resetPage();
    }

    public function render()
    {
        $productsQuery = Product::active();

        // 1. Category Filter
        if (!empty($this->selectedCategories)) {
            $productsQuery->whereHas('categories', function ($q) {
                $q->whereIn('id', $this->selectedCategories);
            });
        }

        // 2. Brand Filter
        if (!empty($this->selectedBrands)) {
            $productsQuery->whereIn('brand_id', $this->selectedBrands);
        }

        // 3. Price Filter
        $productsQuery->whereBetween('price', [$this->priceMin, $this->priceMax]);

        // 4. Rating Filter (New Logic)
        if ($this->selectedRating) {
            // Filter products where the average of the 'rating' column in the 'reviews' table is >= selectedRating
            $productsQuery->whereRaw(
                "(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) >= ?", 
                [$this->selectedRating]
            );
        }

        // 5. Sorting
        switch ($this->sortBy) {
            case 'price_asc':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'oldest':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default: // latest
                $productsQuery->latest();
                break;
        }

        $products = $productsQuery->paginate($this->perPage);

        $categories = Category::active()->withCount('products')->get();
        // Ensure Brand model exists or remove this line
        $brands = \App\Models\Brand::withCount('products')->get(); 

        return view('livewire.frontend.shop.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}
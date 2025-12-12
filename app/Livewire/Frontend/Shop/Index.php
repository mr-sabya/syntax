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
    public $selectedRating = null;
    public $priceMin = 0;
    public $priceMax = 5000;
    public $sortBy = 'latest';
    public $perPage = 9;

    protected $paginationTheme = 'bootstrap';

    // Optional: If you want the URL to update dynamically when filters change
    protected $queryString = [
        'sortBy' => ['except' => 'latest'],
        'priceMin' => ['except' => 0],
        'priceMax' => ['except' => 5000],
        // We generally don't put selectedCategories here if mapping IDs to Slugs is complex, 
        // but for basic functionality, we rely on mount().
    ];

    public function mount()
    {
        // 1. Initialize Price Range
        $this->priceMin = 0;
        $this->priceMax = ceil(Product::max('price') ?? 5000);

        // 2. Handle URL Query Parameter for Category (?category=slug)
        $categorySlug = request()->query('category');

        if ($categorySlug) {
            // Find the category ID based on the slug provided in the URL
            $category = Category::where('slug', $categorySlug)->first();

            if ($category) {
                // Add the ID to the selection array so the checkbox gets checked
                // and the render method filters by it.
                $this->selectedCategories = [$category->id];
            }
        }
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

        // Remove the ?category= parameter from the URL visually (optional)
        $this->dispatch('url-clean-up');
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

        // 4. Rating Filter
        if ($this->selectedRating) {
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
        $brands = \App\Models\Brand::withCount('products')->get();

        return view('livewire.frontend.shop.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}

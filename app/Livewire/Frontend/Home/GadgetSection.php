<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Category;
use Livewire\Component;

class GadgetSection extends Component
{
    public function render()
    {
        // Fetch specifically 'laboratory-equipment'
        // Eager load products with limit of 8 for the grid
        $category = Category::where('slug', 'laboratory-equipment')
            ->where('is_active', true)
            ->with(['products' => function ($query) {
                $query->active() // Uses scopeActive from Product model
                    ->latest()
                    ->take(8);
            }])
            ->first();

        return view('livewire.frontend.home.gadget-section', [
            'category' => $category
        ]);
    }
}

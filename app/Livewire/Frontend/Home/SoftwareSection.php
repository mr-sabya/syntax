<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Component;
use App\Models\Software;
use App\Models\SoftwareCategory;

class SoftwareSection extends Component
{
    public $activeCategorySlug = '';

    public function mount()
    {
        // 1. Fetch the first active category to set as the default active tab
        $firstCategory = SoftwareCategory::where('is_active', true)->first();

        if ($firstCategory) {
            $this->activeCategorySlug = $firstCategory->slug;
        }
    }

    public function setCategory($slug)
    {
        $this->activeCategorySlug = $slug;
    }

    public function render()
    {
        // Get all active categories for the buttons
        $categories = SoftwareCategory::where('is_active', true)->get();

        // Query Software based on the selected category
        // We removed the 'all' check because we are always selecting a specific category now
        $softwareList = Software::active()
            ->with('category')
            ->whereHas('category', function ($q) {
                $q->where('slug', $this->activeCategorySlug);
            })
            ->latest()
            ->take(4) // 2. Limit the result to exactly 4 items
            ->get();

        return view('livewire.frontend.home.software-section', [
            'categories' => $categories,
            'softwareList' => $softwareList
        ]);
    }
}

<?php

namespace App\Livewire\Frontend\Software;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Software;
use App\Models\SoftwareCategory;

class Index extends Component
{
    use WithPagination;

    // Use Bootstrap pagination theme to match your design
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $activeCategorySlug = 'all';

    // Reset pagination when filtering
    public function updatingSearch() { $this->resetPage(); }
    
    public function setCategory($slug) 
    { 
        $this->activeCategorySlug = $slug; 
        $this->resetPage();
    }

    public function render()
    {
        // 1. Get Categories
        $categories = SoftwareCategory::where('is_active', true)->get();

        // 2. Build Query
        $query = Software::active()->with('category');

        // Apply Search
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('short_description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply Category Filter
        if ($this->activeCategorySlug !== 'all') {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->activeCategorySlug);
            });
        }

        // Get Paginated Results
        $softwareList = $query->latest()->paginate(9); // 9 items per page

        return view('livewire.frontend.software.index', [
            'categories' => $categories,
            'softwareList' => $softwareList
        ]);
    }
}
<?php

namespace App\Livewire\Frontend\Software;

use App\Models\Software;
use Livewire\Component;

class Show extends Component
{
    public $software;
    public $relatedSoftware;

    public function mount($id)
    {
        // 1. Fetch the active software by slug
        $this->software = Software::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        // 2. Fetch related items (same category, excluding current one)
        $this->relatedSoftware = Software::where('software_category_id', $this->software->software_category_id)
            ->where('id', '!=', $this->software->id)
            ->where('is_active', true)
            ->take(3)
            ->get();
    }
    
    public function render()
    {
        return view('livewire.frontend.software.show');
    }
}

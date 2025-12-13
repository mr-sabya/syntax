<?php

namespace App\Livewire\Frontend\Partner;

use App\Models\Partner;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // Fetch active partners using the scope
        $partners = Partner::active()->get();

        return view('livewire.frontend.partner.index', [
            'partners' => $partners
        ]);
    }
}
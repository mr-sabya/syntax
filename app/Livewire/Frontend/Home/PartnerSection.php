<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Partner;
use Livewire\Component;

class PartnerSection extends Component
{
    public function render()
    {
        // Fetch active partners, sorted by the order defined in backend
        $partners = Partner::active()->get();

        return view('livewire.frontend.home.partner-section', [
            'partners' => $partners
        ]);
    }
}

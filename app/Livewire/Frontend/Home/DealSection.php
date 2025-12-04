<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Deal;
use Livewire\Component;

class DealSection extends Component
{
    public function render()
    {
        // Fetch the latest active deal and load its products
        $deal = Deal::with('products') // Ensure your Deal model has this relationship defined
            ->where('is_active', 1)
            ->latest('starts_at') // Get the most recent one
            ->first();
        // dd($deal);

        return view('livewire.frontend.home.deal-section', [
            'deal' => $deal
        ]);
    }
}

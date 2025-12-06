<?php

namespace App\Livewire\Frontend\HotOffer;

use App\Models\Deal;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // Fetch all active deals and eager load products to prevent N+1 issues
        // We order by display_order (if you use it) or latest
        $deals = Deal::where('is_active', 1)
            ->with('products')
            ->orderBy('display_order', 'asc')
            ->latest()
            ->get();

        return view('livewire.frontend.hot-offer.index', [
            'deals' => $deals
        ]);
    }
}
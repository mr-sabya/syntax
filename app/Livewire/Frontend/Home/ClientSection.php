<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Client;
use Livewire\Component;

class ClientSection extends Component
{
    public function render()
    {
        // Fetch active clients sorted by 'sort_order'
        // We use the 'active()' scope defined in the Client model
        $clients = Client::active()->get();

        return view('livewire.frontend.home.client-section', [
            'clients' => $clients
        ]);
    }
}

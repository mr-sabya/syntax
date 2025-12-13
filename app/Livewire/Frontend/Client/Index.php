<?php

namespace App\Livewire\Frontend\Client;

use App\Models\Client;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $clients = Client::active()->get();

        return view('livewire.frontend.client.index', [
            'clients' => $clients
        ]);
    }
}
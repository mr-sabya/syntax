<?php

namespace App\Livewire\Frontend\Utilities;

use Livewire\Component;

class WhatsAppButton extends Component
{
    public $phoneNumber = '15551234567'; // REPLACE WITH YOUR NUMBER (Country code + Number, no symbols)
    public $message = 'Hello! I am interested in your software.'; // Optional pre-filled message

    public function render()
    {
        return view('livewire.frontend.utilities.whats-app-button');
    }
}
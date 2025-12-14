<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ThankYou extends Component
{
    public $order;

    public function mount($orderId)
    {
        // Fetch order securely (ensure it belongs to logged in user)
        $this->order = Order::with('orderItems')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.checkout.thank-you');
    }
}

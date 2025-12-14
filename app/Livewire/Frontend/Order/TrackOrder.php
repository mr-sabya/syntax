<?php

namespace App\Livewire\Frontend\Order;

use App\Models\Order;
use App\Enums\OrderStatus;
use Livewire\Component;

class TrackOrder extends Component
{
    public $orderNumber;
    public $order;

    // Optional: Accept order number from URL query string ?order=ORD-...
    protected $queryString = ['orderNumber' => ['except' => '']];

    public function mount()
    {
        if ($this->orderNumber) {
            $this->trackOrder();
        }
    }

    protected $rules = [
        'orderNumber' => 'required|string|exists:orders,order_number',
    ];

    public function trackOrder()
    {
        $this->validate();

        $this->order = Order::where('order_number', $this->orderNumber)
            ->with('orderItems.product') // Eager load items
            ->first();

        // Security check: You might want to match email here too 
        // if you want to prevent random guessing.
    }

    /**
     * Helper to calculate progress percentage for the bar
     */
    public function getProgressPercent()
    {
        if (!$this->order) return 0;

        return match ($this->order->order_status) {
            OrderStatus::Pending => 10,
            OrderStatus::Processing => 40,
            OrderStatus::Shipped => 75,
            OrderStatus::Delivered => 100,
            default => 0,
        };
    }

    public function render()
    {
        return view('livewire.frontend.order.track-order');
    }
}

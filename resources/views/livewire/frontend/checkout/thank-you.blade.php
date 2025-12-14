<section class="py-5 bg-light product-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 p-5 text-center">

                    <div class="mb-4 text-success">
                        <!-- FontAwesome check icon -->
                        <i class="fas fa-check-circle fa-5x"></i>
                    </div>

                    <h2 class="fw-bold mb-3">Thank You for Your Order!</h2>
                    <p class="text-muted mb-4">
                        Your order <strong>{{ $order->order_number }}</strong> has been placed successfully.
                        We have sent an email confirmation to <strong>{{ $order->billing_email }}</strong>.
                    </p>

                    <div class="bg-light p-3 rounded mb-4 text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Payment Method:</span>
                            <span class="fw-bold text-uppercase">{{ $order->payment_method }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Status:</span>
                            <!-- Using your Enum's label() and badgeColor() methods -->
                            <span class="badge {{ $order->order_status->badgeColor() }}">
                                {{ $order->order_status->label() }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <span class="h6 mb-0">Total Amount:</span>
                            <span class="h6 mb-0 text-primary">
                                {{ $order->currency }} {{ number_format($order->total_amount, 2) }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary" wire:navigate>Return Home</a>
                        <!-- Add track link if you have one -->
                        <a href="{{ route('order.track') }}?orderNumber={{ $order->order_number }}" wire:navigate class="btn btn-primary">Track Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
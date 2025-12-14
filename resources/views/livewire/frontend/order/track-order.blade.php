<div class="py-5 bg-light product-area" style="min-height: 80vh;">
    <div class="container">

        <!-- 1. Search Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Track Your Order</h2>
                    <p class="text-muted">Enter your Order ID to see the current status.</p>
                </div>

                <div class="card border-0 shadow-sm p-2">
                    <form wire:submit.prevent="trackOrder" class="d-flex gap-2">
                        <input type="text"
                            class="form-control form-control-lg border-0"
                            placeholder="Order ID (e.g. ORD-2023-X8H...)"
                            wire:model="orderNumber">
                        <button type="submit" class="btn btn-primary px-4 fw-bold">
                            <span wire:loading.remove wire:target="trackOrder">Track</span>
                            <span wire:loading wire:target="trackOrder">...</span>
                        </button>
                    </form>
                </div>
                @error('orderNumber') <span class="text-danger small mt-2 d-block text-center">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- 2. Order Details Section (Only shows if order is found) -->
        @if($order)
        <div class="row justify-content-center animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">

                        <!-- Header -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 border-bottom pb-4">
                            <div>
                                <h4 class="fw-bold mb-1">Order #{{ $order->order_number }}</h4>
                                <p class="text-muted mb-0">Placed on {{ $order->placed_at->format('M d, Y') }}</p>
                            </div>
                            <div class="mt-3 mt-md-0 text-md-end">
                                <span class="badge {{ $order->order_status->badgeColor() }} fs-6 px-3 py-2 rounded-pill">
                                    {{ $order->order_status->label() }}
                                </span>
                            </div>
                        </div>

                        <!-- Cancelled Alert -->
                        @if($order->order_status === \App\Enums\OrderStatus::Cancelled)
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i> This order has been cancelled.
                        </div>
                        @else
                        <!-- Status Progress Bar -->
                        <div class="position-relative my-5 mx-4">
                            <div class="progress" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ $this->getProgressPercent() }}%"></div>
                            </div>

                            <!-- Timeline Dots -->
                            <div class="position-absolute top-0 start-0 w-100 translate-middle-y d-flex justify-content-between">
                                <!-- Step 1: Pending -->
                                <div class="text-center" style="width: 80px;">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 30px; height: 30px; border: 4px solid #fff; box-shadow: 0 0 0 1px #dee2e6;">
                                        <i class="fas fa-clipboard-check small"></i>
                                    </div>
                                    <small class="fw-bold d-block">Pending</small>
                                </div>

                                <!-- Step 2: Processing -->
                                <div class="text-center" style="width: 80px;">
                                    <div class="{{ in_array($order->order_status->value, ['processing', 'shipped', 'delivered']) ? 'bg-primary text-white' : 'bg-light text-muted' }} rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 30px; height: 30px; border: 4px solid #fff; box-shadow: 0 0 0 1px #dee2e6;">
                                        <i class="fas fa-box-open small"></i>
                                    </div>
                                    <small class="{{ in_array($order->order_status->value, ['processing', 'shipped', 'delivered']) ? 'fw-bold' : 'text-muted' }}">Processing</small>
                                </div>

                                <!-- Step 3: Shipped -->
                                <div class="text-center" style="width: 80px;">
                                    <div class="{{ in_array($order->order_status->value, ['shipped', 'delivered']) ? 'bg-primary text-white' : 'bg-light text-muted' }} rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 30px; height: 30px; border: 4px solid #fff; box-shadow: 0 0 0 1px #dee2e6;">
                                        <i class="fas fa-truck small"></i>
                                    </div>
                                    <small class="{{ in_array($order->order_status->value, ['shipped', 'delivered']) ? 'fw-bold' : 'text-muted' }}">Shipped</small>
                                </div>

                                <!-- Step 4: Delivered -->
                                <div class="text-center" style="width: 80px;">
                                    <div class="{{ $order->order_status->value === 'delivered' ? 'bg-primary text-white' : 'bg-light text-muted' }} rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 30px; height: 30px; border: 4px solid #fff; box-shadow: 0 0 0 1px #dee2e6;">
                                        <i class="fas fa-home small"></i>
                                    </div>
                                    <small class="{{ $order->order_status->value === 'delivered' ? 'fw-bold' : 'text-muted' }}">Delivered</small>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Items & Address Grid -->
                        <div class="row g-4 mt-4">
                            <!-- Items List -->
                            <div class="col-md-8">
                                <h6 class="fw-bold mb-3">Order Items</h6>
                                <div class="border rounded p-3 bg-white">
                                    @foreach($order->orderItems as $item)
                                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                        @if($item->product && $item->product->thumbnail_image_path)
                                        <img src="{{ asset('storage/'.$item->product->thumbnail_image_path) }}"
                                            class="rounded object-fit-cover" width="60" height="60" alt="Product">
                                        @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                        @endif

                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small fw-bold">{{ $item->item_name }}</h6>
                                            <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                        </div>
                                        <div class="fw-bold text-end">
                                            {{ $order->currency }} {{ number_format($item->subtotal, 2) }}
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="d-flex justify-content-between pt-2 border-top">
                                        <span class="fw-bold">Total Amount</span>
                                        <span class="fw-bold text-primary">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Info -->
                            <div class="col-md-4">
                                <h6 class="fw-bold mb-3">Shipping Details</h6>
                                <div class="border rounded p-3 bg-light h-100">
                                    <p class="mb-1 fw-bold">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
                                    <p class="mb-1 small text-muted">{{ $order->shipping_email }}</p>
                                    <p class="mb-3 small text-muted">{{ $order->shipping_phone }}</p>

                                    <hr>

                                    <p class="mb-0 small">
                                        {{ $order->shipping_address_line_1 }}<br>
                                        {{ $order->shipping_city }}, {{ $order->shipping_zip_code }}<br>
                                        {{ $order->shipping_country }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
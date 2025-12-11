<div class="checkout-area py-5 product-area">
    <div class="container">

        <div class="row g-4">

            <!-- LEFT COLUMN: Billing Details -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 p-4">
                    <h4 class="fw-bold mb-4">Billing Details</h4>

                    <form wire:submit.prevent="placeOrder">
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror" wire:model="fullname">
                                @error('fullname') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-12">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone">
                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label class="form-label">Shipping Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" rows="2" wire:model="address"></textarea>
                                @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <!-- City & Zip -->
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" wire:model="city">
                                @error('city') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control @error('zip') is-invalid @enderror" wire:model="zip">
                                @error('zip') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="mt-5">
                            <h5 class="fw-bold mb-3">Payment Method</h5>

                            <div class="border rounded p-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="cod" id="cod" wire:model="payment_method">
                                    <label class="form-check-label fw-semibold" for="cod">
                                        Cash on Delivery (COD)
                                    </label>
                                    <p class="text-muted small mb-0 ms-2">Pay with cash when the courier arrives.</p>
                                </div>
                            </div>

                            <div class="border rounded p-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="stripe" id="stripe" wire:model="payment_method">
                                    <label class="form-check-label fw-semibold" for="stripe">
                                        Credit Card (Stripe)
                                    </label>
                                </div>
                            </div>
                            @error('payment_method') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT COLUMN: Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 p-4">
                    <h5 class="fw-bold mb-4">Your Order</h5>

                    <!-- Item List Small -->
                    <div class="checkout-items mb-4" style="max-height: 300px; overflow-y: auto;">
                        @foreach($cartItems as $item)
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $item->product->thumbnail_image_path) }}"
                                    class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary" style="font-size: 0.6rem;">
                                    {{ $item->quantity }}
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 small fw-semibold">{{ Str::limit($item->product->name, 20) }}</h6>
                                <span class="text-muted small">${{ number_format($item->product->price, 2) }}</span>
                            </div>
                            <div class="text-end fw-bold small">
                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr>

                    <!-- Totals -->
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Shipping</span>
                        <span class="fw-bold text-success">Free</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4 mt-3 pt-3 border-top">
                        <span class="h5 fw-bold">Total</span>
                        <span class="h4 fw-bold text-primary">${{ number_format($total, 2) }}</span>
                    </div>

                    <button type="button" wire:click="placeOrder"
                        class="btn btn-primary w-100 btn-lg py-3 shadow-sm position-relative">
                        <span wire:loading.remove wire:target="placeOrder">Place Order</span>
                        <span wire:loading wire:target="placeOrder">Processing...</span>
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="fas fa-lock me-1"></i> Secure Checkout</small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
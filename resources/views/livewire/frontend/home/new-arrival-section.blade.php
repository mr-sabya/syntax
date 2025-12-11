<section class="new-arrival-area bg-area">
    <div class="container">
        <h2 class="new-arrival-heading common-heading mb-4">New Arrival</h2>
        <div class="row g-3">

            <!-- Left Banner Column (Static for now, can be made dynamic via a Banner Model) -->
            <div class="col-lg-3 col-md-12">
                <div class="new-arrival-banner">
                    <img src="{{ asset('assets/frontend/images/new arrival.png') }}" alt="new arrival">
                    <div class="banner-content">
                        <h3>Consumer electronics and gadgets</h3>
                        <a href="#" class="btn-source">Source Now</a>
                    </div>
                </div>
            </div>

            <!-- Right Product Grid Column -->
            <div class="col-lg-9 col-md-12">
                <div class="row g-3">

                    @forelse ($products as $product)
                    @php
                    // Calculate Discount Logic
                    $hasDiscount = $product->compare_at_price > $product->price;
                    $discountPercentage = 0;
                    $saveAmount = 0;

                    if ($hasDiscount) {
                    $saveAmount = $product->compare_at_price - $product->price;
                    $discountPercentage = round(($saveAmount / $product->compare_at_price) * 100);
                    }
                    @endphp

                    <!-- Product Item -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="product-card">

                            {{-- Discount Badge --}}
                            @if($hasDiscount)
                            <div class="discount-badge">
                                <span>{{ $discountPercentage }}%</span>
                                <small>OFF</small>
                            </div>
                            @endif

                            <!-- Link on Image -->
                            {{-- Assuming you have a route named 'product.detail' --}}
                            <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="img-wrap">
                                {{-- Use the accessor created in Product Model --}}
                                <img src="{{ url('storage/' . $product->thumbnail_image_path) }}" alt="{{ $product->name }}">
                            </a>

                            <div class="product-info">
                                <!-- Link on Title -->
                                <h4>
                                    <a href="{{ route('product.show', $product->slug) }}" wire:navigate>
                                        {{ Str::limit($product->name, 40) }}
                                    </a>
                                </h4>

                                <div class="price-box">
                                    <span class="current-price">৳{{ number_format($product->price) }}</span>
                                    @if($hasDiscount)
                                    <del class="old-price">₹{{ number_format($product->compare_at_price) }}</del>
                                    @endif
                                </div>

                                @if($hasDiscount)
                                <span class="save-text">Save ₹{{ number_format($saveAmount) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-light text-center">
                            No new arrivals at the moment.
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>
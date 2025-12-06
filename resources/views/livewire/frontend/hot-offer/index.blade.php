<section class="deals-area bg-area product-area">
    <div class="container">
        @forelse($deals as $deal)
        {{-- Add margin bottom to separate multiple deals --}}
        <div class="deals-wrapper mb-5">
            <div class="row">
                <!-- Left Side: Deal Info & Countdown -->
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="counter-wrapper">
                        <div class="counter-text">
                            <h2 class="headline">Deals and offers</h2>
                            <p class="decribe">{{ $deal->name }}</p>
                            @if($deal->description)
                            <small class="text-muted">{{ Str::limit($deal->description, 50) }}</small>
                            @endif
                        </div>

                        <!-- Countdown Timer -->
                        <!-- We use a class 'deal-countdown' for JS selection -->
                        <!-- We use dynamic IDs to target specific spans -->
                        <div id="countdown-{{ $deal->id }}"
                            class="deal-countdown"
                            data-date="{{ $deal->expires_at ? $deal->expires_at->format('Y/m/d H:i:s') : '' }}"
                            data-id="{{ $deal->id }}">
                            <ul>
                                <li><span id="days-{{ $deal->id }}">00</span>days</li>
                                <li><span id="hours-{{ $deal->id }}">00</span>Hour</li>
                                <li><span id="minutes-{{ $deal->id }}">00</span>Min</li>
                                <li><span id="seconds-{{ $deal->id }}">00</span>Sec</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Product Slider -->
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="items">
                        @forelse($deal->products as $product)
                        <div class="item">
                            {{-- Product Link --}}
                            <a href="##">
                                <div class="deals-img">
                                    @if($product->thumbnail_image_path)
                                    <img src="{{ url('storage/' . $product->thumbnail_image_path) }}" alt="{{ $product->name }}">
                                    @else
                                    <img src="{{ asset('assets/frontend/images/no-image.png') }}" alt="no image">
                                    @endif
                                </div>

                                <h2>{{ Str::limit($product->name, 15) }}</h2>

                                {{-- Dynamic Discount Label --}}
                                <div class="discount-label text-center mt-2">
                                    @if($deal->type == 'percentage')
                                    <span class="badge bg-danger">
                                        -{{ number_format($deal->value, 0) }}%
                                    </span>
                                    @elseif($deal->type == 'fixed')
                                    <span class="badge bg-danger">
                                        Save ${{ number_format($deal->value, 0) }}
                                    </span>
                                    @endif
                                </div>
                            </a>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-light text-center">
                                No products available for this deal.
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info text-center">
            <h3>No Hot Offers Available Right Now.</h3>
            <p>Please check back later!</p>
        </div>
        @endforelse
    </div>

    <!-- Universal Countdown Script -->
    <script>
        document.addEventListener('livewire:init', function() {
            // Select all countdown containers by class
            const timers = document.querySelectorAll('.deal-countdown');

            timers.forEach(timer => {
                const dateString = timer.getAttribute('data-date');
                const dealId = timer.getAttribute('data-id');

                if (!dateString) return;

                const countDownDate = new Date(dateString).getTime();

                // Update the count down every 1 second
                const x = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = countDownDate - now;

                    // Time calculations
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Update specific elements using the deal ID
                    const dayEl = document.getElementById(`days-${dealId}`);
                    const hourEl = document.getElementById(`hours-${dealId}`);
                    const minEl = document.getElementById(`minutes-${dealId}`);
                    const secEl = document.getElementById(`seconds-${dealId}`);

                    if (dayEl) dayEl.innerText = days < 10 ? '0' + days : days;
                    if (hourEl) hourEl.innerText = hours < 10 ? '0' + hours : hours;
                    if (minEl) minEl.innerText = minutes < 10 ? '0' + minutes : minutes;
                    if (secEl) secEl.innerText = seconds < 10 ? '0' + seconds : seconds;

                    // If the count down is over
                    if (distance < 0) {
                        clearInterval(x);
                        timer.innerHTML = "<h3 class='text-danger'>EXPIRED</h3>";
                    }
                }, 1000);
            });
        });
    </script>
</section>
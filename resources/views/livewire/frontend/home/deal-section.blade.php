<section class="deals-area bg-area">
    @if($deal)
    <div class="container">
        <div class="deals-wrapper">
            <div class="row">
                <!-- Left Side: Deal Info & Countdown -->
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="counter-wrapper">
                        <div class="counter-text">
                            <h2 id="headline">Deals and offers</h2>
                            <p id="decribe">{{ $deal->name }}</p>
                        </div>

                        <!-- Pass the expiration date to JS via data-date attribute -->
                        <div id="countdown" data-date="{{ $deal->expires_at ? $deal->expires_at->format('Y/m/d H:i:s') : '' }}">
                            <ul>
                                <li><span id="days">00</span>days</li>
                                <li><span id="hours">00</span>Hour</li>
                                <li><span id="minutes">00</span>Min</li>
                                <li><span id="seconds">00</span>Sec</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Product Slider -->
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="items">
                        @forelse($deal->products as $product)
                        <div class="item">
                            {{-- Adjust route name based on your routes (e.g., product.detail) --}}
                            <a href="{{ url('product/'.$product->slug) }}">
                                <div class="deals-img">
                                    {{-- Fallback image logic --}}
                                    <img src="{{ $product->thumbnail_image_path ? url('storage/' . $product->thumbnail_image_path) : asset('assets/frontend/images/no-image.png') }}"
                                        alt="{{ $product->name }}">
                                </div>
                                <h2>{{ Str::limit($product->name, 10) }}</h2>

                                {{-- Dynamic Discount Label --}}
                                @if($deal->type == 'percentage')
                                <span>-{{ number_format($deal->value, 0) }}%</span>
                                @elseif($deal->type == 'fixed')
                                <span>Save ${{ number_format($deal->value, 0) }}</span>
                                @endif
                            </a>
                        </div>
                        @empty
                        <div class="item">
                            <p>No products available for this deal.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Countdown Script -->
    <script>
        document.addEventListener('livewire:init', function() {
            // Get the countdown container
            const countdownEl = document.getElementById('countdown');
            if (!countdownEl) return;

            // Get the expiration date string
            const dateString = countdownEl.getAttribute('data-date');
            if (!dateString) return;

            const countDownDate = new Date(dateString).getTime();

            const x = setInterval(function() {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                // Time calculations
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the results
                document.getElementById("days").innerText = days < 10 ? '0' + days : days;
                document.getElementById("hours").innerText = hours < 10 ? '0' + hours : hours;
                document.getElementById("minutes").innerText = minutes < 10 ? '0' + minutes : minutes;
                document.getElementById("seconds").innerText = seconds < 10 ? '0' + seconds : seconds;

                // If the count down is over
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "<h3>EXPIRED</h3>";
                }
            }, 1000);
        });
    </script>
    @endif
</section>
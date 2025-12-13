<section class="clients-section py-5 product-area">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Our Clients</h2>
            <p class="text-muted">Companies that trust us with their business.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($clients as $client)
            <div class="col-lg-2 col-md-4 col-6">
                <div class="client-card position-relative text-center p-3 border rounded-3 h-100 d-flex flex-column align-items-center justify-content-between">

                    <!-- Logo -->
                    <div class="client-logo-wrapper mb-3 w-100 d-flex align-items-center justify-content-center" style="height: 80px;">
                        <img src="{{ $client->logo_url }}"
                            alt="{{ $client->name }}"
                            class="img-fluid"
                            style="max-height: 60px; filter: grayscale(100%); transition: all 0.3s;">
                    </div>

                    <!-- Name -->
                    <h6 class="client-name fw-semibold mb-2" style="font-size: 0.9rem;">{{ $client->name }}</h6>

                    <!-- Link -->
                    @if($client->website_url)
                    <a href="{{ $client->website_url }}" target="_blank" class="client-link text-decoration-none small text-primary fw-bold">
                        View Site <i class="fas fa-arrow-right small"></i>
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No clients to display.</p>
            </div>
            @endforelse
        </div>
    </div>

    <style>
        .client-card {
            transition: all 0.3s ease;
            background: #fff;
        }

        .client-card:hover {
            border-color: var(--bs-primary) !important;
            /* Adjust if not using Bootstrap defaults */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* Grayscale to Color on Hover */
        .client-card:hover img {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        /* Show link only on hover/focus could be an option, but keeping it visible is better UX */
        .client-link {
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .client-link:hover {
            opacity: 1;
            text-decoration: underline !important;
        }
    </style>
</section>
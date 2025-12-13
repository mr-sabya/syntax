<section class="partners-section py-5 product-area">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Trusted Partners</h2>
            <div class="divider mx-auto bg-primary" style="height: 3px; width: 60px;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($partners as $partner)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="partner-card card h-100 border-0 shadow-sm">
                    <!-- Logo Area -->
                    <div class="card-img-top p-4 d-flex align-items-center justify-content-center bg-white" style="height: 180px;">
                        <img src="{{ $partner->logo_url }}"
                            alt="{{ $partner->name }}"
                            class="img-fluid"
                            style="max-height: 120px; object-fit: contain;">
                    </div>

                    <!-- Card Body -->
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark mb-2">{{ $partner->name }}</h5>

                        @if($partner->description)
                        <p class="card-text text-muted small flex-grow-1">
                            {{ \Illuminate\Support\Str::limit($partner->description, 80) }}
                        </p>
                        @else
                        <div class="flex-grow-1"></div>
                        @endif

                        <!-- Visit Website Button -->
                        @if($partner->website_url)
                        <a href="{{ $partner->website_url }}" target="_blank" class="btn btn-outline-primary btn-sm mt-3 w-100 rounded-pill">
                            Visit Website <i class="fas fa-external-link-alt ms-1"></i>
                        </a>
                        @else
                        <button class="btn btn-light btn-sm mt-3 w-100 rounded-pill" disabled>
                            Partner
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No partners listed at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>

    <style>
        .partner-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .partner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
</section>
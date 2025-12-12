<div class="software-detail-page software-area product-area">

    <!-- Header / Title Section -->
    <section class="software-header-area bg-area py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-primary mb-2">{{ $software->category->name ?? 'Software' }}</span>
                    <h1 class="section-heading text-start mb-3">{{ $software->name }}</h1>
                    <p class="lead text-muted">{{ $software->short_description }}</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <!-- Price Tag -->
                    @if($software->price > 0)
                    <h2 class="text-primary fw-bold mb-0">${{ number_format($software->price, 2) }}</h2>
                    <small class="text-muted">License / One-time</small>
                    @else
                    <span class="badge bg-success fs-5">Free Download</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="software-content-area py-5">
        <div class="container">
            <div class="row">

                <!-- LEFT COLUMN: Main Info -->
                <div class="col-lg-8 col-md-12">
                    <!-- Banner Image -->
                    <div class="template-content border p-2 rounded mb-4">
                        <div class="template-img">
                            @if($software->banner_url)
                            <img src="{{ $software->banner_url }}" alt="{{ $software->name }}" class="img-fluid w-100 rounded">
                            @else
                            <img src="{{ asset('assets/frontend/images/default-banner.png') }}" alt="Default Banner" class="img-fluid w-100 rounded">
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="content-box mb-5">
                        <h3 class="mb-3">Overview</h3>
                        <div class="text-secondary lh-lg">
                            {!! $software->long_description !!}
                        </div>
                    </div>

                    <!-- Features List -->
                    @if(!empty($software->features))
                    <div class="features-box mb-5">
                        <h3 class="mb-3">Key Features</h3>
                        <div class="row">
                            @foreach($software->features as $feature)
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <span>{{ $feature }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- RIGHT COLUMN: Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-widget border p-4 rounded shadow-sm bg-white">

                        <!-- Logo & Version -->
                        <div class="text-center mb-4">
                            <img src="{{ $software->logo_url }}" alt="Logo" class="img-fluid mb-3" style="max-height: 100px;">
                            @if($software->version)
                            <div class="badge bg-secondary">Version {{ $software->version }}</div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-3">
                            @if($software->demo_url)
                            <a href="{{ $software->demo_url }}" target="_blank" class="text-decoration-none">
                                <button class="w-100" style="background: transparent; border: 1px solid #007bff; color: #007bff; padding: 10px; border-radius: 5px;">
                                    Live Preview <i class="fas fa-eye ms-2"></i>
                                </button>
                            </a>
                            @endif

                            @if($software->download_url)
                            <a href="{{ $software->download_url }}" class="text-decoration-none">
                                <button class="w-100" style="background: #007bff; color: #fff; border: none; padding: 12px; border-radius: 5px; font-weight: 600;">
                                    Download Now <i class="fas fa-download ms-2"></i>
                                </button>
                            </a>
                            @elseif($software->purchase_url)
                            <a href="{{ $software->purchase_url }}" class="text-decoration-none">
                                <button class="w-100" style="background: #28a745; color: #fff; border: none; padding: 12px; border-radius: 5px; font-weight: 600;">
                                    Buy Now <i class="fas fa-shopping-cart ms-2"></i>
                                </button>
                            </a>
                            @else
                            <a href="/contact" class="text-decoration-none">
                                <button class="w-100" style="background: #333; color: #fff; border: none; padding: 12px; border-radius: 5px;">
                                    Contact Us <i class="fas fa-envelope ms-2"></i>
                                </button>
                            </a>
                            @endif
                        </div>

                        <!-- Meta Info -->
                        <div class="mt-4 pt-3 border-top">
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between mb-2">
                                    <strong>Category:</strong>
                                    <span>{{ $software->category->name }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Last Update:</strong>
                                    <span>{{ $software->updated_at->format('M Y') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Software Section -->
    @if($relatedSoftware->count() > 0)
    <section class="related-software bg-area py-5 border-top">
        <div class="container">
            <h3 class="section-heading mb-4">Related Software</h3>
            <div class="row">
                @foreach($relatedSoftware as $related)
                <div class="col-lg-4 col-md-6 mt-4">
                    <div class="template-content border p-2 rounded h-100 d-flex flex-column bg-white">
                        <div class="template-img mb-3">
                            <img src="{{ $related->logo_url }}" alt="{{ $related->name }}" class="img-fluid rounded w-100" style="height: 200px; object-fit: cover;">
                        </div>
                        <a href="{{ route('software.show', $related->slug) }}" wire:navigate class="text-decoration-none text-dark">
                            <h3>{{ $related->name }}</h3>
                        </a>
                        <p class="flex-grow-1">{{ \Illuminate\Support\Str::limit($related->short_description, 80) }}</p>
                        <a href="{{ route('software.show', $related->slug) }}" wire:navigate class="text-decoration-none text-dark" class="mt-auto">
                            <button>
                                View Details <i class="fas fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Add this CSS block or put it in your main CSS file to match your 'template-content' styles --}}
    <style>
        .software-header-area .section-heading {
            text-transform: capitalize;
            /* Matches your H2 style */
        }

        /* Reusing your button style from SoftwareSection */
        .template-content button,
        .sidebar-widget button {
            cursor: pointer;
            transition: 0.3s;
        }

        .template-content button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</div>
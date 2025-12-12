<div class="software-index-page software-area product-area">

    <!-- Page Header -->
    <section class="bg-area py-5 text-center border-bottom">
        <div class="container">
            <h1 class="section-heading mb-3">Software Catalog</h1>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                Explore our comprehensive range of software solutions designed to streamline your business operations.
            </p>
        </div>
    </section>

    <!-- Filter & Content Section -->
    <section class="py-5 bg-white">
        <div class="container">

            <!-- Controls: Search & Categories -->
            <div class="row mb-5 justify-content-center">

                <!-- Search Box -->
                <div class="col-md-8 col-lg-6 mb-4">
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text"
                            class="form-control border-start-0 ps-0 py-2"
                            placeholder="Search software..."
                            wire:model.live.debounce.300ms="search">
                    </div>
                </div>

                <!-- Category Buttons (Centered) -->
                <div class="col-12 text-center" id="myBtnContainer">
                    <button class="filter-btn {{ $activeCategorySlug === 'all' ? 'active1' : '' }}"
                        wire:click="setCategory('all')">
                        All
                    </button>
                    @foreach($categories as $category)
                    <button class="filter-btn {{ $activeCategorySlug === $category->slug ? 'active1' : '' }}"
                        wire:click="setCategory('{{ $category->slug }}')">
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Loading Spinner -->
            <div class="text-center mb-4" wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <!-- Software Grid -->
            <div class="row" wire:loading.remove>
                @forelse($softwareList as $software)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="template-content border rounded h-100 d-flex flex-column hover-effect">
                        <!-- Image -->
                        <div class="template-img mb-3 bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;">
                            @if($software->banner_url)
                            <img src="{{ $software->banner_url }}" alt="{{ $software->name }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            @else
                            <img src="{{ $software->logo_url }}" alt="{{ $software->name }}" class="img-fluid p-3" style="max-height: 150px;">
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-grow-1 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <a href="{{ route('software.show', $software->slug) }}" class="text-decoration-none text-dark" wire:navigate>
                                    <h3 class="h5 fw-bold mb-0">{{ $software->name }}</h3>
                                </a>
                                @if($software->price > 0)
                                <span class="badge bg-light text-dark border">${{ $software->price }}</span>
                                @else
                                <span class="badge bg-success-subtle text-success border border-success">Free</span>
                                @endif
                            </div>

                            <p class="text-muted small mb-3 flex-grow-1">
                                {{ \Illuminate\Support\Str::limit($software->short_description, 100) }}
                            </p>
                        </div>

                        <!-- Footer Button -->
                        <div class="mt-auto">
                            <a href="{{ route('software.show', $software->slug) }}" class="text-decoration-none" wire:navigate>
                                <button class="w-100">
                                    View Details <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-box-open fa-3x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted">No software found matching your criteria.</h4>
                    <button class="filter-btn mt-3" wire:click="setCategory('all')">Clear Filters</button>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $softwareList->links() }}
            </div>

        </div>
    </section>

    {{--
    Optional CSS adjustments if not already in your main stylesheet.
    This ensures the 'filter-btn' and 'template-content' behave nicely on a full page.
--}}
    <style>
        .hover-effect {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .filter-btn {
            margin: 5px;
            /* Add spacing for wrapped buttons on mobile */
        }

        /* Fix bootstrap pagination alignment if needed */
        .page-item.active .page-link {
            background-color: var(--primary-color, #0d6efd);
            border-color: var(--primary-color, #0d6efd);
        }
    </style>
</div>
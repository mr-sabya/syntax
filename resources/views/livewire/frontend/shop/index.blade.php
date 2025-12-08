<section class="product-area bg-area">
    <div class="container">
        <div class="row">

            <!-- LEFT SIDEBAR -->
            <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                <div class="product-category-group">
                    <div class="accordion" id="shopSidebarAccordion">

                        <!-- Add Reset Button Here -->
                        @if(!empty($selectedCategories) || !empty($selectedBrands) || $priceMin > 0 || $priceMax < 5000)
                            <div class="mb-3">
                            <button wire:click="resetFilters" class="btn btn-outline-danger btn-sm w-100">
                                <i class="fas fa-undo me-1"></i> Reset All Filters
                            </button>
                    </div>
                    @endif


                    <!-- 1. Categories Filter -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingCategory">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="true">
                                Category
                            </button>
                        </h2>
                        <div id="collapseCategory" class="accordion-collapse collapse show" data-bs-parent="#shopSidebarAccordion">
                            <div class="accordion-body">
                                <div class="items">
                                    @foreach($categories as $category)
                                    <label class="d-flex align-items-center gap-2 mb-2">
                                        <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category->id }}">
                                        <span>{{ $category->name }} <small class="text-muted">({{ $category->products_count }})</small></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Brands Filter -->
                    <div class="accordion-item mt-3">
                        <h2 class="accordion-header" id="headingBrand">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBrand" aria-expanded="true">
                                Brands
                            </button>
                        </h2>
                        <div id="collapseBrand" class="accordion-collapse collapse show" data-bs-parent="#shopSidebarAccordion">
                            <div class="accordion-body">
                                <div class="items">
                                    @foreach($brands as $brand)
                                    <label class="d-flex align-items-center gap-2 mb-2">
                                        <input type="checkbox" wire:model.live="selectedBrands" value="{{ $brand->id }}">
                                        <span>{{ $brand->name }} <small class="text-muted">({{ $brand->products_count }})</small></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Price Filter -->
                    <div class="accordion-item mt-3">
                        <h2 class="accordion-header" id="headingPrice">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="true">
                                Price Range
                            </button>
                        </h2>
                        <div id="collapsePrice" class="accordion-collapse collapse show" data-bs-parent="#shopSidebarAccordion">
                            <div class="accordion-body">
                                <div class="items">
                                    <div class="product-price">
                                        <div class="price-content mb-3">
                                            <div>
                                                <label>Min</label>
                                                <input class="form-control" type="number" wire:model.live.debounce.500ms="priceMin">
                                            </div>
                                            <div>
                                                <label>Max</label>
                                                <input class="form-control" type="number" wire:model.live.debounce.500ms="priceMax">
                                            </div>
                                        </div>
                                        <!-- Simple visual feedback for active range -->
                                        <small class="text-muted">Selected: ${{ $priceMin }} - ${{ $priceMax }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Rating Filter -->
                    <div class="accordion-item mt-3">
                        <h2 class="accordion-header" id="headingRating">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRating" aria-expanded="true">
                                Rating
                            </button>
                        </h2>
                        <div id="collapseRating" class="accordion-collapse collapse show" data-bs-parent="#shopSidebarAccordion">
                            <div class="accordion-body">
                                <div class="items">

                                    <!-- 5 Stars -->
                                    <label class="d-flex align-items-center gap-2 mb-2 cursor-pointer">
                                        <input type="radio" wire:model.live="selectedRating" value="5">
                                        <span class="rate text-warning">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </span>
                                        <span class="text-muted small">& up</span>
                                    </label>

                                    <!-- 4 Stars -->
                                    <label class="d-flex align-items-center gap-2 mb-2 cursor-pointer">
                                        <input type="radio" wire:model.live="selectedRating" value="4">
                                        <span class="rate text-warning">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </span>
                                        <span class="text-muted small">& up</span>
                                    </label>

                                    <!-- 3 Stars -->
                                    <label class="d-flex align-items-center gap-2 mb-2 cursor-pointer">
                                        <input type="radio" wire:model.live="selectedRating" value="3">
                                        <span class="rate text-warning">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </span>
                                        <span class="text-muted small">& up</span>
                                    </label>

                                    <!-- 2 Stars -->
                                    <label class="d-flex align-items-center gap-2 mb-2 cursor-pointer">
                                        <input type="radio" wire:model.live="selectedRating" value="2">
                                        <span class="rate text-warning">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </span>
                                        <span class="text-muted small">& up</span>
                                    </label>

                                    <!-- 1 Star -->
                                    <label class="d-flex align-items-center gap-2 mb-2 cursor-pointer">
                                        <input type="radio" wire:model.live="selectedRating" value="1">
                                        <span class="rate text-warning">
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </span>
                                        <span class="text-muted small">& up</span>
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- RIGHT PRODUCT GRID -->
        <div class="col-lg-9 col-md-9 col-sm-12 mb-4">
            <div class="all-product">

                <!-- Top Bar (Sorting & Counts) -->
                <div class="product-nav">
                    <div class="text">
                        <p><samp>{{ $products->total() }} items</samp> found</p>
                    </div>
                    <div class="items">
                        <!-- Sorting -->
                        <select class="form-select form-select-sm" style="width: auto;" wire:model.live="sortBy">
                            <option value="latest">Newest Items</option>
                            <option value="oldest">Oldest Items</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                        </select>


                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row">
                    @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="product-details-grid mt-3">
                            <div class="img">
                                <a href="{{ route('product.show', $product->slug) }}" wire:navigate>
                                    @if($product->thumbnail_image_path)
                                    <img src="{{ url('storage/' . $product->thumbnail_image_path) }}" alt="{{ $product->name }}">
                                    @else
                                    <img src="{{ asset('assets/frontend/images/no-image.png') }}" alt="no image">
                                    @endif
                                </a>
                            </div>
                            <div class="text p-3">
                                <h4>
                                    ${{ number_format($product->price, 2) }}
                                    @if($product->compare_at_price > $product->price)
                                    <del>${{ number_format($product->compare_at_price, 2) }}</del>
                                    @endif
                                </h4>

                                {{-- Static Rating (Implement Reviews Later) --}}
                                <div class="rating">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li><a href="#">
                                                <p class="rate">4.0</p>
                                            </a></li>
                                    </ul>
                                </div>


                                <p class="title">
                                    <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="text-dark text-decoration-none">
                                        {{ Str::limit($product->name, 40) }}
                                    </a>
                                </p>

                                <button type="button" class="heart border-0 bg-transparent" wire:click="$dispatch('addToWishlist', { id: {{ $product->id }} })">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 mt-5">
                        <div class="alert alert-warning text-center">
                            <h4>No products found!</h4>
                            <p>Try adjusting your filters.</p>
                        </div>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="col-lg-12 col-md-12 col-sm-12 mb-12 mt-4 pb-4">
                    <div class="pagination-wrapper d-flex justify-content-between align-items-center">
                        <!-- Per Page Selector -->
                        <div>
                            <select class="form-select" wire:model.live="perPage">
                                <option value="9">Show 9</option>
                                <option value="18">Show 18</option>
                                <option value="27">Show 27</option>
                            </select>
                        </div>

                        <!-- Laravel Standard Pagination -->
                        <div>
                            {{ $products->links(data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
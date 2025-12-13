<div>
    <!--===== single-product-area section start ======-->
    <section class="single-product-area">
        <div class="container">
            <div class="product-container">
                <div class="row g-5">

                    <!-- ============================================== -->
                    <!-- LEFT COLUMN: IMAGE GALLERY                     -->
                    <!-- ============================================== -->
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="picZoomer mb-4 border rounded" wire:ignore>
                            <img src="{{ $selectedImage }}" alt="{{ $product->name }}" style="width: 100%;">
                        </div>

                        <ul class="piclist d-flex gap-2 list-unstyled overflow-auto">
                            <!-- Main Thumbnail -->
                            <li wire:click="changeImage('{{ $product->thumbnail_url }}')"
                                class="border rounded p-1"
                                style="cursor: pointer; width: 80px; height: 80px;">
                                @if($product->thumbnail_image_path)
                                <img src="{{ url('storage/' . $product->thumbnail_image_path) }}"
                                    class="w-100 h-100 object-fit-cover"
                                    alt="Main">
                                @endif
                            </li>

                            <!-- Gallery Images -->
                            @foreach($product->images as $image)
                            <li wire:click="changeImage('{{ url('storage/' . $image->image_path) }}')"
                                class="border rounded p-1"
                                style="cursor: pointer; width: 80px; height: 80px;">
                                <img src="{{ url('storage/' . $image->image_path) }}"
                                    class="w-100 h-100 object-fit-cover"
                                    alt="Gallery">
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- ============================================== -->
                    <!-- RIGHT COLUMN: PRODUCT INFO                     -->
                    <!-- ============================================== -->
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <div class="product-details ps-lg-4">

                            <!-- 1. Stock Status & Wishlist -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                @if($product->is_manage_stock && $product->quantity == 0)
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                    <i class="fas fa-times me-1"></i> Out of Stock
                                </span>
                                @else
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                    <i class="fas fa-check me-1"></i> In Stock
                                </span>
                                @endif

                                <!-- Wishlist Button -->
                                <button class="btn btn-link text-decoration-none text-muted p-0"
                                    wire:click="$dispatch('addToWishlist', { id: {{ $product->id }} })">
                                    <i class="far fa-heart me-1"></i> Save for later
                                </button>
                            </div>

                            <!-- 2. Title -->
                            <h2 class="fw-bold text-dark mb-2">{{ $product->name }}</h2>

                            <!-- 3. Reviews & Stats -->
                            <div class="d-flex align-items-center gap-3 mb-3 text-muted small">
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span class="text-dark fw-bold ms-1">4.5</span>
                                </div>
                                <span class="border-start ps-3">{{ $product->reviews->count() }} Reviews</span>
                                <span class="border-start ps-3"><i class="fas fa-shopping-basket me-1"></i> {{ $product->orderItems_count ?? 0 }} Sold</span>
                            </div>

                            <!-- 4. Price -->
                            <div class="mb-4">
                                <h3 class="text-primary fw-bold d-inline-block me-2">
                                    ৳{{ number_format($product->price, 2) }}
                                </h3>
                                @if($product->compare_at_price > $product->price)
                                <del class="text-muted fs-5">৳{{ number_format($product->compare_at_price, 2) }}</del>
                                <span class="badge bg-danger ms-2">
                                    {{ round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100) }}% OFF
                                </span>
                                @endif
                            </div>

                            <!-- 5. Short Description -->
                            <div class="text-muted mb-4 lh-lg">
                                {!! $product->short_description !!}
                            </div>

                            <hr class="text-muted my-4">

                            <!-- 6. ACTION AREA (Quantity + Buttons) -->
                            <div class="row align-items-end g-3">

                                <!-- Quantity Selector -->
                                <div class="col-sm-4 col-12">
                                    <label class="fw-bold mb-2 small text-uppercase">Quantity</label>
                                    <div class="input-group qty-container border rounded">
                                        <button class="btn btn-light border-0" type="button" wire:click="decrementQty">
                                            <i class="fas fa-minus small"></i>
                                        </button>

                                        <input type="text" class="form-control text-center border-0 bg-transparent fw-bold"
                                            wire:model="quantity" readonly value="1" style="max-width: 60px;">

                                        <button class="btn btn-light border-0" type="button" wire:click="incrementQty">
                                            <i class="fas fa-plus small"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="col-sm-8 col-12">
                                    <div class="d-flex gap-2">
                                        <!-- Reusing the AddToCart Component (Primary Action) -->
                                        <div class="flex-grow-1">
                                            <!-- Passed 'w-100 btn-lg' via class attribute for full width -->
                                            <livewire:frontend.components.add-to-cart-button
                                                :productId="$product->id"
                                                :qty="$quantity"
                                                class="btn-dark w-100"
                                                text="Add to Cart" />
                                        </div>

                                        <!-- Buy Now Button (Secondary Action) -->
                                        <div class="flex-grow-1">
                                            <button type="button"
                                                class="btn btn-outline-primary w-100"
                                                wire:click="$dispatch('buyNow', { productId: {{ $product->id }}, qty: {{ $quantity }} })">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 7. Security / Trust Badges (Optional Polish) -->
                            <div class="mt-4 pt-3 d-flex gap-4 text-muted small">
                                <span><i class="fas fa-shield-alt me-1"></i> 1 Year Warranty</span>
                                <span><i class="fas fa-undo me-1"></i> 30 Days Return</span>
                                <span><i class="fas fa-truck me-1"></i> Fast Delivery</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== single-product-area section end =======-->

    <!--===== about-area section start ======-->
    <section class="product-details-area py-5 bg-light">
        <div class="container">
            <div class="row g-4">

                <!-- LEFT COLUMN: Tabs Content (9 Cols) -->
                <div class="col-lg-9 col-md-12">
                    <div class="bg-white p-4 rounded shadow-sm">

                        <!-- Bootstrap Nav Tabs -->
                        <ul class="nav nav-tabs" id="productTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active fw-bold text-dark" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                    Description
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold text-dark" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                                    Reviews ({{ $product->reviews->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold text-dark" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab" aria-controls="specs" aria-selected="false">
                                    Specifications
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold text-dark" id="seller-tab" data-bs-toggle="tab" data-bs-target="#seller" type="button" role="tab" aria-controls="seller" aria-selected="false">
                                    Seller Info
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content Panes -->
                        <div class="tab-content pt-4" id="productTabContent">

                            <!-- 1. Description Tab -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div class="pro-desc text-muted lh-lg">
                                    {!! $product->long_description !!}
                                </div>
                            </div>

                            <!-- 2. Reviews Tab -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="review-list">
                                    @forelse($product->reviews as $review)
                                    <div class="d-flex gap-3 mb-4 border-bottom pb-3">
                                        <div class="flex-shrink-0">
                                            <!-- Initials Avatar -->
                                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                {{ substr($review->user->name ?? 'G', 0, 1) }}
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-1 fw-bold">{{ $review->user->name ?? 'Guest User' }}</h6>
                                            <div class="text-warning small mb-2">
                                                @for($i=1; $i<=5; $i++)
                                                    <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                                    @endfor
                                            </div>
                                            <p class="text-muted mb-0">{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="alert alert-light text-center">
                                        No reviews yet. Be the first to review!
                                    </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- 3. Specifications (Previously split in shipping/desc) -->
                            <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                                <!-- Attributes Table -->
                                @if($product->attributeValues->count() > 0)
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        @foreach($product->attributeValues as $attr)
                                        <tr>
                                            <th class="bg-light text-dark" style="width: 30%;">{{ $attr->attribute->name ?? 'Feature' }}</th>
                                            <td>{{ $attr->value }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif

                                <!-- Shipping Info -->
                                <h5 class="mt-4 mb-3">Shipping Details</h5>
                                <ul class="list-unstyled text-muted">
                                    <li class="mb-2"><i class="fas fa-box-open me-2 text-primary"></i> Weight: {{ $product->weight }} kg</li>
                                    <li class="mb-2"><i class="fas fa-clock me-2 text-primary"></i> Dispatch: 2-3 Business Days</li>
                                    <li class="mb-2"><i class="fas fa-shield-alt me-2 text-primary"></i> Secure Packaging Guaranteed</li>
                                </ul>
                            </div>

                            <!-- 4. Seller Tab -->
                            <div class="tab-pane fade" id="seller" role="tabpanel" aria-labelledby="seller-tab">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light p-3 rounded-circle">
                                        <i class="fas fa-store fa-2x text-muted"></i>
                                    </div>
                                    <div>
                                        @if($product->vendor)
                                        <h5 class="mb-1">{{ $product->vendor->name }}</h5>
                                        <p class="text-muted mb-0"><i class="fas fa-envelope me-1"></i> {{ $product->vendor->email }}</p>
                                        @else
                                        <h5 class="mb-1">Official Store</h5>
                                        <p class="text-muted mb-0">Verified by Admin</p>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <p class="text-muted">
                                    This seller is committed to providing excellent customer service. Please contact them directly if you have specific questions about bulk orders or customization.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Sidebar (3 Cols) -->
                <div class="col-lg-3 col-md-12">
                    <div class="bg-white p-3 rounded shadow-sm">
                        <h5 class="border-bottom pb-2 mb-3 fw-bold">You may like</h5>

                        <div class="d-flex flex-column gap-3">
                            @foreach($relatedProducts as $related)
                            <div class="d-flex gap-3 align-items-center">
                                <!-- Image -->
                                <a href="{{ route('product.show', $related->slug) }}" class="flex-shrink-0">
                                    <img src="{{ $related->thumbnail_image_path ? url('storage/' . $related->thumbnail_image_path) : asset('assets/frontend/images/no-image.png') }}"
                                        alt="{{ $related->name }}"
                                        class="rounded border"
                                        style="width: 70px; height: 70px; object-fit: cover;">
                                </a>

                                <!-- Content -->
                                <div>
                                    <a href="{{ route('product.show', $related->slug) }}" class="text-decoration-none text-dark">
                                        <h6 class="mb-1" style="font-size: 0.95rem; line-height: 1.3;">
                                            {{ Str::limit($related->name, 25) }}
                                        </h6>
                                    </a>
                                    <span class="fw-bold text-primary">৳{{ number_format($related->price, 2) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Optional CSS for Active Tab Styling -->
    <style>
        .nav-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6c757d;
        }

        .nav-tabs .nav-link:hover {
            border-color: transparent;
            color: #000;
            isolation: isolate;
            /* Fixes stacking context issues */
        }

        .nav-tabs .nav-link.active {
            border-color: transparent;
            /* Remove standard border */
            border-bottom: 3px solid #0d6efd;
            /* Add primary color bottom border */
            color: #000;
            background-color: transparent;
        }
    </style>
    <!--===== about-area section end ======-->
</div>

@push('script')
<script>
    (function($) {
        $.fn.picZoomer = function(options) {
            var opts = $.extend({}, $.fn.picZoomer.defaults, options),
                $this = this,
                $picBD = $('<div class="picZoomer-pic-wp"></div>').css({
                    'width': opts.picWidth + 'px',
                    'height': opts.picHeight + 'px'
                }).appendTo($this),

                $pic = $this.children('img').addClass('picZoomer-pic').appendTo($picBD),
                $cursor = $('<div class="picZoomer-cursor"><i class="f-is picZoomCursor-ico"></i></div>').appendTo($picBD),

                cursorSizeHalf = {
                    w: $cursor.width() / 2,
                    h: $cursor.height() / 2
                },
                $zoomWP = $('<div class="picZoomer-zoom-wp"><img class="picZoomer-zoom-pic"></img></div>').appendTo($this),

                $zoomPic = $zoomWP.find('.picZoomer-zoom-pic'),
                picBDOffset = {
                    x: $picBD.offset().left,
                    y: $picBD.offset().top
                };

            opts.zoomWidth = opts.zoomWidth || opts.picWidth;
            opts.zoomHeight = opts.zoomHeight || opts.picHeight;
            var zoomWPSizeHalf = {
                w: opts.zoomWidth / 2,
                h: opts.zoomHeight / 2
            };


            $zoomWP.css({
                'width': opts.zoomWidth + 'px',
                'height': opts.zoomHeight + 'px'
            });

            $zoomWP.css(opts.zoomerPosition || {
                top: 0,
                left: opts.picWidth + 30 + 'px'
            });

            $zoomPic.css({
                'width': opts.picWidth * opts.scale + 'px',
                'height': opts.picHeight * opts.scale + 'px'
            });

            $picBD.on('mouseenter', function(event) {
                $cursor.show();
                $zoomWP.show();
                $zoomPic.attr('src', $pic.attr('src'))
            }).on('mouseleave', function(event) {
                $cursor.hide();
                $zoomWP.hide();
            }).on('mousemove', function(event) {
                var x = event.pageX - picBDOffset.x,
                    y = event.pageY - picBDOffset.y;

                $cursor.css({
                    'left': x - cursorSizeHalf.w + 'px',
                    'top': y - cursorSizeHalf.h + 'px'
                });

                $zoomPic.css({
                    'left': -(x * opts.scale - zoomWPSizeHalf.w) + 'px',
                    'top': -(y * opts.scale - zoomWPSizeHalf.h) + 'px'
                });
            });

            return $this;
        };
        $.fn.picZoomer.defaults = {
            picWidth: 500, // updated
            picHeight: 500, // updated
            scale: 2.5,
            zoomerPosition: {
                top: '0',
                left: '520px'
            }
        };

    })(jQuery);

    $(function() {
        $('.picZoomer').picZoomer();
        $('.piclist li').on('click', function(event) {
            var $pic = $(this).find('img');
            $('.picZoomer-pic').attr('src', $pic.attr('src'));
        });
    });
</script>
@endpush
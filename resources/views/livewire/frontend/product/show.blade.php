<div>
    <!--===== single-product-area section start ======-->
    <section class="single-product-area bg-area">
        <div class="container">
            <div class="row">
                <!-- Left: Image Gallery -->
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="picZoomer" wire:ignore>
                        <!-- Main Image -->
                        <img src="{{ $selectedImage }}" alt="{{ $product->name }}" style="width: 100%;">
                    </div>

                    <!-- Thumbnails -->
                    <ul class="piclist">
                        <!-- Main Thumbnail -->
                        <li wire:click="changeImage('{{ $product->thumbnail_url }}')" style="cursor: pointer">
                            @if($product->thumbnail_image_path)
                            <img src="{{ url('storage/' . $product->thumbnail_image_path) }}" alt="Main">
                            @endif
                        </li>

                        <!-- Gallery Images -->
                        @foreach($product->images as $image)
                        <li wire:click="changeImage('{{ url('storage/' . $image->image_path) }}')" style="cursor: pointer">
                            <img src="{{ url('storage/' . $image->image_path) }}" alt="Gallery">
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Right: Product Info -->
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <div class="single-product-area-header">
                        <div class="single-product-header">
                            <div class="single-product-header-left">
                                @if($product->is_manage_stock && $product->quantity == 0)
                                <a href="javascript:void(0)" class="text-danger"><i class="fas fa-times"></i> Out of Stock</a>
                                @else
                                <a href="javascript:void(0)"><i class="fas fa-check"></i> In Stock</a>
                                @endif

                                <h3>{{ $product->name }}</h3>
                            </div>

                            <!-- Wishlist -->
                            <div class="save">
                                <a href="javascript:void(0)" wire:click="$dispatch('addToWishlist', { id: {{ $product->id }} })">
                                    <i class="far fa-heart"></i>
                                    <p>Save for later</p>
                                </a>
                            </div>
                        </div>

                        <!-- Ratings & Stats -->
                        <div class="rating">
                            <ul class="start">
                                {{-- Logic for stars can be added here based on avg rating --}}
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                            </ul>
                            <ul class="reviews">
                                <li>
                                    <a href="#">
                                        <p class="rate">4.5</p>
                                    </a>
                                </li>
                                <li><a href="#"><i class="fas fa-circle round"></i></a></li>
                                <li>
                                    <a href="#">
                                        <p class="order"><i class="fas fa-envelope"></i> {{ $product->reviews->count() }} reviews</p>
                                    </a>
                                </li>
                                <li><a href="#"><i class="fas fa-circle round"></i></a></li>
                                <li>
                                    <a href="#">
                                        <p class="ship"><i class="fas fa-shopping-basket"></i> {{ $product->orderItems_count ?? 0 }} sold</p>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <p class="dis">{{ $product->short_description }}</p>

                        <!-- Price -->
                        <h4>
                            ${{ number_format($product->price, 2) }}
                            @if($product->compare_at_price > $product->price)
                            <del class="text-muted fs-6">${{ number_format($product->compare_at_price, 2) }}</del>
                            @endif
                        </h4>

                        <!-- Quantity -->
                        <div class="quantity-count">
                            <div class="qty-container">
                                <button class="qty-btn-minus btn-light" type="button" wire:click="decrementQty">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text" min="1" wire:model="quantity" readonly class="input-qty" />
                                <button class="qty-btn-plus btn-light" type="button" wire:click="incrementQty">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="button">
                            <!-- Helper: Dispatch Cart Event -->
                            <a href="javascript:void(0)"
                                wire:click="$dispatch('buyNow', { productId: {{ $product->id }}, qty: {{ $quantity }} })">
                                <button>Buy Now</button>
                            </a>
                            <a href="javascript:void(0)"
                                wire:click="$dispatch('addToCart', { productId: {{ $product->id }}, qty: {{ $quantity }} })">
                                <button>Add to Cart</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== single-product-area section end =======-->

    <!--===== about-area section start ======-->
    <section class="about-area bg-area">
        <div class="container">
            <div class="row">

                <!-- Center Tabs Content -->
                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="about">

                        <!-- Tabs Header -->
                        <div class="group">
                            <ul>
                                <li>
                                    <p class="{{ $activeTab == 'description' ? 'active' : '' }}"
                                        wire:click="switchTab('description')" style="cursor: pointer;">Description</p>
                                </li>
                                <li>
                                    <p class="{{ $activeTab == 'reviews' ? 'active' : '' }}"
                                        wire:click="switchTab('reviews')" style="cursor: pointer;">Reviews ({{ $product->reviews->count() }})</p>
                                </li>
                                <li>
                                    <p class="{{ $activeTab == 'shipping' ? 'active' : '' }}"
                                        wire:click="switchTab('shipping')" style="cursor: pointer;">Shipping</p>
                                </li>
                                <li>
                                    <p class="{{ $activeTab == 'seller' ? 'active' : '' }}"
                                        wire:click="switchTab('seller')" style="cursor: pointer;">About seller</p>
                                </li>
                            </ul>
                        </div>

                        <!-- 1. Description Tab -->
                        @if($activeTab == 'description')
                        <div class="details">
                            <div class="mb-4">
                                {!! $product->long_description !!}
                            </div>

                            <!-- Attributes / Specifications -->
                            <div class="chart">
                                @if($product->attributeValues->count() > 0)
                                <h5 class="mb-3">Specifications</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            @foreach($product->attributeValues as $attr)
                                            <li><a href="javascript:void(0)">{{ $attr->attribute->name ?? 'Feature' }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul>
                                            @foreach($product->attributeValues as $attr)
                                            <li><a href="javascript:void(0)">{{ $attr->value }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- 2. Reviews Tab -->
                        @if($activeTab == 'reviews')
                        <div class="reviews">
                            @forelse($product->reviews as $review)
                            <div class="review-item mb-3 border-bottom pb-2">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $review->user->name ?? 'Guest' }}</strong>
                                    <span class="text-warning">
                                        @for($i=0; $i<$review->rating; $i++) <i class="fas fa-star"></i> @endfor
                                    </span>
                                </div>
                                <p class="mt-2">{{ $review->comment }}</p>
                            </div>
                            @empty
                            <p>No reviews yet.</p>
                            @endforelse
                        </div>
                        @endif

                        <!-- 3. Shipping Tab -->
                        @if($activeTab == 'shipping')
                        <div class="shipping">
                            <p>
                                Shipping details regarding this product. Usually ships within 2-3 business days.
                                <br>Weight: {{ $product->weight }} kg
                            </p>
                            <div class="feature">
                                <p><i class="fas fa-check"></i> Secure Packaging</p>
                                <p><i class="fas fa-check"></i> Fast Delivery</p>
                            </div>
                        </div>
                        @endif

                        <!-- 4. Seller Tab -->
                        @if($activeTab == 'seller')
                        <div class="seller">
                            @if($product->vendor)
                            <h4>{{ $product->vendor->name }}</h4>
                            <p>Email: {{ $product->vendor->email }}</p>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit iure deserunt mollitia.
                            </p>
                            @else
                            <p>Admin Store</p>
                            @endif
                        </div>
                        @endif

                    </div>
                </div>

                <!-- Right Sidebar: You May Like -->
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="card-right">
                        <div class="like">
                            <h3>You may like</h3>
                        </div>

                        @foreach($relatedProducts as $related)
                        <div class="card-right-bottom d-flex">
                            <a href="{{ route('product.detail', $related->slug) }}">
                                <div class="card-right-img">
                                    @if($related->thumbnail_image_path)
                                    <img src="{{ url('storage/' . $related->thumbnail_image_path) }}" alt="{{ $related->name }}">
                                    @else
                                    <img src="{{ asset('assets/frontend/images/no-image.png') }}" alt="no-image">
                                    @endif
                                </div>
                            </a>
                            <div class="card-right-content">
                                <a href="{{ route('product.detail', $related->slug) }}">
                                    <h4>{{ Str::limit($related->name, 25) }}</h4>
                                </a>
                                <div class="product-price card-right-price">
                                    <span class="product-price-new">${{ number_format($related->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
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
            picWidth: 300,
            picHeight: 300,
            scale: 2.5,
            zoomerPosition: {
                top: '0',
                left: '350px'
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
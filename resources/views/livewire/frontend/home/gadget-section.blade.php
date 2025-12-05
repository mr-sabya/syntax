<section class="gadget-area bg-area">
    @if($category)
    <div class="container">
        <div class="gadger-container">
            <div class="row">
                <!-- Left Banner Section: Category Info -->
                <div class="col-lg-3 col-md-4 col-sm-12 p-0">
                    <div class="consumer-wrapper">
                        <div class="consumer-img">
                            {{-- Use category image if available, else fallback to hardcoded --}}
                            <img src="{{ $category->image_url ?? url('assets/frontend/images/gadets.png') }}"
                                alt="{{ $category->name }}">
                        </div>
                        <div class="consumer-content">
                            <h2>{{ $category->name }}</h2>
                            <a href="{{ url('collections/'.$category->slug) }}">
                                <button>Source Now</button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Product Grid -->
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="items-wrapper">
                        @forelse($category->products as $product)
                        <div class="items">
                            {{-- Adjust route to your specific product detail route --}}
                            <a href="{{ url('product/'.$product->slug) }}">
                                <h5>{{ Str::limit($product->name, 20) }}</h5>

                                <div class="price">
                                    <p>From <br>
                                        {{-- Use effective_price to show discounted price if a deal exists --}}
                                        USD {{ number_format($product->effective_price, 0) }}

                                        {{-- Optional: Show strike-through if discounted --}}
                                        @if($product->effective_price < $product->price)
                                            <small class="text-decoration-line-through text-muted" style="font-size: 12px">
                                                {{ number_format($product->price, 0) }}
                                            </small>
                                            @endif
                                    </p>

                                    {{-- Use the accessor defined in your Product model --}}
                                    <img src="{{ url('storage/' . $product->thumbnail_image_path) ?? asset('assets/frontend/images/no-image.png') }}"
                                        alt="{{ $product->name }}">
                                </div>
                            </a>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-light text-center">
                                No products found in Laboratory Equipment.
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
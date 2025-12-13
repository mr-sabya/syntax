<!-- ======== related-product section start ============ -->
<section class="related-product-area bg-area">
    <div class="container">
        <h2>Related products</h2>
        <div class="row">

            @forelse($relatedProducts as $related)
            <div class="col-lg-2 col-md-3 col-sm-6 col-6 mb-3">
                <div class="related-product">
                    <div class="product-img">
                        <a href="{{ route('product.show', $related->slug) }}" wire:navigate>
                            @if($related->thumbnail_image_path)
                            <img src="{{ url('storage/' . $related->thumbnail_image_path) }}" alt="{{ $related->name }}">
                            @else
                            <img src="{{ asset('assets/frontend/images/no-image.png') }}" alt="no image">
                            @endif
                        </a>
                    </div>
                    <div class="product-details">
                        <a href="{{ route('product.show', $related->slug) }}" wire:navigate>
                            <h3>
                                {{ Str::limit($related->name, 15) }}
                            </h3>
                        </a>

                        {{-- Show Brand Name or 'Original' --}}
                        <p>
                            {{ $related->brand->name ?? 'Original' }}
                        </p>

                        <p class="price">
                            ৳{{ number_format($related->price, 2) }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-light text-center">
                    No related products found.
                </div>
            </div>
            @endforelse

        </div>
    </div>
</section>
<!-- ======== related-product section end ============ -->
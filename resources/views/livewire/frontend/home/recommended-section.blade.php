<section class="recommended-area bg-area">
    <div class="container">
        <h2 class="recommended-heading common-heading">Recommended items</h2>
        <div class="row">
            <div class="col-12 mt-2">
                <div class="items">

                    @forelse($products as $product)
                    <div class="item">
                        <div class="recom-img">
                            {{-- Link to Product Detail --}}
                            <a href="{{ route('product.show', $product->slug) }}" wire:navigate>
                                {{-- Use the thumbnail_url accessor --}}
                                <img src="{{ url('storage/' . $product->thumbnail_image_path) }}" alt="{{ $product->name }}">
                            </a>
                        </div>

                        <div class="p-3">
                            {{-- Price --}}
                            <h5>৳{{ number_format($product->price, 2) }}</h5>

                            {{-- Title --}}
                            <h4 style="font-size: 1.2rem;">
                                <a href="{{ route('product.show', $product->slug) }}" wire:navigate>
                                    {{ Str::limit($product->name, 25) }}
                                </a>
                            </h4>

                            {{-- Short Description --}}
                            <p class="m-0">
                                {{ Str::limit($product->short_description ?? 'Great quality product.', 30) }}
                            </p>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="shado">
                            {{-- UPDATED BUTTON --}}
                            {{-- added .prevent to stop page reload --}}
                            {{-- added loading state to prevent double clicks --}}
                            <livewire:frontend.components.add-to-cart-button
                                :productId="$product->id"
                                class="btn-sm btn-primary" />

                            <p><i class="fas fa-share-alt"></i> Share</p>
                        </div>
                    </div>
                    @empty
                    <div class="item">
                        <div class="p-3 text-center">
                            <p>No recommendations available.</p>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>
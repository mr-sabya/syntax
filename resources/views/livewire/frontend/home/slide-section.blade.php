<section class="new-slide-area bg-area">
    <div class="container">
        <div class="banner-container">
            <div class="row">
                <!-- Categories Sidebar -->
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="all-product">
                        <ul class="d-ul">
                            @forelse($categories as $category)
                            <li class="d-li">
                                {{-- Adjust the route name ('collections' or 'category') based on your routes file --}}
                                <a href="{{ url('collections/'.$category->slug) }}">
                                    <p class="m-0">{{ $category->name }}</p>
                                </a>
                            </li>
                            @empty
                            <li class="d-li">
                                <p class="m-0">No Category Found!!</p>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Banner Carousel -->
                <div class="col-lg-9 col-md-8 col-sm-12">
                    @if($banners->count() > 0)
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                        <!-- Dynamic Indicators -->
                        <div class="carousel-indicators">
                            @foreach($banners as $key => $banner)
                            <button type="button"
                                data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $key }}"
                                class="{{ $key == 0 ? 'active' : '' }}"
                                aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $key + 1 }}">
                            </button>
                            @endforeach
                        </div>

                        <!-- Dynamic Slides -->
                        <div class="carousel-inner">
                            @foreach($banners as $key => $banner)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                                {{-- Make sure your Banner model accessor or path is correct --}}
                                <img src="{{ url('storage/'. $banner->image) }}" class="d-block w-100" alt="{{ $banner->title ?? 'banner' }}">

                                <div class="carousel-caption d-none d-md-block">
                                    <h2>
                                        {{ $banner->title }}
                                        @if($banner->subtitle)
                                        <span>{{ $banner->subtitle }}</span>
                                        @endif
                                    </h2>

                                    @if($banner->link)
                                    <a href="{{ $banner->link }}">
                                        <button>{{ $banner->button}}</button>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    @else
                    {{-- Optional: Fallback content if no banners exist --}}
                    <div class="alert alert-warning">No banners configured.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
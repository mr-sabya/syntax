<section class="software-area bg-area">
    <div class="container">
        <div class="rounded">
            <h2 class="section-heading">Our Software</h2>

            <div class="main">
                <!-- Filter Buttons -->
                <div id="myBtnContainer" class="mb-4 text-center">

                    {{--
                        REMOVED: The "All" Button 
                    --}}

                    {{-- Dynamic Category Buttons --}}
                    @foreach($categories as $category)
                    <button
                        class="filter-btn {{ $activeCategorySlug === $category->slug ? 'active1' : '' }}"
                        wire:click="setCategory('{{ $category->slug }}')">
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>

                <!-- Software Grid -->
                <div class="row">
                    @forelse($softwareList as $software)
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4" wire:key="soft-{{ $software->id }}">
                        <div class="template-content border p-2 rounded h-100 d-flex flex-column">
                            {{-- Image --}}
                            <div class="template-img mb-3">
                                @if($software->banner_url)
                                <img src="{{ $software->banner_url }}" alt="{{ $software->name }}" class="img-fluid rounded">
                                @else
                                <img src="{{ $software->logo_url }}" alt="{{ $software->name }}" class="img-fluid rounded" style="max-height: 200px; object-fit: contain; width: 100%;">
                                @endif
                            </div>

                            {{-- Title --}}
                            <a href="{{ route('software.show', $software->slug) }}" class="text-decoration-none text-dark" wire:navigate>
                                <h3>{{ $software->name }}</h3>
                            </a>

                            {{-- Short Description --}}
                            <p class="flex-grow-1">
                                {{ \Illuminate\Support\Str::limit($software->short_description, 120) }}
                            </p>

                            {{-- Action Button --}}
                            <a href="{{ route('software.show', $software->slug) }}" class="mt-auto" wire:navigate>
                                <button>
                                    View Details
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <h5 class="text-muted">Coming Soon.</h5>
                        <p>No software added to this category yet.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Loading Indicator --}}
                <div wire:loading class="text-center w-100 mt-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
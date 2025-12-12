<section class="partners-area bg-area">
    <div class="container">
        <h2 class="section-heading">Our Partners</h2>

        {{--
            NOTE: If you are using a JavaScript library like Slick Slider, 
            it modifies the DOM after the page loads. 
            If this Livewire component refreshes, the slider might break.
            If this component is static (doesn't change after load), this code is perfect.
        --}}
        <div class="row slick">
            @forelse($partners as $partner)
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="partner-img">
                    @if($partner->website_url)
                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                    </a>
                    @else
                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                    @endif
                </div>
            </div>
            @empty
            {{-- Fallback if no partners exist --}}
            <div class="col-12 text-center">
                <p class="text-muted">No partners to display.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
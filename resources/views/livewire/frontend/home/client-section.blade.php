<section class="clients-area bg-area">
    <div class="container">
        <h2 class="section-heading">Our Clients</h2>

        <div class="clients">
            @forelse($clients as $client)
            <div class="clients-img">
                @if($client->website_url)
                {{-- If URL exists, wrap in a link --}}
                <a href="{{ $client->website_url }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ $client->logo_url }}" alt="{{ $client->name }}">
                </a>
                @else
                {{-- Otherwise just show image --}}
                <img src="{{ $client->logo_url }}" alt="{{ $client->name }}">
                @endif
            </div>
            @empty
            {{-- Fallback content if no clients are uploaded yet --}}
            <div class="text-center w-100 py-3">
                <p class="text-muted">No clients to display.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
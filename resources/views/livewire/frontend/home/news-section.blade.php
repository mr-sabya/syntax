<section class="recent-news-area bg-area py-5">
    <div class="container">
        <h2 class="common-heading mb-5">Recent News</h2>
        <div class="row g-4">

            @forelse($newsPosts as $post)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="recent-news-card h-100">

                    {{-- Image Section --}}
                    <div class="recent-news-img">
                        <a href="{{ route('blog.show', $post->slug) }}" wire:navigate>
                            @if($post->image_url)
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                            @else
                            {{-- Placeholder if no image exists --}}
                            <img src="{{ asset('assets/frontend/images/blog_1.jpg') }}" alt="Default Image">
                            @endif
                        </a>

                        {{-- Date Badge (e.g., 12 Oct) --}}
                        <div class="date-badge">
                            {{ $post->published_at->format('d M') }}
                        </div>
                    </div>

                    {{-- Content Section --}}
                    <div class="news-content">
                        <h4>
                            <a href="{{ route('blog.show', $post->slug) }}" wire:navigate>
                                {{ \Illuminate\Support\Str::limit($post->title, 40) }}
                            </a>
                        </h4>

                        <p>
                            {{ \Illuminate\Support\Str::limit($post->excerpt, 80) }}
                        </p>

                        <div class="news-footer">
                            <a href="{{ route('blog.show', $post->slug) }}" class="read-more-btn" wire:navigate>
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            @empty
            {{-- Fallback if no news exists --}}
            <div class="col-12 text-center py-5">
                <p class="text-muted">No recent news available.</p>
            </div>
            @endforelse

        </div>
    </div>
</section>
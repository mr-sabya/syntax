<section class="blog-area bg-area">
    <div class="container">
        <div class="heading">
            <h2>Recent news</h2>
        </div>

        <div class="row">
            @forelse($posts as $post)
            <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                <div class="recent-news-card">
                    <div class="recent-news-img">
                        {{-- Use the accessor from your Model, with a fallback image --}}
                        <img src="{{ $post->image_url ?? asset('images/default-blog.png') }}"
                            alt="{{ $post->title }}"
                            style="width: 100%; height: 200px; object-fit: cover;">
                        <a href="#" class="category">
                            {{-- Display Category Name or 'Uncategorized' --}}
                            <span>{{ $post->category->name ?? 'News' }}</span>
                        </a>
                    </div>

                    <div class="recent-news-content p-3">
                        {{-- Link to details page (Update 'blog.show' to your actual route name) --}}


                        {{-- Limit title or excerpt length to keep grid uniform --}}
                        <h5 class="mt-2">
                            <a href="{{ route('blog.show', $post->slug) }}" wire:navigate style="color: inherit; text-decoration: none;">
                                {{ Str::limit($post->title, 40) }}
                            </a>
                        </h5>

                        <p>{{ Str::limit($post->excerpt, 80) }}</p>

                        <div class="recent-news-btn">
                            <p class="m-0">{{ $post->created_at->diffForHumans() }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" wire:navigate class="get-btn">Read <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No recent news available at the moment.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination Links --}}
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</section>
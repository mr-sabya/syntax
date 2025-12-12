<div class="blog-single-page blog-area bg-area">

    <!-- Header / Breadcrumb Section -->
    <section class="bg-area py-5 border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <!-- Category Badge -->
                    <span class="badge bg-primary mb-3">
                        {{ $post->category->name ?? 'Uncategorized' }}
                    </span>

                    <!-- Title -->
                    <h1 class="fw-bold mb-3 display-5">{{ $post->title }}</h1>

                    <!-- Meta Info -->
                    <div class="text-muted d-flex justify-content-center align-items-center gap-3">
                        <span><i class="far fa-calendar-alt me-1"></i> {{ $post->published_at->format('M d, Y') }}</span>
                        <span>&bull;</span>
                        <span><i class="far fa-clock me-1"></i> {{ $post->published_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content & Sidebar -->
    <section class="py-5">
        <div class="container">
            <div class="row">

                <!-- LEFT COLUMN: Post Content -->
                <div class="col-lg-8">
                    <article class="blog-post-content">

                        <!-- Featured Image -->
                        @if($post->image_url)
                        <div class="mb-4 rounded-3 overflow-hidden shadow-sm">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="img-fluid w-100">
                        </div>
                        @endif

                        <!-- The Content -->
                        {{--
                            We use {!! !!} because blog content usually contains HTML tags 
                            from the rich text editor (bold, lists, etc).
                        --}}
                        <div class="content-body lh-lg text-secondary mb-5">
                            {!! $post->content !!}
                        </div>

                        <!-- Tags -->
                        @if($post->tags->count() > 0)
                        <div class="border-top pt-4 mb-5">
                            <h5 class="fw-bold mb-3">Tags:</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($post->tags as $tag)
                                <span class="badge bg-light text-dark border px-3 py-2">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Share Buttons (Static Example) -->
                        <div class="d-flex align-items-center gap-3 mb-5">
                            <span class="fw-bold">Share:</span>
                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-info"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-success"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </article>

                    <!-- Related Posts Section -->
                    @if($relatedPosts->count() > 0)
                    <div class="related-posts mt-5">
                        <h3 class="section-heading text-start mb-4">You Might Also Like</h3>
                        <div class="row">
                            @foreach($relatedPosts as $related)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    @if($related->image_url)
                                    <img src="{{ $related->image_url }}" class="card-img-top" alt="{{ $related->title }}" style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none text-dark" wire:navigate>
                                                {{ \Illuminate\Support\Str::limit($related->title, 50) }}
                                            </a>
                                        </h5>
                                        <small class="text-muted">{{ $related->published_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- RIGHT COLUMN: Sidebar -->
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="sidebar">

                        <!-- Search Widget -->
                        {{-- Assuming you might want a search form pointing to a blog index --}}
                        <div class="widget mb-4 p-4 bg-light rounded">
                            <h5 class="fw-bold mb-3">Search</h5>
                            <form action="#" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search blog...">
                                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories Widget -->
                        <div class="widget mb-4 p-4 border rounded">
                            <h5 class="fw-bold mb-3">Categories</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($categories as $cat)
                                <li class="mb-2">
                                    <a href="#" class="text-decoration-none text-secondary d-flex justify-content-between align-items-center">
                                        <span>{{ $cat->name }}</span>
                                        <span class="badge bg-secondary rounded-pill">{{ $cat->posts_count }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Recent Posts Widget -->
                        <div class="widget mb-4 p-4 border rounded">
                            <h5 class="fw-bold mb-3">Recent Posts</h5>
                            @foreach($recentPosts as $recent)
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    @if($recent->image_url)
                                    <img src="{{ $recent->image_url }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                                    @else
                                    <div class="bg-secondary rounded" style="width: 60px; height: 60px;"></div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">
                                        <a href="{{ route('blog.show', $recent->slug) }}" class="text-decoration-none text-dark" wire:navigate>
                                            {{ \Illuminate\Support\Str::limit($recent->title, 40) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">{{ $recent->published_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        .content-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }

        .content-body h2,
        .content-body h3 {
            margin-top: 30px;
            font-weight: bold;
        }

        .content-body ul {
            margin-bottom: 20px;
        }
    </style>
</div>
<div class="product-area">
    {{-- 1. Hero / Banner Section --}}
    @if($page->banner_image)
    <div class="position-relative w-100" style="height: 300px; overflow: hidden;">
        {{-- Background Image --}}
        <img src="{{ asset('storage/' . $page->banner_image) }}"
            alt="{{ $page->title }}"
            class="w-100 h-100 object-fit-cover"
            style="object-position: center;">

        {{-- Overlay for text readability --}}
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>

        {{-- Title Centered on Banner --}}
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100 px-3">
            <h1 class="display-4 fw-bold">{{ $page->title }}</h1>

            {{-- Breadcrumb (Optional) --}}
            <nav aria-label="breadcrumb" class="d-flex justify-content-center mt-2">
                <ol class="breadcrumb breadcrumb-dark mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white-50" aria-current="page">{{ $page->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    @else
    {{-- Fallback Header if no image --}}
    <div class="bg-light py-5 mb-4">
        <div class="container text-center">
            <h1 class="fw-bold text-dark">{{ $page->title }}</h1>
            <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    @endif

    {{-- 2. Main Content Section --}}
    <section class="page-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                {{-- Depending on template, you can change column width here --}}
                <div class="{{ $page->template === 'full-width' ? 'col-12' : 'col-lg-10' }}">

                    {{-- Render HTML content from Quill Editor --}}
                    {{-- !! !! syntax is required to render HTML tags stored in DB --}}
                    <div class="typography-content text-break">
                        {!! $page->content !!}
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
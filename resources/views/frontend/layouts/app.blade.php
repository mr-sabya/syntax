<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <!-- ======== responsive ======== -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">
    @livewireStyles
</head>

<body>
    <!-- ====== header section start  ======== -->
    <livewire:frontend.theme.header />
    <!-- mb bottom tab start -->
    <livewire:frontend.theme.bottom-bar />
    <!-- mb bottom tab end -->
    <!-- ====== header section end  =========== -->
    @yield('content')


    <!-- ======== footer section start ============ -->
    <livewire:frontend.theme.footer />
    <!-- copyright section start -->
    <livewire:frontend.theme.copyright />
    <!-- copyright section end -->
    <!-- ======== footer section end ============== -->



    <script src="{{ asset('assets/frontend/js/jquary.all.2.2.4.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
    @livewireScripts
</body>

</html>
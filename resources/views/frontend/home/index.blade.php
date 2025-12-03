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
</head>

<body>
    <!-- ====== header section start  ======== -->
    <header>
        <div class="header-top-area bg-area">
            <div class="container">
                <div class="header-top">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{ url('assets/frontend/images/logo.png') }}" alt=""></a>
                    </div>
                    <div class="header-search d-flex">
                        <input type="text" placeholder="Search">
                        <div class="search-icon">
                            <a href="#"> <i class="fas fa-search"></i></a>
                        </div>
                    </div>

                    <div class="header-right">
                        <div class="icon-cards">
                            <div class="header-right-icon">
                                <a href="#"><i class="fas fa-user"></i></a>
                            </div>
                            <div class="header-right-content">
                                <a href="#">
                                    <h3>Profile</h3>
                                </a>
                            </div>
                        </div>
                        <div class="icon-cards">
                            <div class="header-right-icon">
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                            <div class="header-right-content">
                                <a href="#">
                                    <h3>Message</h3>
                                </a>
                            </div>
                        </div>
                        <div class="icon-cards">
                            <div class="header-right-icon">

                                <a href="#"><i class="fas fa-heart"></i></a>
                            </div>
                            <div class="header-right-content">
                                <a href="#">
                                    <h3>Order</h3>
                                </a>
                            </div>
                        </div>

                        <div class="icon-cards">
                            <div class="header-right-icon">
                                <a href="#"><i class="fas fa-cart-plus"></i></a>
                            </div>
                            <div class="header-right-content">
                                <a href="#">
                                    <h3>My Cart</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- navber section start  -->
        <div class="teach-top-area bg-area">
            <div class="container"><input type="checkbox" id="menu-bar">
                <!-- mb header start  -->
                <div class="mb-header-tab">
                    <label for="menu-bar">
                        <i class="fa fa-bars"></i>
                    </label>
                    <div class="mb-header-logo">
                        <img src="{{ url('assets/frontend/images/logo.png') }}" alt="">
                    </div>
                    <div class="mb-header-icon d-flex">
                        <div class="mbsearch d-flex">
                            <i class="fa fa-search search"></i>
                            <input type="text" placeholder="Search" id="search">
                        </div>
                    </div>
                </div>

                <nav class="navber ">
                    <ul>
                        <li>
                            <a href="product.html" class="menu ">All Product</a>
                        </li>
                        <li>
                            <a href="# " class="menu ">Hot offers</a>
                        </li>
                        <li>
                            <a href="# " class="menu ">Projects</a>
                        </li>
                        <li>
                            <a href="software.html" class="menu ">Software</a>
                        </li>
                        <li>
                            <a href="blog.html" class="menu ">Blog</a>
                        </li>
                        <li>
                            <a href="contact.html" class="menu ">Contact</a>
                        </li>

                        <!-- laptop drop-down start  -->
                        <!-- <li>
                        <select id="input-zone ">
                            <i class="fa-solid fa-cart-shopping "></i>
                            <option value=" ">Help</option>
                            <option value=" ">Help 1</option>
                            <option value=" ">Help 2</option>
                            <option value=" ">Help 3</option>
                        </select>
                    </li> -->
                    </ul>
                    <ul>
                        <!--  drop-down start  -->
                        <li>
                            <select id="input-zone ">
                                <option value=" ">Bangla</option>
                                <option value=" ">English</option>
                            </select>
                        </li>
                        <li>
                            <a href="# ">Ship to</a>
                        </li>
                        <li>
                            <select id="input-zone ">
                                <option value=" ">Bangladesh</option>
                                <option value=" ">India</option>
                                <option value=" ">China</option>
                                <option value=" ">Japan</option>
                                <option value=" ">Indoneshia</option>
                            </select>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- mb bottom tab start -->
    <div class="mb-bottom-tab-area ">
        <div class="container ">
            <div class="row ">
                <div class="col-12 ">
                    <div class="mb-bottom-tab ">
                        <a href="#">
                            <i class="fa fa-heart"></i>
                            <h5>Order</h5>
                        </a>
                        <a href="#">
                            <i class="fas fa-envelope"></i>
                            <h5>Message</h5>
                        </a>
                        <a href="#">
                            <i class="fas fa-cart-plus"></i>
                            <h5>My Cart</h5>
                        </a>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <h5>Profile</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mb bottom tab end -->
    <!-- ====== header section end  =========== -->

    <!--======= new-slide section start =======-->
    <section class="new-slide-area bg-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="all-product">
                        <ul class="d-ul">
                            <li class="d-li">
                                <a href="product.html">Laboratory Consumables</a>
                            </li>
                            <li class="d-li">
                                <a href="product.html">Capital Machinery</a>
                            </li>
                            <li class="d-li">
                                <a href="product.html">Laboratory Equipment</a>
                            </li>
                            <li class="d-li">
                                <a href="product.html">Sports and outdoor</a>
                            </li>
                            <li class="d-li">
                                <a href="product.html">Tools, equipments</a>
                            </li>
                            <li class="d-li">
                                <a href="product.html">Animal and pets</a>
                            </li>
                            <li class="d-li">
                                <a href="product.html">Machinery tools</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ url('assets/frontend/images/banner-bg-1.png') }}" class="d-block w-100" alt="banner-bg-1">
                                <div class="carousel-caption d-none d-md-block">
                                    <h2>Latest trending
                                        <span>Electronic items</span>
                                    </h2>
                                    <a href="#">
                                        <button>source now</button>
                                    </a>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ url('assets/frontend/images/banner-bg-2.png') }}" class="d-block w-100" alt="banner-bg-2">
                                <div class="carousel-caption d-none d-md-block">
                                    <h2>Latest trending
                                        <span>Electronic items</span>
                                    </h2>
                                    <a href="#">
                                        <button>source now</button>
                                    </a>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ url('assets/frontend/images/banner-bg-3.png') }}" class="d-block w-100" alt="banner-bg-3">
                                <div class="carousel-caption d-none d-md-block">
                                    <h2>Latest trending
                                        <span>Electronic items</span>
                                    </h2>
                                    <a href="#">
                                        <button>source now</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======== new-slide section end ========-->

    <!-- ======== deals section start ======== -->
    <section class="deals-area bg-area">
        <div class="container">
            <div class="deals-wrapper">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="counter-wrapper">
                            <div class="counter-text">
                                <h2 id="headline">Deals and offers</h2>
                                <p id="decribe">Hygiene equipments</p>
                            </div>
                            <div id="countdown">
                                <ul>
                                    <li><span id="days"></span>days</li>
                                    <li><span id="hours"></span>Hour</li>
                                    <li><span id="minutes"></span>Min</li>
                                    <li><span id="seconds"></span>Sec</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="items">
                            <div class="item">
                                <a href="product.html">
                                    <div class="deals-img">
                                        <img src="{{ url('assets/frontend/images/watch.png') }}" alt="watch">
                                    </div>
                                    <h2>smart watches</h2>
                                    <span>-25%</span>
                                </a>
                            </div>
                            <div class="item">
                                <a href="product.html">
                                    <div class="deals-img">
                                        <img src="{{ url('assets/frontend/images/laptop.png') }}" alt="laptop">
                                    </div>
                                    <h2>smart watches</h2>
                                    <span>-25%</span>
                                </a>
                            </div>
                            <div class="item">
                                <a href="product.html">
                                    <div class="deals-img">
                                        <img src="{{ url('assets/frontend/images/headphone.png') }}" alt="headphone">
                                    </div>
                                    <h2>smart watches</h2>
                                    <span>-25%</span>
                                </a>
                            </div>
                            <div class="item">
                                <a href="product.html">
                                    <div class="deals-img">
                                        <img src="{{ url('assets/frontend/images/camera.png') }}" alt="camera">
                                    </div>
                                    <h2>smart watches</h2>
                                    <span>-25%</span>
                                </a>
                            </div>
                            <div class="item">
                                <a href="product.html">
                                    <div class="deals-img">
                                        <img src="{{ url('assets/frontend/images/smart phone') }}.png" alt="smart phone">
                                    </div>
                                    <h2>smart watches</h2>
                                    <span>-25%</span>
                                </a>
                            </div>
                            <div class="item">
                                <a href="product.html">
                                    <div class="deals-img">
                                        <img src="{{ url('assets/frontend/images/headphone.png') }}" alt="headphone">
                                    </div>
                                    <h2>smart watches</h2>
                                    <span>-25%</span>
                                </a>
                            </div>
                            <div class="item">
                                <a href="product.html">
                                    <div class="deals-img">
                                        <img src="{{ url('assets/frontend/images/camera.png') }}" alt="camera">
                                    </div>
                                    <h2>smart watches</h2>
                                    <span>-25%</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== deals section end ========== -->

    <!--======== gadget section start ========-->
    <div class="gadget-area bg-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="consumer-wrapper">
                        <div class="consumer-img">
                            <img src="{{ url('assets/frontend/images/gadets.png') }}" al t="gadets">
                        </div>
                        <div class="consumer-content">
                            <h2>Consumer electronics and gadgets</h2>
                            <a href="#">
                                <button>source now</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="items-wrapper">
                        <div class="items">
                            <a href="#">
                                <h5>smart watches</h5>
                                <div class="price">
                                    <p>From <br>USD 19</p>
                                    <img src="{{ url('assets/frontend/images/watch.png') }}" alt="watch">
                                </div>
                            </a>
                        </div>
                        <div class="items">
                            <a href="#">
                                <h5>smart watches</h5>
                                <div class="price">
                                    <p>From <br>USD 19</p>
                                    <img src="{{ url('assets/frontend/images/watch.png') }}" alt="watch">
                                </div>
                            </a>
                        </div>
                        <div class="items">
                            <a href="#">
                                <h5>Cameras</h5>
                                <div class="price">
                                    <p>From <br>USD 19</p>
                                    <img src="{{ url('assets/frontend/images/camera.png') }}" alt="Cameras">
                                </div>
                            </a>
                        </div>
                        <div class="items">
                            <a href="#">
                                <h5>smart watches</h5>
                                <div class="price">
                                    <p>From <br>USD 19</p>
                                    <img src="{{ url('assets/frontend/images/watch.png') }}" alt="watch">
                                </div>
                            </a>
                        </div>
                        <div class="items">
                            <a href="#">
                                <h5>Headphones</h5>
                                <div class="price">
                                    <p>From <br>USD 19</p>
                                    <img src="{{ url('assets/frontend/images/headphone.png') }}" alt="headphone">
                                </div>
                            </a>
                        </div>
                        <div class="items">
                            <a href="#">
                                <h5>electric ketly</h5>
                                <div class="price">
                                    <p>From <br>USD 35</p>
                                    <img src="{{ url('assets/frontend/images/smart-ketly') }}.png" alt="smart-ketly">
                                </div>
                            </a>
                        </div>
                        <div class="items">
                            <a href="#">
                                <h5>electric ketly</h5>
                                <div class="price">
                                    <p>From <br>USD 35</p>
                                    <img src="{{ url('assets/frontend/images/smart-ketly') }}.png" alt="smart-ketly">
                                </div>
                            </a>
                        </div>
                        <div class="items">
                            <a href="#">
                                <h5>smart watches</h5>
                                <div class="price">
                                    <p>From <br>USD 19</p>
                                    <img src="{{ url('assets/frontend/images/watch.png') }}" alt="watch">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======== gadget section end ========-->

    <!--======== new-arrival section start ======-->
    <section class="new-arrival-area bg-area">
        <div class="container">
            <h2 class="new-arrival-heading common-heading">new arrival</h2>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="new-arrival">
                        <img src="{{ url('assets/frontend/images/new arrival.png') }}" alt="new arrival">
                        <div class="text-buttton">
                            <h2>Consumer electronics and gadgets</h2>
                            <a href="#">
                                <button>source now</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="new-arrival-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a class="over" href="product-detail.html">
                                    <div class="product">
                                        <img src="{{ url('assets/frontend/images/galaxy-2.png') }}" alt="galaxy-2">
                                        <h3>Galaxy M13(4GB|64GB)</h3>
                                        <h5>₹10499 <span><del>14999</del></span></h5>
                                        <samp>Save-₹4000</samp>
                                        <div class="discount">
                                            <h2>56% <br>OFF</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <a href="product-detail.html">
                                    <div class="product">
                                        <img src="{{ url('assets/frontend/images/galaxy-1.png') }}" alt="galaxy-1">
                                        <h3>Galaxy M13(4GB|64GB)</h3>
                                        <h5>₹10499 <span><del>14999</del></span></h5>
                                        <samp>Save-₹4000</samp>
                                        <div class="discount">
                                            <h2>56% <br>OFF</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <a href="product-detail.html">
                                    <div class="product">
                                        <img src="{{ url('assets/frontend/images/galaxy-3.png') }}" alt="galaxy-3">
                                        <h3>Galaxy M13(4GB|64GB)</h3>
                                        <h5>₹10499 <span><del>14999</del></span></h5>
                                        <samp>Save-₹4000</samp>
                                        <div class="discount">
                                            <h2>56% <br>OFF</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <a href="product-detail.html">
                                    <div class="product">
                                        <img src="{{ url('assets/frontend/images/galaxy-1.png') }}" alt="galaxy-1">
                                        <h3>Galaxy M13(4GB|64GB)</h3>
                                        <h5>₹10499 <span><del>14999</del></span></h5>
                                        <samp>Save-₹4000</samp>
                                        <div class="discount">
                                            <h2>56% <br>OFF</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <a href="product-detail.html">
                                    <div class="product">
                                        <img src="{{ url('assets/frontend/images/galaxy-3.png') }}" alt="galaxy-3">
                                        <h3>Galaxy M13(4GB|64GB)</h3>
                                        <h5>₹10499 <span><del>14999</del></span></h5>
                                        <samp>Save-₹4000</samp>
                                        <div class="discount">
                                            <h2>56% <br>OFF</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <a href="product-detail.html">
                                    <div class="product">
                                        <img src="{{ url('assets/frontend/images/galaxy-1.png') }}" alt="galaxy-1">
                                        <h3>Galaxy M13(4GB|64GB)</h3>
                                        <h5>₹10499 <span><del>14999</del></span></h5>
                                        <samp>Save-₹4000</samp>
                                        <div class="discount">
                                            <h2>56% <br>OFF</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <a href="product-detail.html">
                                    <div class="product">
                                        <img src="{{ url('assets/frontend/images/galaxy-2.png') }}" alt="galaxy-2">
                                        <h3>Galaxy M13(4GB|64GB)</h3>
                                        <h5>₹10499 <span><del>14999</del></span></h5>
                                        <samp>Save-₹4000</samp>
                                        <div class="discount">
                                            <h2>56% <br>OFF</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <a href="product-detail.html">
                                    <div class="product">
                                        <img src="{{ url('assets/frontend/images/galaxy-3.png') }}" alt="galaxy-3">
                                        <h3>Galaxy M13(4GB|64GB)</h3>
                                        <h5>₹10499 <span><del>14999</del></span></h5>
                                        <samp>Save-₹4000</samp>
                                        <div class="discount">
                                            <h2>56% <br>OFF</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--======== new-arrival section end ========-->

    <!--======== recommended items section start ========-->
    <section class="recommended-area bg-area">
        <div class="container">
            <h2 class="recommended-heading common-heading">Recommended items</h2>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                    <div class="items">
                        <a href="product-detail.html">
                            <div class="item">
                                <div class="recom-img">
                                    <img src="{{ url('assets/frontend/images/recom-1.png') }}" alt="recom-1">
                                </div>
                                <h5>$10.30</h5>
                                <p>T-shirts with multiple colors, for men</p>
                                <div class="shado">
                                    <button>Add to Cart</button>
                                    <p>
                                        <i class="fas fa-share-alt"></i> Share
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="product-detail.html">
                            <div class="item">
                                <div class="recom-img">
                                    <img src="{{ url('assets/frontend/images/recom-2.png') }}" alt="recom-2">
                                </div>
                                <h5>$10.30</h5>
                                <p>Jeans bag for travel for men</p>
                                <div class="shado">
                                    <button>Add to Cart</button>
                                    <p>
                                        <i class="fas fa-share-alt"></i> Share
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="product-detail.html">
                            <div class="item">
                                <div class="recom-img">
                                    <img src="{{ url('assets/frontend/images/recom-3.png') }}" alt="recom-3">
                                </div>
                                <h5>$10.30</h5>
                                <p>T-shirts with multiple colors, for men</p>
                                <div class="shado">
                                    <button>Add to Cart</button>
                                    <p>
                                        <i class="fas fa-share-alt"></i> Share
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="product-detail.html">
                            <div class="item">
                                <div class="recom-img">
                                    <img src="{{ url('assets/frontend/images/recom-4.png') }}" alt="recom-4">
                                </div>
                                <h5>$10.30</h5>
                                <p>T-shirts with multiple colors, for men</p>
                                <div class="shado">
                                    <button>Add to Cart</button>
                                    <p>
                                        <i class="fas fa-share-alt"></i> Share
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="product-detail.html">
                            <div class="item">
                                <div class="recom-img">
                                    <img src="{{ url('assets/frontend/images/recom-2.png') }}" alt="recom-2">
                                </div>
                                <h5>$10.30</h5>
                                <p>T-shirts with multiple colors, for men</p>
                                <div class="shado">
                                    <button>Add to Cart</button>
                                    <p>
                                        <i class="fas fa-share-alt"></i> Share
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="product-detail.html">
                            <div class="item">
                                <div class="recom-img">
                                    <img src="{{ url('assets/frontend/images/recom-2.png') }}" alt="recom-2">
                                </div>
                                <h5>$10.30</h5>
                                <p>T-shirts with multiple colors, for men</p>
                                <div class="shado">
                                    <button>Add to Cart</button>
                                    <p>
                                        <i class="fas fa-share-alt"></i> Share
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======== recommended items section end ========-->

    <!--======== software section start ========-->
    <section class="software-area bg-area">
        <div class="container">
            <h2 class="section-heading">Our Software</h2>
            <div class="main">
                <div id="myBtnContainer">
                    <button class="filter-btn active1" onclick="filterSelection('clinic')">Clinic and Diagnostic</button>
                    <button class="filter-btn" onclick="filterSelection('online-dealer')"> Online dealer and distributor</button>
                    <button class="filter-btn" onclick="filterSelection('dealer-distributor')"> Dealer and distributor</button>
                    <button class="filter-btn" onclick="filterSelection('jewelry-software')"> Jewelry Software</button>
                </div>

                <div class="row">
                    <div class="column clinic">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-1.png') }}" alt="template-1">
                                        </div>
                                        <a href="#">
                                            <h3>Template 1</h3>
                                        </a>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="software-detail.html">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-1.png') }}" alt="template-1">
                                        </div>
                                        <a href="#">
                                            <h3>Template 1</h3>
                                        </a>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="software-detail.html">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-1.png') }}" alt="template-1">
                                        </div>
                                        <a href="#">
                                            <h3>Template 1</h3>
                                        </a>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="software-detail.html">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-1.png') }}" alt="template-1">
                                        </div>
                                        <a href="#">
                                            <h3>Template 1</h3>
                                        </a>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="software-detail.html">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column  online-dealer">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-2.png') }}" alt="template-2">
                                        </div>
                                        <a href="#">
                                            <a href="#">
                                                <h3>Template 2</h3>
                                            </a>
                                        </a>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="#">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column dealer-distributor">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-2.png') }}" alt="template-2">
                                        </div>
                                        <a href="#">
                                            <h3>Template 2</h3>
                                        </a>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="#">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-1.png') }}" alt="template-1">
                                        </div>
                                        <h3>Template 1</h3>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="#">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-2.png') }}" alt="template-2">
                                        </div>
                                        <a href="#">
                                            <h3>Template 2</h3>
                                        </a>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="#">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column jewelry-software">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-1.png') }}" alt="template-1">
                                        </div>
                                        <h3>Template 1</h3>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="#">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <div class="template-content">
                                        <div class="template-img">
                                            <img src="{{ url('assets/frontend/images/template-2.png') }}" alt="template-2">
                                        </div>
                                        <a href="#">
                                            <h3>Template 2</h3>
                                        </a>
                                        <p>
                                            Apparently we had reached a great height in the atmosphere, for the sky was a dead black, and the stars had ceased to twinkle.
                                        </p>
                                        <a href="#">
                                            <button>
                                                View Details
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======== software section end ========-->

    <!--======== partners section start ========-->
    <section class="partners-area bg-area">
        <div class="container">
            <h2 class="section-heading">our partners</h2>
            <div class="row slick">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="partner-img">
                        <img src="{{ url('assets/frontend/images/delta-logo-1.png') }}" alt="delta-logo-1">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="partner-img">
                        <img src="{{ url('assets/frontend/images/delta-logo-2.png') }}" alt="delta-logo-2">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="partner-img">
                        <img src="{{ url('assets/frontend/images/delta-logo-3.png') }}" alt="delta-logo-3">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="partner-img">
                        <img src="{{ url('assets/frontend/images/delta-logo-4.png') }}" alt="delta-logo-4">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="partner-img">
                        <img src="{{ url('assets/frontend/images/delta-logo-1.png') }}" alt="delta-logo-1">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="partner-img">
                        <img src="{{ url('assets/frontend/images/delta-logo-2.png') }}" alt="delta-logo-2">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="partner-img">
                        <img src="{{ url('assets/frontend/images/delta-logo-3.png') }}" alt="delta-logo-3">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="partner-img">
                        <img src="{{ url('assets/frontend/images/delta-logo-4.png') }}" alt="delta-logo-4">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======== partners section end ========-->

    <!--======== clients section start ========-->
    <section class="clients-area bg-area">
        <div class="container">
            <h2 class="section-heading">our Clients</h2>
            <div class="clients">
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-1.png') }}" alt="BINA 1">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-2.png') }}" alt="BINA 2">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-3.png') }}" alt="BINA 3">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-4.png') }}" alt="BINA 4">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-5.png') }}" alt="BINA 5">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-1.png') }}" alt="BINA 1">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-2.png') }}" alt="BINA 2">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-3.png') }}" alt="BINA 3">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-4.png') }}" alt="BINA 4">
                </div>
                <div class="clients-img">
                    <img src="{{ url('assets/frontend/images/BINA-5.png') }}" alt="BINA 5">
                </div>
            </div>
        </div>
    </section>
    <!--======== clients section end ========-->

    <!-- ======== recent section start ============ -->
    <section class="recent-news-area bg-area">
        <div class="container">
            <h2 class="common-heading">
                recent news
            </h2>
            <div class="row recent">
                <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                    <div class="recent-news-card">
                        <a href="blog.html">
                            <div class="recent-news-img">
                                <img src="{{ url('assets/frontend/images/news-1.png') }}" alt="news-1">
                            </div>
                        </a>
                        <div class="recent-news-content">
                            <a href="blog.html">
                                <span>Coaching</span>
                            </a>
                            <p>Lorem Ipsum is simply text of the printing and type setting industry.</p>
                        </div>
                        <div class="recent-news-btn ">
                            <a href="#" class="get-btn">Read</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                    <div class="recent-news-card">
                        <a href="blog.html">
                            <div class="recent-news-img">
                                <img src="{{ url('assets/frontend/images/news-1.png') }}" alt="news-1">
                            </div>
                        </a>
                        <div class="recent-news-content">
                            <a href="blog.html">
                                <span>Digital Partner</span>
                            </a>
                            <p>Lorem Ipsum is simply text of the printing and type setting industry.</p>
                        </div>
                        <div class="recent-news-btn ">
                            <a href="#" class="get-btn">Read</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                    <div class="recent-news-card">
                        <a href="blog.html">
                            <div class="recent-news-img">
                                <img src="{{ url('assets/frontend/images/news-2.png') }}" alt="news-2">
                            </div>
                        </a>
                        <div class="recent-news-content">
                            <a href="blog.html">
                                <span>SEO</span>
                            </a>
                            <p>Lorem Ipsum is simply text of the printing and type setting industry.</p>
                        </div>
                        <div class="recent-news-btn ">
                            <a href="#" class="get-btn">Read</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                    <div class="recent-news-card">
                        <div class="recent-news-img">
                            <img src="{{ url('assets/frontend/images/news-3.png') }}" alt="news-3">
                        </div>
                        <div class="recent-news-content">
                            <a href="blog.html">
                                <span>Coaching</span>
                            </a>
                            <p>Lorem Ipsum is simply text of the printing and type setting industry.</p>
                        </div>
                        <div class="recent-news-btn ">
                            <a href="#" class="get-btn">Read</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                    <div class="recent-news-card">
                        <div class="recent-news-img">
                            <img src="{{ url('assets/frontend/images/news-3.png') }}" alt="news-3">
                        </div>
                        <div class="recent-news-content">
                            <a href="blog.html">
                                <span>Coaching</span>
                            </a>
                            <p>Lorem Ipsum is simply text of the printing and type setting industry.</p>
                        </div>
                        <div class="recent-news-btn ">
                            <a href="#" class="get-btn">Read</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== recent section end ============ -->

    <!-- ======== subscribe section start ============ -->
    <section class="subscribe-area bg-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="syntax">
                        <img class="group-im" src="{{ url('assets/frontend/images/subscribe-bg.png') }}" alt="subscribe-bg">
                        <img class="syn-im" src="{{ url('assets/frontend/images/subscribe.png') }}" alt="subscribe">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="subscribe-content">
                        <h2 class="subscribe-heading section-heading">Subscribe
                            <span>Our</span> News
                        </h2>
                        <p class="text">
                            Subscribe Our News Hey! Are you tired of missing out on our updates? Subscribe to our news now and stay in the loop!
                        </p>
                        <form action="">
                            <input type="text" placeholder="Email Address">
                            <button class="common-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== subscribe section end ============ -->

    <!-- ======== footer section start ============ -->
    <footer class="footer-area bg-area">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                        <div class="footer-widget">
                            <a href="#">
                                <div class="footer-logo">
                                    <img src="{{ url('assets/frontend/images/logo.png') }}" alt="logo">
                                </div>
                            </a>
                            <div class="footer-text">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, laboriosam!
                                </p>
                                <ul class="footer-icons social-icons d-flex">
                                    <li>
                                        <a href="#"><i class="fab fa-facebook-f facebook-bg"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-instagram instagram-bg"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                        <div class="footer-widget space">
                            <div class="footer-wedget-headling">
                                <h3>About</h3>
                            </div>
                            <ul class="footer-widget-content">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Privacy policy</a></li>
                                <li><a href="#">Terms and conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                        <div class="footer-widget space">
                            <div class="footer-wedget-headling">
                                <h3>Partnership</h3>
                            </div>
                            <ul class="footer-widget-content">
                                <li><a href="#">Our Partners</a></li>
                                <li><a href="#">Our Clients</a></li>
                                <li><a href="#">Find store</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                        <div class="footer-widget space">
                            <div class="footer-wedget-headling">
                                <h3>Information</h3>
                            </div>
                            <ul class="footer-widget-content">
                                <li><a href="#">Help Center</a></li>
                                <li><a href="#">Contact us</a></li>
                                <li><a href="#">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                        <div class="footer-widget space">
                            <div class="footer-wedget-headling">
                                <h3>For users</h3>
                            </div>
                            <ul class="footer-widget-content">
                                <li><a href="#">Login</a></li>
                                <li><a href="#">Register</a></li>
                                <li><a href="#">Settings</a></li>
                                <li><a href="#">My Orders</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                        <div class="footer-widget space">
                            <div class="footer-wedget-headling">
                                <h3>Get App</h3>
                            </div>
                            <ul class="footer-app">
                                <li>
                                    <a href="#">
                                        <div class="footer-app-img">
                                            <img src="{{ url('assets/frontend/images/app-1.png') }}" alt="app-1">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="footer-app-img">
                                            <img src="{{ url('assets/frontend/images/app-2.png') }}" alt="app-2">
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- copyright section start -->
    <section class="copyright-area bg-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="copyright-text">
                        <p>
                            @ copyright 2024 <a href="#">Syntax Corporation</a> || <a href="https://gainsit.net/" target="_blank">Developed by Gains IT</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- copyright section end -->
    <!-- ======== footer section end ============== -->



    <script src="{{ asset('assets/frontend/js/jquary.all.2.2.4.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
</body>

</html>
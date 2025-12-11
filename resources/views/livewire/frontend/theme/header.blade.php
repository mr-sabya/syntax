<header>
    <div class="header-top-area bg-area">
        <div class="container">
            <div class="header-top">
                <div class="header-logo">
                    <a href="{{ route('home') }}" wire:navigate><img src="{{ url('assets/frontend/images/logo.png') }}" alt=""></a>
                </div>
                <div class="header-search d-flex">
                    <input type="text" placeholder="Search">
                    <div class="search-icon">
                        <a href="#"> <i class="fas fa-search"></i></a>
                    </div>
                </div>

                <div class="header-right">

                    @auth
                    <!-- LOGGED IN USER SEES: Profile, Message, Orders -->
                    <div class="icon-cards">
                        <div class="header-right-content">
                            <a href="{{ route('profile') }}" wire:navigate>
                                <i class="fas fa-user"></i>
                                <h3>Profile</h3>
                            </a>
                        </div>
                    </div>

                    <div class="icon-cards">
                        <div class="header-right-content">
                            <a href="#">
                                <i class="fas fa-envelope"></i>
                                <h3>Message</h3>
                            </a>
                        </div>
                    </div>

                    <div class="icon-cards">
                        <div class="header-right-content">
                            {{-- Assuming this links to Orders history --}}
                            <a href="#" wire:click="$dispatch('switchTab', { tab: 'orders' })">
                                <i class="fas fa-box-open"></i> {{-- Changed icon to Box for Orders --}}
                                <h3>Orders</h3>
                            </a>
                        </div>
                    </div>

                    @else
                    <!-- GUEST SEES: Login, Wishlist -->
                    <div class="icon-cards">
                        <div class="header-right-content">
                            <a href="{{ route('login') }}" wire:navigate>
                                <i class="fas fa-sign-in-alt"></i>
                                <h3>Login</h3>
                            </a>
                        </div>
                    </div>

                    <div class="icon-cards">
                        <div class="header-right-content">
                            <a href="#">
                                <i class="fas fa-heart"></i>
                                <h3>Wishlist</h3>
                            </a>
                        </div>
                    </div>
                    @endauth

                    <!-- ALWAYS VISIBLE: Cart -->
                    <div class="icon-cards">
                        <div class="header-right-content">
                            <a href="javascript:void(0)" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideCart">
                                <i class="fas fa-cart-plus"></i>
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
                        <a href="{{ route('shop') }}" wire:navigate class="menu ">All Product</a>
                    </li>
                    <li>
                        <a href="{{ route('hot-offers')}}" wire:navigate class="menu ">Hot offers</a>
                    </li>
                    <li>
                        <a href="#" class="menu ">Software</a>
                    </li>
                    <li>
                        <a href="{{ route('blog')}}" wire:navigate class="menu ">Blog</a>
                    </li>
                    <li>
                        <a href="{{ route('about')}}" wire:navigate class="menu">About</a>
                    </li>
                    <li>
                        <a href="{{ route('contact')}}" wire:navigate class="menu ">Contact</a>
                    </li>
                </ul>
                <ul>
                    <!--  drop-down start  -->
                    <li>
                        <select id="input-zone ">
                            <option value=" ">English</option>
                        </select>
                    </li>
                    <li>
                        <a href="# ">Ship to</a>
                    </li>
                    <li>
                        <select id="input-zone ">
                            <option value=" ">Bangladesh</option>
                        </select>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
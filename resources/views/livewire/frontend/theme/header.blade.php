<header>
    <div class="header-top-area bg-area">
        <div class="container">
            <div class="header-top">
                <div class="header-logo">
                    <livewire:frontend.theme.logo />
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
                            <a href="#" wire:click="$dispatch('switchTab', { tab: 'orders' })">
                                <i class="fas fa-box-open"></i>
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

                    @endauth

                    <div class="icon-cards">
                        <div class="header-right-content position-relative">
                            <a href="{{ route('order.track') }}" wire:navigate>
                                <i class="fas fa-shipping-fast"></i>
                                <h3>Track Order</h3>
                            </a>
                        </div>
                    </div>

                    <!-- CART SECTION -->
                    <!-- Alpine Data: Handles switching between DB count (Auth) and LocalStorage count (Guest) -->
                    <div class="icon-cards"
                        x-data="{ 
                            authCount: @entangle('cartCount'),
                            guestCount: 0,
                            isLoggedIn: {{ Auth::check() ? 'true' : 'false' }},
                            updateGuestCart() {
                                // Read from Local Storage
                                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                                // Sum up quantities
                                this.guestCount = cart.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                            }
                         }"
                        x-init="
                            updateGuestCart();
                            
                            // Listen for the AddToCartButton event (Guest)
                            window.addEventListener('add-to-local-storage', (event) => {
                                // Wait a tiny bit for the actual storage script to save data
                                setTimeout(() => { updateGuestCart(); }, 100);
                            });

                            // Listen for storage changes in other tabs
                            window.addEventListener('storage', () => { updateGuestCart(); });
                         ">
                        <div class="header-right-content position-relative">
                            <!-- Show Auth Count or Guest Count based on login status -->
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                x-text="isLoggedIn ? authCount : guestCount">
                                0
                            </span>

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

    <!-- navbar section start (unchanged) -->
    <div class="teach-top-area bg-area">
        <div class="container"><input type="checkbox" id="menu-bar">
            <!-- mb header start  -->
            <div class="mb-header-tab">
                <button class="menu-btn" for="menu-bar">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="mb-header-logo">
                    <livewire:frontend.theme.logo />
                </div>
                <div class="mb-header-icon d-flex">
                    <button
                        type="button"
                        class="search-btn-mb"
                        data-bs-toggle="modal"
                        data-bs-target="#searchModal"
                        aria-label="Open Search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <nav class="navber ">
                <ul>
                    <li><a href="{{ route('shop') }}" wire:navigate class="menu ">All Product</a></li>
                    <li><a href="{{ route('hot-offers')}}" wire:navigate class="menu ">Hot offers</a></li>
                    <li><a href="{{ route('software') }}" wire:navigate class="menu ">Software</a></li>
                    <li><a href="{{ route('partners') }}" wire:navigate class="menu ">Our Partners</a></li>
                    <li><a href="{{ route('clients') }}" wire:navigate class="menu ">Our Clients</a></li>
                    <li><a href="{{ route('blog')}}" wire:navigate class="menu ">Blog</a></li>
                    <li><a href="{{ route('about')}}" wire:navigate class="menu">About</a></li>
                    <li><a href="{{ route('contact')}}" wire:navigate class="menu ">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
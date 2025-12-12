<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(Route::is('home'))
    <title>Syntax Corporation | Your Trusted Partner</title>
    @else
    <title>@yield('title') - Syntax Corporation</title>
    @endif

    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <!-- ======== responsive ======== -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">

    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
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

    @livewire('frontend.utilities.whats-app-button')
    <!-- The Container -->
    <!-- <div id="WAButton"></div> -->

    <!-- 2. The Side Cart -->
    <div class="offcanvas offcanvas-end side-cart" tabindex="-1" id="sideCart" aria-labelledby="sideCartLabel">

        <!-- 2. The Livewire Component (Dynamic Content) -->
        <livewire:frontend.theme.side-cart />

    </div>



    <script data-navigate-once src="{{ asset('assets/frontend/js/jquary.all.2.2.4.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
    <script src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>

    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>

    @stack('script')
    <script>
        document.addEventListener('livewire:init', () => {
            // Listen for the specific Livewire event dispatched from the PHP component
            Livewire.on('add-to-local-storage', ({
                data
            }) => {

                // 1. Get existing cart from Local Storage
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                // 2. Check if product already exists
                let existingItem = cart.find(item => item.id === data.id);

                if (existingItem) {
                    // Increment quantity
                    existingItem.quantity += 1;
                } else {
                    // Add new item
                    cart.push(data);
                }

                // 3. Save back to Local Storage
                localStorage.setItem('cart', JSON.stringify(cart));

                // 4. Dispatch a Window event so your Navbar/Header can update the count immediately
                window.dispatchEvent(new CustomEvent('cart-local-updated', {
                    detail: {
                        cart: cart
                    }
                }));

                // Optional: Show an alert/toast
                alert('Item added to cart (Guest)!');
                // If you use Toastr/SweetAlert: toastr.success('Added to cart');
            });

            // Optional: Listen for server-side notifications (Auth user)
            Livewire.on('notify', ({
                type,
                message
            }) => {
                alert(message); // Replace with toastr[type](message) if you have it
            });
        });
    </script>
    
    <!-- Check if session has the clear flag -->
    @if(session('clear_guest_cart'))
    <script>
        document.addEventListener("livewire:navigated", function() {
            // Clear the cart from local storage
            localStorage.removeItem('cart');

            // Dispatch event to update the UI (Nav counters, etc) to show 0/empty 
            // until the DB cart loads
            window.dispatchEvent(new CustomEvent('cart-local-updated'));

            console.log('Guest cart synced to database and cleared from local storage.');
        });
    </script>
    @endif
    @livewireScripts
</body>

</html>
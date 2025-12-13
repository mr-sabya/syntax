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
                    <a href="javascript:void(0)" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideCart">
                        <i class="fas fa-cart-plus"></i>
                        <h5>My Cart</h5>
                    </a>
                    @auth
                    <a href="{{ route('profile') }}" wire:navigate>
                        <i class="fa fa-user"></i>
                        <h5>Profile</h5>
                    </a>
                    @else
                    <a href="{{ route('login') }}" wire:navigate>
                        <i class="fas fa-sign-in-alt"></i>
                        <h5>Login</h5>
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
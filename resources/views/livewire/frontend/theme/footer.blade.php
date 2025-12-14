<footer class="footer-area bg-area">
    <div class="container">
        <div class="footer-content">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                    <div class="footer-widget">
                        <a href="{{ route('home') }}" wire:navigate>
                            <div class="footer-logo">
                                <img src="{{ isset($settings['logo']) ? url('storage/' .$settings['logo']) : url('assets/frontend/images/logo.png') }}" alt="logo">
                            </div>
                        </a>
                        <div class="footer-text">
                            <p>{!! $settings['footer_about'] ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, laboriosam!' !!}
                            </p>
                            <ul class="footer-icons social-icons d-flex">
                                <li>
                                    <a href="{{ $settings['facebook'] ?? '#' }}"><i class="fab fa-facebook-f facebook-bg"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $settings['twitter'] ?? '#' }}"><i class="fab fa-twitter twitter-bg"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $settings['instagram'] ?? '#' }}"><i class="fab fa-instagram instagram-bg"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $settings['youtube'] ?? '#' }}"><i class="fab fa-youtube"></i></a>
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
                            <li><a href="{{ route('about') }}" wire:navigate>About us</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Terms and conditions</a></li>
                            <li><a href="{{ route('contact') }}" wire:navigate>Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                    <div class="footer-widget space">
                        <div class="footer-wedget-headling">
                            <h3>Partnership</h3>
                        </div>
                        <ul class="footer-widget-content">
                            <li><a href="{{ route('partners') }}" wire:navigate>Our Partners</a></li>
                            <li><a href="{{ route('clients') }}" wire:navigate>Our Clients</a></li>
                            <li><a href="{{ route('shop') }}" wire:navigate>Find store</a></li>
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
                            <li><a href="{{ route('contact') }}" wire:navigate>Contact us</a></li>
                            <li><a href="{{ route('blog') }}" wire:navigate>Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 pe-0">
                    <div class="footer-widget space">
                        <div class="footer-wedget-headling">
                            <h3>For users</h3>
                        </div>
                        <ul class="footer-widget-content">
                            <li><a href="{{ route('login') }}" wire:navigate>Login</a></li>
                            <li><a href="{{ route('register') }}" wire:navigate>Register</a></li>
                            <li><a href="{{ route('order.track') }}" wire:navigate>Track Order</a></li>
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
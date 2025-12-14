<section class="bg-area contact-area">
    <div class="container">
        <div class="form-heading contact-heading">
            <h2>Contact <span>With Us</span></h2>
            <p>
                {{ $settings['contact_page_text'] }}
            </p>
        </div>
        <div class="contact-wraper">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="contact-content">
                        <!-- head-office  -->
                        <div class="head-office">
                            <div class="contact-section-heading">
                                <h2>
                                    Head Office
                                </h2>
                            </div>
                            <div class="location">
                                <p class="text">{!! $settings['address'] !!}</p>
                            </div>
                        </div>
                        <!-- phone number  -->
                        <div class="phone-number">
                            <div class="contact-section-heading">
                                <h2>
                                    Phone number
                                </h2>
                            </div>
                            <div class="location">
                                <p class="text">{{ $settings['phone'] }}</p>
                            </div>
                        </div>
                        <!-- email  -->
                        <div class="contact-email">
                            <div class="contact-section-heading">
                                <h2>
                                    Email
                                </h2>
                            </div>
                            <div class="location">
                                <p class="text">{{ $settings['email'] }}</p>
                            </div>
                        </div>
                        <!-- time  -->
                        <div class="contact-time">
                            <div class="contact-section-heading">
                                <h2>
                                    Time
                                </h2>
                            </div>
                            <div class="location">
                                <p class="text">{{ $settings['open_day'] }}</p>
                                <p class="text">{{ $settings['open_time'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="contact-img-content">
                        <div class="contact-img">
                            <img src="{{ isset($settings['contact_image']) ? url('storage/' . $settings['contact_image']) : url('assets/frontend/images/contact.png') }}" alt="contact">
                        </div>
                    </div>
                    <div class="contact-social-media">
                        <div class="contact-heading contact-section-heading">
                            <h2>
                                Social Media
                            </h2>
                        </div>
                        <ul class=" social-icons d-flex">
                            <li>
                                <a href="{{ $settings['facebook'] }}"><i class="fab fa-facebook-f facebook-bg"></i></a>
                            </li>
                            <li>
                                <a href="{{ $settings['twitter'] }}"><i class="fab fa-twitter twitter-bg"></i></a>
                            </li>
                            <li>
                                <a href="{{ $settings['instagram'] }}"><i class="fab fa-instagram instagram-bg"></i></a>
                            </li>
                            <li>
                                <a href="{{ $settings['youtube'] }}"><i class="fab fa-youtube"></i></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
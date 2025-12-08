@extends('frontend.layouts.app')

@section('title', 'Conatct')

@section('content')


<!-- =============== contact section start =============== -->
<section class="bg-area contact-area">
    <div class="container">
        <div class="form-heading contact-heading">
            <h2>Contact <span>With Us</span></h2>
            <p>
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin
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
                                <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley Letraset sheets containing
                                    Lorem Ipsum passages, software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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
                                <p class="text">+8802 22 22 43 465</p>
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
                                <p class="text">info@syntaxbd.org</p>
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
                                <p class="text">Saturday to Friday</p>
                                <p class="text">9 am - 10 pm</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="contact-img-content">
                        <div class="contact-img">
                            <img src="{{ url('assets/frontend/images/contact.png') }}" alt="contact">
                        </div>
                        <div class="contact-location">
                            <p class="text"> 4517 Washington Ave. Manchester, Kentucky 39495</p>
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
        </div>
    </div>
</section>

<!-- =============== contact section end =============== -->

@endsection
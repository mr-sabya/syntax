@extends('frontend.layouts.app')

@section('title', 'About')

@section('content')


<!-- ============== syntax-about section start ============ -->
<section class="bg-area syntax-about-area">
    <div class="container">
        <div class="syntax-about-heading heading-2">
            <span>Welcome to</span>
            <h2>
                Syntax Corporation
            </h2>
        </div>
        <div class="syntax-about-wrapper">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="learn-about syntax-about-content">
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. </h5>
                        <p>
                            Hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis. Hendrerit in vulputate velit esse molestie consequat,
                            vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis. Hendrerit in vulputate velit esse molestie consequat, vel illum dolore
                        </p>
                        <p>
                            eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis. Hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                        </p>
                        <p>
                            facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="about-img">
                        <img src="{{ url('assets/frontend/images/about.png') }}" alt="about">
                    </div>
                </div>
            </div>
        </div>
        <!-- mission  -->
        <div class="syntax-about-mission">
            <div class="syntax-about-heading heading-2">
                <h2>
                    Mission
                </h2>
            </div>
            <div class="mission-content syntax-about-content">
                <p>
                    The success of a restaurant depends on many factors that can heavily affect a business’s success, some of these factors include the location, current popular food trends, customer service, the restaurant’s atmosphere, as well as how good the food is.
                    The last trait, in particular, is an area where many restaurants mess up. They get too comfortable and the next thing you know, their menu becomes outdated and their customers slowly grow tired of it. Now that’s not to say that
                    restaurants should completely forget about the other factors related to their business. Without a great location, you won’t have the consumer base available to keep your business alive, and without good customer service, people
                    will be so turned off that they won’t want to visit your restaurant again.
                </p>
                <ul>
                    <li>
                        Quality of food will drop because chefs will lose focus trying to prepare too many menu items.
                    </li>
                    <li>
                        Customers become overwhelmed with too many menu items.
                    </li>
                    <li>
                        Too many recipes and inventory items that can end up as an overabundance of expired items which would be a waste of money for the restaurant.</li>
                    <li>
                        Quality of food will drop because chefs will lose focus trying to prepare too many menu items.
                    </li>
                </ul>
            </div>
        </div>
        <!-- vission -->
        <div class="syntax-about-mission">
            <div class="syntax-about-heading heading-2">
                <h2>
                    Vision
                </h2>
            </div>
            <div class="vission-content syntax-about-content">
                <p>
                    The success of a restaurant depends on many factors that can heavily affect a business’s success, some of these factors include the location, current popular food trends, customer service, the restaurant’s atmosphere, as well as how good the food is.
                    The last trait, in particular, is an area where many restaurants mess up. They get too comfortable and the next thing you know, their menu becomes outdated and their customers slowly grow tired of it. Now that’s not to say that
                    restaurants should completely forget about the other factors related to their business. Without a great location, you won’t have the consumer base available to keep your business alive, and without good customer service, people
                    will be so turned off that they won’t want to visit your restaurant again.
                </p>
                <ul>
                    <li>
                        Quality of food will drop because chefs will lose focus trying to prepare too many menu items.
                    </li>
                    <li>
                        Customers become overwhelmed with too many menu items.
                    </li>
                    <li>
                        Too many recipes and inventory items that can end up as an overabundance of expired items which would be a waste of money for the restaurant.</li>
                    <li>
                        Quality of food will drop because chefs will lose focus trying to prepare too many menu items.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- ============== syntax-about section end ============= -->

@endsection
@extends('layouts.app')
@section('content')
    <section class="bg-section not-found category">
        <div class="container">
            <header>
                <div class="logo">
                    <a href="#"><img src="{{assets('assets')}}/img/Logo.png" alt=""></a>
                </div>
                <div class="menu">
                    <a href="javascript:void(0)">
                        <span>Menu</span>
                        <span class="close">Close</span>
                        <i class="icon-menu"></i></a>
                </div>
            </header>


            <p class="not-found-head to-hide">
                404
            </p>

            <div class="rtl-container full-width to-hide">
                <div class="rtl right-mrg">
                    <div class="video-container">
                        <video poster="{{assets('assets')}}/img/404.png">
                            <source src="{{assets('assets')}}/img/small.webm">
                        </video>
                        <div class="over-element bg-h">
                            <a href="javascript:void(0)" class="play-icon">
                                <i class="icon-play-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="triangle">
                    <img src="{{assets('assets')}}/img/triangle.png" alt="">
                </div>
            </div>

            <div class="error-content to-hide">
                <p class="main-title-font zigzag">
                    Page not found
                </p>
                <p>
                    Sorry, but the page you were looking for was not found. Try checking the URL for the error, then
                    press
                    the refresh button in your browser or try to find something else in our site.
                </p>
            </div>

            <div class="bg-v to-hide">
                <a href="{{route('index')}}" class="read">BACK TO HOME</a>
                <a href="#" class="see">YOU WILL BE REDIRECTED</a>
            </div>

            <div class="menu-content category">
                <div class="container">
                    <ul>
                        <li>
                            <a href="javascript:void(0)" class="before-dot">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                Channels
                            </a>
                            <div class="item-channel">
                                <a href="#"><img src="{{assets('assets')}}/img/Fel90.png" alt=""></a>
                                <a href="#"><img src="{{assets('assets')}}/img/Ahadon%20Ahad.png" alt=""></a>
                                <a href="#"><img src="{{assets('assets')}}/img/w%20laken%20zorafa2.png" alt=""></a>
                                <a href="#"><img src="{{assets('assets')}}/img/seret%20Zayed.png" alt=""></a>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                About
                            </a>
                        </li>
                    </ul>
                    <div class="social-icons">
                        <ul>
                            <li>
                                <a href="#">
                                    FACEBOOK
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    TWITTER
                                </a>
                            </li>
                            <li>

                                <a href="#">
                                    YOUTUBE
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="bg-v">
                        <a href="#" class="main-title-font">contact info</a>
                        <a href="#" class="">Abu Dhabi, UAE, 2454</a>
                        <a href="#" class="">+971 569888100</a>

                        <a href="#" class="">info@dotinsider.com</a>
                    </div>

                </div>
                <div class="bg-group-menu">
                    <img src="{{assets('assets')}}/img/Elements-Group-2.png" alt="">
                </div>
                <div class="bg-triangle-up">
                    <img src="{{assets('assets')}}/img/Elements-Triangle-2.png" alt="">
                </div>
            </div>


        </div>
        <div class="bg-circle">
            <img src="{{assets('assets')}}/img/Elements-Circle.png" alt="">
        </div>
        <div class="bg-cuboid">
            <img src="{{assets('assets')}}/img/Elements-Cuboid.png" alt="">
        </div>
        <div class="bg-group">
            <img src="{{assets('assets')}}/img/absoluteGroup.png" alt="">
        </div>
    </section>
    <script>
        var counter = 5;
        setInterval(function () {
            c = -- counter;
            if(c < 1){
                window.location.href = '{{route('index')}}';
                return;
            }
        }, 1000);
    </script>
@endsection
@section('footer')
@endsection


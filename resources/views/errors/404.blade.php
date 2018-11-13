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
                        <span>القائمة</span>
                        <span class="close">اغلاق</span>
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
                    </div>
                </div>
                <div class="triangle">
                    <img src="{{assets('assets')}}/img/triangle.png" alt="">
                </div>
            </div>

            <div class="error-content to-hide">
                <p class="main-title-font zigzag">
                    الصفحة غير موجودة
                </p>
                <p>
                    عذرا ، ولكن الصفحة التي كنت تبحث عنها لم يتم العثور عليها. حاول التحقق من URL للخطأ ، ثم اضغط على زر
                    التحديث في المتصفح الخاص بك أو حاول العثور على شيء آخر في موقعنا .
                </p>
            </div>

            <div class="bg-v to-hide">
                <a href="{{route('index')}}" class="read">العودة الي الرئيسية</a>
                <a href="#" class="see">سيتم تحويلك</a>
            </div>

            <div class="menu-content category">
                <div class="container">
                    <ul>
                        <li>
                            <a href="{{route('index')}}" class="before-dot">
                                الرئيسية
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                القنوات
                            </a>
                            <div class="item-channel">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">

                                        @foreach($cats as $cat)
                                            <div class="swiper-slide">
                                                <a href="{{$cat->path}}"><img
                                                            src="{{thumbnail($cat->image->path, 'cat-footer-logo')}}"
                                                            alt="{{$cat->slug}}"></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="{{route('contact-us.form')}}">
                                أتصل بنا
                            </a>
                        </li>
                        <li>
                            <a href="{{route('pages.show', 'about-us')}}">
                                عن dotinsider
                            </a>
                        </li>
                    </ul>
                    <div class="social-icons">
                        <ul>
                            <li>
                                <a href="{{option('facebook_page')}}" target="_blank" >
                                    FACEBOOK
                                </a>
                            </li>
                            <li>
                                <a href="{{option('twitter_page')}}" target="_blank">
                                    TWITTER
                                </a>
                            </li>
                            <li>

                                <a href="{{option('youtube_page')}}" target="_blank">
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


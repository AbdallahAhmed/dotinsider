<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500</title>
    <link rel="stylesheet" href="{{assets('assets')}}/css/reset.css">
    <link rel="stylesheet" href="{{assets('assets')}}/css/swiper.css">
    <link rel="stylesheet" href="{{assets('assets')}}/css/fontello.css">
    <link rel="stylesheet" href="{{assets('assets')}}/css/main.css">
    <script src="{{assets('assets')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{assets('assets')}}/js/swiper.js"></script>
    <script src="{{assets('assets')}}/js/main.js"></script>
</head>
<body>
<section class="bg-section not-found category">
    <div class="container">
        <header>
            <div class="logo">
                <a href="#"><img src="{{assets('assets')}}/img/Logo.png" alt=""></a>
            </div>
            <!--<div class="menu">-->
            <!--<a href="javascript:void(0)">-->
            <!--<span>Menu</span>-->
            <!--<span class="close">Close</span>-->
            <!--<i class="icon-menu"></i></a>-->
            <!--</div>-->
        </header>

        <p class="not-found-head to-hide">
            500
        </p>

        <div class="rtl-container full-width to-hide">
            <div class="rtl right-mrg">
                <div class="video-container">
                    <video poster="{{assets('assets')}}/img/500.png">
                        <source>
                    </video>

                </div>
            </div>
            <div class="triangle">
                <img src="{{assets('assets')}}/img/triangle.png" alt="">
            </div>
        </div>

        <div class="error-content to-hide">
            <p class="main-title-font zigzag">
                خطأ في النظام الداخلي
            </p>
            <p>
                لقد الخادم شيء غير متوقع لم يسمح  بإتمام الطلب. ونحن نعتذر .
            </p>
        </div>

        <div class="bg-v to-hide">
            <!--<a href="#" class="read"></a>-->
            <!--<a href="#" class="see"></a>-->
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

</body>
</html>
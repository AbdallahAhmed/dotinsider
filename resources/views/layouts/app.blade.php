<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" prefix="og: http://ogp.me/ns#">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="{{option('site_robots')}}">
    <meta name="copyright" content="3altayeer">
    <meta name="language" content="{{app()->getLocale()}}">
    @section('meta')
        <meta name="title" content="<?=  option('site_title')?>">
        <meta name="description" content="<?= str_limit(option('site_description'), 150)?>">
        <meta name="keywords" content="<?=option('site_keywords')?>">
        <meta name="author" content="<?=option('site_author')?>">
        <meta property="og:locale" content="{{app()->getLocale()}}"/>
        <meta property="og:title" content="<?=  option('site_title')?>"/>
        <meta property="og:site_name" content="{{option('site_name')}}"/>
        <meta property="og:description" content="<?= str_limit(option('site_description'), 150)?>">
        <meta property="og:image" content="{{asset('assets')}}/images/Vector-Smart-Object.png">
        <meta name="twitter:title" content="<?= option('site_title')?>">
        <meta name="twitter:description" content="<?= str_limit(option('site_description'), 150)?>">
        <meta name="twitter:image" content="{{asset('assets')}}/images/Vector-Smart-Object.png">
        <meta name="twitter:url" content="{{asset('/')}}">
    @show
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="icon" type="image/png" href="{{asset('assets')}}/img/Dotinsider.png">

    <title> @yield("title")</title>
    <script>
        window.trans = {};
        window.lang = "{{app()->getLocale()}}";
        window.searchUrl = "{{asset(app()->getLocale().'/search')}}";
    </script>

    <link rel="stylesheet" href="{{asset('assets')}}/css/reset.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/swiper.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/fontello.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="{{asset('assets')}}/css/main.css">--}}
    <link rel="stylesheet" href="{{asset('assets')}}/css/arbic_style.css">
    <link rel="stylesheet" href="{{asset('')}}css/common.css">
    {{--<script src="{{asset('assets')}}/js/jquery-3.3.1.min.js"></script>--}}
    <script
            src="https://code.jquery.com/jquery-1.8.2.min.js"
            integrity="sha256-9VTS8JJyxvcUR+v+RTLTsd0ZWbzmafmlzMmeZO9RFyk="
            crossorigin="anonymous"></script>
    <script src="{{asset('assets')}}/js/swiper.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="{{asset('assets')}}/js/main.js"></script>
    <script src="{{asset('')}}/js/common.js"></script>
    <script data-pace-options='{ "ajax": false }' src="{{asset('')}}/js/pace.js"></script>
    <script>
        Pace.once('start', function () {
            document.getElementById('wrapper-body').style.opacity = "0";
        })

        Pace.once('hide', function () {
            document.getElementById('wrapper-body').style.opacity = 1;
            document.getElementById('progress-bar').style.display = "none";
            document.getElementsByClassName('loading-page')[0].style.display = "none";
            document.getElementById('body').style.height = "auto";
        })
    </script>
    @stack('head')
</head>
<body id="body" style="overflow: hidden;height: 100vh">
<div id="progress-bar">
</div>
<div class="loading-page bg-section">
    <div class="logo">
        <img src="../assets/img/Logo11.png" alt="#">
    </div>
    <div class="loading-icon">
        <div class="loading-active"></div>
    </div>
    <span id="percentage">0%</span>

    <div class="bg-group-triangle">
        <img src="../assets/img/triangle.png" alt="">

    </div>
    <div class="bg-circle">
        <img src="../assets/img/Elements-Circle.png" alt="">
    </div>
    <div class="bg-cuboid">
        <img src="../assets/img/Elements-Cuboid.png" alt="">
    </div>
    <div class="bg-group">
        <img src="../assets/img/absoluteGroup.png" alt="">
    </div>
</div>
<section class="bg-section section-padding video-details popup" id="popframe" style="display: none">
    <div class="container">
        <div class="rtl-container full-width">
            <div class="rtl right-mrg">
                <div class="video-container" id="video-container">
                    <video  poster="" id="video" src="">
                        <!--<source src="img/small.webm">-->
                    </video>
                    <div class="over-element bg-h">
                        <a href="javascript:void(0)" class="play-icon">
                            <i class="icon-play-icon"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="back-home">
                <a href="">
                    EXPLORE NOW
                    <i class="icon-arrow-right"></i>
                </a>
            </div>

        </div>

        <div class="details-container">
            <div class="back-home">
                <a href="javascript: window.parent.closePopup()" class="close-popup">
                    BACK TO HOME
                    <i class="icon-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-circle">
        <img src="img/Elements-Circle.png" alt="">
    </div>
    <div class="bg-cuboid">
        <img src="img/Elements-Cuboid.png" alt="">
    </div>
</section>
<div id="wrapper-body" style="opacity: 0;">
    @yield('content')
    @section('footer')
        @include('layouts.partials.footer')
    @show
</div>
</body>
@stack('scripts')
</html>
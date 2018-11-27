@extends('layouts.app')
@section('title','Dotinsider')
@section('content')
    <section class="bg-section category home">
        <div class="container">
            @include('layouts.partials.header')
            <div class="slider-2 to-hide">

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($cats as $cat)
                            <div class="swiper-slide" data-id="{{$cat->id}}">
                                <a href="{{ route('category.show', ['slug' => $cat->slug]) }}"><img
                                            src="{{thumbnail($cat->image->path, 'cat-footer-logo')}}" alt=""></a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev">
                        <i class="icon-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="icon-arrow-right"></i>
                    </div>
                </div>
            </div>

            <div class="slider-1 rtl-container rtl right-mrg to-hide">
                <div class="swiper-container video-container" dir="ltr">
                    <div class="swiper-wrapper" id="cat-slider">
                        @foreach($posts_slider as $post)
                            <div class="swiper-slide" data-url="{{$post->category->path}}">
                                <div class="slide-content">
                                    <img src="{{thumbnail($post->image->path, 'main-slider')}}">
                                    <div class="over-element bg-h">
                                        <a href="javascript:void(0)" class="open"
                                           data-poster="{{thumbnail($post->image->path, 'video-details')}}"
                                           data-link="{{$post->media->path}}">
                                            <i class="icon-play-icon"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="channel to-hide">
                                    <div class="text">
                                        <p class="main-title-font zigzag">{{$post->category->name}}</p>
                                        <p class="description">{{$post->title}}</p>
                                        <div class="social" data-youtube="{{$post->media->path}}"
                                             data-url="{{$post->path}}"
                                             data-title="{!! $post->title !!}">
                                            <a href="javascript:void(0)" class="shareBtn facebook">FACEBOOK</a>
                                            <a href="javascript:void(0)" class="shareBtn twitter">TWITTER</a>
                                            <a href="javascript:void(0)" class="shareBtn youtube">YOUTUBE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="triangle">
                    <img src="{{assets('assets')}}/img/triangle.png" alt="">
                </div>
                <div class="swiper-button-prev">
                    <i class="icon-arrow-left"></i>
                </div>
                <div class="swiper-button-next">
                    <i class="icon-arrow-right"></i>
                </div>

            </div>
            <div class="bg-v to-hide">
                <a href="{{route('categories')}}" class="read">كل القنوات</a>
                <a href="{{$posts_slider ? $posts_slider[0]->category->path : '#'}}" class="see" id="read-more">انتقل
                    للأسفل </a>
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
        </div>
    </section>
    <section class="section-padding">
        <div class="container">
            <p class="title-section main-title-font black-color zigzag title-video">أخر الفيديوهات</p>
            <div class="cards">
                @include('extensions.index-videos', ['posts'=>$main_posts])
                <div class="insert-more" style="display: none;"></div>
            </div>
            @if(count($main_posts) == 12)
                <div class="more">
                    <a href="javascript:void(0)" class="btn-more">المزيد <i class="icon-arrow-down"></i></a>
                </div>
            @endif
        </div>
    </section>

    @include('extensions.subscribe')

    @push('scripts')
        <script>
            $(function () {
                var catCount = "{{count($cats) >= 4 ? 4 :count($cats)  }}";
                var mySwiper = new Swiper('.home .slider-2 .swiper-container', {
                    speed: 400,
                    loop: true,
                    slidesPerView: catCount,
                    slideToClickedSlide: false,
                    /*autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },*/
                    navigation: {
                        nextEl: '.slider-2 .swiper-button-next',
                        prevEl: '.slider-2 .swiper-button-prev',
                    },
                    breakpoints: {
                        1024: {
                            slidesPerView: catCount,
                        },
                        786: {
                            slidesPerView: catCount,
                            navigation: {
                                nextEl: null,
                                prevEl: null
                            }
                        },
                    },
                });
                /*
                 document.querySelector('.slider-1 .swiper-container').swiper.on('slideChange', function () {
                     $('#read-more').attr('href', $('#cat-slider').find('.swiper-slide-active').data('url'));
                 });
                 mySwiper.on('slideChange', function () {
                     var id = $('.slider-2').find('.swiper-slide-active').data('id');
                     $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                     });
                     $.ajax({
                         type: "post",
                         url: "{{route('category.posts')}}",
                        data: {category_id: id},
                        success: function (data) {
                            destroy = document.querySelector('.slider-1 .swiper-container').swiper;
                            destroy.destroy();
                            $('#cat-slider').html(data.view)
                            var videoSwiper = new Swiper('.slider-1 .swiper-container', {
                                speed: 400,
                                autoplay: {
                                    delay: 5000,
                                    disableOnInteraction: false
                                },
                                navigation: {
                                    nextEl: '.slider-1 .swiper-button-next',
                                    prevEl: '.slider-1 .swiper-button-prev',
                                },
                            });
                            readURL = $('#cat-slider').find('.swiper-slide-active').data('url');
                            $('#read-more').attr('href', readURL);
                            videoSwiper.on('slideChange', function () {
                                $('#read-more').attr('href', readURL);
                            });
                        }
                    })
                });
                */
                offset = 12
                $('.btn-more').on('click', function (e) {
                    e.preventDefault();
                    $('.more').hide()
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "get",
                        url: "{{route('index')}}",
                        data: {'offset': offset, 'limit': 12},
                        async: false,
                        success: function (data) {
                            if (data.count > 0) {
                                $(data.view).insertBefore('.insert-more');
                                $('.card').each(function () {
                                    if ($(this).isInViewport()) {
                                        $(this).css({
                                            opacity: '1',
                                            transform: 'translateY(-10px)'
                                        });
                                    }
                                });
                                offset += data.count;
                            }
                            if (data.count < 12)
                                $('.more').remove();
                            else
                                $('.more').show()
                        }
                    })
                });
            })
        </script>
    @endpush
@endsection
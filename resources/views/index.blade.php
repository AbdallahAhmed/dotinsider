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
                                <a href="javascript:void(0)"><img
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
                                <img src="{{thumbnail($post->image->path, 'main-slider')}}">
                                <div class="over-element bg-h">
                                    <a href="javascript:void(0)" class="open"
                                       data-poster="{{thumbnail($post->image->path, 'video-details')}}"
                                       data-link="{{$post->media->path}}">
                                        <i class="icon-play-icon"></i>
                                    </a>
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
            <div class="channel to-hide">
                <div class="text">
                    <p class="main-title-font zigzag">FEL 90</p>
                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                        laborum.</p>
                    <div class="social">
                        <a href="{{option('facebook_page')}}" target="_blank">FACEBOOK</a>
                        <a href="{{option('twitter_page')}}" target="_blank">TWITTER</a>
                        <a href="{{option('youtube_page')}}" target="_blank">YOUTUBE</a>
                    </div>
                </div>
            </div>
            <div class="bg-v to-hide">
                <a href="{{route('categories')}}" class="read">SEE ALL</a>
                <a href="{{$posts_slider ? $posts_slider[0]->category->path : '#'}}" class="see" id="read-more">READ MORE</a>
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
    <section class="section-padding">
        <div class="container">
            <p class="title-section main-title-font black-color zigzag title-video">Latest Videos</p>
            <div class="cards">
                @include('extensions.index-videos', ['posts'=>$main_posts])
                <div class="insert-more" style="display: none;"></div>
            </div>
            @if(count($main_posts) == 12)
                <div class="more">
                    <a href="javascript:void(0)" class="btn-more">MORE <i class="icon-arrow-down"></i></a>
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
                    slideToClickedSlide: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
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
                document.querySelector('.slider-1 .swiper-container').swiper.on('slideChange', function () {
                    $('#read-more').attr('href',$('#cat-slider').find('.swiper-slide-active').data('url') );
                });
                mySwiper.on('slideChange',  function () {
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
                            $('#cat-slider').html(data.view)
                            destroy = document.querySelector('.slider-1 .swiper-container').swiper;
                            destroy.destroy();
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
                                $(data.view).hide().insertBefore('.insert-more').fadeIn(800);
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
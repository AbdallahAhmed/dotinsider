@extends('layouts.app')
@section('title','Dotinsider | '.$category->name)
@section('content')
    <section class="bg-section category">
        <div class="container">
            @include('layouts.partials.header')
            <div class="channel to-hide">
                <div class="image">
                    <img src="{{thumbnail($category->image->path, 'cat-footer-logo')}}" alt="">
                </div>
                <div class="text">
                    <p class="main-title-font zigzag">{{$category->name}}</p>
                    <p class="description">{{$category->excerpt}}</p>
                    <div class="social">
                        <a href="{{option('facebook_page')}}" target="_blank">FACEBOOK</a>
                        <a href="{{option('twitter_page')}}" target="_blank">TWITTER</a>
                        <a href="{{option('youtube_page')}}" target="_blank">YOUTUBE</a>
                    </div>
                </div>
            </div>
            <div class="slider-1 rtl-container rtl right-mrg to-hide">
                <div class="swiper-container video-container" dir="ltr">
                    <div class="swiper-wrapper" id="cat-slider">
                        @foreach($slider_posts as $slider)
                            <div class="swiper-slide">
                                <img src="{{thumbnail($slider->image->path, 'main-slider')}}">
                                <div class="over-element bg-h">
                                    <a href="javascript:void(0)" class="open"
                                       data-poster="{{thumbnail($slider->image->path, 'video-details')}}"
                                       data-link="{{$slider->media->path}}">
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
            <div class="slider-2 cat-slider to-hide">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($seasons as $season)
                            <div class="swiper-slide">
                                <a href="javascript:void(0)" data-id="{{$season->id}}"
                                   class="main-title-font season-click">{{$season->name}}</a>
                                <p>{{$season->count}} Episodes</p>
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
            <div class="bg-v to-hide">
                <a href="#" class="read">READ MORE</a>
                <a href="#" class="see">SEE ALL</a>
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
                @include('extensions.index-videos', ['posts', $posts])
                <div class="insert-more" style="display: none;"></div>
            </div>
            @if(count($posts) == 12)
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
                offset = 12
                $('.btn-more').on('click', function (e) {
                    e.preventDefault();
                    // $('.more').hide()
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "get",
                        url: "{{route('category.show', $category->slug)}}",
                        data: {'offset': offset, 'limit': 12},
                        async: false,
                        success: function (data) {
                            if (data.count > 0) {
                                $(data.view).insertBefore('.insert-more');
                                offset += data.count;
                            }
                            $('.more').show()
                        }
                    })
                });
                $('.season-click').on('click', function (e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "{{route('season.posts')}}",
                        data: {season_id: $(this).data('id')},
                        success: function (data) {
                            $('#cat-slider').html(data.view)
                            var mySwiper = new Swiper('.slider-1 .swiper-container', {
                                speed: 400,
                                navigation: {
                                    nextEl: '.slider-1 .swiper-button-next',
                                    prevEl: '.slider-1 .swiper-button-prev',
                                },
                            });

                           // $('.cards').hide().html(data.view).show(500);
                        }
                    })
                })
            })

        </script>
    @endpush

@endsection
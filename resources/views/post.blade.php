@extends('layouts.app')
@section('meta')
    @include('extensions.meta',['post'=>$post])
@endsection
@section('title','Dotinsider | '.$post->title)
@section('content')
    <section class="bg-section video-details">
        <div class="container">
            @include('layouts.partials.header')
            <div class="rtl-container full-width to-hide">
                <div class="rtl right-mrg">
                    <div class="video-container">
                        <img src="{{thumbnail($post->image->path, 'video-details')}}">
                        <div class="over-element bg-h">
                            <a href="javascript:void(0)" class="open" data-poster="{{thumbnail($post->image->path, 'video-details')}}" data-link="{{$post->media->path}}">
                                <i class="icon-play-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="back-home" id="scroll">
                    <a href="javascript:void(0)">
                        EXPLORE NOW
                        <i class="icon-arrow-right"></i>
                    </a>
                </div>

            </div>
            <div class="details-container to-hide mb-126">
                <a href="{{$post->category->path}}" class="image"><img src="{{assets('assets')}}/img/in-90.png" alt=""></a>
                <a href="javascript:void(0)" class="title">
                   {{$post->title}}
                </a>
                <div class="back-home">
                    <a href="{{route('index')}}">
                        BACK TO HOME
                        <i class="icon-arrow-left"></i>

                    </a>
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
    <section class="section-padding">
        <div class="container">
            <p class="title-section main-title-font title-video black-color zigzag">Related Videos</p>
            <div class="cards">
               @include('extensions.index-videos', ['posts' => $related_posts])
                <div class="insert-more" style="display: none;"></div>
            </div>
            @if(count($related_posts) == 12)
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
                    $('.more').hide()
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "get",
                        url: "{{route('posts.show', $post->slug)}}",
                        data: {'offset': offset, 'limit': 12},
                        async: false,
                        success: function (data) {
                            if (data.count > 0) {
                                $(data.view).insertBefore('.insert-more')
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
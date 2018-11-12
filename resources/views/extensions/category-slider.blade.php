@foreach($posts as $post)
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
                <div class="social" data-youtube="{{$post->media->path}}" data-url="{{$post->path}}"
                     data-title="{!! $post->title !!}">
                    <a href="javascript:void(0)" class="shareBtn facebook">FACEBOOK</a>
                    <a href="javascript:void(0)" class="shareBtn twitter">TWITTER</a>
                    <a href="javascript:void(0)" class="shareBtn youtube">YOUTUBE</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
@foreach($posts as $post)
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
@foreach($posts as $post)
    <div class="swiper-slide">
        <img src="{{thumbnail($post->image->path, 'main-slider')}}">
        <div class="over-element bg-h">
            <a href="javascript:void(0)" class="open" data-link="_video-popup.html">
                <i class="icon-play-icon"></i>
            </a>
        </div>
    </div>
@endforeach
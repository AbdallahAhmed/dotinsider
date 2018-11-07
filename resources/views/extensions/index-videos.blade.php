@foreach($posts as $post)
    <div class="card">
        <div class="img-card">
            <a href="{{$post->path}}" class=""><img
                        src="{{thumbnail($post->image->path, 'main')}}" alt="{{$post->slug}}"></a>
            <a href="{{$post->category->path}}" class="channel-card"><img src="{{thumbnail($post->category->image->path, 'cat-logo')}}" alt="{{$post->category->name}}"></a>
            <div class="hover-card bg-hr ">
                <div class="social-icon" data-youtube="{{$post->media->path}}" data-url="{{$post->path}}"
                     data-title="{!! $post->title !!}">
                    <a href="javascript:void(0)"><i class="icon-twitter twitter shareBtn"></i></a>
                    <a href="javascript:void(0)"><i class="icon-facebook-official facebook shareBtn"></i></a>
                    <a href="javascript:void(0)"><i class="icon-youtube-play shareBtn youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="title-card clearfix">
            <a href="{{$post->path}}" class="">
                <i class="icon-play-icon"></i>
            </a>
            <p class="text-title second-title-font black-color d-inline-block">
               {!! $post->title !!}
            </p>
        </div>
    </div>
@endforeach

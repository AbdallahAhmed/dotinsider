@extends('layouts.app')
@section('title','Dotinsider | '. $page->title)
@section('content')
    <section class="bg-section about">
        <div class="container">
            @include('layouts.partials.header')
            <div class="about-us to-hide">
                <div>
                    <div class="width-25">
                        <p class="zigzag main-title-font">{{$page->title}}</p>
                    </div>
                    <div class="width-75">
                        <p class="main-title-font smaller">
                            {{$page->excerpt}}
                        </p>
                        <span>
                            {{ strip_tags($page->content)}}
                        </span>

                        <div class="channels-logo">
                            <?php $i = 1;?>
                            @foreach($cats as $cat)
                                <a href="javascript:void(0)" id="channel{{$i}}" @if($i == 1)class="active"@endif>
                                    <img src="{{thumbnail($cat->image->path, 'cat-footer-logo')}}" alt="">
                                </a>
                                <?php $i++;?>
                            @endforeach
                        </div>

                        <div class="related-to-channel">
                            <?php $i = 1;?>
                            @foreach($cats as $cat)
                                <div data-index="channel{{$i}}">
                                    <p class="main-title-font zigzag smaller">
                                        {{$cat->name}}
                                    </p>
                                    <p>
                                        {{$cat->excerpt}}
                                    </p>
                                    <ul class="social-icons">
                                        <li><a href="#" target="_blank">FACEBOOK</a></li>
                                        <li><a href="#" target="_blank">TWITTER</a></li>
                                        <li><a href="#" target="_blank">YOUTUBE</a></li>
                                    </ul>
                                </div>
                                <?php $i++;?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-circle">
            <img src="{{assets('assets')}}/img/Elements-Circle.png" alt="">
        </div>
        <div class="bg-cuboid">
            <img src="{{assets('assets')}}/img/Elements-Cuboid.png" alt="">
        </div>
        <div class="bg-triangle-up">
            <img src="{{assets('assets')}}/img/Elements-Triangle-2.png" alt="">
        </div>
        <div class="bg-group">
            <img src="{{assets('assets')}}/img/absoluteGroup.png" alt="">
        </div>
    </section>
@endsection
@section('footer')
@endsection

<section class="footer-channel">
    <div class="container">
        <div class="logo">
            <a href="{{route('index')}}"><img src="{{asset('assets')}}/img/LogoText.png" alt="dotinsider"></a>
        </div>
        <div class="channels-logo">
            @foreach($cats as $cat)
                <a href="{{$cat->path}}"><img src="{{thumbnail($cat->image->path, 'cat-footer-logo')}}"
                                              alt="{{$cat->slug}}"></a>
            @endforeach
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="">
            <p>Design and Code by dotdev</p>
        </div>
        <div class="">
            <ul>
                @foreach($nav2 as $nav)
                    <li><a href="{{nav_url($nav)}}">{{$nav->name}}</a></li>
                @endforeach
                <li><a href="{{route('contact-us.form')}}">أتصل بنا</a></li>
            </ul>
        </div>

        <div class="">
            @foreach($nav1 as $nav)
                <a href="{{nav_url($nav)}}">{{$nav->name}}</a>
            @endforeach
        </div>
    </div>
</footer>
<header>
    <div class="logo">
        <a href="{{route('index')}}"><img src="{{assets('assets')}}/img/Logo.png" alt="dotinsider"></a>
    </div>
    <div class="menu">
        <a href="javascript:void(0)">
            <span>Menu</span>
            <span class="close">Close</span>
            <i class="icon-menu"></i></a>
    </div>
</header>
<div class="menu-content category">
    <div class="container">
        <ul>
            <li>
                <a href="{{route('index')}}" class="before-dot">
                    Home
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    Channels
                </a>
                <div class="item-channel">
                    @foreach($cats as $cat)
                        <a href="{{$cat->path}}"><img src="{{thumbnail($cat->image->path, 'cat-footer-logo')}}" alt="{{$cat->slug}}"></a>
                    @endforeach
                </div>
            </li>
            <li>
                <a href="{{route('contact-us.form')}}">
                    Contact Us
                </a>
            </li>
            <li>
                <a href="{{route('pages.show', 'about-us')}}">
                    About
                </a>
            </li>
        </ul>
        <div class="social-icons">
            <ul>
                <li>
                    <a href="{{option('facebook_page')}}">
                        FACEBOOK
                    </a>
                </li>
                <li>
                    <a href="{{option('twitter_page')}}">
                        TWITTER
                    </a>
                </li>
                <li>

                    <a href="{{option('youtube_page')}}">
                        YOUTUBE
                    </a>
                </li>
            </ul>

        </div>
        <div class="bg-v">
            <a href="#" class="main-title-font">contact info</a>
            <a href="#" class="">Abu Dhabi, UAE, 2454</a>
            <a href="#" class="">+971 569888100</a>

            <a href="#" class="">info@dotinsider.com</a>
        </div>

    </div>
    <div class="bg-group-menu">
        <img src="{{assets('assets')}}/img/Elements-Group-2.png" alt="">
    </div>
    <div class="bg-triangle-up">
        <img src="{{assets('assets')}}/img/Elements-Triangle-2.png" alt="">
    </div>
</div>
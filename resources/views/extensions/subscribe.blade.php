<section class="bg-section subscribe section-padding">
    <div class="bg-h">
        <div class="bg-group">
            <img src="{{assets('assets')}}/img/absoluteGroup.png" alt="">
        </div>
    </div>
    <div class="bg-v">
    </div>
    <div class="container">
        <div class="images">
            {{--<img src="{{assets('assets')}}/img/iphones.png" alt="">--}}
            <div class="slider-subscribe rtl-container">
                <div class="swiper-container " dir="rtl">
                    <div class="swiper-wrapper ">
                        @foreach($slider->files as $file)
                        <div class="swiper-slide">
                            <img src="{{ thumbnail($file->path , 'slider') }}" alt="{{ $file->title }}">
                        </div>
                        @endforeach
                        {{--<div class="swiper-slide">--}}
                            {{--<img src="{{ assets('assets')}}/img/iphones.png" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide">--}}
                            {{--<img src="{{ assets('assets')}}/img/iphones.png" alt="">--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <div class="triangle">
                <img src="{{assets('assets')}}/img/triangle.png" alt="">
            </div>

        </div>
        <div class="text-container">
            <div class="text">
                <p class="main-title-font zigzag">dot<span>insider</span> is a must follow.</p>
                <p>Get the stories that matter most, delivered directly to your social feeds. We’ve built a powerful
                    video
                    news network specifically for the new mobile first generation.</p>
                <form class="d-none" action="">
                    <input id="email" type="email" placeholder="email">
                    <button id="s-button"><i class="icon-right-thin"></i></button>
                </form>
                <p style="display: none" class="message"></p>
                <div class="social">
                    <a href="#" class="active-link">Facebook</a>
                    <a href="#">Twitter</a>
                    <a href="#">Youtube</a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-cuboid-subscribe">
        <img src="{{assets('assets')}}/img/Elements-Cuboid.png" alt="">
    </div>
    <div class="bg-group-subscribe">
        <img src="{{assets('assets')}}/img/Elements-Group-2.png" alt="">
    </div>
</section>

@push('scripts')
    <script>
        $(function () {
            $('.d-none').submit(function (e) {
                e.preventDefault();
                $("#s-button").fadeOut(200);
                let email = $('#email').val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('subscribe')}}',
                    type: 'POST',
                    data: {
                        email: email
                    }
                }).done(function (json) {
                    $("#s-button").fadeIn(200);
                    if (json.status) {
                        //
                        $('#email').val('')
                        $('.d-none').remove();
                        $('.message').html("Subscribed Successfully!");
                        $('.message').css('display', 'block')
                        $('.message').fadeOut(3000);
                    } else {
                        $('.message').css('display', 'block')
                        for (let error of json.errors)
                            $('.message').html(error);
                    }
                })
                /*.fail(function (xhr, status, errorThrown) {
                                    alert('alert their error in request');
                                });*/
                return false;
            });

            var subscribe = new Swiper('.slider-subscribe .swiper-container', {
                speed: 400,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.slider-1 .swiper-button-next',
                    prevEl: '.slider-1 .swiper-button-prev',
                },
            });
            subscribe.on('slideChange',() =>{
                var children = $('.subscribe .social').children();
                children.removeClass('active-link');
                $(children[subscribe.activeIndex]).addClass('active-link')

            });

        })

    </script>
@endpush
$(document).ready(function () {
    $('.play-icon').click(function (e) {
        player.pauseVideo();
        state = player.getPlayerState();
        if(state == 2){
            player.playVideo()
            $(this).find('i').addClass('icon-pause-icon')
        }else if(state == 1){
            player.pauseVideo();
            $(this).find('i').removeClass('icon-pause-icon')
        }
        //$(this).find('i').addClass('icon-pause-icon')
        /*var video = $(this).parents('.video-container').find('video');
        if (video[0].paused) {
            video[0].play();
            $(this).find('i').addClass('icon-pause-icon')
        }
        else {
            video[0].pause();
            $(this).find('i').removeClass('icon-pause-icon')
        }
        video.on('ended', function () {
            console.log($(this))
            $(this).parent().find('i').removeClass('icon-pause-icon')
        });*/
    });

    var mySwiper = new Swiper('.item-channel .swiper-container', {
        observeParents: true,
        observer: true,
        speed: 400,
        loop: true,
        slidesPerView: 4,
        slideToClickedSlide: true,
        direction: 'vertical',
        breakpoints: {
            786: {
                slidesPerView: 4,
                direction: 'horizontal'
            },
        }
    });

    var mySwiper = new Swiper('.slider-1 .swiper-container', {
        speed: 400,
        navigation: {
            nextEl: '.slider-1 .swiper-button-next',
            prevEl: '.slider-1 .swiper-button-prev',
        },
    });
    var mySwiper = new Swiper('.cat-slider .swiper-container', {
        speed: 400,
        slidesPerView: 4,
        slideToClickedSlide: true,
        navigation: {
            nextEl: '.slider-2 .swiper-button-next',
            prevEl: '.slider-2 .swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 3,
            },
            786: {
                slidesPerView: 2.4,
                navigation: {
                    nextEl: null,
                    prevEl: null
                }
            },
            320: {
                slidesPerView: 2,
            }
        }
    });
   /* var mySwiper = new Swiper('.home .slider-2 .swiper-container', {
        speed: 400,
        loop: true,
        slidesPerView: 4,
        slideToClickedSlide: true,
        navigation: {
            nextEl: '.slider-2 .swiper-button-next',
            prevEl: '.slider-2 .swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 3,
            },
            786: {
                slidesPerView: 4,
                navigation: {
                    nextEl: null,
                    prevEl: null
                }
            },
        }
    });*/


    $('.open-popup').click(function () {
        let link = $(this).data('link');
        Window.top = $(document).scrollTop();

        $('section, footer').hide();

        $('body').append('<iframe id="popup" src="_video-popup.html" frameborder="0"></iframe></div>');
        document.getElementById('popup').onload = function () {
            var iframe = this.contentDocument || this.contentWindow.document;
            var video = iframe.getElementById('video');
            video.src = link;
        }
    });

    $(document).on('click', '.open', function () {
        Window.top = $(document).scrollTop();
        let link = $(this).data('link');
        $('#video').attr('src', link);
        $('#video').attr('poster', $(this).data('poster'));
        $('#wrapper-body').hide(200);
        $('#popframe').show(400)
        var div = $('#video-container');
        var height = div.height();
        var width = div.width();
        var vid = link.split('embed/')[1];
        $('#video-container').find('i').addClass('icon-pause-icon')
        player = new YT.Player('video', {
            height: height,
            width: width,
            videoId: vid,
            playerVars: {
                'autoplay': 1,
                'controls': 0,
                'rel': 0
            },
        })
    })


    $('.channels-logo a').click(function (e) {
        $('.channels-logo > a').removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('id');
        $('.related-to-channel > div').css('display', 'none');
        $('.related-to-channel').find('div[data-index=\"' + id + '\"]').css('display', 'block');
    });

    $('.menu-content li a').click(function (e) {
        $('.menu-content a').removeClass('before-dot');
        $(this).addClass('before-dot');
        $('.item-channel').css('display', 'none');
        if($(window).width() < 768) {
            $(this).parent().find('.item-channel').css('display', 'block');

        }
        else {
            $(this).parent().find('.item-channel').css('display', 'flex');
        }
    });

    $('header .menu a').click(function () {
        $('.to-hide').toggle();
        $('.menu-content').toggle();
        $(this).find('span').toggle();
    })
    //validation-contact
    $('#contact-form').submit(function (e) {

        e.preventDefault()
        $('input ,textarea').each(function (index, el) {
            var dataLenghth = $(el).val().length;
            var minCharacters = $(el).attr('min-characters');
            var maxCharacters = $(el).attr('max-characters');
            console.log(dataLenghth)

            if (dataLenghth == 0) {
                $(el).parent().append('<p >Please fill this field</p>')
            }
            else {
                $(el).parent().find('p').remove();
                if (dataLenghth < minCharacters) {
                    if ($(el).parent().hasClass('phone')) {
                        $(el).parent().append('<p >Phone number should be ' + minCharacters + ' number </p>')
                    }
                    else {
                        $(el).parent().append('<p >data sholud be greater than ' + minCharacters + ' </p>')
                    }
                }
                else if (dataLenghth > maxCharacters) {
                    if ($(el).parent().hasClass('phone')) {
                        $(el).parent().append('<p >Phone number should be ' + minCharacters + ' number </p>')
                    }
                    else
                        $(el).parent().append('<p >data sholud be less than ' + maxCharacters + ' </p>')
                }
            }
        })
    })
});

function closePopup() {
    $('#popframe').hide(200)
    $('#wrapper-body').show(400);
    $(document).scrollTop(Window.top);
    $('iframe').remove();
    $('#video-container').prepend('<video src="" poster="" id="video"></video>')
}


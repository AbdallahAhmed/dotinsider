$(function () {

    $("body").on("click", ".shareBtn", function () {

        var base = $(this);

        var $super = base.closest('.social-icon')
        url = $super.data('url');
        title = $super.data('title');

        if (base.hasClass("facebook")) {
            link = "https://www.facebook.com/sharer/sharer.php?u=" + url;
        }

        if (base.hasClass("twitter")) {
            link = "https://twitter.com/intent/tweet?url=" + url + "&via=dotinsider&text=" + title.replace('#', '');
        }

        if(base.hasClass("youtube")){
            link = "https://www.youtube.com/watch?v="+($super.data("youtube")).split("embed/")[1];
            window.open(link,"_blank")
            return false;
        }

        var winWidth = 650;
        var winHeight = 350;
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);

        window.open(link, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);

        return false;

    });
});

function moveTo(e) {
    var t = $(e).offset().top;
    $("html, body").stop().animate({
        scrollTop: t
    }, 2e3, "easeInOutQuart")
}
$(function() {
    var e = 290;
    var t = 240;
    var n = $(window).width() / 2 + e;
    var r = $(window).width() / 2 + t;
    $(".colored-header").css("right", n);
    $(".colored-header-triangle").css("right", r);
    $("ul.right a").bind("click", function(e) {
        var t = $(this);
        $("html, body").stop().animate({
            scrollTop: $(t.attr("href")).offset().top
        }, 2e3, "easeInOutQuart");
        e.preventDefault()
    });
    $(".middle-column a").bind("click", function(e) {
        var t = $(this);
        $("html, body").stop().animate({
            scrollTop: $(t.attr("href")).offset().top
        }, 3e3, "easeInOutQuart");
        e.preventDefault()
    });
    $(".bottom-icon a").bind("click", function(e) {
        var t = $(this);
        $("html, body").stop().animate({
            scrollTop: $(t.attr("href")).offset().top
        }, 3e3, "easeInOutQuart");
        e.preventDefault()
    });
    $(".name a").bind("click", function(e) {
        var t = $(this);
        $("html, body").stop().animate({
            scrollTop: $(t.attr("href")).offset().top
        }, 3e3, "easeInOutQuart");
        e.preventDefault()
    });
    $("#menu-main-menu li a").bind("click", function(e) {
        var t = $(this);
        $("html, body").stop().animate({
            scrollTop: $(t.attr("href")).offset().top
        }, 3e3, "easeInOutQuart");
        e.preventDefault()
    });
    $(".back-to-top a").bind("click", function(e) {
        var t = $(this);
        $("html, body").stop().animate({
            scrollTop: $(t.attr("href")).offset().top
        }, 3e3, "easeInOutQuart");
        e.preventDefault()
    });
});

(function($) {
    $('.menu-mobile-nav a').click(function(event) {
        event.preventDefault();
        $('.mobile-nav-container').toggleClass('active-nav');
    });
    $('.mobile-nav-container').on('click', 'a', function(event) {
        var isHas = $(this).attr('href')[0];
        if (isHas == '#') {
            $('.mobile-nav-container').toggleClass('active-nav');
        }
    });
})(jQuery);
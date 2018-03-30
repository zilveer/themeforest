(function ($) {
    "use strict";
    $.fn.cssticky = function (options) {
        var do_menu = false;
        var defaultVal = {
                offset: 0,
                delay: 10
            },
            obj = $.extend(defaultVal, options);
        this.each(function () {
            var b = $(this);
            b.addClass('cs-sticky');
            b.data({
                'offset-top': obj.offset
            });
            var dosticky = function () {
                var a = $(window).scrollTop();
                if (a > b.data('offset-top')) {
                    b.addClass('fixed');
                    $('body').addClass('cs-stickied');
                } else {
                    b.removeClass('fixed');
                    $('body').removeClass('cs-stickied');
                }
            };
            var scrollTimer = null;
            $(window).bind('scroll', function () {
                if (scrollTimer) {
                    clearTimeout(scrollTimer);
                }
                scrollTimer = setTimeout(dosticky, 10);
            });
            dosticky();
        })
    };
    $(window).bind('load', function () {
        var $mainmenu = $('#menu'),
		offset = $mainmenu.offset().top + $mainmenu.outerHeight();
        $('.sticky-header').cssticky({
            offset: offset,
            delay: 10
        });
    })
}(jQuery));

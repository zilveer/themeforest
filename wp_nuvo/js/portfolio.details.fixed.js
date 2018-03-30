(function($) { "use strict";
jQuery(document).ready(function ($) {
    function cshero_scroll_fixed() {
        /* get elements */
        var main = $('#cs-portfolio-media');
        var item = $('.cs-scroll-fixed');
        var scroll_fixed = $('.cs-scroll-fixed .widget-area');
        var adminbar = $('#wpadminbar');
        var stiky = $('#header-sticky');
        /* get values */
        var document_height = $(document).width();
        var main_height = main.outerHeight();
        var item_height = item.outerHeight(true);

        /* check admin bar */
        var admin_height = 0;
        if (adminbar != undefined) {
            admin_height = adminbar.outerHeight(true);
        }
        /* check stiky */
        var header = 0;

        /* caculator */
        var limit = main_height - item_height;
        var top = limit;

        /* resize windows */
        var old_width = item.width();
        $(window).resize(function () {
            old_width = item.width();
            document_height = $(document).width();
        });
        /* scroll windows */
        $(window).scroll(function () {
        	var main_top = main.offset().top;
            if (stiky != undefined && document_height >= 992) {
                header = stiky.outerHeight(true) + admin_height;
            } else {
                header = admin_height;
            }
            if (main != undefined && item != undefined && document_height > 767) {
                var scroll = $(window).scrollTop();
                var new_top = scroll - main_top;
                if (scroll >= (main_top - header) && main_height > item_height) {
                    if (new_top <= (limit - header)) {
                        scroll_fixed.css({
                            'width': '' + old_width + 'px',
                            'position': 'fixed',
                            'top': '' + header + 'px'
                        });
                    } else {
                        scroll_fixed.css({
                            'width': '' + old_width + 'px',
                            'position': 'absolute',
                            'top': '' + top + 'px'
                        });
                    }
                } else {
                    scroll_fixed.removeAttr('style');
                }
            } else {
                scroll_fixed.removeAttr('style');
            }
        });
    }
    $(window).load(function (e) {
	    if (portfolio.ns != 100) {
	        var container = document.querySelector('.gallery-portfolio');
	        var msnry = new Masonry(container, {});
	    }
	    cshero_scroll_fixed();
    });
});
})(jQuery);

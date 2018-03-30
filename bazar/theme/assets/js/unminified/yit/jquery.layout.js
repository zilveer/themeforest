var YIT_Browser = {

    isTablet: function () {
        var device = jQuery('body').hasClass('responsive') || jQuery('body').hasClass('iPad') || jQuery('body').hasClass('Blakberrytablet') || jQuery('body').hasClass('isAndroidtablet') || jQuery('body').hasClass('isPalm');
        var size = jQuery(window).width() <= 1024 && jQuery(window).width() >= 768;

        return device && size;
    },

    isPhone: function () {
        var device = jQuery('body').hasClass('responsive') || jQuery('body').hasClass('isIphone') || jQuery('body').hasClass('isWindowsphone') || jQuery('body').hasClass('isAndroid') || jQuery('body').hasClass('isBlackberry');
        var size = jQuery(window).width() <= 480 && jQuery(window).width() >= 320;

        return device && size;
    },

    isViewportBetween: function (high, low) {
        if (low == 'undefinied') {
            low = 0;
        }

        if (!low) {
            return jQuery(window).width() < high;
        }
        else {
            return jQuery(window).width() < high && jQuery(window).width() > low;
        }
    },

    isLowResMonitor: function () {
        return jQuery(window).width() < 1200;
    },

    isMobile: function () {
        return this.isTablet() || this.isPhone();
    },


    isIE: function () {
        if (undefined !== jQuery.browser) {
            return jQuery.browser.msie;
        }
    },

    isIE8: function () {
        return this.isIE() && jQuery.browser.version == '8.0';
    },

    isIE9: function () {
        return this.isIE() && jQuery.browser.version == '9.0';
    },

    isIE10: function () {
        return this.isIE() && jQuery.browser.version == '10.0';
    }

};


// sticky footer plugin
(function ($) {
    var footer;

    $.fn.extend({
        stickyFooter: function (options) {
            footer = this;

            positionFooter();

            $(window)
                .on('sticky', positionFooter)
                .scroll(positionFooter)
                .resize(positionFooter);

            function positionFooter() {
                var docHeight = $(document.body).height() - $("#sticky-footer-push").height();

                if (docHeight < $(window).height()) {
                    var diff = $(window).height() - docHeight;
                    if (!$("#sticky-footer-push").length > 0) {
                        $(footer).before('<div id="sticky-footer-push"></div>');
                    }

                    if ($('#wpadminbar').length > 0) {
                        diff -= 28;
                    }
                    $("#sticky-footer-push").height(diff);
                }
            }
        }
    });
})(jQuery);


//Menu
jQuery(document).ready(function ($) {

    $('#nav ul > li').each(function () {
        var $this_item = $(this);
        if ($('ul', this).length > 0) {
            $(this).children('a').append('<span class="sf-sub-indicator"> &raquo;</span>');

            var add_padding;
            (add_padding = function () {
                $this_item.children('a').css('padding-right', '').css({ paddingRight: parseInt($this_item.children('a').css('padding-right')) + 16 });
            })();

            $(window).resize(add_padding);
        }
    });


    $('li.megamenu > div > ul.sub-menu').each(function () {
        $(this).addClass('megamenu-length-' + $(this).children('li').length);
    });

    var show_dropdown = function (event, elem) {
        // For hover state
        if ( ! elem ) { elem = $(this); }

        if ( $('body').hasClass('isMobile') ) {
            var current_visible = $('.sub-menu:visible');
            if (current_visible.length) {
                current_visible.each(function (index, current) {
                    if ( $(current).parent().hasClass('megamenu')) {
                        $(current_visible[ index ]).hide();
                        return false;
                    } else {
                        var parents = elem.parents('.sub-menu');
                        $.each( current_visible, function (i) {
                            if ( !parents[ i ] ) {
                                $(current_visible[ i ]).hide();
                            }
                        });
                    }
                });
            }
        }

        var options = {};
        var containerWidth = $('body').outerWidth(true);
        if(yit.isBoxed) containerWidth = $('#header .container').outerWidth(true);

        var submenu = $('> ul.sub-menu', elem);

        if ( submenu.length > 0 ) {
            var submenuWidth = submenu.outerWidth(true);
            var offsetMenu = elem.position().left + submenuWidth;

            if (offsetMenu >= containerWidth) {
                if (containerWidth >= submenuWidth) {
                    // options.left = ( ( containerWidth - submenuWidth ) / 2 );
                    options.right = 0;
                } else {
                    options.left = ( ( submenuWidth - containerWidth ) / 2 );
                }
            } else if (elem.hasClass('megamenu')) {
                options.left = elem.position().left;
            }

            $('> .sub-menu', elem).css(options).stop(true, true).fadeIn(300);
        }

        return false;
    }

    $(window).resize(show_dropdown);

    var hide_dropdown = function (e, elem) {
        // For hover state
        if ( !elem ) { elem = $(this); }

        if ( !elem.parent().parent().hasClass('megamenu') ) {
            $('> .sub-menu', elem).fadeOut(300);
        }

    }

    if (! ( $('body').hasClass('isMobile') && $('body').hasClass('ipad') ) ) {
        $('#nav ul > li').hover(show_dropdown, hide_dropdown);
    }

    if ( $('body').hasClass('isMobile') && !$('body').hasClass('iphone') ) {
        $('.menu-item.menu-item-has-children').click(function (e) {
            e.stopPropagation();
            // Remove Link from item on level 1 for dropdown menu
            var _submenu = $('> .submenu, > .sub-menu', $(this));
            if (_submenu.length) {
                $('> a', this).attr('href', '#');
                e.preventDefault();
                if (_submenu.is(':hidden')) {
                    show_dropdown(e, $(this));
                }
                else {
                    hide_dropdown(e, $(this));
                }
            }

        });

        $('.sub-menu li > a').click(function (e) {
            if ($(this).attr('href') != '' && $(this).attr('href') != '#')
                location.href = $(this).attr('href');
        });
    }

});

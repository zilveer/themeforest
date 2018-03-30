window._errors = [];
window.onerror = function(args) {
    args = arguments;
    var len = args.length,
            i = 0;
    for (; i < len; ++i) {
        window._errors.push(args[i]);
    }
};


var rtl;
var window_width = 0;
var first = true;
var left_offset = 16;
var mobile = false;
var jaw_use_prettyphoto = jaw_use_prettyphoto || '1';
var isotope_grid = isotope_grid || 'masonry';
if (navigator.userAgent.match(/Android|BlackBerry|iPhone|iPod|Opera Mini|IEMobile/i)) {
    mobile = 'mobile';
} else if (navigator.userAgent.match(/iPad/i)) {
    mobile = 'tablet';
}
if (!("ontouchstart" in document.documentElement)) {
    document.documentElement.className += " no-touch";
}


var jaw_options = {
    offset: 0,
    offsetTopBar: 0,
    offsetMenuBar: 0,
    isotope_init: false,
    sortAscending: false,
    sortName: 'date',
    transformsEnabled: false,
    animationEngine: 'css'
};

//Kdyz je IE 8 nebo RTL     -  $.cookie("rtl_support")  - pro panel
if (jQuery.browser.msie === true && parseInt(jQuery.browser.version, 10) === 8 && $.cookie("rtl_support") != '1') {
    jaw_options.transformsEnabled = false;
    jaw_options.animationEngine = 'css';
} else if (rtl == '1' || jQuery.cookie("rtl_support") == '1') {
    jaw_options.transformsEnabled = false;
    jaw_options.animationEngine = 'best-available';
} else {
    jaw_options.transformsEnabled = true;
    jaw_options.animationEngine = 'jquery';
}


(function($, sr) {

    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function(func, threshold, execAsap) {
        var timeout;

        return function debounced() {
            var obj = this, args = arguments;
            function delayed() {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            }

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 500);
        };
    };
    // smartresize 
    jQuery.fn[sr] = function(fn) {
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
    };

})(jQuery, 'smartresize');






jQuery(document).ready(function($) {
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement("style");
        msViewportStyle.appendChild(
                document.createTextNode(
                        "@-ms-viewport{width:auto!important}"
                        )
                );
        document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
    }

    $('.jaw-counter').countTo();
    $('.post.format-gallery .carousel').carousel({
        interval: 5000
    });
    $('.tab-post-row .carousel').carousel({
        interval: 5000
    });
    // *** ISOTOPE**************************************************************

    if (rtl == '1' || $.cookie("rtl_support") == '1') {
        $.Isotope.prototype._positionAbs = function(x, y) {
            return {
                right: x,
                top: y
            };
        };
    }


    $('#main').on('click', '.items-sortby-list a', function() {
        jaw_options.sortName = $(this).attr('href').slice(1);
        if (jaw_options.sortName == 'name' || jaw_options.sortName == 'price' || jaw_options.sortName == 'category') {
            jaw_options.sortAscending = true;
        } else {
            jaw_options.sortAscending = false;
        }
        $(this).parents('.builder-section').find('.elements_iso').isotope({
            sortBy: jaw_options.sortName,
            sortAscending: jaw_options.sortAscending
        });
        return false;
    });
    // END ISOTOPE**************************************************************


    // filter items when filter link is clicked
    $('.items-filter-list a').click(function() {
        var selector = $(this).attr('data-filter');
        $(this).parents('.builder-section').find('.elements_iso').isotope({
            filter: selector
        });
        return false;
    });
    /*************************************************************************** 
     * BANNERS - Skyscrapper
     * ************************************************************************/
    $('.skyscrapper').css({
        top: $('#header').height() + "px"
    });
    /***************************************************************************
     * TO TOP
     ***************************************************************************/
    $(window).scroll(function() {
        offset = $(window).scrollTop();
        if (offset >= 50 && wWidth > 959) {
            $('#totop').show(250);
        } else {
            $('#totop').hide(250);
        }
    });
    $('#totop').hover(function() {
        $(this).animate({
            'opacity': '1'
        }, 150);
    }, function() {
        $(this).animate({
            'opacity': '0.8'
        }, 150);
    });
    $('#totop').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 350);
    });
    /* CAPTION FADE EFFECT *****************************************************/

    /* SELECT BOX MENU */
    $(".mobile-selectbox").change(
            function() {
                window.location = $(this).find("option:selected").val();
            }
    );
    /* ADD LAST CHILD CLASS IF IE 8 *******************************************/
    if ($("html").hasClass("ie8")) {
        $('*:last-child').addClass('last-child');
        $('#sidebar #searchform #searchsubmit').val(' ');
    }




    /* STARS RATING *******************************************************/
    $('.user-rating').mousemove(function(e) {

        $jw_rating_id = $(this).find(".jw_rating_id").val();
        $jw_rating_post_id = $(this).find(".jw_rating_post_id").val();
        cookieName = "jw_user_rating_" + $jw_rating_post_id + "_" + $jw_rating_id;
        if ($.cookie(cookieName) == 1) {
            $(this).find(".rating-top-stars").removeClass("user_editable");
        }

        if ($(this).find('.rating-top-stars').hasClass("user_editable")) {

            $('.jw-rating-userrating-name').text($('.jw-rating-userrating-name').attr('data-rel') + ':');
            userRating = (e.pageX - $(this).offset().left);
            if (userRating > 77) {
                userRating = 77;
            }
            if ($('body').hasClass('rtl'))
                userRating = 77 - userRating;
            //$('#rating-top-stars').css({width:Math.round(userRating)+"px"});
            switch (true) {
                case (userRating < 7):
                    $(this).find('.rating-top-stars').css({
                        width: "0px"
                    });
                    $('.jw-rating-userrating-score').text(0);
                    $(this).find('.jw_rating_user_value').val(0);
                    break;
                case (userRating >= 7 && userRating < 15):
                    $(this).find('.rating-top-stars').css({
                        width: "9%"
                    });
                    $('.jw-rating-userrating-score').text(0.5);
                    $(this).find('.jw_rating_user_value').val(0.1);
                    break;
                case (userRating >= 15 && userRating < 22):
                    $(this).find('.rating-top-stars').css({
                        width: "20%"
                    });
                    $('.jw-rating-userrating-score').text(1);
                    $(this).find('.jw_rating_user_value').val(0.2);
                    break;
                case (userRating >= 22 && userRating < 31):
                    $(this).find('.rating-top-stars').css({
                        width: "29%"
                    });
                    $('.jw-rating-userrating-score').text(1.5);
                    $(this).find('.jw_rating_user_value').val(0.3);
                    break;
                case (userRating >= 31 && userRating < 38):
                    $(this).find('.rating-top-stars').css({
                        width: "40%"
                    });
                    $('.jw-rating-userrating-score').text(2);
                    $(this).find('.jw_rating_user_value').val(0.4);
                    break;
                case (userRating >= 38 && userRating < 46):
                    $(this).find('.rating-top-stars').css({
                        width: "49%"
                    });
                    $('.jw-rating-userrating-score').text(2.5);
                    $(this).find('.jw_rating_user_value').val(0.5);
                    break;
                case (userRating >= 46 && userRating < 53):
                    $(this).find('.rating-top-stars').css({
                        width: "60%"
                    });
                    $('.jw-rating-userrating-score').text(3);
                    $(this).find('.jw_rating_user_value').val(0.6);
                    break;
                case (userRating >= 53 && userRating < 62):
                    $(this).find('.rating-top-stars').css({
                        width: "69%"
                    });
                    $('.jw-rating-userrating-score').text(3.5);
                    $(this).find('.jw_rating_user_value').val(0.7);
                    break;
                case (userRating >= 62 && userRating < 68):
                    $(this).find('.rating-top-stars').css({
                        width: "80%"
                    });
                    $('.jw-rating-userrating-score').text(4);
                    $(this).find('.jw_rating_user_value').val(0.8);
                    break;
                case (userRating >= 68 && userRating < 70):
                    $(this).find('.rating-top-stars').css({
                        width: "89%"
                    });
                    $('.jw-rating-userrating-score').text(4.5);
                    $(this).find('.jw_rating_user_value').val(0.9);
                    break;
                case (userRating >= 70):
                    $(this).find('.rating-top-stars').css({
                        width: "100%"
                    });
                    $('.jw-rating-userrating-score').text(5);
                    $(this).find('.jw_rating_user_value').val(1);
                    break;
            }
        }
    });
    $('.jw-rating-area-percent-user-rating').find('.user-rating').mouseleave(function() {
        ratingScore = Math.round($(this).find(".jw_rating_value").val() * 100);
        $(this).find('.rating-top-stars').css({
            width: ratingScore + "%"
        });
        $('.jw-rating-userrating-name').text($(this).find(".jw_rating_name").val() + ":");
        if ($(this).find('.rating-top-stars').hasClass("user_editable")) {
            $('.jw-rating-userrating-score').text((Math.round(ratingScore) / 100 * 5).toFixed(1));
        }
    });
    $('.ratig-background-stars').click(function() {

        var ratingBg = $(this);
        jw_rating_id = ratingBg.find(".jw_rating_id").val();
        jw_rating_post_id = ratingBg.find(".jw_rating_post_id").val();
        var cookieName = "jw_user_rating_" + jw_rating_post_id + "_" + jw_rating_id;
        if (ratingBg.find('.rating-top-stars').hasClass("user_editable")) {
            var data = {
                postId: ratingBg.find(".jw_rating_post_id").val(),
                ratingId: ratingBg.find(".jw_rating_id").val(),
                score: ratingBg.find(".jw_rating_user_value").val()
            };
            $.post(
                    site_url + '/wp-admin/admin-ajax.php', {
                        'action': 'jwrating_vote', // nebo jwrating_get
                        'data': data
                    },
            function(response) {
                var resp = jQuery.parseJSON(response);
                ratingBg.find(".jw_rating_value").val(resp.score);
                var label = $('.jw-rating-userrating-votes').attr('data-rel');
                $('.jw-rating-userrating-votes').text("(" + resp.voted + ": " + label + ")");
                $('.jw-rating-userrating-score').text(Math.round((resp.score * 100) / 2) / 10);
                ratingBg.find('.rating-top-stars').css({
                    width: Math.round(resp.score * 100) + "px"
                });
                ratingBg.find('.rating-top-stars').removeClass('user_editable');
                $.cookie(cookieName, 1, {
                    expires: 1,
                    path: '/'
                });
            });
        }
    });
    /* END STARS RATING ***************************************************/


    var jaw_dropdown = document.getElementById("cat");

    function onCatChange() {
        if (jaw_dropdown.options[jaw_dropdown.selectedIndex].value > 0) {
            /// LOCATION dodelat!!,
            //alert(site_url);

            location.href = site_url + "/?cat=" + jaw_dropdown.options[jaw_dropdown.selectedIndex].value;
        }
    }
    if (document.getElementById("cat") !== null && jaw_dropdown.length > 0) {
        jaw_dropdown.onchange = onCatChange;
    }

    /* Background banner klik *********************************************** */

    backgroundBannerWidth();
    //fullscreen
    left_offset = 20;
    //fullscreen
    if (jQuery(window).width() < 480) {
        left_offset = 10;
    } else if (jQuery(window).width() < 1000) {
        left_offset = 15;
    } else if (jQuery(window).width() < 1030) {
        left_offset = 10;
    } else if (jQuery(window).width() < 1263) {
        left_offset = 20;
    } else {
        left_offset = 20;
        if (jQuery('body').hasClass('wide-theme')) {
            left_offset = 50;
        }
    }
    jQuery('.row-fullwidth-item').each(function(el) {
        if (jQuery(this).hasClass('el-slider')) {
            jQuery(this).find('.jaw_slider').css("left", -jQuery("#container").offset().left - left_offset);
            jQuery(this).find('.jaw_slider_row').css("left", jQuery(window).width() / 2 - 1225);
            jQuery(this).find('.bullet_row').css("left", jQuery(window).width() / 2);
        } else {
            // @TODO HOTFIX - i radek 830 
            if (jQuery(this).find('.paralax_video').length && left_offset > 20) {
                left_offset = 25;
            }
            jQuery(this).css("left", jQuery("#container").offset().left * (-1) - left_offset);
            jQuery(this).width(jQuery(window).width());
        }

    });
    // ShortCode Divider Back to Top
    $('.divider_to_top').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 300);
        return false;
    });
    // Dropdown widget menu
    jQuery('.widget_nav_menu ul.menu > li, .jw_login_widget ul.menu > li').each(function() {
        jQuery(this).addClass('item-lvl-0');
        if (jQuery(this).find('ul.sub-menu').length !== 0) {
            jQuery(this).find('ul.sub-menu li').each(function() {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
            });
            if (jQuery(this).hasClass('current-menu-item')) {
                jQuery(this).find('ul.sub-menu').addClass('item-show');
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-up-gs"></span></div>');
            } else {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-down-gs"></span></div>');
            }
        } else {
            jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
        }
    });
    jQuery('.widget_nav_menu .widget-menu-dropdown, .jw_login_widget .widget-menu-dropdown').click(function() {
        if (jQuery(this).parent().find('> ul.sub-menu').hasClass('item-show')) {
            jQuery(this).parent().find('> ul.sub-menu').removeClass('item-show').slideUp("slow");
            jQuery(this).find('span.icon-arrow-up-gs').removeClass('icon-arrow-up-gs').addClass('icon-arrow-down-gs');
        } else {
            jQuery(this).parent().find('> ul.sub-menu').addClass('item-show').slideDown("slow");
            jQuery(this).find('span.icon-arrow-down-gs').removeClass('icon-arrow-down-gs').addClass('icon-arrow-up-gs');
        }
    });
    jQuery('.widget_nav_menu li.item-lvl-0 > a, .jw_login_widget li.item-lvl-0 > a').hover(
            function() {
                jQuery(this).parent().addClass('active-item');
            },
            function() {
                jQuery(this).parent().removeClass('active-item');
            }
    );
    // Drop down product category
    jQuery('.widget_product_categories ul.product-categories > li').each(function() {
        jQuery(this).addClass('item-lvl-0');
        if (jQuery(this).find('ul.children').length !== 0) {
            jQuery(this).find('ul.children li').each(function() {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
            });
            if (jQuery(this).hasClass('current-cat')) {
                jQuery(this).find('ul.children').addClass('item-show');
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-up-gs"></span></div>');
            } else {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-down-gs"></span></div>');
            }
        } else {
            jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
        }
    });
    jQuery('.widget_product_categories li.item-lvl-0').hover(
            function() {
                jQuery(this).addClass('active-item');
            },
            function() {
                jQuery(this).removeClass('active-item');
            }
    );
    jQuery('.widget_product_categories li .children').hover(
            function() {
                jQuery(this).closest('li.item-lvl-0').unbind('mouseenter').unbind('mouseleave').removeClass('active-item');
            },
            function() {
                jQuery(this).closest('li.item-lvl-0').bind({
                    mouseenter: function(e) {
                        jQuery(this).addClass('active-item');
                    },
                    mouseleave: function(e) {
                        jQuery(this).removeClass('active-item');
                    }
                }).addClass('active-item');
            }
    );
    //ONLOAD dropdownmenu
    jQuery('.widget_product_categories').each(function(e) {
        jQuery(this).find('.current-cat-parent').find('ul.children').addClass('item-show').slideDown("slow");
        jQuery(this).find('.current-cat-parent').find('span.icon-arrow-down-gs').removeClass('icon-arrow-down-gs').addClass('icon-arrow-up-gs');
    });
    jQuery('.widget_product_categories .widget-menu-dropdown').click(function() {
        if (jQuery(this).parent().find('> ul.children').hasClass('item-show')) {
            jQuery(this).parent().find('> ul.children').removeClass('item-show').slideUp("slow");
            jQuery(this).find('span.icon-arrow-up-gs').removeClass('icon-arrow-up-gs').addClass('icon-arrow-down-gs');
        } else {
            jQuery(this).parent().find('> ul.children').addClass('item-show').slideDown("slow");
            jQuery(this).find('span.icon-arrow-down-gs').removeClass('icon-arrow-down-gs').addClass('icon-arrow-up-gs');
        }
    });
    // Posts category
    jQuery('.widget_categories > ul > li').each(function() {
        jQuery(this).addClass('item-lvl-0');
        if (jQuery(this).find('ul.children').length !== 0) {
            jQuery(this).find('ul.children li').each(function() {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
            });
            if (jQuery(this).hasClass('current-menu-item')) {
                jQuery(this).find('ul.children').addClass('item-show');
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-up-gs"></span></div>');
            } else {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-down-gs"></span></div>');
            }
        } else {
            jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
        }
    });
    jQuery('.widget_categories .widget-menu-dropdown').click(function() {
        if (jQuery(this).parent().find('> ul.children').hasClass('item-show')) {
            jQuery(this).parent().find('> ul.children').removeClass('item-show').slideUp("slow");
            jQuery(this).find('span.icon-arrow-up-gs').removeClass('icon-arrow-up-gs').addClass('icon-arrow-down-gs');
        } else {
            jQuery(this).parent().find('> ul.children').addClass('item-show').slideDown("slow");
            jQuery(this).find('span.icon-arrow-down-gs').removeClass('icon-arrow-down-gs').addClass('icon-arrow-up-gs');
        }
    });
    jQuery('.widget_categories li.item-lvl-0').hover(
            function() {
                jQuery(this).addClass('active-item');
            },
            function() {
                jQuery(this).removeClass('active-item');
            }
    );
    jQuery('.widget_categories li .children').hover(
            function() {
                jQuery(this).closest('li.item-lvl-0').unbind('mouseenter').unbind('mouseleave').removeClass('active-item');
            },
            function() {
                jQuery(this).closest('li.item-lvl-0').bind({
                    mouseenter: function(e) {
                        jQuery(this).addClass('active-item');
                    },
                    mouseleave: function(e) {
                        jQuery(this).removeClass('active-item');
                    }
                }).addClass('active-item');
            }
    );
    jQuery('.widget_nav_menu .widget-menu-dropdown, .widget_product_categories .widget-menu-dropdown, .widget_categories ul li.item-lvl-0 > .widget-menu-dropdown').hover(
            function() {
                jQuery(this).parent().addClass('active-item');
            },
            function() {
                jQuery(this).parent().removeClass('active-item');
            }
    );
    if (mobile) {
        jQuery.each(jQuery('.paralax'), function() {
            jQuery(this).find('.fullwidth-block').css('background-attachment', 'scroll');
            jQuery(this).find('.fullwidth-block').css('margin-left', '-65px');
            jQuery(this).find('.fullwidth-block').css('margin-right', '-50px');
            jQuery(this).find('.fullwidth-block').css('padding-left', '65px');
            jQuery(this).find('.fullwidth-block').css('padding-right', '50px');
            jQuery(this).addClass('static');
        });
    } else {
        jQuery.each(jQuery('.paralax.dynamic'), function() {
            var scrolled = jQuery(window).scrollTop() - jQuery(this).offset().top;
            jQuery(this).find('.row').css('background-position', '50% ' + (-(scrolled * 0.5)) + 'px');
        });
    }
    jQuery('.js-paralax_video').jawParalaxVideo({
        mobile: mobile
    });
    //LAZYLOAD images
    $("img.lazy").lazyload({
        event: 'show_lazy'
    });
    //Images
    $('.builder-img').find('img.lazy').trigger('show_lazy');
    //Image in big blog
    $('.content-big .box').find('img.lazy').lazyload();
    //Trigger for gallery
    $(document).on("slid", function(event) {
        $(event.target).find('.active').find('img.lazy').trigger('show_lazy');
        $(event.target).find('.content-big.format-gallery').find('img.lazy').trigger('show_lazy');
    });
    if (jQuery('#container').length) {
        $("#skyscrapper-left").css({
            "left": (jQuery('#container').offset().left - jQuery("#skyscrapper-left").width() - 7) + "px",
            "top": jQuery('#header').height() + 'px'
        });
        $("#skyscrapper-right").css({
            "right": (jQuery('#container').offset().left - jQuery("#skyscrapper-right").width() - 7) + "px",
            "top": jQuery('#header').height() + 'px'
        });
    }
    if (jQuery('.row-menu-bar-fixed').length && jQuery(window).width() >= 768) {

        jaw_options.offset = jQuery(window).scrollTop();
        jaw_options.offsetTopBar = jQuery('#template-box').offset().top;
        jaw_options.topBarHeight = jQuery('.page-top').outerHeight();

        if (jQuery('.topbar-fixed').length) {
            jQuery('.body-big-menu.body-fix-menu #template-box').css({
                marginTop: (jQuery('.big-menu.main-menu').innerHeight()) - 2 + jaw_options.topBarHeight + 'px'
            });
        } else {
            jQuery('.body-big-menu.body-fix-menu #template-box').css({
                marginTop: (jQuery('.big-menu.main-menu').innerHeight()) - 2 + 'px'
            });
        }

        //menuHeaderBars();
        jaw_options.offsetMenuBar = jQuery('.row-menu-bar-fixed').offset().top;
        jQuery(window).scrollTop(0);
        jaw_options.topBarHeight = jQuery('.page-top').outerHeight();
        if (jQuery('.admin-bar').length) {
            jQuery('.big-menu.row-menu-bar-fixed-on').css({
                top: jaw_options.topBarHeight + jQuery('#wpadminbar').height() - 1 + 'px'
            });
        } else {
            jQuery('.big-menu.row-menu-bar-fixed-on').css({
                top: jaw_options.topBarHeight + 'px'
            });
        }
    }

    jQuery('ul.top-nav-mobile li.jaw-menu-item-depth-0.has-dropdown > a .jaw-menu-icon').click(function() {

        var parent = jQuery(this).parent().parent();
        if (parent.hasClass('jaw-active-item')) {
            parent.removeClass('jaw-active-item');
        } else {
            parent.addClass('jaw-active-item');
        }


        return false;
    });
    if (jQuery('.search .search-product').length > 0) {
        if (jQuery('.search .search-product').hasClass('.active')) {
            jQuery('.woo-sort-cat-form').show();
        } else {
            jQuery('.woo-sort-cat-form').hide();
        }
    }


    // **** PRETTYPHOTO**************************

    if (jaw_use_prettyphoto === '1') {

        $("a[rel^='prettyPhoto'], a[data-rel^='prettyPhoto'] ").prettyPhoto({
            social_tools: false,
            default_width: 800,
            default_height: 500,
            show_title: false
        });
    }

    // Hover over product style 20
    $('.product-style-20').find('.woo_thumbnail_image').on('mouseenter', function() {
        $(this).parents('.images').find('.wp-post-image').css('opacity', '0');
        $(this).parents('.images').find('.woo_second_image').css('opacity', '0');
        $(this).parents('.images').find('#woo_second_image_' + $(this).data('thumbnail')).css('opacity', '1');
        $(this).one('mouseleave', function() {
            $(this).parents('.images').find('.wp-post-image').css('opacity', '1');
            $(this).parents('.images').find('.woo_second_image').css('opacity', '0');
        });
    });

    jaw_isotope();
});
//DOCUMENT ready  =  END  =====================================================



jQuery(window).load(function() {
    jQuery(document).ready(function($) {
        if (use_selectric == '1') {
            // selectric - pro hezci selecty
            jQuery('select').not('.mobile-selectbox').not('.country_to_state').not('#calc_shipping_state').not('#billing_state').not('#shipping_state').not('#wc_product_finder select').not('#billing_city').not('#delivery_time').not('select[class^="fpd-"]').not('.wc_address_validation_chosen').not('.wc-address-validation-enhanced-select').selectric();
            //pri kliku na clear selection na woocommerce
            jQuery('.variations_form').bind('woocommerce_update_variation_values', function() {
                jQuery('select').selectric('refresh');
            });
        }


        jQuery('.jaw-video').each(function() {
            jQuery(this).height(jQuery(this).width() / 1.78);
        });


        //search v menu
        jQuery('.header-small-center-search .header-search').find('.search-button').on('click', function(e) {
            if (!jQuery(this).parents('.header-search').hasClass('active')) {
                jQuery(this).parents('.header-search').addClass('active');
                jQuery(this).parent().find('input').focus();
                console.log('Adsfds');
                e.preventDefault();
            }
        });


        //po nacteni revslideru

        jQuery('#search_jaw-faq > .elements_iso').on('hidden.bs.collapse', function(e) {
            jQuery('#search_jaw-faq > .elements_iso').each(function(key, el) {
                jQuery(el).isotope('reLayout');
            });
        });
        jQuery('#search_jaw-faq > .elements_iso').on('shown.bs.collapse', function(e) {
            jQuery('#search_jaw-faq > .elements_iso').each(function(key, el) {
                jQuery(el).isotope('reLayout');
            });
        });
        
        //po nacteni html carouselů - carousel-initialized
        jQuery('.el-html_carousel').each(function(key, element){
        var max_height_carousel = 0;
        jQuery(element).find('.carousel').find('.item').each(function(k, el) {
            var el_height = jQuery(element).find('.carousel-caption').height();
            if (max_height_carousel < el_height) {
                max_height_carousel = el_height;
            }

        });
        jQuery(element).find('.item').height(max_height_carousel);
        jQuery(element).find('.carousel-inner').height(max_height_carousel);
        jQuery(element).find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
        jQuery('body').trigger('jaw-relayout');
    });


    });
});

function backgroundBannerWidth() {
    var offset_left = 0;
    if (jQuery('.container').offset() !== undefined) {
        offset_left = jQuery('.container').offset().left;
    } else {
        offset_left = 0;
    }
    var banner_left_width = jQuery('.background_banner_link.left').width();
    var banner_right_width = jQuery('.background_banner_link.right').width();
    if (banner_left_width > 0) {
        jQuery('.background_banner_link.left').css({
            left: (offset_left - banner_left_width) + 'px',
            height: '100%'
        });
    } else {
        jQuery('.background_banner_link.left').css({
            width: offset_left + 'px',
            height: '100%'
        });
    }

    if (banner_right_width > 0) {
        jQuery('.background_banner_link.right').css({
            right: (offset_left - banner_right_width) + 'px',
            height: '100%'
        });
    } else {
        jQuery('.background_banner_link.right').css({
            width: offset_left + 'px',
            height: '100%'
        });
    }
}

/* =============== GOOD STORE ================== 
 * =========================*/

// Window scrolling functions 
jQuery(window).scroll(function() {

    menuHeaderBars();
    if (!mobile) {
        jQuery.each(jQuery('.paralax.dynamic'), function() {
            var scrolled = jQuery(window).scrollTop() - jQuery(this).offset().top;
            jQuery(this).find('.row').css('background-position', '50% ' + (-(scrolled * 0.5)) + 'px');
        });
    }

});
// Funcke urcuje pozici menu, pokud je zapnuto ze ma byt menu fixni.
function menuHeaderBars() {
    jaw_options.topBarHeight = jQuery('.page-top').outerHeight();
    if (jQuery(window).width() >= 768) {
        if (jQuery('.row-menu-bar-fixed').length && !jQuery('.body-big-menu').length) {

            jaw_options.offset = jQuery(window).scrollTop();
            jaw_options.offsetTopBar = jQuery('#template-box').offset().top;
            if (jaw_options.offset < jaw_options.offsetMenuBar) {
                jQuery('.row-menu-bar-fixed').removeClass('row-menu-bar-fixed-on');
                jQuery('.row-menu-bar-fixed').css({
                    top: 0 + 'px'
                });
            } else {
                jQuery('.row-menu-bar-fixed').addClass('row-menu-bar-fixed-on');
                if (jQuery('.topbar-fixed').length) {
                    jQuery('.row-menu-bar-fixed').css({
                        top: jaw_options.offsetTopBar + 'px'
                    });
                } else {
                    jQuery('.row-menu-bar-fixed').css({
                        top: jaw_options.offsetTopBar - jaw_options.topBarHeight + 'px'
                    });
                }
            }
        } else {

            jaw_options.offset = jQuery(window).scrollTop();
            if (jaw_options.offset < jaw_options.topBarHeight) {
                if (jQuery('.topbar-fixed').length) {
                    jQuery('.big-menu.row-menu-bar-fixed-on').css({
                        top: jaw_options.offsetTopBar + 'px'
                    });
                } else {
                    jQuery('.big-menu.row-menu-bar-fixed-on').css({
                        top: jaw_options.topBarHeight + 'px'
                    });
                }
            } else {
                if (jQuery('.topbar-fixed').length) {
                    jQuery('.big-menu.row-menu-bar-fixed-on').css({
                        top: jaw_options.offsetTopBar + 'px'
                    });
                } else {
                    jQuery('.big-menu.row-menu-bar-fixed-on').css({
                        top: 0 + 'px'
                    });
                }
            }
        }
        //scrollable logo with search
        var srcHeight=18;
        if(jQuery(".header-small-center-search.jaw-logo-scrollable.row-menu-bar-fixed-on").length) {
            jQuery(".header-small-center-search.jaw-logo-scrollable.row-menu-bar-fixed-on .header-search").css("top",jQuery(".jaw-menu-bar").height()/2 - srcHeight);
        } else {
            jQuery(".header-small-center-search.jaw-logo-scrollable .header-search").css("top",2);
        }
    }
}

jQuery('.search .nav.nav-tabs li').click(function() {
    if (jQuery(this).hasClass('search-product')) {
        jQuery('.woo-sort-cat-form').show();
    } else {
        jQuery('.woo-sort-cat-form').hide();
    }
});
//WISHLIST - ajax   
jQuery('body').on('added_to_wishlist', function() {
    var data = {
        'tmpl': 'wishlist',
        'dir': ['header', 'top_bar']
    };
    jQuery.post(site_url + '/wp-admin/admin-ajax.php', {
        'action': 'get_template_part',
        'data': data
    },
    function(response) {
        if (response && response != '0') {
            jQuery('.wishlist-contents').html(response);
        }
    });
});
jQuery(window).smartresize(function() {
    //BACKGROUND BANNER 
    backgroundBannerWidth();
    //fullscreen
    if (jQuery(window).width() < 480) {
        left_offset = 10;
    } else if (jQuery(window).width() < 1000) {
        left_offset = 15;
    } else if (jQuery(window).width() < 1030) {
        left_offset = 10;
    } else if (jQuery(window).width() < 1263) {
        left_offset = 20;
    } else {
        left_offset = 20;
        if (jQuery('body').hasClass('wide-theme')) {
            left_offset = 50;
        }
    }
    jQuery('.row-fullwidth-item').each(function(el) {
        if (jQuery(this).hasClass('el-slider')) {
            jQuery(this).find('.jaw_slider').css("left", -jQuery("#container").offset().left - left_offset);
            jQuery(this).find('.jaw_slider_row').css("left", jQuery(window).width() / 2 - 1225);
            jQuery(this).find('.bullet_row').css("left", jQuery(window).width() / 2);
        } else {
            // @TODO - i radek 370
            if (jQuery(this).find('.paralax_video').length && left_offset > 20) {
                left_offset = 25;
            }
            jQuery(this).css("left", jQuery("#container").offset().left * (-1) - left_offset);
            jQuery(this).width(jQuery(window).width());
        }

    });
    //Jaw SLIDER pri resiznuti okna - otoceni tabletu
    if (!first && jQuery(window).width() < 1000 && window_width >= 1263 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({
            left: '-=' + 215 + 'px'
        }, 500, 'easeInOutQuint');
    }
    if (!first && jQuery(window).width() >= 1263 && window_width < 1000 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({
            left: '+=' + 215 + 'px'
        }, 500, 'easeInOutQuint');
    }

    if (!first && jQuery(window).width() < 1000 && window_width >= 1000 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({
            left: '-=' + 111 + 'px'
        }, 500, 'easeInOutQuint');
    }
    if (!first && jQuery(window).width() >= 1000 && window_width < 1000 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({
            left: '+=' + 111 + 'px'
        }, 500, 'easeInOutQuint');
    }
    if (!first && jQuery(window).width() < 1263 && window_width >= 1263 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({
            left: '-=' + 104 + 'px'
        }, 500, 'easeInOutQuint');
    }
    if (!first && jQuery(window).width() >= 1263 && window_width < 1263 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({
            left: '+=' + 104 + 'px'
        }, 500, 'easeInOutQuint');
    }

    window_width = jQuery(window).width();



    //ISOTOPE-resize
    jQuery('.elements_iso').each(function(key, el) {

        jQuery('.carousel').find('.carousel-inner').removeClass('carousel-initialized'); // Safari fix
        jQuery('body').trigger('jaw-relayout');
        if (jaw_options.isotope_init) {
            jQuery(el).isotope('reLayout', function() { // pri zmene velikosti okna reLayoutujeme vsechny isotopy
                // a v callbacku (po preskladani) zmerime opet vysku vsech carouselu
                setTimeout(function() {

                    jQuery(el).parents('.carousel').each(function(key, element) {
                        var max_height_carousel = 0;
                        jQuery(element).find('.item').each(function(k, el) {
                            var el_height = jQuery(element).find('.carousel-caption').height();
                            if (max_height_carousel < el_height) {
                                max_height_carousel = el_height;
                            }

                        });
                        jQuery(element).find('.item').height(max_height_carousel);
                        jQuery(element).find('.carousel-inner').height(max_height_carousel);
                        jQuery('.carousel').find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
                    });

                }, 3000);
            });
        }

    });
    
    jQuery('.el-html_carousel').each(function(key, element){
        var max_height_carousel = 0;
        jQuery(element).find('.carousel').find('.item').each(function(k, el) {
            var el_height = jQuery(element).find('.carousel-caption').height();
            if (max_height_carousel < el_height) {
                max_height_carousel = el_height;
            }

        });
        jQuery(element).find('.item').height(max_height_carousel);
        jQuery(element).find('.carousel-inner').height(max_height_carousel);
        jQuery(element).find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
        jQuery('body').trigger('jaw-relayout');
    });
    jQuery("#skyscrapper-left").css({
        "left": (jQuery('#container').offset().left - jQuery("#skyscrapper-left").width() - 15) + "px"
    });
    jQuery("#skyscrapper-right").css({
        "right": (jQuery('#container').offset().left - jQuery("#skyscrapper-right").width() - 15) + "px"
    });
    //Velikost videa
    jQuery('.jaw-video').each(function() {
        jQuery(this).height(jQuery(this).width() / 1.78);
    });
});
//scrool animation 
(function($) {
    'use strict';
    $.fn.jawScroolAnimation = function(options) {
        var defaults = {
            animation: 'slide',
            animationSpeed: 1000,
            animationDirection: 'left',
            animationEasing: 'swing'
        };
        options = $.extend({}, defaults, options);
        return this.each(function(key, el) {
            $(el).contents().hide();
            var checkStartAnimation = function() {
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                var bottom_of_object = $(el).offset().top;
                if (bottom_of_window > bottom_of_object) {
                    return true;
                }
                return false;
            };
            var jawAnimationHandler = function() {
                if (checkStartAnimation()) {
                    $(el).contents().show(options.animation, {
                        direction: options.animationDirection,
                        easing: options.animationEasing
                    }, options.animationSpeed, function() {
                        $(window).off("scroll", jawAnimationHandler);
                    });
                }
            };
            jawAnimationHandler();
            $(window).scroll(jawAnimationHandler);
        });
    };
})(jQuery);
//JAW-SLIDER
(function($) {

    'use_strict';
    /**      * JaW Slider
     * @param {type} options
     */
    $.fn.jawSlider = function(options) {

        var defaults = {
            animationSpeed: 1500,
            animationDelay: '3000',
            animationStep: 489,
            animationDirection: 'left'
        };
        options = $.extend({}, defaults, options);
        var $slider = this;
        var timeout;
        var click_active = true;
        var mouseout = true;
        var show_info = function(id) {
            $slider.find('.jaw_one_slide').eq(id).find('.jaw_content').animate({
                bottom: '-185px'
            }, options.animationSpeed);
            $slider.find('.jaw_one_slide').eq(id + 1).find('.jaw_content').animate({
                bottom: '0'
            }, options.animationSpeed);
            $slider.find('.jaw_one_slide').removeClass('prev active next');
            $slider.find('.jaw_one_slide').eq(1).addClass('prev');
            $slider.find('.jaw_one_slide').eq(2).addClass('active');
            $slider.find('.jaw_one_slide').eq(3).addClass('next');
            $slider.find('.bullet').eq(0).find('i').removeClass('icon-radio-unchecked');
            $slider.find('.bullet').eq(0).find('i').addClass('icon-circle2');
        };
        var slide = function(length, direction) {
            var i = 0;
            if (click_active) {
                click_active = false;
                if (length === undefined) {
                    length = 1;
                }

                if (direction === undefined) {
                    direction = options.animationDirection;
                }

                first = false;
                if (direction == 'left') {

                    for (i = 0; i < length; i++) {
                        $slider.find('.jaw_slider_row').append($slider.find('.jaw_one_slide').eq(i).clone());
                    }

                    $slider.find('.jaw_one_slide').find('.jaw_content').animate({
                        bottom: '-185px'
                    }, options.animationSpeed);
                    $slider.find('.jaw_slider_row').animate({
                        left: '-=' + options.animationStep * length + 'px'
                    }, options.animationSpeed, 'easeInOutQuint', function() {

                        clearTimeout(timeout);
                        $slider.find('.jaw_slider_row').css('left', '+=' + options.animationStep * length + 'px');
                        for (i = 0; i < length; i++) {
                            $slider.find('.jaw_one_slide').first().remove();
                        }
                        $slider.find('.jaw_one_slide').eq(2).find('.jaw_content').animate({
                            bottom: '0'
                        }, options.animationSpeed);
                        $slider.find('.jaw_one_slide').removeClass('prev active next');
                        $slider.find('.jaw_one_slide').eq(1).addClass('prev');
                        $slider.find('.jaw_one_slide').eq(2).addClass('active');
                        $slider.find('.jaw_one_slide').eq(3).addClass('next');
                        $slider.find('.bullet i').removeClass('icon-circle2');
                        $slider.find('.bullet i').addClass('icon-radio-unchecked');
                        $slider.find('.bullet').eq(Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld'))).find('i').removeClass('icon-radio-unchecked');
                        $slider.find('.bullet').eq(Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld'))).find('i').addClass('icon-circle2');
                        if (mouseout) {
                            timeout = setTimeout(slide, options.animationDelay);
                        }
                        jQuery('.row-fullwidth-item').find('.jaw_slider_row').css("left", jQuery(window).width() / 2 - 1225);
                        click_active = true;
                        //  });
                    });
                } else {

                    for (i = $slider.find('.jaw_one_slide').length - 1; i > $slider.find('.jaw_one_slide').length - 1 - length; i--) {
                        $slider.find('.jaw_slider_row').prepend($slider.find('.jaw_one_slide').eq(i).clone());
                    }

                    $slider.find('.jaw_one_slide').find('.jaw_content').animate({
                        bottom: '-185px'
                    }, options.animationSpeed);
                    $slider.find('.jaw_slider_row').css('left', '-=' + options.animationStep * length + 'px');
                    $slider.find('.jaw_slider_row').animate({
                        left: '+=' + options.animationStep * length + 'px'
                    }, options.animationSpeed, 'easeInOutQuint', function() {

                        clearTimeout(timeout);
                        for (i = 0; i < length; i++) {
                            $slider.find('.jaw_one_slide').last().remove();
                        }
                        $slider.find('.jaw_one_slide').eq(2).find('.jaw_content').animate({
                            bottom: '0'
                        }, options.animationSpeed);
                        $slider.find('.jaw_one_slide').removeClass('prev active next');
                        $slider.find('.jaw_one_slide').eq(1).addClass('prev');
                        $slider.find('.jaw_one_slide').eq(2).addClass('active');
                        $slider.find('.jaw_one_slide').eq(3).addClass('next');
                        $slider.find('.bullet i').removeClass('icon-circle2');
                        $slider.find('.bullet i').addClass('icon-radio-unchecked');
                        $slider.find('.bullet').eq(Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld'))).find('i').removeClass('icon-radio-unchecked');
                        $slider.find('.bullet').eq(Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld'))).find('i').addClass('icon-circle2');
                        if (mouseout) {
                            timeout = setTimeout(slide, options.animationDelay);
                        }
                        jQuery('.row-fullwidth-item').find('.jaw_slider_row').css("left", jQuery(window).width() / 2 - 1225);
                        click_active = true;
                    });
                }
            }
        };
        var init = function() {
            $slider.show();
            show_info(1);
            timeout = setTimeout(slide, options.animationDelay);
        };
        init();
        //po najeti zastavit animaci
        $slider.mouseenter(function() {
            clearTimeout(timeout);
            mouseout = false;
        });
        $slider.mouseleave(function() {
            mouseout = true;
            timeout = setTimeout(slide, options.animationDelay);
        });
        /********************************** UI **********************************/

        //odsazeni navigacnich sipek
        $slider.find('.bullet_row').css('margin-left', -$slider.find('.bull').length * 10);
        //Kliknuti na navigacni sipky
        $slider.find('.bull').on('click', function() {
            clearTimeout(timeout);
            if (jQuery(this).attr('data-sld') === undefined) {
                if (jQuery(this).attr('data-direction') == 'left') {
                    slide(1);
                } else {
                    slide(1, 'right');
                }
            } else {
                if (jQuery(this).attr('data-sld') != $slider.find('.jaw_one_slide').eq(2).attr('data-sld')) {
                    var cross_zero = 0;
                    if (jQuery(this).attr('data-sld') < $slider.find('.jaw_one_slide').eq(2).attr('data-sld')) {
                        cross_zero = 1;
                    }
                    var calltime = cross_zero * ($slider.find('.jaw_one_slide').length) - Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld')) + Number(jQuery(this).attr('data-sld'));
                    slide(calltime);
                }
            }
        });
        //Kliknuti na OBRAZKY - pretoceni nebo odkaz
        $slider.find('.jaw_one_slide').on('click', function() {

            if (jQuery(this).hasClass('prev')) {
                slide(1, 'right');
            } else if (jQuery(this).hasClass('next')) {
                slide(1, 'left');
            } else if (jQuery(this).hasClass('active')) {
                window.location.href = jQuery(this).attr('data-link');
            }
        });
    };
})(jQuery);
//PARALAX VIDEO
(function($, window) {


    $.fn.jawParalaxVideo = function(options) {
        var defaults = {
            mobile: false
        };
        options = $.extend({}, defaults, options);
        var $video = this;
        var position = function($element, mobile) {
            if (mobile) {
                $element.css('top', (-($element.height() - $element.parent().height()) / 2) + 'px');
            } else {
                var scrolled = ($element.parent().height() - $element.height()) / jQuery(window).height() * (jQuery(window).scrollTop() - $element.parent().offset().top - 700);
                $element.css('top', (-(scrolled * 0.5)) + 'px');
            }
        };




        $video.show();
        $.each($video, function(el) {
            position($(this), options.mobile);
        });
        // barvu pozadi nacist az po posunuti divu s videem aby tam nebyl videt ten skok
        $video.parent().css('background-color', $video.parent().attr('data-color'));
        $video.parent().css('background-image', 'url(\'' + $video.parent().attr('data-image') + '\')');
        //showuju pattern az po nastaveni pozice - ze stejnyho duvodu jako pozadi
        $video.parent().find('.block-pattern').show();
        if (options.mobile == 'mobile') { //pokud sem na telefonu tak video oddelam.
            $video.remove();
        }



        return (function(mobile) {
            $(window).scroll(function() {
                $.each($video, function(el) {
                    position($(this), mobile);
                });
            });
        })(options.mobile);
    };

})(jQuery, window);
/**
 * Trigger a callback when 'this' image is loaded:
 * @param {Function} callback
 */
(function($) {
    $.fn.imgLoad = function(callback) {
        return this.each(function() {
            if (callback) {
                if (this.complete || /*for IE 10-*/ $(this).height() > 0) {
                    callback.apply(this);
                } else {
                    $(this).on('load', function() {
                        callback.apply(this);
                    });
                }
            }
        });
    };
})(jQuery);

/**
 * Trigger a callback when 'this' image is loaded:
 * @param {Function} callback
 */
(function($) {
    $.fn.itemsLoad = function(callback) {
        var itemsloaded = 0;
        var items = jQuery('.rev_slider').length + 1;


        imagesLoaded(this.find('img'), function(instance) {
            ret($(this));
        });

        jQuery('.rev_slider').bind('revolution.slide.onloaded', function() {
            ret();
        });

        function ret(el) {


            itemsloaded++;
            //console.log(itemsloaded + ' / ' + items  );
            if (itemsloaded == items) {
                return callback.apply(this);
            }
        }
    };
})(jQuery);

var jaw_isotope = function() {
    if (!jaw_options.isotope_init) {
        jQuery('.elements_iso').each(function(key, el) {
            jQuery(el).isotope({
                layoutMode: isotope_grid,
                animationEngine: jaw_options.animationEngine,
                transformsEnabled: jaw_options.transformsEnabled,
                itemSelector: '.element',
                resizable: false,
                getSortData: {
                    name: function(jQueryelem) {
                        return jQueryelem.attr('sort_name');
                    },
                    date: function(jQueryelem) {
                        return jQueryelem.attr('sort_date');
                    },
                    rating: function(jQueryelem) {
                        return parseFloat(jQueryelem.attr('sort_rating'));
                    },
                    popular: function(jQueryelem) {
                        return parseFloat(jQueryelem.attr('sort_popular'));
                    },
                    price: function(jQueryelem) {
                        return parseFloat(jQueryelem.attr('sort_price'));
                    },
                    sales: function(jQueryelem) {
                        return parseFloat(jQueryelem.attr('sort_sales'));
                    },
                    category: function(jQueryelem) {
                        return jQueryelem.attr('sort_category');
                    }
                }
            },
            function() {
                jaw_options.isotope_init = true;
                //Pri nacteni stranky se ykontroluje vyska vsech stranek v caruselu a vsem se nastavi stejna -> aby to neskakalo

                jQuery(el).itemsLoad(function() {


                    //console.log('imgsLoad');



                    jQuery(el).parents('.carousel').find('.carousel-inner').removeClass('carousel-initialized'); // Safari fix

                    jQuery(el).isotope('reLayout', function() {
                        jQuery(el).parents('.carousel').find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
                        jQuery('body').trigger('jaw-relayout');
                    });

                    setTimeout(function() {

                        jQuery(el).parents('.carousel').each(function(key, element) {
                            var max_height_carousel = 0;
                            jQuery(element).find('.elements_iso').each(function(k, item) {
                                var el_height = jQuery(item).height();
                                if (max_height_carousel < el_height) {
                                    max_height_carousel = el_height;
                                }
                            });
                            jQuery(element).find('.item').height(max_height_carousel);
                            jQuery(element).find('.carousel-inner').height(max_height_carousel);
                        });


                    }, 3000);
                });
            });
        });


        // ========= INFINITY LIST ===========================================
        var count_page = 0;
        var num_page_on_page = 2; // <<--- Nuber of ajax section on page
        if (typeof infinite_scroll != 'undefined') {

            jQuery.each(infinite_scroll, function(i, in_sc) {

                jQuery(in_sc.contentSelector).infinitescroll(in_sc, function(newElements) {

                    jQuery(this).isotope("appended", jQuery(newElements)); //>>>>> Speed gallery slider (on the main page) for next pages in infinite list<<<<<
                    jQuery('#infinite_load_' + in_sc.id + ' .morebutton').show();
                    if (in_sc.type == 'ajax') {
                        count_page++;
                        if (count_page >= (num_page_on_page - 1)) {
                            jQuery(in_sc.contentSelector).infinitescroll({
                                state: {
                                    isDone: true
                                }
                            });
                            jQuery("#infinite_load_" + in_sc.id).append(window.next_page);
                            jQuery("#infinite_load_" + in_sc.id).append(jQuery('#infinite_load_' + in_sc.id + ' #post-nav-infinite .post-next-infinite').html());
                        }
                    }
                    if (jaw_use_prettyphoto === '1') {
                        jQuery("a[rel^='prettyPhoto'], a[data-rel^='prettyPhoto'] ").prettyPhoto({
                            social_tools: false,
                            default_width: 800,
                            default_height: 500,
                            show_title: false
                        });
                    }
                    jQuery('.content-big .box').find('img.lazy').lazyload();
                    setTimeout(function() {
                        jQuery('.carousel').find('.carousel-inner').removeClass('carousel-initialized'); // Safari fix
                        jQuery(newElements).parent().isotope('reLayout', function() {
                            jQuery('.carousel').find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
                            jQuery('body').trigger('jaw-relayout');
                        });
                    }, 500);

                    //Uprava showing x-xx of xx products
                    var number_of_el = jQuery(this).find('.element').length;
                    var old_html = jQuery('.woocommerce-result-count').text().replace(/(.*?\d+)-(\d+)(.*?)/, "$1-" + number_of_el + "$3");
                    jQuery('.woocommerce-result-count').text(old_html);
                });
                if (in_sc.type == 'infinitemore') {
                    jQuery('#infinite_load_' + in_sc.id + ' #post-nav-infinite').hide();
                    jQuery("#infinite_load_" + in_sc.id).append(more);
                    jQuery(in_sc.contentSelector).infinitescroll('pause');
                    jQuery('#infinite_load_' + in_sc.id + ' .morebutton').click(function() {
                        jQuery(in_sc.contentSelector).infinitescroll('retrieve');
                        jQuery('#infinite_load_' + in_sc.id + ' .morebutton').hide();
                    });
                } else if (in_sc.type == 'infinite') {
                    jQuery('#infinite_load_' + in_sc.id + ' #post-nav-infinite').hide();
                }
            });
        }
    } else {
        jQuery('.carousel').find('.carousel-inner').removeClass('carousel-initialized'); // Safari fix
        jQuery('.elements_iso').each(function(key, el) {
            jQuery(el).isotope('reLayout', function() {
                jQuery('.carousel').find('.carousel-inner').addClass('carousel-initialized'); //  Safari fix
                jQuery('body').trigger('jaw-relayout');
            });
        });
        setTimeout(function() {
            jQuery('.elements_iso').each(function(key, el) {
                jQuery(el).find('img').imgLoad(function() {
                    jQuery(el).parents('.carousel').each(function(key, element) {
                        var max_height_carousel = 0;
                        jQuery(element).find('.elements_iso').each(function(k, item) {
                            var el_height = jQuery(item).height();
                            if (max_height_carousel < el_height) {
                                max_height_carousel = el_height;
                            }
                        });
                        jQuery(element).find('.item').height(max_height_carousel);
                        jQuery(element).find('.carousel-inner').height(max_height_carousel);
                    });

                });
            });
        }, 1000);
    }
};

//google maps
function JawGoogleMapLoaded(){ 
    jQuery("body").trigger("jaw_g_maps");
}
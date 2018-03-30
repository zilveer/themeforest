jQuery(document).ready(function ($) {
    "use strict";

    $('body').find('iframe').each(function () {
        $(this).removeAttr('frameborder');
    });

    var isCheckMenu = $('ul').hasClass('menu-links');
    if (isCheckMenu === false) {
        $('div.menu-links').removeClass('menu-links').children('ul').addClass('menu-links');
    }

    $('.page-content img').each(function () {
        var title = $(this).attr('title');
        if (title == 'Image Alignment 1200x400') {
            $(this).parent('figure').attr('style', '');
            $(this).attr('height', '100%');
            $(this).attr('width', '100%');
        }
    });


    $('.filter-bar a.grid-view').on('click', function () {
        $('div.row > div.shop').removeClass('product-list');
    });

    $('.filter-bar a.list-view').on('click', function () {
        $('div.row > div.shop').addClass('product-list');
    });


    /*===== Search Form =====*/
    $('.shop-menu button.form').on('click', function () {
        $('.shop-menu form').addClass('search-here');
        return false;
    });

    $('.shop-menu form .form-close').on('click', function () {
        $('.shop-menu form').removeClass('search-here');
        return false;
    });

    var big_div = $(".bg-div").height();

    $('.trigger').on('click', function () {
        $('html, body').animate({
            scrollTop: $("#scrolled").offset().top
        }, 2000);
    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll > big_div) {
            $(".simpleheader2.stick2").addClass("sticky");
            $(".theme-layout").addClass("slide-up");
        } else {
            $(".simpleheader2.stick2").removeClass("sticky");
            $(".theme-layout").removeClass("slide-up");
        }
    });

    $('ul.menu-links li').each(function () {
        if ($(this).hasClass('menu-item-has-children')) {
            var check = $(this).children('div');
            if ($(check).hasClass('megamenu')) {
                var parent = $(check).parent();
                $(parent).find('ul.sub-menu').remove();
            }
        }
    });
    /*=================== Responsive Menu ===================*/
    $(".responsive-menu ul li").each(function () {
        if ($(this).hasClass('page_item_has_children') || $(this).hasClass('menu-item-has-children')) {
            $(this).prepend('<i class="fa fa-angle-down"></i>');
        }
    });
    jQuery(".open-menu").on("click", function () {
        jQuery(".responsive-menu").slideDown();
        jQuery(".responsive-search").slideUp();
        return false;
    });
    jQuery(".open-search").on("click", function () {
        jQuery(".responsive-search").slideToggle();
        jQuery(".responsive-menu").slideUp();
        return false;
    });
    jQuery(".close-this, html").on("click", function () {
        jQuery(".responsive-menu").slideUp();
    });
    jQuery(".responsive-menu").on("click", function (e) {
        e.stopPropagation();
    });

    var responsive = jQuery(".responsive-header").innerHeight();
    jQuery(".responsive-header-height").css({
        "height": responsive
    });

    jQuery(".responsive-menu li.menu-item-has-children > i").on("click", function () {
        jQuery(this).parent().siblings().children("ul").slideUp();
        jQuery(this).parent().siblings().removeClass("active");
        jQuery(this).parent().children("ul").slideToggle();
        jQuery(this).parent().toggleClass("active");
        return false;
    });

    $('.responsive-menu').enscroll({
        showOnHover: false,
        verticalTrackClass: 'track4',
        verticalHandleClass: 'handle4'
    });

    $('div.enscroll-track.track4').parent('div').css({
        'z-index': 99999
    })
    /*=================== Sticky Header ===================*/
    if (jQuery("body div").hasClass("simple-header")) {
        var simple_header_stick;
        if (jQuery(".simple-header").hasClass('stick')) {
            var simple_header_stick = jQuery(".simple-header.stick").offset().top;
        }
        var simple_header_height = jQuery(".simple-header.stick").innerHeight();
        jQuery(".header-wrap").css({
            "height": simple_header_height
        });
        jQuery(window).scroll(function () {
            var scroll = jQuery(window).scrollTop();
            if (scroll > 70) {
                jQuery(".simple-header.stick").addClass("sticky");
            } else {
                jQuery(".simple-header.stick").removeClass("sticky");
            }
        });
    }
    if (jQuery("body div").hasClass("creative-header")) {
        var simple_header_stick;
        if (jQuery(".creative-header").hasClass('stick')) {
            var simple_header_stick = jQuery(".creative-header.stick").offset().top;
        }
        var simple_header_height = jQuery(".creative-header.stick").innerHeight();
        jQuery(".header-wrap").css({
            "height": simple_header_height
        });
        jQuery(window).scroll(function ($) {
            var scroll = jQuery(window).scrollTop();
            if (scroll > 70) {
                jQuery(".creative-header.stick").addClass("sticky");
            } else {
                jQuery(".creative-header.stick").removeClass("sticky");
            }
        });
    }
    if (jQuery("body div").hasClass("transparent-header")) {
        var simple_header_stick;
        if (jQuery(".transparent-header").hasClass('stick')) {
            var simple_header_stick = jQuery(".transparent-header.stick").offset().top;
        }
        jQuery(window).scroll(function ($) {
            var scroll = jQuery(window).scrollTop();
            if (scroll > 70) {
                jQuery(".transparent-header.stick").addClass("sticky");
            } else {
                jQuery(".transparent-header.stick").removeClass("sticky");
            }
        });
    }


    /*=================== Mega Menu ===================*/
    jQuery(".megamenu").parent().addClass("has-megamenu");




    /*=================== Dropdown Anmiation ===================*/
    var drop = jQuery('.menu-links > li > ul > li');
    jQuery('.menu-links > li').each(function () {
        var delay = 0;
        jQuery(this).find(drop).each(function () {
            jQuery(this).css({transitionDelay: delay + 'ms'});
            delay += 50;
        });
    });
    var drop2 = jQuery('.menu-links > li > ul > li >  ul > li');
    jQuery('.menu-links > li > ul > li').each(function () {
        var delay2 = 0;
        jQuery(this).find(drop2).each(function () {
            jQuery(this).css({transitionDelay: delay2 + 'ms'});
            delay2 += 50;
        });
    });



    /*=================== Accordion ===================*/
    jQuery('.toggle .content').hide();
    jQuery('.toggle h3:first').addClass('active').next().slideDown(500).parent().addClass("activate");
    jQuery('.toggle h3').on("click", function () {
        if (jQuery(this).next().is(':hidden')) {
            jQuery('.toggle h3').removeClass('active').next().slideUp(500).removeClass('animated zoomIn').parent().removeClass("activate");
            jQuery(this).toggleClass('active').next().slideDown(500).addClass('animated zoomIn').parent().toggleClass("activate");
        }
    });

    /*=================== Share Link ===================*/
    var share_link = jQuery('.share-link a');
    jQuery('.share-link').each(function () {
        var delay = 0;
        jQuery(this).find(share_link).each(function () {
            jQuery(this).css({transitionDelay: delay + 'ms'});
            delay += 50;
        });
    });


    /*=================== Footer Links ===================*/
    jQuery(".footer-links > a").mouseenter(function () {
        jQuery(".footer-links > a").removeClass("hovered");
        jQuery(this).addClass("hovered");
    });


    /*=================== LightBox ===================*/
    if ($.fn.poptrox !== undefined) {
        var foo = jQuery('.lightbox');
        foo.poptrox({
            usePopupCaption: false,
            usePopupNav: true
        });
    }
    /*=================== Ajax Contact Form ===================*/
    jQuery('#contactform').submit(function () {
        var action = jQuery(this).attr('action');
        jQuery("#message").slideUp(750, function () {
            jQuery('#message').hide();
            jQuery('#submit').after('<img src="' + theme_url + '/assets/assets/ajax-loader.gif" class="loader" />').attr('disabled', 'disabled');
            $.post(action, {
                name: jQuery('#name').val(),
                email: jQuery('#email').val(),
                phone: jQuery('#phone').val(),
                comments: jQuery('#comments').val(),
                verify: jQuery('#verify').val()
            },
                    function (data) {
                        document.getElementById('message').innerHTML = data;
                        jQuery('#message').slideDown('slow');
                        jQuery('#contactform img.loader').fadeOut('slow', function () {
                            jQuery(this).remove();
                        });
                        jQuery('#submit').removeAttr('disabled');
                        if (data.match('success') != null)
                            ;
                        $('#contactform').slideUp('slow');

                    }
            )

                    .fail(function () {
                        alert("error");
                    })
        });

        return false;
    });


    /*=================== Parallax ===================*/
    //jQuery('.parallax').scrolly({bgParallax: true});  

}); /*=== Document.Ready Ends Here ===*/


function like_dislike(postid) {
    jQuery('a#like_dislike').live('click', function () {
        var check = jQuery('a#like_dislike').attr('class');
        if (check === 'like-this ' || check === 'like-this') {
            var data = {
                'action': 'crazyblog_like',
                'postid': postid
            };
            jQuery.post(ajaxurl, data, function (responce) {
                jQuery('a#like_dislike').children().eq(1).empty();
                jQuery('a#like_dislike').children().eq(1).html(responce);
            });
            jQuery(this).addClass('liked');
            jQuery('a#like_dislike').children().eq(0).removeClass('fa fa-heart-o').addClass('fa fa-heart');
        } else {
            var data = {
                'action': 'crazyblog_dis_like',
                'postid': postid
            };
            jQuery.post(ajaxurl, data, function (responce) {
                jQuery('a#like_dislike span').empty();
                jQuery('a#like_dislike span').html(responce);
            });
            jQuery('a#like_dislike').removeClass('liked');
            jQuery('a#like_dislike').children().eq(0).removeClass('fa fa-heart').addClass('fa fa-heart-o');
        }
        return false;
    });
}

jQuery('.form-builder').submit(function () {
    var action = jQuery(this).attr('action');
    var form = this;
    var method = jQuery(this).attr("method");
    if (jQuery(form).children('.message').length) {
        jQuery(form).children('.message').html();
    } else {
        jQuery(form).prepend('<div class="message"></div>');
    }

    jQuery(this).find('.submit')
            .after('<img src="' + theme_url + '/assets/assets/ajax-loader.gif" class="loader" />');
    jQuery.ajax({
        type: method,
        url: action,
        data: jQuery(this).serialize(),
        success: function (res) {
            jQuery(form).find('.message').html(res);
            jQuery(form).find('.message').slideDown('slow');
            jQuery(form).find('.loader').fadeOut('slow', function () {
                jQuery(this).remove();
            });
        }
    });

    return false;

});

jQuery(document).ready(function ($) {
    $('.subscribe-submit').on('click', function () {
        var $this = $(this);
        var parent = $(this).parents('form.subscribtion');
        var email = $(parent).find("input.subscribe-email").val();
        var data = 'email=' + email + '&action=crazyblog_newsletter_module';
        var nf = $(parent).prev('div#comming-soon-notify');
        var notify = $(parent).prev('div#comming-soon-notify').children().children('div.notifications');
        $(notify).empty();
        jQuery.ajax({
            type: "post",
            url: ajaxurl,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $($this).prop('disabled', true);
                $('div#coming-soon-loader').show();
            },
            success: function (res) {
                $($this).prop('disabled', false);
                $('div#coming-soon-loader').fadeOut('slow');
                $(notify).empty();
                $(notify).html(res.msg);
                $(nf).show();
                $(parent).find("input.subscribe-email").val('');
            }
        });
        return false;
    });

    $('form#widget-newsletter button.subscribe-submit').on('click', function () {
        var $this = $(this);
        var parent = $(this).parents('form#widget-newsletter');
        var email = $(parent).find("input.subscribe-email").val();
        var data = 'email=' + email + '&action=crazyblog_newsletter_module';
        var notify = $(parent).prev('div.widget-notify');
        $(notify).empty();
        jQuery.ajax({
            type: "post",
            url: ajaxurl,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $($this).prop('disabled', true);
                $($this).children('i').removeClass().addClass('fa fa-cog');
                $($this).addClass('rotate');
            },
            success: function (res) {
                $($this).prop('disabled', false);
                $($this).children('i').removeClass().addClass('fa fa-envelope');
                $($this).removeClass('rotate');
                $(notify).empty();
                $(notify).html(res.msg);
                $(parent).find("input.subscribe-email").val('');
            }
        });
        return false;
    });


    $('form.footer-newsletter button.subscribe-submit').on('click', function () {
        var $this = $(this);
        var parent = $(this).parents('form.footer-newsletter');
        var email = $(parent).find("input.subscribe-email").val();
        var data = 'email=' + email + '&action=crazyblog_newsletter_module';
        var notify = $(parent).prev('div.notifications');
        $(notify).empty();
        jQuery.ajax({
            type: "post",
            url: ajaxurl,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $($this).prop('disabled', true);
                $($this).addClass('process');
                $($this).children('i').fadeIn('slow');
            },
            success: function (res) {
                $($this).prop('disabled', false);
                $($this).removeClass('process');
                $($this).children('i').fadeOut('slow');
                $(notify).empty();
                $(notify).html(res.msg);
                $(parent).find("input.subscribe-email").val('');
            }
        });
        return false;
    });
});

function initialize_owl(el) {
    el.owlCarousel({
        autoplay: true,
        autoplayTimeout: 2500,
        smartSpeed: 2000,
        loop: true,
        dots: false,
        nav: true,
        margin: 10,
        mouseDrag: true,
        items: 1,
        autoHeight: true,
        singleItem: true
    });
}
function destroy_owl(el) {
    el.owlCarousel('destroy');
}

jQuery(document).ready(function ($) {
    $('div.load-btn a#weekly_posts:not(.ajax_loader), \n\
        div.load-btn a#fashion_posts:not(.ajax_loader), \n\
        div.load-btn a#creative_grid_posts:not(.ajax_loader),\n\
        div.load-btn a#magzine_list:not(.ajax_loader),\n\
        div.load-btn a#creative_grid_posts_masonry:not(.ajax_loader),\n\
        div.load-btn a#simple_recipe_grid:not(.ajax_loader)').live('click', function (e) {
        e.preventDefault();
        var $load_more_btn = $(this);
        var selector = $load_more_btn.attr('data-selector');
        var post_type = $load_more_btn.attr('data-posts');
        var off = $load_more_btn.attr('data-offset');
        var offset = $(selector + ' ' + off).length;
        var limit = $load_more_btn.attr('data-limit');
        var cats = $load_more_btn.attr('data-cats');
        var order = $load_more_btn.attr('data-order');
        var orderby = $load_more_btn.attr('data-orderby');
        var type = $load_more_btn.attr('data-type');
        $.ajax({
            type: "post",
            context: this,
            dataType: "json",
            url: ajaxurl,
            data: {
                action: "crazyblog_ajax_load_more",
                offset: offset,
                post_type: post_type,
                posts_per_page: limit,
                cats: cats,
                order: order,
                orderby: orderby,
                type: type
            },
            beforeSend: function () {
                $load_more_btn.addClass('ajax_loader');
                $('div#loaded').show();
            },
            success: function (response) {
                if (response.have_posts === true) {
                    $load_more_btn.removeClass('ajax_loader');
                    $('div#loaded').hide();
                    var $newElems = $(response['html'].replace(/(\r\n|\n|\r)/gm, ''));
                    if (response.masonry === true) {
                        $(selector).append($newElems).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        jQuery(selector).isotope('destroy');
                        jQuery(selector).isotope();
                    } else {
                        $(selector).append($newElems);
                    }
                } else {
                    $('div#loaded').hide();
                    $load_more_btn.html("<p>No More Posts</p>");
                    //$load_more_btn.remove();
                }
            }
        });
        return false;
    });
});

function infinite_scroll(off, selector, post_type, limt, cat, ord, ordby, typ) {
    var post_type = post_type;
    var offset = jQuery(off).length;
    var limit = limt;
    var cats = cat;
    var order = ord;
    var orderby = ordby;
    jQuery.ajax({
        type: "post",
        context: this,
        dataType: "json",
        url: ajaxurl,
        data: {
            action: "crazyblog_ajax_load_more",
            offset: offset,
            post_type: post_type,
            posts_per_page: limit,
            cats: cats,
            order: order,
            orderby: orderby,
            type: typ
        },
        beforeSend: function () {
            jQuery('div#loaded').addClass('laod_ajax');
            jQuery('div#loaded').show();
        },
        success: function (response) {
            if (response.have_posts === true) {
                jQuery('div#loaded').removeClass('laod_ajax');
                jQuery('div#loaded').hide();
                var $newElems = jQuery(response['html'].replace(/(\r\n|\n|\r)/gm, ''));
                if (response.masonry === true) {
                    jQuery(selector).append($newElems).isotope('reloadItems').isotope({sortBy: 'original-order'});
                } else {
                    jQuery(selector).append($newElems);
                }
            } else {
                jQuery('div#loaded').removeClass('laod_ajax').addClass('infinite_end');
                jQuery('div#loaded').html("<p>No More Posts</p>");
            }
        }
    });
}
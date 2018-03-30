/*
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
*/

jQuery(function($) {

    "use strict";

    /* ================================================
       On Scroll Menu
       ================================================ */

    $(window).scroll(function() {
        if ($(window).scrollTop() > 600) {
            $('.js-reveal-menu').removeClass('reveal-menu-hidden').addClass('reveal-menu-visible');
        } else {
            $('.js-reveal-menu').removeClass('reveal-menu-visible').addClass('reveal-menu-hidden');
        }
    });

    /* ================================================
       Parallax Header
       ================================================ */

    if ($('.parallax-bg').length) {
        $('.parallax-bg').parallax({
            speed: 0.20
        });
    }

    /* ================================================
       FLEX SLIDER
       ================================================ */

    if ($('.blogslider').length) {
        $('.blogslider').flexslider({
            animation: "slide",
            useCSS: Modernizr.touch,
        });
    }
    var cf = jQuery(".cth-flexslider");
    var optionsData = cf.data('options') ? JSON.parse(decodeURIComponent(cf.data('options'))) : {slideshow:true,animation:'fade',direction:'horizontal',smoothHeight:false,slideshowSpeed:7000,controlNav:true,directionNav:true};
    cf.flexslider({
        slideshow: optionsData.slideshow,
        animation: optionsData.animation,
        direction: optionsData.direction,
        smoothHeight: optionsData.smoothHeight,
        slideshowSpeed: optionsData.slideshowSpeed,

        directionNav: optionsData.directionNav,
        controlNav: optionsData.controlNav,
        
    });
    if ($('.blogsingleslider').length) {
        $('.blogsingleslider').flexslider({
            //animation: "slide",
        });
    }

    jQuery('.bg-slideshow-slider').flexslider({
        animation: "fade",
        controlNav: false,  
        directionNav: false, 
    });

    /* ================================================
       Initialize Countdown
       ================================================ */

    /*Fetch Event Date From HTML. For Not tech Savvy Users */
    if($('.countdown').length > 0){
        $('.countdown').each(function(index){
            var $this = $(this);
            var get_date = $this.data('event-date');

            if (get_date) {
                $this.countdown({
                    date: get_date,
                    /*Change date and time in HTML data-event-date attribute */
                    format: "on"
                },function(){
                    console.log('event ended')
                });
            }
        });
    }

    /* ================================================
       Initialize Tabs
       ================================================ */

    $('#schedule-tabs a').on("click",function(e) {
        e.preventDefault()
        $(this).tab('show')
    });

    /* ================================================
       Stat Counter
       ================================================ */

    $('#stats-counter').appear(function() {
        $('.count').countTo({
            refreshInterval: 50
        });
    });

    /* ================================================
       Initialize Slick Slider 
       ================================================ */

    /* 
       SLICK SLIDER
       ------------ */

    if ($('.slick-slider').length) {
        $('.slick-slider').slick({
            pauseOnHover:false,
        });
    }

    /* 
    SPONSORS
    -------- */

    if ($('.sponsor-slider').length) {
        $('.sponsor-slider').slick({
            centerPadding: '30px',
            pauseOnHover:false,
        });
    }
    /* 
       SPEAKERS
       -------- */

    if ($('.speaker-slider').length) {
        $('.speaker-slider').slick({
            pauseOnHover:false,
        });
    }

    /* ================================================
       Scroll Functions
       ================================================ */

    $(window).scroll(function() {
        if ($(window).scrollTop() > 1000) {
            $('.back_to_top').fadeIn('slow');
        } else {
            $('.back_to_top').fadeOut('slow');
        }
    });

    $('nav a[href^="#"]:not([href="#"]), .back_to_top, .custom-scroll-link').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 50
        }, 1500);
        event.preventDefault();
    });

});

    /* ================================================
      Video Gallery
      ================================================ */

    jQuery(".play-video").on("click",function(e) {
        e.preventDefault();
        var videourl = jQuery(this).data("video-url");
        jQuery(this).append('<i class="video-loader fa fa-spinner fa-spin"></i>')
        jQuery('.media-video iframe').attr('src', videourl);
        setTimeout(function() {
            jQuery('.video-loader').remove();
        }, 1000);
    });

    /* ================================================
       Magnific Popup
       ================================================ */
    // if(jQuery('.speaker_link').length){
    
    //     jQuery(".speaker_link").magnificPopup({
    //         type: "inline"
    //     });
    // }
    if(jQuery('.speaker_link').length){
        jQuery(".speaker_link").each(function(){
            $that = jQuery(this);
            $that.magnificPopup({
                items: {
                    src: $that.attr('data-mfp-src'),
                    type: 'inline'
                }
            });
        });
    }
    if (jQuery('.popup-video').length) {
        jQuery(".popup-video").magnificPopup({
            disableOn: 700,
            type: "iframe",
            removalDelay: 600,
            mainClass: "my-mfp-slide-bottom"
        });
    }
    if (jQuery('.popup-gallery').length) {
        jQuery('.popup-gallery').magnificPopup({
            delegate: 'a:not(.popup-video)',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function(element) {
                    return element.find('img');
                }
            }
        });
    }

    /* ================================================
       jQuery Validate - Reset Defaults
       ================================================ */

    jQuery.validator.setDefaults({
        highlight: function(element) {
            jQuery(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            jQuery(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'small',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            }
            if (element.parent('label').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    /* ================================================
       Add to Calendar
       ================================================ */

    (function() {
        if (window.addtocalendar)
            if (typeof window.addtocalendar.start == "function") return;
        if (window.ifaddtocalendar == undefined) {
            window.ifaddtocalendar = 1;
            var d = document,
                s = d.createElement('script'),
                g = 'getElementsByTagName';
            s.type = 'text/javascript';
            s.charset = 'UTF-8';
            s.async = true;
            s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://addtocalendar.com/atc/1.5/atc.min.js';
            var h = d[g]('body')[0];
            h.appendChild(s);
        }
    })();

    /* ================================================
       Twitter Widget
       ================================================ */

    window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));

    jQuery(function($) {

        /* ================================================
           Initialize WOW JS
           ================================================ */

        if ($('body').hasClass('animate-page')) {
            wow = new WOW({
                animateClass: 'animated',
                offset: 100,
                mobile: false
            });
            wow.init();
        }
    });

    jQuery(function($){
        $(".player").YTPlayer();
    });
    /*
     * End $ Function
     * -------------- */

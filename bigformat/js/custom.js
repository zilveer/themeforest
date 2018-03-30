/**
 * Custom Javascript for BigFormat
 *
 * @package WordPress
 * @subpackage Edition
 * @since BigFormat 1.4
 */

// Set jQuery to NoConflict Mode
jQuery.noConflict();

(function ($) {
    "use strict";

    /**
     * Prevents right clicking to protect images
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeProtectImages = function(){
        var $this = $(this);

        // If image protect is turned on
        if ($('body').hasClass('imageprotect')) {
            $this.bind("contextmenu", function(e) {
                e.preventDefault();
            });
        }
    }

    /**
     * Theme Tabs
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeTabs = function(){
        $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
        $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
        $( "#tabs" ).tabs({ fx: { opacity: 'toggle' } });
    }

    /**
     * Full Video Background
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeVideoBackground = function(allVideos){
        var $allVideos  = $(allVideos),
            $fluidEl    = $(this);

        $allVideos.each(function() {
            $(this)
                // jQuery .data does not work on object/embed elements
                .attr('data-aspectRatio', this.height / this.width)
                .removeAttr('height')
                .removeAttr('width');
        });

        $(document).ready(function() {
          var newWidth = $fluidEl.width();

            $allVideos.each(function() {
                var $el = $(this);
                $el
                    .width(newWidth)
                    .height(newWidth * $el.attr('data-aspectRatio'));
            });
        }).resize();

        $(window).resize(function() {
            var newWidth = $fluidEl.width();

            $allVideos.each(function() {
                var $el = $(this);

                $el
                    .width(newWidth)
                    .height(newWidth * $el.attr('data-aspectRatio'));
            });
        }).resize();
    }

    /**
     * Remove Flash Controls/Elements for Flash Browsers
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeFlashControls = function(){
        if (swfobject.hasFlashPlayerVersion("8.0.0")) {
            $('#videocaption .Center').css('z-index', '0');
            $('.videoslide').attr('style', 'display: none !important');
            $('.videowrapper').css('display', 'block');
        }
        else {
            $('#videocaption .Center').css('z-index', '1');
            $('#play-video').remove();
            $('.lines.vimeolines').remove();
        }
    }

    /**
     * Theme Tooltips
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeTooltips = function(){
        $('.tooltip-top').tipsy({
            delayIn: 0,      // delay before showing tooltip (ms)
            delayOut: 0,     // delay before hiding tooltip (ms)
            fade: true,     // fade tooltips in/out?
            fallback: '',    // fallback text to use when no tooltip text
            gravity: 's',    // gravity
            html: false,     // is tooltip content HTML?
            live: false,     // use live event support?
            offset: 5,       // pixel offset of tooltip from element
            opacity: .8,    // opacity of tooltip
            title: 'title',  // attribute/callback containing tooltip text
            trigger: 'hover' // how tooltip is triggered - hover | focus | manual
        });

        $('.tooltip-bottom').tipsy({
            delayIn: 0,      // delay before showing tooltip (ms)
            delayOut: 0,     // delay before hiding tooltip (ms)
            fade: true,     // fade tooltips in/out?
            fallback: '',    // fallback text to use when no tooltip text
            gravity: 'n',    // gravity
            html: false,     // is tooltip content HTML?
            live: false,     // use live event support?
            offset: 5,       // pixel offset of tooltip from element
            opacity: .8,    // opacity of tooltip
            title: 'title',  // attribute/callback containing tooltip text
            trigger: 'hover' // how tooltip is triggered - hover | focus | manual
        });

        $('.tooltip-left').tipsy({
            delayIn: 0,      // delay before showing tooltip (ms)
            delayOut: 0,     // delay before hiding tooltip (ms)
            fade: true,     // fade tooltips in/out?
            fallback: '',    // fallback text to use when no tooltip text
            gravity: 'e',    // gravity
            html: false,     // is tooltip content HTML?
            live: false,     // use live event support?
            offset: 5,       // pixel offset of tooltip from element
            opacity: .8,    // opacity of tooltip
            title: 'title',  // attribute/callback containing tooltip text
            trigger: 'hover' // how tooltip is triggered - hover | focus | manual
        });

        $('.tooltip-right').tipsy({
            delayIn: 0,      // delay before showing tooltip (ms)
            delayOut: 0,     // delay before hiding tooltip (ms)
            fade: true,     // fade tooltips in/out?
            fallback: '',    // fallback text to use when no tooltip text
            gravity: 'w',    // gravity
            html: false,     // is tooltip content HTML?
            live: false,     // use live event support?
            offset: 5,       // pixel offset of tooltip from element
            opacity: .8,    // opacity of tooltip
            title: 'title',  // attribute/callback containing tooltip text
            trigger: 'hover' // how tooltip is triggered - hover | focus | manual
        });
    }

    /**
     * Theme Lightbox
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeLightbox = function(){

        var lighboxSkin = $('body').attr('data-lightbox') ? $('body').attr('data-lightbox') : 'light_square';

        $(this).prettyPhoto({
            animation_speed:       'fast', /* fast/slow/normal */
            slideshow:             5000, /* false OR interval time in ms */
            autoplay_slideshow:    false, /* true/false */
            opacity:               0.80, /* Value between 0 and 1 */
            show_title:            false, /* true/false */
            allow_resize:          true, /* Resize the photos bigger than viewport. true/false */
            default_width:         500,
            default_height:        344,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: lighboxSkin, /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            horizontal_padding: 20, /* The padding on each side of the picture */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
            overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
            callback: function(){}, /* Called when prettyPhoto is closed */
            ie6_fallback: true
        });
    }

    /**
     * Hover Overlays
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeHovers = function(){
        function hover_overlay() {
            $('.portfolioitem a img').each(function() {
                var $this = $(this);

                $this.hover( function() {
                    $this.stop().animate({opacity : 0.1}, 500);
                    $this.parent().find('.thumbnailtitle').fadeIn('500');
                }, function() {
                    $this.stop().animate({opacity : 1}, 500);
                    $this.parent().find('.thumbnailtitle').css('display', 'none');
                });
            });
        }
        hover_overlay();

        function hover_overlay_play() {
            $('#play-button, #videoplaypause').hover( function() {
                $(this).stop().animate({opacity : 1}, 100);
            }, function() {
                $(this).stop().animate({opacity : 0.5}, 100);
            });
        }
        hover_overlay_play();

        function hover_overlay_images() {
            $('a img').not('.portfolioitem a img').hover( function() {
                $(this).stop().animate({opacity : 0.7}, 500);
            }, function() {
                $(this).stop().animate({opacity : 1}, 500);
            });
        }
        hover_overlay_images();
    }

    /**
     * Portfolio Flexible Slider
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeSlideshow = function(){
        var $this       = $(this),
            autoplay    = $this.attr('data-autoplay') ? $this.attr('data-autoplay') : 'true',
            delay       = $this.attr('data-autoplay-delay') ? $this.attr('data-autoplay-delay') : '7000';

        $(this).wmuSlider({
            animation: 'fade',
            animationDuration: 600,
            slideshow: autoplay,
            slideshowSpeed: delay,
            slideToStart: 0,
            navigationControl: true,
            paginationControl: true,
            previousText: 'Previous',
            nextText: 'Next',
            touch: Modernizr.touch,
            slide: 'span'
        });
    }

    /**
     * Scroll To Top
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeTop = function(){
        var top = $(this);

        $(window).scroll(function () {
            var y_scroll_pos    = window.pageYOffset,
                scroll_pos_test = 50;

            if(y_scroll_pos > scroll_pos_test) {
                top.fadeIn(1000);
                jQuery('.iphone').children('.top').css('display', 'none !important');
            } else {
                top.fadeOut(500);
            }
        });

        top.click(function(){
            $('html, body').animate({scrollTop:0}, 500, 'easeOutCubic');
            return false;
        });
    }

    /**
     * Project Information on Project Pages
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeProjectDrawer =  function() {
        var $this = $(this),
            tipsy = $('.tipsy.tipsy-on');

        $this.bind({
            toggleProject: function () {
                $this = $(this);

                $('.projectcontent').fadeToggle(500, 'easeOutCubic', function(){
                    $this.toggleClass("minus");

                    $('#prevslide').toggleClass('fullopen');

                    var $thisclass = $this.hasClass('minus'),
                        $hidetext = $this.attr('data-hidetext'),
                        $showtext = $this.attr('data-showtext');

                    if ($thisclass == true) {
                        $('.tipsy-inner').html($hidetext);
                        $this.attr('title', $hidetext);
                    } else {
                        $('.tipsy-inner').html($showtext);
                        $this.attr('title', $showtext);
                    }
                });
            }
        });

        $this.click(function (e) {
            e.preventDefault();
            $(this).trigger("toggleProject");
        });

        $(window).load(function() {
            tipsy
                .animate({
                    opacity: .8,
                    left: 69
                }, 1000, "easeOutCubic")
                .delay(3000)
                .animate({
                    opacity:0,
                    left:99
                }, 1000, "easeOutCubic", function(){
                    $('.tool-project').hover(
                        function(){
                            tipsy.stop().animate({ opacity: .8, left: 69}, 1000, "easeOutCubic");
                        }, function(){
                            tipsy.stop().animate({ opacity: 0, left: 99}, 1000, "easeOutCubic");
                        }
                    );
            });
        });

        if ($('body').hasClass('show-more')) {
            $('.toggleproject').trigger("toggleProject");
        }
    }

    /**
     * Navigation Drawer on Mobile
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeMobileNav =  function() {
        var button          = $('#top_panel_button'),
            height          = $('#top_panel_content').height(),
            $buttondisplay  = button.css('display');

        if ($buttondisplay = 'none') {
            $('#toggle_button').addClass('downarrow').removeClass('uparrow');
        } else {
            $('#toggle_button').addClass('uparrow').removeClass('downarrow');
        }

        button.click(function() {
            var docHeight       = $(document).height(),
                windowHeight    = $(window).height(),
                scrollPos       = docHeight - windowHeight + height;

            $('#top_panel_content').animate({ height: "toggle"}, 500, 'easeOutCubic');

            $('#toggle_button').toggleClass("downarrow").toggleClass("uparrow");

            $('#top_panel').removeClass('active');

            $(this).addClass('active');
        });

        // Hide home nav drawer
        $(window).load(function() {
            $('.home #top_panel_content')
                .delay(1500)
                .animate({ height: "toggle"}, 500, 'easeOutCubic', function(){
                    $('#toggle_button').toggleClass("downarrow").toggleClass("uparrow");
                    $('#top_panel').removeClass('active');
                    $(this).addClass('active');
                });
        });
    }

    /**
     * Desktop Nav Drawer
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeFullNav =  function() {
        var navhandleinit   = $('.navhandle').css('left'),
            navwidth        = $('.navcontainer').width() + 30,
            mainmargin      = $('.mainbody').css('margin-left'),
            $navnow         = $('.navhandle').css('left'),
            navtray         = $('#thumb-tray').css('left');

        $('.navhandle, #tray-button, .page-template-template-home-php .lines, .single-portfolio .lines').click(function() {
            $('#supersized img').addClass('resize'); //add class for css3 transitions

            var $thisid     = $(this).attr("id"),
                $thisclass  = $(this).attr("class"),
                $navnow     = $('.navhandle').css('left');

            if ($navnow == navhandleinit) {
                if (($thisid == 'tray-button')) {
                    $('#thumb-tray').stop().animate({bottom : 0}, 300);
                }

                $('#prevslide').stop().animate({left: 25 }, 500, 'easeOutCubic');
                $('.navcontainer').stop().animate({ left: -210 }, 500, 'easeOutCubic');
                $('.navhandle').stop().animate({ left: -10 }, 500, 'easeOutCubic');
                $('.mainbody').stop().animate({marginLeft: 10}, 500, 'easeOutCubic', function(){ $('#supersized img').removeClass('resize'); }); //remove css3 transition class after completion
                $('.videowrapper').animate({width: '120%', paddingLeft:0}, 500, 'easeOutCubic');
                $('.nav').fadeOut(500, 'easeOutCubic');
                $('.navhandle').toggleClass("rightarrow");
            } else {
                $('#prevslide').stop().animate({left: 245}, 500, 'easeOutCubic');
                $('.navcontainer').stop().animate({ left: 0 }, 500, 'easeOutCubic');
                $('.navhandle').stop().animate({ left: navhandleinit}, 500, 'easeOutCubic');
                $('.mainbody').stop().animate({marginLeft: 220}, 500, 'easeOutCubic', function(){ $('#supersized img').removeClass('resize'); }); //remove css3 transition class after completion
                $('#thumb-tray').stop().animate({bottom : -$('#thumb-tray').height()}, 300);
                $('.videowrapper').animate({paddingLeft: 220, width: '100%'}, 500, 'easeOutCubic');
                $('.nav').fadeIn(500, 'easeOutCubic');
                $('.navhandle').toggleClass("rightarrow");

                $navnow = navhandleinit;
            }
        });
    }

    /**
     * Show Comments on Click
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichShowComments = function() {
        $(this).click(function(e) {
           if ( $.browser.msie && $.browser.version == '7.0') {
                $('html,body').parent().animate({scrollTop: $('.comments-section').offset().top}, 500, 'easeOutCubic');
            } else {
                $('html,body').animate({scrollTop: $('.comments-section').offset().top}, 500, 'easeOutCubic');
            }

            e.preventDefault();
        });
    }

    /**
     * Veritcally Center Homepage Captions
     * @since v1.4
     * (c) Copyright 2014 Andre Gagnon - http://themewich.com
     */
    $.fn.themewichThemeCenterCaption = function() {
        this.css("position","absolute");
        this.css("top", (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px");
        return this;
    }

    $.fn.themewichThemeIsotope = function() {

        var waitForFinalEvent = (function () {
            var timers = {};
            return function (callback, ms, uniqueId) {
                if (!uniqueId) {
                    uniqueId = "Don't call this twice without a uniqueId";
                }
                if (timers[uniqueId]) {
                    clearTimeout (timers[uniqueId]);
                }
                timers[uniqueId] = setTimeout(callback, ms);
            };
        })();


        /* Jquery Isotope */

        if($.fn.isotope) {
            var $selector = '*';

            $(window).load(function(){
                var $container = $('#portfoliocontainer');

                $container.isotope({
                    // options
                    itemSelector : '.portfoliothumb',
                    layoutMode : 'masonry'
                });

                $(window).resize(function(){
                    waitForFinalEvent(function(){
                      $container.isotope('reLayout');
                    }, 500, "re_Iso");
                });

                // filter items when filter link is clicked
                $('#filters a, a.filtersort').click(function(){
                    $('#filters a').removeClass("active");
                    var $selector = $(this).attr('data-filter');

                        $('#filters a').each(function() {
                        var $filterselect = jQuery(this).attr('data-filter');
                              if ($filterselect == $selector){
                                $(this).addClass("active");
                              }
                          });

                      $container.isotope({ filter: $selector });
                      return false;
                });
            });

            var scrollContainer = $('#portfoliocontainer'),
                finishedText    = scrollContainer.attr('data-finished'),
                loadingText     = scrollContainer.attr('data-loading');

            // Infininte Scroll
            $('#portfoliocontainer').infinitescroll({
                navSelector  : '#nextpost',    // selector for the paged navigation
                nextSelector : '#nextpost a',  // selector for the NEXT link (to page 2)
                itemSelector : '.portfoliothumb',     // selector for all items you'll retrieve
                loading: {
                    finishedMsg: finishedText,
                    img: agAjax.get_template_directory_uri + '/images/loading.gif',
                    msgText: loadingText
                  }
                },
                // call Isotope as a callback
                function( newElements ) {
                    $('#portfoliocontainer').isotope( 'insert', $( newElements ), function(){
                        $('#portfoliocontainer').isotope('reLayout');
                        $('body').themewichThemeHovers();
                        $("a[rel^='prettyPhoto']").themewichThemeLightbox();
                  });
                }
            );


            $('#nextpost a').click(function(){
                $('#portfoliocontainer').infinitescroll('retrieve');
                return false;
            });
        } // if isotope
    }

    $.fn.themewichThemeFixIOS = function() {
        if ((navigator.userAgent.match(/(iPad|iPhone);.*CPU.*OS 4_\d/i))) {
            window.onscroll = function() {
                var $topscroll = window.pageYOffset;
                $('.iphone #navscroll, .iphone #supersized li a, .iphone .lines').stop().animate({top : $topscroll}, 500);
            };
        }
    }

    /**
     * Run Javascript Functions on document ready
     */
    $(document).ready(function(){

	    var $body = $( 'body' );

        $('html').themewichThemeProtectImages(); // Protect Images
        $(".videowrapper").themewichThemeVideoBackground("#vimeofull, #myytplayer"); // Fullscreen video background
        $body.themewichThemeFlashControls(); // Remove flash controls
        $body.themewichThemeTooltips();  // Tooltips
        $body.themewichThemeHovers(); // Hovers
        $('.top').themewichThemeTop(); // Scroll Top
        $('.toggleproject').themewichThemeProjectDrawer(); // Project Drawer
        $('#top_panel_button').themewichThemeMobileNav(); // Mobile Nav
        $body.themewichThemeFullNav(); // Full Nav Nav
        $('.videos').fitVids(); // Fitvids
        $('.comment.button').themewichShowComments(); // Show comments
        $body.themewichThemeIsotope(); // Theme Isotope
        $body.themewichThemeFixIOS(); // Fix iOS Woes

        if($.fn.superfish) {
            $('ul.sf-menu').superfish({ autoArrows:  true }); // Menu
        }
        if($.fn.tabs) {
	        $body.themewichThemeTabs(); // Tabs
        }
        if ($.fn.prettyPhoto) {
            $("a[rel^='prettyPhoto']").themewichThemeLightbox(); // Lightbox
        }
        if ($.fn.wmuSlider) {
            $('.projectslideshow').themewichThemeSlideshow(); // Slideshow
        }
        if ($.fn.validate) {
            $("#contactform").validate(); // Contact form validation
            $("#quickform").validate(); // Quick Contact form validation
            $("#commentsubmit").validate(); // Comment form validation
        }

        $(window).resize(function(){
            $('.Center, .Left, .Right').not('.Right.Top, .Right.Bottom, .Left.Top, .Left.Bottom').themewichThemeCenterCaption();
        });

    });

    /**
     * Run Javascript Functions on window load
     */
    $(window).load(function(){
        $('#thumb-tray').css('display', 'block');
    });

})(jQuery);

/**
 * Custom Youtube Functions
 * @since v1.0
 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
 */
function onYouTubePlayerReady(playerId) {
    document.getElementById('myytplayer').style.width="100%";
    document.getElementById('myytplayer').style.height="100%";

    ytplayer = document.getElementById("myytplayer");
    ytplayer.addEventListener("onStateChange", "onytplayerStateChange");

    $playerState = ytplayer.getPlayerState();  //get initial play state

    if ($playerState == -1 || $playerState == 2 || $playerState == 0) { //if player is unstarted -1, or paused 2 or ended
        jQuery('#play-video').addClass('play'); // Change play button
    } else {
        jQuery('#play-video').removeClass('play'); // Change play button
    }

    /* Play Button */
    jQuery('#play-video').click(function(e) {
        var $playerState = ytplayer.getPlayerState();  //get play state

        if ($playerState == -1 || $playerState == 2 || $playerState == 0) { //if player is unstarted -1, or paused 2 or ended
            ytplayer.playVideo();
        } else {
            ytplayer.pauseVideo();
        }

        $playerState = ytplayer.getPlayerState(); //update player state

        e.preventDefault();
    });
}

function onytplayerStateChange($playerState) {
    if ($playerState == -1 || $playerState == 2 || $playerState == 0) { //if player is unstarted -1, or paused 2 or ended
        jQuery('#play-video').addClass('play'); // Change play button
    } else {
        jQuery('#play-video').removeClass('play'); // Change play button
    }
}

/**
 * Custom Supersized Functions
 * @since v1.0
 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
 */
(function($){

    theme = {

        /* Initial Placement
        ----------------------------*/
        _init : function(){

            // Center Slide Links
            if (api.options.slide_links) $(vars.slide_list).css('margin-left', -$(vars.slide_list).width()/2);

            // Start progressbar if autoplay enabled
            if (api.options.autoplay){
                if (api.options.progress_bar) theme.progressBar();
            }else{
                if ($(vars.play_button).attr('src')) $(vars.play_button).attr("src", vars.image_path + "play-button.png");  // If pause play button is image, swap src
                if (api.options.progress_bar) $(vars.progress_bar).stop().animate({left : -$(window).width()}, 0 ); //  Place progress bar
            }


            /* Thumbnail Tray
            ----------------------------*/
            // Hide tray off screen
            $(vars.thumb_tray).animate({bottom : -$(vars.thumb_tray).height()}, 0 );

            // Make thumb tray proper size
            $(vars.thumb_list).width($('> li', vars.thumb_list).length * $('> li', vars.thumb_list).outerWidth(true));  //Adjust to true width of thumb markers

            // Display total slides
            if ($(vars.slide_total).length){
                $(vars.slide_total).html(api.options.slides.length);
            }


            /* Thumbnail Tray Navigation
            ----------------------------*/
            if (api.options.thumb_links){
                //Hide thumb arrows if not needed
                if ($(vars.thumb_list).width() <= $(vars.thumb_tray).width()){
                    $(vars.thumb_back +','+vars.thumb_forward).fadeOut(0);
                }

                // Thumb Intervals
                vars.thumb_interval = Math.floor($(vars.thumb_tray).width() / $('> li', vars.thumb_list).outerWidth(true)) * $('> li', vars.thumb_list).outerWidth(true);
                vars.thumb_page = 0;

                // Cycle thumbs forward
                $(vars.thumb_forward).click(function(){
                    if (vars.thumb_page - vars.thumb_interval <= -$(vars.thumb_list).width()){
                        vars.thumb_page = 0;
                        $(vars.thumb_list).stop().animate({'left': vars.thumb_page}, {duration:500, easing:'easeOutExpo'});
                    }else{
                        vars.thumb_page = vars.thumb_page - vars.thumb_interval;
                        $(vars.thumb_list).stop().animate({'left': vars.thumb_page}, {duration:500, easing:'easeOutExpo'});
                    }
                });

                // Cycle thumbs backwards
                $(vars.thumb_back).click(function(){
                    if (vars.thumb_page + vars.thumb_interval > 0){
                        vars.thumb_page = Math.floor($(vars.thumb_list).width() / vars.thumb_interval) * -vars.thumb_interval;
                        if ($(vars.thumb_list).width() <= -vars.thumb_page) vars.thumb_page = vars.thumb_page + vars.thumb_interval;
                        $(vars.thumb_list).stop().animate({'left': vars.thumb_page}, {duration:500, easing:'easeOutExpo'});
                    }else{
                        vars.thumb_page = vars.thumb_page + vars.thumb_interval;
                        $(vars.thumb_list).stop().animate({'left': vars.thumb_page}, {duration:500, easing:'easeOutExpo'});
                    }
                });

            }


            /* Navigation Items
            ----------------------------*/
            $(vars.next_slide).click(function() {
                api.nextSlide();
            });

            $(vars.prev_slide).click(function() {
                api.prevSlide();
            });

                // Full Opacity on Hover
                if(jQuery.support.opacity){
                    $(vars.prev_slide +','+vars.next_slide).mouseover(function() {
                       $(this).stop().animate({opacity:1},100);
                    }).mouseout(function(){
                       $(this).stop().animate({opacity:.75},100);
                    });
                }


            if (api.options.thumbnail_navigation){
                // Next thumbnail clicked
                $(vars.next_thumb).click(function() {
                    api.nextSlide();
                });
                // Previous thumbnail clicked
                $(vars.prev_thumb).click(function() {
                    api.prevSlide();
                });
            }

            $(vars.play_button).click(function() {
                api.playToggle();
            });


            /* Thumbnail Mouse Scrub
            ----------------------------*/
            if (api.options.mouse_scrub){
                $(vars.thumb_tray).mousemove(function(e) {
                    var containerWidth = $(vars.thumb_tray).width(),
                        listWidth = $(vars.thumb_list).width();
                    if (listWidth > containerWidth){
                        var mousePos = 1,
                            diff = e.pageX - mousePos;
                        if (diff > 10 || diff < -10) {
                            mousePos = e.pageX;
                            newX = (containerWidth - listWidth) * (e.pageX/containerWidth);
                            diff = parseInt(Math.abs(parseInt($(vars.thumb_list).css('left'))-newX )).toFixed(0);
                            $(vars.thumb_list).stop().animate({'left':newX}, {duration:diff*3, easing:'easeOutExpo'});
                        }
                    }
                });
            }


            /* Window Resize
            ----------------------------*/
            $(window).resize(function(){

                // Delay progress bar on resize
                if (api.options.progress_bar && !vars.in_animation){
                    if (vars.slideshow_interval) clearInterval(vars.slideshow_interval);
                    if (api.options.slides.length - 1 > 0) clearInterval(vars.slideshow_interval);

                    $(vars.progress_bar).stop().animate({left : -$(window).width()}, 0 );

                    if (!vars.progressDelay && api.options.slideshow){
                        // Delay slideshow from resuming so Chrome can refocus images
                        vars.progressDelay = setTimeout(function() {
                                if (!vars.is_paused){
                                    theme.progressBar();
                                    vars.slideshow_interval = setInterval(api.nextSlide, api.options.slide_interval);
                                }
                                vars.progressDelay = false;
                        }, 1000);
                    }
                }

                // Thumb Links
                if (api.options.thumb_links && vars.thumb_tray.length){
                    // Update Thumb Interval & Page
                    vars.thumb_page = 0;
                    vars.thumb_interval = Math.floor($(vars.thumb_tray).width() / $('> li', vars.thumb_list).outerWidth(true)) * $('> li', vars.thumb_list).outerWidth(true);

                    // Adjust thumbnail markers
                    if ($(vars.thumb_list).width() > $(vars.thumb_tray).width()){
                        $(vars.thumb_back +','+vars.thumb_forward).fadeIn('fast');
                        $(vars.thumb_list).stop().animate({'left':0}, 200);
                    }else{
                        $(vars.thumb_back +','+vars.thumb_forward).fadeOut('fast');
                    }

                }
            });


        },


        /* Go To Slide
        ----------------------------*/
        goTo : function(){
            if (api.options.progress_bar && !vars.is_paused){
                $(vars.progress_bar).stop().animate({left : -$(window).width()}, 0 );
                theme.progressBar();
            }
        },

        /* Play & Pause Toggle
        ----------------------------*/
        playToggle : function(state){

            if (state =='play'){
                // If image, swap to pause
                if ($(vars.play_button).attr('src')) $(vars.play_button).attr("src", vars.image_path + "pause-button.png");
                if (api.options.progress_bar && !vars.is_paused) theme.progressBar();
            }else if (state == 'pause'){
                // If image, swap to play
                if ($(vars.play_button).attr('src')) $(vars.play_button).attr("src", vars.image_path + "play-button.png");
                if (api.options.progress_bar && vars.is_paused)$(vars.progress_bar).stop().animate({left : -$(window).width()}, 0 );
            }

        },


        /* Before Slide Transition
        ----------------------------*/
        beforeAnimation : function(direction){
            if (api.options.progress_bar && !vars.is_paused) $(vars.progress_bar).stop().animate({left : -$(window).width()}, 0 );

            /* Update Fields
            ----------------------------*/
            // Update slide caption
            if ($(vars.slide_caption).length){

                if (api.getField('title')) {
                    $(vars.slide_caption).html(api.getField('title')).css({ opacity: 0 });
                    jQuery('.Center, .Left, .Right').not('.Right.Top, .Right.Bottom, .Left.Top, .Left.Bottom').themewichThemeCenterCaption();
                    $(vars.slide_caption).animate({opacity: 1}, 1500, 'easeOutCubic');
                } else {
                $(vars.slide_caption).html('');
                }


            }
            // Update slide number
            if (vars.slide_current.length){
                $(vars.slide_current).html(vars.current_slide + 1);
            }


            // Highlight current thumbnail and adjust row position
            if (api.options.thumb_links){

                $('.current-thumb').removeClass('current-thumb');
                $('li', vars.thumb_list).eq(vars.current_slide).addClass('current-thumb');

                // If thumb out of view
                if ($(vars.thumb_list).width() > $(vars.thumb_tray).width()){
                    // If next slide direction
                    if (direction == 'next'){
                        if (vars.current_slide == 0){
                            vars.thumb_page = 0;
                            $(vars.thumb_list).stop().animate({'left': vars.thumb_page}, {duration:500, easing:'easeOutExpo'});
                        } else if ($('.current-thumb').offset().left - $(vars.thumb_tray).offset().left >= vars.thumb_interval){
                            vars.thumb_page = vars.thumb_page - vars.thumb_interval;
                            $(vars.thumb_list).stop().animate({'left': vars.thumb_page}, {duration:500, easing:'easeOutExpo'});
                        }
                    // If previous slide direction
                    }else if(direction == 'prev'){
                        if (vars.current_slide == api.options.slides.length - 1){
                            vars.thumb_page = Math.floor($(vars.thumb_list).width() / vars.thumb_interval) * -vars.thumb_interval;
                            if ($(vars.thumb_list).width() <= -vars.thumb_page) vars.thumb_page = vars.thumb_page + vars.thumb_interval;
                            $(vars.thumb_list).stop().animate({'left': vars.thumb_page}, {duration:500, easing:'easeOutExpo'});
                        } else if ($('.current-thumb').offset().left - $(vars.thumb_tray).offset().left < 0){
                            if (vars.thumb_page + vars.thumb_interval > 0) return false;
                            vars.thumb_page = vars.thumb_page + vars.thumb_interval;
                            $(vars.thumb_list).stop().animate({'left': vars.thumb_page}, {duration:500, easing:'easeOutExpo'});
                        }
                    }
                }


            }

        },


        /* After Slide Transition
        ----------------------------*/
        afterAnimation : function(){
            if (api.options.progress_bar && !vars.is_paused) theme.progressBar();   //  Start progress bar
        },


        /* Progress Bar
        ----------------------------*/
        progressBar : function(){
            $(vars.progress_bar).stop().animate({left : -$(window).width()}, 0 ).animate({ left:0 }, api.options.slide_interval);
        }


    };


     /* Theme Specific Variables
     ----------------------------*/
     $.supersized.themeVars = {

        // Internal Variables
        progress_delay      :   false,              // Delay after resize before resuming slideshow
        thumb_page          :   false,              // Thumbnail page
        thumb_interval      :   false,              // Thumbnail interval
        image_path          :   agAjax.get_template_directory_uri + '/images/', // Default image path

        // General Elements
        play_button         :   '.linesmobile, #pauseplay',     // Play/Pause button
        next_slide          :   '#nextslide',       // Next slide button
        prev_slide          :   '#prevslide',       // Prev slide button
        next_thumb          :   '#nextthumb',       // Next slide thumb button
        prev_thumb          :   '#prevthumb',       // Prev slide thumb button

        slide_caption       :   '#slidecaption',    // Slide caption
        slide_current       :   '.slidenumber',     // Current slide number
        slide_total         :   '.totalslides',     // Total Slides
        slide_list          :   '#slide-list',      // Slide jump list

        thumb_tray          :   '#thumb-tray',      // Thumbnail tray
        thumb_list          :   '#thumb-list',      // Thumbnail list
        thumb_forward       :   '#thumb-forward',   // Cycles forward through thumbnail list
        thumb_back          :   '#thumb-back',      // Cycles backwards through thumbnail list
        tray_arrow          :   '#tray-arrow',      // Thumbnail tray button arrow
        tray_button         :   '#tray-button',     // Thumbnail tray button

        progress_bar        :   '#progress-bar'     // Progress bar

     };

     /* Theme Specific Options

     ----------------------------*/
     $.supersized.themeOptions = {

        progress_bar        :   1,      // Timer for each slide
        mouse_scrub         :   0       // Thumbnails move with mouse

     };


})(jQuery);

/**
Plugin Name: WP-Ajaxify-Comments
Plugin URI: http://wordpress.org/extend/plugins/wp-ajaxify-comments/
Description: WP-Ajaxify-Comments hooks into your current theme and adds AJAX functionality to the comment form.
Author: Jan Jonas
Author URI: http://janjonas.net
Version: 0.23.1
License: GPLv2
Text Domain: wpac
*/
function wpac_extractBody(html) {
    var regex = new RegExp('<body[^>]*>((.|\n|\r)*)</body>', 'i');
    return jQuery(regex.exec(html)[1]);
}
function wpac_showMessage(message, type) {
    var backgroundColor = "#000";
    if (type == "error") backgroundColor = "#f00";
    if (type == "success") backgroundColor = "#008000";

    jQuery.blockUI({
        message: message,
        fadeIn: 400,
        fadeOut: 400,
        timeout: 1200,
        centerX: true,
        centerY: true,
        css: {
            width: '35px',
            top:            '50%',
            left:           '50%',
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .75,
            color: '#fff',
            fontSize: '12px',
            lineHeight: '22px'
        },
        overlayCSS:  {
        backgroundColor: '#000',
        opacity:         0
    }
    });
}

function ac_resetForm(form) {
    jQuery(form).find('input:text, input:password, input:file, select, textarea').val('');
    jQuery(form).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}

var wpac_debug_errorShown = false;
function wpac_debug(level, message) {

    if (typeof window["console"] === 'undefined') {
        /* if (!wpac_debug_errorShown) alert("console object is undefined, debugging wp-ajaxify-comments is disabled!"); */
        wpac_debug_errorShown = true;
        return;
    }

    var args = jQuery.merge(["[WP-Ajaxify-Comments] " + message], jQuery.makeArray(arguments).slice(2));
    //console[level].apply(console, args);
}

jQuery(document).ready(function() {

    var form = jQuery(jQuery(wpac_options.selectorCommentForm)[0]);
    var commentsContainer = jQuery(jQuery(wpac_options.selectorCommentsContainer)[0]);

    // Debug infos

        wpac_debug("info", "Enabled (Version: %s)", wpac_options.version);
        wpac_debug("info", "Search jQuery... Found: %s", jQuery.fn.jquery);
        if (form.length > 0) {
            wpac_debug("info", "Search comment form ('%s')... Found: %o", wpac_options.selectorCommentForm, form);
        } else {
            wpac_debug("error", "Search comment form ('%s')... Not found", wpac_options.selectorCommentForm);
        }
        if (commentsContainer.length > 0) {
            wpac_debug("info", "Search comments container ('%s')... Found: %o", wpac_options.selectorCommentsContainer, commentsContainer);
        } else {
            wpac_debug("error", "Search comment container ('%s')... Not found", wpac_options.selectorCommentsContainer);
        }


    // Abort initialization
     if (form.length == 0 || commentsContainer.length == 0) return;

    // Intercept comment form submit
    jQuery(wpac_options["selectorCommentForm"]).live("submit", function (event) {

        var form = jQuery(this);

        event.preventDefault();

        wpac_showMessage(wpac_options["textLoading"], "loading");

        jQuery.ajax({
            url: form.attr('action'),
            type: "POST",
            data: form.serialize(),
            success: function (data) {

                var newComments = wpac_extractBody(data).find(wpac_options.selectorCommentsContainer);
                var oldComments = jQuery(wpac_options.selectorCommentsContainer);
                if (oldComments.length > 0 && newComments.length > 0) {
                    // Update comments
                    ac_resetForm(jQuery(form));
                    wpac_showMessage(wpac_options["textPosted"], "success");
                    oldComments.replaceWith(newComments);
                } else {
                    // Fallback (page reload) if something went wrong
                    location.reload();
                }

            },
            error: function (jqXhr, textStatus, errorThrown) {
                var error = wpac_extractBody(jqXhr.responseText).html();
                wpac_showMessage(error, "error");
            }
        });

    });

});
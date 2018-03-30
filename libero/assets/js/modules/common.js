(function($) {
	"use strict";

    var common = {};
    mkd.modules.common = common;

    common.mkdIsTouchDevice = mkdIsTouchDevice;
    common.mkdDisableSmoothScrollForMac = mkdDisableSmoothScrollForMac;
    common.mkdFluidVideo = mkdFluidVideo;
    common.mkdPreloadBackgrounds = mkdPreloadBackgrounds;
    common.mkdPrettyPhoto = mkdPrettyPhoto;
    common.mkdCheckHeaderStyleOnScroll = mkdCheckHeaderStyleOnScroll;
    common.mkdInitParallax = mkdInitParallax;
    common.mkdSmoothScroll = mkdSmoothScroll;
    common.mkdEnableScroll = mkdEnableScroll;
    common.mkdDisableScroll = mkdDisableScroll;
    common.mkdWheel = mkdWheel;
    common.mkdKeydown = mkdKeydown;
    common.mkdPreventDefaultValue = mkdPreventDefaultValue;
    common.mkdOwlSlider = mkdOwlSlider;
    common.mkdInitSelfHostedVideoPlayer = mkdInitSelfHostedVideoPlayer;
    common.mkdSelfHostedVideoSize = mkdSelfHostedVideoSize;
    common.mkdInitBackToTop = mkdInitBackToTop;
    common.mkdBackButtonShowHide = mkdBackButtonShowHide;
    common.mkdSmoothTransition = mkdSmoothTransition;
    

	$(document).ready(function() {
        mkdIsTouchDevice();
        mkdDisableSmoothScrollForMac();
		mkdFluidVideo();
        mkdPreloadBackgrounds();
        mkdPrettyPhoto();
        mkdInitElementsAnimations();
        mkdInitAnchor().init();
        mkdInitVideoBackground();
        mkdInitVideoBackgroundSize();
        mkdSetContentBottomMargin();
        mkdSmoothScroll();
        mkdOwlSlider();
        mkdInitSelfHostedVideoPlayer();
		mkdSelfHostedVideoSize();
        mkdInitBackToTop();
        mkdBackButtonShowHide();
        mkdSmoothTransition();
	});

    $(window).load(function() {
        mkdCheckHeaderStyleOnScroll(); //called on load since all content needs to be loaded in order to calculate row's position right
        mkdInitParallax();
    });

	$(window).resize(function() {
		mkdInitVideoBackgroundSize();
		mkdSelfHostedVideoSize();
	});

    /*
     ** Disable shortcodes animation on appear for touch devices
     */
    function mkdIsTouchDevice() {
        if(Modernizr.touch && !mkd.body.hasClass('mkd-no-animation-on-touch')) {
            mkd.body.addClass('mkd-no-animation-on-touch');
        }
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function mkdDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && mkd.body.hasClass('mkd-smooth-scroll')) {
            mkd.body.removeClass('mkd-smooth-scroll');
        }
    }

	function mkdFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    /**
     * Init Owl Carousel
     */
    function mkdOwlSlider() {

        var sliders = $('.mkd-owl-slider');

        if (sliders.length) {
            sliders.each(function(){

                var slider = $(this);
                slider.owlCarousel({
                    singleItem: true,
                    transitionStyle: 'fadeUp',
                    navigation: true,
                    autoHeight: true,
                    pagination: false,
                    navigationText: [
                        '<span class="mkd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="mkd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });

            });
        }

    }


    /*
     *	Preload background images for elements that have 'mkd-preload-background' class
     */
    function mkdPreloadBackgrounds(){

        $(".mkd-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('mkd-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('mkd-preload-background'); }); //make sure that mkd-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function mkdPrettyPhoto() {
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole
        });
    }

    /*
     *	Check header style on scroll, depending on row settings
     */
    function mkdCheckHeaderStyleOnScroll(){

        if($('[data-mkd_header_style]').length > 0 && mkd.body.hasClass('mkd-header-style-on-scroll')) {

            var waypointSelectors = $('.mkd-full-width-inner > .wpb_row.mkd-section, .mkd-full-width-inner > .mkd-parallax-section-holder, .mkd-container-inner > .wpb_row.mkd-section, .mkd-container-inner > .mkd-parallax-section-holder, .mkd-portfolio-single > .wpb_row.mkd-section');
            var changeStyle = function(element){
                (element.data("mkd_header_style") !== undefined) ? mkd.body.removeClass('mkd-dark-header mkd-light-header').addClass(element.data("mkd_header_style")) : mkd.body.removeClass('mkd-dark-header mkd-light-header').addClass(''+mkd.defaultHeaderStyle);
            };

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'down') { changeStyle($(this.element)); }
            }, { offset: 0});

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'up') { changeStyle($(this.element)); }
            }, { offset: function(){
                return -$(this.element).outerHeight();
            } });
        }
    }

    /*
     *	Start animations on elements
     */
    function mkdInitElementsAnimations(){

        var touchClass = $('.mkd-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.mkd-grow-in, .mkd-fade-in-down, .mkd-element-from-fade, .mkd-element-from-left, .mkd-element-from-right, .mkd-element-from-top, .mkd-element-from-bottom, .mkd-flip-in, .mkd-x-rotate, .mkd-z-rotate, .mkd-y-translate, .mkd-fade-in, .mkd-fade-in-left-x-rotate'),
            clasess,
            animationClass;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        var animationClasses = ['mkd-grow-in', 'mkd-fade-in-down', 'mkd-element-from-fade', 'mkd-element-from-left', 'mkd-element-from-right', 'mkd-element-from-top', 'mkd-element-from-bottom', 'mkd-flip-in', 'mkd-x-rotate', 'mkd-z-rotate', 'mkd-y-translate', 'mkd-fade-in', 'mkd-fade-in-left-x-rotate'];

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
                var element = $(this);

                clasess = element.attr('class').split(/\s+/);
                if(animationClasses.indexOf(clasess[0]) !== -1){
                	animationClass = clasess[0];
                }
                else{
                	animationClass = clasess[1];
                }

                element.appear(function() {
                    element.addClass(animationClass+'-on');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            });
        }

    }


/*
 **	Sections with parallax background image
 */
function mkdInitParallax(){

    if($('.mkd-parallax-section-holder').length){
        $('.mkd-parallax-section-holder').each(function() {

            var parallaxElement = $(this);
            if(parallaxElement.hasClass('mkd-full-screen-height-parallax')){
                parallaxElement.height(mkd.windowHeight);
                parallaxElement.find('.mkd-parallax-content-outer').css('padding',0);
            }
            parallaxElement.css({opacity:1});
            var speed = parallaxElement.data('mkd-parallax-speed')*0.4;
            parallaxElement.parallax("50%", speed);
        });
    }
}

/*
 **	Anchor functionality
 */
var mkdInitAnchor = mkd.modules.common.mkdInitAnchor = function() {

    /**
     * Set active state on clicked anchor
     * @param anchor, clicked anchor
     */
    var setActiveState = function(anchor){

        $('.mkd-main-menu .mkd-active-item, .mkd-mobile-nav .mkd-active-item, .mkd-vertical-menu .mkd-active-item').removeClass('mkd-active-item');
        anchor.parent().addClass('mkd-active-item');

        $('.mkd-main-menu a, .mkd-mobile-nav a, .mkd-vertical-menu a').removeClass('current');
        anchor.addClass('current');
    };

    /**
     * Check anchor active state on scroll
     */
    var checkActiveStateOnScroll = function(){

        $('[data-mkd-anchor]').waypoint( function(direction) {
            if(direction === 'down') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkd-anchor")+"']"));
            }
        }, { offset: '50%' });

        $('[data-mkd-anchor]').waypoint( function(direction) {
            if(direction === 'up') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkd-anchor")+"']"));
            }
        }, { offset: function(){
            return -($(this.element).outerHeight() - 150);
        } });

    };

    /**
     * Check anchor active state on load
     */
    var checkActiveStateOnLoad = function(){
        var hash = window.location.hash.split('#')[1];

        if(hash !== "" && $('[data-mkd-anchor="'+hash+'"]').length > 0){
            //triggers click which is handled in 'anchorClick' function
            $("a[href='"+window.location.href.split('#')[0]+"#"+hash).trigger( "click" );
        }
    };

    /**
     * Calculate header height to be substract from scroll amount
     * @param anchoredElementOffset, anchorded element offest
     */
    var headerHeihtToSubtract = function(anchoredElementOffset){

        if(mkd.modules.header.behaviour == 'mkd-sticky-header-on-scroll-down-up') {
            (anchoredElementOffset > mkd.modules.header.stickyAppearAmount) ? mkd.modules.header.isStickyVisible = true : mkd.modules.header.isStickyVisible = false;
        }

        if(mkd.modules.header.behaviour == 'mkd-sticky-header-on-scroll-up') {
            (anchoredElementOffset > mkd.scroll) ? mkd.modules.header.isStickyVisible = false : '';
        }

        var headerHeight = mkd.modules.header.isStickyVisible ? mkdGlobalVars.vars.mkdStickyHeaderTransparencyHeight : mkdPerPageVars.vars.mkdHeaderTransparencyHeight;

        return headerHeight;
    };

    /**
     * Handle anchor click
     */
    var anchorClick = function() {
        mkd.document.on("click", ".mkd-main-menu a, .mkd-vertical-menu a, .mkd-btn, .mkd-anchor,.mkd-mobile-nav a", function() {
            var scrollAmount;
            var anchor = $(this);
            var hash = anchor.prop("hash").split('#')[1];

            if(hash !== "" && $('[data-mkd-anchor="' + hash + '"]').length > 0 && anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]) {

                var anchoredElementOffset = $('[data-mkd-anchor="' + hash + '"]').offset().top;
                scrollAmount = $('[data-mkd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                setActiveState(anchor);

                mkd.html.stop().animate({
                    scrollTop: Math.round(scrollAmount)
                }, 1000, function() {
                    //change hash tag in url
                    if(history.pushState) { history.pushState(null, null, '#'+hash); }
                });
                return false;
            }
        });
    };

    return {
        init: function() {
            if($('[data-mkd-anchor]').length) {
                anchorClick();
                checkActiveStateOnScroll();
                $(window).load(function() { checkActiveStateOnLoad(); });
            }
        }
    };

};

/*
 **	Video background initialization
 */
function mkdInitVideoBackground(){

    $('.mkd-section .mkd-video-wrap .mkd-video').mediaelementplayer({
        enableKeyboard: false,
        iPadUseNativeControls: false,
        pauseOtherPlayers: false,
        // force iPhone's native controls
        iPhoneUseNativeControls: false,
        // force Android's native controls
        AndroidUseNativeControls: false
    });

    //mobile check
    if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
        mkdInitVideoBackgroundSize();
        $('.mkd-section .mkd-mobile-video-image').show();
        $('.mkd-section .mkd-video-wrap').remove();
    }
}

    /*
     **	Calculate video background size
     */
    function mkdInitVideoBackgroundSize(){

        $('.mkd-section .mkd-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.mkd-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.mkd-section').outerHeight();
            mkd.minVideoWidth = mkd.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / mkd.videoWidthOriginal;
            var scaleV = sectionHeight / mkd.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * mkd.videoWidthOriginal < mkd.minVideoWidth) {scale = mkd.minVideoWidth / mkd.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * mkd.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * mkd.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
            element.addClass('mkd-video-visible');
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function mkdSetContentBottomMargin(){
        var uncoverFooter = $('.mkd-footer-uncover');
        var content = $('.mkd-content');

        if(uncoverFooter.length && mkd.windowWidth > 600){
            content.waitForImages(function() {
                content.css('margin-bottom', $('.mkd-footer-inner').height());
            });
        }
    }

	/*
	** Initiate Smooth Scroll
	*/
	function mkdSmoothScroll(){

		if(mkd.body.hasClass('mkd-smooth-scroll')){

			var scrollTime = 0.4;			//Scroll time
			var scrollDistance = 300;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll

			var mobile_ie = -1 !== navigator.userAgent.indexOf("IEMobile");

			var smoothScrollListener = function(event){
				event.preventDefault();

				var delta = event.wheelDelta / 120 || -event.detail / 3;
				var scrollTop = mkd.window.scrollTop();
				var finalScroll = scrollTop - parseInt(delta * scrollDistance);

				TweenLite.to(mkd.window, scrollTime, {
					scrollTo: {
						y: finalScroll, autoKill: !0
					},
					ease: Power1.easeOut,
					autoKill: !0,
					overwrite: 5
				});
			};

			if (!$('html').hasClass('touch') && !mobile_ie) {
				if (window.addEventListener) {
					window.addEventListener('mousewheel', smoothScrollListener, false);
					window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
				}
			}
		}
	}

    function mkdDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', mkdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = mkdWheel;
        document.onkeydown = mkdKeydown;

        if(mkd.body.hasClass('mkd-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', mkdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(mkd.body.hasClass('mkd-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdWheel(e) {
        mkdPreventDefaultValue(e);
    }

    function mkdKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                mkdPreventDefaultValue(e);
                return;
            }
        }
    }

    function mkdPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function mkdInitSelfHostedVideoPlayer() {

        var players = $('.mkd-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function mkdSelfHostedVideoSize(){

		$('.mkd-self-hosted-video-holder .mkd-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.mkd-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / mkd.videoRatio;

			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				thisVideo.parent().width(videoWidth);
				thisVideo.parent().height(videoHeight);
			}

			thisVideo.width(videoWidth);
			thisVideo.height(videoHeight);

			thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
			thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
		});
	}

    function mkdToTopButton(a) {
        
        var b = $("#mkd-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function mkdBackButtonShowHide(){
        mkd.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { mkdToTopButton('off'); } else { mkdToTopButton('on'); }
        });
    }

    function mkdInitBackToTop(){
        var backToTopButton = $('#mkd-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            mkd.html.animate({scrollTop: 0}, mkd.window.scrollTop()/3, 'linear');
        });
    }

    /**
     *	Floating Background Script - end
     */

    function mkdSmoothTransition() {

        if (mkd.body.hasClass('mkd-smooth-page-transitions')) {
            $(window).bind("pageshow", function(event) {
                if (event.originalEvent.persisted) {
                    $('.mkd-wrapper-inner').fadeIn(0);
                }
            });
            $('a').click(function(e) {
                var a = $(this);
                if (
                    e.which == 1 && // check if the left mouse button has been pressed
                    (typeof a.data('rel') === 'undefined') && //Not pretty photo link
                    (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                    a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
                    (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') // check if the link opens in the same window
                ) {
                    e.preventDefault();
                    $('.mkd-wrapper-inner').fadeOut(1000, function() {
                        window.location = a.attr('href');
                    });
                }
            });
        }
    }

})(jQuery);



(function($) {
    "use strict";

    window.mkd = {};
    mkd.modules = {};

    mkd.scroll = 0;
    mkd.window = $(window);
    mkd.document = $(document);
    mkd.windowWidth = $(window).width();
    mkd.windowHeight = $(window).height();
    mkd.body = $('body');
    mkd.html = $('html, body');
    mkd.menuDropdownHeightSet = false;
    mkd.defaultHeaderStyle = '';
    mkd.minVideoWidth = 1500;
    mkd.videoWidthOriginal = 1280;
    mkd.videoHeightOriginal = 720;
    mkd.videoRatio = 1280/720;

    //set boxed layout width variable for various calculations

    switch(true){
        case mkd.body.hasClass('mkd-grid-1300'):
            mkd.boxedLayoutWidth = 1350;
            break;
        case mkd.body.hasClass('mkd-grid-1200'):
            mkd.boxedLayoutWidth = 1250;
            break;
        case mkd.body.hasClass('mkd-grid-1000'):
            mkd.boxedLayoutWidth = 1050;
            break;
        case mkd.body.hasClass('mkd-grid-800'):
            mkd.boxedLayoutWidth = 850;
            break;
        default :
            mkd.boxedLayoutWidth = 1150;
            break;
    }
    
    $(document).ready(function(){
        mkd.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(mkd.body.hasClass('mkd-dark-header')){ mkd.defaultHeaderStyle = 'mkd-dark-header';}
        if(mkd.body.hasClass('mkd-light-header')){ mkd.defaultHeaderStyle = 'mkd-light-header';}

    });


    $(window).resize(function() {
        mkd.windowWidth = $(window).width();
        mkd.windowHeight = $(window).height();
    });


    $(window).scroll(function(){
        mkd.scroll = $(window).scrollTop();
    });



})(jQuery);
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



(function($) {
    "use strict";

    var header = {};
    mkd.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.mkdSideArea = mkdSideArea;
    header.mkdSideAreaScroll = mkdSideAreaScroll;
    header.mkdInitMobileNavigation = mkdInitMobileNavigation;
    header.mkdMobileHeaderBehavior = mkdMobileHeaderBehavior;
    header.mkdSetDropDownMenuPosition = mkdSetDropDownMenuPosition;
    header.mkdDropDownMenu = mkdDropDownMenu;
    header.mkdSearch = mkdSearch;

    $(document).ready(function() {
        mkdHeaderBehaviour();
        mkdSideArea();
        mkdSideAreaScroll();
        mkdInitMobileNavigation();
        mkdMobileHeaderBehavior();
        mkdSetDropDownMenuPosition();
        mkdDropDownMenu();
        mkdSearch();
    });

    $(window).load(function() {
        mkdSetDropDownMenuPosition();
        mkdFollowHover();
    });

    $(window).resize(function() {
        mkdDropDownMenu();
    });

    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdHeaderBehaviour() {

        var header = $('.mkd-page-header');
        var stickyHeader = $('.mkd-sticky-header');
        var fixedHeaderWrapper = $('.mkd-fixed-wrapper');

        var headerMenuAreaOffset = $('.mkd-page-header').find('.mkd-fixed-wrapper').length ? $('.mkd-page-header').find('.mkd-fixed-wrapper').offset().top : null;

        var stickyAppearAmount;


        switch(true) {
            // sticky header that will be shown when user scrolls up
            case mkd.body.hasClass('mkd-sticky-header-on-scroll-up'):
                mkd.modules.header.behaviour = 'mkd-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = mkdGlobalVars.vars.mkdTopBarHeight + mkdGlobalVars.vars.mkdLogoAreaHeight + mkdGlobalVars.vars.mkdMenuAreaHeight + mkdGlobalVars.vars.mkdStickyHeaderHeight;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkd.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.mkd-main-menu .second').removeClass('mkd-drop-down-start');
                    }else {
                        mkd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case mkd.body.hasClass('mkd-sticky-header-on-scroll-down-up'):
                mkd.modules.header.behaviour = 'mkd-sticky-header-on-scroll-down-up';
                stickyAppearAmount = mkdPerPageVars.vars.mkdStickyScrollAmount !== 0 ? mkdPerPageVars.vars.mkdStickyScrollAmount : mkdGlobalVars.vars.mkdTopBarHeight + mkdGlobalVars.vars.mkdLogoAreaHeight + mkdGlobalVars.vars.mkdMenuAreaHeight;
                mkd.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic
                
                var headerAppear = function(){
                    if(mkd.scroll < stickyAppearAmount) {
                        mkd.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkd-main-menu .second').removeClass('mkd-drop-down-start');
                    }else{
                        mkd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case mkd.body.hasClass('mkd-fixed-on-scroll'):
                mkd.modules.header.behaviour = 'mkd-fixed-on-scroll';
                var headerFixed = function(){
                    if(mkd.scroll < headerMenuAreaOffset){
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom',0);}
                    else{
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom',fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function mkdSideArea() {

        var wrapper = $('.mkd-wrapper'),
            sideMenu = $('.mkd-side-menu'),
            sideMenuButtonOpen = $('a.mkd-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (mkd.body.hasClass('mkd-side-menu-slide-from-right')) {

            cssClass = 'mkd-right-side-menu-opened';
            wrapper.prepend('<div class="mkd-cover"/>');
            slideFromRight = true;

        } else if (mkd.body.hasClass('mkd-side-menu-slide-with-content')) {

            cssClass = 'mkd-side-menu-open';
            slideWithContent = true;

        } else if (mkd.body.hasClass('mkd-side-area-uncovered-from-content')) {

            cssClass = 'mkd-right-side-menu-opened';
            slideUncovered = true;

        }

        $('a.mkd-side-menu-button-opener, a.mkd-close-side-menu').click( function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                mkd.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.mkd-wrapper .mkd-cover').click(function() {
                        mkd.body.removeClass('mkd-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility' : 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {
                    if(Math.abs(mkd.scroll - currentScroll) > 400){
                        mkd.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function(){
                                sideMenu.css({'visibility':'hidden'});
                                clearTimeout(hideSideMenu);
                            },400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                mkd.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function(){
                        sideMenu.css({'visibility':'hidden'});
                        clearTimeout(hideSideMenu);
                    },400);
                }

            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.click(function() {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    mkd.body.removeClass('mkd-side-menu-open');
                });

            }

        });

    }

    /*
     **  Smooth scroll functionality for Side Area
     */
    function mkdSideAreaScroll(){

        var sideMenu = $('.mkd-side-menu');

        if(sideMenu.length){
            sideMenu.niceScroll({
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            });
        }
    }

    function mkdInitMobileNavigation() {
        var navigationOpener = $('.mkd-mobile-header .mkd-mobile-menu-opener');
        var navigationHolder = $('.mkd-mobile-header .mkd-mobile-nav');
        var dropdownOpener = $('.mkd-mobile-nav .mobile_arrow, .mkd-mobile-nav h4, .mkd-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                	navigationOpener.removeClass('mkd-mobile-active');
                    navigationHolder.slideUp(animationSpeed);
                } else {
                	navigationOpener.addClass('mkd-mobile-active');
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
				    var dropdownToOpen = $(this).nextAll('ul').first();

				    if(dropdownToOpen.length) {
					    e.preventDefault();
					    e.stopPropagation();

					    var openerParent = $(this).parent('li');
					    if(dropdownToOpen.is(':visible')) {
						    dropdownToOpen.slideUp(animationSpeed);
						    openerParent.removeClass('mkd-opened');
					    } else {
						    dropdownToOpen.slideDown(animationSpeed);
						    openerParent.addClass('mkd-opened');
					    }
				    }

			    });
            });
        }

        $('.mkd-mobile-nav a, .mkd-mobile-logo-wrapper a').on('click tap', function() {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function mkdMobileHeaderBehavior() {
        if(mkd.body.hasClass('mkd-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var mobileHeader = $('.mkd-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('mkd-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('mkd-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.mkd-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);

                    //if(adminBar.length) {
                    //    mobileHeader.find('.mkd-mobile-header-inner').css('top', adminBarHeight);
                    //}
                }

                docYScroll1 = $(document).scrollTop();
            });
        }

    }


    /**
     * Set dropdown position
     */
    function mkdSetDropDownMenuPosition(){

        var menuItems = $(".mkd-drop-down > ul > li.narrow");
        menuItems.each( function() {

            var browserWidth = mkd.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(mkd.body.hasClass('boxed')){
                menuItemFromLeft = mkd.boxedLayoutWidth  - (menuItemPosition - (browserWidth - mkd.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });

    }


    function mkdDropDownMenu() {

        var menu_items = $('.mkd-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });
                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end
                }

                if(!mkd.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(mkd.body.hasClass('mkd-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '1'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height')
                            }, 200, 'easeInSine' , function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 0, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('mkd-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('mkd-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
        $('.mkd-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which == 1){
				var $this = $(this);
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
        });

        mkd.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function mkdSearch() {

        var searchOpener = $('a.mkd-search-opener'),
            searchClose,
            searchForm,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( mkd.body.hasClass( 'mkd-fullscreen-search' ) ) {

                var fullscreenSearchFade = false,
                    fullscreenSearchFromCircle = false;

                searchClose = $( '.mkd-fullscreen-search-close' );

                if (mkd.body.hasClass('mkd-search-fade')) {
                    fullscreenSearchFade = true;
                } else if (mkd.body.hasClass('mkd-search-from-circle')) {
                    fullscreenSearchFromCircle = true;
                }
                mkdFullscreenSearch( fullscreenSearchFade, fullscreenSearchFromCircle );

            } else if ( mkd.body.hasClass( 'mkd-search-slides-from-window-top' ) ) {

                searchForm = $('.mkd-search-slide-window-top');
                searchClose = $('.mkd-search-close');
                mkdSearchWindowTop();

            } else if ( mkd.body.hasClass( 'mkd-search-slides-from-header-bottom' ) ) {

                mkdSearchHeaderBottom();

            } else if ( mkd.body.hasClass( 'mkd-search-covers-header' ) ) {

                mkdSearchCoversHeader();

            }

            //Check for hover color of search
            if(typeof searchOpener.data('hover-color') !== 'undefined') {
                var changeSearchColor = function(event) {
                    event.data.searchOpener.css('color', event.data.color);
                };

                var originalColor = searchOpener.css('color');
                var hoverColor = searchOpener.data('hover-color');

                searchOpener.on('mouseenter', { searchOpener: searchOpener, color: hoverColor }, changeSearchColor);
                searchOpener.on('mouseleave', { searchOpener: searchOpener, color: originalColor }, changeSearchColor);
            }

        }

        /**
         * Search slides from window top type of search
         */
        function mkdSearchWindowTop() {

            searchOpener.click( function(e) {
                e.preventDefault();

                var yPos;

                if($('.title').hasClass('has_parallax_background')){
                    yPos = parseInt($('.title.has_parallax_background').css('backgroundPosition').split(" ")[1]);
                }else {
                    yPos = 0;
                }
                if ( searchForm.height() == "0") {
                    $('.mkd-search-slide-window-top input[type="text"]').focus();
                    //Push header bottom
                    mkd.body.addClass('mkd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos + 50)+'px'
                    }, 150);
                } else {
                    mkd.body.removeClass('mkd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos - 50)+'px'
                    }, 150);
                }

                $(window).scroll(function() {
                    if ( searchForm.height() != '0' && mkd.scroll > 50 ) {
                        mkd.body.removeClass('mkd-search-open');
                        $('.title.has_parallax_background').css('backgroundPosition', 'center '+(yPos)+'px');
                    }
                });

                searchClose.click(function(e){
                    e.preventDefault();
                    mkd.body.removeClass('mkd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos)+'px'
                    }, 150);
                });

            });
        }

        /**
         * Search slides from header bottom type of search
         */
        function mkdSearchHeaderBottom() {

            var searchInput = $('.mkd-search-slide-header-bottom input[type="submit"]');

            searchOpener.click( function(e) {
                e.preventDefault();

                //If there is form openers in multiple widgets, only one search form should be opened
                if ( $(this).closest('.mkd-mobile-header').length > 0 ) {
                    //    Open form in mobile header
                    searchForm = $(this).closest('.mkd-mobile-header').children().children().first();
                } else if ( $(this).closest('.mkd-sticky-header').length > 0 ) {
                    //    Open form in sticky header
                    searchForm= $(this).closest('.mkd-sticky-header').children().first();
                } else {
                    //Open first form in header
                    searchForm = $('.mkd-search-slide-header-bottom').first();
                }

                if( searchForm.hasClass( 'mkd-animated' ) ) {
                    searchForm.removeClass('mkd-animated');
                } else {
                    searchForm.addClass('mkd-animated');
                }

                searchForm.addClass('mkd-disabled');
                searchInput.attr('disabled','mkd-disabled');
                if( ( $('.mkd-search-slide-header-bottom .mkd-search-field').val() !== '' ) && ( $('.mkd-search-slide-header-bottom .mkd-search-field').val() !== ' ' ) ) {
                    searchInput.removeAttr('mkd-disabled');
                    searchForm.removeClass('mkd-disabled');
                } else {
                    searchForm.addClass('mkd-disabled');
                    searchInput.attr('disabled','mkd-disabled');
                }

                $('.mkd-search-slide-header-bottom .mkd-search-field').keyup(function() {
                    if( ($(this).val() !== '' ) && ( $(this).val() != ' ') ) {
                        searchInput.removeAttr('mkd-disabled');
                        searchForm.removeClass('mkd-disabled');
                    }
                    else {
                        searchInput.attr('disabled','mkd-disabled');
                        searchForm.addClass('mkd-disabled');
                    }
                });

                $('.content, footer').click(function(e){
                    e.preventDefault();
                    searchForm.removeClass('mkd-animated');
                });

            });

            //Submit form
            if($('.mkd-search-submit').length) {
                $('.mkd-search-submit').click(function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    searchForm.submit();
                });
            }
        }

        /**
         * Search covers header type of search
         */
        function mkdSearchCoversHeader() {

            var searchFormSubmit = $('.mkd-search-submit');

            searchOpener.click( function(e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.mkd-search-cover .mkd-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid


                //for search in right of menu area or logo
                searchForm = $(this).parents('.mkd-page-header').children('.mkd-menu-area').children('.mkd-grid').children().first();
                searchFormLandmark = searchForm.parent();

                if ( $(this).closest('.mkd-sticky-header').length > 0 ) {
                    searchForm = $(this).closest('.mkd-sticky-header').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                if ( $(this).closest('.mkd-mobile-header').length > 0 ) {
                    searchForm = $(this).closest('.mkd-mobile-header').children().children().first();
                    searchFormLandmark = searchForm.parent();
                }

                //Find search form position in header and height
                if ( searchFormLandmark.parent().hasClass('mkd-logo-area') ) {
                    searchFormHeight = mkdGlobalVars.vars.mkdLogoAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('mkd-top-bar') ) {
                    searchFormHeight = mkdGlobalVars.vars.mkdTopBarHeight;
                } else if ( searchFormLandmark.parent().hasClass('mkd-menu-area') ) {
                    searchFormHeight = mkdGlobalVars.vars.mkdMenuAreaHeight;
                } else if ( searchFormLandmark.hasClass('mkd-sticky-header') ) {
                    searchFormHeight = mkdGlobalVars.vars.mkdStickyHeight;
                } else if ( searchFormLandmark.parent().hasClass('mkd-mobile-header') ) {
                    searchFormHeight = $('.mkd-mobile-header-inner').height();
                }

                searchFormHolder.height(searchFormHeight);
                searchForm.stop(true).fadeIn(600);
                $('.mkd-search-cover input[type="text"]').focus();
                $('.mkd-search-close, .content, footer').click(function(e){
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(450);
                });
                searchForm.blur(function() {
                    searchForm.stop(true).fadeOut(450);
                });
            });


            //Submit form
			if(searchFormSubmit.length) {
				searchFormSubmit.each(function(){
					var searchFormSubmitThis = $(this);
					searchFormSubmitThis.click(function(e) {
						e.preventDefault();
						e.stopPropagation();
						searchFormSubmitThis.closest('.mkd-search-cover').submit();
					});
				});
			}


        }

        /**
         * Fullscreen search (two types: fade and from circle)
         */
        function mkdFullscreenSearch( fade, fromCircle ) {

            var searchHolder = $( '.mkd-fullscreen-search-holder'),
                searchOverlay = $( '.mkd-fullscreen-search-overlay' );

            searchOpener.click( function(e) {
                e.preventDefault();
                var samePosition = false;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    var closeTop = $(this).children().first().offset().top;
                    var closeHeight = $(this).children().first().css('height');
                    var closeLeft = $(this).offset().left;
                    samePosition = true;
                }

                //Fullscreen search fade
                if ( fade ) {
                    if ( searchHolder.hasClass( 'mkd-animate' ) ) {
                        mkd.body.removeClass('mkd-fullscreen-search-opened');
                        mkd.body.addClass( 'mkd-search-fade-out' );
                        mkd.body.removeClass( 'mkd-search-fade-in' );
                        searchHolder.removeClass( 'mkd-animate' );
                        if(!mkd.body.hasClass('page-template-full_screen-php')){
                            mkd.modules.common.mkdEnableScroll();
                        }
                    } else {
                        mkd.body.addClass('mkd-fullscreen-search-opened');
                        mkd.body.removeClass('mkd-search-fade-out');
                        mkd.body.addClass('mkd-search-fade-in');
                        searchHolder.addClass('mkd-animate');
                        if (samePosition) {
                            searchClose.css({
                                'top' : closeTop - mkd.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                'left' : closeLeft,
                                'height': closeHeight,
                                'line-height': closeHeight
                            });
                        }
                        if(!mkd.body.hasClass('page-template-full_screen-php')){
                            mkd.modules.common.mkdDisableScroll();
                        }
                    }
                    searchClose.click( function(e) {
                        e.preventDefault();
                        mkd.body.removeClass('mkd-fullscreen-search-opened');
                        searchHolder.removeClass('mkd-animate');
                        mkd.body.removeClass('mkd-search-fade-in');
                        mkd.body.addClass('mkd-search-fade-out');
                        if(!mkd.body.hasClass('page-template-full_screen-php')){
                            mkd.modules.common.mkdEnableScroll();
                        }
                    });
                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            mkd.body.removeClass('mkd-fullscreen-search-opened');
                            searchHolder.removeClass('mkd-animate');
                            mkd.body.removeClass('mkd-search-fade-in');
                            mkd.body.addClass('mkd-search-fade-out');
                            if(!mkd.body.hasClass('page-template-full_screen-php')){
                                mkd.modules.common.mkdEnableScroll();
                            }
                        }
                    });
                }
                //Fullscreen search from circle
                if ( fromCircle ) {
                    if( searchOverlay.hasClass('mkd-animate') ) {
                        searchOverlay.removeClass('mkd-animate');
                        searchHolder.css({
                            'opacity': 0,
                            'display':'none'
                        });
                        searchClose.css({
                            'opacity' : 0,
                            'visibility' : 'hidden'
                        });
                        searchOpener.css({
                            'opacity': 1
                        });
                    } else {
                        searchOverlay.addClass('mkd-animate');
                        searchHolder.css({
                            'display':'block'
                        });
                        setTimeout(function(){
                            searchHolder.css('opacity','1');
                            searchClose.css({
                                'opacity' : 1,
                                'visibility' : 'visible',
                                'top' : closeTop - mkd.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                'left' : closeLeft
                            });
                            if (samePosition) {
                                searchClose.css({
                                    'top' : closeTop - mkd.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                    'left' : closeLeft
                                });
                            }
                            searchOpener.css({
                                'opacity' : 0
                            });
                        },200);
                        if(!mkd.body.hasClass('page-template-full_screen-php')){
                            mkd.modules.common.mkdDisableScroll();
                        }
                    }
                    searchClose.click(function(e) {
                        e.preventDefault();
                        searchOverlay.removeClass('mkd-animate');
                        searchHolder.css({
                            'opacity' : 0,
                            'display' : 'none'
                        });
                        searchClose.css({
                            'opacity':0,
                            'visibility' : 'hidden'
                        });
                        searchOpener.css({
                            'opacity' : 1
                        });
                        if(!mkd.body.hasClass('page-template-full_screen-php')){
                            mkd.modules.common.mkdEnableScroll();
                        }
                    });
                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            searchOverlay.removeClass('mkd-animate');
                            searchHolder.css({
                                'opacity' : 0,
                                'display' : 'none'
                            });
                            searchClose.css({
                                'opacity':0,
                                'visibility' : 'hidden'
                            });
                            searchOpener.css({
                                'opacity' : 1
                            });
                            if(!mkd.body.hasClass('page-template-full_screen-php')){
                                mkd.modules.common.mkdEnableScroll();
                            }
                        }
                    });
                }
            });

            //Text input focus change
            $('.mkd-fullscreen-search-holder .mkd-search-field').focus(function(){
                $('.mkd-fullscreen-search-holder .mkd-field-holder .mkd-line').css("width","100%");
            });

            $('.mkd-fullscreen-search-holder .mkd-search-field').blur(function(){
                $('.mkd-fullscreen-search-holder .mkd-field-holder .mkd-line').css("width","0");
            });

        }

    }

    function mkdFollowHover() {

        //hover item and current item
        $('.mkd-main-menu').append("<span class='mkd-item-hover'></span>");

        var itemHover = $('.mkd-item-hover');
        var menu = $('.mkd-main-menu');
        var menuItem = $('.mkd-main-menu > ul > li');
        var currentMenuItem = menu.find('.current_page_item');

        //init hover width and position
        if (menuItem.hasClass('current_page_item')) {
            itemHover.css({width: currentMenuItem.find('.bottom-border-inner').width()});
            itemHover.css({left: currentMenuItem.find('.bottom-border-inner').offset().left - menu.offset().left});
        }

        //init opacity
        itemHover.css({opacity:0});

        //hover actions
        menuItem.mouseenter(function(){
            itemHover.css({width: $(this).find('.bottom-border-inner').width()});
            itemHover.css({left: $(this).find('.bottom-border-inner').offset().left - $(this).parent().offset().left});
            itemHover.animate({opacity:1},100);
        });

        menu.mouseleave(function(){
            itemHover.animate({opacity:0},250, 'easeOutSine');
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var title = {};
    mkd.modules.title = title;

    title.mkdParallaxTitle = mkdParallaxTitle;

    $(document).ready(function() {
        mkdParallaxTitle();
        mkdTitleAnimation();
    });

    $(window).load(function() {
        
    });

    $(window).resize(function() {

    });

    /*
     **	Title image with parallax effect
     */
    function mkdParallaxTitle(){
        if($('.mkd-title.mkd-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.mkd-title.mkd-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.mkd-title.mkd-has-parallax-background.mkd-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(mkd.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+mkdGlobalVars.vars.mkdAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-mkd.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(mkd.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+mkdGlobalVars.vars.mkdAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-mkd.scroll + 'px auto'});
            });

        }
    }

    /*
     ** Animation on load
     */
    function mkdTitleAnimation(){
        if($('.mkd-title.mkd-title-animation').length > 0){
            var titleArea = $('.mkd-title.mkd-title-animation');

            $('.mkd-title.mkd-title-animation').waitForImages({
                waitForAll: true,
                finished: function() {
                    titleArea.addClass('appeared');
                }
            });

        }
    }

})(jQuery);

(function($) {
    'use strict';

    var shortcodes = {};

    mkd.modules.shortcodes = shortcodes;

    shortcodes.mkdInitCounter = mkdInitCounter;
    shortcodes.mkdInitProgressBars = mkdInitProgressBars;
    shortcodes.mkdInitCountdown = mkdInitCountdown;
    shortcodes.mkdInitTestimonials = mkdInitTestimonials;
    shortcodes.mkdInitCarousels = mkdInitCarousels;
    shortcodes.mkdInitPieChart = mkdInitPieChart;
    shortcodes.mkdInitTabs = mkdInitTabs;
    shortcodes.mkdInitTabIcons = mkdInitTabIcons;
    shortcodes.mkdCustomFontResize = mkdCustomFontResize;
    shortcodes.mkdCounterResize = mkdCounterResize;
    shortcodes.mkdIconListResize = mkdIconListResize;
    shortcodes.mkdInitImageGallery = mkdInitImageGallery;
    shortcodes.mkdInitImageSlider = mkdInitImageSlider;
    shortcodes.mkdInitAccordions = mkdInitAccordions;
    shortcodes.mkdShowGoogleMap = mkdShowGoogleMap;
    shortcodes.mkdInitPortfolioListMasonry = mkdInitPortfolioListMasonry;
    shortcodes.mkdInitPortfolioListPinterest = mkdInitPortfolioListPinterest;
    shortcodes.mkdInitPortfolio = mkdInitPortfolio;
    shortcodes.mkdInitPortfolioMasonryFilter = mkdInitPortfolioMasonryFilter;
    shortcodes.mkdInitPortfolioSlider = mkdInitPortfolioSlider;
    shortcodes.mkdInitPortfolioLoadMore = mkdInitPortfolioLoadMore;
    shortcodes.mkdInitListAnimation = mkdInitListAnimation;
    shortcodes.mkdInitInteractiveImage = mkdInitInteractiveImage;
    shortcodes.mkdInitIconSeparator = mkdInitIconSeparator;
    shortcodes.mkdInitImageWithHoverInfo = mkdInitImageWithHoverInfo;
    shortcodes.mkdInitSocialHover = mkdInitSocialHover;
    shortcodes.mkdInitInteractiveIcon = mkdInitInteractiveIcon;
    shortcodes.mkdInitTeam = mkdInitTeam;
    shortcodes.mkdInitInteractiveBanner = mkdInitInteractiveBanner;
    shortcodes.mkdInitVideoBoxHolderAppear = mkdInitVideoBoxHolderAppear;
    shortcodes.mkdInitFullWidthSlider = mkdInitFullWidthSlider;

    $(document).ready(function() {
        mkdInitCounter();
        mkdInitProgressBars();
        mkdInitCountdown();
        mkdIcon().init();
        mkdInitTestimonials();
        mkdInitCarousels();
        mkdInitPieChart();
		mkdInitTabs();
        mkdInitTabIcons();
        mkdButton().init();
		mkdCustomFontResize();
		mkdCounterResize();
		mkdIconListResize();
        mkdInitImageGallery();
        mkdInitImageSlider();
        mkdInitAccordions();
        mkdShowGoogleMap();
        mkdInitPortfolioListMasonry();
        mkdInitPortfolioListPinterest();
        mkdInitPortfolio();
        mkdInitPortfolioMasonryFilter();
        mkdInitPortfolioSlider();
        mkdInitPortfolioLoadMore();
        mkdInitListAnimation();
        mkdInitInteractiveImage();
        mkdInitIconSeparator();
        mkdInitImageWithHoverInfo();
        mkdInitSocialHover();
        mkdInitVideoBoxHolderAppear();
        mkdInitFullWidthSlider();
    });
    
    $(window).resize(function(){
		mkdCustomFontResize();
		mkdCounterResize();
		mkdIconListResize();
        mkdInitPortfolioListMasonry();
        mkdInitPortfolioListPinterest();
        mkdInitImageWithHoverInfo();
        mkdInitInteractiveIcon();
        mkdInitTeam();
        mkdInitInteractiveBanner();
    });

    $(window).load(function(){
        mkdInitInteractiveIcon();
        mkdInitTeam();
        mkdInitInteractiveBanner();
    });

    /**
     * Counter Shortcode
     */
    function mkdInitCounter() {

        var counters = $('.mkd-counter');


        if (counters.length) {
            counters.each(function() {
                var counter = $(this);
                counter.appear(function() {
                    counter.parents('.mkd-counter-holder').addClass('mkd-counter-holder-show');

                    //Counter zero type
                    if (counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 2000,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            });
        }

    }
	/*
	**	Counter Resizing
	*/
	function mkdCounterResize(){
		var counters = $('.mkd-counter-holder');
		if (counters.length){
			counters.each(function(){
				var thisCounter = $(this);
				var thisCounterDigit = thisCounter.find('.mkd-counter');
				var thisCounterCurrency = thisCounter.find('.mkd-counter-currency');
				var fontSize;
				var coef1 = 1;
				var coef2 = 1;

				if (mkd.windowWidth <= 1024){
					coef1 = 0.8;
					coef2 = 0.88;
				}

				if (mkd.windowWidth < 600){
					coef1 = 0.6;
					coef2 = 0.8;
				}

				if (mkd.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.6;
				}

				if (mkd.windowWidth < 320){
					coef1 = 0.3;
					coef2 = 0.5;
				}

				if (typeof thisCounter.data('digit-size') !== 'undefined' && thisCounter.data('digit-size') !== false) {
					fontSize = parseInt(thisCounter.data('digit-size'));

					if (fontSize > 90) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if(fontSize > 70) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCounterDigit.css('font-size',fontSize + 'px');
					thisCounterCurrency.css('font-size',fontSize + 'px');
				}

			});
		}
	}
	/*
	**	Icon List Item Resizing
	*/
	function mkdIconListResize(){
		var iconList = $('.mkd-icon-list-item');
		if (iconList.length){
			iconList.each(function(){
				var thisIconItem = $(this);
				var thisItemIcon = thisIconItem.find('.mkd-icon-list-icon-holder-inner');
				var thisItemText = thisIconItem.find('.mkd-icon-list-text');
				var fontSizeIcon;
				var fontSizeText;
				var coef1 = 1;

				if (mkd.windowWidth <= 1024){
					coef1 = 0.75;
				}

				if (mkd.windowWidth < 600){
					coef1 = 0.65;
				}

				if (mkd.windowWidth < 480){
					coef1 = 0.5;
				}

				if (typeof thisItemIcon.data('icon-size') !== 'undefined' && thisItemIcon.data('icon-size') !== false) {
					fontSizeIcon = parseInt(thisItemIcon.data('icon-size'));

					if (fontSizeIcon > 50) {
						fontSizeIcon = Math.round(fontSizeIcon*coef1);
					}

					thisItemIcon.children().css('font-size',fontSizeIcon + 'px');
				}

				if (typeof thisItemText.data('title-size') !== 'undefined' && thisItemText.data('title-size') !== false) {
					fontSizeText = parseInt(thisItemText.data('title-size'));

					if (fontSizeText > 50) {
						fontSizeText = Math.round(fontSizeText*coef1);
					}

					thisItemText.css('font-size',fontSizeText + 'px');
				}

			});
		}
	}

    /*
    **	Horizontal progress bars shortcode
    */
    function mkdInitProgressBars(){
        
        var progressBar = $('.mkd-progress-bar');
        
        if(progressBar.length){
            
            progressBar.each(function() {
                
                var thisBar = $(this);
                
                thisBar.appear(function() {
                    mkdInitToCounterProgressBar(thisBar);
                    if(thisBar.find('.mkd-floating.mkd-floating-inside') !== 0){
                        var floatingInsideMargin = thisBar.find('.mkd-progress-content').height();
                        floatingInsideMargin += parseFloat(thisBar.find('.mkd-progress-title-holder').css('padding-bottom'));
                        floatingInsideMargin += parseFloat(thisBar.find('.mkd-progress-title-holder').css('margin-bottom'));
                        thisBar.find('.mkd-floating-inside').css('margin-bottom',-(floatingInsideMargin)+'px');
                    }
                    var percentage = thisBar.find('.mkd-progress-content').data('percentage'),
                        progressContent = thisBar.find('.mkd-progress-content'),
                        progressNumber = thisBar.find('.mkd-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage+'%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage+'%'}, 1500);

                });
            });
        }
    }
    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function mkdInitToCounterProgressBar(progressBar){
        var percentage = parseFloat(progressBar.find('.mkd-progress-content').data('percentage'));
        var percent = progressBar.find('.mkd-progress-number .mkd-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.mkd-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }

    /**
     * Countdown Shortcode
     */
    function mkdInitCountdown() {

        var countdowns = $('.mkd-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel,
            monthLabelSingle,
            dayLabelSingle,
            hourLabelSingle,
            minuteLabelSingle,
            secondLabelSingle;

        if (countdowns.length) {

            countdowns.each(function(){

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#'+countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                monthLabelSingle = countdown.data('month-label-single');
                dayLabelSingle = countdown.data('day-label-single');
                hourLabelSingle = countdown.data('hour-label-single');
                minuteLabelSingle = countdown.data('minute-label-single');
                secondLabelSingle = countdown.data('second-label-single');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    labels1: ['Years', monthLabelSingle, 'Weeks', dayLabelSingle, hourLabelSingle, minuteLabelSingle, secondLabelSingle],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size' : digitFontSize+'px',
                        'line-height' : digitFontSize+'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size' : labelFontSize+'px'
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdIcon = mkd.modules.shortcodes.mkdIcon = function() {
        //get all icons on page
        var icons = $('.mkd-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('mkd-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.mkd-icon-animation-holder').addClass('mkd-icon-animation-show');
                }, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.mkd-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.find('.mkd-background').css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon.find('.mkd-background'), color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon.find('.mkd-background'), color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.find('.mkd-background').css('borderTopColor');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon.find('.mkd-background'), color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon.find('.mkd-background'), color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function mkdInitTestimonials(){

        var testimonial = $('.mkd-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var thisTestimonial = $(this);

                //set three items in one column for 1x3 format
                var sliderItem = $(this).find('.mkd-testimonial-content');
                for(var i = 0; i < sliderItem.length; i+=3) {
                  sliderItem.slice(i, i+3).wrapAll("<div class='item-inner'></div>");
                }

                //opacity 1
                thisTestimonial.waitForImages(function() {
                    $(this).animate({opacity:1},1000);
                });

                thisTestimonial.appear(function() {
                    thisTestimonial.css('visibility','visible');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

                var interval = 5000;

                var items = [
                    [0,1],
                    [480,1],
                    [1024,1]
                ];

                thisTestimonial.owlCarousel({
                    items: 1,
                    itemsCustom: items,
                    autoPlay: interval,
                    addClassActive: true,
                    transitionStyle : 'mkdTransition', //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    paginationSpeed: 500
                });

            });

        }

    }

    /**
     * Init Carousel shortcode
     */
    function mkdInitCarousels() {

        var carouselHolders = $('.mkd-carousel-holder'),
            carousel;

        if (carouselHolders.length) {
            carouselHolders.each(function(){
                //Bullet Pagination
                var pagination = true;
                //Autoplay
                var autoplay = 4000;
                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3]
                ];
                var carouselHolder = $(this);
                carousel = carouselHolder.children('.mkd-carousel');
                
                //set two items in one column for 3x2 format
                var sliderItem = $(this).find('.mkd-carousel-item-holder');
                if (carousel.hasClass('mkd-carousel-grid')){
                    for(var i = 0; i < sliderItem.length; i+=2) {
                      sliderItem.slice(i, i+2).wrapAll("<div class='item-inner'></div>");
                    }
                }
                else{
                    sliderItem.wrap("<div class='item-inner'></div>");
                    pagination = false;
                    var itemsNumber = 6;
                    if (typeof carousel.data('items-shown') !== 'undefined'){
                    	itemsNumber = parseInt(carousel.data('items-shown'));
                    }
                    items = [
                        [0,1],
                        [480,2],
                        [768,4],
                        [1024,itemsNumber]
                    ];
                }
                if (carousel.data('autoplay') == 'no'){
                	autoplay = false;
                }

                //opacity 1
                carouselHolder.waitForImages(function() {
                    $(this).animate({opacity:1},2200);
                });


                carousel.owlCarousel({
                    autoPlay: autoplay,
                    items: 3,
                    itemsCustom: items,
                    addClassActive: true,
                    pagination: pagination,
                    navigation: false,
                    paginationSpeed: 400
                });



            });
        }

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function mkdInitPieChart() {

        var pieCharts = $('.mkd-pie-chart-holder, .mkd-pie-chart-with-icon-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.mkd-percentage, .mkd-percentage-with-icon'),
                    barColor = mkdGlobalVars.vars.mkdFirstMainColor,
                    trackColor = '#efefef',
                    lineWidth = 10,
                    size = 142;

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart( pieChart ){

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.mkd-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /*
    **	Init tabs shortcode
    */
    function mkdInitTabs(){

       var tabs = $('.mkd-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this),
                    navLinks = thisTabs.find('.mkd-tabs-nav a');

                navLinks.each(function () {
                    var that = $(this),
                        link = that.attr('href'),
                        container = $(link),
                        linkSub = link.substr(1, link.length - 1),
                        customID = Math.floor(Math.random() * 10000);

                    if (container.length) {
                        container.attr({
                            'id' : linkSub + customID
                        });
                        that.attr({
                            'href' : link + customID
                        });
                    }
                });

                if(thisTabs.hasClass('mkd-horizontal')){
                    thisTabs.tabs();
                }
                else if(thisTabs.hasClass('mkd-vertical')){
                    thisTabs.tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
                    thisTabs.find('.mkd-tabs-nav > ul >li').removeClass( 'ui-corner-top' ).addClass( 'ui-corner-left' );
                }
            });
        }
    }

    /*
    **	Generate icons in tabs navigation
    */
    function mkdInitTabIcons(){

        var tabContent = $('.mkd-tab-container');
        if(tabContent.length){

            tabContent.each(function(){
                var thisTabContent = $(this);

                var id = thisTabContent.attr('id');
                var icon = '';
                if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
                    icon = thisTabContent.data('icon-html');
                }

                var tabNav = thisTabContent.parents('.mkd-tabs').find('.mkd-tabs-nav > li > a[href=#'+id+']');

                if(typeof(tabNav) !== 'undefined') {
                    tabNav.children('.mkd-icon-frame').append(icon);
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdButton = mkd.modules.shortcodes.mkdButton = function() {
        //all buttons on the page
        var buttons = $('.mkd-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };



        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor');
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        var buttonIconHoverBorderColor = function(button) {
            if(button.hasClass('mkd-btn-icon')) {
                if(typeof button.data('between-hover-border-color') !== 'undefined') {
                    var changeIconBorderColor = function(event) {
                        event.data.iconHolder.css('border-color', event.data.color);
                    };

                    var iconHolder = button.find('.mkd-btn-text');

                    var originalBorderColor = iconHolder.css('borderRightColor');

                    var hoverBorderColor = button.data('between-hover-border-color');

                    button.on('mouseenter', { iconHolder: iconHolder, color: hoverBorderColor }, changeIconBorderColor);
                    button.on('mouseleave', { iconHolder: iconHolder, color: originalBorderColor }, changeIconBorderColor);
                }
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                        buttonIconHoverBorderColor($(this));
                    });
                }
            }
        };
    };


	/*
	**	Custom Font resizing
	*/
	function mkdCustomFontResize(){
		var customFont = $('.mkd-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (mkd.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (mkd.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (mkd.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (mkd.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (mkd.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && mkd.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && mkd.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **	Show Google Map
     */
    function mkdShowGoogleMap(){

        if($('.mkd-google-map').length){
            $('.mkd-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "mkd-map-"+ uniqueId;

                mkdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function mkdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'mkd-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Mkd Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkd-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkd-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            mkdInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function mkdInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function mkdInitAccordions(){
        var accordion = $('.mkd-accordion-holder');
        if(accordion.length){
            accordion.each(function(){

               var thisAccordion = $(this);

				if(thisAccordion.hasClass('mkd-accordion')){

					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('mkd-toggle')){

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.mkd-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
            });
        }
    }

    function mkdInitImageGallery() {

        var galleries = $('.mkd-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.mkd-image-gallery-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes');

                gallery.owlCarousel({
                    singleItem: true,
                    autoPlay: autoplay * 1000,
                    navigation: navigation,
                    transitionStyle : animation, //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: pagination,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="mkd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="mkd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });
            });
        }

    }
    /**
     * Initializes portfolio list
     */
    function mkdInitPortfolio(){
        var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-standard, .mkd-portfolio-list-holder-outer.mkd-ptf-gallery');
        if(portList.length){            
            portList.each(function(){
                var thisPortList = $(this);
                thisPortList.appear(function(){
                    mkdInitPortMixItUp(thisPortList);
                });
            });
        }
    }
    /**
     * Initializes mixItUp function for specific container
     */
    function mkdInitPortMixItUp(container){
        var filterClass = '';
        if(container.hasClass('mkd-ptf-has-filter')){
            filterClass = container.find('.mkd-portfolio-filter-holder-inner ul li').data('class');
            filterClass = '.'+filterClass;
        }
        
        var holderInner = container.find('.mkd-portfolio-list-holder');
        holderInner.mixItUp({
            callbacks: {
                onMixLoad: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixStart: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixBusy: function(){
                    holderInner.find('article').css('visibility','visible');
                } 
            },           
            selectors: {
                filter: filterClass
            },
            animation: {
                effects: 'fade scale',
                duration: 300,
                easing: 'ease-out'
            }
            
        });
        
    }
     /*
    **	Init portfolio list masonry type
    */
    function mkdInitPortfolioListMasonry(){
        var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-masonry');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.mkd-portfolio-list-holder');
                var size = thisPortList.find('.mkd-portfolio-list-masonry-grid-sizer').width();
                mkdResizeMasonry(size,thisPortList);
                
                mkdInitMasonry(thisPortList);
                $(window).resize(function(){
                    mkdResizeMasonry(size,thisPortList);
                    mkdInitMasonry(thisPortList);
                });
            });
        }
    }
    
    function mkdInitMasonry(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.mkd-portfolio-item',
            masonry: {
                columnWidth: '.mkd-portfolio-list-masonry-grid-sizer'
            }
        });
    }
    
    function mkdResizeMasonry(size,container){
        
        var defaultMasonryItem = container.find('.mkd-default-masonry-item');
        var largeWidthMasonryItem = container.find('.mkd-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.mkd-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.mkd-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeWidthMasonryItem.css('height', size);
        
        
        if(mkd.windowWidth > 600){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeHeightMasonryItem.css('height', Math.round(2*size));
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', size);
        }
    }
    /**
     * Initializes portfolio pinterest 
     */
    function mkdInitPortfolioListPinterest(){
        
        var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-pinterest');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.mkd-portfolio-list-holder');
                mkdInitPinterest(thisPortList);
                $(window).resize(function(){
                     mkdInitPinterest(thisPortList);
                });
            });
            
        }
    }
    
    function mkdInitPinterest(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.mkd-portfolio-item',
            masonry: {
                columnWidth: '.mkd-portfolio-list-masonry-grid-sizer'
            }
        });
        
    }
    /**
     * Initializes portfolio masonry filter
     */
    function mkdInitPortfolioMasonryFilter(){
        
        var filterHolder = $('.mkd-portfolio-filter-holder.mkd-masonry-filter');
        
        if(filterHolder.length){
            filterHolder.each(function(){
               
                var thisFilterHolder = $(this);
                
                var portfolioIsotopeAnimation = null;
                
                var filter = thisFilterHolder.find('ul li').data('class');
                
                thisFilterHolder.find('.filter:first').addClass('current');
                
                thisFilterHolder.find('.filter').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(portfolioIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    portfolioIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s'); 
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.siblings('.mkd-portfolio-list-holder-outer').find('.mkd-portfolio-list-holder').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });
                
            });
        }
    }
    /**
     * Initializes portfolio slider
     */
    
    function mkdInitPortfolioSlider(){
        var portSlider = $('.mkd-portfolio-list-holder-outer.mkd-portfolio-slider-holder');
        if(portSlider.length){
            portSlider.each(function(){
                var thisPortSlider = $(this);
                var sliderWrapper = thisPortSlider.children('.mkd-portfolio-list-holder');
                var numberOfItems = thisPortSlider.data('items');
                var navigation = true;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,numberOfItems]
                ];

                sliderWrapper.owlCarousel({                    
                    autoPlay: 5000,
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: true,
                    navigation: navigation,
                    slideSpeed: 600,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    navigationText: [
                        '<span class="mkd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="mkd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });
            });
        }
    }
    /**
     * Initializes portfolio load more function
     */
    function mkdInitPortfolioLoadMore(){
        var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-load-more');
        if(portList.length){
            portList.each(function(){
                
                var thisPortList = $(this);
                var thisPortListInner = thisPortList.find('.mkd-portfolio-list-holder');
                var nextPage; 
                var maxNumPages;
                var loadMoreButton = thisPortList.find('.mkd-ptf-list-load-more a');
                
                if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {  
                    maxNumPages = thisPortList.data('max-num-pages');
                }
                
                loadMoreButton.on('click', function (e) {  
                    var loadMoreDatta = mkdGetPortfolioAjaxData(thisPortList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation(); 
                    if(nextPage <= maxNumPages){
                        var ajaxData = mkdSetPortfolioAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: mkdCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisPortList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = mkdConvertHTML(response.html); //convert response html into jQuery collection that Mixitup can work with
                                thisPortList.waitForImages(function(){
                                    setTimeout(function() {
                                        if(thisPortList.hasClass('mkd-ptf-masonry') || thisPortList.hasClass('mkd-ptf-pinterest') ){
                                            thisPortListInner.isotope().append( responseHtml ).isotope( 'appended', responseHtml ).isotope('reloadItems');
                                        } else {
                                            thisPortListInner.mixItUp('append',responseHtml);
                                        }
                                    },400);
                                });                           
                            }
                        });
                    }
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });
                
            });
        }
    }
    
    function mkdConvertHTML ( html ) {
        var newHtml = $.trim( html ),
                $html = $(newHtml ),
                $empty = $();

        $html.each(function ( index, value ) {
            if ( value.nodeType === 1) {
                $empty = $empty.add ( this );
            }
        });

        return $empty;
    }
    /**
     * Initializes portfolio load more data params
     * @param portfolio list container with defined data params
     * return array
     */
    function mkdGetPortfolioAjaxData(container){
        var returnValue = {};
        
        returnValue.type = '';
        returnValue.columns = '';
        returnValue.gridSize = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.imageSize = '';
        returnValue.filter = '';
        returnValue.filterOrderBy = '';
        returnValue.category = '';
        returnValue.selectedProjectes = '';
        returnValue.showLoadMore = '';
        returnValue.titleTag = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        
        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('grid-size') !== 'undefined' && container.data('grid-size') !== false) {                    
            returnValue.gridSize = container.data('grid-size');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {                    
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {                    
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {                    
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {                    
            returnValue.number = container.data('number');
        }
        if (typeof container.data('image-size') !== 'undefined' && container.data('image-size') !== false) {
            returnValue.imageSize = container.data('image-size');
        }
        if (typeof container.data('filter') !== 'undefined' && container.data('filter') !== false) {                    
            returnValue.filter = container.data('filter');
        }
        if (typeof container.data('filter-order-by') !== 'undefined' && container.data('filter-order-by') !== false) {                    
            returnValue.filterOrderBy = container.data('filter-order-by');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('selected-projects') !== 'undefined' && container.data('selected-projects') !== false) {                    
            returnValue.selectedProjectes = container.data('selected-projects');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {                    
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {                    
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {                    
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {                    
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        return returnValue;
    }
     /**
     * Sets portfolio load more data params for ajax function
     * @param portfolio list container with defined data params
     * return array
     */
    function mkdSetPortfolioAjaxData(container){
        var returnValue = {
            action: 'mkd_core_portfolio_ajax_load_more',
            type: container.type,
            columns: container.columns,
            gridSize: container.gridSize,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            imageSize: container.imageSize,
            filter: container.filter,
            filterOrderBy: container.filterOrderBy,
            category: container.category,
            selectedProjectes: container.selectedProjectes,
            showLoadMore: container.showLoadMore,
            titleTag: container.titleTag,
            nextPage: container.nextPage
        };
        return returnValue;
    }

	 /**
	 * Animate unordered list
	 */
	function mkdInitListAnimation(){

		var animateList = $('.mkd-animate-list');
		var animateOnTouch = $('.mkd-no-animations-on-touch');

		if(animateList.length && !animateOnTouch.length){
			animateList.each(function(){
				var thisList = $(this);
				var thisListLis = thisList.find("li");
				thisList.appear(function() {
					thisListLis.each(function (l) {
						var k = $(this);
						setTimeout(function () {
							k.animate({
								opacity: 1,
								top: 0
							}, 200);
						}, 220*l);
					});
				},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			});
		}
	}

    /**
    * Init Mkd Image Slider
    */
    function mkdInitImageSlider() {
        
        if ($('.mkd-image-slider').length) {
            $('.mkd-image-slider').each(function(){

                //vars
                var imageSlider = $(this);
                var animation = '';
                var thumbs = '';
                var navigation = '';
                var customNavigation = '';
                var navigationArrows = imageSlider.find(".mkd-slider-navigation a");


                //params
                if ($(this).hasClass('with-thumbs')) {
                    thumbs = "thumbnails";
                    navigation = false;
                    customNavigation = false;
                    animation = 'slide';
                } else {
                    thumbs = false;
                    navigation = true;
                    customNavigation = navigationArrows;
                    animation = 'fade';
                }



                imageSlider.waitForImages(function() {
                    $(this).animate({opacity:1},2200);
                });

                imageSlider.find('.flexslider').flexslider({
                    animation: animation,
                    controlNav: thumbs,
                    directionNav: navigation,
                    customDirectionNav: customNavigation,
                    animationLoop: false,
                    start: function(slider){
                        slider.find('.flex-control-nav .flex-active').parent('li').addClass('active-item').siblings().removeClass('active-item');

                        mkd.modules.common.mkdInitParallax();
                    },
                    after: function(slider){
                        slider.find('.flex-control-nav .flex-active').parent('li').addClass('active-item').siblings().removeClass('active-item');              
                    }
                });

                //hover effect elements
                imageSlider.find('.flex-control-thumbs li').append('<span class="mkd-image-slider-thumb-hover"></span>');

            });
        }

    }

    /**
    * Init Interactive Image shortcode - Checkmark animation
    */

    function mkdInitInteractiveImage() {

        var checkMarks = $('.mkd-interactive-image.mkd-checkmark');
        var rows = checkMarks.closest('.vc_row'); // checkmark parent row elements

        if (rows.length){
            rows.each(function(){

                var row = $(this); //current row

                if(checkMarks.length){
                    checkMarks.each(function(i){

                        var checkMark = $(this);
                        var n = row.find(checkMarks).length; // number of checkmark elements in current row

                        if (i>=n) {
                            i = i - n;
                        } //rewind delay coefficient after n elements

                        checkMark.appear(function() {
                            $(this).find('.tick').delay(i*300).animate({'width': '53px'}, 400);
                        },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

                    });
                }

            });
        }
    }

    /**
    * Init Icon Separator shortcode
    */

    function mkdInitIconSeparator() {
        var iconSeparators = $('.mkd-separator-with-icon.mkd-animate');

        if(iconSeparators.length){
            iconSeparators.each(function(){

                var iconSeparator = $(this);

                iconSeparator.appear(function() {
                    $(this).addClass('appeared');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

            });
        }
    }

    /**
    * Init Image With Hover Info shortcode
    */

    function mkdInitImageWithHoverInfo() {
        var imageWithHoverInfo = $('.mkd-image-with-hover-info');

        if(imageWithHoverInfo.length){
            imageWithHoverInfo.each(function(){

                var mask = $(this).find('.mkd-mask');
                var content = $(this).find('.mkd-info');
                var maskHeight = '';

                if ((mask.outerHeight()-150) < content.outerHeight()) {
                    maskHeight = content.outerHeight() + 150; // 150 - offset in pixels for the desired angle of mask element
                    mask.css({'height':maskHeight + 'px'});
                    mask.css({'top':-maskHeight + 'px'});
                }

            });
        }
    }


    /**
    * Init Social Share Hover
    */

	function mkdInitSocialHover() {
		var iconsSocial = $('.mkd-social-network-icon');

		iconsSocial.each(function(){
			var iconSocial = $(this);
			if(typeof iconSocial.data('hover-color') !== 'undefined' && iconSocial.data('hover-color') !== '') {


				var iconHoverHolder = iconSocial.parent();
				var hoverColor = iconSocial.data('hover-color');
				var originalColor = iconSocial.css('color');


				iconHoverHolder.on("mouseenter", function(){
					iconSocial.css('color',hoverColor);
				});

				iconHoverHolder.on("mouseleave", function(){
					iconSocial.css('color',originalColor);
				});
			}
		});
	}

    /**
    * Init Interactive Icon shortcode
    */

    function mkdInitInteractiveIcon() {
        var interactiveIcons = $('.mkd-interactive-icon');

        if(interactiveIcons.length){
            interactiveIcons.each(function(){

                //vars
                var interactiveIcon= $(this);
                var titleHeight;
                var initialContentHeight;
                var hoverContentHeight;

                interactiveIcon.animate({opacity:1}, 1000, 'easeOutSine');

                //heights
                titleHeight = interactiveIcon.find('.mkd-interactive-icon-title').outerHeight();
                initialContentHeight = interactiveIcon.find('.mkd-interactive-icon-initial-content').outerHeight();
                hoverContentHeight = interactiveIcon.find('.mkd-interactive-icon-hover-content').outerHeight() + titleHeight;

                //definitive height
                if ( initialContentHeight < hoverContentHeight) {
                    interactiveIcon.find('.mkd-interactive-icon-inner').css({'height': parseInt(hoverContentHeight) + 'px'});
                }

                //offset when hover content exceeds initial content
                var interactiveIconTopPosition = interactiveIcon.offset().top;
                var titleTopPosition = interactiveIcon.find('.mkd-interactive-icon-title').offset().top;
                var titleMovement = interactiveIconTopPosition - titleTopPosition - 10;

                interactiveIcon.find('.mkd-interactive-icon-hover-content').css({'top':parseInt(titleHeight)+'px'}); //hover content positioning just below the title

                //hovers
                interactiveIcon.on('mouseenter', interactiveIcon, function(){

                    interactiveIcon.find('.mkd-interactive-icon-title').css('-webkit-transform','translateY('+parseInt(titleMovement)+'px)');
                    interactiveIcon.find('.mkd-interactive-icon-title').css('transform','translateY('+parseInt(titleMovement)+'px)');

                });

                interactiveIcon.on('mouseleave', interactiveIcon, function(){

                   interactiveIcon.find('.mkd-interactive-icon-title').css('-webkit-transform','translateY(0px)');
                   interactiveIcon.find('.mkd-interactive-icon-title').css('transform','translateY(0px)');

                });

            });
        }
    }


    /**
    * Init Team shortcode
    */
    function mkdInitTeam() {

        var teamShortcodes = $('.mkd-team');

        if(teamShortcodes.length){
            teamShortcodes.each(function(){

                var teamShortcode = $(this);
                var infoHolder = teamShortcode.find('.mkd-team-info');
                var triangle = teamShortcode.find('.mkd-team-triangle ');
                var triangleTop = infoHolder.offset().top - teamShortcode.offset().top; 

                //calculate traingle position
                triangle.css({'top':triangleTop-12+'px'}); // 12 px is triangle height

                //social icons text 
                var teamSocialNetworks = ['blogger','delicious','deviantart','dribbble','facebook','flickr','googledrive','instagram','myspace','picassa','pinterest','rss','share','skype','spotify','stumbleupon','tumblr','twitter','linkedin','wordpress','youtube'];

                for (var i = teamSocialNetworks.length - 1; i >= 0; i--) {
                    var teamSocialNetwork = teamSocialNetworks[i];
                    var teamSocialIcon = teamShortcode.find('.mkd-icon-element[class*="'+teamSocialNetwork+'"]');
                    teamSocialIcon.parent('a').append('<span class="mkd-team-social-text">'+teamSocialNetwork+'</span>');
                }

            });
        }
    }

    /*
    * init Interactive Banner shortcode
    */
    function mkdInitInteractiveBanner() {
        var interactiveBanners = $('.mkd-interactive-banner');
        if(interactiveBanners.length){
            interactiveBanners.each(function(){

                var interactiveBanner = $(this);
                var infoHolder = interactiveBanner.find('.mkd-interactive-banner-info');
                var triangle = interactiveBanner.find('.mkd-interactive-banner-triangle ');
                var triangleTop = infoHolder.offset().top - interactiveBanner.offset().top; 
                
                //calculate traingle position
                triangle.css({'top':triangleTop-12+'px'}); // 12 px is triangle height
            });
        }
    }

    /*
    * Video Box appearing
    */
	function mkdInitVideoBoxHolderAppear(){
		var videoBox = $('.mkd-video-box');

		if (videoBox.length){
			videoBox.each(function(){
				var thisVideoBox = $(this);
				var thisVideoBoxText = thisVideoBox.find('.mkd-video-box-text');

				thisVideoBox.waitForImages(function() {
					thisVideoBoxText.addClass('mkd-vtext-appear');
				});
			});
		}

	}

    /**
     * Init fullwidth slider shortcode
     */

    function mkdInitFullWidthSlider(){

        var fullwidthSlider = $('.mkd-fullwidth-slider-slides');
        if(fullwidthSlider.length){
            fullwidthSlider.each(function(){

                var thisFullwidthSlider = $(this);

                thisFullwidthSlider.appear(function() {
                    thisFullwidthSlider.css('visibility','visible');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

                var interval = 5000;
                var controlNav = true;
                var directionNav = false;
                var animationSpeed = 600;
                if(typeof thisFullwidthSlider.data('animation-speed') !== 'undefined' && thisFullwidthSlider.data('animation-speed') !== false) {
                    animationSpeed = thisFullwidthSlider.data('animation-speed');
                }

                //var iconClasses = getIconClassesForNavigation(directionNavArrowsTestimonials); TODO

                thisFullwidthSlider.owlCarousel({
                    singleItem: true,
                    autoPlay: interval,
                    addClassActive: true,
                    navigation: directionNav,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: controlNav,
                    slideSpeed: animationSpeed
                });

            });

        }

    }


})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function () {
        mkdInitQuantityButtons();
        mkdInitSelect2();
    });

    function mkdInitQuantityButtons() {

        $(document).on( 'click', '.mkd-quantity-minus, .mkd-quantity-plus', function(e) {
            e.stopPropagation();


            var button = $(this),
                inputField = button.siblings('.mkd-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('mkd-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            inputField.trigger( 'change' );

        });

    }

    function mkdInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();

        }

    }


})(jQuery);
(function($) {
    'use strict';

    mkd.modules.portfolio = {};

    $(window).load(function() {
        mkdPortfolioLoadMore();
        mkdPortfolioSingleFollow().init();
    });

    var mkdPortfolioSingleFollow = function() {

        var info = $('.mkd-follow-portfolio-info .small-images.mkd-portfolio-single-holder .mkd-portfolio-info-holder, ' +
        '.mkd-follow-portfolio-info .small-slider.mkd-portfolio-single-holder .mkd-portfolio-info-holder');

        if (info.length) {
            var infoHolder = info.parent(),
                infoHolderOffset = infoHolder.offset().top,
                infoHolderHeight = infoHolder.height(),
                mediaHolder = $('.mkd-portfolio-media'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .mkd-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(mkd.scroll > infoHolderOffset) {
                        info.animate({
                            marginTop: (mkd.scroll - (infoHolderOffset) + mkdGlobalVars.vars.mkdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                        });
                    }
                }

            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(mkd.scroll > infoHolderOffset) {
                        if(mkd.scroll + headerHeight + mkdGlobalVars.vars.mkdAddForAdminBar + infoHolderHeight + 20 < infoHolderOffset + mediaHolderHeight) {    //20 px is for styling, spacing between header and info holder
                            //Calculate header height if header appears
                            if($('.header-appear, .mkd-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .mkd-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (mkd.scroll - (infoHolderOffset) + mkdGlobalVars.vars.mkdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                            });
                            //Reset header height
                            headerHeight = 0;
                        }else{
                            info.stop().animate({
                                marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {

            init : function() {

                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });

            }

        };

    };

    /*
    * Init portfolio load more button  
    */
    function mkdPortfolioLoadMore() {
        if($('.mkd-ptf-list-load-more').length){
            $('.mkd-ptf-list-load-more').each(function(){
                $(this).find('.mkd-btn').animate({opacity:1},200);
            });
        }
    }

})(jQuery);
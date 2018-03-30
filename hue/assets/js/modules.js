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
    mkd.htmlEl = $('html');
    mkd.menuDropdownHeightSet = false;
    mkd.defaultHeaderStyle = '';
    mkd.minVideoWidth = 1500;
    mkd.videoWidthOriginal = 1280;
    mkd.videoHeightOriginal = 720;
    mkd.videoRatio = 1280/720;

    mkd.mkdOnDocumentReady = mkdOnDocumentReady;
    mkd.mkdOnWindowLoad = mkdOnWindowLoad;
    mkd.mkdOnWindowResize = mkdOnWindowResize;
    mkd.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkd.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(mkd.body.hasClass('mkd-dark-header')){ mkd.defaultHeaderStyle = 'mkd-dark-header';}
        if(mkd.body.hasClass('mkd-light-header')){ mkd.defaultHeaderStyle = 'mkd-light-header';}

    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
        mkd.windowWidth = $(window).width();
        mkd.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {
        mkd.scroll = $(window).scrollTop();
    }



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
	common.mkdInitCustomMenuDropdown = mkdInitCustomMenuDropdown;

    common.mkdOnDocumentReady = mkdOnDocumentReady;
    common.mkdOnWindowLoad = mkdOnWindowLoad;
    common.mkdOnWindowResize = mkdOnWindowResize;
    common.mkdOnWindowScroll = mkdOnWindowScroll;
    common.mkdIsTouchDevice = mkdIsTouchDevice;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdTouchDeviceBodyClass();
		mkdDisableSmoothScrollForMac();
        mkdFluidVideo();
        mkdPreloadBackgrounds();
        mkdPrettyPhoto();
        mkdInitAnchor().init();
        mkdInitVideoBackground();
        mkdInitVideoBackgroundSize();
        mkdSetContentBottomMargin();
        //mkdSmoothScroll();
        mkdOwlSlider();
        mkdInitSelfHostedVideoPlayer();
        mkdSelfHostedVideoSize();
        mkdInitBackToTop();
        mkdBackButtonShowHide();
		mkdInitCustomMenuDropdown();
        mkdGradientOverlayAnimation();
        mkdInitIntroSection();
    }

    /*
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {
        mkdInitElementsAnimations();
        mkdCheckHeaderStyleOnScroll(); //called on load since all content needs to be loaded in order to calculate row's position right
        mkdInitParallax();
        mkdSmoothTransition();
    }

    /*
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
        mkdInitVideoBackgroundSize();
        mkdSelfHostedVideoSize();
        mkdInitParallax();
        mkdInitIntroSection();
    }

    /*
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {

    }

	/*
	 ** Disable shortcodes animation on appear for touch devices
	 */
    function mkdTouchDeviceBodyClass() {
        if(mkdIsTouchDevice()) {
            mkd.body.addClass('mkd-no-animations-on-touch');
        }
    }

    function mkdIsTouchDevice() {
        return Modernizr.touch && !mkd.body.hasClass('mkd-no-animations-on-touch');
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

                if (!slider.hasClass('owl-carousel')) {
                    slider.addClass('owl-carousel');
                }

                slider.waitForImages(function(){
                    slider.css('visibility','visible');
                    slider.animate({opacity:1});
                });

                slider.owlCarousel({
                    autoplay:true,
                    autoplayHoverPause:true,
                    loop: true,
                    items: 1,
                    nav: true,
                    autoHeight: true,
                    dots: false,
                    navText: [
                        '<span class="mkd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="mkd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ],
                    smartSpeed: 600,
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut',
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
        /*jshint multistr: true */
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
                                            <a class="pp_next" href="#"></a> \
                                            <a class="pp_previous" href="#"></a>\
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

            var waypointSelectors = $('.wpb_row.mkd-section');
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
            elements = $('.mkd-grow-in, .mkd-fade-in-up, .mkd-fade-in-down, .mkd-fade-in-left, .mkd-fade-in-right, .mkd-element-from-fade, .mkd-element-from-left, .mkd-element-from-right, .mkd-element-from-top, .mkd-element-from-bottom, .mkd-flip-in, .mkd-x-rotate, .mkd-z-rotate, .mkd-y-translate, .mkd-fade-in, .mkd-fade-in-left-x-rotate'),
            animationClass,
            animationData;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
				$(this).appear(function() {
					animationData = $(this).data('animation');
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						$(this).addClass(animationClass+'-on');
					}
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
            var speed = parallaxElement.data('mkd-parallax-speed')*0.4;
            parallaxElement.parallax("50%", speed);
        });
    }
}

/*
 **	Intro Section 
 */
function mkdInitIntroSection(){

    if($('.mkd-intro-section-section-holder').length && mkd.windowWidth > 1024){

        var introSection = $('.mkd-intro-section-section-holder');
        introSection.height(mkd.windowHeight);

        var scrolled = function() {
            if (mkd.scroll > 0) {
                introSection.addClass('scrolled');
            } else {
                introSection.removeClass('scrolled');
            }
        }

        mkd.window.bind('scroll', scrolled);
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

        $('.mkd-main-menu .mkd-active-item, .mkd-mobile-nav .mkd-active-item, .mkd-vertical-menu .mkd-active-item, .mkd-fullscreen-menu .mkd-active-item').removeClass('mkd-active-item');
        anchor.parent().addClass('mkd-active-item');

        $('.mkd-main-menu a, .mkd-mobile-nav a, .mkd-vertical-menu a, .mkd-fullscreen-menu a').removeClass('current');
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
            var linkURL = window.location.href.split('#')[0]+"#"+hash;
            if($("a[href='"+linkURL+"']").length){ //if there is a link on page with such href
                $("a[href='"+linkURL+"']").trigger( "click" );
            }else{ //than create a fake link and click it
                var link = $('<a/>').attr({'href':linkURL,'class':'mkd-anchor'}).appendTo('body');
                link.trigger('click');
            }
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
        mkd.document.on("click", ".mkd-main-menu a, .mkd-vertical-menu a, .mkd-fullscreen-menu a, .mkd-btn, .mkd-anchor, .mkd-mobile-nav a", function() {
            var scrollAmount;
            var anchor = $(this);
            var hash = anchor.prop("hash").split('#')[1];

            if(hash !== "" && $('[data-mkd-anchor="' + hash + '"]').length > 0 /*&& anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]*/) {

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
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function mkdSetContentBottomMargin(){
        var uncoverFooter = $('.mkd-footer-uncover');

        if(uncoverFooter.length){
            $('.mkd-content').css('margin-bottom', $('.mkd-footer-inner').height()-1); //fix for white line in IE
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
            mkd.html.animate({scrollTop: 0}, mkd.window.scrollTop()/2, 'easeOutQuart');
        });
    }

    function mkdSmoothTransition() {
		var loader = $('body > .mkd-smooth-transition-loader.mkd-mimic-ajax');
        if (loader.length) {
            loader.fadeOut(500);
			$(window).bind('pageshow', function(event) {
				if (event.originalEvent.persisted) {
					loader.fadeOut(500);
				}
			});

            $('a').click(function(e) {
                var a = $(this);
                if (
                    e.which == 1 && // check if the left mouse button has been pressed
                    a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
					(typeof a.data('rel') === 'undefined') && //Not pretty photo link
                    (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                    (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                    (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                ) {
                    e.preventDefault();
                    loader.addClass('mkd-hide-spinner');
                    loader.fadeIn(500, function() {
                        window.location = a.attr('href');
                    });
                }
            });
        }
    }

	function mkdInitCustomMenuDropdown() {
		var menus = $('.mkd-sidebar .widget_nav_menu .menu');

		var dropdownOpeners,
			currentMenu;


		if(menus.length) {
			menus.each(function() {
				currentMenu = $(this);

				dropdownOpeners = currentMenu.find('li.menu-item-has-children > a');

				if(dropdownOpeners.length) {
					dropdownOpeners.each(function() {
						var currentDropdownOpener = $(this);

						currentDropdownOpener.on('click', function(e) {
							e.preventDefault();

							var dropdownToOpen = currentDropdownOpener.parent().children('.sub-menu');

							if(dropdownToOpen.is(':visible')) {
								dropdownToOpen.slideUp();
								currentDropdownOpener.removeClass('mkd-custom-menu-active');
							} else {
								dropdownToOpen.slideDown();
								currentDropdownOpener.addClass('mkd-custom-menu-active');
							}
						});
					});
				}
			});
		}
	}

    function mkdGradientOverlayAnimation(){

        if($('.mkd-gradient-overlay-animation').length) {

            $('.mkd-gradient-overlay-animation').each(function(){
                var gradientOverlay = $(this);

                var color1 = $(this).data('gradient-color1').split(',');
                var color2 = $(this).data('gradient-color2').split(',');
                var color3 = $(this).data('gradient-color3').split(',');
                var color4 = $(this).data('gradient-color4').split(',');

                var colors = new Array(color1,color2,color3,color4);

                var step = 0;
                //color table indices for:
                // current color left
                // next color left
                // current color right
                // next color right
                var colorIndices = [0, 1, 2, 3];

                //transition speed
                var gradientSpeed = 0.001;

                var updateGradient = function () {

                    if ($ === undefined) return;

                    var c0_0 = colors[colorIndices[0]];
                    var c0_1 = colors[colorIndices[1]];
                    var c1_0 = colors[colorIndices[2]];
                    var c1_1 = colors[colorIndices[3]];

                    var istep = 1 - step;
                    var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
                    var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
                    var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
                    var color1 = "rgb(" + r1 + "," + g1 + "," + b1 + ")";

                    var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
                    var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
                    var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
                    var color2 = "rgb(" + r2 + "," + g2 + "," + b2 + ")";

                    gradientOverlay.css({
                        background: "-webkit-linear-gradient(left, " + color1 + "," + color2 + ")"
                    }).css({
                        background: "-moz-linear-gradient(right, " + color1 + ", " + color2 + ")"
                    }).css({
                        background: "linear-gradient(to right, " + color1 + ", " + color2 + ")"
                    });

                    step += gradientSpeed;
                    if (step >= 1) {
                        step %= 1;
                        colorIndices[0] = colorIndices[1];
                        colorIndices[2] = colorIndices[3];

                        //pick two new target color indices
                        //do not pick the same as the current one
                        colorIndices[1] = ( colorIndices[1] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;
                        colorIndices[3] = ( colorIndices[3] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;

                    }
                }

                setInterval(updateGradient, 10);
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    var ajax = {};

    mkd.modules.ajax = ajax;

    var animation = {};
    ajax.animation = animation;

    ajax.mkdFetchPage = mkdFetchPage;
    ajax.mkdInitAjax = mkdInitAjax;
    ajax.mkdHandleLinkClick = mkdHandleLinkClick;
    ajax.mkdInsertFetchedContent = mkdInsertFetchedContent;
    ajax.mkdInitBackBehavior = mkdInitBackBehavior;
    ajax.mkdSetActiveState = mkdSetActiveState;
    ajax.mkdReinitiateAll = mkdReinitiateAll;
    ajax.mkdHandleMeta = mkdHandleMeta;

    ajax.mkdOnDocumentReady = mkdOnDocumentReady;
    ajax.mkdOnWindowLoad = mkdOnWindowLoad;
    ajax.mkdOnWindowResize = mkdOnWindowResize;
    ajax.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdInitAjax();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {
    }


    var loadedPageFlag = true; // Indicates whether the page is loaded
    var firstLoad = true; // Indicates whether this is the first loaded page, for back button functionality
    animation.type = null;
    animation.time = 500; // Duration of animation for the content to be changed
    animation.simultaneous = true; // False indicates that the new content should wait for the old content to disappear, true means that it appears at the same time as the old content disappears
    animation.loader = null;
    animation.loaderTime = 500;

    /**
     * Fetching the targeted page
     */
    function mkdFetchPage(params, destinationSelector, targetSelector) {

        function setDefaultParam(key,value) {
            params[key] = typeof params[key] !== 'undefined' ? params[key] : value;
        }

        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.mkd-content';
        targetSelector = typeof targetSelector !== 'undefined' ? targetSelector : '.mkd-content';
        
        // setting default ajax parameters
        params = typeof params !== 'undefined' ? params : {};

        setDefaultParam('url', window.location.href);
        setDefaultParam('type', 'POST');
        setDefaultParam('success', function(response) {
            var jResponse = $(response);

            var meta = jResponse.find('.mkd-meta');
            if (meta.length) { mkdHandleMeta(meta); }

            var new_content = jResponse.find(targetSelector);
            if (!new_content.length) {
                loadedPageFlag = true;
                return false;
            }
            else {
                mkdInsertFetchedContent(params.url, new_content, destinationSelector);
            }
        });

        // setting data parameters
        setDefaultParam('ajaxReq', 'yes');

        $.ajax({
            url: params.url,
            type: params.type,
            data: {
                ajaxReq: params.ajaxReq
            },
            success: params.success
        });
    }

    function mkdInitAjax() {
        mkd.body.removeClass('page-not-loaded'); // Might be necessary for ajax calls
		animation.loader = $('body > .mkd-smooth-transition-loader.mkd-ajax');
        if (animation.loader.length) {
            animation.loader.fadeOut(animation.loaderTime);
            $(window).focus(function() {
                animation.loader.fadeOut(animation.loaderTime);
            });

            if(mkd.body.hasClass('woocommerce') || mkd.body.hasClass('woocommerce-page')) {
                return false;
            }
            else {
                mkdInitBackBehavior();
                $(document).on('click', 'a[target!="_blank"]:not(.no-ajax):not(.no-link)', function(click) {
                    var link = $(this);

                    if(click.ctrlKey == 1) { // Check if CTRL key is held with the click
                        window.open(link.attr('href'), '_blank');
                        return false;
                    }

                    if(link.parents('.mkd-ptf-load-more').length){ return false; } // Don't initiate ajax for portfolio load more link

                    if(link.parents('.mkd-blog-load-more-button').length){ return false; } // Don't initiate ajax for blog load more link

                    if(link.parents('mkd-post-info-comments').length){ // If it's a comment link, don't load any content, just scroll to the comments section
                        var hash = link.attr('href').split("#")[1];  
                        $('html, body').scrollTop( $("#"+hash).offset().top );  
                        return false;  
                    }

                    if(window.location.href.split('#')[0] == link.attr('href').split('#')[0]){ return false; } //  If the link leads to the same page, don't use ajax

                    if(link.closest('.mkd-no-animation').length === 0){ // If no parents are set to no-animation...

                        if(document.location.href.indexOf("?s=") >= 0){ // Don't use ajax if currently on search page
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-admin") >= 0){ // Don't use ajax for wp-admin
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-content") >= 0){ // Don't use ajax for wp-content
                            return true;
                        }

                        if(jQuery.inArray(link.attr('href').split('#')[0], mkdGlobalVars.vars.no_ajax_pages) !== -1){ // If the target page is a no-ajax page, don't use ajax
                            document.location.href = link.attr('href');
                            return false;
                        }

                        if((link.attr('href') !== "http://#") && (link.attr('href') !== "#")){ // Don't use ajax if the link is empty

                            var url = link.attr('href');
                            var start = url.indexOf(window.location.protocol + '//' + window.location.host); // Check if the link leads to the same domain
                            if(start === 0){
                                if(!loadedPageFlag){ return false; } //if page is not loaded don't load next one
                                click.preventDefault();
                                click.stopImmediatePropagation();
                                click.stopPropagation();
                                if (!link.is('.current')) {
                                    mkdHandleLinkClick(link);
                                }
                            }

                        }else{
                            return false;
                        }
                    }
                });
            }
        }
    }

    function mkdInitBackBehavior() {
        if (window.history.pushState) {
            /* the below code is to override back button to get the ajax content without reload*/
            $(window).bind('popstate', function() {
                "use strict";

                var url = location.href;
                if (!firstLoad && loadedPageFlag) {
                    loadedPageFlag = false;
                    mkdFetchPage({
                        url: url
                    });
                }
            });
        }
    }

    function mkdHandleLinkClick(link) {
        loadedPageFlag = false;
        animation.loader.fadeIn(animation.loaderTime);
        mkdFetchPage({
            url: link.attr('href')
        });
    }

    function mkdSetActiveState(url) {
        var me = $("nav a[href='"+url+"'], .widget_nav_menu a[href='"+url+"']");

		$('.mkd-main-menu a, .mkd-mobile-nav a, .mkd-mobile-nav h4, .mkd-vertical-menu a, .popup_menu a, .widget_nav_menu a').removeClass('current').parent().removeClass('mkd-active-item');
		$('.widget_nav_menu ul.menu > li').removeClass('current-menu-item');

        me.each(function() {
            var me = $(this);

            if(me.closest('.second').length === 0){
                me.parent().addClass('mkd-active-item');
            }else{
                me.closest('.second').parent().addClass('mkd-active-item');
            }

            if(me.closest('.mkd-mobile-nav').length > 0){
                me.closest('.level0').addClass('mkd-active-item');
                me.closest('.level1').addClass('mkd-active-item');
                me.closest('.level2').addClass('mkd-active-item');
            }

            if(me.closest('.widget_nav_menu').length > 0){
                me.closest('.widget_nav_menu').find('.menu-item').addClass('current-menu-item');
            }


            me.addClass('current');
        });
    }

    function mkdReinitiateAll() {
        $(document).off(); // Remove all event handlers before reinitialization
		$(window).off();
        mkd.body.off().find('*').off(); // Remove all event handlers before reinitialization

        mkd.mkdOnDocumentReady();
        mkd.mkdOnWindowLoad();
        mkd.mkdOnWindowResize();
        mkd.mkdOnWindowScroll();

        var modules = ['common', 'ajax', 'header', 'title', 'shortcodes', 'woocommerce', 'portfolio', 'blog', 'like'];
        for (var i=0; i<modules.length; i++) {
            if (1 || typeof mkd.modules[modules[i]] !== 'undefined') {
                mkd.modules[modules[i]].mkdOnDocumentReady();
                mkd.modules[modules[i]].mkdOnWindowLoad();
                mkd.modules[modules[i]].mkdOnWindowResize();
                mkd.modules[modules[i]].mkdOnWindowScroll();
            }
        }
    }

    function mkdHandleMeta(meta_data) {
        // set up title, meta description and meta keywords
        var newTitle = meta_data.find(".mkd-seo-title").text();
        var pageTransition = meta_data.find(".mkd-page-transition").text();
        var newDescription = meta_data.find(".mkd-seo-description").text();
        var newKeywords = meta_data.find(".mkd-seo-keywords").text();
        if (typeof pageTransition !== 'undefined') {
            animation.type = pageTransition;
        } 
        if ($('head meta[name="description"]').length) {
            $('head meta[name="description"]').attr('content', newDescription);
        } else if (typeof newDescription !== 'undefined') {
            $('<meta name="description" content="'+newDescription+'">').prependTo($('head'));
        } 
        if ($('head meta[name="keywords"]').length) {
            $('head meta[name="keywords"]').attr('content', newKeywords);
        } else if (typeof newKeywords !== 'undefined') {
            $('<meta name="keywords" content="'+newKeywords+'">').prependTo($('head'));
        } 
        document.title = newTitle;

        var newBodyClasses = meta_data.find(".mkd-body-classes").text();
        var myArray = newBodyClasses.split(',');
        mkd.body.removeClass();
        for(var i=0;i<myArray.length;i++){
            if (myArray[i] !== "mkd-page-not-loaded"){
                mkd.body.addClass(myArray[i]);
            }
        }

        if($("#wp-admin-bar-edit").length > 0){
            // set up edit link when wp toolbar is enabled
            var pageId = meta_data.find("#mkd-page-id").text();
            var old_link = $('#wp-admin-bar-edit a').attr("href");
            var new_link = old_link.replace(/(post=).*?(&)/,'$1' + pageId + '$2');
            $('#wp-admin-bar-edit a').attr("href", new_link);
        }
    }

    function mkdInsertFetchedContent(url, new_content, destinationSelector) {
        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.mkd-content';
        var destination = mkd.body.find(destinationSelector);
        
        new_content.height(destination.height()).css({'position': 'absolute', 'opacity': 0, 'overflow': 'hidden'}).insertBefore(destination);
       
        new_content.waitForImages(function() {
            if (url.indexOf('#') !== -1) {
                $('<a class="mkd-temp-anchor mkd-anchor" href="'+url+'" style="display: none"></a>').appendTo('body');
            }
            mkdReinitiateAll();

            if (animation.type == "fade") {
                destination.stop().fadeTo(animation.time, 0, function() {
                    destination.remove();
                    if (window.history.pushState) {
                        if(url!==window.location.href){
                            window.history.pushState({path:url},'',url);
                        }

                        //does Google Analytics code exists on page?
                        if(typeof _gaq !== 'undefined') {
                            //add new url to Google Analytics so it can be tracked
                            _gaq.push(['_trackPageview', url]);
                        }
                    } else {
                        document.location.href = window.location.protocol + '//' + window.location.host + '#' + url.split(window.location.protocol + '//' + window.location.host)[1];
                    }
                    mkdSetActiveState(url);
                    mkd.body.animate({scrollTop: 0}, animation.time, 'swing');
                });
                setTimeout(function() {
                    new_content.css('position','relative').height('').stop().fadeTo(animation.time, 1, function() {
                        loadedPageFlag = true;
                        firstLoad = false;
                        animation.loader.fadeOut(animation.loaderTime, function() {
                            var anch = $('.mkd-temp-anchor');
                            if (anch.length) {
                                anch.trigger('click').remove();
                            }
                        });
                    });
                }, !animation.simultaneous * animation.time);
            }
        });
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
    header.mkdFullscreenMenu = mkdFullscreenMenu;

    header.mkdOnDocumentReady = mkdOnDocumentReady;
    header.mkdOnWindowLoad = mkdOnWindowLoad;
    header.mkdOnWindowResize = mkdOnWindowResize;
    header.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdHeaderBehaviour();
        mkdSideArea();
        mkdSideAreaScroll();
        mkdFullscreenMenu();
        mkdInitMobileNavigation();
        mkdMobileHeaderBehavior();
        //mkdSetDropDownMenuPosition();
        mkdDropDownMenu();
        mkdSearch();
        mkdVerticalMenu().init();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {
        mkdInitDividedHeaderMenu();
        //mkdSetDropDownMenuPosition();
        mkdDropDownMenu();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
        mkdDropDownMenu();
        mkdInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {
        
    }



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
                var setStickyScrollAmount = function() {
                    var amount;

                    if(isStickyAmountFullScreen()) {
                        amount = mkd.window.height();
                    } else {
                        if(mkdPerPageVars.vars.mkdStickyScrollAmount !== 0) {
                            amount = mkdPerPageVars.vars.mkdStickyScrollAmount;
                        } else {
                            amount = mkdGlobalVars.vars.mkdTopBarHeight + mkdGlobalVars.vars.mkdLogoAreaHeight + mkdGlobalVars.vars.mkdMenuAreaHeight;
                        }
                    }
                    console.log(mkdGlobalVars.vars.mkdTopBarHeight);
                    console.log(mkdGlobalVars.vars.mkdLogoAreaHeight);
                    console.log(mkdGlobalVars.vars.mkdMenuAreaHeight);
                    stickyAppearAmount = amount;
                };

                var isStickyAmountFullScreen = function() {
                    var fullScreenStickyAmount = mkdPerPageVars.vars.mkdStickyScrollAmountFullScreen;

                    return typeof fullScreenStickyAmount !== 'undefined' && fullScreenStickyAmount === true;
                };
                
                mkd.modules.header.behaviour = 'mkd-sticky-header-on-scroll-down-up';
                setStickyScrollAmount();
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

    /**
     * Init Divided Header Menu
     */
    function mkdInitDividedHeaderMenu(){
        if(mkd.body.hasClass('mkd-header-divided')){
            //get left side menu width
            var menuArea = $('.mkd-menu-area'),
                stickyArea = $('.mkd-sticky-holder'),
                menuAreaWidth = menuArea.width(),
                stickyAreaWidth = stickyArea.width(),
                menuAreaItem = $('.mkd-main-menu > ul > li > a'),
                menuItemPadding = 0,
                logoArea = menuArea.find('.mkd-logo-wrapper .mkd-normal-logo'),
                logoAreaWidth = 0;

            if(menuArea.children('.mkd-grid').length) {
                menuAreaWidth = menuArea.children('.mkd-grid').outerWidth();
            }

            if(stickyArea.children('.mkd-grid').length) {
                stickyAreaWidth = stickyArea.children('.mkd-grid').outerWidth();
            }

            if(menuAreaItem.length) {
                menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
            }

            if(logoArea.length) {
                logoAreaWidth = logoArea.width() / 2;
            }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth);
            var stickyAreaLeftRightSideWidth = Math.round(stickyAreaWidth/2 - menuItemPadding - logoAreaWidth);

            $('.mkd-menu-area .mkd-position-left').width(menuAreaLeftRightSideWidth);
            $('.mkd-menu-area .mkd-position-right').width(menuAreaLeftRightSideWidth);

            $('.mkd-sticky-header .mkd-position-left').width(stickyAreaLeftRightSideWidth);
            $('.mkd-sticky-header .mkd-position-right').width(stickyAreaLeftRightSideWidth);

            menuArea.css('opacity',1);
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
                    navigationHolder.slideUp(animationSpeed);
                } else {
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

        $('.mkd-mobile-nav a, .mkd-mobile-logo-wrapper a').on('click tap', function(e) {
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
        menuItems.each( function(i) {

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
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();

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

                    if(!$(this).hasClass('wide_background')) {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = (mkd.windowWidth - 2 * (mkd.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;

                            dropDownSecondDiv.css('left', -left_position);
                        }
                    } else {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = dropDownSecondDiv.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', mkd.windowWidth);

                        }
                    }
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
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 200, function() {
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

                mkdFullscreenSearch();

            } else if ( mkd.body.hasClass( 'mkd-search-slides-from-window-top' ) ) {

                searchForm = $('.mkd-search-slide-window-top');
                searchClose = $('.mkd-search-close');
                mkdSearchWindowTop();

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

                var yPos = 0;
                if($('.title').hasClass('has_parallax_background')){
                    yPos = parseInt($('.title.has_parallax_background').css('backgroundPosition').split(" ")[1]);
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
         * Search covers header type of search
         */
        function mkdSearchCoversHeader() {

            searchOpener.click( function(e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.mkd-search-cover .mkd-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid

                if($(this).closest('.mkd-grid').length){
                    searchForm = $(this).closest('.mkd-grid').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                else{
                    searchForm = $(this).closest('.mkd-menu-area').children().first();
                    searchFormLandmark = searchForm;
                }

                if ( $(this).closest('.mkd-sticky-header').length > 0 ) {
                    searchForm = $(this).closest('.mkd-sticky-header').children().first();
                }
                if ( $(this).closest('.mkd-mobile-header').length > 0 ) {
                    searchForm = $(this).closest('.mkd-mobile-header').children().children().first();
                }

                //Find search form position in header and height
                if ( searchFormLandmark.parent().hasClass('mkd-logo-area') ) {
                    searchFormHeight = mkdGlobalVars.vars.mkdLogoAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('mkd-top-bar') ) {
                    searchFormHeight = mkdGlobalVars.vars.mkdTopBarHeight;
                } else if ( searchFormLandmark.parent().hasClass('mkd-menu-area') ) {
                    searchFormHeight = mkdGlobalVars.vars.mkdMenuAreaHeight;
                } else if ( searchFormLandmark.hasClass('mkd-sticky-header') ) {
                    searchFormHeight = mkdGlobalVars.vars.mkdMenuAreaHeight;
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

        }

        /**
         * Fullscreen search (two types: fade and from circle)
         */
        function mkdFullscreenSearch( fade, fromCircle ) {

            var searchHolder = $( '.mkd-fullscreen-search-holder'),
                searchOverlay = $( '.mkd-fullscreen-search-overlay' ),
                fieldHolder = searchHolder.find('.mkd-field-holder');

            searchOpener.click( function(e) {
                e.preventDefault();

                //Fullscreen search fade
                if ( searchHolder.hasClass( 'mkd-animate' ) ) {
                    searchClose();
                } else {
                    searchOpen();
                }

                //Close on click away
                $(document).mouseup(function (e) {
                    if (!fieldHolder.is(e.target) && fieldHolder.has(e.target).length === 0)  {
                        e.preventDefault();
                        searchClose();
                    }
                });
                //Close on escape
                $(document).keyup(function(e){
                    if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                        searchClose();
                    }
                });

                function searchClose() {
                    mkd.body.removeClass('mkd-fullscreen-search-opened');
                    searchHolder.removeClass('mkd-animate');
                    mkd.body.removeClass('mkd-search-fade-in');
                    mkd.body.addClass('mkd-search-fade-out');
                    if(!mkd.body.hasClass('page-template-full_screen-php')){
                        mkd.modules.common.mkdEnableScroll();
                    }
                    fieldHolder.find('.mkd-search-field').blur().val('');
                }

                function searchOpen() {
                    mkd.body.addClass('mkd-fullscreen-search-opened');
                    mkd.body.removeClass('mkd-search-fade-out');
                    mkd.body.addClass('mkd-search-fade-in');
                    searchHolder.addClass('mkd-animate');
                    if(!mkd.body.hasClass('page-template-full_screen-php')){
                        mkd.modules.common.mkdDisableScroll();
                    }
                    setTimeout(function(){
                        fieldHolder.find('.mkd-search-field').focus();
                    },400);
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

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var mkdVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.mkd-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */


        /**
         * Checks if vertical area is scrollable (if it has mkd-with-scroll class)
         *
         * @returns {bool}
         */

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.mkd-vertical-menu');
            var navigationType = typeof verticalNavObject.data('navigation-type') !== 'undefined' ? verticalNavObject.data('navigation-type') : '';

            switch(navigationType) {
                default:
                    dropdownFloat();
                    break;
            }


            /**
             * Initializes floating navigation type (it comes from the side as a dropdown)
             */
            function dropdownFloat() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
                var allDropdowns = menuItems.find(' > .second, > ul');

                menuItems.each(function() {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;

                    if(Modernizr.touch) {
                        var dropdownOpener = $(this).find('> a');

                        dropdownOpener.on('click tap', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if(elementToExpand.hasClass('mkd-float-open')) {
                                elementToExpand.removeClass('mkd-float-open');
                                $(menuItem).removeClass('open');
                            } else {
                                if(!$(this).parents('li').hasClass('open')) {
                                    menuItems.removeClass('open');
                                    allDropdowns.removeClass('mkd-float-open');
                                }

                                elementToExpand.addClass('mkd-float-open');
                                $(menuItem).addClass('open');
                            }
                        });
                    } else {
                        //must use hoverIntent because basic hover effect doesn't catch dropdown
                        //it doesn't start from menu item's edge
                        $(this).hoverIntent({
                            over: function() {
                                elementToExpand.addClass('mkd-float-open');
                                $(menuItem).addClass('open');
                            },
                            out: function() {
                                elementToExpand.removeClass('mkd-float-open');
                                $(menuItem).removeClass('open');
                            },
                            timeout: 300
                        });
                    }
                });
            }

        };



        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                }
            }
        };
    };

    /**
     * Init Fullscreen Menu
     */
    function mkdFullscreenMenu() {

        if ($('a.mkd-fullscreen-menu-opener').length) {

            var popupMenuOpener = $( 'a.mkd-fullscreen-menu-opener'),
                popupMenuHolderOuter = $(".mkd-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Logo
                logo = $('.mkd-fullscreen-logo-wrapper'),
            //Widgets
                widgetAboveNav = $('.mkd-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.mkd-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.mkd-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.mkd-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.mkd-fullscreen-menu ul li:not(.has_sub) a');


            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(mkd.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(mkd.windowHeight);
            });

            if (mkd.body.hasClass('mkd-fade-push-text-right')) {
                cssClass = 'mkd-push-nav-right';
                fadeRight = true;
            } else if (mkd.body.hasClass('mkd-fade-push-text-top')) {
                cssClass = 'mkd-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if(logo.length){
                    logo.css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }

                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 70 + 'ms',
                        '-moz-animation-delay' : 70 + 'ms',
                        'animation-delay' : 70 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+2) * 70 + 'ms',
                        '-moz-animation-delay': (i+2) * 70 + 'ms',
                        'animation-delay': (i+2) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 2)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 2)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 2)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('opened')) {
                    popupMenuOpener.addClass('opened');
                    mkd.body.addClass('mkd-fullscreen-menu-opened');
                    mkd.body.removeClass('mkd-fullscreen-fade-out').addClass('mkd-fullscreen-fade-in');
                    mkd.body.removeClass(cssClass);
                    if(!mkd.body.hasClass('page-template-full_screen-php')){
                        mkd.modules.common.mkdDisableScroll();
                    }
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            popupMenuOpener.removeClass('opened');
                            mkd.body.removeClass('mkd-fullscreen-menu-opened');
                            mkd.body.removeClass('mkd-fullscreen-fade-in').addClass('mkd-fullscreen-fade-out');
                            mkd.body.addClass(cssClass);
                            if(!mkd.body.hasClass('page-template-full_screen-php')){
                                mkd.modules.common.mkdEnableScroll();
                            }
                            $("nav.mkd-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('opened');
                    mkd.body.removeClass('mkd-fullscreen-menu-opened');
                    mkd.body.removeClass('mkd-fullscreen-fade-in').addClass('mkd-fullscreen-fade-out');
                    mkd.body.addClass(cssClass);
                    if(!mkd.body.hasClass('page-template-full_screen-php')){
                        mkd.modules.common.mkdEnableScroll();
                    }
                    $("nav.mkd-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                if ($(this).parent().hasClass('has_sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.click(function (e) {

                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){

                    if (e.which == 1) {
                        popupMenuOpener.removeClass('opened');
                        mkd.body.removeClass('mkd-fullscreen-menu-opened');
                        mkd.body.removeClass('mkd-fullscreen-fade-in').addClass('mkd-fullscreen-fade-out');
                        mkd.body.addClass(cssClass);
                        $("nav.mkd-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        mkd.modules.common.mkdEnableScroll();
                    }
                }else{
                    return false;
                }

            });

        }



    }

})(jQuery);
(function($) {
    "use strict";

    var title = {};
    mkd.modules.title = title;

    title.mkdParallaxTitle = mkdParallaxTitle;

    title.mkdOnDocumentReady = mkdOnDocumentReady;
    title.mkdOnWindowLoad = mkdOnWindowLoad;
    title.mkdOnWindowResize = mkdOnWindowResize;
    title.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {

    }
    

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

})(jQuery);

(function ($) {
	'use strict';

	var shortcodes = {};

	mkd.modules.shortcodes = shortcodes;

	shortcodes.mkdInitCounter = mkdInitCounter;
	shortcodes.mkdInitProgressBars = mkdInitProgressBars;
	shortcodes.mkdInitCountdown = mkdInitCountdown;
	shortcodes.mkdInitMessages = mkdInitMessages;
	shortcodes.mkdInitMessageHeight = mkdInitMessageHeight;
	shortcodes.mkdInitTestimonials = mkdInitTestimonials;
	shortcodes.mkdInitCarousels = mkdInitCarousels;
	shortcodes.mkdInitPieChart = mkdInitPieChart;
	shortcodes.mkdInitPieChartDoughnut = mkdInitPieChartDoughnut;
	shortcodes.mkdInitTabs = mkdInitTabs;
	shortcodes.mkdTwitterSlider = mkdTwitterSlider;
	shortcodes.mkdInitTabIcons = mkdInitTabIcons;
	shortcodes.mkdInitBlogListMasonry = mkdInitBlogListMasonry;
	shortcodes.mkdCustomFontResize = mkdCustomFontResize;
	shortcodes.mkdInitImageGallery = mkdInitImageGallery;
	shortcodes.mkdInitAccordions = mkdInitAccordions;
	shortcodes.mkdShowGoogleMap = mkdShowGoogleMap;
	shortcodes.mkdInitPortfolioListMasonry = mkdInitPortfolioListMasonry;
	shortcodes.mkdInitPortfolioListPinterest = mkdInitPortfolioListPinterest;
	shortcodes.mkdInitPortfolio = mkdInitPortfolio;
	shortcodes.mkdInitPortfolioMasonryFilter = mkdInitPortfolioMasonryFilter;
	shortcodes.mkdInitPortfolioLoadMore = mkdInitPortfolioLoadMore;
	shortcodes.mkdCheckSliderForHeaderStyle = mkdCheckSliderForHeaderStyle;
	shortcodes.mkdInfoBox = mkdInfoBox;
	shortcodes.mkdProcess = mkdProcess;
	shortcodes.mkdComparisonPricingTables = mkdComparisonPricingTables;
	shortcodes.mkdProgressBarVertical = mkdProgressBarVertical;
	shortcodes.mkdIconProgressBar = mkdIconProgressBar;
	shortcodes.mkdBlogSlider = mkdBlogSlider;
	shortcodes.teamSlider = teamSlider;
	shortcodes.processSlider = processSlider;
	shortcodes.mkdOnDocumentReady = mkdOnDocumentReady;
	shortcodes.mkdOnWindowLoad = mkdOnWindowLoad;
	shortcodes.mkdOnWindowResize = mkdOnWindowResize;
	shortcodes.mkdOnWindowScroll = mkdOnWindowScroll;
	shortcodes.emptySpaceResponsive = emptySpaceResponsive;
	shortcodes.mkdZoomingSlider = mkdZoomingSlider;
	shortcodes.mkdInitVerticalSplitSlider = mkdInitVerticalSplitSlider;
	shortcodes.mkdThumbnailImageSlider = mkdThumbnailImageSlider;
	shortcodes.mkdStaticTextSlider = mkdStaticTextSlider;
	shortcodes.mkdTabSlider = mkdTabSlider;
	shortcodes.mkdProductSlider = mkdProductSlider;
	shortcodes.mkdTypeOutSectionTitle = mkdTypeOutSectionTitle;
	shortcodes.mkdWorkflow = mkdWorkflow;

	$(document).ready(mkdOnDocumentReady);
	$(window).load(mkdOnWindowLoad);
	$(window).resize(mkdOnWindowResize);
	$(window).scroll(mkdOnWindowScroll);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdOnDocumentReady() {
        mkdLazyImages(); //has to be on first place in order to set proper image heights
		mkdInitCounter();
		mkdInitProgressBars();
		mkdInitCountdown();
		mkdIcon().init();
		mkdInitMessages();
		mkdInitMessageHeight();
		mkdInitCarousels();
		mkdInitPieChart();
		mkdInitPieChartDoughnut();
		mkdInitTabs();
		mkdTwitterSlider();
		mkdInitTabIcons();
		mkdButton().init();
		mkdInitBlogListMasonry();
		mkdCustomFontResize();
		mkdInitImageGallery();
		mkdBlogSlider();
		teamSlider();
		processSlider();
		mkdInitAccordions();
		mkdShowGoogleMap();
		mkdInitPortfolioListMasonry();
		mkdInitPortfolioListPinterest();
		mkdInitPortfolio();
		mkdInitPortfolioMasonryFilter();
		mkdInitPortfolioLoadMore();
		mkdSlider().init();
		mkdSocialIconWidget().init();
		mkdProcess().init();
		mkdComparisonPricingTables().init();
		mkdProgressBarVertical().init();
		mkdIconProgressBar().init();
		emptySpaceResponsive().init();
		mkdZoomingSlider();
		mkdInitVerticalSplitSlider();
		mkdInitTestimonials(); //after split slider because of the init ordering
		mkdThumbnailImageSlider();
		mkdStaticTextSlider();
		mkdTabSlider();
		mkdTypeOutSectionTitle();
		mkdWorkflow();
        mkdCardsSlider().init();
        mkdCardsGallery();

	}

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdOnWindowLoad() {
		mkdInfoBox();
		mkdProductSlider();
		mkdDeviceSlider();
        mkdExpandingImages();
        mkdCardsSlider().load();
		mkd.modules.common.mkdInitParallax(); //on last place in order to reinitialize after all shortcodes
	}

	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function mkdOnWindowResize() {
		mkdInitBlogListMasonry();
		mkdCustomFontResize();
		mkdInitPortfolioListMasonry();
		mkdInitPortfolioListPinterest();
	}

	/*
	 All functions to be called on $(window).scroll() should be in this function
	 */
	function mkdOnWindowScroll() {
        mkdLazyImages();
	}

	/**
	 * Counter Shortcode
	 */
	function mkdInitCounter() {

		var counters = $('.mkd-counter');


		if (counters.length) {
			counters.each(function () {
				var counter = $(this);
				counter.appear(function () {
					counter.parent().addClass('mkd-counter-holder-show');

					//Counter zero type
					if (counter.hasClass('zero')) {
						var max = parseFloat(counter.text());
						counter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						counter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}

				}, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			});
		}

	}

	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdInitProgressBars() {

		var progressBar = $('.mkd-progress-bar');

		if (progressBar.length) {

			progressBar.each(function () {

				var thisBar = $(this);

				thisBar.appear(function () {
					mkdInitToCounterProgressBar(thisBar);
					if (thisBar.find('.mkd-floating.mkd-floating-inside') !== 0) {
						var floatingInsideMargin = thisBar.find('.mkd-progress-content').height();
						floatingInsideMargin += parseFloat(thisBar.find('.mkd-progress-title-holder').css('padding-bottom'));
						floatingInsideMargin += parseFloat(thisBar.find('.mkd-progress-title-holder').css('margin-bottom'));
						thisBar.find('.mkd-floating-inside').css('margin-bottom', -(floatingInsideMargin) + 'px');
					}
					var percentage = thisBar.find('.mkd-progress-content').data('percentage'),
						progressContent = thisBar.find('.mkd-progress-content'),
						progressNumber = thisBar.find('.mkd-progress-number');

					progressContent.css('width', '0%');
					progressContent.animate({'width': percentage + '%'}, 1500);
					progressNumber.css('left', '0%');
					progressNumber.animate({'left': percentage + '%'}, 1500);

				});
			});
		}
	}

	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function mkdInitToCounterProgressBar(progressBar) {
		var percentage = parseFloat(progressBar.find('.mkd-progress-content').data('percentage'));
		var percent = progressBar.find('.mkd-progress-number .mkd-percent');
		if (percent.length) {
			percent.each(function () {
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

	/*
	 **	Function to close message shortcode
	 */
	function mkdInitMessages() {
		var message = $('.mkd-message');
		if (message.length) {
			message.each(function () {
				var thisMessage = $(this);
				thisMessage.find('.mkd-close').click(function (e) {
					e.preventDefault();
					$(this).parent().parent().fadeOut(500);
				});
			});
		}
	}

	/*
	 **	Init message height
	 */
	function mkdInitMessageHeight() {
		var message = $('.mkd-message.mkd-with-icon');
		if (message.length) {
			message.each(function () {
				var thisMessage = $(this);
				var textHolderHeight = thisMessage.find('.mkd-message-text-holder').height();
				var iconHolderHeight = thisMessage.find('.mkd-message-icon-holder').height();

				if (textHolderHeight > iconHolderHeight) {
					thisMessage.find('.mkd-message-icon-holder').height(textHolderHeight);
				} else {
					thisMessage.find('.mkd-message-text-holder').height(iconHolderHeight);
				}
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
			secondLabel;

		if (countdowns.length) {

			countdowns.each(function () {

				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#' + countdownId),
					digitFontSize,
					digitColor,
					labelFontSize,
					labelColor;

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
				digitFontSize = countdown.data('digit-size');
				digitColor = countdown.data('digit-color');
				labelFontSize = countdown.data('label-size');
				labelColor = countdown.data('label-color');

				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month - 1, day, hour, minute, 44),
					labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'yodHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});

				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size': digitFontSize + 'px',
						'line-height': digitFontSize + 'px',
						'color': digitColor
					});
					countdown.find('.countdown-period').css({
						'font-size': labelFontSize + 'px',
						'color': labelColor
					});
				}

			});

		}

	}

	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdIcon = mkd.modules.shortcodes.mkdIcon = function () {
		//get all icons on page
		var icons = $('.mkd-icon-shortcode');

		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function (icon) {
			if (icon.hasClass('mkd-icon-animation')) {
				icon.appear(function () {
					icon.parent('.mkd-icon-animation-holder').addClass('mkd-icon-animation-show');
				}, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			}
		};

		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function (icon) {
			if (typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function (event) {
					event.data.icon.css('color', event.data.color);
				};

				var iconElement = icon.find('.mkd-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');

				if (hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};

		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function (icon) {
			if (typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function (event) {
					event.data.icon.css('background-color', event.data.color);
				};

				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');

				if (hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};

		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function (icon) {
			if (typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function (event) {
					event.data.icon.css('border-color', event.data.color);
				};

				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('border-color');

				if (hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};

		return {
			init: function () {
				if (icons.length) {
					icons.each(function () {
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
	 * Object that represents social icon widget
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdSocialIconWidget = mkd.modules.shortcodes.mkdSocialIconWidget = function () {
		//get all social icons on page
		var icons = $('.mkd-social-icon-widget-holder');

		/**
		 * Function that triggers icon hover color functionality
		 */
		var socialIconHoverColor = function (icon) {
			if (typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function (event) {
					event.data.icon.css('color', event.data.color);
				};

				var iconElement = icon;
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');

				if (hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};

		return {
			init: function () {
				if (icons.length) {
					icons.each(function () {
						socialIconHoverColor($(this));
					});

				}
			}
		};
	};

	/**
	 * Init testimonials shortcode
	 */
	function mkdInitTestimonials() {

		var testimonial = $('.mkd-testimonials.testimonials-slider');
		if (testimonial.length) {
			testimonial.each(function () {

				var thisTestimonial = $(this);

				var animateIn = 'fadeInRight';
				var animateOut = 'fadeOutLeft';

				var animationSpeed = 800;
				if (typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
					animationSpeed = thisTestimonial.data('animation-speed');
				}

				if (!thisTestimonial.hasClass('owl-carousel')) {
					thisTestimonial.addClass('owl-carousel');
				}

				var dotsColor = $(this).data('navigation_color');
				var dotsActiveColor = $(this).data('navigation_active_color');

				thisTestimonial.owlCarousel({
					items: 1,
					autoHeight: true,
					autoplay: true,
					autoplayTimeout: 3000,
					autoplayHoverPause: true,
					loop: true,
					nav: false,
					dots: true,
					smartSpeed: animationSpeed,
					onInitialized: function () {
						thisTestimonial.css('visibility', 'visible');
						if (dotsColor !== '' && dotsActiveColor != '') {
							thisTestimonial.find('.owl-dot span').css({'background-color': dotsColor});
							thisTestimonial.find('.owl-dot.active span').css({'background-color': dotsActiveColor});
						}
					},
					animateIn: animateIn,
					animateOut: animateOut
				});

				if (dotsColor !== '' && dotsActiveColor != '') {
					thisTestimonial.on('changed.owl.carousel', function () {
						thisTestimonial.find('.owl-dot span').css({'background-color': dotsColor});
						thisTestimonial.find('.owl-dot.active span').css({'background-color': dotsActiveColor});
					});
				}

			});

		}

	}

	/**
	 * Init Carousel shortcode
	 */
	function mkdInitCarousels() {

		var carouselHolders = $('.mkd-carousel-holder'),
			carousel,
			numberOfItems;

		if (carouselHolders.length) {
			carouselHolders.each(function () {
				carousel = $(this).children('.mkd-carousel');
				numberOfItems = carousel.data('items');

				carousel.waitForImages(function () {
					carousel.css('visibility', 'visible');
					if (!carousel.hasClass('owl-carousel')) {
						carousel.addClass('owl-carousel');
					}
				});

				var showNav = carousel.data('navigation');

				if (typeof showNav !== 'undefined') {
					showNav = showNav === 'yes';
				} else {
					showNav = false;
				}

				carousel.owlCarousel({
					autoplay: true,
					autoplayInterval: 3000,
					autoplayHoverPause: true,
					loop: true,
					nav: showNav,
					dots: false,
					items: numberOfItems,
					responsive: {
						0: {
							items: 1
						},
						480: {
							items: 2
						},
						768: {
							items: 3
						},
						1024: {
							items: numberOfItems
						}
					},
					smartSpeed: 600,
					navText: [
						'<span class="mkd-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
						'<span class="mkd-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
					]
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
					barColor,
					trackColor,
					lineWidth,
					size = 155;

				if (typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}

				if (typeof percentageHolder.data('size') !== 'undefined' && percentageHolder.data('size') !== '') {
					size = percentageHolder.data('size');
				}

				if (typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}

				percentageHolder.appear(function () {
					initToCounterPieChart(pieChart);
					percentageHolder.css('opacity', '1');

					percentageHolder.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: 6,
						animate: 1500,
						size: size
					});
				}, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

			});

		}

	}

	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart) {

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

	/**
	 * Init Pie Chart shortcode
	 */
	function mkdInitPieChartDoughnut() {

		var pieCharts = $('.mkd-pie-chart-doughnut-holder, .mkd-pie-chart-pie-holder');

		pieCharts.each(function () {

			var pieChart = $(this),
				canvas = pieChart.find('canvas'),
				chartID = canvas.attr('id'),
				chart = document.getElementById(chartID).getContext('2d'),
				data = [],
				jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

			for (var i = 1; i <= 10; i++) {

				var chartItem,
					value = jqChart.data('value-' + i),
					color = jqChart.data('color-' + i);

				if (typeof value !== 'undefined' && typeof color !== 'undefined') {
					chartItem = {
						value: value,
						color: color
					};
					data.push(chartItem);
				}

			}

			if (canvas.hasClass('mkd-pie')) {
				new Chart(chart).Pie(data,
					{segmentStrokeColor: 'transparent'}
				);
			} else {
				new Chart(chart).Doughnut(data,
					{segmentStrokeColor: 'transparent'}
				);
			}

		});

	}

	/*
	 **	Init tabs shortcode
	 */
	function mkdInitTabs() {

		var tabs = $('.mkd-tabs');
		if (tabs.length) {
			tabs.each(function () {
				var thisTabs = $(this);

				thisTabs.children('.mkd-tab-container').each(function (index) {
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.mkd-tabs-nav li:nth-child(' + index + ') a'),
						navLink = navItem.attr('href');

					link = '#' + link;

					if (link.indexOf(navLink) > -1) {
						navItem.attr('href', link);
					}
				});

				if (thisTabs.hasClass('mkd-horizontal')) {
					thisTabs.tabs();
				}
				else if (thisTabs.hasClass('mkd-vertical')) {
					thisTabs.tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
					thisTabs.find('.mkd-tabs-nav > ul >li').removeClass('ui-corner-top').addClass('ui-corner-left');
				}

				/*
				 * Tabs Content animation
				 */
				var tabContent = thisTabs.find('.mkd-tab-container');

				showTabContent(tabContent); // initial appear

				thisTabs.find('li:not(.mkd-tab-line)').each(function () {
					var singleTab = $(this);
					singleTab.click(function () {
						setTimeout(function () {
							showTabContent(tabContent);
						}, 50);
					});
				});

				function showTabContent(tabContent) {
					tabContent.each(function () {
						var thisTabContent = $(this);
						if (thisTabContent.is(':visible')) {
							thisTabContent.addClass('mkd-visible');
						} else {
							thisTabContent.removeClass('mkd-visible');
						}
					});
				}

				/*
				 * Tabs Follow animation
				 */
				//horizontal tabs
				if (thisTabs.hasClass('mkd-horizontal')) {
					var tab = thisTabs.find('> ul > li:not(.mkd-tab-line)'),
						tabLine = thisTabs.find('.mkd-tab-line');

					if (mkd.windowWidth >= 1024) { //tabs in default layout

						tabLine.css({width: tab.first().outerWidth()});
						tabLine.css({left: 0});

						tab.each(function () {
							var thisTab = $(this);
							thisTab.mouseenter(function () {
								tabLine.css({width: thisTab.outerWidth()});
								tabLine.css({left: thisTab.offset().left - thisTab.parent().offset().left});
							});
						});

						thisTabs.find('> ul').mouseleave(function () {
							tabLine.css({width: tab.filter('.ui-tabs-active').outerWidth()});
							tabLine.css({left: tab.filter('.ui-tabs-active').offset().left - tab.filter('.ui-tabs-active').parent().offset().left});
						});

					} else { //tabs are on top of each other, responsive layout

						tab.each(function () {
							tabLine.css({width: '100%'});
							tabLine.css({'transition': 'none'});
							var thisTab = $(this);
							thisTab.click(function () {
								tabLine.css({top: thisTab.offset().top - thisTab.parent().offset().top + thisTab.height()});
							});
						});

					}
				}
				//vertical tabs
				if (thisTabs.hasClass('mkd-vertical')) {
					var tab = thisTabs.find('> ul > li'),
						tabLine = thisTabs.find('.mkd-tab-line');

					tabLine.css({height: tab.first().outerHeight()});
					tabLine.css({top: 0});

					tab.each(function () {
						var thisTab = $(this);
						thisTab.mouseenter(function () {
							tabLine.css({height: thisTab.outerHeight()});
							tabLine.css({top: thisTab.offset().top - thisTab.parent().offset().top});
						});
					});

					thisTabs.find('> ul').mouseleave(function () {
						tabLine.css({height: tab.filter('.ui-tabs-active').outerHeight()});
						tabLine.css({top: tab.filter('.ui-tabs-active').offset().top - tab.filter('.ui-tabs-active').parent().offset().top});
					});
				}


			});
		}
	}

	/*
	 **	Generate icons in tabs navigation
	 */
	function mkdInitTabIcons() {

		var tabContent = $('.mkd-tab-container');
		if (tabContent.length) {

			tabContent.each(function () {
				var thisTabContent = $(this);

				var id = thisTabContent.attr('id');
				var icon = '';
				if (typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
					icon = thisTabContent.data('icon-html');
				}

				var tabNav = thisTabContent.parents('.mkd-tabs').find('.mkd-tabs-nav > li > a[href="#' + id + '"]');

				if (typeof(tabNav) !== 'undefined') {
					tabNav.children('.mkd-icon-frame').append(icon);
				}
			});
		}
	}

	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var mkdButton = mkd.modules.shortcodes.mkdButton = function () {
		//all buttons on the page
		var buttons = $('.mkd-btn');

		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function (button) {
			if (typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function (event) {
					event.data.button.css('color', event.data.color);
				};

				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');

				button.on('mouseenter', {button: button, color: hoverColor}, changeButtonColor);
				button.on('mouseleave', {button: button, color: originalColor}, changeButtonColor);
			}
		};


		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function (button) {
			if (typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function (event) {
					event.data.button.css('background-color', event.data.color);
				};

				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');

				button.on('mouseenter', {button: button, color: hoverBgColor}, changeButtonBg);
				button.on('mouseleave', {button: button, color: originalBgColor}, changeButtonBg);
			}
		};

		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function (button) {
			if (typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function (event) {
					event.data.button.css('border-color', event.data.color);
				};

				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');

				button.on('mouseenter', {button: button, color: hoverBorderColor}, changeBorderColor);
				button.on('mouseleave', {button: button, color: originalBorderColor}, changeBorderColor);
			}
		};

		return {
			init: function () {
				if (buttons.length) {
					buttons.each(function () {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};

	/*
	 **	Init blog list masonry type
	 */
	function mkdInitBlogListMasonry() {
		var blogList = $('.mkd-blog-list-holder.mkd-masonry .mkd-blog-list');
		if (blogList.length) {
			blogList.each(function () {
				var thisBlogList = $(this);
				thisBlogList.animate({opacity: 1});
				thisBlogList.isotope({
					itemSelector: '.mkd-blog-list-masonry-item',
					masonry: {
						columnWidth: '.mkd-blog-list-masonry-grid-sizer',
						gutter: '.mkd-blog-list-masonry-grid-gutter'
					}
				});
			});

		}
	}

	/*
	 **	Custom Font resizing
	 */
	function mkdCustomFontResize() {
		var customFont = $('.mkd-custom-font-holder');
		if (customFont.length) {
			customFont.each(function () {
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (mkd.windowWidth < 1200) {
					coef1 = 0.8;
				}

				if (mkd.windowWidth < 1000) {
					coef1 = 0.7;
				}

				if (mkd.windowWidth < 768) {
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (mkd.windowWidth < 600) {
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (mkd.windowWidth < 480) {
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize * coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize * coef2);
					}

					thisCustomFont.css('font-size', fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && mkd.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && mkd.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else {
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
	function mkdShowGoogleMap() {

		if ($('.mkd-google-map').length) {
			$('.mkd-google-map').each(function () {

				var element = $(this);

				var customMapStyle;
				if (typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}

				var colorOverlay;
				if (typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}

				var saturation;
				if (typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}

				var lightness;
				if (typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}

				var zoom;
				if (typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}

				var pin;
				if (typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}

				var mapHeight;
				if (typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}

				var uniqueId;
				if (typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}

				var scrollWheel;
				if (typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if (typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}

				var map = "map_" + uniqueId;
				var geocoder = "geocoder_" + uniqueId;
				var holderId = "mkd-map-" + uniqueId;

				mkdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses);
			});
		}

	}

	/*
	 **	Init Google Map
	 */
	function mkdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data) {

		var mapStyles = [
			{
				stylers: [
					{hue: color},
					{saturation: saturation},
					{lightness: lightness},
					{gamma: 1}
				]
			}
		];

		var googleMapStyleId;

		if (customMapStyle) {
			googleMapStyleId = 'mkd-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}

		var qoogleMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Mikado Google Map"});

		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);

		if (!isNaN(height)) {
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
	function mkdInitializeGoogleAddress(data, pin, map, geocoder) {
		if (data === '')
			return;
		var contentString = '<div id="content">' +
			'<div id="siteNotice">' +
			'</div>' +
			'<div id="bodyContent">' +
			'<p>' + data + '</p>' +
			'</div>' +
			'</div>';
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		geocoder.geocode({'address': data}, function (results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon: pin,
					title: data['store_title']
				});
				google.maps.event.addListener(marker, 'click', function () {
					infowindow.open(map, marker);
				});

				google.maps.event.addDomListener(window, 'resize', function () {
					map.setCenter(results[0].geometry.location);
				});

			}
		});
	}

	function mkdInitAccordions() {
		var accordion = $('.mkd-accordion-holder');
		if (accordion.length) {
			accordion.each(function () {

				var thisAccordion = $(this);

				if (thisAccordion.hasClass('mkd-accordion')) {

					thisAccordion.accordion({
						animate: "swing",
						collapsible: false,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if (thisAccordion.hasClass('mkd-toggle')) {

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.mkd-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function () {
						var thisTitle = $(this);
						thisTitle.hover(function () {
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click', function () {
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
					autoplay = false,
					autoplayInterval = gallery.data('autoplay'),
					animation,
					animateIn,
					animateOut,
					navigation = (gallery.data('navigation') == 'yes'),
					pagination = (gallery.data('pagination') == 'yes');

				if (autoplayInterval != '') {
					autoplay = true;
				}

				if (animation = (gallery.data('animation') == 'slide')) {
					animateIn = 'slideInRight';
					animateOut = 'slideOutLeft';
				} else if (animation = (gallery.data('animation') == 'fade')) {
					animateIn = 'fadeIn';
					animateOut = 'fadeOut';
				} else if (animation = (gallery.data('animation') == 'fadeUp')) {
					animateIn = 'fadeInUp';
					animateOut = 'fadeOutUp';
				} else if (animation = (gallery.data('animation') == 'backSlide')) {
					animateIn = 'zoomInRight';
					animateOut = 'zoomOutLeft';
				} else if (animation = (gallery.data('animation') == 'goDown')) {
					animateIn = 'slideInDown';
					animateOut = 'slideOutDown';
				}

				if (!gallery.hasClass('owl-carousel')) {
					gallery.addClass('owl-carousel');
				}

				gallery.waitForImages(function () {
					gallery.css('visibility', 'visible');
					gallery.animate({opacity: 1}, 600, 'easeOutSine');
				});

				gallery.owlCarousel({
					items: 1,
					autoplay: autoplay,
					autoplayInterval: autoplayInterval * 1000,
					autoplayHoverPause: true,
					loop: true,
					nav: navigation,
					dots: pagination,
					transitionStyle: animation,
					autoHeight: true,
					smartSpeed: 600,
					navText: [
						'<span class="mkd-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
						'<span class="mkd-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
					],
					animateIn: animateIn,
					animateOut: animateOut
				});
			});
		}

	}

	/**
	 * Initializes portfolio list
	 */
	function mkdInitPortfolio() {
		var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-standard, .mkd-portfolio-list-holder-outer.mkd-ptf-gallery');
		if (portList.length) {
			portList.each(function () {
				var thisPortList = $(this);
				thisPortList.waitForImages(function () {
					mkdInitPortMixItUp(thisPortList);
					if(thisPortList.hasClass('mkd-ptf-cursor-follow') && !thisPortList.hasClass('mkd-ptf-standard')){
					    thisPortList.find('article').each(function(){
					        $(this).hoverdir({
					        hoverElem:'div.mkd-ptf-item-text-overlay',
					        speed: 330,
					        hoverDelay: 35,
					        easing: 'ease'
					        });
					    });
					}
				});
			});
		}
	}

	/**
	 * Initializes mixItUp function for specific container
	 */
	function mkdInitPortMixItUp(container) {
		var filterClass = '';
		if (container.hasClass('mkd-ptf-has-filter')) {
			filterClass = container.find('.mkd-portfolio-filter-holder-inner ul li').data('class');
			filterClass = '.' + filterClass;
		}

		var holderInner = container.find('.mkd-portfolio-list-holder');
		holderInner.mixItUp({
			callbacks: {
				onMixLoad: function () {
					holderInner.find('article').css('visibility', 'visible');
				},
				onMixStart: function () {
					holderInner.find('article').css('visibility', 'visible');
				},
				onMixBusy: function () {
					holderInner.find('article').css('visibility', 'visible');
				}
			},
			selectors: {
				filter: filterClass
			},
			animation: {
				duration: 400,
				effects: 'fade translateZ(-360px) scale(0.43) stagger(86ms)',
				easing: 'cubic-bezier(0.455, 0.03, 0.515, 0.955)'
			}
		});

	}

	/*
	 **	Init portfolio list masonry type
	 */
	function mkdInitPortfolioListMasonry() {
		var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-masonry');
		if (portList.length) {
			portList.each(function () {
				var thisPortList = $(this).children('.mkd-portfolio-list-holder');
				var size = thisPortList.find('.mkd-portfolio-list-masonry-grid-sizer').width();

				mkdResizeMasonry(size, thisPortList);
				mkdInitMasonry(thisPortList);

				if(thisPortList.parent().hasClass('mkd-ptf-cursor-follow')){
				    thisPortList.find('article').each(function(){
				        $(this).hoverdir({
				        hoverElem:'div.mkd-ptf-item-text-overlay',
				        speed: 330,
				        hoverDelay: 35,
				        easing: 'ease'
				        });
				    });
				}
				$(window).resize(function () {
					mkdResizeMasonry(size, thisPortList);
					mkdInitMasonry(thisPortList);
				});
			});
		}
	}

	function mkdInitMasonry(container) {
		container.animate({opacity: 1});
		container.isotope({
			itemSelector: '.mkd-portfolio-item',
			masonry: {
				columnWidth: '.mkd-portfolio-list-masonry-grid-sizer'
			}
		});
	}

	function mkdResizeMasonry(size, container) {

		var defaultMasonryItem = container.find('.mkd-default-masonry-item');
		var largeWidthMasonryItem = container.find('.mkd-large-width-masonry-item');
		var largeHeightMasonryItem = container.find('.mkd-large-height-masonry-item');
		var largeWidthHeightMasonryItem = container.find('.mkd-large-width-height-masonry-item');

		defaultMasonryItem.css('height', size);
		largeHeightMasonryItem.css('height', Math.round(2 * size));

		if (mkd.windowWidth > 600) {
			largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
			largeWidthMasonryItem.css('height', size);
		} else {
			largeWidthHeightMasonryItem.css('height', size);
			largeWidthMasonryItem.css('height', Math.round(size / 2));

		}
	}

	/**
	 * Initializes portfolio pinterest
	 */
	function mkdInitPortfolioListPinterest() {

		var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-pinterest');
		if (portList.length) {
			portList.each(function () {
				var thisPortList = $(this).children('.mkd-portfolio-list-holder');
				mkdInitPinterest(thisPortList);
				$(window).resize(function () {
					mkdInitPinterest(thisPortList);
				});
			});

		}
	}

	function mkdInitPinterest(container) {
		container.animate({opacity: 1});
		container.isotope({
			itemSelector: '.mkd-portfolio-item',
			masonry: {
				columnWidth: '.mkd-portfolio-list-masonry-grid-sizer',
				gutter: '.mkd-portfolio-list-masonry-grid-gutter'
			}
		});

	}

	/**
	 * Initializes portfolio masonry filter
	 */
	function mkdInitPortfolioMasonryFilter() {

		var filterHolder = $('.mkd-portfolio-filter-holder.mkd-masonry-filter');

		if (filterHolder.length) {
			filterHolder.each(function () {

				var thisFilterHolder = $(this);

				var portfolioIsotopeAnimation = null;

				var filter = thisFilterHolder.find('ul li').data('class');

				thisFilterHolder.find('.filter:first').addClass('current');

				thisFilterHolder.find('.filter').click(function () {

					var currentFilter = $(this);
					clearTimeout(portfolioIsotopeAnimation);

					$('.isotope, .isotope .isotope-item').css('transition-duration', '0.8s');

					portfolioIsotopeAnimation = setTimeout(function () {
						$('.isotope, .isotope .isotope-item').css('transition-duration', '0s');
					}, 700);

					var selector = $(this).attr('data-filter');
					thisFilterHolder.siblings('.mkd-portfolio-list-holder-outer').find('.mkd-portfolio-list-holder').isotope({filter: selector});

					thisFilterHolder.find('.filter').removeClass('current');
					currentFilter.addClass('current');

					return false;

				});

			});
		}
	}

	/**
	 * Initializes portfolio load more function
	 */
	function mkdInitPortfolioLoadMore() {
		var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-load-more');
		if (portList.length) {
			portList.each(function () {

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
					if (nextPage <= maxNumPages) {
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
								thisPortList.waitForImages(function () {
									setTimeout(function () {
										if (thisPortList.hasClass('mkd-ptf-masonry') || thisPortList.hasClass('mkd-ptf-pinterest')) {
											thisPortListInner.isotope().append(responseHtml).isotope('appended', responseHtml).isotope('reloadItems');

											if (thisPortList.hasClass('mkd-ptf-masonry')) {
												var size = thisPortList.find('.mkd-portfolio-list-masonry-grid-sizer').width();
												mkdResizeMasonry(size, thisPortList);

												mkdInitMasonry(thisPortList);

											}
										} else {
											thisPortListInner.mixItUp('append', responseHtml);
										}
										if(thisPortList.hasClass('mkd-ptf-cursor-follow')){
										    thisPortList.find('article').each(function(){
										        $(this).hoverdir({
										            hoverElem:'div.mkd-ptf-item-text-overlay'});
										    });
										}
									}, 400);
								});
							}
						});
					}
					if (nextPage === maxNumPages) {
						loadMoreButton.hide();
					}
				});

			});
		}
	}

	function mkdConvertHTML(html) {
		var newHtml = $.trim(html),
			$html = $(newHtml),
			$empty = $();

		$html.each(function (index, value) {
			if (value.nodeType === 1) {
				$empty = $empty.add(this);
			}
		});

		return $empty;
	}

	/**
	 * Initializes portfolio load more data params
	 * @param portfolio list container with defined data params
	 * return array
	 */
	function mkdGetPortfolioAjaxData(container) {
		var returnValue = {};

		returnValue.type = '';
		returnValue.columns = '';
		returnValue.gridSize = '';
		returnValue.orderBy = '';
		returnValue.order = '';
		returnValue.number = '';
		returnValue.imageSize = '';
		returnValue.customImageDimensions = '';
		returnValue.filter = '';
		returnValue.filterOrderBy = '';
		returnValue.category = '';
		returnValue.selectedProjectes = '';
		returnValue.showLoadMore = '';
		returnValue.titleTag = '';
		returnValue.nextPage = '';
		returnValue.maxNumPages = '';
		returnValue.showExcerpt = '';
		returnValue.infoPosition = '';

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

		if (typeof container.data('custom-image-dimensions') !== 'undefined' && container.data('custom-image-dimensions') !== false) {
			returnValue.customImageDimensions = container.data('custom-image-dimensions');
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

		if (typeof container.data('show-excerpt') !== 'undefined' && container.data('show-excerpt') !== false) {
			returnValue.showExcerpt = container.data('show-excerpt');
		}

		return returnValue;
	}

	/**
	 * Sets portfolio load more data params for ajax function
	 * @param portfolio list container with defined data params
	 * return array
	 */
	function mkdSetPortfolioAjaxData(container) {
		var returnValue = {
			action: 'mkd_core_portfolio_ajax_load_more',
			type: container.type,
			columns: container.columns,
			gridSize: container.gridSize,
			orderBy: container.orderBy,
			order: container.order,
			number: container.number,
			imageSize: container.imageSize,
			customImageDimensions: container.customImageDimensions,
			filter: container.filter,
			filterOrderBy: container.filterOrderBy,
			category: container.category,
			selectedProjectes: container.selectedProjectes,
			showLoadMore: container.showLoadMore,
			titleTag: container.titleTag,
			nextPage: container.nextPage,
			showExcerpt: container.showExcerpt
		};
		return returnValue;
	}

	/**
	 * Slider object that initializes whole slider functionality
	 * @type {Function}
	 */
	var mkdSlider = mkd.modules.shortcodes.mkdSlider = function () {

		//all sliders on the page
		var sliders = $('.mkd-slider .carousel');
		//image regex used to extract img source
		var imageRegex = /url\(["']?([^'")]+)['"]?\)/;
		//default responsive breakpoints set
		var responsiveBreakpointSet = [1600, 1200, 900, 650, 500, 320];
		//var init for coefficiens array
		var coefficientsGraphicArray;
		var coefficientsTitleArray;
		var coefficientsSubtitleArray;
		var coefficientsTextArray;
		var coefficientsButtonArray;
		//var init for slider elements responsive coefficients
		var sliderGraphicCoefficient;
		var sliderTitleCoefficient;
		var sliderSubtitleCoefficient;
		var sliderTextCoefficient;
		var sliderButtonCoefficient;
		var sliderTitleCoefficientLetterSpacing;
		var sliderSubtitleCoefficientLetterSpacing;
		var sliderTextCoefficientLetterSpacing;

		/*** Functionality for translating image in slide - START ***/

		var matrixArray = {
			zoom_center: '1.2, 0, 0, 1.2, 0, 0',
			zoom_top_left: '1.2, 0, 0, 1.2, -150, -150',
			zoom_top_right: '1.2, 0, 0, 1.2, 150, -150',
			zoom_bottom_left: '1.2, 0, 0, 1.2, -150, 150',
			zoom_bottom_right: '1.2, 0, 0, 1.2, 150, 150'
		};

		// regular expression for parsing out the matrix components from the matrix string
		var matrixRE = /\([0-9epx\.\, \t\-]+/gi;

		// parses a matrix string of the form "matrix(n1,n2,n3,n4,n5,n6)" and
		// returns an array with the matrix components
		var parseMatrix = function (val) {
			return val.match(matrixRE)[0].substr(1).split(",").map(function (s) {
				return parseFloat(s);
			});
		};

		// transform css property names with vendor prefixes;
		// the plugin will check for values in the order the names are listed here and return as soon as there
		// is a value; so listing the W3 std name for the transform results in that being used if its available
		var transformPropNames = [
			"transform",
			"-webkit-transform"
		];

		var getTransformMatrix = function (el) {
			// iterate through the css3 identifiers till we hit one that yields a value
			var matrix = null;
			transformPropNames.some(function (prop) {
				matrix = el.css(prop);
				return (matrix !== null && matrix !== "");
			});

			// if "none" then we supplant it with an identity matrix so that our parsing code below doesn't break
			matrix = (!matrix || matrix === "none") ?
				"matrix(1,0,0,1,0,0)" : matrix;
			return parseMatrix(matrix);
		};

		// set the given matrix transform on the element; note that we apply the css transforms in reverse order of how its given
		// in "transformPropName" to ensure that the std compliant prop name shows up last
		var setTransformMatrix = function (el, matrix) {
			var m = "matrix(" + matrix.join(",") + ")";
			for (var i = transformPropNames.length - 1; i >= 0; --i) {
				el.css(transformPropNames[i], m + ' rotate(0.01deg)');
			}
		};

		// interpolates a value between a range given a percent
		var interpolate = function (from, to, percent) {
			return from + ((to - from) * (percent / 100));
		};

		$.fn.transformAnimate = function (opt) {
			// extend the options passed in by caller
			var options = {
				transform: "matrix(1,0,0,1,0,0)"
			};
			$.extend(options, opt);

			// initialize our custom property on the element to track animation progress
			this.css("percentAnim", 0);

			// supplant "options.step" if it exists with our own routine
			var sourceTransform = getTransformMatrix(this);
			var targetTransform = parseMatrix(options.transform);
			options.step = function (percentAnim, fx) {
				// compute the interpolated transform matrix for the current animation progress
				var $this = $(this);
				var matrix = sourceTransform.map(function (c, i) {
					return interpolate(c, targetTransform[i],
						percentAnim);
				});

				// apply the new matrix
				setTransformMatrix($this, matrix);

				// invoke caller's version of "step" if one was supplied;
				if (opt.step) {
					opt.step.apply(this, [matrix, fx]);
				}
			};

			// animate!
			return this.stop().animate({percentAnim: 100}, options);
		};

		/*** Functionality for translating image in slide - END ***/


		/**
		 * Calculate heights for slider holder and slide item, depending on window width, but only if slider is set to be responsive
		 * @param slider, current slider
		 * @param defaultHeight, default height of slider, set in shortcode
		 * @param responsive_breakpoint_set, breakpoints set for slider responsiveness
		 * @param reset, boolean for reseting heights
		 */
		var setSliderHeight = function (slider, defaultHeight, responsive_breakpoint_set, reset) {
			var sliderHeight = defaultHeight;
			if (!reset) {
				if (mkd.windowWidth > responsive_breakpoint_set[0]) {
					sliderHeight = defaultHeight;
				} else if (mkd.windowWidth > responsive_breakpoint_set[1]) {
					sliderHeight = defaultHeight * 0.75;
				} else if (mkd.windowWidth > responsive_breakpoint_set[2]) {
					sliderHeight = defaultHeight * 0.6;
				} else if (mkd.windowWidth > responsive_breakpoint_set[3]) {
					sliderHeight = defaultHeight * 0.55;
				} else if (mkd.windowWidth <= responsive_breakpoint_set[3]) {
					sliderHeight = defaultHeight * 0.45;
				}
			}

			slider.css({'height': (sliderHeight) + 'px'});
			slider.find('.mkd-slider-preloader').css({'height': (sliderHeight) + 'px'});
			slider.find('.mkd-slider-preloader .mkd-ajax-loader').css({'display': 'block'});
			slider.find('.item').css({'height': (sliderHeight) + 'px'});
		};

		/**
		 * Calculate heights for slider holder and slide item, depending on window size, but only if slider is set to be full height
		 * @param slider, current slider
		 */
		var setSliderFullHeight = function (slider) {
			var mobileHeaderHeight = mkd.windowWidth < 1000 ? mkdGlobalVars.vars.mkdMobileHeaderHeight + $('.mkd-top-bar').height() : 0;
			slider.css({'height': (mkd.windowHeight - mobileHeaderHeight) + 'px'});
			slider.find('.mkd-slider-preloader').css({'height': (mkd.windowHeight) + 'px'});
			slider.find('.mkd-slider-preloader .mkd-ajax-loader').css({'display': 'block'});
			slider.find('.item').css({'height': (mkd.windowHeight) + 'px'});
		};

		/**
		 * Set initial sizes for slider elements and put them in global variables
		 * @param slideItem, each slide
		 * @param index, index od slide item
		 */
		var setSizeGlobalVariablesForSlideElements = function (slideItem, index) {
			window["slider_graphic_width_" + index] = [];
			window["slider_graphic_height_" + index] = [];
			window["slider_title_" + index] = [];
			window["slider_subtitle_" + index] = [];
			window["slider_text_" + index] = [];
			window["slider_button1_" + index] = [];
			window["slider_button2_" + index] = [];

			//graphic size
			window["slider_graphic_width_" + index].push(parseFloat(slideItem.find('.mkd-thumb img').data("width")));
			window["slider_graphic_height_" + index].push(parseFloat(slideItem.find('.mkd-thumb img').data("height")));

			// font-size (0)
			window["slider_title_" + index].push(parseFloat(slideItem.find('.mkd-slide-title').css("font-size")));
			window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.mkd-slide-subtitle').css("font-size")));
			window["slider_text_" + index].push(parseFloat(slideItem.find('.mkd-slide-text').css("font-size")));
			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(0)').css("font-size")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(1)').css("font-size")));

			// line-height (1)
			window["slider_title_" + index].push(parseFloat(slideItem.find('.mkd-slide-title').css("line-height")));
			window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.mkd-slide-subtitle').css("line-height")));
			window["slider_text_" + index].push(parseFloat(slideItem.find('.mkd-slide-text').css("line-height")));
			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(0)').css("line-height")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(1)').css("line-height")));

			// letter-spacing (2)
			window["slider_title_" + index].push(parseFloat(slideItem.find('.mkd-slide-title').css("letter-spacing")));
			window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.mkd-slide-subtitle').css("letter-spacing")));
			window["slider_text_" + index].push(parseFloat(slideItem.find('.mkd-slide-text').css("letter-spacing")));
			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(0)').css("letter-spacing")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(1)').css("letter-spacing")));

			// margin-bottom (3)
			window["slider_title_" + index].push(parseFloat(slideItem.find('.mkd-slide-title').css("margin-bottom")));
			window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.mkd-slide-subtitle').css("margin-bottom")));


			// slider_button padding top/bottom(3), padding left/right(4)
			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(0)').css("padding-top")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(1)').css("padding-top")));

			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(0)').css("padding-left")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkd-btn:eq(1)').css("padding-left")));
		};

		/**
		 * Set responsive coefficients for slider elements
		 * @param responsiveBreakpointSet, responsive breakpoints
		 * @param coefficientsGraphicArray, responsive coeaficcients for graphic
		 * @param coefficientsTitleArray, responsive coeaficcients for title
		 * @param coefficientsSubtitleArray, responsive coeaficcients for subtitle
		 * @param coefficientsTextArray, responsive coeaficcients for text
		 * @param coefficientsButtonArray, responsive coeaficcients for button
		 */
		var setSliderElementsResponsiveCoeffeicients = function (responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray) {

			function coefficientsSetter(graphicArray, titleArray, subtitleArray, textArray, buttonArray) {
				sliderGraphicCoefficient = graphicArray;
				sliderTitleCoefficient = titleArray;
				sliderSubtitleCoefficient = subtitleArray;
				sliderTextCoefficient = textArray;
				sliderButtonCoefficient = buttonArray;
			}

			if (mkd.windowWidth > responsiveBreakpointSet[0]) {
				coefficientsSetter(coefficientsGraphicArray[0], coefficientsTitleArray[0], coefficientsSubtitleArray[0], coefficientsTextArray[0], coefficientsButtonArray[0]);
			} else if (mkd.windowWidth > responsiveBreakpointSet[1]) {
				coefficientsSetter(coefficientsGraphicArray[1], coefficientsTitleArray[1], coefficientsSubtitleArray[1], coefficientsTextArray[1], coefficientsButtonArray[1]);
			} else if (mkd.windowWidth > responsiveBreakpointSet[2]) {
				coefficientsSetter(coefficientsGraphicArray[2], coefficientsTitleArray[2], coefficientsSubtitleArray[2], coefficientsTextArray[2], coefficientsButtonArray[2]);
			} else if (mkd.windowWidth > responsiveBreakpointSet[3]) {
				coefficientsSetter(coefficientsGraphicArray[3], coefficientsTitleArray[3], coefficientsSubtitleArray[3], coefficientsTextArray[3], coefficientsButtonArray[3]);
			} else if (mkd.windowWidth > responsiveBreakpointSet[4]) {
				coefficientsSetter(coefficientsGraphicArray[4], coefficientsTitleArray[4], coefficientsSubtitleArray[4], coefficientsTextArray[4], coefficientsButtonArray[4]);
			} else if (mkd.windowWidth > responsiveBreakpointSet[5]) {
				coefficientsSetter(coefficientsGraphicArray[5], coefficientsTitleArray[5], coefficientsSubtitleArray[5], coefficientsTextArray[5], coefficientsButtonArray[5]);
			} else {
				coefficientsSetter(coefficientsGraphicArray[6], coefficientsTitleArray[6], coefficientsSubtitleArray[6], coefficientsTextArray[6], coefficientsButtonArray[6]);
			}

			// letter-spacing decrease quicker
			sliderTitleCoefficientLetterSpacing = sliderTitleCoefficient;
			sliderSubtitleCoefficientLetterSpacing = sliderSubtitleCoefficient;
			sliderTextCoefficientLetterSpacing = sliderTextCoefficient;
			if (mkd.windowWidth <= responsiveBreakpointSet[0]) {
				sliderTitleCoefficientLetterSpacing = sliderTitleCoefficient / 2;
				sliderSubtitleCoefficientLetterSpacing = sliderSubtitleCoefficient / 2;
				sliderTextCoefficientLetterSpacing = sliderTextCoefficient / 2;
			}
		};

		/**
		 * Set sizes for slider elements
		 * @param slideItem, each slide
		 * @param index, index od slide item
		 * @param reset, boolean for reseting sizes
		 */
		var setSliderElementsSize = function (slideItem, index, reset) {

			if (reset) {
				sliderGraphicCoefficient = sliderTitleCoefficient = sliderSubtitleCoefficient = sliderTextCoefficient = sliderButtonCoefficient = sliderTitleCoefficientLetterSpacing = sliderSubtitleCoefficientLetterSpacing = sliderTextCoefficientLetterSpacing = 1;
			}

			slideItem.find('.mkd-thumb').css({
				"width": Math.round(window["slider_graphic_width_" + index][0] * sliderGraphicCoefficient) + 'px',
				"height": Math.round(window["slider_graphic_height_" + index][0] * sliderGraphicCoefficient) + 'px'
			});

			slideItem.find('.mkd-slide-title').css({
				"font-size": Math.round(window["slider_title_" + index][0] * sliderTitleCoefficient) + 'px',
				"line-height": Math.round(window["slider_title_" + index][1] * sliderTitleCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_title_" + index][2] * sliderTitleCoefficient) + 'px',
				"margin-bottom": Math.round(window["slider_title_" + index][3] * sliderTitleCoefficient) + 'px'
			});

			slideItem.find('.mkd-slide-subtitle').css({
				"font-size": Math.round(window["slider_subtitle_" + index][0] * sliderSubtitleCoefficient) + 'px',
				"line-height": Math.round(window["slider_subtitle_" + index][1] * sliderSubtitleCoefficient) + 'px',
				"margin-bottom": Math.round(window["slider_subtitle_" + index][3] * sliderSubtitleCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_subtitle_" + index][2] * sliderSubtitleCoefficientLetterSpacing) + 'px'
			});

			slideItem.find('.mkd-slide-text').css({
				"font-size": Math.round(window["slider_text_" + index][0] * sliderTextCoefficient) + 'px',
				"line-height": Math.round(window["slider_text_" + index][1] * sliderTextCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_text_" + index][2] * sliderTextCoefficientLetterSpacing) + 'px'
			});

			slideItem.find('.mkd-btn:eq(0)').css({
				"font-size": Math.round(window["slider_button1_" + index][0] * sliderButtonCoefficient) + 'px',
				"line-height": Math.round(window["slider_button1_" + index][1] * sliderButtonCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_button1_" + index][2] * sliderButtonCoefficient) + 'px',
				"padding-top": Math.round(window["slider_button1_" + index][3] * sliderButtonCoefficient) + 'px',
				"padding-bottom": Math.round(window["slider_button1_" + index][3] * sliderButtonCoefficient) + 'px',
				"padding-left": Math.round(window["slider_button1_" + index][4] * sliderButtonCoefficient) + 'px',
				"padding-right": Math.round(window["slider_button1_" + index][4] * sliderButtonCoefficient) + 'px'
			});
			slideItem.find('.mkd-btn:eq(1)').css({
				"font-size": Math.round(window["slider_button2_" + index][0] * sliderButtonCoefficient) + 'px',
				"line-height": Math.round(window["slider_button2_" + index][1] * sliderButtonCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_button2_" + index][2] * sliderButtonCoefficient) + 'px',
				"padding-top": Math.round(window["slider_button2_" + index][3] * sliderButtonCoefficient) + 'px',
				"padding-bottom": Math.round(window["slider_button2_" + index][3] * sliderButtonCoefficient) + 'px',
				"padding-left": Math.round(window["slider_button2_" + index][4] * sliderButtonCoefficient) + 'px',
				"padding-right": Math.round(window["slider_button2_" + index][4] * sliderButtonCoefficient) + 'px'
			});
		};

		/**
		 * Set heights for slider and elemnts depending on slider settings (full height, responsive height od set height)
		 * @param slider, current slider
		 */
		var setHeights = function (slider) {

			slider.find('.item').each(function (i) {
				setSizeGlobalVariablesForSlideElements($(this), i);
				setSliderElementsSize($(this), i, false);
			});

			if (slider.hasClass('mkd-full-screen')) {

				setSliderFullHeight(slider);

				$(window).resize(function () {
					setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray);
					setSliderFullHeight(slider);
					slider.find('.item').each(function (i) {
						setSliderElementsSize($(this), i, false);
					});
				});

			} else if (slider.hasClass('mkd-responsive-height')) {

				var defaultHeight = slider.data('height');
				setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);

				$(window).resize(function () {
					setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray);
					setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
					slider.find('.item').each(function (i) {
						setSliderElementsSize($(this), i, false);
					});
				});

			} else {
				var defaultHeight = slider.data('height');

				slider.find('.mkd-slider-preloader').css({'height': (slider.height()) + 'px'});
				slider.find('.mkd-slider-preloader .mkd-ajax-loader').css({'display': 'block'});

				mkd.windowWidth < 1000 ? setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false) : setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);

				$(window).resize(function () {
					setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray);
					if (mkd.windowWidth < 1000) {
						setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
						slider.find('.item').each(function (i) {
							setSliderElementsSize($(this), i, false);
						});
					} else {
						setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);
						slider.find('.item').each(function (i) {
							setSliderElementsSize($(this), i, true);
						});
					}
				});
			}
		};

		/**
		 * Set prev/next numbers on navigation arrows
		 * @param slider, current slider
		 * @param currentItem, current slide item index
		 * @param totalItemCount, total number of slide items
		 */
		var setPrevNextNumbers = function (slider, currentItem, totalItemCount) {
			if (currentItem == 1) {
				slider.find('.left.carousel-control .prev').html(totalItemCount);
				slider.find('.right.carousel-control .next').html(currentItem + 1);
			} else if (currentItem == totalItemCount) {
				slider.find('.left.carousel-control .prev').html(currentItem - 1);
				slider.find('.right.carousel-control .next').html(1);
			} else {
				slider.find('.left.carousel-control .prev').html(currentItem - 1);
				slider.find('.right.carousel-control .next').html(currentItem + 1);
			}
		};

		/**
		 * Set video background size
		 * @param slider, current slider
		 */
		var initVideoBackgroundSize = function (slider) {
			var min_w = 1500; // minimum video width allowed
			var video_width_original = 1920;  // original video dimensions
			var video_height_original = 1080;
			var vid_ratio = 1920 / 1080;

			slider.find('.item .mkd-video .mkd-video-wrap').each(function () {

				var slideWidth = mkd.windowWidth;
				var slideHeight = $(this).closest('.carousel').height();

				$(this).width(slideWidth);

				min_w = vid_ratio * (slideHeight + 20);
				$(this).height(slideHeight);

				var scale_h = slideWidth / video_width_original;
				var scale_v = (slideHeight - mkdGlobalVars.vars.mkdMenuAreaHeight) / video_height_original;
				var scale = scale_v;
				if (scale_h > scale_v)
					scale = scale_h;
				if (scale * video_width_original < min_w) {
					scale = min_w / video_width_original;
				}

				$(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original + 2));
				$(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original + 2));
				$(this).scrollLeft(($(this).find('video').width() - slideWidth) / 2);
				$(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - slideHeight) / 2);
				$(this).scrollTop(($(this).find('video').height() - slideHeight) / 2);
			});
		};

		/**
		 * Init video background
		 * @param slider, current slider
		 */
		var initVideoBackground = function (slider) {
			$('.item .mkd-video-wrap .video').mediaelementplayer({
				enableKeyboard: false,
				iPadUseNativeControls: false,
				pauseOtherPlayers: false,
				// force iPhone's native controls
				iPhoneUseNativeControls: false,
				// force Android's native controls
				AndroidUseNativeControls: false
			});

			$(window).resize(function () {
				initVideoBackgroundSize(slider);
			});

			//mobile check
			if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
				$('.mkd-slider .mkd-mobile-video-image').show();
				$('.mkd-slider .mkd-video-wrap').remove();
			}
		};

		/**
		 * initiate slider
		 * @param slider, current slider
		 * @param currentItem, current slide item index
		 * @param totalItemCount, total number of slide items
		 * @param slideAnimationTimeout, timeout for slide change
		 */
		var initiateSlider = function (slider, totalItemCount, slideAnimationTimeout) {

			//set active class on first item
			slider.find('.carousel-inner .item:first-child').addClass('active');
			//check for header style
			mkdCheckSliderForHeaderStyle($('.carousel .active'), slider.hasClass('mkd-header-effect'));
			// setting numbers on carousel controls
			if (slider.hasClass('mkd-slider-numbers')) {
				setPrevNextNumbers(slider, 1, totalItemCount);
			}
			// set video background if there is video slide
			if (slider.find('.item video').length) {
				initVideoBackgroundSize(slider);
				initVideoBackground(slider);
			}

			//init slider
			if (slider.hasClass('mkd-auto-start')) {
				slider.carousel({
					interval: slideAnimationTimeout,
					pause: false
				});

				//pause slider when hover slider button
				slider.find('.slide_buttons_holder .qbutton')
					.mouseenter(function () {
						slider.carousel('pause');
					})
					.mouseleave(function () {
						slider.carousel('cycle');
					});
			} else {
				slider.carousel({
					interval: 0,
					pause: false
				});
			}


			//initiate image animation
			if ($('.carousel-inner .item:first-child').hasClass('mkd-animate-image') && mkd.windowWidth > 1000) {
				slider.find('.carousel-inner .item.mkd-animate-image:first-child .mkd-image').transformAnimate({
					transform: "matrix(" + matrixArray[$('.carousel-inner .item:first-child').data('mkd_animate_image')] + ")",
					duration: 30000
				});
			}
		};

		return {
			init: function () {
				if (sliders.length) {
					sliders.each(function () {
						var $this = $(this);
						var slideAnimationTimeout = $this.data('slide_animation_timeout');
						var totalItemCount = $this.find('.item').length;
						if ($this.data('mkd_responsive_breakpoints')) {
							if ($this.data('mkd_responsive_breakpoints') == 'set2') {
								responsiveBreakpointSet = [1600, 1300, 1000, 768, 567, 320];
							}
						}
						coefficientsGraphicArray = $this.data('mkd_responsive_graphic_coefficients').split(',');
						coefficientsTitleArray = $this.data('mkd_responsive_title_coefficients').split(',');
						coefficientsSubtitleArray = $this.data('mkd_responsive_subtitle_coefficients').split(',');
						coefficientsTextArray = $this.data('mkd_responsive_text_coefficients').split(',');
						coefficientsButtonArray = $this.data('mkd_responsive_button_coefficients').split(',');

						setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray);

						setHeights($this);

						/*** wait until first video or image is loaded and than initiate slider - start ***/
						if (mkd.htmlEl.hasClass('touch')) {
							if ($this.find('.item:first-child .mkd-mobile-video-image').length > 0) {
								var src = imageRegex.exec($this.find('.item:first-child .mkd-mobile-video-image').attr('style'));
							} else {
								var src = imageRegex.exec($this.find('.item:first-child .mkd-image').attr('style'));
							}
							if (src) {
								var backImg = new Image();
								backImg.src = src[1];
								$(backImg).load(function () {
									$('.mkd-slider-preloader').fadeOut(500);
									initiateSlider($this, totalItemCount, slideAnimationTimeout);
								});
							}
						} else {
							if ($this.find('.item:first-child video').length > 0) {
								$this.find('.item:first-child video').get(0).addEventListener('loadeddata', function () {
									$('.mkd-slider-preloader').fadeOut(500);
									initiateSlider($this, totalItemCount, slideAnimationTimeout);
								});
							} else {
								var src = imageRegex.exec($this.find('.item:first-child .mkd-image').attr('style'));
								if (src) {
									var backImg = new Image();
									backImg.src = src[1];
									$(backImg).load(function () {
										$('.mkd-slider-preloader').fadeOut(500);
										initiateSlider($this, totalItemCount, slideAnimationTimeout);
									});
								}
							}
						}
						/*** wait until first video or image is loaded and than initiate slider - end ***/

						/* before slide transition - start */
						$this.on('slide.bs.carousel', function () {
							$this.addClass('mkd-in-progress');
							$this.find('.active .mkd-slider-content-outer').fadeTo(250, 0);
						});
						/* before slide transition - end */

						/* after slide transition - start */
						$this.on('slid.bs.carousel', function () {
							$this.removeClass('mkd-in-progress');
							$this.find('.active .mkd-slider-content-outer').fadeTo(0, 1);

							// setting numbers on carousel controls
							if ($this.hasClass('mkd-slider-numbers')) {
								var currentItem = $('.item').index($('.item.active')[0]) + 1;
								setPrevNextNumbers($this, currentItem, totalItemCount);
							}

							// initiate image animation on active slide and reset all others
							$('.item.mkd-animate-image .mkd-image').stop().css({
								'transform': '',
								'-webkit-transform': ''
							});
							if ($('.item.active').hasClass('mkd-animate-image') && mkd.windowWidth > 1000) {
								$('.item.mkd-animate-image.active .mkd-image').transformAnimate({
									transform: "matrix(" + matrixArray[$('.item.mkd-animate-image.active').data('mkd_animate_image')] + ")",
									duration: 30000
								});
							}
						});
						/* after slide transition - end */

						/* swipe functionality - start */
						$this.swipe({
							swipeLeft: function () {
								$this.carousel('next');
							},
							swipeRight: function () {
								$this.carousel('prev');
							},
							threshold: 20
						});
						/* swipe functionality - end */

					});

					//adding parallax functionality on slider
					if ($('.no-touch .carousel').length) {
						var skrollr_slider = skrollr.init({
							smoothScrolling: false,
							forceHeight: false
						});
						skrollr_slider.refresh();
					}

					$(window).scroll(function () {
						//set control class for slider in order to change header style
						if ($('.mkd-slider .carousel').height() < mkd.scroll) {
							$('.mkd-slider .carousel').addClass('mkd-disable-slider-header-style-changing');
						} else {
							$('.mkd-slider .carousel').removeClass('mkd-disable-slider-header-style-changing');
							mkdCheckSliderForHeaderStyle($('.mkd-slider .carousel .active'), $('.mkd-slider .carousel').hasClass('mkd-header-effect'));
						}

						//hide slider when it is out of viewport
						if ($('.mkd-slider .carousel').hasClass('mkd-full-screen') && mkd.scroll > mkd.windowHeight && mkd.windowWidth > 1000) {
							$('.mkd-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
						} else if (!$('.mkd-slider .carousel').hasClass('mkd-full-screen') && mkd.scroll > $('.mkd-slider .carousel').height() && mkd.windowWidth > 1000) {
							$('.mkd-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
						} else {
							$('.mkd-slider .carousel').find('.carousel-inner, .carousel-indicators').show();
						}
					});
				}
			}
		};
	};

	/**
	 * Check if slide effect on header style changing
	 * @param slide, current slide
	 * @param headerEffect, flag if slide
	 */

	function mkdCheckSliderForHeaderStyle(slide, headerEffect) {

		if ($('.mkd-slider .carousel').not('.mkd-disable-slider-header-style-changing').length > 0) {

			var slideHeaderStyle = "";
			if (slide.hasClass('light')) {
				slideHeaderStyle = 'mkd-light-header';
			}
			if (slide.hasClass('dark')) {
				slideHeaderStyle = 'mkd-dark-header';
			}

			if (slideHeaderStyle !== "") {
				if (headerEffect) {
					mkd.body.removeClass('mkd-dark-header mkd-light-header').addClass(slideHeaderStyle);
				}
			} else {
				if (headerEffect) {
					mkd.body.removeClass('mkd-dark-header mkd-light-header').addClass(mkd.defaultHeaderStyle);
				}

			}
		}
	}

	function mkdInfoBox() {
		var infoBoxes = $('.mkd-info-box-holder');

		var getBottomHeight = function (bottomHolder) {
			if (bottomHolder.length) {
				return bottomHolder.height();
			}

			return false;
		}

		var infoBoxesHeight = function () {
			if (infoBoxes.length) {
				var maxHeight = 0;
				var heightestBox;

				infoBoxes.each(function () {
					var bottomHolder = $(this).find('.mkd-ib-bottom-holder');
					var topHolder = $(this).find('.mkd-ib-top-holder')

					var currentHeight = getBottomHeight(bottomHolder) + topHolder.height();

					maxHeight = Math.max(maxHeight, currentHeight);

					if (maxHeight <= currentHeight) {
						heightestBox = $(this);
						maxHeight = currentHeight;
					}
				});

				infoBoxes.height(maxHeight);
			}
		}

		var initHover = function (infoBox) {
			var timeline = new TimelineLite({paused: true}),
				topHolder = infoBox.find('.mkd-ib-top-holder'),
				bottomHolder = infoBox.find('.mkd-ib-bottom-holder'),
				bottomHeight = getBottomHeight(bottomHolder);

			timeline.to(topHolder, 0.6, {y: -(bottomHeight / 2), ease: Back.easeInOut.config(2)});
			timeline.to(bottomHolder, 0.4, {y: -(bottomHeight / 2), opacity: 1, ease: Back.easeOut}, '-=0.3');

			infoBox.hover(function () {
				timeline.restart();
			}, function () {
				timeline.reverse();
			});
		}

		if (infoBoxes.length) {
			infoBoxesHeight();

			$(mkd.window).resize(function () {
				infoBoxesHeight();
			});

			infoBoxes.each(function () {
				var thisInfoBox = $(this);
				initHover(thisInfoBox);

				$(mkd.window).resize(function () {
					initHover(thisInfoBox);
				});
			});
		}
	}

	function mkdProcess() {
		var processes = $('.mkd-process-holder');

		var setProcessItemsPosition = function (process) {
			var items = process.find('.mkd-process-item-holder');
			var highlighted = items.filter('.mkd-pi-highlighted');

			if (highlighted.length) {
				if (highlighted.length === 1) {
					var afterHighlighed = highlighted.nextAll();

					if (afterHighlighed.length) {
						afterHighlighed.addClass('mkd-pi-push-right');
					}
				} else {
					process.addClass('mkd-process-multiple-highlights');
				}
			}
		}

		var processAnimation = function (process) {
			if (!mkd.body.hasClass('mkd-no-animations-on-touch')) {
				var items = process.find('.mkd-process-item-holder');
				var background = process.find('.mkd-process-bg-holder');

				process.appear(function () {
					var tl = new TimelineLite();
					tl.fromTo(background, 0.2, {y: 50, opacity: 0, delay: 0.1}, {opacity: 1, y: 0, delay: 0.1});
					tl.staggerFromTo(items, 0.3, {opacity: 0, y: 50, ease: Back.easeOut.config(2)}, {
						opacity: 1,
						y: 0,
						ease: Back.easeOut.config(2)
					}, 0.2);
				}, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			}
		}

		return {
			init: function () {
				if (processes.length) {
					processes.each(function () {
						setProcessItemsPosition($(this));
						processAnimation($(this));
					});
				}
			}
		}
	};

	function mkdComparisonPricingTables() {
		var pricingTablesHolder = $('.mkd-comparision-pricing-tables-holder');

		var alterPricingTableColumn = function (holder) {
			var featuresHolder = holder.find('.mkd-cpt-features-item');
			var pricingTables = holder.find('.mkd-comparision-table-holder');

			if (pricingTables.length) {
				pricingTables.each(function () {
					var currentPricingTable = $(this);
					var pricingItems = currentPricingTable.find('.mkd-cpt-table-content li');

					if (pricingItems.length) {
						pricingItems.each(function (i) {
							var pricingItemFeature = featuresHolder[i];
							var pricingItem = this;
							var pricingItemContent = pricingItem.innerHTML;

							if (typeof pricingItemFeature !== 'undefined') {
								pricingItem.innerHTML = '<span class="mkd-cpt-table-item-feature">' + $(pricingItemFeature).text() + ': </span>' + pricingItemContent;
							}
						});
					}
				});
			}
		};

		return {
			init: function () {
				if (pricingTablesHolder.length) {
					pricingTablesHolder.each(function () {
						alterPricingTableColumn($(this));
					});
				}
			}
		}
	}

	function mkdProgressBarVertical() {
		var progressBars = $('.mkd-vertical-progress-bar-holder');

		var animateProgressBar = function (progressBar) {

			progressBar.appear(function () {
				var barHolder = progressBar.find('.mkd-vpb-bar');
				var activeBar = progressBar.find('.mkd-vpb-active-bar');
				var percentage = barHolder.data('percent');

				activeBar.animate({
					height: percentage + '%'
				}, 1500);

			}, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
		};

		var animatePercentageNumber = function (progressBar) {
			progressBar.appear(function () {
				var barHolder = progressBar.find('.mkd-vpb-bar');
				var percentage = barHolder.data('percent');
				var percentHolder = progressBar.find('.mkd-vpb-percent-number');

				percentHolder.countTo({
					from: 0,
					to: percentage,
					speed: 1500,
					refreshInterval: 50
				});
			});
		};

		return {
			init: function () {

				if (progressBars.length) {

					progressBars.each(function () {
						animateProgressBar($(this));
						animatePercentageNumber($(this));
					});
				}
			}
		}
	}

	function mkdIconProgressBar() {
		var progressBars = $('.mkd-icon-progress-bar');

		var animateActiveIcons = function (progressBar) {
			var timeouts = [];
			progressBar.appear(function () {
				var numberOfActive = parseInt(progressBar.data('number-of-active-icons'));
				var icons = progressBar.find('.mkd-ipb-icon');
				var customColor = progressBar.data('icon-active-color');

				if (typeof numberOfActive !== 'undefined') {

					icons.each(function (i) {
						if (i < numberOfActive) {
							var time = (i + 1) * 150;
							var currentIcon = $(this);

							timeouts[i] = setTimeout(function () {
								animateSingleIcon(currentIcon, customColor);
								$(icons[i]).addClass('active');
								if ($(icons[i]).attr('class').indexOf("gradient") > -1) {
									$(icons[i]).attr('class', $(icons[i]).attr('class').replace('-off', ''));
								}
							}, time);
						}
					});
				}
			}, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
		};

		var animateSingleIcon = function (icon, customColor) {
			icon.addClass('mkd-ipb-active');

			if (typeof customColor !== 'undefined' && customColor !== '') {
				icon.find('.mkd-ipb-icon-elem').css('color', customColor);
			}
		}

		return {
			init: function () {
				if (progressBars.length) {
					progressBars.each(function () {
						animateActiveIcons($(this));
					});
				}
			}
		}
	}

	function mkdBlogSlider() {
		var blogSliders = $('.mkd-blog-slider-holder');
		var verticalHeader = $('body').hasClass('mkd-header-vertical') ? true : false;

		if (blogSliders.length) {
			blogSliders.each(function () {
					var thisSlider = $(this);
					var postsToShow = 4;
					var navigation = 'dots';

					if (typeof $(this).data('posts_to_show') !== 'undefined') {
						postsToShow = $(this).data('posts_to_show');
					}

					if (typeof $(this).data('slider_navigation') !== 'undefined') {
						navigation = $(this).data('slider_navigation');
					}
					var dotsColor = $(this).data('navigation_color');
					var dotsActiveColor = $(this).data('navigation_active_color');

					var dots = navigation != 'arrows' ? true : false;
					var arrows = navigation != 'dots' ? true : false;

					// initialise slider
					thisSlider.on('init', function () {

						// change default opacity on init
						thisSlider.css({'opacity': '1'});
						if (dotsColor !== '' && dotsActiveColor != '') {
							thisSlider.find('.slick-dots li').css({'background-color': dotsColor});
							thisSlider.find('.slick-dots li.slick-active').css({'background-color': dotsActiveColor});
						}
					}).slick({
						dots: dots,
						infinite: false,
						arrows: arrows,
						cssEase: 'cubic-bezier(0.77, 0, 0.175, 1)',
						speed: 850,
						slidesToShow: postsToShow,
						slidesToScroll: postsToShow,
						responsive: [
							{
								breakpoint: 1650,
								settings: {
									slidesToShow: (verticalHeader && postsToShow == 4) ? 3 : postsToShow,
									slidesToScroll: (verticalHeader && postsToShow == 4) ? 3 : postsToShow
								}
							},
							{
								breakpoint: 1441,
								settings: {
									slidesToShow: verticalHeader ? 2 : 3,
									slidesToScroll: verticalHeader ? 2 : 3
								}
							},
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 2
								}
							},
							{
								breakpoint: 769,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1
								}
							}
						]
					});

					if (dotsColor !== '' && dotsActiveColor != '') {
						thisSlider.on('swipe', function () {
							thisSlider.find('.slick-dots li').css({'background-color': dotsColor});
							thisSlider.find('.slick-dots li.slick-active').css({'background-color': dotsActiveColor});
						});

						thisSlider.find('.slick-dots li').on('click', function () {
							thisSlider.find('.slick-dots li').css({'background-color': dotsColor});
							thisSlider.find('.slick-dots li.slick-active').css({'background-color': dotsActiveColor});
						});

						thisSlider.find('.slick-arrow:not(slick-disabled)').on('click', function () {
							thisSlider.find('.slick-dots li').css({'background-color': dotsColor});
							thisSlider.find('.slick-dots li.slick-active').css({'background-color': dotsActiveColor});
						});
					}
				}
			)
			;
		}
	}

	function teamSlider() {
		var teamSlidersHolder = $('.mkd-team-slider-holder');

		if (teamSlidersHolder.length) {
			teamSlidersHolder.each(function () {
				var thisSlider = $(this).find('.mkd-team-slider'),
					numberOfItems = thisSlider.data('items'),
					play = thisSlider.data('play'),
					showDots = thisSlider.data('dots');

				if (thisSlider.length) {
					thisSlider.on('init', function () {

						// change default opacity on init
						thisSlider.css({'opacity': '1'});

					}).slick({
						dots: showDots,
						slidesToShow: numberOfItems,
						slidesToScroll: 1,
						autoplay: play,
						swipeToSlide: true,
						autoplaySpeed: 2000,
						touchTreshold: 20,
						cssEase: 'cubic-bezier(0.77, 0, 0.175, 1)',
						speed: 850,
						responsive: [
							{
								breakpoint: 1400,
								settings: {
									slidesToShow: 4
								}
							},
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: 2
								}
							},
							{
								breakpoint: 600,
								settings: {
									slidesToShow: 1
								}
							}
						]
					});
				}
			});
		}
	}

	function processSlider() {
		var processSlidersHolder = $('.mkd-process-slider-holder');

		if (processSlidersHolder.length) {
			processSlidersHolder.each(function () {
				var thisSlider = $(this).find('.mkd-process-slider');

				if (thisSlider.length) {
					thisSlider.slick({
						dots: true,
						slidesToShow: 4,
						slidesToScroll: 1,
						swipeToSlide: true,
						touchTreshold: 20,
						cssEase: 'cubic-bezier(0.77, 0, 0.175, 1)',
						speed: 850,
						responsive: [
							{
								breakpoint: 1400,
								settings: {
									slidesToShow: 3
								}
							},
							{
								breakpoint: 1025,
								settings: {
									slidesToShow: 2
								}
							},
							{
								breakpoint: 600,
								settings: {
									slidesToShow: 1
								}
							}
						]
					});
				}
			});
		}
	}

	function mkdTwitterSlider() {
		var twitterSliders = $('.mkd-twitter-slider-inner');

		if (twitterSliders.length) {
			twitterSliders.each(function () {

				$(this).slick({
					centerMode: true,
					slidesToShow: 1,
					arrows: false,
					centerPadding: '0px',
					dots: true,
					speed: 1500,
					cssEase: 'cubic-bezier(0.77, 0, 0.175, 1)',
					swipeToSlide: true
				});
			});
		}
	}

	function emptySpaceResponsive() {
		var emptySpaces = $('.vc_empty_space');

		var sizes = {
			'large_laptop': 1559,
			'laptop': 1279,
			'tablet_landscape': 1023,
			'tablet_portrait': 767,
			'phone_landscape': 599,
			'phone_portrait': 479
		}

		var sizeValues = function () {
			var values = [];
			for (var size in sizes) {
				values.push(sizes[size]);
			}
			;

			return values;
		}();

		var getHeights = function (emptySpace) {
			var heights = {};

			for (var size in sizes) {
				var dataValue = emptySpace.data(size);
				if (typeof dataValue !== 'undefined' && dataValue !== '') {
					heights[size] = dataValue;
				}
			}

			return heights;
		};

		var usedSizes = function (emptySpace) {
			var usedSizes = [];

			for (var size in sizes) {
				var dataValue = emptySpace.data(size);
				if (typeof dataValue !== 'undefined' && dataValue !== '') {
					usedSizes.push(sizes[size]);
				}
			}

			return usedSizes;
		};

		var resizeEmptySpace = function (heights, emptySpace) {
			if (typeof heights !== 'undefined') {
				var originalHeight = emptySpace.data('original-height');
				var sizeValues = usedSizes(emptySpace);
				var heightestSize = Math.max.apply(null, sizeValues);

				for (var size in sizes) {
					if (mkd.windowWidth <= sizes[size]) {
						emptySpace.height(heights[size]);
					} else if (mkd.windowWidth > heightestSize) {
						emptySpace.height(originalHeight);
					}
				}
			}
		};

		return {
			init: function () {
				if (emptySpaces.length) {
					emptySpaces.each(function () {
						var heights = getHeights($(this));

						resizeEmptySpace(heights, $(this));

						var thisEmptySpace = $(this);

						$(window).resize(function () {
							resizeEmptySpace(heights, thisEmptySpace);
						});
					});
				}
			}
		}
	}

	/**
	 * Initializing Zooming Slider
	 */
	function mkdZoomingSlider() {
		var zoomingSliders = $('.mkd-zooming-slider-holder');

		if (zoomingSliders.length) {

			zoomingSliders.each(function () {
                var $this = $(this);
				var autoplay = $this.data('autoplay');
                var slidesToShow = $this.data('slides-to-show');

				$(this).slick({
					infinite: true,
					autoplay: autoplay,
					centerMode: true,
					slidesToShow: slidesToShow,
					slidesToScroll: 1,
					arrows: false,
					centerPadding: '0px',
					dots: false,
					speed: 850,
					cssEase: 'cubic-bezier(0.77, 0, 0.175, 1)',
					swipeToSlide: true,
					responsive: [
						{
							breakpoint: 1400,
							settings: {
								centerPadding: '0px',
								slidesToShow: slidesToShow
							}
						},
						{
							breakpoint: 1281,
							settings: {
								centerPadding: '0px',
								slidesToShow: 3
							}
						},
						{
							breakpoint: 768,
							settings: {
								centerPadding: false,
								centerMode: false,
								slidesToShow: 1
							}
						}
					]
				});
			});
		}
	}

	/*
	 **	Vertical Split Slider
	 */

	function mkdInitVerticalSplitSlider() {

		if (mkd.body.hasClass('mkd-vertical-split-screen-initialized')) {
			mkd.body.removeClass('mkd-vertical-split-screen-initialized');
			$.fn.multiscroll.destroy();
		}

		var defaultHeaderStyle = '';
		if (mkd.body.hasClass('mkd-light-header')) {
			defaultHeaderStyle = 'light';
		} else if (mkd.body.hasClass('mkd-dark-header')) {
			defaultHeaderStyle = 'dark';
		}

		if ($('.mkd-vertical-split-slider').length) {

			var slider = $('.mkd-vertical-split-slider');

			slider.height(mkd.windowHeight).animate({opacity: 1}, 300);
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.mkd-vss-ms-section',
				leftSelector: '.mkd-vss-ms-left',
				rightSelector: '.mkd-vss-ms-right',
				afterRender: function () {
					mkdCheckVerticalSplitSectionsForHeaderStyle($('.mkd-vss-ms-right .mkd-vss-ms-section:last-child').data('header-style'), defaultHeaderStyle);
					mkd.body.addClass('mkd-vertical-split-screen-initialized');
					if ($('div.wpcf7 > form').length) {
						_wpcf7.supportHtml5 = $.wpcf7SupportHtml5();
						$('div.wpcf7 > form').wpcf7InitForm();
					} // this function need to be initialized after initVerticalSplitSlide

					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $("<div class='mkd-vertical-split-slider-responsive' />");
					slider.after(verticalSplitSliderResponsive);
					var leftSide = $('.mkd-vertical-split-slider .mkd-vss-ms-left > div');
					var rightSide = $('.mkd-vertical-split-slider .mkd-vss-ms-right > div');

					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}

					//prepare google maps clones
					if ($('.mkd-vertical-split-slider-responsive .mkd-google-map').length) {
						$('.mkd-vertical-split-slider-responsive .mkd-google-map').each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'mkd-map-' + num);
							map.data('unique-id', num);
						});
					}

					mkdButton().init();
					mkdInitTestimonials();
					mkdInitPortfolioListMasonry();
					mkdInitPortfolioListPinterest();
					mkdInitPortfolio();
					mkdShowGoogleMap();
					mkdInitProgressBars();
				},
				onLeave: function (index, nextIndex, direction) {
					mkdCheckVerticalSplitSectionsForHeaderStyle($($('.mkd-vss-ms-right .mkd-vss-ms-section')[$(".mkd-vss-ms-right .mkd-vss-ms-section").length - nextIndex]).data('header-style'), defaultHeaderStyle);
				}
			});


			if (mkd.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}

			$(window).resize(function () {
				if (mkd.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}

			});
		}
	}

	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function mkdCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {

		if (section_header_style != undefined && section_header_style != '') {
			mkd.body.removeClass('mkd-light-header mkd-dark-header').addClass('mkd-' + section_header_style + '-header');
		} else if (default_header_style != '') {
			mkd.body.removeClass('mkd-light-header mkd-dark-header').addClass('mkd-' + default_header_style + '-header');
		} else {
			mkd.body.removeClass('mkd-light-header mkd-dark-header');
		}
	}

	/**
	 * Init Thumbnail Image Slider
	 */
	function mkdThumbnailImageSlider() {

		if ($('.mkd-thumbnail-image-slider').length) {
			$('.mkd-thumbnail-image-slider').each(function () {

				//vars
				var imageSlider = $(this);
				var thumbs = "thumbnails";
				var navigation = false;
				var customNavigation = false;

				imageSlider.waitForImages(function () {
					$(this).animate({opacity: 1}, 2200);
				});

				imageSlider.find('.flexslider').flexslider({
					animation: "slide",
					controlNav: thumbs,
					directionNav: navigation,
					customDirectionNav: customNavigation,
					animationLoop: false,
					start: function (slider) {
						slider.find('.flex-control-nav .flex-active').parent('li').addClass('active-item').siblings().removeClass('active-item');

						mkd.modules.common.mkdInitParallax();
					},
					after: function (slider) {
						slider.find('.flex-control-nav .flex-active').parent('li').addClass('active-item').siblings().removeClass('active-item');
					}
				});


			});
		}

	}

	/**
	 * Static Text Slider
	 */
	function mkdStaticTextSlider() {
		var staticTextSlider = $('.mkd-static-text-slider-holder .flexslider');

		if (staticTextSlider.length) {
			staticTextSlider.each(function () {


				staticTextSlider.waitForImages(function () {
					$(this).animate({opacity: 1}, 1000);
				});

				$(this).flexslider({
					animation: "slide",
					slideshow: true,
					controlNav: false,
					directionNav: true,
					animationLoop: true,
					start: function () {
						mkd.modules.common.mkdInitParallax();
					}
				});
			});
		}
	}

	/**
	 * Tab Slider
	 */
	function mkdTabSlider() {
		var tabSliders = $('.mkd-tab-slider-container');

		if (tabSliders.length) {
			tabSliders.each(function () {
				$(this).flexslider({
					animation: 'slide',
					manualControls: '.mkd-tab-slider-nav .mkd-tab-slider-nav-item',
					selector: '.mkd-tab-slider-container-inner li',
					directionNav: false
				});
			});
		}
	}

	/*
	 ** Product Slider
	 */
	function mkdProductSlider() {

		if ($('.mkd-product-slider').length) {
			$('.mkd-product-slider').each(function () {
				var $this = $(this);

				var products_shown;
				if (typeof $(this).data('products_shown') !== 'undefined') {
					products_shown = $(this).data('products_shown');
				}
				else {
					products_shown = 'auto';
				}

				var maxItems = ($this.parents('.mkd-grid-section').length == 1) ? 3 : products_shown;
				var itemWidthTemp;

				switch (products_shown) {
					case 3:
						itemWidthTemp = 667;
						break;
					case 4:
						itemWidthTemp = 500;
						break;
					case 5:
						itemWidthTemp = 400;
						break;
					case 6:
						itemWidthTemp = 334;
						break;
					default:
						itemWidthTemp = 500;

						break;
				}

				var itemWidth = ($this.parents('.mkd-grid-section').length == 1) ? 353 : itemWidthTemp;

				var active = function (element) {
					var items = $this.find('ul.products').triggerHandler("currentVisible");
					$this.find('ul.products').children().removeClass("active");
					items.filter(":eq(" + element + ")").addClass("active");
				};

				$this.find('ul.products').carouFredSel({
					circular: true,
					responsive: true,
					scroll: {
						items: 1,
						onBefore: function () {
							active(2);
						}
					},
					prev: {
						button: function () {
							return $this.find('.caroufredsel-direction-nav .caroufredsel-prev');
						}
					},
					next: {
						button: function () {
							return $this.find('.caroufredsel-direction-nav .caroufredsel-next');
						}
					},
					pagination: function () {
						return $this.find('.mkd-product-slider-pager');
					},
					items: {
						width: itemWidth,
						visible: {
							min: 1,
							max: maxItems
						}
					},
					auto: false,
					pauseOnHover: true,
					mousewheel: false,
					swipe: {
						onMouse: true,
						onTouch: true
					},
					onCreate: function () {
						active(1);
						$this.find('ul.products').trigger('updateSizes');
						setTimeout(function () {
							mkdCalculateHeights();
							mkd.modules.common.mkdInitParallax();
						}, 300);
						$this.animate({'opacity': 1}, 1000);
					}
				});

				$(window).resize(function () {
					mkdCalculateHeights();
				});

			});

		}
	}

	function mkdCalculateHeights() {
		if ($('.mkd-product-slider .products').length) {
			$('.mkd-product-slider .products').each(function () {
				$(this).parents('.caroufredsel_wrapper').css({'height': ($(this).find('li').outerHeight()) + 'px'});
			});
		}
	}

	/*
	 * Type out functionality for Section Title shortcode
	 */
	function mkdTypeOutSectionTitle() {

		var typeOuts = $('.mkd-section-title-holder .mkd-typed');

		if (typeOuts.length) {
			typeOuts.each(function () {

				//vars
				var typeOut = $(this),
					typeOutHolder = typeOut.parent('.mkd-typed-wrap'),
					str,
					cursorStyleSet = false,
					cursorGradientStyle = typeOutHolder.attr('data-cursor-gradient'),
					cursorColorStyle = typeOutHolder.attr('data-cursor-color'),
					loop = typeOutHolder.attr('data-loop'),
					string_1 = typeOut.find('.mkd-typed-strings:first-child').text(),
					string_2 = typeOut.find('.mkd-typed-strings:nth-child(2)').text(),
					string_3 = typeOut.find('.mkd-typed-strings:nth-child(3)').text();

				//show only the strings that are entered in
				if (!string_2.trim() || !string_3.trim()) {
					str = [string_1];
				}
				if (!string_3.trim() && string_2.length) {
					str = [string_1, string_2];
				}
				if (string_1.length && string_2.length && string_3.length) {
					str = [string_1, string_2, string_3];
				}

				//loop
				if (loop == 'yes') {
					loop = true;
				} else {
					loop = false;
				}

				//typeout
				typeOutHolder.appear(function () {
					typeOutHolder.addClass('mkd-typing');
					setTimeout(function () {
						typeOut.typed({
							strings: str,
							typeSpeed: 80,
							backDelay: 800,
							loop: loop,
							contentType: 'text',
							loopCount: true,
							cursorChar: "|",
							preStringTyped: function () {
								if (!cursorStyleSet && cursorGradientStyle != '' && cursorGradientStyle != undefined) {
									typeOutHolder.find('.typed-cursor').wrapInner("<span></span>").addClass(cursorGradientStyle);
									cursorStyleSet = true;
								} else if (!cursorStyleSet && cursorColorStyle != '' && cursorColorStyle != undefined) {
									typeOutHolder.find('.typed-cursor').css('color', cursorColorStyle);
									cursorStyleSet = true;
								}
							}
						});
					}, 100);
				});

			});
		}
	}


	/*
	 * Animate Workflow shortcode
	 */
	function mkdWorkflow() {
		var workflowShortcodes = $('.mkd-workflow');
		if (workflowShortcodes.length) {
			workflowShortcodes.each(function () {
				var workflowShortcode = $(this);
				if (workflowShortcode.hasClass('mkd-workflow-animate')) {
					var workflowItems = workflowShortcode.find('.mkd-workflow-item');

					workflowShortcode.appear(function () {
						workflowShortcode.addClass('mkd-appeared');
						setTimeout(function () {
							workflowItems.each(function (i) {
								var workflowItem = $(this);
								setTimeout(function () {
									workflowItem.addClass('mkd-appeared');
								}, 350 * i);
							});
						}, 350);
					}, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

				}
			});
		}
	}

	/**
	 * Device Slider shortcode
	 */
	function mkdDeviceSlider() {

		var deviceSlider = $('.mkd-device-slider-holder'),
			carousel;

		if (deviceSlider.length) {
			deviceSlider.each(function () {
				carousel = $(this).find('.owl-carousel');

				carousel.owlCarousel({
					autoplay: true,
					autoplayInterval: 3000,
					autoplayHoverPause: true,
					loop: true,
					nav: false,
					dots: false,
					items: 1,
					smartSpeed: 600
				});

			});
		}

	}

    /**
     * Cards Slider shortcode
     */
    var mkdCardsSlider = mkd.modules.shortcodes.mkdCardsSlider = function () {

            var handleMovement = function (slides, slider, curSlideId, newSlideId, newSlide, centerSlider) {
                slider.data('slide', newSlideId).attr('data-slide', newSlideId);
                slider.find('.mkd-card-slider').css('margin-left', centerSlider ? (-newSlide.position().left + $(slider).outerWidth() / 2 - newSlide.outerWidth() / 2) : -newSlide.position().left);

                setTimeout(function(){
                    mkdLazyImages();
                },500); //500 is duration of margin animation

                var direction = curSlideId < newSlideId ? 1 : -1;

                if (direction > 0 && newSlideId == slides.length) {
                    slider.find('.button[data-direction="next"]').addClass('hidden');
                } else {
                    slider.find('.button[data-direction="next"]').removeClass('hidden');
                }
                if (direction < 0 && newSlideId == 1) {
                    slider.find('.button[data-direction="prev"]').addClass('hidden');
                } else {
                    slider.find('.button[data-direction="prev"]').removeClass('hidden');
                }
            }

            var setSliderToCenter = function(slider,activeMiddleSlide,centerSlider){
                slider.each(function (i, slider) {
                    var slides = $(slider).find('.mkd-card-slider > .slide'),
                        dots = $(slider).find('.dot'),
                        center = Math.round(slides.length / 2) - 1;

                    if(activeMiddleSlide) {
                        if (dots.length > 0) {
                            $(dots[center]).click();
                        } else {
                            handleMovement(slides,$(slider),1,center,$(slides[center]),centerSlider);
                        }
                        $(slider).data('slide', center + 1).attr('data-slide', center + 1);
                        $(slider).find('.button').removeClass('hidden');
                    }else{
                        if (dots.length > 0) {
                            $(dots[0]).click();
                        } else {
                            handleMovement(slides,$(slider),1,1,$(slides[0]),centerSlider);
                        }
                    }
                })
            }

            //set max width of slides
            var maxWidthOfSlides = function (slides,slider,autoheight) {
                slider.find('.mkd-card-slider').width(99999);
                slides.each(function(){
                    $(this).css('max-width',slider.outerWidth());
                });
            }

            //initialize card headers
            var initCardHeaders = function() {

                var headers = $('.cards');
                headers.each(function () {
                    var header = $(this);
                    var cards = header.find('.card');
                    cards.each(function() {
                        var card = $(this);
                        card.click(function () {
                            if (!cards.last().is(card)) {
                                card.detach();
                                card.insertAfter(cards.last());
                                cards = header.find('.card');
                            }
                            return false;
                        })
                    });
                });
            }

            //initialize card headers hover animation
            var initCardsHeadersHoverAnimation = function(){
                var headers = $('.cards');
                headers.each(function () {
                    var header = $(this);
                    var cards = header.find('.card').get().reverse();
                    header.appear(function () {
                        $(cards).each(function (i) {
                            var card = $(this);
                            setTimeout(function () {
                                card.addClass('hovered');
                                setTimeout(function () {
                                    card.removeClass('hovered');
                                }, 600);
                            }, 200 * i);

                        });
                    }, {accX: 0, accY: -(mkd.windowHeight / 3)});
                });
            }

            //initialize card panes changing
            var initCardPanes = function() {
                $('.mkd-cards-holder .card').each(function (i, card) {
                    $(card).click(function () {
                        var pane = $('.'+$(card).data('value'));
                        pane.closest('.mkd-card-panes').find('.pane').removeClass('active');
                        pane.addClass('active');
                        mkdLazyImages();
                        return false;
                    })
                });

                $('.mkd-cards-holder').each(function(i, holder){
                    $(holder).find('.mkd-card-panes .pane').last().addClass('active'); //set last slider as active
                    //replace cards headers in right place
                    if($(holder).find('.mkd-card-panes .pane .card').length) {
                        $(holder).find('.mkd-card-panes .pane .card').each(function (i, card) {
                            $(card).detach();
                            $(holder).find('.mkd-cards-header').append($(card));
                        });
                    }else{
                        $(holder).find('.mkd-cards-header').remove();
                    }
                });
            }

            //set height of slider
            var setHeightOfSlider = function(){
                $('.mkd-card-panes').each(function() {
                    var $this = $(this);
                    var maxHeight = -1;
                    var element_height = $this.find('.pane').height();
                    maxHeight = maxHeight > element_height ? maxHeight : element_height;
                    $this.height(maxHeight);
                });
            }

            //set swipe functionality on all sliders
            var setSwipeFunctionality = function(slider){
                slider.swipe({
                    swipeLeft: function () {
                        slider.find('.button[data-direction="next"]').click();
                    },
                    swipeRight: function () {
                        slider.find('.button[data-direction="prev"]').click();
                    },
                    threshold: 20
                });
            }


            //initialize sliders in every pane
            var initiateSliders = function() {
                $('.mkd-card-slider-holder').each(function (i, slider) {
                    var slides = $(slider).find('.mkd-card-slider > .slide'),
                        activeMiddleSlide = $(slider).data('active-middle-slide'),
                        centerSlider = $(slider).data('center');

                    //handle navigation arros click
                    $(slider).find('.button').each(function (i, button) {
                        $(button).click(function () {
                            var direction = $(button).data('direction') == 'prev' ? -1 : 1,
                                curSlideId = $(slider).data('slide'),
                                newSlideId = $(slider).data('slide') + direction,
                                newSlide = $(slider).find('.slide[data-slide="' + newSlideId + '"]');

                            if (newSlide.length) {
                                handleMovement(slides, $(slider), curSlideId, newSlideId, newSlide, centerSlider);
                                $(slider).find('.dot').removeClass('active').filter('[data-slide="' + newSlideId + '"]').addClass('active');
                            }
                            return false;
                        });
                    });

                    //handle navigation bullets click
                    $(slider).find('.dot').each(function (i, dot) {
                        $(dot).click(function () {
                            $(slider).find('.dot').removeClass('active');
                            $(dot).addClass('active');
                            var curSlideId = $(slider).data('slide'),
                                newSlideId = $(dot).data('slide'),
                                newSlide = $(slider).find('.slide[data-slide="' + newSlideId + '"]');
                            if (newSlide.length) {
                                handleMovement(slides, $(slider), curSlideId, newSlideId, newSlide, centerSlider);
                            }
                            return false;
                        });
                    });


                    /** 1. **/ maxWidthOfSlides(slides, $(slider), false);
                    /** 2. **/ setSliderToCenter($(slider), activeMiddleSlide, centerSlider);
                    /** 3. **/ setSwipeFunctionality($(slider));
                    $(window).resize(function () {
                        maxWidthOfSlides(slides, $(slider), true);
                        setSliderToCenter($(slider), activeMiddleSlide, centerSlider);
                        setHeightOfSlider();
                    });
                });
            }


            return {
                init: function(){
                    if ($('.mkd-card-slider-holder').length) {
                        initiateSliders();
                        setHeightOfSlider();
                        initCardPanes();
                        initCardHeaders();
                    }
                },
                load: function(){
                    if ($('.mkd-card-slider-holder').length) {
                        setHeightOfSlider();
                        initCardsHeadersHoverAnimation();
                    }
                }
            };

    }

    /**
     * Loads images that are set to be 'lazy'
     */
    function mkdLazyImages() {
        $.fn.preloader = function (action, callback) {
            if (!!action && action == 'destroy') {
                this.find('.mkd-preloader').remove();
            } else {
                var block = $('<div class="mkd-preloader"></div>');
                $('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="75" width="75" viewbox="0 0 75 75"><circle stroke-linecap="round" cx="37.5" cy="37.5" r="33.5" stroke-width="8"/></svg>').appendTo(block);
                block.appendTo(this);
                if(typeof callback == 'function')
                    callback();
            }
            return this;
        };

        $('img[data-image][data-lazy="true"]:not(.lazyLoading)').each(function(i, object) {
            object = $(object);

            if(object.attr('data-ratio')) {
                object.height(object.width()*object.data('ratio'));

            }

            var rect = object[0].getBoundingClientRect(),
                vh = (mkd.windowHeight || document.documentElement.clientHeight),
                vw = (mkd.windowWidth || document.documentElement.clientWidth),
                oh = object.outerHeight(),
                ow = object.outerWidth();


            if(
                ( rect.top !=0 || rect.right !=0 || rect.bottom !=0 || rect.left !=0 ) &&
                ( rect.top >= 0 || rect.top + oh >= 0 ) &&
                ( rect.bottom >=0 && rect.bottom - oh - vh <= 0 ) &&
                ( rect.left >= 0 || rect.left + ow >= 0 ) &&
                ( rect.right >=0 && rect.right - ow - vw <= 0 )
            ) {

                var p = object.parent();
                if(!!p) {
                    p.preloader('init');
                }
                object.addClass('lazyLoading');

                var imageObj = new Image();

                $(imageObj).on('load', function() {

                    p.preloader('destroy');
                    object
                        .removeAttr('data-image')
                        .removeData('image')
                        .removeAttr('data-lazy')
                        .removeData('lazy')
                        .removeClass('lazyLoading');

                    object.attr('src', $(this).attr('src'));
                    object.height('auto');

                }).attr('src', object.data('image'));
            }
        });
    }

    /**
     * Cards Gallery shortcode
     */
    function mkdCardsGallery() {
        if ($('.mkd-cards-gallery-holder').length) {
            $('.mkd-cards-gallery-holder').each(function(){
                var gallery = $(this);
                var cards =  gallery.find('.card');
                cards.each(function() {
                    var card = $(this);
                    card.click(function () {
                        if (!cards.last().is(card)) {
                            card.addClass('out').animate({
                                opacity: 0,
                                marginLeft: '20%'
                            },200,function(){
                                card.detach();
                                card.insertAfter(cards.last()).animate({
                                    opacity: 1,
                                    marginLeft: '0%'
                                },500,function(){
                                    card.removeClass('out');
                                });
                                cards = gallery.find('.card');
                            });
                            return false;
                        }
                    });
                });
            });
        }
    }

    /**
     * Expanding Images shortcode
     */
    function mkdExpandingImages(){
        
        if ($('.mkd-expanding-images').length) {
            $('.mkd-expanding-images').each(function(){
                var $this = $(this);
                $this.appear(function () {
                    $this.addClass('active');
                }, {accX: 0, accY: -($this.height())});
            });
        }

    }

})
(jQuery);
(function ($) {
	'use strict';

	var woocommerce = {};
	mkd.modules.woocommerce = woocommerce;

	woocommerce.mkdInitQuantityButtons = mkdInitQuantityButtons;
	woocommerce.mkdInitSelect2 = mkdInitSelect2;

	woocommerce.mkdOnDocumentReady = mkdOnDocumentReady;
	woocommerce.mkdOnWindowLoad = mkdOnWindowLoad;
	woocommerce.mkdOnWindowResize = mkdOnWindowResize;
	woocommerce.mkdOnWindowScroll = mkdOnWindowScroll;

	$(document).ready(mkdOnDocumentReady);
	$(window).load(mkdOnWindowLoad);
	$(window).resize(mkdOnWindowResize);
	$(window).scroll(mkdOnWindowScroll);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdOnDocumentReady() {
		mkdInitQuantityButtons();
		mkdInitSelect2();
	}

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdOnWindowLoad() {

	}

	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function mkdOnWindowResize() {

	}

	/*
	 All functions to be called on $(window).scroll() should be in this function
	 */
	function mkdOnWindowScroll() {

	}


	function mkdInitQuantityButtons() {

		$(document).on('click', '.mkd-quantity-minus, .mkd-quantity-plus', function (e) {
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
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			inputField.trigger('change');
		});

	}

	function mkdInitSelect2() {

		if ($('.woocommerce-ordering .orderby').length || $('#calc_shipping_country').length) {

			$('.woocommerce-ordering .orderby').select2({
				minimumResultsForSearch: Infinity
			});

			$('#calc_shipping_country').select2();
		}

		$('.variations_form.cart select').select2({
			minimumResultsForSearch: Infinity
		});

	}


})(jQuery);
(function($) {
	'use strict';

	var portfolio = {};
	mkd.modules.portfolio = portfolio;

	portfolio.mkdOnDocumentReady = mkdOnDocumentReady;
	portfolio.mkdOnWindowLoad = mkdOnWindowLoad;
	portfolio.mkdOnWindowResize = mkdOnWindowResize;
	portfolio.mkdOnWindowScroll = mkdOnWindowScroll;

	portfolio.mkdPortfolioSingleMasonryImages = mkdPortfolioSingleMasonryImages;

	$(document).ready(mkdOnDocumentReady);
	$(window).load(mkdOnWindowLoad);
	$(window).resize(mkdOnWindowResize);
	$(window).scroll(mkdOnWindowScroll);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdOnDocumentReady() {
		portfolio.mkdPortfolioSlider();
	}

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdOnWindowLoad() {
		mkdPortfolioSingleMasonryImages().init();
		mkdPortfolioSingleFollow().init();
	}

	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function mkdOnWindowResize() {

	}

	/*
	 All functions to be called on $(window).scroll() should be in this function
	 */
	function mkdOnWindowScroll() {

	}

	portfolio.mkdPortfolioSlider = function() {
		var sliders = $('.mkd-portfolio-slider-holder');
		if(sliders.length) {
			sliders.each(function() {
				var slider = $(this).find('.mkd-portfolio-slider-list');
				var numberOfItems = slider.data('columns');
				var autoPlay = slider.data('enable-autoplay');
				var pagination = slider.data('enable-pagination');

				slider.waitForImages(function() {
					slider.css('visibility', 'visible');
				});

				if(!slider.hasClass('owl-carousel')) {
					slider.addClass('owl-carousel');
				}


				if(pagination !== undefined) {
					if(pagination == 'yes') {
						pagination = true;
					} else {
						pagination = false;
					}
				}

				if(autoPlay !== undefined) {
					if(autoPlay == 'yes') {
						autoPlay = true;
					} else {
						autoPlay = false;
					}
				}

				slider.owlCarousel({
					responsive: {
						0: {
							items: 1,
						},
						768: {
							items: 2,
						},
						1024: {
							items: numberOfItems - 1,
						},
						1280: {
							items: numberOfItems,
						}
					},
					items: numberOfItems,
					autoHeight: true,
					autoplay: autoPlay,
					autoplayTimeout: 3000,
					autoplayHoverPause: true,
					loop: true,
					nav: false,
					dots: pagination,
					smartSpeed: 400,
				});

			});
		}
	};


	var mkdPortfolioSingleFollow = function() {

		var info = $('.mkd-follow-portfolio-info .small-images.mkd-portfolio-single-holder .mkd-portfolio-info-holder, ' +
			'.mkd-follow-portfolio-info .small-slider.mkd-portfolio-single-holder .mkd-portfolio-info-holder');

		if(info.length) {
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

				if(mediaHolderHeight > infoHolderHeight) {
					if(mkd.scroll > infoHolderOffset) {
						info.animate({
							marginTop: (mkd.scroll - (infoHolderOffset) + mkdGlobalVars.vars.mkdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
						});
					}
				}

			}
		};

		var recalculateInfoHolderPosition = function() {

			if(info.length) {
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
						}
						else {
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

			init: function() {
				if(!mkd.modules.common.mkdIsTouchDevice()) {
					infoHolderPosition();
					$(window).scroll(function() {
						recalculateInfoHolderPosition();
					});
				}
			}

		};

	};

	function mkdPortfolioSingleMasonryImages() {

		var holder = $('.mkd-portfolio-single-holder.masonry');
		var ptfGallery = holder.find('.mkd-ptf-gallery');
		var coeficient = 1.48; //in order to make images to be landscape
		var sizerWidth = ptfGallery.find('.mkd-ptf-gallery-sizer').outerWidth();

		var size = sizerWidth / coeficient + 23; //23px is spacing between items

		var resizeMasonryImages = function() {

			sizerWidth = ptfGallery.find('.mkd-ptf-gallery-sizer').outerWidth();
			size = sizerWidth / coeficient + 23; //23px is spacing between items

			var defaultItem = ptfGallery.find('.mkd-ptf-gallery-item.default');
			var largeHeightItem = ptfGallery.find('.mkd-ptf-img-large-height');
			var largeHeightWidthItem = ptfGallery.find('.mkd-ptf-img-large-height-width');

			defaultItem.css('height', size);
			largeHeightItem.css('height', Math.round(2 * size));
			largeHeightWidthItem.css('height', Math.round(2 * size));


		};

		var initMasonryItems = function() {

			ptfGallery.isotope({
				itemSelector: '.mkd-ptf-gallery-item',
				masonry: {
					columnWidth: '.mkd-ptf-gallery-sizer',
					gutter: '.mkd-ptf-gallery-gutter'
				}
			});

		};

		return {

			init: function() {

				resizeMasonryImages();
				initMasonryItems();

				$(window).resize(function() {
					resizeMasonryImages();
				});

			}

		};

	}

})(jQuery);
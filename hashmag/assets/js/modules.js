(function($) {
    "use strict";

    window.mkdf = {};
    mkdf.modules = {};

    mkdf.scroll = 0;
    mkdf.window = $(window);
    mkdf.document = $(document);
    mkdf.windowWidth = $(window).width();
    mkdf.windowHeight = $(window).height();
    mkdf.body = $('body');
    mkdf.html = $('html, body');
    mkdf.menuDropdownHeightSet = false;
    mkdf.defaultHeaderStyle = '';
    mkdf.minVideoWidth = 1500;
    mkdf.videoWidthOriginal = 1280;
    mkdf.videoHeightOriginal = 720;
    mkdf.videoRatio = 1.61; // golden ration for video
    mkdf.boxedLayoutWidth = 1280;
    
    $(document).ready(function(){
        mkdf.scroll = $(window).scrollTop();
    });


    $(window).resize(function() {
        mkdf.windowWidth = $(window).width();
        mkdf.windowHeight = $(window).height();
    });


    $(window).scroll(function(){
        mkdf.scroll = $(window).scrollTop();
    });

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    mkdf.modules.common = common;

    common.mkdfIsTouchDevice = mkdfIsTouchDevice;
    common.mkdfDisableSmoothScrollForMac = mkdfDisableSmoothScrollForMac;
    common.mkdfInitAudioPlayer = mkdfInitAudioPlayer;
    common.mkdfPostGallerySlider = mkdfPostGallerySlider;
    common.mkdfFluidVideo = mkdfFluidVideo;
    common.mkdfPrettyPhoto = mkdfPrettyPhoto;
    common.mkdfPreloadBackgrounds = mkdfPreloadBackgrounds;
    common.mkdfEnableScroll = mkdfEnableScroll;
    common.mkdfDisableScroll = mkdfDisableScroll;
    common.mkdfWheel = mkdfWheel;
    common.mkdfKeydown = mkdfKeydown;
    common.mkdfPreventDefaultValue = mkdfPreventDefaultValue;
    common.mkdfInitSelfHostedVideoPlayer = mkdfInitSelfHostedVideoPlayer;
    common.mkdfSelfHostedVideoSize = mkdfSelfHostedVideoSize;
    common.mkdfInitBackToTop = mkdfInitBackToTop;
    common.mkdfBackButtonShowHide = mkdfBackButtonShowHide;
    common.mkdfInitParallax = mkdfInitParallax;

	$(document).ready(function() {
        mkdfIsTouchDevice();
        mkdfDisableSmoothScrollForMac();
        mkdfInitAudioPlayer();
		mkdfFluidVideo();
        mkdfPostGallerySlider();
        mkdfPrettyPhoto();
        mkdfPreloadBackgrounds();
        mkdfInitElementsAnimations();
        mkdfInitAnchor().init();
        mkdfInitVideoBackground();
        mkdfInitVideoBackgroundSize();
        mkdfInitSelfHostedVideoPlayer();
		mkdfSelfHostedVideoSize();
        mkdfInitBackToTop();
        mkdfBackButtonShowHide();
	});

    $(window).resize(function() {
		mkdfInitVideoBackgroundSize();
		mkdfSelfHostedVideoSize();
	});

    $(window).load(function() {
		mkdfInitParallax();
	});

    /*
     ** Disable shortcodes animation on appear for touch devices
     */
    function mkdfIsTouchDevice() {
        if(Modernizr.touch && !mkdf.body.hasClass('mkdf-no-animations-on-touch')) {
            mkdf.body.addClass('mkdf-no-animations-on-touch');
        }
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function mkdfDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && mkdf.body.hasClass('mkdf-smooth-scroll')) {
            mkdf.body.removeClass('mkdf-smooth-scroll');
        }
    }

	function mkdfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    function mkdfInitAudioPlayer() {

        var players = $('audio.mkdf-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /*
    **  Init gallery post slider 
    */
    function mkdfPostGallerySlider(){

        var bsHolder = $('.mkdf-pg-slider');

        if(bsHolder.length){
            bsHolder.each(function(){
                var thisBsHolder = $(this);

                thisBsHolder.flexslider({
                    selector: ".mkdf-pg-slides", 
                    animation: "fade",
                    controlNav: false,
                    directionNav: true,
                    prevText: "<span class='ion-chevron-left'></span>",
                    nextText: "<span class='ion-chevron-right'></span>",
                    slideshowSpeed: 6000,
                    animationSpeed: 400,  
                });
            });
        }
    }

    function mkdfPrettyPhoto() {
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
     *	Preload background images for elements that have 'mkdf-preload-background' class
     */
    function mkdfPreloadBackgrounds(){

        $(".mkdf-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('mkdf-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('mkdf-preload-background'); }); //make sure that mkdf-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    /*
     *	Start animations on elements
     */
    function mkdfInitElementsAnimations(){

        var touchClass = $('.mkdf-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.mkdf-grow-in, .mkdf-fade-in-down, .mkdf-element-from-fade, .mkdf-element-from-left, .mkdf-element-from-right, .mkdf-element-from-top, .mkdf-element-from-bottom, .mkdf-flip-in, .mkdf-x-rotate, .mkdf-z-rotate, .mkdf-y-translate, .mkdf-fade-in, .mkdf-fade-in-left-x-rotate'),
            clasess,
            animationClass;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
                var element = $(this);

                clasess = element.attr('class').split(/\s+/);
                animationClass = clasess[1];

                element.appear(function() {
                    element.addClass(animationClass+'-on');
                },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }

    /*
     **	Anchor functionality
     */
    var mkdfInitAnchor = mkdf.modules.common.mkdfInitAnchor = function() {

        /**
         * Set active state on clicked anchor
         * @param anchor, clicked anchor
         */
        var setActiveState = function(anchor){

            $('.mkdf-main-menu .mkdf-active-item, .mkdf-mobile-nav .mkdf-active-item, .mkdf-vertical-menu .mkdf-active-item, .mkdf-fullscreen-menu .mkdf-active-item').removeClass('mkdf-active-item');
            anchor.parent().addClass('mkdf-active-item');

            $('.mkdf-main-menu a, .mkdf-mobile-nav a, .mkdf-vertical-menu a, .mkdf-fullscreen-menu a').removeClass('current');
            anchor.addClass('current');
        };

        /**
         * Check anchor active state on scroll
         */
        var checkActiveStateOnScroll = function(){

            $('[data-mkdf-anchor]').waypoint( function(direction) {
                if(direction === 'down') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkdf-anchor")+"']"));
                }
            }, { offset: '50%' });

            $('[data-mkdf-anchor]').waypoint( function(direction) {
                if(direction === 'up') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkdf-anchor")+"']"));
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

            if(hash !== "" && $('[data-mkdf-anchor="'+hash+'"]').length > 0){
                //triggers click which is handled in 'anchorClick' function
                $("a[href='"+window.location.href.split('#')[0]+"#"+hash).trigger( "click" );
            }
        };

        /**
         * Calculate header height to be substract from scroll amount
         * @param anchoredElementOffset, anchorded element offest
         */
        var headerHeihtToSubtract = function(anchoredElementOffset){

            var headerHeight = mkdfPerPageVars.vars.mkdfHeaderTransparencyHeight;

            return headerHeight;
        };

        /**
         * Handle anchor click
         */
        var anchorClick = function() {
            mkdf.document.on("click", ".mkdf-main-menu a, .mkdf-btn, .mkdf-anchor", function() {
                var scrollAmount;
                var anchor = $(this);
                var hash = anchor.prop("hash").split('#')[1];

                if(hash !== "" && $('[data-mkdf-anchor="' + hash + '"]').length > 0 && anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]) {

                    var anchoredElementOffset = $('[data-mkdf-anchor="' + hash + '"]').offset().top;
                    scrollAmount = $('[data-mkdf-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                    setActiveState(anchor);

                    mkdf.html.stop().animate({
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
                if($('[data-mkdf-anchor]').length) {
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
    function mkdfInitVideoBackground(){

        $('.mkdf-section .mkdf-video-wrap .mkdf-video').mediaelementplayer({
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
            mkdfInitVideoBackgroundSize();
            $('.mkdf-section .mkdf-mobile-video-image').show();
            $('.mkdf-section .mkdf-video-wrap').remove();
        }
    }

    /*
     **	Calculate video background size
     */
    function mkdfInitVideoBackgroundSize(){

        $('.mkdf-section .mkdf-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.mkdf-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.mkdf-section').outerHeight();
            mkdf.minVideoWidth = mkdf.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / mkdf.videoWidthOriginal;
            var scaleV = sectionHeight / mkdf.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * mkdf.videoWidthOriginal < mkdf.minVideoWidth) {scale = mkdf.minVideoWidth / mkdf.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * mkdf.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * mkdf.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });
    }

    function mkdfDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', mkdfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = mkdfWheel;
        document.onkeydown = mkdfKeydown;

        if(mkdf.body.hasClass('mkdf-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdfEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', mkdfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(mkdf.body.hasClass('mkdf-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdfWheel(e) {
        mkdfPreventDefaultValue(e);
    }

    function mkdfKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                mkdfPreventDefaultValue(e);
                return;
            }
        }
    }

    function mkdfPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function mkdfInitSelfHostedVideoPlayer() {

        var players = $('.mkdf-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function mkdfSelfHostedVideoSize(){

		$('.mkdf-self-hosted-video-holder .mkdf-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.mkdf-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / mkdf.videoRatio;

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

    function mkdfToTopButton(a) {
        
        var b = $("#mkdf-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function mkdfBackButtonShowHide(){        
        mkdf.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { mkdfToTopButton('off'); } else { mkdfToTopButton('on'); }
        });
    }

    function mkdfInitBackToTop(){       
        var backToTopButton = $('#mkdf-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            mkdf.html.animate({scrollTop: 0}, mkdf.window.scrollTop()/5, 'easeInOutQuart');
        });
    }

	/*
	 **	Sections with parallax background image
	 */
	function mkdfInitParallax(){

	    if($('.mkdf-parallax-section-holder').length){
	        $('.mkdf-parallax-section-holder').each(function() {

	            var parallaxElement = $(this);
	            var speed = parallaxElement.data('mkdf-parallax-speed')*0.4;
	            parallaxElement.parallax("50%", speed);
	        });
	    }
	}

})(jQuery);
(function ($) {
    "use strict";

    var header = {};
    mkdf.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour = "";
    header.mkdfInitMobileNavigation = mkdfInitMobileNavigation;
    header.mkdfMobileHeaderBehavior = mkdfMobileHeaderBehavior;
    header.mkdfSetDropDownMenuPosition = mkdfSetDropDownMenuPosition;
    header.mkdfSetWideMenuPosition = mkdfSetWideMenuPosition;
    header.mkdfSideArea = mkdfSideArea;
    header.mkdfSideAreaScroll = mkdfSideAreaScroll;
    header.mkdfDropDownMenu = mkdfDropDownMenu;
    header.mkdfSearch = mkdfSearch;

    $(document).ready(function () {
        mkdfHeaderBehaviour();
        mkdfInitMobileNavigation();
        mkdfMobileHeaderBehavior();
        mkdfSideArea();
        mkdfSideAreaScroll();
        mkdfSetDropDownMenuPosition();
        mkdfSetWideMenuPosition();
        mkdfSearch();
    });

    $(window).load(function () {
        mkdfDropDownMenu();
        mkdfSetDropDownMenuPosition();
    });

    $(window).resize(function () {
        mkdfSetWideMenuPosition();
        mkdfDropDownMenu();
    });

    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdfHeaderBehaviour() {

        var header = $('.mkdf-page-header');
        var stickyHeader = $('.mkdf-sticky-header');
        var stickyAppearAmount;
        var headerAppear;

        var fixedHeaderWrapper = $('.mkdf-fixed-wrapper');
        var headerMenuAreaOffset = $('.mkdf-page-header').find('.mkdf-fixed-wrapper').length ? $('.mkdf-page-header').find('.mkdf-fixed-wrapper').offset().top : null;

        switch (true) {
            // sticky header that will be shown when user scrolls up
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-up'):
                mkdf.modules.header.behaviour = 'mkdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = mkdfGlobalVars.vars.mkdfTopBarHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight + mkdfGlobalVars.vars.mkdfStickyHeaderHeight + 200; //200 is designer's whish

                headerAppear = function () {
                    var docYScroll2 = $(document).scrollTop();

                    if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkdf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                    } else {
                        mkdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-down-up'):
                mkdf.modules.header.behaviour = 'mkdf-sticky-header-on-scroll-down-up';
                stickyAppearAmount = mkdfPerPageVars.vars.mkdfStickyScrollAmount !== 0 ? mkdfPerPageVars.vars.mkdfStickyScrollAmount : mkdfGlobalVars.vars.mkdfTopBarHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight + 200; //200 is designer's whish
                mkdf.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic

                headerAppear = function () {
                    if (mkdf.scroll < stickyAppearAmount) {
                        mkdf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                    } else {
                        mkdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // on scroll down, when viewport hits header's top position it remains fixed
            case mkdf.body.hasClass('mkdf-fixed-on-scroll'):
                mkdf.modules.header.behaviour = 'mkdf-fixed-on-scroll';
                var headerFixed = function () {
                    if (mkdf.scroll < headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom', 0);
                    }
                    else {
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom', fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function () {
                    headerFixed();
                });

                break;
        }
    }


    function mkdfInitMobileNavigation() {
        var navigationOpener = $('.mkdf-mobile-header .mkdf-mobile-menu-opener');
        var navigationHolder = $('.mkdf-mobile-header .mkdf-mobile-nav');
        var dropdownOpener = $('.mkdf-mobile-nav .mobile_arrow, .mkdf-mobile-nav h6, .mkdf-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if (navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function (e) {
                e.stopPropagation();
                e.preventDefault();

                if (navigationHolder.is(':visible')) {
                    navigationOpener.removeClass('opened');
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationOpener.addClass('opened');
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if (dropdownOpener.length) {
            dropdownOpener.each(function () {
                $(this).on('tap click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var dropdownToOpen = $(this).nextAll('ul').first();
                    var openerParent = $(this).parent('li');
                    if (dropdownToOpen.is(':visible')) {
                        dropdownToOpen.slideUp(animationSpeed);
                        openerParent.removeClass('mkdf-opened');
                    } else {
                        dropdownToOpen.slideDown(animationSpeed);
                        openerParent.addClass('mkdf-opened');
                    }
                });
            });
        }

        $('.mkdf-mobile-nav a, .mkdf-mobile-logo-wrapper a').on('click tap', function (e) {
            if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function mkdfMobileHeaderBehavior() {
        if (mkdf.body.hasClass('mkdf-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var topBar = $('.mkdf-top-bar');
            var mobileHeader = $('.mkdf-mobile-header');
            var adminBar = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var topBarHeight = topBar.is(':visible') ? topBar.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = topBarHeight + mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function () {
                var docYScroll2 = $(document).scrollTop();

                if (docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('mkdf-animate-mobile-header');
                    mobileHeader.css('margin-bottom', mobileHeaderHeight);
                } else {
                    mobileHeader.removeClass('mkdf-animate-mobile-header');
                    mobileHeader.css('margin-bottom', 0);
                }

                if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    if (adminBar.length) {
                        mobileHeader.find('.mkdf-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');

                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function mkdfSetDropDownMenuPosition() {

        var menuItems = $(".mkdf-drop-down > ul > li.mkdf-menu-narrow");
        menuItems.each(function (i) {

            var browserWidth = mkdf.windowWidth - 16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').width();

            var menuItemFromLeft = 0;
            if (mkdf.body.hasClass('mkdf-boxed')) {
                menuItemFromLeft = mkdf.boxedLayoutWidth - (menuItemPosition - (browserWidth - mkdf.boxedLayoutWidth) / 2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if ($(this).find('li.mkdf-menu-sub').length > 0) {
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
                $(this).find('.mkdf-menu-second').addClass('right');
                $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').addClass('right');
            } else {
                $(this).find('.mkdf-menu-second').removeClass('right');
                $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').removeClass('right');
            }
        });
    }

    function mkdfSetWideMenuPosition() {

        var browserWidth = mkdf.windowWidth;
        var menu_items = $('.mkdf-drop-down > ul > li.mkdf-menu-wide');
        menu_items.each(function (i) {
            if ($(menu_items[i]).find('.mkdf-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.mkdf-menu-second');
                dropDownSecondDiv.css('left', '0'); //reinit left offset for fixed header transition

                if (browserWidth - 16 < 1440 && browserWidth - 16 > 1201) {

                    var headerWidth = Math.floor($('.mkdf-menu-area > .mkdf-grid')[0].getBoundingClientRect().width);

                    var tempWidth = headerWidth != '' ?  headerWidth : '';
                    $(this).find('.mkdf-menu-inner > ul').css('width', tempWidth+'px');
                }
                else {
                    $(this).find('.mkdf-menu-inner > ul').css('width', '');
                }
                
                var dropdown = $(this).find('.mkdf-menu-inner > ul');
                var dropdownWidth = Math.floor(dropdown[0].getBoundingClientRect().width);
                var dropdownPosition = dropdown.offset().left;
                var left_position = 0;


                if (!$(this).hasClass('mkdf-menu-left-position') && !$(this).hasClass('mkdf-menu-right-position')) {
                    left_position = dropdownPosition - (browserWidth - dropdownWidth) / 2;
                    dropDownSecondDiv.css('left', -left_position);
                    dropDownSecondDiv.css('width', dropdownWidth);
                }
            }
        });
    }

    function mkdfDropDownMenu() {

        var menu_items = $('.mkdf-drop-down > ul > li');

        menu_items.each(function (i) {
            if ($(menu_items[i]).find('.mkdf-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.mkdf-menu-second');

                if ($(menu_items[i]).hasClass('mkdf-menu-wide')) {
                    if ($(menu_items[i]).data('wide_background_image') !== '' && $(menu_items[i]).data('wide_background_image') !== undefined) {
                        var wideBackgroundImageSrc = $(menu_items[i]).data('wide_background_image');
                        dropDownSecondDiv.find('> .mkdf-menu-inner > ul').css('background-image', 'url(' + wideBackgroundImageSrc + ')');
                    }
                }

                if (!mkdf.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function () {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function () {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    $(menu_items[i]).mouseenter(function () {
                        dropDownSecondDiv.css({'opacity': '1', 'height': $(menu_items[i]).data('original_height')});
                        dropDownSecondDiv.addClass('mkdf-drop-down-start');
                    });
                    $(menu_items[i]).mouseleave(function () {
                        dropDownSecondDiv.css({'opacity': '0', 'height': '0'});
                        dropDownSecondDiv.removeClass('mkdf-drop-down-start');
                    });
                }
            }
        });

        $('.mkdf-drop-down ul li.mkdf-menu-wide ul li a').on('click', function (e) {
            if (e.which === 1) {
                var $this = $(this);
                setTimeout(function () {
                    $this.mouseleave();
                }, 500);
            }
        });
        mkdf.menuDropdownHeightSet = true;

    }

    /**
     * Show/hide side area
     */
    function mkdfSideArea() {

        var wrapper = $('.mkdf-wrapper'),
            sideMenu = $('.mkdf-side-menu'),
            sideMenuButtonOpen = $('a.mkdf-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false,
            slideOverContent = false;

        if (mkdf.body.hasClass('mkdf-side-menu-slide-from-right')) {
            $('.mkdf-cover').remove();
            cssClass = 'mkdf-right-side-menu-opened';
            wrapper.prepend('<div class="mkdf-cover"/>');
            slideFromRight = true;

        } else if (mkdf.body.hasClass('mkdf-side-menu-slide-with-content')) {

            cssClass = 'mkdf-side-menu-open';
            slideWithContent = true;

        } else if (mkdf.body.hasClass('mkdf-side-area-uncovered-from-content')) {

            cssClass = 'mkdf-right-side-menu-opened';
            slideUncovered = true;

        } else if (mkdf.body.hasClass('mkdf-side-menu-slide-over-content')) {

            cssClass = 'mkdf-side-menu-open';
            slideOverContent = true;

        }

        $('a.mkdf-side-menu-button-opener, a.mkdf-close-side-menu').click(function (e) {
            e.preventDefault();

            if (!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                mkdf.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.mkdf-wrapper .mkdf-cover').click(function () {
                        mkdf.body.removeClass('mkdf-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility': 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function () {
                    if (Math.abs(mkdf.scroll - currentScroll) > 400) {
                        mkdf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function () {
                                sideMenu.css({'visibility': 'hidden'});
                                clearTimeout(hideSideMenu);
                            }, 400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                mkdf.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function () {
                        sideMenu.css({'visibility': 'hidden'});
                        clearTimeout(hideSideMenu);
                    }, 400);
                }

            }

            if (slideWithContent || slideOverContent) {

                e.stopPropagation();
                wrapper.click(function () {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    mkdf.body.removeClass('mkdf-side-menu-open');
                });

            }

        });

    }

    /*
     **  Smooth scroll functionality for Side Area
     */
    function mkdfSideAreaScroll() {

        var sideMenu = $('.mkdf-side-menu');

        if (sideMenu.length) {
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
     * Init Search Types
     */
    function mkdfSearch() {

        var searchOpener = $('header .mkdf-search-submit');

        searchOpener.each(function () {
            var opener = $(this),
                searchWidget = opener.parent().parent().find('.mkdf-search-field');

            //Search results
            if (mkdf.body.hasClass('search-results') || mkdf.body.hasClass('search-no-results')) {
                opener.addClass('mkdf-active');
                searchWidget.addClass('mkdf-active');
            }

            //Open / Close
            opener.on('click', function (e) {
                if (!opener.hasClass('mkdf-active')) {
                    e.preventDefault();
                    opener.addClass('mkdf-active');
                    searchWidget.addClass('mkdf-active');
                    searchWidget.focus();
                } else {
                    if (searchWidget.val() === '') {
                        e.preventDefault();
                        opener.removeClass('mkdf-active');
                        searchWidget.removeClass('mkdf-active');
                        searchWidget.blur();
                    }
                }
            });

            //Close on click away
            $(document).mouseup(function (e) {
                var container = $(".mkdf-search-menu-holder, .mkdf-search-opener");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    e.preventDefault();
                    opener.removeClass('mkdf-active');
                    searchWidget.removeClass('mkdf-active');
                }
            });

            //Close on escape
            $(document).keyup(function (e) {
                if (e.keyCode == 27) { //KeyCode for ESC button is 27
                    e.preventDefault();
                    opener.removeClass('mkdf-active');
                    searchWidget.removeClass('mkdf-active');
                }
            });

        });

    }

})(jQuery);
(function ($) {
    'use strict';

    var shortcodes = {};

    mkdf.modules.shortcodes = shortcodes;

    shortcodes.mkdfInitTabs = mkdfInitTabs;
    shortcodes.mkdfCustomFontResize = mkdfCustomFontResize;
    shortcodes.mkdfBlockReveal = mkdfBlockReveal;
    shortcodes.mkdfLayoutFour = mkdfLayoutFour;
    shortcodes.mkdfBlockThree = mkdfBlockThree;
    shortcodes.mkdfBreakingNews = mkdfBreakingNews;
    shortcodes.mkdfPostClassicSlider = mkdfPostClassicSlider;
    shortcodes.mkdfPostWithThumbnailSlider = mkdfPostWithThumbnailSlider;
    shortcodes.mkdfPostCarousel = mkdfPostCarousel;
    shortcodes.mkdfPostCarouselSwipe = mkdfPostCarouselSwipe;
    shortcodes.mkdfInitStickyWidget = mkdfInitStickyWidget;
    shortcodes.mkdfShowGoogleMap = mkdfShowGoogleMap;

    $(document).ready(function () {
        mkdfIcon().init();
        mkdfInitTabs();
        mkdfButton().init();
        mkdfCustomFontResize();
        mkdfBlockReveal();
        mkdfLayoutFour();
        mkdfBlockThree();
        mkdfBlockThreeMobile();
        mkdfBreakingNews();
        mkdfPostClassicSlider();
        mkdfPostWithThumbnailSlider();
        mkdfPostCarousel();
        mkdfPostCarouselSwipe();
        mkdfSocialIconWidget().init();
        mkdfPostPagination().init();
        mkdfRecentCommentsHover();
        mkdfShowGoogleMap();
    });

    $(window).resize(function () {
        mkdfCustomFontResize();
        mkdfCarouselResize();
        mkdfInitStickyWidget();
        mkdfBlockThree();
        mkdfBlockThreeMobile();
    });

    $(window).load(function () {
        mkdfPostLayoutTabWidget().init();
        mkdfInitStickyWidget();
        mkdf.modules.common.mkdfInitParallax();
        mkdfPostTemplateAnimateExcerpt();
    });

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfIcon = mkdf.modules.shortcodes.mkdfIcon = function () {
        //get all icons on page
        var icons = $('.mkdf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function (icon) {
            if (icon.hasClass('mkdf-icon-animation')) {
                icon.appear(function () {
                    icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
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

                var iconElement = icon.find('.mkdf-icon-element');
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
    var mkdfSocialIconWidget = mkdf.modules.shortcodes.mkdfSocialIconWidget = function () {
        //get all social icons on page
        var icons = $('.mkdf-social-icon-widget-holder');

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

    /*
     **	Init tabs shortcode
     */
    function mkdfInitTabs() {

        var tabs = $('.mkdf-tabs');
        if (tabs.length) {
            tabs.each(function () {
                var thisTabs = $(this);

                if (!thisTabs.hasClass('mkdf-ptw-holder')) {
                    thisTabs.children('.mkdf-tab-container').each(function (index) {
                        index = index + 1;

                        var that = $(this),
                            link = that.attr('id');

                        var navItem = -1;
                        if (that.parent().find('.mkdf-tabs-nav li').hasClass('mkdf-tabs-title-holder')) {
                            index = index + 1;

                            if (that.parent().find('.mkdf-tabs-nav li.mkdf-tabs-title-holder .mkdf-tabs-title-image').length) {
                                that.parent().find('.mkdf-tabs-nav li.mkdf-tabs-title-holder').children('.mkdf-tabs-title-image:first-child').addClass('mkdf-active-tab-image');
                            }
                        }
                        navItem = that.parent().find('.mkdf-tabs-nav li:nth-child(' + index + ') a');

                        var navLink = navItem.attr('href');

                        link = '#' + link;

                        if (link.indexOf(navLink) > -1) {
                            navItem.attr('href', link);
                        }
                    });
                }

                thisTabs.tabs({
                    activate: function () {
                        thisTabs.find('.mkdf-tabs-nav li').each(function () {
                            var thisTab = $(this);

                            if (thisTab.hasClass('ui-tabs-active')) {
                                var activeTab = thisTab.index();

                                if (thisTab.parent().find('.mkdf-tabs-title-image').length) {
                                    thisTab.parent().find('.mkdf-tabs-title-image').removeClass('mkdf-active-tab-image');
                                    thisTab.parent().find('.mkdf-tabs-title-image:nth-child(' + activeTab + ')').addClass('mkdf-active-tab-image');
                                }
                            }
                        });
                    }
                });
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdfButton = mkdf.modules.shortcodes.mkdfButton = function () {
        //all buttons on the page
        var buttons = $('.mkdf-btn');

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
         * Initializes button icon hover background color
         * @param button current button
         */
        var buttonIconHoverBgColor = function (button) {
            if (!button.hasClass('mkdf-btn-outline') && (typeof button.data('icon-hover-bg-color') !== 'undefined' || typeof button.data('icon-hover-bg-color') !== 'undefined')) {
                if (typeof button.data('icon-bg-color') !== 'undefined') {
                    button.children('.mkdf-btn-icon-element').css('background-color', button.data('icon-bg-color'));
                }

                var changeButtonIconBg = function (event) {
                    event.data.button.children('.mkdf-btn-icon-element').css('background-color', event.data.color);
                };

                var originalIconBgColor = (typeof button.data('icon-bg-color') !== 'undefined') ? button.data('icon-bg-color') : 'transparent';
                var hoverIconBgColor = (typeof button.data('icon-hover-bg-color') !== 'undefined') ? button.data('icon-hover-bg-color') : 'transparent';

                button.on('mouseenter', {button: button, color: hoverIconBgColor}, changeButtonIconBg);
                button.on('mouseleave', {button: button, color: originalIconBgColor}, changeButtonIconBg);
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

                var originalBorderColor = button.css('border-color');
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
                        buttonIconHoverBgColor($(this));
                    });
                }
            }
        };
    };

    /*
     **	Custom Font resizing
     */
    function mkdfCustomFontResize() {
        var customFont = $('.mkdf-custom-font-holder');
        if (customFont.length) {
            customFont.each(function () {
                var thisCustomFont = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if (mkdf.windowWidth < 1200) {
                    coef1 = 0.8;
                }

                if (mkdf.windowWidth < 1000) {
                    coef1 = 0.7;
                }

                if (mkdf.windowWidth < 768) {
                    coef1 = 0.6;
                    coef2 = 0.7;
                }

                if (mkdf.windowWidth < 600) {
                    coef1 = 0.5;
                    coef2 = 0.6;
                }

                if (mkdf.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
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

                    if (lineHeight > 70 && mkdf.windowWidth < 1200) {
                        lineHeight = '1.2em';
                    }
                    else if (lineHeight > 35 && mkdf.windowWidth < 768) {
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
     **  Init block revealing
     */
    function mkdfBlockReveal() {

        var blockHolder = $('.mkdf-block-revealing .mkdf-bnl-inner');

        if (blockHolder.length) {
            blockHolder.each(function () {
                var thisBlockHolder = $(this);
                var thisBlockNonFeaturedHolder = thisBlockHolder.find('.mkdf-pbr-non-featured');
                var thisBlockFeaturedHolder = thisBlockHolder.find('.mkdf-pbr-featured');
                var currentItemPosition = 1;
                var activeItemClass = 'mkdf-block-reveal-active-item';
                var activeNonFItemClass = 'mkdf-reveal-nonf-active';
                var thisFeaturedBlocks = thisBlockFeaturedHolder.find('.mkdf-post-block-part-inner');
                var currentItem;
                var itemInterval = 4000;
                var numberOfItems = thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item').length;
                var isPaused = false;
                var loop;

                thisFeaturedBlocks.each(function (e) {
                    var thisFeatured = $(this);

                    if (thisFeatured.hasClass('mkdf-block-reveal-active-item')) {
                        currentItemPosition = e + 1;
                    }
                });

                thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
                thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item:nth-child(' + currentItemPosition + ')').addClass(activeNonFItemClass);
                thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')').fadeIn(200);

                thisBlockNonFeaturedHolder.find('a').click(function (e) {
                    e.preventDefault();

                    var thisItem = $(this).parents('.mkdf-pbr-non-featured .mkdf-pt-four-item');

                    currentItemPosition = $(this).parents('.mkdf-pbr-non-featured > .mkdf-pbr-non-featured-inner > .mkdf-post-item-outer > .mkdf-post-item').index() + 1; // +1 is because index start from 0 and list from 1
                    thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner').removeClass(activeItemClass);
                    thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item').removeClass(activeNonFItemClass);
                    thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
                    thisItem.addClass(activeNonFItemClass);

                    if ($(window).width() <= 1024) {
                        mkdfBlockThreeMobile();
                    }

                });

                mkdf.modules.common.mkdfInitParallax();
                showcaseLoop();

                thisBlockHolder.hover(function (e) {
                    isPaused = true;
                    clearInterval(loop);
                },function (e) {
                    isPaused = false;
                    showcaseLoop();
                });


                //loop through the items
                function showcaseLoop()  {
                    currentItem = 0; //start from the first item, index = 0

                    loop = setInterval(function(){
                         if (!isPaused) {
                            if (currentItemPosition == numberOfItems) {
                                currentItemPosition = 1;
                            } else {
                                currentItemPosition++;
                            }

                            thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner').removeClass(activeItemClass);
                            thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item').removeClass(activeNonFItemClass);
                            thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
                            thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item:nth-child(' + currentItemPosition + ')').addClass(activeNonFItemClass);
                            thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')');

                         }
                        else {
                             isPaused = false;
                         }
                    }, itemInterval);
                }

            });
        }
    }

    /*
     **  Layout 4 calculations
     */
    function mkdfLayoutFour() {
        var layoutHolder = $('header .widget .mkdf-pl-four-holder .mkdf-bnl-outer');

        if (layoutHolder.length) {
            layoutHolder.each(function () {
                var thisLayoutHolder = $(this);
                var thisLayoutItem = thisLayoutHolder.find('.mkdf-pt-four-item');
                var height = layoutHolder.innerHeight();

                thisLayoutItem.each(function () {
                    $(this).height(height);
                });
            });
        }
    }

    /*
     **  Block 3 calculations
     */
    function mkdfBlockThree() {

        if ($(window).width() > 1024) {

            var blockHolder = $('.mkdf-pb-three-holder .mkdf-bnl-inner');

            blockHolder.waitForImages(function () {

                if (blockHolder.length) {
                    blockHolder.each(function () {
                        var thisBlockHolder = $(this),
                            thisBlockFeaturedHolder = thisBlockHolder.find('.mkdf-pbr-featured'),
                            thisBlocks = thisBlockHolder.find('.mkdf-post-block-part-inner'),
                            minHeight = parseInt(thisBlockFeaturedHolder.height());

                        thisBlocks.each(function () {
                            var thisBlockHeight = parseInt($(this).height());
                            if (thisBlockHeight > minHeight) {
                                minHeight = thisBlockHeight;
                            }
                        });

                        thisBlockFeaturedHolder.css('height', minHeight);

                    });
                }
            });
        }
    }


    /*
     **  Block 3 mobile calculations
     */
    function mkdfBlockThreeMobile() {
        var blockThree = $('.mkdf-pb-three-holder');
        if (blockThree.length) {
            blockThree.each(function () {
                var activeItem = $(this).find('.mkdf-block-reveal-active-item img'),
                    activeItemImage = activeItem.attr('src');

                if ($(window).width() < 1024) {
                    activeItem.closest('.mkdf-bnl-outer').css({'background-image': 'url(' + activeItemImage + ')'});
                }
                else {
                    activeItem.closest('.mkdf-bnl-outer').css({'background-image': 'none'});
                }
            });
        }
    }


    /*
     **  Init breaking news
     */
    function mkdfBreakingNews() {

        var bnHolder = $('.mkdf-bn-holder');

        if (bnHolder.length) {

            bnHolder.each(function () {
                var thisBnHolder = $(this);

                thisBnHolder.css('display', 'inline-block');

                var slideshowSpeed = (thisBnHolder.data('slideshowSpeed') !== '' && thisBnHolder.data('slideshowSpeed') !== undefined) ? thisBnHolder.data('slideshowSpeed') : 3000;
                var animationSpeed = (thisBnHolder.data('animationSpeed') !== '' && thisBnHolder.data('animationSpeed') !== undefined) ? thisBnHolder.data('animationSpeed') : 400;

                thisBnHolder.flexslider({
                    selector: ".mkdf-bn-text",
                    animation: "fade",
                    controlNav: false,
                    directionNav: false,
                    maxItems: 1,
                    allowOneSlide: true,
                    slideshowSpeed: slideshowSpeed,
                    animationSpeed: animationSpeed
                });
            });
        }
    }

    /*
     **  Init classic slider
     */
    function mkdfPostClassicSlider() {

        var classicSlider = $('.mkdf-psc-holder');

        if (classicSlider.length) {
            classicSlider.each(function () {
                var thisSliderHolder = $(this),
                    control = false,
                    directionNav = false;

                if (thisSliderHolder.hasClass('mkdf-psc-full-screen')) {
                    var fullScreenHeight = function () {
                        var mkdfHeaderheight;
                        var topBar = $('.mkdf-top-bar');
                        var topBarHeight = topBar.is(':visible') ? topBar.height() : 0;
                        if (mkdf.windowWidth <= 1024) {
                            mkdfHeaderheight = mkdfGlobalVars.vars.mkdfMobileHeaderHeight + topBarHeight;
                        } else {
                            mkdfHeaderheight = mkdfPerPageVars.vars.mkdfHeaderHeight;
                        }
                        thisSliderHolder.find('.mkdf-psc-slide').height(mkdf.windowHeight - mkdfHeaderheight);
                    };
                    fullScreenHeight();
                    $(window).resize(function () {
                        fullScreenHeight();
                    });
                }

                directionNav = thisSliderHolder.data('display_navigation') == 'yes';
                control = thisSliderHolder.data('display_paging') == 'yes';

                thisSliderHolder.css('opacity', '1');

                thisSliderHolder.flexslider({
                    selector: ".mkdf-psc-slide",
                    animation: "fade",
                    controlNav: control,
                    customDirectionNav: "<span><b></b></span>",
                    directionNav: directionNav,
                    prevText: "<span class='ion-chevron-left'></span>",
                    nextText: "<span class='ion-chevron-right'></span>",
                    maxItems: 1,
                    slideshowSpeed: 4000,
                    animationSpeed: 500,
                    pauseOnHover: false,
                    easing: 'easeOutQuart',
                    start: function () {
                        mkdf.modules.common.mkdfInitParallax();
                        mkdfAnimatePSC();
                    },
                    after: function () {
                        mkdfAnimatePSC();
                    }
                });

                function mkdfAnimatePSC() {
                    thisSliderHolder.find('.flex-active-slide').addClass('mkdf-appeared');
                    thisSliderHolder.find(':not(.flex-active-slide)').removeClass('mkdf-appeared');
                }
            });
        }
    }

    /*
     **  Init with thumbnails slider
     */
    function mkdfPostWithThumbnailSlider() {

        var withThumbnailSlider = $('.mkdf-pswt-holder');

        if (withThumbnailSlider.length) {
            withThumbnailSlider.each(function () {
                var thisSliderHolder = $(this),
                    control = true,
                    directionNav = true,
                    thisSlider = thisSliderHolder.find('.mkdf-pswt-slider'),
                    thisSliderArrows;

                thisSlider.flexslider({
                    selector: ".mkdf-pswt-slides > .mkdf-pswt-slide",
                    animation: "slide",
                    controlNav: control,
                    animationLoop: true,
                    directionNav: directionNav,
                    maxItems: 1,
                    easeing: 'easeInOutSine',
                    slideshowSpeed: 4000,
                    animationSpeed: 800,
                    pauseOnHover: false,
                    prevText: "<span class='ion-chevron-left'></span>",
                    nextText: "<span class='ion-chevron-right'></span>",
                    manualControls: '.mkdf-pswt-slide-thumb',
                    start: function () {
                        mkdf.modules.common.mkdfInitParallax();
                        thisSliderArrows = thisSlider.find('.flex-direction-nav li');
                        thisSliderHolder.animate({opacity: 1}, 300, function () {
                            thisSliderHolder.find('.mkdf-pswt-slides-thumb').css('opacity', 1);
                        });
                        mkdfAddPositionForNavigation(thisSliderHolder);
                        mkdfAnimatePSWT();
                    },
                    after: function () {
                        mkdfAnimatePSWT();
                    }
                });

                function mkdfAnimatePSWT() {
                    thisSliderHolder.find('.flex-active-slide').addClass('mkdf-appeared');
                    thisSliderHolder.find(':not(.flex-active-slide)').removeClass('mkdf-appeared');
                }

            });
        }
    }


    /*
     **  Add position for navigation arrows witch depends of thumb size
     */
    function mkdfAddPositionForNavigation(thisSliderHolder) {

        var thumbnailHeight;

        if (thisSliderHolder.find('.mkdf-pswt-slide').length && thisSliderHolder.find('.mkdf-pswt-slides-thumb').length) {
            thumbnailHeight = thisSliderHolder.find('.mkdf-pswt-slides-thumb').height();
            thisSliderHolder.find('.flex-direction-nav > li').css('margin-top', thumbnailHeight / -2 + 'px');
        }
    }


    /*
     **  Init post carousel
     */
    function mkdfPostCarousel() {


        var carousels = $('.mkdf-pcs-holder');

        if (carousels.length) {
            carousels.each(function () {
                var thisCarouselHolder = $(this),
                    thisCarousel = thisCarouselHolder.find('.mkdf-bnl-inner'),
                    slidesToShow = mkdfCarouselNumberOfItems(thisCarouselHolder),
                    directionNav = thisCarouselHolder.data('display_navigation') == 'yes';

                thisCarousel.on('init', function (event, slick) {
                    thisCarousel.animate({opacity: 1}, 200);
                    mkdf.modules.common.mkdfInitParallax();
                });

                thisCarousel.slick({
                    arrows: directionNav,
                    prevArrow: "<span class='ion-chevron-left'></span>",
                    nextArrow: "<span class='ion-chevron-right'></span>",
                    autoplay: true,
                    autoplaySpeed: 4000,
                    infinite: true,
                    speed: 1100,
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    responsive: [
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
            });
        }
    }

    /*
     * Calculate number of elements for carousel
     */

    function mkdfCarouselNumberOfItems(carousel) {

        var maxItems = 2;

        if (carousel.hasClass('three-posts')) {
            maxItems = 3;
        }
        else if (carousel.hasClass('four-posts')) {
            maxItems = 4;
        }

        if (mkdf.windowWidth < 1025) {
            maxItems = 2;
        }

        return maxItems;
    }

    /*
     * Resizing carousel
     */

    function mkdfCarouselResize() {

        var carousels = $('.mkdf-pc-holder');

        if (carousels.length) {
            carousels.each(function () {
                var thisCarouselHolder = $(this),
                    thisCarousel = thisCarouselHolder.children('.mkdf-bnl-outer');

                var items = mkdfCarouselNumberOfItems(thisCarouselHolder);

                thisCarousel.data('flexslider').vars.minItems = items;
                thisCarousel.data('flexslider').vars.maxItems = items;
            });
        }
    }

    /*
     **  Init post carousel swipe
     */
    function mkdfPostCarouselSwipe() {

        var swipeCarousels = $('.mkdf-pcs-swipe-holder');

        if (swipeCarousels.length) {
            swipeCarousels.each(function () {
                var thisSwipeCarousel = $(this),
                    thisSwipe = thisSwipeCarousel.children('.mkdf-bnl-outer'),
                    slidesToShow = mkdfCarouselNumberOfItems(thisSwipeCarousel),
                    directionNav = thisSwipeCarousel.data('display_navigation') == 'yes';


                thisSwipe.on('init', function (event, slick) {
                    thisSwipe.animate({opacity: 1}, 200);
                    mkdf.modules.common.mkdfInitParallax();
                });

                thisSwipe.slick({
                    arrows: directionNav,
                    prevArrow: "<span class='ion-chevron-left'></span>",
                    nextArrow: "<span class='ion-chevron-right'></span>",
                    autoplay: true,
                    autoplaySpeed: 2500,
                    infinite: true,
                    pauseOnHover: false,
                    speed: 1100,
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    responsive: [
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


            });
        }
    }

    /*
     **  Init sticky sidebar widget
     */
    function mkdfInitStickyWidget() {

        var stickyHeader = $('.mkd-sticky-header'),
            mobileHeader = $('.mkd-mobile-header'),
            stickyWidgets = $('.mkdf-widget-sticky-sidebar');
        if (stickyWidgets.length && mkdf.windowWidth > 1024) {

            stickyWidgets.each(function () {
                var widget = $(this),
                    parent = '.mkdf-full-section-inner, .mkdf-section-inner, .mkdf-two-columns-75-25, .mkdf-two-columns-25-75, .mkdf-two-columns-66-33, .mkdf-two-columns-33-66',
                    stickyHeight = 0,
                    widgetOffset = widget.offset().top;


                if (widget.parent('.mkdf-sidebar').length) {
                    var sidebar = widget.parents('.mkdf-sidebar');
                } else if (widget.parents('.wpb_widgetised_column').length) {
                    var sidebar = widget.parents('.wpb_widgetised_column');
                    widget.closest('.wpb_column').css('position', 'static');
                }

                var sidebarOffset = sidebar.offset().top;
                if (mkdf.body.hasClass('mkdf-sticky-header-on-scroll-down-up')) {
                    stickyHeight = mkdfGlobalVars.vars.mkdfStickyHeaderHeight;
                } else {
                    stickyHeight = 0;
                }
                var offset = -(widgetOffset - sidebarOffset - stickyHeight - 10); //10 is to push down from browser top edge


                sidebar.stick_in_parent({
                    parent: parent,
                    sticky_class: 'mkdf-sticky-sidebar',
                    inner_scrolling: false,
                    offset_top: offset,
                }).on("sticky_kit:bottom", function () { //check if sticky sidebar have hit the bottom and use that class for pull it down when sticky header appears
                    sidebar.addClass('mkdf-sticky-sidebar-on-bottom');
                }).on("sticky_kit:unbottom", function () {
                    sidebar.removeClass('mkdf-sticky-sidebar-on-bottom');
                });

                $(window).scroll(function () {
                    if (mkdf.windowWidth >= 1024) {
                        if (stickyHeader.hasClass('header-appear') && mkdf.body.hasClass('mkdf-sticky-header-on-scroll-up') && sidebar.hasClass('mkdf-sticky-sidebar') && !sidebar.hasClass('mkdf-sticky-sidebar-on-bottom')) {
                            sidebar.css('-webkit-transform', 'translateY(' + mkdfGlobalVars.vars.mkdfStickyHeaderHeight + 'px)');
                            sidebar.css('transform', 'translateY(' + mkdfGlobalVars.vars.mkdfStickyHeaderHeight + 'px)');
                        } else {
                            sidebar.css('-webkit-transform', 'translateY(0px)');
                            sidebar.css('transform', 'translateY(0px)');
                        }
                    } else {
                        if (mobileHeader.hasClass('mobile-header-appear') && sidebar.hasClass('mkdf-sticky-sidebar') && !sidebar.hasClass('mkdf-sticky-sidebar-on-bottom')) {
                            sidebar.css('-webkit-transform', 'translateY(' + mkdfGlobalVars.vars.mkdfMobileHeaderHeight + 'px)');
                            sidebar.css('transform', 'translateY(' + mkdfGlobalVars.vars.mkdfMobileHeaderHeight + 'px)');
                        } else {
                            sidebar.css('-webkit-transform', 'translateY(0px)');
                            sidebar.css('transform', 'translateY(0px)');
                        }
                    }
                });

            });
        }

    }

    /**
     * Object that represents post pagination
     * @returns {{init: Function}} function that initializes post pagination functionality
     */
    var mkdfPostPagination = mkdf.modules.shortcodes.mkdfPostPagination = function () {

        // get all post with load more
        var blogBlockWithPaginationLoadMore = $('.mkdf-post-pag-load-more');
        var blogBlockWithPaginationPrevNext = $('.mkdf-post-pag-np-horizontal');
        var blogBlockWithPaginationInfinitive = $('.mkdf-post-pag-infinite');

        $('.mkdf-post-item').addClass('mkdf-active-post-page');

        /**
         * Function that triggers load more functionality
         */
        var mkdfPostLoadMoreEvent = function (thisBlock) {
            var thisBlockShowLoadMoreHolder = thisBlock.children('.mkdf-bnl-navigation-holder'),
                thisBlockShowLoadMore = thisBlockShowLoadMoreHolder.children('.mkdf-bnl-load-more'),
                thisBlockShowLoadMoreLoading = thisBlockShowLoadMoreHolder.children('.mkdf-bnl-load-more-loading'),
                thisBlockShowLoadMoreButton = thisBlockShowLoadMore.children(),
                blockData = mkdfPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            thisBlockShowLoadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                thisBlockShowLoadMore.hide();
                thisBlockShowLoadMoreLoading.css('display', 'inline-block');

                blockData.paged = blockData.next_page;

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if (response.showNextPage === true) {
                            blockData.next_page++;


                            if (isBlockItem) {
                                blogBlockOuter.append(response.html);
                            }
                            else {
                                blogBlockOuter.children('.mkdf-bnl-inner').append(response.html);
                            } // Append the new content


                            thisBlock.waitForImages(function () {
                                postAjaxCallback(thisBlock);
                            });

                            if (blockData.max_pages > (blockData.paged)) {
                                thisBlockShowLoadMore.show();
                                thisBlockShowLoadMoreLoading.hide();
                            }
                            else {
                                thisBlockShowLoadMoreHolder.hide();
                            }
                        }
                    }
                });
            });
        };

        /**
         * Function that triggers next prev functionality
         */
        var mkdfPostNextPrevEvent = function (thisBlock) {
            var thisBlockPostPrevNextButton = thisBlock.children('.mkdf-bnl-navigation-holder').find('a'),
                thisBlockSliderPaging = thisBlock.find('.mkdf-bnl-slider-paging'),
                thisBlockAjaxPreloader = thisBlock.children('.mkdf-post-ajax-preloader'),
                blockData = mkdfPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            if (thisBlock.hasClass('mkdf-post-pag-np-horizontal')) {
                setActivePaging(thisBlockSliderPaging, blockData.paged);
            }

            thisBlockPostPrevNextButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                blockData.paged = getClickedButton($(this), blockData);
                if (blockData.paged === false) {
                    return;
                }

                if (!setAjaxLoading(thisBlock, true)) {
                    return;
                }

                if (thisBlock.hasClass('mkdf-post-pag-np-horizontal')) {
                    setActivePaging(thisBlockSliderPaging, blockData.paged);
                }

                thisBlockAjaxPreloader.show();

                if (!isBlockItem) {
                    blogBlockOuter.children('.mkdf-bnl-inner').find('.mkdf-post-item').addClass('mkdf-removed-post-page');
                }

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if (response.showNextPage === true) {
                            blockData.next_page = blockData.paged + 1;
                            blockData.prev_page = blockData.paged - 1;


                            if (isBlockItem) {
                                blogBlockOuter.html(response.html);
                            }
                            else {
                                var postItems = thisBlock.hasClass('mkdf-pl-eight-holder') ? $(response.html).find('.mkdf-post-item') : response.html;
                                blogBlockOuter.children('.mkdf-bnl-inner').find('.mkdf-post-item:last').after(postItems);
                                thisBlock.find('.mkdf-removed-post-page').remove();
                            }// Append the new content

                            thisBlock.waitForImages(function () {

                                thisBlock.css('min-height', '');
                                thisBlockAjaxPreloader.hide();
                                setAjaxLoading(thisBlock, false);
                                postAjaxCallback(thisBlock);

                            });
                        }
                    }
                });
            });

            function setAjaxLoading(thisBlock, start) {
                if (start) {
                    if (!thisBlock.hasClass('mkdf-post-pag-active')) {
                        thisBlock.css('min-height', thisBlock.height());
                        thisBlock.addClass('mkdf-post-pag-active');
                        return true;
                    }
                    else {
                        return false;
                    }
                }

                else if (!start && thisBlock.hasClass('mkdf-post-pag-active')) {
                    thisBlock.removeClass('mkdf-post-pag-active');
                }

                return true;
            }

            function getClickedButton(thisButton, blockData) {
                if (thisButton.hasClass('mkdf-bnl-nav-next') && blockData.next_page <= blockData.max_pages) {
                    return blockData.paged = blockData.next_page;
                }
                else if (thisButton.hasClass('mkdf-bnl-nav-prev') && blockData.prev_page > 0) {
                    return blockData.paged = blockData.prev_page;
                }
                else if (thisButton.hasClass('mkdf-paging-button-holder')) {
                    return blockData.paged = thisBlockSliderPaging.children('a').index(thisButton) + 1;
                }
                else {
                    return false;
                }
            }

            function setActivePaging(pagingHolder, number) {
                pagingHolder.children('a').removeClass('mkdf-bnl-paging-active');
                pagingHolder.children('a:nth-child(' + number + ')').addClass('mkdf-bnl-paging-active');
            }
        };

        /**
         * Function that triggers load more functionality
         */
        var mkdfPostInfinitiveEvent = function (thisBlock) {
            var blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                blockData = mkdfPostData(thisBlock),
                isBlockItem = isBlock(thisBlock);

            mkdf.window.scroll(function () {

                if (!thisBlock.hasClass('mkdf-ajax-infinite-started') && (blockData.next_page <= blockData.max_pages) && ((mkdf.window.height() + mkdf.window.scrollTop()) > (blogBlockOuter.offset().top + blogBlockOuter.height()))) {

                    var preloaderHTML = '<div class="mkdf-inf-scroll-preloader mkdf-post-ajax-preloader"><div class="mkdf-cubes"><div class="mkdf-cube1"></div><div class="mkdf-cube2"></div></div></div>';

                    thisBlock.after(preloaderHTML);
                    thisBlock.addClass('mkdf-ajax-infinite-started');
                    blockData.paged = blockData.next_page;

                    setTimeout(function () {
                        $.ajax({
                            type: 'POST',
                            data: blockData,
                            url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                            success: function (data) {
                                var response = $.parseJSON(data);
                                if (response.showNextPage === true) {
                                    blockData.next_page++;
                                    if (isBlockItem) {
                                        blogBlockOuter.append(response.html);
                                    }
                                    else {
                                        blogBlockOuter.children('.mkdf-bnl-inner').append(response.html);
                                    } // Append the new content


                                    thisBlock.waitForImages(function () {
                                        postAjaxCallback(thisBlock);
                                    });

                                    thisBlock.removeClass('mkdf-ajax-infinite-started');
                                    $('.mkdf-inf-scroll-preloader').remove();
                                }
                            }
                        });
                    }, 300); //show inf animation
                }
            });
        };

        function isBlock($thisblock) {
            return ($thisblock.hasClass("mkdf-pb-one-holder") || $thisblock.hasClass("mkdf-pb-two-holder"));
        }

        function postAjaxCallback(thisBlock) {

            thisBlock.find('.mkdf-post-item').addClass('mkdf-active-post-page');

            if (thisBlock.parent().hasClass('widget')) {
                mkdf.modules.header.mkdfDropDownMenu();
                thisBlock.parent().parent().css('height', '');
            }
            mkdfBlockReveal();
        }

        return {
            init: function () {
                if (blogBlockWithPaginationLoadMore.length) {
                    blogBlockWithPaginationLoadMore.each(function () {
                        mkdfPostLoadMoreEvent($(this));
                    });
                }
                if (blogBlockWithPaginationPrevNext.length) {
                    blogBlockWithPaginationPrevNext.each(function () {
                        mkdfPostNextPrevEvent($(this));
                    });
                }
                if (blogBlockWithPaginationInfinitive.length) {
                    blogBlockWithPaginationInfinitive.each(function () {
                        mkdfPostInfinitiveEvent($(this));
                    });
                }
            }
        };
    };

    /*
     * Init pagination - load more
     * @returns object with data parameters
     */

    function mkdfPostData(container) {

        var myObj = container.data();
        myObj.action = 'hashmag_mikado_list_ajax';

        return myObj;
    }

    /**
     * Object that represents post layout tabs widget
     * @returns {{init: Function}} function that initializes post layout tabs widget functionality
     */
    var mkdfPostLayoutTabWidget = mkdf.modules.shortcodes.mkdfPostLayoutTabWidget = function () {

        var layoutTabsWidget = $('.mkdf-plw-tabs');


        var mkdfPostLayoutTabWidgetEvent = function (thisWidget) {
            var plwTabsHolder = thisWidget.find('.mkdf-plw-tabs-tabs-holder');
            var plwTabsContent = thisWidget.find('.mkdf-plw-tabs-content-holder');
            var currentItemPosition = plwTabsHolder.children('.mkdf-plw-tabs-tab:first-child').index() + 1; // +1 is because index start from 0 and list from 1

            setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);

            plwTabsHolder.find('a').mouseover(function (e) {
                e.preventDefault();

                currentItemPosition = $(this).parents('.mkdf-plw-tabs-tab').index() + 1; // +1 is because index start from 0 and list from 1

                setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);
            });
        };

        function setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition) {
            var activeItemClass = 'mkdf-plw-tabs-active-item';

            plwTabsContent.children('.mkdf-plw-tabs-content').removeClass(activeItemClass);
            plwTabsHolder.children('.mkdf-plw-tabs-tab').removeClass(activeItemClass);

            var height = plwTabsContent.children('.mkdf-plw-tabs-content:nth-child(' + currentItemPosition + ')').addClass(activeItemClass).height();
            plwTabsContent.css('min-height', height + 'px');
            plwTabsHolder.children('.mkdf-plw-tabs-tab:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
        }

        return {
            init: function () {
                if (layoutTabsWidget.length) {
                    layoutTabsWidget.each(function () {
                        mkdfPostLayoutTabWidgetEvent($(this));
                    });
                }
            },

        };
    };

    /*
     * Recent comments hover
     */
    function mkdfRecentCommentsHover() {
        var link = $('footer .mkdf-rpc-link');
        if (link.length) {
            link.each(function () {
                var thisLink = $(this),
                    commentsNumber = thisLink.closest('li').find('.mkdf-rpc-number-holder');
                thisLink.mouseenter(function () {
                    commentsNumber.addClass('mkdf-hovered');
                });
                thisLink.mouseleave(function () {
                    commentsNumber.removeClass('mkdf-hovered');
                });

            });
        }
    }


    /*
     **	Show Google Map
     */
    function mkdfShowGoogleMap() {

        if ($('.mkdf-google-map').length) {
            $('.mkdf-google-map').each(function () {

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
                var holderId = "mkdf-map-" + uniqueId;

                mkdfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses);
            });
        }

    }

    /*
     **	Init Google Map
     */
    function mkdfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data) {

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
            googleMapStyleId = 'mkdf-style';
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
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkdf-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function mkdfInitializeGoogleAddress(data, pin, map, geocoder) {
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

    /*
     * Post Template Animate Excerpt
     */
    function mkdfPostTemplateAnimateExcerpt() {
        var ptItems = $('body:not(.single) .mkdf-pt-five-item, .mkdf-pb-four-holder .mkdf-pt-seven-item');
        if (ptItems.length) {
            ptItems.each(function () {
                var ptItem = $(this),
                    excerpt = ptItem.find('div[class$="-excerpt"]'),
                    excerptHeight = excerpt.outerHeight();

                excerpt.css('visibility', 'visible');

                $(window).resize(function () {
                    excerptHeight = excerpt.find('p').outerHeight(); //recalc height
                });

                excerpt.css({'height': 0});

                ptItem.mouseenter(function () {
                    excerpt.css({'height': excerptHeight});
                });
                ptItem.mouseleave(function () {
                    excerpt.css({'height': 0});
                });
            });
        }
    }

})(jQuery);
(function ($) {
    'use strict';

    var woocommerce = {};
    mkdf.modules.woocommerce = woocommerce;

    woocommerce.mkdfInitQuantityButtons = mkdfInitQuantityButtons;
    woocommerce.mkdfInitSelect2 = mkdfInitSelect2;
    woocommerce.mkdfRemoveValue = mkdfRemoveValue;

    woocommerce.mkdfOnDocumentReady = mkdfOnDocumentReady;
    woocommerce.mkdfOnWindowLoad = mkdfOnWindowLoad;
    woocommerce.mkdfOnWindowResize = mkdfOnWindowResize;
    woocommerce.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitQuantityButtons();
        mkdfInitSelect2();
        mkdfRemoveValue();
    }

    /* 
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {

    }

    /* 
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {

    }

    /* 
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {

    }


    function mkdfInitQuantityButtons() {

        $(document).on( 'click', '.mkdf-quantity-minus, .mkdf-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.mkdf-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('mkdf-quantity-minus')) {
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
            inputField.trigger( 'change' );
        });

    }

    function mkdfInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length || $('#calc_shipping_country').length) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();

        }

    }

    function mkdfRemoveValue() {

        if ($('.woocommerce-page .mkdf-sidebar').length) {
            $('.widget .woocommerce-product-search input[type="submit"]').val('');
        }
    }


})(jQuery);
(function($) {
    "use strict";

    window.eltd = {};
    eltd.modules = {};

    eltd.scroll = 0;
    eltd.window = $(window);
    eltd.document = $(document);
    eltd.windowWidth = $(window).width();
    eltd.windowHeight = $(window).height();
    eltd.body = $('body');
    eltd.html = $('html, body');
    eltd.htmlEl = $('html');
    eltd.menuDropdownHeightSet = false;
    eltd.defaultHeaderStyle = '';
    eltd.minVideoWidth = 1500;
    eltd.videoWidthOriginal = 1280;
    eltd.videoHeightOriginal = 720;
    eltd.videoRatio = 1280/720;

    eltd.eltdOnDocumentReady = eltdOnDocumentReady;
    eltd.eltdOnWindowLoad = eltdOnWindowLoad;
    eltd.eltdOnWindowResize = eltdOnWindowResize;
    eltd.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltd.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(eltd.body.hasClass('eltd-dark-header')){ eltd.defaultHeaderStyle = 'eltd-dark-header';}
        if(eltd.body.hasClass('eltd-light-header')){ eltd.defaultHeaderStyle = 'eltd-light-header';}

    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltd.windowWidth = $(window).width();
        eltd.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
        eltd.scroll = $(window).scrollTop();
    }



    //set boxed layout width variable for various calculations

    switch(true){
        case eltd.body.hasClass('eltd-grid-1480'):
            eltd.boxedLayoutWidth = 1530;
            break;
        case eltd.body.hasClass('eltd-grid-1300'):
            eltd.boxedLayoutWidth = 1350;
            break;
        case eltd.body.hasClass('eltd-grid-1200'):
            eltd.boxedLayoutWidth = 1250;
            break;
        case eltd.body.hasClass('eltd-grid-1000'):
            eltd.boxedLayoutWidth = 1050;
            break;
        case eltd.body.hasClass('eltd-grid-800'):
            eltd.boxedLayoutWidth = 850;
            break;
        default :
            eltd.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    eltd.modules.common = common;

    common.eltdIsTouchDevice = eltdIsTouchDevice;
    common.eltdDisableSmoothScrollForMac = eltdDisableSmoothScrollForMac;
    common.eltdFluidVideo = eltdFluidVideo;
    common.eltdPreloadBackgrounds = eltdPreloadBackgrounds;
    common.eltdPrettyPhoto = eltdPrettyPhoto;
    common.eltdCheckHeaderStyleOnScroll = eltdCheckHeaderStyleOnScroll;
    common.eltdInitParallax = eltdInitParallax;
    //common.eltdSmoothScroll = eltdSmoothScroll;
    common.eltdEnableScroll = eltdEnableScroll;
    common.eltdDisableScroll = eltdDisableScroll;
    common.eltdWheel = eltdWheel;
    common.eltdKeydown = eltdKeydown;
    common.eltdPreventDefaultValue = eltdPreventDefaultValue;
    common.eltdOwlSlider = eltdOwlSlider;
    common.eltdInitSelfHostedVideoPlayer = eltdInitSelfHostedVideoPlayer;
    common.eltdSelfHostedVideoSize = eltdSelfHostedVideoSize;
    common.eltdInitBackToTop = eltdInitBackToTop;
    common.eltdBackButtonShowHide = eltdBackButtonShowHide;
    common.eltdSmoothTransition = eltdSmoothTransition;

    common.eltdOnDocumentReady = eltdOnDocumentReady;
    common.eltdOnWindowLoad = eltdOnWindowLoad;
    common.eltdOnWindowResize = eltdOnWindowResize;
    common.eltdOnWindowScroll = eltdOnWindowScroll;
    common.eltdInitAjaxComments = eltdInitAjaxComments;
    common.eltdInitSearchWidget = eltdInitSearchWidget;
    common.eltdInitInstagramCarousel = eltdInitInstagramCarousel;
    common.eltdInitAnimations = eltdInitAnimations;
    common.eltdLandingItemsHeight = eltdLandingItemsHeight;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdIsTouchDevice();
        eltdDisableSmoothScrollForMac();
        eltdFluidVideo();
        eltdPreloadBackgrounds();
        eltdPrettyPhoto();
        eltdInitElementsAnimations();
        eltdInitAnchor().init();
        eltdInitVideoBackground();
        eltdInitVideoBackgroundSize();
        eltdSetContentBottomMargin();
        //eltdSmoothScroll();
        setTimeout(function(){
            eltdOwlSlider();
        },200);        
        eltdInitSelfHostedVideoPlayer();
        eltdSelfHostedVideoSize();
        eltdInitBackToTop();
        eltdBackButtonShowHide();
        eltdInitAjaxComments();
        eltdInitStickyWidget();
        eltdInitSearchWidget();
        eltdInitInstagramCarousel();
        eltdInitAnimations();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
        eltdCheckHeaderStyleOnScroll(); //called on load since all content needs to be loaded in order to calculate row's position right
        eltdInitParallax();
        eltdSmoothTransition();
        eltdLandingItemsHeight();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdInitVideoBackgroundSize();
        eltdSelfHostedVideoSize();
        eltdInitStickyWidget();
        eltdLandingItemsHeight();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
    }

    /*
     ** Disable shortcodes animation on appear for touch devices
     */
    function eltdIsTouchDevice() {
        if(Modernizr.touch && !eltd.body.hasClass('eltd-no-animations-on-touch')) {
            eltd.body.addClass('eltd-no-animations-on-touch');
        }
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function eltdDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && eltd.body.hasClass('eltd-smooth-scroll')) {
            eltd.body.removeClass('eltd-smooth-scroll');
        }
    }

	function eltdFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    /**
     * Init Owl Carousel
     */
    function eltdOwlSlider() {

        var sliders = $('.eltd-owl-slider');

        if (sliders.length) {
            sliders.each(function(){

                var slider = $(this);
                
                if(slider.hasClass('owl-carousel')){
                    
                    slider.data('owlCarousel').reinit({
                        singleItem: true,
                        transitionStyle: 'fadeUp',
                        navigation: true,
                        loop: false,
                        navRewind:false,
                        autoHeight: true,
                        pagination: false,
                        navigationText: [
                            '<div class="eltd-prev-icon-holder"><div class="eltd-prev-icon-triangle"></div><span class="arrow_carrot-left"></span></div>',
                            '<div class="eltd-next-icon-holder"><div class="eltd-next-icon-triangle"></div><span class="arrow_carrot-right"></span></div>'
                        ]
                      });
                  
                }else{
                    slider.owlCarousel({
                        singleItem: true,
                        transitionStyle: 'fadeUp',
                        loop: false,
                        navRewind:false,
                        navigation: true,
                        autoHeight: true,
                        pagination: false,
                        navigationText: [
                            '<div class="eltd-prev-icon-holder"><div class="eltd-prev-icon-triangle"></div><span class="arrow_carrot-left"></span></div>',
                            '<div class="eltd-next-icon-holder"><div class="eltd-next-icon-triangle"></div><span class="arrow_carrot-right"></span></div>'
                        ]
                    });
                }
                
                

            });
        }

    }   


    /*
     *	Preload background images for elements that have 'eltd-preload-background' class
     */
    function eltdPreloadBackgrounds(){

        $(".eltd-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('eltd-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('eltd-preload-background'); }); //make sure that eltd-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function eltdPrettyPhoto() {
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
     *	Check header style on scroll, depending on row settings
     */
    function eltdCheckHeaderStyleOnScroll(){

        if($('[data-eltd_header_style]').length > 0 && eltd.body.hasClass('eltd-header-style-on-scroll')) {

            var waypointSelectors = $('.eltd-full-width-inner > .wpb_row.eltd-section, .eltd-full-width-inner > .eltd-parallax-section-holder, .eltd-container-inner > .wpb_row.eltd-section, .eltd-container-inner > .eltd-parallax-section-holder, .eltd-portfolio-single > .wpb_row.eltd-section');
            var changeStyle = function(element){
                (element.data("eltd_header_style") !== undefined) ? eltd.body.removeClass('eltd-dark-header eltd-light-header').addClass(element.data("eltd_header_style")) : eltd.body.removeClass('eltd-dark-header eltd-light-header').addClass(''+eltd.defaultHeaderStyle);
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
    function eltdInitElementsAnimations(){

        var touchClass = $('.eltd-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.eltd-grow-in, .eltd-fade-in-down, .eltd-element-from-fade, .eltd-element-from-left, .eltd-element-from-right, .eltd-element-from-top, .eltd-element-from-bottom, .eltd-flip-in, .eltd-x-rotate, .eltd-z-rotate, .eltd-y-translate, .eltd-fade-in, .eltd-fade-in-left-x-rotate'),
            clasess,
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
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }

    }


/*
 **	Sections with parallax background image
 */
function eltdInitParallax(){

    if($('.eltd-parallax-section-holder').length){
        $('.eltd-parallax-section-holder').each(function() {

            var parallaxElement = $(this);
            if(parallaxElement.hasClass('eltd-full-screen-height-parallax')){
                parallaxElement.height(eltd.windowHeight);
                parallaxElement.find('.eltd-parallax-content-outer').css('padding',0);
            }
            var speed = parallaxElement.data('eltd-parallax-speed')*0.4;
            parallaxElement.parallax("50%", speed);
        });
    }
}

/*
 **	Anchor functionality
 */
var eltdInitAnchor = eltd.modules.common.eltdInitAnchor = function() {

    /**
     * Set active state on clicked anchor
     * @param anchor, clicked anchor
     */
    var setActiveState = function(anchor){

        $('.eltd-main-menu .eltd-active-item, .eltd-mobile-nav .eltd-active-item, .eltd-vertical-menu .eltd-active-item, .eltd-fullscreen-menu .eltd-active-item').removeClass('eltd-active-item');
        anchor.parent().addClass('eltd-active-item');

        $('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-vertical-menu a, .eltd-fullscreen-menu a').removeClass('current');
        anchor.addClass('current');
    };

    /**
     * Check anchor active state on scroll
     */
    var checkActiveStateOnScroll = function(){

        $('[data-eltd-anchor]').waypoint( function(direction) {
            if(direction === 'down') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("eltd-anchor")+"']"));
            }
        }, { offset: '50%' });

        $('[data-eltd-anchor]').waypoint( function(direction) {
            if(direction === 'up') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("eltd-anchor")+"']"));
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

        if(hash !== "" && $('[data-eltd-anchor="'+hash+'"]').length > 0){
            //triggers click which is handled in 'anchorClick' function
            $("a[href='"+window.location.href.split('#')[0]+"#"+hash+"'").trigger( "click" );
        }
    };

    /**
     * Calculate header height to be substract from scroll amount
     * @param anchoredElementOffset, anchorded element offest
     */
    var headerHeihtToSubtract = function(anchoredElementOffset){

        if(eltd.modules.header.behaviour == 'eltd-sticky-header-on-scroll-down-up') {
            (anchoredElementOffset > eltd.modules.header.stickyAppearAmount) ? eltd.modules.header.isStickyVisible = true : eltd.modules.header.isStickyVisible = false;
        }

        if(eltd.modules.header.behaviour == 'eltd-sticky-header-on-scroll-up') {
            (anchoredElementOffset > eltd.scroll) ? eltd.modules.header.isStickyVisible = false : '';
        }

        var headerHeight = eltd.modules.header.isStickyVisible ? eltdGlobalVars.vars.eltdStickyHeaderTransparencyHeight : eltdPerPageVars.vars.eltdHeaderTransparencyHeight;

        return headerHeight;
    };

    /**
     * Handle anchor click
     */
    var anchorClick = function() {
        eltd.document.on("click", ".eltd-main-menu a, .eltd-vertical-menu a, .eltd-fullscreen-menu a, .eltd-btn, .eltd-anchor, .eltd-mobile-nav a", function() {
            var scrollAmount;
            var anchor = $(this);
            var hash = anchor.prop("hash").split('#')[1];

            if(hash !== "" && $('[data-eltd-anchor="' + hash + '"]').length > 0 /*&& anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]*/) {

                var anchoredElementOffset = $('[data-eltd-anchor="' + hash + '"]').offset().top;
                scrollAmount = $('[data-eltd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                setActiveState(anchor);

                eltd.html.stop().animate({
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
            if($('[data-eltd-anchor]').length) {
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
function eltdInitVideoBackground(){

    $('.eltd-section .eltd-video-wrap .eltd-video').mediaelementplayer({
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
        eltdInitVideoBackgroundSize();
        $('.eltd-section .eltd-mobile-video-image').show();
        $('.eltd-section .eltd-video-wrap').remove();
    }
}

    /*
     **	Calculate video background size
     */
    function eltdInitVideoBackgroundSize(){

        $('.eltd-section .eltd-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.eltd-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.eltd-section').outerHeight();
            eltd.minVideoWidth = eltd.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / eltd.videoWidthOriginal;
            var scaleV = sectionHeight / eltd.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * eltd.videoWidthOriginal < eltd.minVideoWidth) {scale = eltd.minVideoWidth / eltd.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * eltd.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * eltd.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function eltdSetContentBottomMargin(){
        var uncoverFooter = $('.eltd-footer-uncover');

        if(uncoverFooter.length){
            $('.eltd-content').css('margin-bottom', $('.eltd-footer-inner').height());
        }
    }

	/*
	** Initiate Smooth Scroll
	*/
	//function eltdSmoothScroll(){
	//
	//	if(eltd.body.hasClass('eltd-smooth-scroll')){
	//
	//		var scrollTime = 0.4;			//Scroll time
	//		var scrollDistance = 300;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll
	//
	//		var mobile_ie = -1 !== navigator.userAgent.indexOf("IEMobile");
	//
	//		var smoothScrollListener = function(event){
	//			event.preventDefault();
	//
	//			var delta = event.wheelDelta / 120 || -event.detail / 3;
	//			var scrollTop = eltd.window.scrollTop();
	//			var finalScroll = scrollTop - parseInt(delta * scrollDistance);
	//
	//			TweenLite.to(eltd.window, scrollTime, {
	//				scrollTo: {
	//					y: finalScroll, autoKill: !0
	//				},
	//				ease: Power1.easeOut,
	//				autoKill: !0,
	//				overwrite: 5
	//			});
	//		};
	//
	//		if (!$('html').hasClass('touch') && !mobile_ie) {
	//			if (window.addEventListener) {
	//				window.addEventListener('mousewheel', smoothScrollListener, false);
	//				window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
	//			}
	//		}
	//	}
	//}

    function eltdDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', eltdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = eltdWheel;
        document.onkeydown = eltdKeydown;

        if(eltd.body.hasClass('eltd-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function eltdEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', eltdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(eltd.body.hasClass('eltd-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function eltdWheel(e) {
        eltdPreventDefaultValue(e);
    }

    function eltdKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                eltdPreventDefaultValue(e);
                return;
            }
        }
    }

    function eltdPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function eltdInitSelfHostedVideoPlayer() {

        var players = $('.eltd-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function eltdSelfHostedVideoSize(){

		$('.eltd-self-hosted-video-holder .eltd-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.eltd-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / eltd.videoRatio;

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

    function eltdToTopButton(a) {

        var b = $("#eltd-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function eltdBackButtonShowHide(){
        eltd.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { eltdToTopButton('off'); } else { eltdToTopButton('on'); }
        });
    }

    function eltdInitBackToTop(){
        var backToTopButton = $('#eltd-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            eltd.html.animate({scrollTop: 0}, eltd.window.scrollTop()/3, 'linear');
        });
    }

    function eltdSmoothTransition() {
        var loader = $('body > .eltd-smooth-transition-loader.mimic-ajax');
        if (loader.length) {
            loader.fadeOut(500);
            $(window).bind("pageshow", function(event) {
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
                    !a.hasClass('qodef-like') && //Not like link
                    (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                    (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                ) {
                    e.preventDefault();
                    loader.addClass('eltd-hide-spinner');
                    loader.fadeIn(500, function() {
                        window.location = a.attr('href');
                    });
                }
            });
        }
    }

    /**
     * Ajax comments functionality
     */
    function eltdInitAjaxComments() {

        /**
         * Submit comment
         */
        $('#commentform').submit(function(e){
            e.preventDefault();
            var commentForm = $(this),
                formData = commentForm.serialize(),
                commentParent = commentForm.find('#comment_parent').val();

            var data = {
                'action': 'flow_elated_ajax_add_comment',
                'commentData' : formData
            };

            $.ajax({
                url : ElatedAjaxUrl,
                data : data,
                dataType: 'json',
                type : 'POST',
                success : function( response ) {
                    if ( response.status == 'success' ) {
                        if ( commentForm.parents('.eltd-comment-form.comment-all').length == 0 ) {
                            commentForm.parents('#respond').first().fadeOut(300);
                        }
                        commentForm.find('#comment').val('');
                        setTimeout(function(){
                            layoutComments( commentParent, response.data );
                        }, 300);
                    } else {
                        layoutError( response.data, commentForm );
                    }
                }
            });

        });

        /**
         * Reply on comment
         */
        $(document).on( 'click', '.comment-reply-link', function(){
            //Remove form after submit reply
            if ( ! $('#respond').is(':visible') ) {
                var resp = $('#respond');
                resp.fadeIn(300);
                setTimeout(function() {
                    resizeExpandibleItem(resp);
                },10);
            }
            //Remove error notice
            if ( $('.eltd-comment-form-error').is(':visible') ) {
                $('.eltd-comment-form-error').remove();
            }
        });

        /**
         * Render comment HTML in comment list
         *
         * @param commentParent
         * @param commentData
         */
        var layoutComments = function( commentParent, commentData ) {

            var commentsHolder = $('.eltd-comments'),
                replyWrapperBefore = '<ul class="children">',
                replyWrapperAfter = '</ul>',
                listWrapperBefore = '<ul class="eltd-comment-list">',
                listWrapperAfter = '</ul>';


            if ( commentParent !== '0' ) {
                var parentInner = commentsHolder.find( '#comment-' + commentParent),
                    parent = parentInner.parents('.eltd-comment').first();
                if ( parent.next('.children').length ) {
                    parent.next('.children').append( commentData);
                } else {
                    parent.after( replyWrapperBefore + commentData + replyWrapperAfter );
                }
            } else {
                var commentsList = commentsHolder.children('.eltd-comment-list');
                if ( commentsList.length ) {
                    commentsList.append( commentData );
                } else {
                    commentsHolder.append( listWrapperBefore + commentData + listWrapperAfter );
                }
            }

            resizeExpandibleItem(commentsHolder);

        };

        /**
         * Reply on comment
         */

        var resizeExpandibleItem = function($target) {
            var exp_item = $target.closest('.eltd-blog-list-expandable-item');
            if (exp_item.length) {
                eltd.modules.blog.eltdExpandableTiles.adjust_height(exp_item);
            }
        };

        /**
         * Render error notice
         *
         * @param error
         * @param form
         */
        var layoutError = function( error, form ) {
            if ( form.parent().find('.eltd-comment-form-error').length ) {
                form.parent().find('.eltd-comment-form-error').remove();
            }
            form.before( '<div class="eltd-comment-form-error">' + error + '</div>' );
        };

    }

    function eltdInitStickyWidget() {

        var stickyHeader = $('.eltd-sticky-header'),
            mobileHeader = $('.eltd-mobile-header'),
            stickyWidgets = $('.eltd-widget-sticky-sidebar');
        if ( stickyWidgets.length && eltd.windowWidth > 768 ) {
            stickyWidgets.each(function(){
                var widget = $(this),
                    sidebar = widget.parent('.eltd-sidebar'),
                    parents = $('.eltd-two-columns-75-25, .eltd-two-columns-25-75, .eltd-two-columns-66-33, .eltd-two-columns-33-66');
                sidebar.stick_in_parent({
                    parent: parents,
                    sticky_class : 'eltd-sticky-sidebar',
                    inner_scrolling : false
                });

                if ( stickyHeader.length && eltd.windowWidth > 1024 ) {
                    $(window).scroll(function(){
                        if ( stickyHeader.hasClass( 'header-appear' ) ) {
                            sidebar.addClass('move-down');
                        } else {
                            sidebar.removeClass('move-down');
                        }
                    });
                } else if ( eltd.windowWidth < 1025 ) {
                    $(window).scroll(function(){
                        if ( mobileHeader.hasClass( 'mobile-header-appear' ) ) {
                            sidebar.addClass('mobile-move-down');
                        } else {
                            sidebar.removeClass('mobile-move-down');
                        }
                    });
                }

            });
        }

    };

    /**
     * Init Search Widget
     */
    function eltdInitSearchWidget() {

        var searchWidgets = $('.eltd-search-holder ');

        if ( searchWidgets.length ) {
            searchWidgets.each(function() {

                var searchWidget = $(this);
                var searchOpener = searchWidget.find('.eltd-search-opener'),
                    searchForm = searchWidget.find('form'),
                    searchInput = searchWidget.find('input');
                searchOpener.click(function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    if ( searchWidget.hasClass( 'eltd-search-open' ) ) {

                        if ( searchInput.val() !== '' ) {

                            //If expanding tiles grid, send ajax request
                            if(eltd.body.hasClass('page-template-blog-expanding-tiles')){
                                var input = searchInput.val(),
                                    blogHolder = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles');
                                blogHolder.data('search-value',input);
                                blogHolder.data('next-page',2);

                                var data = {
                                    'action': 'flow_elated_ajax_search',
                                    'searchParam' : input
                                };

                                $.ajax({
                                    url : ElatedAjaxUrl,
                                    data : data,
                                    type : 'POST',
                                    success : function( data ) {

                                        var response = $.parseJSON(data);
                                        var responseHtml =  response.html;
                                        var maxPages = response.maxPages;

                                        //reinit load more params
                                        blogHolder.data('max-pages', maxPages);

                                        eltd.modules.blog.eltdExpandableTiles.update_grid({
                                            action: 'refresh',
                                            html: responseHtml
                                        });



                                    }
                                });
                            } else {
                                //Submit form
                                searchForm.submit();
                            }


                        } else {
                            searchWidget.removeClass( 'eltd-search-open' );
                        }
                    } else {
                        searchWidget.addClass( 'eltd-search-open' );
                        searchInput.focus();
                    }
                });

                searchForm.submit(function(e) {
                    //If expanding tiles grid, send ajax request
                    if(eltd.body.hasClass('page-template-blog-expanding-tiles')){
                        e.preventDefault();
                        var input = searchInput.val(),
                            blogHolder = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles');
                        blogHolder.data('search-value',input);
                        blogHolder.data('next-page',2);

                        var data = {
                            'action': 'flow_elated_ajax_search',
                            'searchParam' : input
                        };

                        $.ajax({
                            url : ElatedAjaxUrl,
                            data : data,
                            type : 'POST',
                            success : function( data ) {

                                var response = $.parseJSON(data);
                                var responseHtml =  response.html;
                                var maxPages = response.maxPages;

                                //reinit load more params
                                blogHolder.data('max-pages', maxPages);

                                eltd.modules.blog.eltdExpandableTiles.update_grid({
                                    action: 'refresh',
                                    html: responseHtml
                                });



                            }
                        });
                    }
                });

                $(document).keyup(function(e) {
                    if (e.keyCode == 27 && searchWidget.hasClass( 'eltd-search-open' ) ) {
                        searchWidget.removeClass( 'eltd-search-open' );
                        searchInput.val('');
                    }
                });

            });
        }

    }

    function eltdInitInstagramCarousel() {

        var instagramCarousels = $('.eltd-instagram-feed.carousel');
        if ( instagramCarousels.length ) {
            instagramCarousels.each(function() {
                
                var slider = $(this);
                
                if(slider.hasClass('owl-carousel')){
                    
                    slider.data('owlCarousel').reinit({
                        pagination: false,
                        navigation: true,
                        navigationText: [
                            '<div class="eltd-prev-icon-holder"><div class="eltd-prev-icon-triangle"></div><span class="arrow_carrot-left"></span></div>',
                            '<div class="eltd-next-icon-holder"><div class="eltd-next-icon-triangle"></div><span class="arrow_carrot-right"></span></div>'
                        ],
                        itemsCustom: [
                            [0,4],
                            [360,4],
                            [480,4],
                            [600,6],
                            [768,8],
                            [1024,10],
                            [1400,12]
                        ]
                      });
                  
                }else{
                    
                    slider.owlCarousel({
                        pagination: false,
                        navigation: true,
                        navigationText: [
                            '<div class="eltd-prev-icon-holder"><div class="eltd-prev-icon-triangle"></div><span class="arrow_carrot-left"></span></div>',
                            '<div class="eltd-next-icon-holder"><div class="eltd-next-icon-triangle"></div><span class="arrow_carrot-right"></span></div>'
                        ],
                        itemsCustom: [
                            [0,4],
                            [360,4],
                            [480,4],
                            [600,6],
                            [768,8],
                            [1024,10],
                            [1400,12]
                        ]
                    });
                }
                
                
            });
        }

    }
    

    /*
    * Prevent animations from ending on mouse leave
    */
    function eltdInitAnimations() {
        var animatedElements = $('.eltd-play-button');
        if (animatedElements.length) {
            animatedElements.each(function(){
                var animatedElement = $(this);
                animatedElement.mouseenter(function(){
                    $(this).addClass('eltd-animating');
                    $(this).one('webkitAnimationEnd oanimationend msAnimationEnd animationend',   
                        function(e) {
                        $(this).removeClass('eltd-animating');
                    });
                });
            });
        }
    }

    function eltdLandingItemsHeight() {

        var landingItemImage = $('.eltd-landing-item-image img'),
            landingItemImageHolder = $('.eltd-landing-item-image'),
            landingItemTitle = $('.eltd-landing-item-title h3')
        if ( landingItemImage.length ) {

            var height = landingItemImage.first().height();
            landingItemImageHolder.css({
                'height' : height
            });

        }

        //appear fx
        var landingBanner = $('.eltd-landing-banner-image'),
            landingFlash = $('.eltd-landing-banner-flash');

        if (landingBanner.length) {
            landingBanner.closest('.eltd-landing-wrapper').appear(function(){
                setTimeout(function(){
                    landingBanner.addClass('eltd-appeared');
                },100);
                setTimeout(function(){
                    landingFlash.addClass('eltd-appeared');
                },1100);
                setTimeout(function(){
                    landingItemImage.each(function(i){
                        var landingItem = $(this).closest('.eltd-landing-item');
                        landingItem.appear(function(){
                            setTimeout(function(){
                                landingItem.addClass('eltd-appeared');
                            },120);
                        },{accX: 0, accY: 80});
                    });
                },1250);
            },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
        }

    }

})(jQuery);



(function($) {
    'use strict';

    var ajax = {};

    eltd.modules.ajax = ajax;

    var animation = {};
    ajax.animation = animation;

    ajax.eltdFetchPage = eltdFetchPage;
    ajax.eltdInitAjax = eltdInitAjax;
    ajax.eltdHandleLinkClick = eltdHandleLinkClick;
    ajax.eltdInsertFetchedContent = eltdInsertFetchedContent;
    ajax.eltdInitBackBehaviour = eltdInitBackBehaviour;
    ajax.eltdSetActiveState = eltdSetActiveState;
    ajax.eltdReinitiateAll = eltdReinitiateAll;
    ajax.eltdHandleMeta = eltdHandleMeta;

    ajax.eltdOnDocumentReady = eltdOnDocumentReady;
    ajax.eltdOnWindowLoad = eltdOnWindowLoad;
    ajax.eltdOnWindowResize = eltdOnWindowResize;
    ajax.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdInitAjax();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
        qodefHandleAjaxFader();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
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
    function eltdFetchPage(params, destinationSelector, targetSelector) {

        function setDefaultParam(key,value) {
            params[key] = typeof params[key] !== 'undefined' ? params[key] : value;
        }

        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.eltd-content';
        targetSelector = typeof targetSelector !== 'undefined' ? targetSelector : '.eltd-content';
        
        // setting default ajax parameters
        params = typeof params !== 'undefined' ? params : {};

        setDefaultParam('url', window.location.href);
        setDefaultParam('type', 'POST');
        setDefaultParam('success', function(response) {
            var jResponse = $(response);

            var meta = jResponse.find('.eltd-meta');
            if (meta.length) { eltdHandleMeta(meta); }

            var new_content = jResponse.find(targetSelector);
            if (!new_content.length) {
                loadedPageFlag = true;
                return false;
            }
            else {
                eltdInsertFetchedContent(params.url, new_content, destinationSelector);
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

    function qodefHandleAjaxFader() {
        if (animation.loader.length) {
            if (firstLoad) {
                animation.loader.fadeOut(animation.loaderTime);
            }
            $(window).bind("pageshow", function(event) {
                if (event.originalEvent.persisted) {
                    animation.loader.fadeOut(animation.loaderTime);
                }
            });
        }
    }

    function eltdInitAjax() {
        eltd.body.removeClass('page-not-loaded'); // Might be necessary for ajax calls
        animation.loader = $('body > .eltd-smooth-transition-loader.ajax');
        if (animation.loader.length) {

            if(eltd.body.hasClass('woocommerce') || eltd.body.hasClass('woocommerce-page')) {
                return false;
            }
            else {
                eltdInitBackBehaviour();
                $(document).on('click', 'a[target!="_blank"]:not(.no-ajax):not(.no-link)', function(click) {
                    var link = $(this);

                    if(click.ctrlKey == 1) { // Check if CTRL key is held with the click
                        window.open(link.attr('href'), '_blank');
                        return false;
                    }

                    if(link.parents('.eltd-ptf-load-more').length){ return false; } // Don't initiate ajax for portfolio load more link

                    if(link.parents('.eltd-blog-load-more-button').length){ return false; } // Don't initiate ajax for blog load more link

                    if(link.parents('eltd-post-info-comments').length){ // If it's a comment link, don't load any content, just scroll to the comments section
                        var hash = link.attr('href').split("#")[1];  
                        $('html, body').scrollTop( $("#"+hash).offset().top );  
                        return false;  
                    }

                    if(window.location.href.split('#')[0] == link.attr('href').split('#')[0]){ return false; } //  If the link leads to the same page, don't use ajax

                    if(link.closest('.eltd-no-animation').length === 0){ // If no parents are set to no-animation...

                        if(document.location.href.indexOf("?s=") >= 0){ // Don't use ajax if currently on search page
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-admin") >= 0){ // Don't use ajax for wp-admin
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-content") >= 0){ // Don't use ajax for wp-content
                            return true;
                        }

                        var no_hash_url = link.attr('href').split('#')[0];
                        if(
                            jQuery.inArray(no_hash_url, eltdGlobalVars.vars.no_ajax_pages) !== -1 || 
                            jQuery.inArray(no_hash_url + '/', eltdGlobalVars.vars.no_ajax_pages) !== -1 || 
                            (no_hash_url[no_hash_url.length-1] == '/' && jQuery.inArray(no_hash_url.substr(0,no_hash_url.length-1), eltdGlobalVars.vars.no_ajax_pages) !== -1)) { // If the target page is a no-ajax page, don't use ajax
                            document.location.href = link.attr('href');
                            return false;
                        }

                        if((link.attr('href') !== "http://#") && (link.attr('href') !== "#")){ // Don't use ajax if the link is empty
                            //disableHashChange = true;

                            var url = link.attr('href');
                            var start = url.indexOf(window.location.protocol + '//' + window.location.host); // Check if the link leads to the same domain
                            if(start === 0){
                                if(!loadedPageFlag){ return false; } //if page is not loaded don't load next one
                                click.preventDefault();
                                click.stopImmediatePropagation();
                                click.stopPropagation();
                                if (!link.is('.current')) {
                                    eltdHandleLinkClick(link);
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

    function eltdInitBackBehaviour() {
        if (window.history.pushState) {
            /* the below code is to override back button to get the ajax content without reload*/
            $(window).bind('popstate', function() {
                "use strict";

                var url = location.href;
                if (!firstLoad && loadedPageFlag) {
                    loadedPageFlag = false;
                    eltdFetchPage({
                        url: url
                    });
                }
            });
        }
    }

    function eltdHandleLinkClick(link) {
        loadedPageFlag = false;
        animation.loader.fadeIn(animation.loaderTime);
        eltdFetchPage({
            url: link.attr('href')
        });
    }

    function eltdSetActiveState(url) {
        var me = $("nav a[href='"+url+"'], .widget_nav_menu a[href='"+url+"']");

        $('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-mobile-nav h4, .eltd-vertical-menu a, .popup_menu a').parent().removeClass('eltd-active-item');
        //$('.main_menu a, .mobile_menu a, .mobile_menu h4, .vertical_menu a, .popup_menu a').parent().removeClass('active');

        me.each(function() {
            var me = $(this);

            if(me.closest('.second').length === 0){
                me.parent().addClass('eltd-active-item');
            }else{
                me.closest('.second').parent().addClass('eltd-active-item');
            }

            if(me.closest('.eltd-mobile-nav').length > 0){
                me.closest('.level0').addClass('eltd-active-item');
                me.closest('.level1').addClass('eltd-active-item');
                me.closest('.level2').addClass('eltd-active-item');
            }

            if(me.closest('.widget_nav_menu').length > 0){
                $('.widget_nav_menu ul.menu > li').removeClass('current-menu-item');
                me.closest('.widget_nav_menu').find('.menu-item').addClass('current-menu-item');
            }


            $('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-vertical-menu a, .popup_menu a').removeClass('current');
            me.addClass('current');
        });
    }

    /**
     * Reinitiate all function
     *
     * @param modules - array of modules to exclude
     */
    function eltdReinitiateAll( modulesToExclude ) {
        $(document).off(); // Remove all event handlers before reinitialization
        eltd.body.off().find('*').off(); // Remove all event handlers before reinitialization

        eltd.eltdOnDocumentReady();
        eltd.eltdOnWindowLoad();
        eltd.eltdOnWindowResize();
        eltd.eltdOnWindowScroll();

        var defaultModules = ['common', 'ajax', 'header', 'headerBehaviour', 'title', 'blog', 'like', 'shortcodes'];
        var modules = [];

        if ( typeof modulesToExclude !== 'undefined' && modulesToExclude.length ) {
            defaultModules.forEach(function(key) {
                if (-1 === modulesToExclude.indexOf(key)) {
                    modules.push(key);
                }
            }, this);
        } else {
            modules = defaultModules;
        }

        for (var i=0; i<modules.length; i++) {
            if (1 || typeof eltd.modules[modules[i]] !== 'undefined') {
                eltd.modules[modules[i]].eltdOnDocumentReady();
                eltd.modules[modules[i]].eltdOnWindowLoad();
                eltd.modules[modules[i]].eltdOnWindowResize();
                eltd.modules[modules[i]].eltdOnWindowScroll();
            }
        }
    }

    function eltdHandleMeta(meta_data) {
        // set up title, meta description and meta keywords
        var newTitle = meta_data.find(".eltd-seo-title").text();
        var pageTransition = meta_data.find(".eltd-page-transition").text();
        var newDescription = meta_data.find(".eltd-seo-description").text();
        var newKeywords = meta_data.find(".eltd-seo-keywords").text();
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

        var newBodyClasses = meta_data.find(".eltd-body-classes").text();
        var myArray = newBodyClasses.split(',');
        eltd.body.removeClass();
        for(var i=0;i<myArray.length;i++){
            if (myArray[i] !== "eltd-page-not-loaded"){
                eltd.body.addClass(myArray[i]);
            }
        }

        if($("#wp-admin-bar-edit").length > 0){
            // set up edit link when wp toolbar is enabled
            var pageId = meta_data.find("#eltd-page-id").text();
            var old_link = $('#wp-admin-bar-edit a').attr("href");
            var new_link = old_link.replace(/(post=).*?(&)/,'$1' + pageId + '$2');
            $('#wp-admin-bar-edit a').attr("href", new_link);
        }
    }

    function eltdInsertFetchedContent(url, new_content, destinationSelector) {
        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.eltd-content';
        var destination = eltd.body.find(destinationSelector);
        
        
        
        $('.eltd-wrapper').css('overflow','hidden');
        new_content.height(destination.height()).css({'position': 'relative', 'opacity': 0, 'overflow': 'hidden'}).insertBefore(destination);
        destination.css({'position': 'absolute', 'width': new_content.width()+'px', 'top': new_content.offset().top - new_content.parent().offset().top +'px', 'left': new_content.offset().left - new_content.parent().offset().left + parseInt(new_content.parent().css('padding-left'),10) + 'px'});
       
        new_content.waitForImages(function() {
            if (url.indexOf('#') !== -1) {
                $('<a class="eltd-temp-anchor eltd-anchor" href="'+url+'" style="display: none"></a>').appendTo('body');
            }
            firstLoad = false;
            eltdReinitiateAll();

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
                    eltdSetActiveState(url);
                    eltd.body.animate({scrollTop: 0}, animation.time, 'swing');
                });
                setTimeout(function() {
                    new_content.css('position','relative').height('').stop().fadeTo(animation.time, 1, function() {
                        $('.eltd-wrapper').css('overflow','');
                        loadedPageFlag = true;
                        //firstLoad = false;
                        animation.loader.fadeOut(animation.loaderTime, function() {
                            var anch = $('.eltd-temp-anchor');
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
    eltd.modules.header = header;
    var headerBehaviour = {};
    eltd.modules.headerBehaviour = headerBehaviour;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.eltdInitMobileNavigation = eltdInitMobileNavigation;
    header.eltdSetDropDownMenuPosition = eltdSetDropDownMenuPosition;
    header.eltdDropDownMenu = eltdDropDownMenu;

    headerBehaviour.eltdHeaderBehaviour = eltdHeaderBehaviour;
    headerBehaviour.eltdMobileHeaderBehaviour = eltdMobileHeaderBehaviour;

    header.eltdOnDocumentReady = eltdOnDocumentReadyHeader;
    header.eltdOnWindowLoad = eltdOnWindowLoadHeader;
    header.eltdOnWindowResize = eltdOnWindowResizeHeader;
    header.eltdOnWindowScroll = eltdOnWindowScrollHeader;

    headerBehaviour.eltdOnDocumentReady = eltdOnDocumentReadyHeaderBehaviour;
    headerBehaviour.eltdOnWindowLoad = eltdOnWindowLoadHeaderBehaviour;
    headerBehaviour.eltdOnWindowResize = eltdOnWindowResizeHeaderBehaviour;
    headerBehaviour.eltdOnWindowScroll = eltdOnWindowScrollHeaderBehaviour;

    $(document).ready(function() {
        eltdOnDocumentReadyHeader();
        eltdOnDocumentReadyHeaderBehaviour();
    });
    $(window).load(function() {
        eltdOnWindowLoadHeader();
        eltdOnWindowLoadHeaderBehaviour();
    });
    $(window).resize(function() {
        eltdOnWindowResizeHeader();
        eltdOnWindowResizeHeaderBehaviour();
    });
    $(window).scroll(function() {
        eltdOnWindowScrollHeader();
        eltdOnWindowScrollHeaderBehaviour();
    });
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReadyHeader() {
        eltdInitMobileNavigation();
        eltdSetDropDownMenuPosition();
        eltdDropDownMenu();
        eltdVerticalMenu().init();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoadHeader() {
        eltdSetDropDownMenuPosition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResizeHeader() {
        eltdDropDownMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScrollHeader() {
        
    }

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReadyHeaderBehaviour() {
        eltdHeaderBehaviour();
        eltdMobileHeaderBehaviour();
    }

    /*
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoadHeaderBehaviour() {
    }

    /*
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResizeHeaderBehaviour() {
    }

    /*
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScrollHeaderBehaviour() {
    }



    /*
     **	Show/Hide sticky header on window scroll
     */
    function eltdHeaderBehaviour() {

        var header = $('.eltd-page-header');
        var stickyHeader = $('.eltd-sticky-header');
        var fixedHeaderWrapper = $('.eltd-fixed-wrapper');

        var headerMenuAreaOffset = $('.eltd-page-header').find('.eltd-fixed-wrapper').length ? $('.eltd-page-header').find('.eltd-fixed-wrapper').eq(0).offset().top : null;

        var stickyAppearAmount;


        switch(true) {
            // sticky header that will be shown when user scrolls up
            case eltd.body.hasClass('eltd-sticky-header-on-scroll-up'):
                eltd.modules.header.behaviour = 'eltd-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = eltdGlobalVars.vars.eltdTopBarHeight + eltdGlobalVars.vars.eltdLogoAreaHeight + eltdGlobalVars.vars.eltdMenuAreaHeight + eltdGlobalVars.vars.eltdStickyHeaderHeight;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        eltd.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.eltd-main-menu .second').removeClass('eltd-drop-down-start');
                    }else {
                        eltd.modules.header.isStickyVisible = true;
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
            case eltd.body.hasClass('eltd-sticky-header-on-scroll-down-up'):
                eltd.modules.header.behaviour = 'eltd-sticky-header-on-scroll-down-up';
                stickyAppearAmount = eltdPerPageVars.vars.eltdStickyScrollAmount !== 0 ? eltdPerPageVars.vars.eltdStickyScrollAmount : eltdGlobalVars.vars.eltdTopBarHeight + eltdGlobalVars.vars.eltdLogoAreaHeight + eltdGlobalVars.vars.eltdMenuAreaHeight;
                eltd.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic
                
                var headerAppear = function(){
                    if(eltd.scroll < stickyAppearAmount) {
                        eltd.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltd-main-menu .second').removeClass('eltd-drop-down-start');
                    }else{
                        eltd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case eltd.body.hasClass('eltd-fixed-on-scroll'):
                eltd.modules.header.behaviour = 'eltd-fixed-on-scroll';
                var headerFixed = function(){
                    if(eltd.scroll < headerMenuAreaOffset){
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-top',0);}
                    else{
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-top',fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    function eltdInitMobileNavigation() {
        var navigationOpener = $('.eltd-mobile-header .eltd-mobile-menu-opener');
        var navigationHolder = $('.eltd-mobile-header .eltd-mobile-nav');
        var dropdownOpener = $('.eltd-mobile-nav .mobile_arrow, .eltd-mobile-nav h4, .eltd-mobile-nav a[href*="#"]');
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
                            openerParent.removeClass('eltd-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('eltd-opened');
                        }
                    }

                });
            });
        }

        $('.eltd-mobile-nav a, .eltd-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function eltdMobileHeaderBehaviour() {
        if(eltd.body.hasClass('eltd-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var mobileHeader = $('.eltd-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('eltd-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('eltd-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.eltd-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);

                    //if(adminBar.length) {
                    //    mobileHeader.find('.eltd-mobile-header-inner').css('top', adminBarHeight);
                    //}
                }

                docYScroll1 = $(document).scrollTop();
            });
        }

    }


    /**
     * Set dropdown position
     */
    function eltdSetDropDownMenuPosition(){

        var menuItems = $(".eltd-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = eltd.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(eltd.body.hasClass('boxed')){
                menuItemFromLeft = eltd.boxedLayoutWidth  - (menuItemPosition - (browserWidth - eltd.boxedLayoutWidth )/2);
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


    function eltdDropDownMenu() {

        var menu_items = $('.eltd-drop-down > ul > li');

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
                            var left_position = (eltd.windowWidth - 2 * (eltd.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    } else {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = dropdown.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', eltd.windowWidth);

                        }
                    }
                }

                if(!eltd.menuDropdownHeightSet) {
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
                    if(eltd.body.hasClass('eltd-dropdown-animate-height')) {
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
                                    dropDownSecondDiv.addClass('eltd-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('eltd-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.eltd-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which == 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        eltd.menuDropdownHeightSet = true;
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var eltdVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.eltd-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */
        var resizeVerticalArea = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.getNiceScroll().resize();
            }
        };

        /**
         * Checks if vertical area is scrollable (if it has eltd-with-scroll class)
         *
         * @returns {bool}
         */
        var verticalAreaScrollable = function() {
            return verticalMenuObject.hasClass('.eltd-with-scroll');
        };

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.eltd-vertical-menu');
            dropdownClickToggle();

            /**
             * Initializes click toggle navigation type. Works the same for touch and no-touch devices
             */
            function dropdownClickToggle() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');

                menuItems.each(function() {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;
                    var dropdownOpener = $(this).find('> a');
                    var secondLevelItems = $(this).find('ul li a');
                    var slideUpSpeed = 'fast';
                    var slideDownSpeed = 'slow';

                    dropdownOpener.on('click tap', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if(elementToExpand.is(':visible')) {
                            $(menuItem).removeClass('open');
                            elementToExpand.slideUp(slideUpSpeed, function() {
                                resizeVerticalArea();
                            });
                        } else {
                            if(!$(this).parents('li').hasClass('open')) {
                                menuItems.removeClass('open');
                                menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
                            }

                            $(menuItem).addClass('open');
                            elementToExpand.slideDown(slideDownSpeed, function() {
                                resizeVerticalArea();
                            });
                        }
                    });

                    secondLevelItems.on('click tap', function(e) {
                        if ( $(this).attr('href') == '#' || $(this).attr('href') == '' ) {
                            return;
                        }
                        if ( $(this).attr('href') !== window.location.href ) {
                            $(this).closest('.second').slideUp(slideUpSpeed);
                        }
                    });
                });
            }

        };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.niceScroll({
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
        };

        var initHiddenVerticalArea = function() {
            var verticalLogo = $('.eltd-vertical-area-bottom-logo');
            var verticalMenuOpener = verticalMenuObject.find('.eltd-vertical-menu-hidden-button');
            var scrollPosition = 0;

            verticalMenuOpener.on('click tap', function() {
                if(isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            //take click outside vertical left/right area and close it
            $j(verticalMenuObject).outclick({
                callback: function() {
                    closeVerticalArea();
                }
            });

            $(window).scroll(function() {
                if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                verticalMenuObject.removeClass('active');

                if(verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                verticalMenuObject.addClass('active');

                if(verticalLogo.length) {
                    verticalLogo.addClass('active');
                }

                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();

                    if(eltd.body.hasClass('eltd-vertical-header-hidden')) {
                        initHiddenVerticalArea();
                    }
                }
            }
        };
    };

})(jQuery);
(function($) {
    "use strict";

    var title = {};
    eltd.modules.title = title;

    title.eltdParallaxTitle = eltdParallaxTitle;

    title.eltdOnDocumentReady = eltdOnDocumentReady;
    title.eltdOnWindowLoad = eltdOnWindowLoad;
    title.eltdOnWindowResize = eltdOnWindowResize;
    title.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {

    }
    

    /*
     **	Title image with parallax effect
     */
    function eltdParallaxTitle(){
        if($('.eltd-title.eltd-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.eltd-title.eltd-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.eltd-title.eltd-has-parallax-background.eltd-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(eltd.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+eltdGlobalVars.vars.eltdAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltd.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(eltd.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+eltdGlobalVars.vars.eltdAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltd.scroll + 'px auto'});
            });

        }
    }

})(jQuery);

(function($) {
    'use strict';

    var shortcodes = {};

    eltd.modules.shortcodes = shortcodes;

    shortcodes.eltdInitMessages = eltdInitMessages;
    shortcodes.eltdInitMessageHeight = eltdInitMessageHeight;
    shortcodes.eltdInitBlogListMasonry = eltdInitBlogListMasonry;
    shortcodes.eltdCustomFontResize = eltdCustomFontResize;
    shortcodes.eltdInitImageGallery = eltdInitImageGallery;
    shortcodes.eltdShowGoogleMap = eltdShowGoogleMap;
    shortcodes.eltdInitBlogCarousel = eltdInitBlogCarousel;

    shortcodes.eltdOnDocumentReady = eltdOnDocumentReady;
    shortcodes.eltdOnWindowLoad = eltdOnWindowLoad;
    shortcodes.eltdOnWindowResize = eltdOnWindowResize;
    shortcodes.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdIcon().init();
        eltdInitMessages();
        eltdInitMessageHeight();
        eltdButton().init();
        eltdInitBlogListMasonry();
        eltdCustomFontResize();
        eltdInitImageGallery();
        eltdShowGoogleMap();
        eltdSocialIconWidget().init();
        eltdInitBlogCarousel();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdInitBlogListMasonry();
        eltdCustomFontResize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
        
    }
    
    /*
    **	Function to close message shortcode
    */
    function eltdInitMessages(){
        var message = $('.eltd-message');
        if(message.length){
            message.each(function(){
                var thisMessage = $(this);
                thisMessage.find('.eltd-close').click(function(e){
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }
    
    /*
    **	Init message height
    */
    function eltdInitMessageHeight(){
       var message = $('.eltd-message.eltd-with-icon');
       if(message.length){
           message.each(function(){
               var thisMessage = $(this);
               var textHolderHeight = thisMessage.find('.eltd-message-text-holder').height();
               var iconHolderHeight = thisMessage.find('.eltd-message-icon-holder').height();
               
               if(textHolderHeight > iconHolderHeight) {
                   thisMessage.find('.eltd-message-icon-holder').height(textHolderHeight);
               } else {
                   thisMessage.find('.eltd-message-text-holder').height(iconHolderHeight);
               }
           });
       }
    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var eltdIcon = eltd.modules.shortcodes.eltdIcon = function() {
        //get all icons on page
        var icons = $('.eltd-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('eltd-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.eltd-icon-animation-holder').addClass('eltd-icon-animation-show');
                }, {accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
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

                var iconElement = icon.find('.eltd-icon-element');
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
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
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
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
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
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var eltdSocialIconWidget = eltd.modules.shortcodes.eltdSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.eltd-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var eltdButton = eltd.modules.shortcodes.eltdButton = function() {
        //all buttons on the page
        var buttons = $('.eltd-btn');

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

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
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
    function eltdInitBlogListMasonry(){
        var blogList = $('.eltd-blog-list-holder.eltd-masonry .eltd-blog-list');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);
                thisBlogList.animate({opacity: 1});
                thisBlogList.isotope({
                    itemSelector: '.eltd-blog-list-masonry-item',
                    masonry: {
                        columnWidth: '.eltd-blog-list-masonry-grid-sizer',
                        gutter: '.eltd-blog-list-masonry-grid-gutter'
                    }
                });
            });

        }
    }

	/*
	**	Custom Font resizing
	*/
	function eltdCustomFontResize(){
		var customFont = $('.eltd-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (eltd.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (eltd.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (eltd.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (eltd.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (eltd.windowWidth < 480){
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

					if (lineHeight > 70 && eltd.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && eltd.windowWidth < 768) {
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
    function eltdShowGoogleMap(){

        if($('.eltd-google-map').length){
            $('.eltd-google-map').each(function(){

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
                var holderId = "eltd-map-"+ uniqueId;

                eltdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function eltdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

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
            googleMapStyleId = 'eltd-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Elated Google Map"});

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
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'eltd-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('eltd-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            eltdInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function eltdInitializeGoogleAddress(data, pin,  map, geocoder){
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

    function eltdInitImageGallery() {

        var galleries = $('.eltd-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.eltd-image-gallery-slider'),
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
                        '<span class="eltd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });
            });
        }

    }

    /**
     * Initialize blog slider
     */
    function eltdInitBlogCarousel() {

        var blogCarousels = $('.eltd-blog-carousel');
        if (blogCarousels.length) {
            blogCarousels.each(function() {
                var blogCarousel = $(this);
                if ( blogCarousel.hasClass('eltd-slider') ) {
                    eltdBlogSliderInitSlider( blogCarousel );
                } else if ( blogCarousel.hasClass('eltd-carousel') ) {
                    eltdBlogSliderInitCarousel( blogCarousel );
                }
            });
        }

    }

    function eltdBlogSliderInitSlider( blogSlider ) {

        if ( blogSlider.length ) {
            var navigation = blogSlider.data('navigation') == 'yes',
                prevArrow = '<div class="eltd-blog-slide-arrow left"><div class="eltd-prev-icon-holder"><div class="eltd-prev-icon-triangle"></div><span class="arrow_carrot-left"></span></div></div>',
                nextArrow = '<div class="eltd-blog-slide-arrow right"><div class="eltd-next-icon-holder"><div class="eltd-next-icon-triangle"></div><span class="arrow_carrot-right"></span></div></div>';
            
            var autoplay = blogSlider.data('autoplay');
            var autoplayFlag; 
            var autoplaySpeed = blogSlider.data('autoplay_speed');
            
            if(autoplay === 'yes'){
                autoplayFlag = true;                
            }else{
                autoplayFlag = false;
            }
            
            if ( blogSlider.hasClass('slick-initialized') ) {
                blogSlider.slick('unslick');
            }
            
            blogSlider.slick({
                arrows: navigation,
                prevArrow: prevArrow,
                nextArrow: nextArrow,
                fade: true,
                cssEase: 'linear',
                autoplay: autoplayFlag,
                autoplaySpeed: autoplaySpeed
            });
        }

    }
    function eltdBlogSliderInitCarousel( blogCarousel ) {

        if ( blogCarousel.length ) {
            var navigation = blogCarousel.data('navigation') == 'yes',
                prevArrow = '<div class="eltd-blog-slide-arrow left"><i class="arrow_carrot-left"></i></div>',
                nextArrow = '<div class="eltd-blog-slide-arrow right"><i class="arrow_carrot-right"></i></div>';
            
            var autoplay = blogCarousel.data('autoplay');
            var autoplayFlag; 
            var autoplaySpeed = blogCarousel.data('autoplay_speed');
            
            if(autoplay === 'yes'){
                autoplayFlag = true;                
            }else{
                autoplayFlag = false;
            }

            if ( blogCarousel.hasClass('slick-initialized') ) {
                blogCarousel.slick('unslick');
            }
            blogCarousel.slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: false,
                dots: navigation,
                prevArrow: prevArrow,
                nextArrow: nextArrow,
                centerMode: true,
                draggable: false,
                centerPadding: '105px',
                autoplay: autoplayFlag,
                autoplaySpeed: autoplaySpeed,
                appendArrows: $('.eltd-blog-carousel-navigation'),
                responsive: [
                    {
                        breakpoint: 1400,
                        settings: {
                            centerPadding: '30px'
                        }
                    },
                    {
                        breakpoint: 1281,
                        settings: {
                            centerPadding: '0px'
                        }
                    },
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerPadding: '270px'
                        }
                    },
                    {
                        breakpoint: 851,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerPadding: '220px'
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerPadding: '170px'
                        }
                    },
                    {
                        breakpoint: 601,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerPadding: '100px'
                        }
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerPadding: '20px'
                        }
                    },
                ]
            });
        }

    }

})(jQuery);
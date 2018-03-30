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



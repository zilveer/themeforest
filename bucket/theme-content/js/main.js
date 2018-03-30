// /* ====== SHARED VARS ====== */

var phone, touch, ltie9, lteie9, wh, ww, dh, ar, fonts;

var ua = navigator.userAgent;
var winLoc = window.location.toString();

var is_webkit = ua.match(/webkit/i);
var is_firefox = ua.match(/gecko/i);
var is_newer_ie = typeof (is_ie) !== "undefined" || (!(window.ActiveXObject) && "ActiveXObject" in window);
var is_older_ie = ua.match(/msie/i) && !is_newer_ie;
var is_ancient_ie = ua.match(/msie 6/i);
var is_mobile = ua.match(/mobile/i);
var is_OSX = (ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false);

var nua = navigator.userAgent;
var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));

var useTransform = true;
var use2DTransform = (ua.match(/msie 9/i) || winLoc.match(/transform\=2d/i));
var transform;

// setting up transform prefixes
var prefixes = {
	webkit: 'webkitTransform',
	firefox: 'MozTransform',
	ie: 'msTransform',
	w3c: 'transform'
};

if (useTransform) {
	if (is_webkit) {
		transform = prefixes.webkit;
	} else if (is_firefox) {
		transform = prefixes.firefox;
	} else if (is_newer_ie) {
		transform = prefixes.ie;
	}
}

if ( is_newer_ie ) jQuery('html').addClass('is--ie');
(function ($, window, undefined) {

	/* --- DETECT VIEWPORT SIZE --- */

	function browserSize() {
		wh = $(window).height();
		ww = $(window).width();
		dh = $(document).height();
		ar = ww / wh;
	}


	/* --- DETECT PLATFORM --- */

	function platformDetect(){
		$.support.touch = 'ontouchend' in document;
		var navUA = navigator.userAgent.toLowerCase(),
			navPlat = navigator.platform.toLowerCase();

		var isiPhone = navPlat.indexOf("iphone"),
			isiPod = navPlat.indexOf("ipod"),
			isAndroidPhone = navPlat.indexOf("android"),
			safari = (navUA.indexOf('safari') != -1 && navUA.indexOf('chrome') == -1) ? true : false,
			svgSupport = (window.SVGAngle) ? true : false,
			svgSupportAlt = (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) ? true : false,
			ff3x = (/gecko/i.test(navUA) && /rv:1.9/i.test(navUA)) ? true : false;

		phone = (isiPhone > -1 || isiPod > -1 || isAndroidPhone > -1) ? true : false;
		touch = $.support.touch ? true : false;
		ltie9 = $.support.leadingWhitespace ? false : true;
		lteie9 = typeof window.atob === 'undefined' ? true : false;

		var $bod = $('body');

		if (touch) {$bod.addClass('touch');}
		if (safari) $bod.addClass('safari');
		if (phone) $bod.addClass('phone');
	};
/* --- Magnific Popup Initialization --- */

function magnificPopupInit(){

	$('.js-post-gallery').each(function() { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', // the container for each your gallery items
			type: 'image',
			removalDelay: 500,
			mainClass: 'mfp-fade',
			image: {
				titleSrc: function (item){
					var output = '';
					if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					}
					if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					}
					return output;
				}
			},
			gallery:{
				enabled:true,
				navigateByImgClick: true
			}
		});
	});
}
/* RILOADR INIT */

function riloadrInit() {
    // Lazy loading for images with '.lazy' class
    var riloadrImages = new Riloadr({
        name : 'lazy',
        breakpoints: [
            {name: 'whatever' , minWidth: 1}
        ],
        defer: {
            mode: 'load'
        }
    });

    // Responsive Featured Image for single post page
    var riloadrSingle = new Riloadr({
        name : 'riloadr-single',
        breakpoints: [
            {name: 'small' , maxWidth: 400},
            {name: 'big'   , minWidth: 401}
        ],
        watchViewportWidth: "*"
    });
}
/* --- Royal Slider Init --- */

var $original_billboard_slider;

/*
 * Slider Initialization
 */
function sliderInit($slider){

	$slider.find('img').removeClass('invisible');

	var $children = $(this).children(),
		rs_arrows = typeof $slider.data('arrows') !== "undefined",
		rs_bullets = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
		rs_autoheight = typeof $slider.data('autoheight') !== "undefined",
		rs_autoScaleSlider = false,
		rs_autoScaleSliderWidth = $slider.data('autoscalesliderwidth'),
		rs_autoScaleSliderHeight = $slider.data('autoscalesliderheight'),
		rs_customArrows = typeof $slider.data('customarrows') !== "undefined",
		rs_slidesSpacing = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
		rs_keyboardNav  = typeof $slider.data('fullscreen') !== "undefined",
		rs_imageScale  = $slider.data('imagescale'),
		rs_visibleNearby = typeof $slider.data('visiblenearby') !== "undefined" ? true : false,
		rs_imageAlignCenter  = typeof $slider.data('imagealigncenter') !== "undefined",
		rs_transition = typeof $slider.data('slidertransition') !== "undefined" && $slider.data('slidertransition') != '' ? $slider.data('slidertransition') : 'move',
		rs_autoPlay = typeof $slider.data('sliderautoplay') !== "undefined" ? true : false,
		rs_delay = typeof $slider.data('sliderdelay') !== "undefined" && $slider.data('sliderdelay') != '' ? $slider.data('sliderdelay') : '1000',
		rs_drag = true,
		rs_globalCaption = typeof $slider.data('showcaptions') !== "undefined" ? true : false;

	if(rs_autoheight) { rs_autoScaleSlider = false } else { rs_autoScaleSlider = true }

	// Single slide case
	if ($children.length == 1){
		rs_arrows = false;
		rs_bullets = 'none';
		rs_customArrows = false;
		rs_keyboardNav = false;
		rs_drag = false;
		rs_transition = 'fade';
	}

	// make sure default arrows won't appear if customArrows is set
	if (rs_customArrows) arrows = false;

	//the main params for Royal Slider
	var royalSliderParams = {
		autoHeight: rs_autoheight,
		autoScaleSlider: rs_autoScaleSlider,
		loop: true,
		autoScaleSliderWidth: rs_autoScaleSliderWidth,
		autoScaleSliderHeight: rs_autoScaleSliderHeight,
		imageScaleMode: rs_imageScale,
		imageAlignCenter: rs_imageAlignCenter,
		slidesSpacing: rs_slidesSpacing,
		arrowsNav: rs_arrows,
		controlNavigation: rs_bullets,
		keyboardNavEnabled: rs_keyboardNav,
		arrowsNavAutoHide: false,
		sliderDrag: rs_drag,
		transitionType: rs_transition,
		autoPlay: {
			enabled: rs_autoPlay,
			stopAtAction: true,
			pauseOnHover: true,
			delay: rs_delay
		},
		numImagesToPreload: 10,
		globalCaption:rs_globalCaption
	};

	if (rs_visibleNearby) {
		royalSliderParams['visibleNearby'] = {
			enabled: true,
			//centerArea: 0.8,
			center: true,
			breakpoint: 0,
			//breakpointCenterArea: 0.64,
			navigateByCenterClick: false
		}
	}

	//lets fire it up
	$slider.royalSlider(royalSliderParams);
	$slider.addClass('slider--loaded');

	var royalSlider = $slider.data('royalSlider');
	var slidesNumber = royalSlider.numSlides;

	// move arrows outside rsOverflow
	$slider.find('.rsArrow').appendTo($slider);

	royalSlider.ev.on('rsVideoPlay', function() {
		if(rs_imageScale == 'fill'){
			var $frameHolder = $('.rsVideoFrameHolder');
			var top = Math.abs(royalSlider.height - $frameHolder.closest('.rsVideoContainer').height())/2;

			$frameHolder.height(royalSlider.height);
			$frameHolder.css('margin-top', top+'px');

		} else {
			var $frameHolder = $('.rsVideoFrameHolder');
			var $videoContainer = $('.rsVideoFrameHolder').closest('.rsVideoContainer');
			var top = parseInt($frameHolder.closest('.rsVideoContainer').css('margin-top'), 10);

			if(top < 0){
				top = Math.abs(top);
				$frameHolder
					.height(royalSlider.height)
					.css('top', top + 'px');
			}
		}
	});

	$slider.addClass('slider--loaded');
}



/*
 * Wordpress Galleries to Sliders
 * Create the markup for the slider from the gallery shortcode
 * take all the images and insert them in the .gallery <div>
 */
function sliderMarkupGallery($gallery){
	var $old_gallery = $gallery,
		gallery_data = $gallery.data(),
		$images = $old_gallery.find('img'),
		$new_gallery = $('<div class="pixslider js-pixslider">');

	$images.prependTo($new_gallery).addClass('rsImg');
	$old_gallery.replaceWith($new_gallery);

	$new_gallery.data(gallery_data);
}

function sliderUpdateSize($slider) {
	var $sliderObj = $slider.data('royalSlider');

	$sliderObj.updateSliderSize(true);
}


/*
 * Change the Slider markup from (1 big / 2 small) to (3 big)
 * ORIGINAL to MOBILE
 */
function sliderMarkupMobile($slider){
	var $parent = $slider;

	// Change markup to default
	$slider.replaceWith($original_billboard_slider);
	$slider = $('.billboard.js-pixslider');

	// Change parameters
	$slider.attr('data-autoheight', true);
	$slider.attr('data-imagescale', 'none');

	$slider.find('.billboard--article-group').each(function(){
		// var $slide = $(this),
		// $slide_thumb = $slide.find('.article--billboard-small img');

		// // For each slide thumb(because there are two)
		// // we set the new image source
		// $slide_thumb.each(function(){
		//     slide_thumb_big_src = $(this).attr('data-src-big');
		//     $(this).attr('src', slide_thumb_big_src);
		// });

		// Change thumbnail for small articles
		$(this).children('.article').removeClass('rsABlock');

		$(this).before($(this).html())
			.remove();
	});

	// Mark as mobile
	$slider.addClass('js-pixslider-mobile');

	$slider.addClass('rsAutoHeight');

	sliderInit($slider);
}



/*
 * Change the Slider Markup from (3 big) to (1 big / 2 small)
 * MOBILE to ORIGINAL
 */
function sliderMarkupOriginal($slider){

	// Change markup
	$slider.replaceWith($original_billboard_slider);
	$slider = $('.billboard.js-pixslider');

	// Change parameters
	$slider.removeAttr('data-autoheight');
	$slider.removeAttr('imagescale');

	$slider.removeClass('js-pixslider-mobile');
	$slider.removeClass('rsAutoHeight');

	sliderInit($slider);
}



/*
 * Billboard Slider markup changes (on resize)
 */
function slider_billboard() {
	var window_size = $(window).width();

	$('.js-pixslider.billboard').each(function(){
		$slider = $(this);
		var slider_rs = $slider.data('royalSlider');

		if((window_size < 900) && (!$slider.hasClass('js-pixslider-mobile'))) {
			if(slider_rs) slider_rs.destroy();
			sliderMarkupMobile($slider);
		} else if((window_size > 900) && ($slider.hasClass('js-pixslider-mobile'))) {
			if(slider_rs) slider_rs.destroy();
			sliderMarkupOriginal($slider);
		}
	});

	// riloadrSlider.riload();
}



/*
 * First Slider Initialization
 */

function royalSliderInit() {
	// Transform Wordpress Galleries to Sliders
	$('.wp-gallery').each(function() { sliderMarkupGallery($(this)); });

	// Find and initialize each slider
	$('.js-pixslider').each(function(){
		if(!$(this).hasClass('billboard'))
			sliderInit($(this));
	});
};

var royalSliderBillboardInitiated = false;
function royalSliderBillboardInit(){
	royalSliderBillboardInitiated = true;

	$('.js-pixslider.billboard').each(function(){
		// Cache The Original Billboard Slider HTML Markup
		$original_billboard_slider = $(this).outerHTML();
		slider_billboard($(this));

		var height = $(this).find('img').first().height();

		sliderInit($(this));


	});
}
/* ====== INTERNAL FUNCTIONS ====== */

/* --- Set Query Parameter--- */
function setQueryParameter(uri, key, value) {
    var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
    separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}


/* --- $VIDEOS --- */

function initVideos() {

    var videos = $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"], video');

    // Figure out and save aspect ratio for each video
    videos.each(function() {
        if( this.width != 0 && this.height != 0 ){
            $(this).data('aspectRatio', this.width / this.height)
            // and remove the hard coded width/height
                .removeAttr('height')
                .removeAttr('width');
        } else { // for the conflict with jetpack set an default aspect ration of 16/9
            $(this).data('aspectRatio', 16/9 )
                .removeAttr('height')
                .removeAttr('width');
        }
    });

    resizeVideos();

    // Firefox Opacity Video Hack
    $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function(){
        var url = $(this).attr("src");

        $(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
    });
}


function stickyHeader(){
    if($('body').hasClass('sticky-nav')){
        var sticky = $('.js-sticky');
        var offset = sticky.offset();
        var stickyHeight = sticky.height();

        sticky.parent().height(stickyHeight);
        sticky.parent().css('margin-bottom', '24px');

        $(window).scroll(function() {

            if ( $(window).scrollTop() > offset.top){
                sticky.addClass('sticky');
            } else {
                sticky.removeClass('sticky');
            }

        });
    }
}

function footerWidgetsTitles() {
    $('.widget--footer__title .hN, .panel__title  .hN').each(function() {
        var $title = $(this),
            text = $title.text(),
            index = text.indexOf(" ");
        if (index != -1) {
            text = '<em>' + text.slice(0, index) + '</em>' + text.slice(text.indexOf(" "), text.length);
        } else {
            text = '<em>' + text + '</em>';
        }
        $title.html(text);
    });
}



function popularPostsWidget() {
    $('.wpgrade_popular_posts, .pixcode--tabs').organicTabs();
}

//scan through the post meta tags and try to find the post image
function getArticleImage() {
    var metas = document.getElementsByTagName('meta');

    for (i=0; i<metas.length; i++) {
        if (metas[i].getAttribute("property") == "og:image") {
            return metas[i].getAttribute("content");
        } else if (metas[i].getAttribute("property") == "image") {
            return metas[i].getAttribute("content");
        } else if (metas[i].getAttribute("property") == "twitter:image:src") {
            return metas[i].getAttribute("content");
        }
    }

    return "";
}

/* --- Load AddThis Async --- */
function loadAddThisScript() {
    if (window.addthis) {
        // Listen for the ready event
        addthis.addEventListener('addthis.ready', addthisReady);
        addthis.init();
    }
}

/* --- AddThis On Ready - The API is fully loaded --- */
//only fire this the first time we load the AddThis API - even when using ajax
function addthisReady( obj ) {
    addThisInit(obj);
}

/* --- AddThis Init --- */
function addThisInit(obj) {
    if (window.addthis) {
        addthis.toolbox('.addthis_toolbox');
    }
}

// Mega-Menu Hover with delay
function megaMenusHover() {
    $('.nav--main > li').hoverIntent({
        interval: 100,
        timeout: 300,
        over: showMegaMenu,
        out: hideMegaMenu,
    })

    function showMegaMenu() {
        var self = $(this);
        self.removeClass('hidden');
        setTimeout(function(){
            self.addClass('open');
        }, 50);
    }
    function hideMegaMenu() {
        var self = $(this);
        self.removeClass('open');
        setTimeout(function(){
            self.addClass('hidden');
        }, 150);
    }
}


/* ====== INITIALIZE ====== */

function init() {

    /* GLOBAL VARS */
    touch = false;

    /* GET BROWSER DIMENSIONS */
    browserSize();

    /* DETECT PLATFORM */
    platformDetect();

    /* Overthrow Polyfill */
    overthrow.set();

    loadAddThisScript();

    FastClick.attach(document.body);

    if (is_android) {
        $('html').addClass('android-browser');
    } else {
        $('html').addClass('no-android-browser');
    }

    /* Retina Logo */
    var is_retina = (window.retina || window.devicePixelRatio > 1);

    if (is_retina && $('.site-logo--image-2x').length) {
        var image = $('.site-logo--image-2x').find('img');

        if (image.data('logo2x') !== undefined && image.data('logo2x').length) {
            image.attr('src', image.data('logo2x'));
            image.addClass('has--2x-image');
        }
    }

    /* Mega Menu */
    megaMenusHover();

    /* ONE TIME EVENT HANDLERS */
    eventHandlersOnce();

    /* INSTANTIATE EVENT HANDLERS */
    eventHandlers();

    /* INSTANTIATE RILOADR (lazy loading and responsive images) */
    riloadrInit();

    if($('body').hasClass('custom-background')){
        if($('body').css('background-repeat') == 'no-repeat') {
            $('body').addClass('background-cover');
        }
    }

};





/* ====== CONDITIONAL LOADING ====== */

function loadUp(){

    initVideos();
    footerWidgetsTitles();

    //Set textareas to autosize
    if($("textarea").length) { $("textarea").autosize(); }

    // if blog archive
    if ($('.masonry').length && !lteie9 && !is_android)
        salvattore();

    //lets test first if we have some riloadr images to work on
    if ($('.riloadr-slider').length > 0) {
        var riloadrSlider = new Riloadr({
            name : 'riloadr-slider',
            breakpoints: [
                {name: 'small' /*post-medium */ , minWidth: 901},
                {name: 'big'   /*post-medium */ , maxWidth: 900}
            ],
            watchViewportWidth: "*",
            oncomplete: function(){
                if(royalSliderBillboardInitiated == false)
                    royalSliderBillboardInit();
            }
        });
    } else {
        //we may as well initiate the billboard slider
        if(royalSliderBillboardInitiated == false)
            royalSliderBillboardInit();
    };

    royalSliderInit();
    magnificPopupInit();

    stickyHeader();
}




/* ====== EVENT HANDLERS ====== */

function eventHandlersOnce() {

    /* NAVIGATION MOBILE */
    // if (touch || ($(window).width() < 900)) {
    var windowHeigth = $(window).height();

    $('.js-nav-trigger').bind('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        if($('html').hasClass('navigation--is-visible')){
            $('#page').css('height', '');
            $('html').removeClass('navigation--is-visible');

        } else {
            $('#page').height(windowHeigth);
            $('html').addClass('navigation--is-visible');
        }
    });

    $('.wrapper').bind('click', function(e) {
        if ($('html').hasClass('navigation--is-visible')) {

            e.preventDefault();
            e.stopPropagation();

            $('#page').css('height', '');
            $('html').removeClass('navigation--is-visible');
        }
    });
    // }


    // Mega Menu Slider Size
    $('.nav--main  .nav__item').on('hover', function() {
        $(this).parent().find('.js-pixslider').each(function() {
            var slider = $(this).data('royalSlider');
            slider.updateSliderSize();
        });
    });

};

function eventHandlers(){};




/* ====== ON DOCUMENT READY ====== */

$(function(){

    /* --- INITIALIZE --- */
    init();

    /* --- CONDITIONAL LOADING --- */
    loadUp();

    setTimeout(function(){
        $('html').addClass('document-ready');
    }, 300);
});



/* ====== ON WINDOW LOAD ====== */

$(window).load(function(){
    popularPostsWidget();
});




/* ====== ON RESIZE ====== */

$(window).on("debouncedresize", function(e){
    resizeVideos();
    slider_billboard();
});



/* ====== ON SCROLL ======  */

//$(window).scroll(function(e){});

// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel

// MIT license

(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
                                   || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

// returns the depth of the element "e" relative to element with id=id
// for this calculation only parents with classname = waypoint are considered
function getLevelDepth(e, id, waypoint, cnt) {
	cnt = cnt || 0;
	if (e.id.indexOf(id) >= 0) return cnt;
	if ($(e).hasClass(waypoint)) {
		++cnt;
	}
	return e.parentNode && getLevelDepth(e.parentNode, id, waypoint, cnt);
}

// returns the closest element to 'e' that has class "classname"
function closest(e, classname) {
	if ($(e).hasClass(classname)) {
		return e;
	}
	return e.parentNode && closest(e.parentNode, classname);
}

})(jQuery, window);
// /* ====== HELPER FUNCTIONS ====== */

//similar to PHP's empty function
function empty(data) {
	if (typeof(data) == 'number' || typeof(data) == 'boolean') {
		return false;
	}
	if (typeof(data) == 'undefined' || data === null) {
		return true;
	}
	if (typeof(data.length) != 'undefined') {
		return data.length === 0;
	}
	var count = 0;
	for (var i in data) {
		// if(data.hasOwnProperty(i))
		//
		// This doesn't work in ie8/ie9 due the fact that hasOwnProperty works only on native objects.
		// http://stackoverflow.com/questions/8157700/object-has-no-hasownproperty-method-i-e-its-undefined-ie8
		//
		// for hosts objects we do this
		if (Object.prototype.hasOwnProperty.call(data, i)) {
			count++;
		}
	}
	return count === 0;
}

function extend(a, b) {
	for (var key in b) {
		if (b.hasOwnProperty(key)) {
			a[key] = b[key];
		}
	}
	return a;
}

// taken from https://github.com/inuyaksa/jquery.nicescroll/blob/master/jquery.nicescroll.js
function hasParent(e, id) {
	if (!e) return false;
	var el = e.target || e.srcElement || e || false;
	while (el && el.id != id) {
		el = el.parentNode || false;
	}
	return (el !== false);
}

function mobilecheck() {
	var check = false;
	(function (a) {
		if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))check = true;
	})(navigator.userAgent || navigator.vendor || window.opera);
	return check;
}

/* --- Set Query Parameter--- */
function setQueryParameter(uri, key, value) {
	var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
	separator = uri.indexOf('?') !== -1 ? "&" : "?";
	if (uri.match(re)) {
		return uri.replace(re, '$1' + key + "=" + value + '$2');
	}
	else {
		return uri + separator + key + "=" + value;
	}
}

function resizeVideos() {

	var videos = jQuery('iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="vimeo.com"], video');

	videos.each(function() {
		var video = jQuery(this),
				ratio = video.data('aspectRatio'),
				w = video.css('width', '100%').width(),
				h = w/ratio;
		video.height(h);
	});
}
/* Polyfill to remove click delays on browsers with touch UIs.
 @version 0.6.7
 @codingstandard ftlabs-jsv2
 @copyright The Financial Times Limited [All Rights Reserved]
 @license MIT License (see LICENSE.txt)
 */
function FastClick(a){var b,c=this;this.trackingClick=!1;this.trackingClickStart=0;this.targetElement=null;this.lastTouchIdentifier=this.touchStartY=this.touchStartX=0;this.layer=a;if(!a||!a.nodeType)throw new TypeError("Layer must be a document node");this.onClick=function(){return FastClick.prototype.onClick.apply(c,arguments)};this.onMouse=function(){return FastClick.prototype.onMouse.apply(c,arguments)};this.onTouchStart=function(){return FastClick.prototype.onTouchStart.apply(c,arguments)};this.onTouchEnd=
    function(){return FastClick.prototype.onTouchEnd.apply(c,arguments)};this.onTouchCancel=function(){return FastClick.prototype.onTouchCancel.apply(c,arguments)};FastClick.notNeeded(a)||(this.deviceIsAndroid&&(a.addEventListener("mouseover",this.onMouse,!0),a.addEventListener("mousedown",this.onMouse,!0),a.addEventListener("mouseup",this.onMouse,!0)),a.addEventListener("click",this.onClick,!0),a.addEventListener("touchstart",this.onTouchStart,!1),a.addEventListener("touchend",this.onTouchEnd,!1),a.addEventListener("touchcancel",
    this.onTouchCancel,!1),Event.prototype.stopImmediatePropagation||(a.removeEventListener=function(d,b,c){var e=Node.prototype.removeEventListener;"click"===d?e.call(a,d,b.hijacked||b,c):e.call(a,d,b,c)},a.addEventListener=function(b,c,f){var e=Node.prototype.addEventListener;"click"===b?e.call(a,b,c.hijacked||(c.hijacked=function(a){a.propagationStopped||c(a)}),f):e.call(a,b,c,f)}),"function"===typeof a.onclick&&(b=a.onclick,a.addEventListener("click",function(a){b(a)},!1),a.onclick=null))}
FastClick.prototype.deviceIsAndroid=0<navigator.userAgent.indexOf("Android");FastClick.prototype.deviceIsIOS=/iP(ad|hone|od)/.test(navigator.userAgent);FastClick.prototype.deviceIsIOS4=FastClick.prototype.deviceIsIOS&&/OS 4_\d(_\d)?/.test(navigator.userAgent);FastClick.prototype.deviceIsIOSWithBadTarget=FastClick.prototype.deviceIsIOS&&/OS ([6-9]|\d{2})_\d/.test(navigator.userAgent);
FastClick.prototype.needsClick=function(a){switch(a.nodeName.toLowerCase()){case "button":case "select":case "textarea":if(a.disabled)return!0;break;case "input":if(this.deviceIsIOS&&"file"===a.type||a.disabled)return!0;break;case "label":case "video":return!0}return/\bneedsclick\b/.test(a.className)};
FastClick.prototype.needsFocus=function(a){switch(a.nodeName.toLowerCase()){case "textarea":case "select":return!0;case "input":switch(a.type){case "button":case "checkbox":case "file":case "image":case "radio":case "submit":return!1}return!a.disabled&&!a.readOnly;default:return/\bneedsfocus\b/.test(a.className)}};
FastClick.prototype.sendClick=function(a,b){var c,d;document.activeElement&&document.activeElement!==a&&document.activeElement.blur();d=b.changedTouches[0];c=document.createEvent("MouseEvents");c.initMouseEvent("click",!0,!0,window,1,d.screenX,d.screenY,d.clientX,d.clientY,!1,!1,!1,!1,0,null);c.forwardedTouchEvent=!0;a.dispatchEvent(c)};FastClick.prototype.focus=function(a){var b;this.deviceIsIOS&&a.setSelectionRange?(b=a.value.length,a.setSelectionRange(b,b)):a.focus()};
FastClick.prototype.updateScrollParent=function(a){var b,c;b=a.fastClickScrollParent;if(!b||!b.contains(a)){c=a;do{if(c.scrollHeight>c.offsetHeight){b=c;a.fastClickScrollParent=c;break}c=c.parentElement}while(c)}b&&(b.fastClickLastScrollTop=b.scrollTop)};FastClick.prototype.getTargetElementFromEventTarget=function(a){return a.nodeType===Node.TEXT_NODE?a.parentNode:a};
FastClick.prototype.onTouchStart=function(a){var b,c,d;if(1<a.targetTouches.length)return!0;b=this.getTargetElementFromEventTarget(a.target);c=a.targetTouches[0];if(this.deviceIsIOS){d=window.getSelection();if(d.rangeCount&&!d.isCollapsed)return!0;if(!this.deviceIsIOS4){if(c.identifier===this.lastTouchIdentifier)return a.preventDefault(),!1;this.lastTouchIdentifier=c.identifier;this.updateScrollParent(b)}}this.trackingClick=!0;this.trackingClickStart=a.timeStamp;this.targetElement=b;this.touchStartX=
    c.pageX;this.touchStartY=c.pageY;200>a.timeStamp-this.lastClickTime&&a.preventDefault();return!0};FastClick.prototype.touchHasMoved=function(a){a=a.changedTouches[0];return 10<Math.abs(a.pageX-this.touchStartX)||10<Math.abs(a.pageY-this.touchStartY)?!0:!1};FastClick.prototype.findControl=function(a){return void 0!==a.control?a.control:a.htmlFor?document.getElementById(a.htmlFor):a.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")};
FastClick.prototype.onTouchEnd=function(a){var b,c,d;d=this.targetElement;this.touchHasMoved(a)&&(this.trackingClick=!1,this.targetElement=null);if(!this.trackingClick)return!0;if(200>a.timeStamp-this.lastClickTime)return this.cancelNextClick=!0;this.lastClickTime=a.timeStamp;b=this.trackingClickStart;this.trackingClick=!1;this.trackingClickStart=0;this.deviceIsIOSWithBadTarget&&(d=a.changedTouches[0],d=document.elementFromPoint(d.pageX-window.pageXOffset,d.pageY-window.pageYOffset));c=d.tagName.toLowerCase();
    if("label"===c){if(b=this.findControl(d)){this.focus(d);if(this.deviceIsAndroid)return!1;d=b}}else if(this.needsFocus(d)){if(100<a.timeStamp-b||this.deviceIsIOS&&window.top!==window&&"input"===c)return this.targetElement=null,!1;this.focus(d);if(!this.deviceIsIOS4||"select"!==c)this.targetElement=null,a.preventDefault();return!1}if(this.deviceIsIOS&&!this.deviceIsIOS4&&(b=d.fastClickScrollParent)&&b.fastClickLastScrollTop!==b.scrollTop)return!0;this.needsClick(d)||(a.preventDefault(),this.sendClick(d,
        a));return!1};FastClick.prototype.onTouchCancel=function(){this.trackingClick=!1;this.targetElement=null};FastClick.prototype.onMouse=function(a){return!this.targetElement||a.forwardedTouchEvent||!a.cancelable?!0:!this.needsClick(this.targetElement)||this.cancelNextClick?(a.stopImmediatePropagation?a.stopImmediatePropagation():a.propagationStopped=!0,a.stopPropagation(),a.preventDefault(),!1):!0};
FastClick.prototype.onClick=function(a){if(this.trackingClick)return this.targetElement=null,this.trackingClick=!1,!0;if("submit"===a.target.type&&0===a.detail)return!0;a=this.onMouse(a);a||(this.targetElement=null);return a};
FastClick.prototype.destroy=function(){var a=this.layer;this.deviceIsAndroid&&(a.removeEventListener("mouseover",this.onMouse,!0),a.removeEventListener("mousedown",this.onMouse,!0),a.removeEventListener("mouseup",this.onMouse,!0));a.removeEventListener("click",this.onClick,!0);a.removeEventListener("touchstart",this.onTouchStart,!1);a.removeEventListener("touchend",this.onTouchEnd,!1);a.removeEventListener("touchcancel",this.onTouchCancel,!1)};
FastClick.notNeeded=function(a){var b;if("undefined"===typeof window.ontouchstart)return!0;if(/Chrome\/[0-9]+/.test(navigator.userAgent))if(FastClick.prototype.deviceIsAndroid){if((b=document.querySelector("meta[name=viewport]"))&&-1!==b.content.indexOf("user-scalable=no"))return!0}else return!0;return"none"===a.style.msTouchAction?!0:!1};FastClick.attach=function(a){return new FastClick(a)};
"undefined"!==typeof define&&define.amd?define(function(){return FastClick}):"undefined"!==typeof module&&module.exports?(module.exports=FastClick.attach,module.exports.FastClick=FastClick):window.FastClick=FastClick;
/* hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license.
 * Copyright 2007, 2013 Brian Cherne
 */
(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:100,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery);
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 *
 * Open source under the BSD License.
 *
 * Copyright Â© 2008 George McGinley Smith
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list
 * of conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 *
 * Neither the name of the author nor the names of contributors may be used to endorse
 * or promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return -c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1){return c/2*t*t+b;}return -c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1){return c/2*t*t*t+b;}return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return -c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1){return c/2*t*t*t*t+b;}return -c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1){return c/2*t*t*t*t*t+b;}return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return -c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return -c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0){return b;}if(t==d){return b+c;}if((t/=d/2)<1){return c/2*Math.pow(2,10*(t-1))+b;}return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return -c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1){return -c/2*(Math.sqrt(1-t*t)-1)+b;}return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0){return b;}if((t/=d)==1){return b+c;}if(!p){p=d*0.3;}if(a<Math.abs(c)){a=c;var s=p/4;}else{var s=p/(2*Math.PI)*Math.asin(c/a);}return -(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0){return b;}if((t/=d)==1){return b+c;}if(!p){p=d*0.3;}if(a<Math.abs(c)){a=c;var s=p/4;}else{var s=p/(2*Math.PI)*Math.asin(c/a);}return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0){return b;}if((t/=d/2)==2){return b+c;}if(!p){p=d*(0.3*1.5);}if(a<Math.abs(c)){a=c;var s=p/4;}else{var s=p/(2*Math.PI)*Math.asin(c/a);}if(t<1){return -0.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;}return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*0.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined){s=1.70158;}return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined){s=1.70158;}return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined){s=1.70158;}if((t/=d/2)<1){return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;}return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else{if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+0.75)+b;}else{if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+0.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+0.984375)+b;}}}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2){return jQuery.easing.easeInBounce(x,t*2,0,c,d)*0.5+b;}return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*0.5+c*0.5+b;}});
// Magnific Popup v0.9.9 by Dmitry Semenov
// http://bit.ly/magnific-popup#build=image+ajax+iframe+gallery+retina+fastclick
// MIT License
(function(a){var b="Close",c="BeforeClose",d="AfterClose",e="BeforeAppend",f="MarkupParse",g="Open",h="Change",i="mfp",j="."+i,k="mfp-ready",l="mfp-removing",m="mfp-prevent-close",n,o=function(){},p=!!window.jQuery,q,r=a(window),s,t,u,v,w,x=function(a,b){n.ev.on(i+a+j,b)},y=function(b,c,d,e){var f=document.createElement("div");return f.className="mfp-"+b,d&&(f.innerHTML=d),e?c&&c.appendChild(f):(f=a(f),c&&f.appendTo(c)),f},z=function(b,c){n.ev.triggerHandler(i+b,c),n.st.callbacks&&(b=b.charAt(0).toLowerCase()+b.slice(1),n.st.callbacks[b]&&n.st.callbacks[b].apply(n,a.isArray(c)?c:[c]))},A=function(b){if(b!==w||!n.currTemplate.closeBtn)n.currTemplate.closeBtn=a(n.st.closeMarkup.replace("%title%",n.st.tClose)),w=b;return n.currTemplate.closeBtn},B=function(){a.magnificPopup.instance||(n=new o,n.init(),a.magnificPopup.instance=n)},C=function(){var a=document.createElement("p").style,b=["ms","O","Moz","Webkit"];if(a.transition!==undefined)return!0;while(b.length)if(b.pop()+"Transition"in a)return!0;return!1};o.prototype={constructor:o,init:function(){var b=navigator.appVersion;n.isIE7=b.indexOf("MSIE 7.")!==-1,n.isIE8=b.indexOf("MSIE 8.")!==-1,n.isLowIE=n.isIE7||n.isIE8,n.isAndroid=/android/gi.test(b),n.isIOS=/iphone|ipad|ipod/gi.test(b),n.supportsTransition=C(),n.probablyMobile=n.isAndroid||n.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),t=a(document),n.popupsCache={}},open:function(b){s||(s=a(document.body));var c;if(b.isObj===!1){n.items=b.items.toArray(),n.index=0;var d=b.items,e;for(c=0;c<d.length;c++){e=d[c],e.parsed&&(e=e.el[0]);if(e===b.el[0]){n.index=c;break}}}else n.items=a.isArray(b.items)?b.items:[b.items],n.index=b.index||0;if(n.isOpen){n.updateItemHTML();return}n.types=[],v="",b.mainEl&&b.mainEl.length?n.ev=b.mainEl.eq(0):n.ev=t,b.key?(n.popupsCache[b.key]||(n.popupsCache[b.key]={}),n.currTemplate=n.popupsCache[b.key]):n.currTemplate={},n.st=a.extend(!0,{},a.magnificPopup.defaults,b),n.fixedContentPos=n.st.fixedContentPos==="auto"?!n.probablyMobile:n.st.fixedContentPos,n.st.modal&&(n.st.closeOnContentClick=!1,n.st.closeOnBgClick=!1,n.st.showCloseBtn=!1,n.st.enableEscapeKey=!1),n.bgOverlay||(n.bgOverlay=y("bg").on("click"+j,function(){n.close()}),n.wrap=y("wrap").attr("tabindex",-1).on("click"+j,function(a){n._checkIfClose(a.target)&&n.close()}),n.container=y("container",n.wrap)),n.contentContainer=y("content"),n.st.preloader&&(n.preloader=y("preloader",n.container,n.st.tLoading));var h=a.magnificPopup.modules;for(c=0;c<h.length;c++){var i=h[c];i=i.charAt(0).toUpperCase()+i.slice(1),n["init"+i].call(n)}z("BeforeOpen"),n.st.showCloseBtn&&(n.st.closeBtnInside?(x(f,function(a,b,c,d){c.close_replaceWith=A(d.type)}),v+=" mfp-close-btn-in"):n.wrap.append(A())),n.st.alignTop&&(v+=" mfp-align-top"),n.fixedContentPos?n.wrap.css({overflow:n.st.overflowY,overflowX:"hidden",overflowY:n.st.overflowY}):n.wrap.css({top:r.scrollTop(),position:"absolute"}),(n.st.fixedBgPos===!1||n.st.fixedBgPos==="auto"&&!n.fixedContentPos)&&n.bgOverlay.css({height:t.height(),position:"absolute"}),n.st.enableEscapeKey&&t.on("keyup"+j,function(a){a.keyCode===27&&n.close()}),r.on("resize"+j,function(){n.updateSize()}),n.st.closeOnContentClick||(v+=" mfp-auto-cursor"),v&&n.wrap.addClass(v);var l=n.wH=r.height(),m={};if(n.fixedContentPos&&n._hasScrollBar(l)){var o=n._getScrollbarSize();o&&(m.marginRight=o)}n.fixedContentPos&&(n.isIE7?a("body, html").css("overflow","hidden"):m.overflow="hidden");var p=n.st.mainClass;return n.isIE7&&(p+=" mfp-ie7"),p&&n._addClassToMFP(p),n.updateItemHTML(),z("BuildControls"),a("html").css(m),n.bgOverlay.add(n.wrap).prependTo(n.st.prependTo||s),n._lastFocusedEl=document.activeElement,setTimeout(function(){n.content?(n._addClassToMFP(k),n._setFocus()):n.bgOverlay.addClass(k),t.on("focusin"+j,n._onFocusIn)},16),n.isOpen=!0,n.updateSize(l),z(g),b},close:function(){if(!n.isOpen)return;z(c),n.isOpen=!1,n.st.removalDelay&&!n.isLowIE&&n.supportsTransition?(n._addClassToMFP(l),setTimeout(function(){n._close()},n.st.removalDelay)):n._close()},_close:function(){z(b);var c=l+" "+k+" ";n.bgOverlay.detach(),n.wrap.detach(),n.container.empty(),n.st.mainClass&&(c+=n.st.mainClass+" "),n._removeClassFromMFP(c);if(n.fixedContentPos){var e={marginRight:""};n.isIE7?a("body, html").css("overflow",""):e.overflow="",a("html").css(e)}t.off("keyup"+j+" focusin"+j),n.ev.off(j),n.wrap.attr("class","mfp-wrap").removeAttr("style"),n.bgOverlay.attr("class","mfp-bg"),n.container.attr("class","mfp-container"),n.st.showCloseBtn&&(!n.st.closeBtnInside||n.currTemplate[n.currItem.type]===!0)&&n.currTemplate.closeBtn&&n.currTemplate.closeBtn.detach(),n._lastFocusedEl&&a(n._lastFocusedEl).focus(),n.currItem=null,n.content=null,n.currTemplate=null,n.prevHeight=0,z(d)},updateSize:function(a){if(n.isIOS){var b=document.documentElement.clientWidth/window.innerWidth,c=window.innerHeight*b;n.wrap.css("height",c),n.wH=c}else n.wH=a||r.height();n.fixedContentPos||n.wrap.css("height",n.wH),z("Resize")},updateItemHTML:function(){var b=n.items[n.index];n.contentContainer.detach(),n.content&&n.content.detach(),b.parsed||(b=n.parseEl(n.index));var c=b.type;z("BeforeChange",[n.currItem?n.currItem.type:"",c]),n.currItem=b;if(!n.currTemplate[c]){var d=n.st[c]?n.st[c].markup:!1;z("FirstMarkupParse",d),d?n.currTemplate[c]=a(d):n.currTemplate[c]=!0}u&&u!==b.type&&n.container.removeClass("mfp-"+u+"-holder");var e=n["get"+c.charAt(0).toUpperCase()+c.slice(1)](b,n.currTemplate[c]);n.appendContent(e,c),b.preloaded=!0,z(h,b),u=b.type,n.container.prepend(n.contentContainer),z("AfterChange")},appendContent:function(a,b){n.content=a,a?n.st.showCloseBtn&&n.st.closeBtnInside&&n.currTemplate[b]===!0?n.content.find(".mfp-close").length||n.content.append(A()):n.content=a:n.content="",z(e),n.container.addClass("mfp-"+b+"-holder"),n.contentContainer.append(n.content)},parseEl:function(b){var c=n.items[b],d;c.tagName?c={el:a(c)}:(d=c.type,c={data:c,src:c.src});if(c.el){var e=n.types;for(var f=0;f<e.length;f++)if(c.el.hasClass("mfp-"+e[f])){d=e[f];break}c.src=c.el.attr("data-mfp-src"),c.src||(c.src=c.el.attr("href"))}return c.type=d||n.st.type||"inline",c.index=b,c.parsed=!0,n.items[b]=c,z("ElementParse",c),n.items[b]},addGroup:function(a,b){var c=function(c){c.mfpEl=this,n._openClick(c,a,b)};b||(b={});var d="click.magnificPopup";b.mainEl=a,b.items?(b.isObj=!0,a.off(d).on(d,c)):(b.isObj=!1,b.delegate?a.off(d).on(d,b.delegate,c):(b.items=a,a.off(d).on(d,c)))},_openClick:function(b,c,d){var e=d.midClick!==undefined?d.midClick:a.magnificPopup.defaults.midClick;if(!e&&(b.which===2||b.ctrlKey||b.metaKey))return;var f=d.disableOn!==undefined?d.disableOn:a.magnificPopup.defaults.disableOn;if(f)if(a.isFunction(f)){if(!f.call(n))return!0}else if(r.width()<f)return!0;b.type&&(b.preventDefault(),n.isOpen&&b.stopPropagation()),d.el=a(b.mfpEl),d.delegate&&(d.items=c.find(d.delegate)),n.open(d)},updateStatus:function(a,b){if(n.preloader){q!==a&&n.container.removeClass("mfp-s-"+q),!b&&a==="loading"&&(b=n.st.tLoading);var c={status:a,text:b};z("UpdateStatus",c),a=c.status,b=c.text,n.preloader.html(b),n.preloader.find("a").on("click",function(a){a.stopImmediatePropagation()}),n.container.addClass("mfp-s-"+a),q=a}},_checkIfClose:function(b){if(a(b).hasClass(m))return;var c=n.st.closeOnContentClick,d=n.st.closeOnBgClick;if(c&&d)return!0;if(!n.content||a(b).hasClass("mfp-close")||n.preloader&&b===n.preloader[0])return!0;if(b!==n.content[0]&&!a.contains(n.content[0],b)){if(d&&a.contains(document,b))return!0}else if(c)return!0;return!1},_addClassToMFP:function(a){n.bgOverlay.addClass(a),n.wrap.addClass(a)},_removeClassFromMFP:function(a){this.bgOverlay.removeClass(a),n.wrap.removeClass(a)},_hasScrollBar:function(a){return(n.isIE7?t.height():document.body.scrollHeight)>(a||r.height())},_setFocus:function(){(n.st.focus?n.content.find(n.st.focus).eq(0):n.wrap).focus()},_onFocusIn:function(b){if(b.target!==n.wrap[0]&&!a.contains(n.wrap[0],b.target))return n._setFocus(),!1},_parseMarkup:function(b,c,d){var e;d.data&&(c=a.extend(d.data,c)),z(f,[b,c,d]),a.each(c,function(a,c){if(c===undefined||c===!1)return!0;e=a.split("_");if(e.length>1){var d=b.find(j+"-"+e[0]);if(d.length>0){var f=e[1];f==="replaceWith"?d[0]!==c[0]&&d.replaceWith(c):f==="img"?d.is("img")?d.attr("src",c):d.replaceWith('<img src="'+c+'" class="'+d.attr("class")+'" />'):d.attr(e[1],c)}}else b.find(j+"-"+a).html(c)})},_getScrollbarSize:function(){if(n.scrollbarSize===undefined){var a=document.createElement("div");a.id="mfp-sbm",a.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(a),n.scrollbarSize=a.offsetWidth-a.clientWidth,document.body.removeChild(a)}return n.scrollbarSize}},a.magnificPopup={instance:null,proto:o.prototype,modules:[],open:function(b,c){return B(),b?b=a.extend(!0,{},b):b={},b.isObj=!0,b.index=c||0,this.instance.open(b)},close:function(){return a.magnificPopup.instance&&a.magnificPopup.instance.close()},registerModule:function(b,c){c.options&&(a.magnificPopup.defaults[b]=c.options),a.extend(this.proto,c.proto),this.modules.push(b)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},a.fn.magnificPopup=function(b){B();var c=a(this);if(typeof b=="string")if(b==="open"){var d,e=p?c.data("magnificPopup"):c[0].magnificPopup,f=parseInt(arguments[1],10)||0;e.items?d=e.items[f]:(d=c,e.delegate&&(d=d.find(e.delegate)),d=d.eq(f)),n._openClick({mfpEl:d},c,e)}else n.isOpen&&n[b].apply(n,Array.prototype.slice.call(arguments,1));else b=a.extend(!0,{},b),p?c.data("magnificPopup",b):c[0].magnificPopup=b,n.addGroup(c,b);return c};var D="ajax",E,F=function(){E&&s.removeClass(E)},G=function(){F(),n.req&&n.req.abort()};a.magnificPopup.registerModule(D,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){n.types.push(D),E=n.st.ajax.cursor,x(b+"."+D,G),x("BeforeChange."+D,G)},getAjax:function(b){E&&s.addClass(E),n.updateStatus("loading");var c=a.extend({url:b.src,success:function(c,d,e){var f={data:c,xhr:e};z("ParseAjax",f),n.appendContent(a(f.data),D),b.finished=!0,F(),n._setFocus(),setTimeout(function(){n.wrap.addClass(k)},16),n.updateStatus("ready"),z("AjaxContentAdded")},error:function(){F(),b.finished=b.loadError=!0,n.updateStatus("error",n.st.ajax.tError.replace("%url%",b.src))}},n.st.ajax.settings);return n.req=a.ajax(c),""}}});var H,I=function(b){if(b.data&&b.data.title!==undefined)return b.data.title;var c=n.st.image.titleSrc;if(c){if(a.isFunction(c))return c.call(n,b);if(b.el)return b.el.attr(c)||""}return""};a.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var a=n.st.image,c=".image";n.types.push("image"),x(g+c,function(){n.currItem.type==="image"&&a.cursor&&s.addClass(a.cursor)}),x(b+c,function(){a.cursor&&s.removeClass(a.cursor),r.off("resize"+j)}),x("Resize"+c,n.resizeImage),n.isLowIE&&x("AfterChange",n.resizeImage)},resizeImage:function(){var a=n.currItem;if(!a||!a.img)return;if(n.st.image.verticalFit){var b=0;n.isLowIE&&(b=parseInt(a.img.css("padding-top"),10)+parseInt(a.img.css("padding-bottom"),10)),a.img.css("max-height",n.wH-b)}},_onImageHasSize:function(a){a.img&&(a.hasSize=!0,H&&clearInterval(H),a.isCheckingImgSize=!1,z("ImageHasSize",a),a.imgHidden&&(n.content&&n.content.removeClass("mfp-loading"),a.imgHidden=!1))},findImageSize:function(a){var b=0,c=a.img[0],d=function(e){H&&clearInterval(H),H=setInterval(function(){if(c.naturalWidth>0){n._onImageHasSize(a);return}b>200&&clearInterval(H),b++,b===3?d(10):b===40?d(50):b===100&&d(500)},e)};d(1)},getImage:function(b,c){var d=0,e=function(){b&&(b.img[0].complete?(b.img.off(".mfploader"),b===n.currItem&&(n._onImageHasSize(b),n.updateStatus("ready")),b.hasSize=!0,b.loaded=!0,z("ImageLoadComplete")):(d++,d<200?setTimeout(e,100):f()))},f=function(){b&&(b.img.off(".mfploader"),b===n.currItem&&(n._onImageHasSize(b),n.updateStatus("error",g.tError.replace("%url%",b.src))),b.hasSize=!0,b.loaded=!0,b.loadError=!0)},g=n.st.image,h=c.find(".mfp-img");if(h.length){var i=document.createElement("img");i.className="mfp-img",b.img=a(i).on("load.mfploader",e).on("error.mfploader",f),i.src=b.src,h.is("img")&&(b.img=b.img.clone()),i=b.img[0],i.naturalWidth>0?b.hasSize=!0:i.width||(b.hasSize=!1)}return n._parseMarkup(c,{title:I(b),img_replaceWith:b.img},b),n.resizeImage(),b.hasSize?(H&&clearInterval(H),b.loadError?(c.addClass("mfp-loading"),n.updateStatus("error",g.tError.replace("%url%",b.src))):(c.removeClass("mfp-loading"),n.updateStatus("ready")),c):(n.updateStatus("loading"),b.loading=!0,b.hasSize||(b.imgHidden=!0,c.addClass("mfp-loading"),n.findImageSize(b)),c)}}});var J,K=function(){return J===undefined&&(J=document.createElement("p").style.MozTransform!==undefined),J};a.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(a){return a.is("img")?a:a.find("img")}},proto:{initZoom:function(){var a=n.st.zoom,d=".zoom",e;if(!a.enabled||!n.supportsTransition)return;var f=a.duration,g=function(b){var c=b.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),d="all "+a.duration/1e3+"s "+a.easing,e={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},f="transition";return e["-webkit-"+f]=e["-moz-"+f]=e["-o-"+f]=e[f]=d,c.css(e),c},h=function(){n.content.css("visibility","visible")},i,j;x("BuildControls"+d,function(){if(n._allowZoom()){clearTimeout(i),n.content.css("visibility","hidden"),e=n._getItemToZoom();if(!e){h();return}j=g(e),j.css(n._getOffset()),n.wrap.append(j),i=setTimeout(function(){j.css(n._getOffset(!0)),i=setTimeout(function(){h(),setTimeout(function(){j.remove(),e=j=null,z("ZoomAnimationEnded")},16)},f)},16)}}),x(c+d,function(){if(n._allowZoom()){clearTimeout(i),n.st.removalDelay=f;if(!e){e=n._getItemToZoom();if(!e)return;j=g(e)}j.css(n._getOffset(!0)),n.wrap.append(j),n.content.css("visibility","hidden"),setTimeout(function(){j.css(n._getOffset())},16)}}),x(b+d,function(){n._allowZoom()&&(h(),j&&j.remove(),e=null)})},_allowZoom:function(){return n.currItem.type==="image"},_getItemToZoom:function(){return n.currItem.hasSize?n.currItem.img:!1},_getOffset:function(b){var c;b?c=n.currItem.img:c=n.st.zoom.opener(n.currItem.el||n.currItem);var d=c.offset(),e=parseInt(c.css("padding-top"),10),f=parseInt(c.css("padding-bottom"),10);d.top-=a(window).scrollTop()-e;var g={width:c.width(),height:(p?c.innerHeight():c[0].offsetHeight)-f-e};return K()?g["-moz-transform"]=g.transform="translate("+d.left+"px,"+d.top+"px)":(g.left=d.left,g.top=d.top),g}}});var L="iframe",M="//about:blank",N=function(a){if(n.currTemplate[L]){var b=n.currTemplate[L].find("iframe");b.length&&(a||(b[0].src=M),n.isIE8&&b.css("display",a?"block":"none"))}};a.magnificPopup.registerModule(L,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){n.types.push(L),x("BeforeChange",function(a,b,c){b!==c&&(b===L?N():c===L&&N(!0))}),x(b+"."+L,function(){N()})},getIframe:function(b,c){var d=b.src,e=n.st.iframe;a.each(e.patterns,function(){if(d.indexOf(this.index)>-1)return this.id&&(typeof this.id=="string"?d=d.substr(d.lastIndexOf(this.id)+this.id.length,d.length):d=this.id.call(this,d)),d=this.src.replace("%id%",d),!1});var f={};return e.srcAction&&(f[e.srcAction]=d),n._parseMarkup(c,f,b),n.updateStatus("ready"),c}}});var O=function(a){var b=n.items.length;return a>b-1?a-b:a<0?b+a:a},P=function(a,b,c){return a.replace(/%curr%/gi,b+1).replace(/%total%/gi,c)};a.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var c=n.st.gallery,d=".mfp-gallery",e=Boolean(a.fn.mfpFastClick);n.direction=!0;if(!c||!c.enabled)return!1;v+=" mfp-gallery",x(g+d,function(){c.navigateByImgClick&&n.wrap.on("click"+d,".mfp-img",function(){if(n.items.length>1)return n.next(),!1}),t.on("keydown"+d,function(a){a.keyCode===37?n.prev():a.keyCode===39&&n.next()})}),x("UpdateStatus"+d,function(a,b){b.text&&(b.text=P(b.text,n.currItem.index,n.items.length))}),x(f+d,function(a,b,d,e){var f=n.items.length;d.counter=f>1?P(c.tCounter,e.index,f):""}),x("BuildControls"+d,function(){if(n.items.length>1&&c.arrows&&!n.arrowLeft){var b=c.arrowMarkup,d=n.arrowLeft=a(b.replace(/%title%/gi,c.tPrev).replace(/%dir%/gi,"left")).addClass(m),f=n.arrowRight=a(b.replace(/%title%/gi,c.tNext).replace(/%dir%/gi,"right")).addClass(m),g=e?"mfpFastClick":"click";d[g](function(){n.prev()}),f[g](function(){n.next()}),n.isIE7&&(y("b",d[0],!1,!0),y("a",d[0],!1,!0),y("b",f[0],!1,!0),y("a",f[0],!1,!0)),n.container.append(d.add(f))}}),x(h+d,function(){n._preloadTimeout&&clearTimeout(n._preloadTimeout),n._preloadTimeout=setTimeout(function(){n.preloadNearbyImages(),n._preloadTimeout=null},16)}),x(b+d,function(){t.off(d),n.wrap.off("click"+d),n.arrowLeft&&e&&n.arrowLeft.add(n.arrowRight).destroyMfpFastClick(),n.arrowRight=n.arrowLeft=null})},next:function(){n.direction=!0,n.index=O(n.index+1),n.updateItemHTML()},prev:function(){n.direction=!1,n.index=O(n.index-1),n.updateItemHTML()},goTo:function(a){n.direction=a>=n.index,n.index=a,n.updateItemHTML()},preloadNearbyImages:function(){var a=n.st.gallery.preload,b=Math.min(a[0],n.items.length),c=Math.min(a[1],n.items.length),d;for(d=1;d<=(n.direction?c:b);d++)n._preloadItem(n.index+d);for(d=1;d<=(n.direction?b:c);d++)n._preloadItem(n.index-d)},_preloadItem:function(b){b=O(b);if(n.items[b].preloaded)return;var c=n.items[b];c.parsed||(c=n.parseEl(b)),z("LazyLoad",c),c.type==="image"&&(c.img=a('<img class="mfp-img" />').on("load.mfploader",function(){c.hasSize=!0}).on("error.mfploader",function(){c.hasSize=!0,c.loadError=!0,z("LazyLoadError",c)}).attr("src",c.src)),c.preloaded=!0}}});var Q="retina";a.magnificPopup.registerModule(Q,{options:{replaceSrc:function(a){return a.src.replace(/\.\w+$/,function(a){return"@2x"+a})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var a=n.st.retina,b=a.ratio;b=isNaN(b)?b():b,b>1&&(x("ImageHasSize."+Q,function(a,c){c.img.css({"max-width":c.img[0].naturalWidth/b,width:"100%"})}),x("ElementParse."+Q,function(c,d){d.src=a.replaceSrc(d,b)}))}}}}),function(){var b=1e3,c="ontouchstart"in window,d=function(){r.off("touchmove"+f+" touchend"+f)},e="mfpFastClick",f="."+e;a.fn.mfpFastClick=function(e){return a(this).each(function(){var g=a(this),h;if(c){var i,j,k,l,m,n;g.on("touchstart"+f,function(a){l=!1,n=1,m=a.originalEvent?a.originalEvent.touches[0]:a.touches[0],j=m.clientX,k=m.clientY,r.on("touchmove"+f,function(a){m=a.originalEvent?a.originalEvent.touches:a.touches,n=m.length,m=m[0];if(Math.abs(m.clientX-j)>10||Math.abs(m.clientY-k)>10)l=!0,d()}).on("touchend"+f,function(a){d();if(l||n>1)return;h=!0,a.preventDefault(),clearTimeout(i),i=setTimeout(function(){h=!1},b),e()})})}g.on("click"+f,function(){h||e()})})},a.fn.destroyMfpFastClick=function(){a(this).off("touchstart"+f+" click"+f),c&&r.off("touchmove"+f+" touchend"+f)}}(),B()})(window.jQuery||window.Zepto);
// --- MODIFIED
// https://github.com/CSS-Tricks/jQuery-Organic-Tabs
(function ($) {
$.organicTabs = function (el, options) {
    var base = this;
    base.$el = $(el);
    base.$nav = base.$el.find(".tabs__nav");
    base.init = function () {
        base.options = $.extend({}, $.organicTabs.defaultOptions, options);
        var $allListWrap = base.$el.find(".tabs__content"),
            curList = base.$el.find("a.current").attr("href").substring(1);
        $allListWrap.height(base.$el.find("#" + curList).height());

        base.$nav.find("li > a").click(function(event) {


            var curList = base.$el.find("a.current").attr("href").substring(1),
                $newList = $(this),
                listID = $newList.attr("href").substring(1);


            if ((listID != curList) && (base.$el.find(":animated").length == 0)) {
                base.$el.find("#" + curList).css({
                    opacity: 0,
                    "z-index": 10,
                    display: "none",
                    "pointer-events": "none"
                });

                setTimeout(function () {
                    base.$el.find("#" + curList);
                    base.$el.find("#" + listID).css({
                        opacity: 1,
                        "z-index": 100,
                        display: "block",
                        "pointer-events": "auto"
                    });
                    base.$el.find(".tabs__nav li a").removeClass("current");
                    $newList.addClass("current");

                    var $tabSlider = base.$el.find("#" + listID).find('.js-pixslider');
                    if($tabSlider.length) {
                        sliderUpdateSize($tabSlider);

                        setTimeout(function() {
                            var newHeight = base.$el.find("#" + listID).height();
                            $allListWrap.css({
                                height: newHeight
                            });
                        }, 200);
                    } else {
                        var newHeight = base.$el.find("#" + listID).height();
                        $allListWrap.css({
                            height: newHeight
                        });
                    }

                    resizeVideos();


                }, 250);
            }
            event.preventDefault();
        });
    };
    base.init();
};
$.organicTabs.defaultOptions = {
    speed: 300
};
$.fn.organicTabs = function (options) {
    return this.each(function () {
        (new $.organicTabs(this, options));
    });
};

})(jQuery);
/* --- $OVERTHROW --- */
/* Overthrow. An overflow:auto polyfill for responsive design.
 * (c) 2012: Scott Jehl, Filament Group, Inc.
 */
/* Detect */
(function(w,undefined){var doc=w.document,docElem=doc.documentElement,enabledClassName="overthrow-enabled",canBeFilledWithPoly="ontouchmove"in doc,nativeOverflow="WebkitOverflowScrolling"in docElem.style||("msOverflowStyle"in docElem.style||(!canBeFilledWithPoly&&w.screen.width>800||function(){var ua=w.navigator.userAgent,webkit=ua.match(/AppleWebKit\/([0-9]+)/),wkversion=webkit&&webkit[1],wkLte534=webkit&&wkversion>=534;return ua.match(/Android ([0-9]+)/)&&(RegExp.$1>=3&&wkLte534)||(ua.match(/ Version\/([0-9]+)/)&&
        (RegExp.$1>=0&&(w.blackberry&&wkLte534))||(ua.indexOf("PlayBook")>-1&&(wkLte534&&!ua.indexOf("Android 2")===-1)||(ua.match(/Firefox\/([0-9]+)/)&&RegExp.$1>=4||(ua.match(/wOSBrowser\/([0-9]+)/)&&(RegExp.$1>=233&&wkLte534)||ua.match(/NokiaBrowser\/([0-9\.]+)/)&&(parseFloat(RegExp.$1)===7.3&&(webkit&&wkversion>=533))))))}()));w.overthrow={};w.overthrow.enabledClassName=enabledClassName;w.overthrow.addClass=function(){if(docElem.className.indexOf(w.overthrow.enabledClassName)===-1)docElem.className+=
    " "+w.overthrow.enabledClassName};w.overthrow.removeClass=function(){docElem.className=docElem.className.replace(w.overthrow.enabledClassName,"")};w.overthrow.set=function(){if(nativeOverflow)w.overthrow.addClass()};w.overthrow.canBeFilledWithPoly=canBeFilledWithPoly;w.overthrow.forget=function(){w.overthrow.removeClass()};w.overthrow.support=nativeOverflow?"native":"none"})(this);

/* Polifyll */
(function(w,o,undefined){if(o===undefined)return;o.scrollIndicatorClassName="overthrow";var doc=w.document,docElem=doc.documentElement,nativeOverflow=o.support==="native",canBeFilledWithPoly=o.canBeFilledWithPoly,configure=o.configure,set=o.set,forget=o.forget,scrollIndicatorClassName=o.scrollIndicatorClassName;o.closest=function(target,ascend){return!ascend&&(target.className&&(target.className.indexOf(scrollIndicatorClassName)>-1&&target))||o.closest(target.parentNode)};var enabled=false;o.set=
    function(){set();if(enabled||(nativeOverflow||!canBeFilledWithPoly))return;w.overthrow.addClass();enabled=true;o.support="polyfilled";o.forget=function(){forget();enabled=false;if(doc.removeEventListener)doc.removeEventListener("touchstart",start,false)};var elem,lastTops=[],lastLefts=[],lastDown,lastRight,resetVertTracking=function(){lastTops=[];lastDown=null},resetHorTracking=function(){lastLefts=[];lastRight=null},inputs,setPointers=function(val){inputs=elem.querySelectorAll("textarea, input");
        for(var i=0,il=inputs.length;i<il;i++)inputs[i].style.pointerEvents=val},changeScrollTarget=function(startEvent,ascend){if(doc.createEvent){var newTarget=(!ascend||ascend===undefined)&&elem.parentNode||(elem.touchchild||elem),tEnd;if(newTarget!==elem){tEnd=doc.createEvent("HTMLEvents");tEnd.initEvent("touchend",true,true);elem.dispatchEvent(tEnd);newTarget.touchchild=elem;elem=newTarget;newTarget.dispatchEvent(startEvent)}}},start=function(e){if(o.intercept)o.intercept();resetVertTracking();resetHorTracking();
        elem=o.closest(e.target);if(!elem||(elem===docElem||e.touches.length>1))return;setPointers("none");var touchStartE=e,scrollT=elem.scrollTop,scrollL=elem.scrollLeft,height=elem.offsetHeight,width=elem.offsetWidth,startY=e.touches[0].pageY,startX=e.touches[0].pageX,scrollHeight=elem.scrollHeight,scrollWidth=elem.scrollWidth,move=function(e){var ty=scrollT+startY-e.touches[0].pageY,tx=scrollL+startX-e.touches[0].pageX,down=ty>=(lastTops.length?lastTops[0]:0),right=tx>=(lastLefts.length?lastLefts[0]:
                0);if(ty>0&&ty<scrollHeight-height||tx>0&&tx<scrollWidth-width)e.preventDefault();else changeScrollTarget(touchStartE);if(lastDown&&down!==lastDown)resetVertTracking();if(lastRight&&right!==lastRight)resetHorTracking();lastDown=down;lastRight=right;elem.scrollTop=ty;elem.scrollLeft=tx;lastTops.unshift(ty);lastLefts.unshift(tx);if(lastTops.length>3)lastTops.pop();if(lastLefts.length>3)lastLefts.pop()},end=function(e){setPointers("auto");setTimeout(function(){setPointers("none")},450);elem.removeEventListener("touchmove",
            move,false);elem.removeEventListener("touchend",end,false)};elem.addEventListener("touchmove",move,false);elem.addEventListener("touchend",end,false)};doc.addEventListener("touchstart",start,false)}})(this,this.overthrow);

/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas. Dual MIT/BSD license */
/*! NOTE: If you're already including a window.matchMedia polyfill via Modernizr or otherwise, you don't need this part */
window.matchMedia=window.matchMedia||function(a){"use strict";var c,d=a.documentElement,e=d.firstElementChild||d.firstChild,f=a.createElement("body"),g=a.createElement("div");return g.id="mq-test-1",g.style.cssText="position:absolute;top:-100em",f.style.background="none",f.appendChild(g),function(a){return g.innerHTML='&shy;<style media="'+a+'"> #mq-test-1 { width: 42px; }</style>',d.insertBefore(f,e),c=42===g.offsetWidth,d.removeChild(f),{matches:c,media:a}}}(document);

/*! Respond.js v1.3.0: min/max-width media query polyfill. (c) Scott Jehl. MIT/GPLv2 Lic. j.mp/respondjs  */
(function(a){"use strict";function x(){u(!0)}var b={};if(a.respond=b,b.update=function(){},b.mediaQueriesSupported=a.matchMedia&&a.matchMedia("only all").matches,!b.mediaQueriesSupported){var q,r,t,c=a.document,d=c.documentElement,e=[],f=[],g=[],h={},i=30,j=c.getElementsByTagName("head")[0]||d,k=c.getElementsByTagName("base")[0],l=j.getElementsByTagName("link"),m=[],n=function(){for(var b=0;l.length>b;b++){var c=l[b],d=c.href,e=c.media,f=c.rel&&"stylesheet"===c.rel.toLowerCase();d&&f&&!h[d]&&(c.styleSheet&&c.styleSheet.rawCssText?(p(c.styleSheet.rawCssText,d,e),h[d]=!0):(!/^([a-zA-Z:]*\/\/)/.test(d)&&!k||d.replace(RegExp.$1,"").split("/")[0]===a.location.host)&&m.push({href:d,media:e}))}o()},o=function(){if(m.length){var b=m.shift();v(b.href,function(c){p(c,b.href,b.media),h[b.href]=!0,a.setTimeout(function(){o()},0)})}},p=function(a,b,c){var d=a.match(/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi),g=d&&d.length||0;b=b.substring(0,b.lastIndexOf("/"));var h=function(a){return a.replace(/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,"$1"+b+"$2$3")},i=!g&&c;b.length&&(b+="/"),i&&(g=1);for(var j=0;g>j;j++){var k,l,m,n;i?(k=c,f.push(h(a))):(k=d[j].match(/@media *([^\{]+)\{([\S\s]+?)$/)&&RegExp.$1,f.push(RegExp.$2&&h(RegExp.$2))),m=k.split(","),n=m.length;for(var o=0;n>o;o++)l=m[o],e.push({media:l.split("(")[0].match(/(only\s+)?([a-zA-Z]+)\s?/)&&RegExp.$2||"all",rules:f.length-1,hasquery:l.indexOf("(")>-1,minw:l.match(/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:l.match(/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}u()},s=function(){var a,b=c.createElement("div"),e=c.body,f=!1;return b.style.cssText="position:absolute;font-size:1em;width:1em",e||(e=f=c.createElement("body"),e.style.background="none"),e.appendChild(b),d.insertBefore(e,d.firstChild),a=b.offsetWidth,f?d.removeChild(e):e.removeChild(b),a=t=parseFloat(a)},u=function(b){var h="clientWidth",k=d[h],m="CSS1Compat"===c.compatMode&&k||c.body[h]||k,n={},o=l[l.length-1],p=(new Date).getTime();if(b&&q&&i>p-q)return a.clearTimeout(r),r=a.setTimeout(u,i),void 0;q=p;for(var v in e)if(e.hasOwnProperty(v)){var w=e[v],x=w.minw,y=w.maxw,z=null===x,A=null===y,B="em";x&&(x=parseFloat(x)*(x.indexOf(B)>-1?t||s():1)),y&&(y=parseFloat(y)*(y.indexOf(B)>-1?t||s():1)),w.hasquery&&(z&&A||!(z||m>=x)||!(A||y>=m))||(n[w.media]||(n[w.media]=[]),n[w.media].push(f[w.rules]))}for(var C in g)g.hasOwnProperty(C)&&g[C]&&g[C].parentNode===j&&j.removeChild(g[C]);for(var D in n)if(n.hasOwnProperty(D)){var E=c.createElement("style"),F=n[D].join("\n");E.type="text/css",E.media=D,j.insertBefore(E,o.nextSibling),E.styleSheet?E.styleSheet.cssText=F:E.appendChild(c.createTextNode(F)),g.push(E)}},v=function(a,b){var c=w();c&&(c.open("GET",a,!0),c.onreadystatechange=function(){4!==c.readyState||200!==c.status&&304!==c.status||b(c.responseText)},4!==c.readyState&&c.send(null))},w=function(){var b=!1;try{b=new a.XMLHttpRequest}catch(c){b=new a.ActiveXObject("Microsoft.XMLHTTP")}return function(){return b}}();n(),b.update=n,a.addEventListener?a.addEventListener("resize",x,!1):a.attachEvent&&a.attachEvent("onresize",x)}})(this);
/*! Riloadr.js 1.5.0 (c) 2013 Tubal Martin - MIT license */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):window.Riloadr=a(jQuery)}(function(a){"use strict";function ib(b){function ib(){cb=ob(),_=jb(k,cb,K),db=_[D]&&lb(k,_[D]),eb=eb||G&&kb(k),fb=H&&mb(_,eb)}function rb(){var b,a=0;if((R||G)&&Ab(U,u,X),R&&(Ab(U,s,W),bb&&(hb=U[M],Ab(U,Q,Y)),B))for(;b=B[a];)Ab(V[O](b),s,W),a++}function sb(){var b,a=0;if(!G&&(Bb(U,u,X),R)){if(Bb(U,s,W),B)for(;b=B[a];)Bb(V[O](b),s,W),a++;bb&&Bb(U,Q,Y)}}function tb(a,b){a[y]=0,a[D]=h,a[v]=ub,a[w]=a[x]=xb,a[d]=pb(a,g,_),Z.splice(b,1)}function ub(){var c,e,a=this;"naturalWidth"in a?e=a.naturalWidth+a.naturalHeight:(c=new Image,c[d]=a[d],e=c[o]+c[q],c=j),+e>0&&(a[v]=a[w]=a[x]=j,a[C]&&(a[E]=a[E].replace(n,"$1$2")),R&&(a.style.visibility="visible"),v in b&&b[v][l](a),Eb())}function xb(){var f,a=this,c=function(b){var c=new Image;c[v]=function(){a[d]=c[d],ub[l](a)},c[w]=a[x]=function(){xb[l](a)},c[d]=b};a[v]=a[w]=a[x]=j,w in b&&b[w][l](a),a[y]<N?(a[y]++,f=pb(a,g,a[D]?db:_,e),c(f)):D in _&&!a[D]?(a[y]=0,a[D]=e,f=pb(a,g,db),c(f)):Eb()}function Eb(){$--,0===$&&(sb(),J in b&&b[J]())}var _,ab,eb,fb,c=this,g=b.base||p,k=b.breakpoints||zb('"breakpoints" not defined.'),m=b.name||"responsive",n=new RegExp("(^|\\s)"+m+"(\\s|$)"),t=b.defer&&("string"==typeof b.defer?{mode:b.defer,threshold:b.foldDistance,overflownElemsIds:[]}:b.defer),z=t&&t.mode.toLowerCase(),A=t&&t.threshold||100,B=t&&t.overflownElemsIds,F=b.watchViewportWidth,G=!!F,H="wider"==F,I="*"==F,K=b.ignoreLowBandwidth||h,N=b[y]||0,P=b.root||j,R=("invisible"==z||"belowfold"==z)&&!gb,W=vb(function(){c[L]()},i),X=wb(function(){G&&ib(),c[L](G)},i),Y=wb(function(){U[M]!==hb&&(hb=U[M],c[L]())},i),Z=[],$=0,db={};c[L]=function(b){yb(function(c,d){if(Z[r]&&b!==e||(b&&rb(),a("img."+m,P).each(function(a,b){b&&!b[C]&&((!G||G&&(!ab||H&&nb(_,ab)||I&&!mb(_,ab)))&&(Z.push(b),$++),(!G||fb)&&(b[C]=e))}),G&&(fb&&(G=h),ab=_)),Z[r])for(d=0;c=Z[d];)c&&(!R||R&&qb(c,A))&&(tb(c,d),d--),d++;c=j})},Cb(function(){S=a(U),T=V[f],P=P&&a("#"+P)||T,ib(),rb(),!z||R?c[L]():Db(c[L])})}function jb(a,b,c){for(var g,h,i,j,d=b,e=0,f={};g=a[e];)h=g[z],i=g[A],j=g[R],b>0?(h&&i&&b>=h&&i>=b||h&&!i&&b>=h||i&&!h&&i>=b)&&(!j||j&&eb>=j&&(c||!c&&!fb))&&(f=g):(0>=d||d>h||d>i)&&(d=h||i||d,f=g),e++;return f}function kb(a){for(var d,b=0,c={};d=a[b];)nb(d,c)&&(c=d),b++;return c}function lb(a,b){for(var d,c=0;d=a[c];){if(d.name==b)return d;c++}}function mb(a,b){return a.name===b.name&&a[z]===b[z]&&a[A]===b[A]&&a[R]===b[R]&&a[F]===b[F]}function nb(a,b){var c=+a[R]||1,d=+b[R]||1;return a=Math.max(+a[z]||0,+a[A]||0)*(eb>=c?c:1),b=Math.max(+b[z]||0,+b[A]||0)*(eb>=d?d:1),a>b}function ob(){for(var f,a=Math,b=[W.clientWidth,W.offsetWidth,T.clientWidth],c=a.ceil(db/eb),d=b[r],e=0;d>e;e++)isNaN(b[e])&&(b.splice(e,1),e--);return b[r]&&(f=a.max[m](a,b),isNaN(c)),f||c||0}function pb(a,b,c,d){var e=(a.getAttribute("data-base")||b)+(a.getAttribute("data-src")||a.getAttribute("data-src-"+c.name)||p);return c[F]&&(e=e.split("."),e.pop(),e=e.join(".")+"."+c[F]),d&&(e+=(_.test(e)?"&":"?")+"riloadrts="+(new Date).getTime()),e.replace(ab,c.name)}function fb(){var a=U.navigator,b=a.connection||a.mozConnection||a.webkitConnection||a.oConnection||a.msConnection||{},c=b.type||"unknown",d=+b.bandwidth||1/0;return d>0&&.1>d||/^[23]g|3|4$/.test(c+p)}function qb(b,c){var d=a(b);return!(rb(d,c)||sb(d,c)||tb(d,c)||ub(d,c))}function rb(a,b){return S[q]()+S[I]()<=a[t]()[c]-b}function sb(a,b){return S[I]()>=a[t]()[c]+b+a[q]()}function tb(a,b){return S[o]()+S[K]()<=a[t]()[g]-b}function ub(a,b){return S[K]()>=a[t]()[g]+b+a[o]()}function vb(a,b){function h(){g=new Date,f=j,a[m](e,c)}var c,d,e,f,g=0;return function(){var i=new Date,j=b-(i-g);return c=arguments,e=this,0>=j?(g=i,d=a[m](e,c)):f||(f=xb(h,j)),d}}function wb(a,b,c){function h(){g=j,c||a[m](f,d)}var d,e,f,g;return function(){var i=c&&!g;return d=arguments,f=this,clearTimeout(g),g=xb(h,b),i&&(e=a[m](f,d)),e}}function xb(a,b){var c=Array[G].slice[l](arguments,2);return U.setTimeout(function(){return a[m](j,c)},b)}function yb(a){return xb[m](j,[a,1].concat(Array[G].slice[l](arguments,1)))}function zb(a){throw new Error("Riloadr: "+a)}function Ab(a,b,c){a[Z](Y+b,c,h)}function Bb(a,b,c){a[$](Y+b,c,h)}function Cb(b){a(b)}function Db(a){if(V.readyState===B)a();else{var b=function(){Bb(U,k,b),a()};Ab(U,k,b)}}var S,T,cb,hb,b="on",c="top",d="src",e=!0,f="body",g="left",h=!1,i=250,j=null,k="load",l="call",m="apply",n="error",o="width",p="",q="height",r="length",s="scroll",t="offset",u="resize",v=b+k,w=b+n,x=b+"abort",y="retries",z="minWidth",A="maxWidth",B="complete",C="riloaded",D="fallback",E="className",F="imgFormat",G="prototype",I=s+"Top",J=b+B,K=s+"Left",L=k+"Images",M="orientation",N="EventListener",O="getElementById",P="add"+N,Q=M+"change",R="minDevicePixelRatio",U=window,V=U.document,W=V.documentElement,X=P in V,Y=X?p:b,Z=X?P:"attachEvent",$=X?"remove"+N:"detachEvent",_=/\?/,ab=/{breakpoint-name}/gi,bb=M in U&&b+Q in U,db=U.screen[o],eb=U.devicePixelRatio||1,fb=fb(),gb="[object OperaMini]"===Object[G].toString[l](U.operamini);return W[E]=W[E].replace(/(^|\s)no-js(\s|$)/,"$1$2"),ib.version="1.5.0",ib[G].riload=function(){this[L](e)},ib});
/*
 * Salvattore 1.0.5 by @rnmp and @ppold
 * https://github.com/rnmp/salvattore
 * Copyright (c) 2013-2014 Rolando Murillo and Giorgio Leveroni

 Permission is hereby granted, free of charge, to any person obtaining a copy of
 this software and associated documentation files (the "Software"), to deal in
 the Software without restriction, including without limitation the rights to
 use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 the Software, and to permit persons to whom the Software is furnished to do so,
 subject to the following conditions:

 The above copyright notice and this permission notice shall be included in all
 copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

 */
function salvattore(){(function(root, factory) {
    if(typeof exports === 'object') {
        module.exports = factory();
    }
    else if(typeof define === 'function' && define.amd) {
        define('salvattore', [], factory);
    }
    else {
        root.salvattore = factory();
    }
}(this, function() {
    /*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas, David Knight. Dual MIT/BSD license */

    window.matchMedia || (window.matchMedia = function() {
        "use strict";

        // For browsers that support matchMedium api such as IE 9 and webkit
        var styleMedia = (window.styleMedia || window.media);

        // For those that don't support matchMedium
        if (!styleMedia) {
            var style       = document.createElement('style'),
                script      = document.getElementsByTagName('script')[0],
                info        = null;

            style.type  = 'text/css';
            style.id    = 'matchmediajs-test';

            script.parentNode.insertBefore(style, script);

            // 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
            info = ('getComputedStyle' in window) && window.getComputedStyle(style, null) || style.currentStyle;

            styleMedia = {
                matchMedium: function(media) {
                    var text = '@media ' + media + '{ #matchmediajs-test { width: 1px; } }';

                    // 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
                    if (style.styleSheet) {
                        style.styleSheet.cssText = text;
                    } else {
                        style.textContent = text;
                    }

                    // Test if media query is true or false
                    return info.width === '1px';
                }
            };
        }

        return function(media) {
            return {
                matches: styleMedia.matchMedium(media || 'all'),
                media: media || 'all'
            };
        };
    }());
    ;/*! matchMedia() polyfill addListener/removeListener extension. Author & copyright (c) 2012: Scott Jehl. Dual MIT/BSD license */
    (function(){
        // Bail out for browsers that have addListener support
        if (window.matchMedia && window.matchMedia('all').addListener) {
            return false;
        }

        var localMatchMedia = window.matchMedia,
            hasMediaQueries = localMatchMedia('only all').matches,
            isListening     = false,
            timeoutID       = 0,    // setTimeout for debouncing 'handleChange'
            queries         = [],   // Contains each 'mql' and associated 'listeners' if 'addListener' is used
            handleChange    = function(evt) {
                // Debounce
                clearTimeout(timeoutID);

                timeoutID = setTimeout(function() {
                    for (var i = 0, il = queries.length; i < il; i++) {
                        var mql         = queries[i].mql,
                            listeners   = queries[i].listeners || [],
                            matches     = localMatchMedia(mql.media).matches;

                        // Update mql.matches value and call listeners
                        // Fire listeners only if transitioning to or from matched state
                        if (matches !== mql.matches) {
                            mql.matches = matches;

                            for (var j = 0, jl = listeners.length; j < jl; j++) {
                                listeners[j].call(window, mql);
                            }
                        }
                    }
                }, 30);
            };

        window.matchMedia = function(media) {
            var mql         = localMatchMedia(media),
                listeners   = [],
                index       = 0;

            mql.addListener = function(listener) {
                // Changes would not occur to css media type so return now (Affects IE <= 8)
                if (!hasMediaQueries) {
                    return;
                }

                // Set up 'resize' listener for browsers that support CSS3 media queries (Not for IE <= 8)
                // There should only ever be 1 resize listener running for performance
                if (!isListening) {
                    isListening = true;
                    window.addEventListener('resize', handleChange, true);
                }

                // Push object only if it has not been pushed already
                if (index === 0) {
                    index = queries.push({
                        mql         : mql,
                        listeners   : listeners
                    });
                }

                listeners.push(listener);
            };

            mql.removeListener = function(listener) {
                for (var i = 0, il = listeners.length; i < il; i++){
                    if (listeners[i] === listener){
                        listeners.splice(i, 1);
                    }
                }
            };

            return mql;
        };
    }());
    ;// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel

// MIT license

    (function() {
        var lastTime = 0;
        var vendors = ['ms', 'moz', 'webkit', 'o'];
        for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
            window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
                || window[vendors[x]+'CancelRequestAnimationFrame'];
        }

        if (!window.requestAnimationFrame)
            window.requestAnimationFrame = function(callback, element) {
                var currTime = new Date().getTime();
                var timeToCall = Math.max(0, 16 - (currTime - lastTime));
                var id = window.setTimeout(function() { callback(currTime + timeToCall); },
                    timeToCall);
                lastTime = currTime + timeToCall;
                return id;
            };

        if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = function(id) {
                clearTimeout(id);
            };
    }());
    ;var salvattore = (function (global, document, undefined) {
        "use strict";

        var self = {},
            grids = [],
            add_to_dataset = function(element, key, value) {
                // uses dataset function or a fallback for <ie10
                if (element.dataset) {
                    element.dataset[key] = value;
                } else {
                    element.setAttribute("data-" + key, value);
                }
                return;
            };

        self.obtain_grid_settings = function obtain_grid_settings(element) {
            // returns the number of columns and the classes a column should have,
            // from computing the style of the ::before pseudo-element of the grid.

            var computedStyle = global.getComputedStyle(element, ":before")
                , content = computedStyle.getPropertyValue("content").slice(1, -1)
                , matchResult = content.match(/^\s*(\d+)(?:\s?\.(.+))?\s*$/)
                , numberOfColumns
                , columnClasses
                ;

            if (matchResult) {
                numberOfColumns = matchResult[1];
                columnClasses = matchResult[2];
                columnClasses = columnClasses? columnClasses.split(".") : ["column"];
            } else {
                matchResult = content.match(/^\s*\.(.+)\s+(\d+)\s*$/);
                columnClasses = matchResult[1];
                numberOfColumns = matchResult[2];
                if (numberOfColumns) {
                    numberOfColumns = numberOfColumns.split(".");
                }
            }

            return {
                numberOfColumns: numberOfColumns,
                columnClasses: columnClasses
            };
        };


        self.add_columns = function add_columns(grid, items) {
            // from the settings obtained, it creates columns with
            // the configured classes and adds to them a list of items.

            var settings = self.obtain_grid_settings(grid)
                , numberOfColumns = settings.numberOfColumns
                , columnClasses = settings.columnClasses
                , columnsItems = new Array(+numberOfColumns)
                , columnsFragment = document.createDocumentFragment()
                , i = numberOfColumns
                , selector
                ;

            while (i-- !== 0) {
                selector = "[data-columns] > *:nth-child(" + numberOfColumns + "n-" + i + ")";
                columnsItems.push(items.querySelectorAll(selector));
            }

            columnsItems.forEach(function append_to_grid_fragment(rows) {
                var column = document.createElement("div")
                    , rowsFragment = document.createDocumentFragment()
                    ;

                column.className = columnClasses.join(" ");

                Array.prototype.forEach.call(rows, function append_to_column(row) {
                    rowsFragment.appendChild(row);
                });
                column.appendChild(rowsFragment);
                columnsFragment.appendChild(column);
            });

            grid.appendChild(columnsFragment);
            add_to_dataset(grid, 'columns', numberOfColumns);
        };


        self.remove_columns = function remove_columns(grid) {
            // removes all the columns from a grid, and returns a list
            // of items sorted by the ordering of columns.

            var range = document.createRange();
            range.selectNodeContents(grid);

            var columns = Array.prototype.filter.call(range.extractContents().childNodes, function filter_elements(node) {
                return node instanceof global.HTMLElement;
            });

            var numberOfColumns = columns.length
                , numberOfRowsInFirstColumn = columns[0].childNodes.length
                , sortedRows = new Array(numberOfRowsInFirstColumn * numberOfColumns)
                ;

            Array.prototype.forEach.call(columns, function iterate_columns(column, columnIndex) {
                Array.prototype.forEach.call(column.children, function iterate_rows(row, rowIndex) {
                    sortedRows[rowIndex * numberOfColumns + columnIndex] = row;
                });
            });

            var container = document.createElement("div");
            add_to_dataset(container, 'columns', 0);

            sortedRows.filter(function filter_non_null(child) {
                return !!child;
            }).forEach(function append_row(child) {
                container.appendChild(child);
            });

            return container;
        };


        self.recreate_columns = function recreate_columns(grid) {
            // removes all the columns from the grid, and adds them again,
            // it is used when the number of columns change.

            global.requestAnimationFrame(function render_after_css_media_query_change() {
                self.add_columns(grid, self.remove_columns(grid));
            });
        };


        self.media_query_change = function media_query_change(mql) {
            // recreates the columns when a media query matches the current state
            // of the browser.

            if (mql.matches) {
                Array.prototype.forEach.call(grids, self.recreate_columns);
            }
        };


        self.get_css_rules = function get_css_rules(stylesheet) {
            // returns a list of css rules from a stylesheet

            var cssRules;
            try {
                cssRules = stylesheet.sheet.cssRules || stylesheet.sheet.rules;
            } catch (e) {
                return [];
            }

            return cssRules || [];
        };


        self.get_stylesheets = function get_stylesheets() {
            // returns a list of all the styles in the document (that are accessible).

            return Array.prototype.concat.call(
                Array.prototype.slice.call(document.querySelectorAll("style[type='text/css']")),
                Array.prototype.slice.call(document.querySelectorAll("link[rel='stylesheet']"))
            );
        };


        self.media_rule_has_columns_selector = function media_rule_has_columns_selector(rules) {
            // checks if a media query css rule has in its contents a selector that
            // styles the grid.

            var i = rules.length
                , rule
                ;

            while (i--) {
                rule = rules[i];
                if (rule.selectorText && rule.selectorText.match(/\[data-columns\](.*)::?before$/)) {
                    return true;
                }
            }

            return false;
        };


        self.scan_media_queries = function scan_media_queries() {
            // scans all the stylesheets for selectors that style grids,
            // if the matchMedia API is supported.

            var mediaQueries = [];

            if (!global.matchMedia) {
                return;
            }

            self.get_stylesheets().forEach(function extract_rules(stylesheet) {
                Array.prototype.forEach.call(self.get_css_rules(stylesheet), function filter_by_column_selector(rule) {
                    if (rule.media && self.media_rule_has_columns_selector(rule.cssRules)) {
                        mediaQueries.push(global.matchMedia(rule.media.mediaText));
                    }
                });
            });

            mediaQueries.forEach(function listen_to_changes(mql) {
                mql.addListener(self.media_query_change);
            });
        };


        self.next_element_column_index = function next_element_column_index(grid) {
            // returns the index of the column where the given element must be added.

            var children = grid.children
                , m = children.length
                , lowestRowCount = 0
                , child
                , currentRowCount
                , i
                , index = 0
                ;

            for (i = 0; i < m; i++) {
                child = children[i];
                currentRowCount = child.children.length;
                if(lowestRowCount == 0) {
                    lowestRowCount = currentRowCount;
                }
                if(currentRowCount < lowestRowCount) {
                    index = i;
                    lowestRowCount = currentRowCount;
                }
            }

            return index;
        };


        self.create_list_of_fragments = function create_list_of_fragments(quantity) {
            // returns a list of fragments

            var fragments = new Array(quantity)
                , i = 0
                ;

            while (i !== quantity) {
                fragments[i] = document.createDocumentFragment();
                i++;
            }

            return fragments;
        };


        self.append_elements = function append_elements(grid, elements) {
            // adds a list of elements to the end of a grid

            var columns = grid.children
                , numberOfColumns = columns.length
                , fragments = self.create_list_of_fragments(numberOfColumns)
                ;

            elements.forEach(function append_to_next_fragment(element) {
                var columnIndex = self.next_element_column_index(grid);
                fragments[columnIndex].appendChild(element);
            });

            Array.prototype.forEach.call(columns, function insert_column(column, index) {
                column.appendChild(fragments[index]);
            });
        };


        self.prepend_elements = function prepend_elements(grid, elements) {
            // adds a list of elements to the start of a grid

            var columns = grid.children
                , numberOfColumns = columns.length
                , fragments = self.create_list_of_fragments(numberOfColumns)
                , columnIndex = numberOfColumns - 1
                ;

            elements.forEach(function append_to_next_fragment(element) {
                var fragment = fragments[columnIndex];
                fragment.insertBefore(element, fragment.firstChild);
                if (columnIndex === 0) {
                    columnIndex = numberOfColumns - 1;
                } else {
                    columnIndex--;
                }
            });

            Array.prototype.forEach.call(columns, function insert_column(column, index) {
                column.insertBefore(fragments[index], column.firstChild);
            });

            // populates a fragment with n columns till the right
            var fragment = document.createDocumentFragment()
                , numberOfColumnsToExtract = elements.length % numberOfColumns
                ;

            while (numberOfColumnsToExtract-- !== 0) {
                fragment.appendChild(grid.lastChild);
            }

            // adds the fragment to the left
            grid.insertBefore(fragment, grid.firstChild);
        };


        self.register_grid = function register_grid (grid) {
            if (global.getComputedStyle(grid).display === "none") {
                return;
            }

            // retrieve the list of items from the grid itself
            var range = document.createRange();
            range.selectNodeContents(grid);

            var items = document.createElement("div");
            items.appendChild(range.extractContents());


            add_to_dataset(items, 'columns', 0);
            self.add_columns(grid, items);
            grids.push(grid);
        };


        self.init = function init() {
            // adds required CSS rule to hide 'content' based
            // configuration.

            var css = document.createElement("style");
            css.innerHTML = "[data-columns]::before{visibility:hidden;position:absolute;font-size:1px;}";
            document.head.appendChild(css);

            // scans all the grids in the document and generates
            // columns from their configuration.

            var gridElements = document.querySelectorAll("[data-columns]");
            Array.prototype.forEach.call(gridElements, self.register_grid);
            self.scan_media_queries();
        };


        self.init();

        return {
            append_elements: self.append_elements,
            prepend_elements: self.prepend_elements,
            register_grid: self.register_grid
        };

    })(window, window.document);

    return salvattore;
}));}
// Avoid `console` errors in browsers that lack a console.
(function () {
	var method;
	var noop = function () {
	};
	var methods = [
		'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
		'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
		'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeStamp', 'trace', 'warn'
	];
	var length = methods.length;
	var console = (window.console = window.console || {});

	while (length--) {
		method = methods[length];

		// Only stub undefined methods.
		if (!console[method]) {
			console[method] = noop;
		}
	}
}());

// Place any jQuery/helper plugins in here.

/* --- $outerHTML Plugin --- */
( function($) {
	$.fn.outerHTML = function () {

		// IE, Chrome & Safari will comply with the non-standard outerHTML, all others (FF) will have a fall-back for cloning
		return (!this.length) ? this : (this[0].outerHTML || (function (el) {
			var div = document.createElement('div');
			div.appendChild(el.cloneNode(true));
			var contents = div.innerHTML;
			div = null;
			return contents;
		})(this[0]));
	};
})(jQuery);

/* --- $DEBOUNCES RESIZE --- */

/* debouncedresize: special jQuery event that happens once after a window resize
 * https://github.com/louisremi/jquery-smartresize
 * Copyright 2012 @louis_remi
 */
(function($){var $event=$.event,$special,resizeTimeout;$special=$event.special.debouncedresize={setup:function(){$(this).on("resize",$special.handler);},teardown:function(){$(this).off("resize",$special.handler);},handler:function(event,execAsap){var context=this,args=arguments,dispatch=function(){event.type="debouncedresize";$event.dispatch.apply(context,args);};if(resizeTimeout){clearTimeout(resizeTimeout);}execAsap?dispatch():resizeTimeout=setTimeout(dispatch,$special.threshold);},threshold:150};})(jQuery);



/* --- $AUTORESIZE TEXTAREA --- */

/* Autosize v1.18.1 - 2013-11-05
 * Automatically adjust textarea height based on user input.
 * (c) 2013 Jack Moore - http://www.jacklmoore.com/autosize
 * license: http://www.opensource.org/licenses/mit-license.php
 */
(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

/* --- $SMOOTH PAGE SCROLL --- */
/*
 * Performs a smooth page scroll to an anchor on the same page.
 * http://css-tricks.com/snippets/jquery/smooth-scrolling/
 */
( function($) {
	$('a[href*="#"]:not([href="#"])').click(function(event) {
		//exclude some links from smooth scrolling like tabs
		if ($(this).parents('.tabs__nav').length) {
			//do nothing
		} else if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 700);
				event.preventDefault();
			}
		}
	});
})(jQuery);
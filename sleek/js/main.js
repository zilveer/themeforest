/*------------------------------------------------------------
 * Go big or go home
 *------------------------------------------------------------*/

if( typeof sleek === "undefined" ){
	var sleek = {};
}


(function($){
"use strict";



/*------------------------------------------------------------
 * Helpers
 *------------------------------------------------------------*/

/* Window width and device
 *------------------------------------------------------------*/

function resolutionUtilities(){

	// get window width & height
	sleek.windowWidth  = $(window).width();
	sleek.windowHeight = $(window).height();

	// get device by window width
	if( sleek.windowWidth <= 767 ){
		sleek.device = 'mobile';
	}

	if( sleek.windowWidth > 767 && sleek.windowWidth < 1200 ){
		sleek.device = 'tablet';
	}

	if( sleek.windowWidth >= 1200 ){
		sleek.device = 'desktop';
	}

}

resolutionUtilities();
$(document).on( 'sleek:resize', resolutionUtilities );



/* UserAgent
 *------------------------------------------------------------*/

function detectUserAgent(){

	sleek.userAgent = '';

	if( navigator.userAgent.match(/iPad/i) !== null ){
		sleek.userAgent = 'iPad';
	}

	if( navigator.userAgent.match(/iPhone/i) !== null ){
		sleek.userAgent = 'iPhone';
	}

	if( navigator.userAgent.match(/Android/i) !== null ){
		sleek.userAgent = 'Android';
	}



	sleek.platform = '';

	if(
		navigator.platform.match(/Mac/i)  !== null &&
		navigator.userAgent.match(/10_6/i) === null &&
		navigator.userAgent.match(/10.6/i) === null &&
		navigator.userAgent.match(/10_5/i) === null &&
		navigator.userAgent.match(/10.5/i) === null
	){
		sleek.platform = 'Mac';
	}



	sleek.browser = '';

  if(
  	/Safari/.test(navigator.userAgent) &&
  	/Apple Computer/.test(navigator.vendor)
  ){
  	sleek.browser = 'Safari';
  }



	// add classes to <html>
	if(
		sleek.userAgent == 'iPad' ||
		sleek.userAgent == 'iPhone' ||
		sleek.userAgent == 'Android'
	){
		$('html').addClass('sleek-touchscreen--true');
	}else{
		$('html').addClass('sleek-touchscreen--false');
	}

}

detectUserAgent();



/* FUNCTION: Validate E-mail
 *------------------------------------------------------------*/

function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}



/* Width of main content area
 *------------------------------------------------------------*/

function mainContentWidth(){

	if( sleek.device == 'mobile' ){
		sleek.mainContentSize = 's';
		$('.main-content').removeClass('main-content--s main-content--m main-content--l main-content--xl main-content--m-plus main-content--l-plus');

		return;
	}

	sleek.mainContentWidth = $('.main-content__inside').width();

	if( sleek.mainContentWidth >= 1075 ){
		sleek.mainContentSize = 'xl';
	}else if( sleek.mainContentWidth >= 774 ){
		sleek.mainContentSize = 'l';
	}else if( sleek.mainContentWidth >= 600 ){
		sleek.mainContentSize = 'm';
	}else{
		sleek.mainContentSize = 's';
	}



	$('.main-content').removeClass('main-content--s main-content--m main-content--l main-content--xl main-content--m-plus main-content--l-plus');

	switch( sleek.mainContentSize ){
		case 'xl':
			$('.main-content').addClass('main-content--xl main-content--l-plus main-content--m-plus');
			break;

		case 'l':
			$('.main-content').addClass('main-content--l main-content--l-plus main-content--m-plus');
			break;

		case 'm':
			$('.main-content').addClass('main-content--m main-content--m-plus');
			break;

		case "s":
			$('.main-content').addClass('main-content--s');
			break;
	}

}

$(document).ready(mainContentWidth);
$(document).on( 'sleek:ajaxPageLoad', mainContentWidth );
$(document).on( 'sleek:resize', mainContentWidth );



/* Is Ajax Loading Enabled & Supported
 *------------------------------------------------------------*/

function ajaxEnabled(){

	sleek.ajaxEnabled = false;

	if(
		Modernizr.history &&
		$('body').hasClass('js-ajax-load-pages')
	){
		sleek.ajaxEnabled = true;
	}

}

$(document).ready(ajaxEnabled);





/*------------------------------------------------------------
 * EVENT: Sleek:Resize
 *------------------------------------------------------------*/

var resizeTimeout;
$(window).resize(function() {

	if( sleek.device == 'mobile' ){
		var w = $(window).width();
		var h = $(window).height();

		if(
			Math.abs(sleek.windowWidth - w) < 80 &&
			Math.abs(sleek.windowHeight - h) < 80
		){
			return;
		}
	}

	requestAnimationFrame(function() {
		clearTimeout(resizeTimeout);
		resizeTimeout = setTimeout(function() {
			$(document).trigger('sleek:resize');
		}, 200);
	});
});





/*------------------------------------------------------------
 * EVENT: Sleek:Scroll
 *------------------------------------------------------------*/

var scrollTime = 0;
var scrollTimeout;
function sleekScrollEvent(){

	requestAnimationFrame(function() {

		var now = new Date().getTime();
		var dt = now - scrollTime;
		if ( dt < 70 ) { return; }
		scrollTime = now;

		$(document).trigger('sleek:scroll');

		// Trigger the event once after the scrolling stops
		clearTimeout( scrollTimeout );
		scrollTimeout = setTimeout( function(){
			$(document).trigger('sleek:scroll');
		}, 250);

	});
}

function sleekScrollWatch(){
	// mobile is native-scrolled
	if( sleek.device == 'mobile' ){
		// currently not firing sleek:scroll event
		// $('body').scroll(sleekScrollEvent);
	}else{
		// Tablet & Desktop
		if( $('body').hasClass('independent-sidebar--true') ){
			$('.main-content .nano-content').scroll(sleekScrollEvent);
		}else{
			$('.content-wrapper').scroll(sleekScrollEvent);
		}
	}
}

$(document).ready( sleekScrollWatch );
$(document).on( 'sleek:ajaxPageLoad', sleekScrollWatch );
$(document).on( 'sleek:resize', sleekScrollWatch );





/*------------------------------------------------------------
 * FUNCTION: Scroll Page Back to Top
 * Used for ajax navigation scroll position reset
 *------------------------------------------------------------*/

function scrollPageToTop(){
	// Height hack for mobile/tablet
	$('body').css('height', 'auto');

	if( sleek.device != 'desktop' ){
		$('body').scrollTop(0);
	}else{
		$('.content-wrapper').scrollTop(0);
	}

	$('body').css('height', '');
}



/*------------------------------------------------------------
 * FUNCTION: Push ajax navigation info to google analytics
 *------------------------------------------------------------*/

function ajaxPushGoogleAnalytics(){
	if( !sleek.ajaxEnabled ){
		return;
	}

	if(typeof _gaq !== "undefined" && _gaq !== null) {
		_gaq.push(['_trackPageview', window.location.pathname]);
	}else if( typeof ga == 'function' ){
		ga('send', 'pageview', window.location.pathname);
	}
}



/*------------------------------------------------------------
 * FUNCTION: Equalize height of layout parts
 *------------------------------------------------------------*/

function layoutHeightEq(){

	if ( Modernizr.flexbox ) { return; }

	function setHeight(){

		if( sleek.device != 'mobile' && $('body').hasClass('independent-sidebar--true') ){
			return;
		}

		// reset previously set heights
		$('.main-content__inside, .sidebar__content').css('height', '');

		// use only on tablet & desktop
		if( sleek.device == 'mobile' ){
			return;
		}

		var getHeightFrom = '.main-content__inside, .sidebar__general, .sidebar__comments';
		var maxHeight = window.innerHeight; // window height

		// get max height from all getHeightFrom
		$(getHeightFrom).each(function(){
			var height = $(this).innerHeight();
			maxHeight = Math.max( height, maxHeight );
		});

		// set calculated height to main layout elements
		$('.main-content__inside, .sidebar__content').height( maxHeight );

	}

	setHeight();
	$(document).on( 'sleek:ajaxPageLoad', setHeight );
	$(document).on( 'sleek:resize', setHeight );

}

$(document).ready( layoutHeightEq );




/*------------------------------------------------------------
 * FUNCTION: Calculate header bottom space for footer
 *------------------------------------------------------------*/

function headerFooterSpace(){
	$('.header__inwrap').waitForImages(function(){
		var footerHeight = $('.js-header-footer').innerHeight();
		$('.header__inwrap').css( 'padding-bottom', footerHeight );
	});
}

$(document).ready( headerFooterSpace );





/*------------------------------------------------------------
 * FUNCTION: Calculate height for single featured image, or Title Header
 *------------------------------------------------------------*/

function titleHeadHeight(){

	var height = sleek.device != 'mobile' ? sleek.windowHeight*0.5 : sleek.windowHeight;
	var heightText = height;



	// Make title-header__inwrap height an even number [2/4/6]
	// Centering with translate(-50%) antialiases edges when not snapped to pixel
	var header__inwrapHeight = $('.title-header__inwrap').height();
	if( header__inwrapHeight % 2 === 1 ) {
		$('.title-header__inwrap').height(header__inwrapHeight+1);
	}

	// title header height
	$('.title-header--big').css({
		'min-height': Math.max(height, (header__inwrapHeight + 50) ) + 'px'
	});



	/* Featured Heads Height
	 *
	 * On Single Post Format Head
	 *------------------------------------------------------------*/

	var featuredElements = '.format-head--image, .format-head--quote, .format-head--status, .format-head--link';

	$( featuredElements, '.article-single--post' ).each(function(){
		heightText = $(this).find('.post__text').height();

		$(this).find('.post__media').css({
			'height': Math.max(height, heightText + 50) + 'px'
		});
	});



	/* Featured Heads on Loop lists
	 *------------------------------------------------------------*/

	$( featuredElements, '.loop-container--wp').each(function(){
		$(this).find('.post__media').height('');
		heightText = $(this).find('.post__text').height();

		if( sleek.device == 'mobile'){

			$(this).find('.post__media').css({
				'height': Math.max( (height*0.9), heightText + 50) + 'px'
			});

		}else{

			$(this).find('.post__media').css({
				'min-height': (heightText + 50) + 'px'
			});

		}
	});

}

$(document).ready( titleHeadHeight );
$(document).on( 'sleek:ajaxPageLoad', titleHeadHeight );
$(document).on( 'sleek:resize', titleHeadHeight );





/*------------------------------------------------------------
 * FUNCTION: Init NanoScrollJS
 *------------------------------------------------------------*/

function nanoScroll(){

	if(
		sleek.userAgent == 'iPad' ||
		sleek.userAgent == 'iPhone' ||
		sleek.userAgent == 'Android'
	){
		return false;
	}

	var elements = '';
	if( $('body').hasClass('independent-sidebar--true') ){
		elements = '.js-nano';
	}else{
		elements = '.js-nano-header';
	}

	var options = {
		disableResize: true
	};
	var options_kill = {
		disableResize: true,
		destroy: true
	};

	if( sleek.device != 'mobile' ){
		$(elements).each(function(){
			$(this).waitForImages(function(){
				$(this).addClass('nano').nanoScroller(options);
			});
		});
	}else{
		$(elements).removeClass('nano').nanoScroller( options_kill );
	}

}

$(document).ready( nanoScroll );
$(document).on( 'sleek:ajaxPageLoad', nanoScroll );
$(document).on( 'sleek:resize', nanoScroll );




/*------------------------------------------------------------
 * FUNCTION: Initial Load Appearance Animation
 *------------------------------------------------------------*/

function initLoadAnimation(){

	$('body').waitForImages(function(){

		$('body').addClass('init-load-animation-start');

		setTimeout(function() {
			$('body').addClass('init-load-animation-end');
			$('body').removeClass('init-load-animation-start');
		}, 1500);

	});

}

$(document).ready( initLoadAnimation );





/*------------------------------------------------------------
 * FUNCTION: Sidebar Tab Control
 *------------------------------------------------------------*/

function sidebarTabControl(){

	// support anchored comments link and reset horizontal scroll [bug]
	if ( window.location.hash == '#respond' || window.location.hash == '#comments') {
		$('.js-sidebar-tab[data-tab="comments"]')
			.addClass('active')
			.siblings().removeClass('active');
		$('.sidebar').addClass('sidebar--comments-active');
	}

	// manual tab control
	$('html').on('click','.js-sidebar-tab', function(e){
		e.preventDefault();
		$(this).addClass('active').siblings().removeClass('active');
		var tab = $(this).attr('data-tab');
		if(tab == 'comments'){
			$('.sidebar').removeClass('sidebar--general-active');
			$('.sidebar').addClass('sidebar--comments-active');
		}else{
			$('.sidebar').removeClass('sidebar--comments-active');
			$('.sidebar').addClass('sidebar--general-active');
		}
	});

}

$(document).ready( sidebarTabControl );





/*------------------------------------------------------------
 * FUNCTION: Touchscreen Navigation Toggle
 *------------------------------------------------------------*/

function headerToggle(){

	$('.js-touchscreen-header-toggle').click(function(e){
		e.preventDefault();
		$('body').toggleClass('touchscreen-header-open');
	});

	$('.content-wrapper').click(function(e){
		if( $('body').hasClass('touchscreen-header-open') ){
			$('body').removeClass('touchscreen-header-open');
		}
	});

}

$(document).ready( headerToggle );





/*------------------------------------------------------------
 * FUNCTION: Google Maps
 *------------------------------------------------------------*/

function googleMaps() {

	$('.js-sleek-gmap:not(.processed)').each(function(e){
		var $el = $(this);
		var el  = $(this)[0];
		var lat = parseFloat( $el.attr('data-lat') );
		var lng = parseFloat( $el.attr('data-lng') );
		var zoom= parseFloat( $el.attr('data-zoom') );
		var pin = $el.attr('data-pin');
		var scrollable 	= $el.attr('data-scrollable') == 'true' ? true : false ;
		var content 	= $el.html();

		var style = [{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]},{"featureType":"landscape","stylers":[{"color":"#f2e5d4"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}];

		var myLatLng = new google.maps.LatLng( lat, lng );
		var mapOptions = {
			zoom: zoom,
			center: myLatLng,
			scrollwheel : scrollable,
			draggable : scrollable,
			mapTypeId: google.maps.MapTypeId.ROADMAP
			// mapTypeControl: false,
			// styles: style
		};

		var map = new google.maps.Map( el, mapOptions );

		var marker_image = new google.maps.MarkerImage(pin,
			null,
			new google.maps.Point(0,0),
			new google.maps.Point(42, 52)
		);

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			icon: marker_image
		});

		// InfoWindow Bubble
		if( content ) {
			var infowindow = new google.maps.InfoWindow({
				content: content,
				maxWidth: 300
			});

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			});
		}

		$el.addClass('processed');
	});

}

$(document).ready( googleMaps );
$(document).on( 'sleek:ajaxPageLoad', googleMaps );




/*------------------------------------------------------------
 * FUNCTION: Sleek Slider
 *------------------------------------------------------------*/

function slider(){

	/* Kill on mobile
	if( sleek.device == 'mobile'){
		$('.js-sleek-slider-item').removeClass('dark-mode');
		$('.sleek-slider__items')
			.css('max-height','')
			.css('min-height','');
		return;
	}
	*/

	$('.js-sleek-slider:not(.processed)').each(function(e){
		var $el         = $(this).addClass('js-started');
		var elType      = 'element';
		var $items      = $el.find('.sleek-slider__items');
		var $item       = $el.find('.sleek-slider__item');
		var $active     = $item.filter('.active');
		var $first      = $item.first();
		var $last       = $item.last();
		var interval;
		var intervalVal = parseInt( $el.attr('data-interval') );
		var control     = $el.attr('data-control');
		var $arrows     = $el.find('.sleek-ui--slider-arrows');
		var $arrowPrev  = $el.find('.js-sleek-ui-arrow--prev');
		var $arrowNext  = $el.find('.js-sleek-ui-arrow--next');
		var $pager      = $el.find('.js-sleek-slider-pager-item');
		var dataHeight 	= $el.attr('data-height');

		var $blogControl= $el.find('.sleek-ui--blog-slider');
		var $loader     = $el.find('.sleek-ui__loader');

		// check if blog slider
		if( $el.hasClass('loop-container') ){ elType = 'blog'; }
		// check if image slider
		if( $el.hasClass('sleek-slider--images') ){ elType = 'images'; }
		// check if slider-element
		if( $el.hasClass('sleek-slider--element') ){ elType = 'element'; }



		$arrows.find('.js-info-total').html( $item.length );

		// Add data-id count to posts if missing [blog slider]
		if( $first.attr('data-id') != 'slider-item-0' ){
			$item.each(function(i){
				$(this).attr( 'data-id', 'slider-item-' + i );
			});
		}

		// If first item does not have active class
		// make it active
		if( !$first.hasClass('active') ){
			$active = $first.addClass('active');
		}



		// Function: Max Height on slide items
		function sliderHeightEq(){
			var height = 0;

			// Position Blog Slider Controls and Count items
			if( elType == 'blog' ){

				$first.waitForImages(function(){
					$item.each(function(){
						var thisHeight = $('.sleek-slider__item-inwrap',this).height('').height();
						height = Math.max( thisHeight, height );
					});

					// Slider Overlay to be full-window height on mobile
					if( sleek.device == 'mobile' && $el.hasClass('loop-container--style-slider_overlay') ){
						height = Math.max( height, sleek.windowHeight );
						$item.find('.sleek-slider__item-inwrap').height(height);
					}

					if( height > 0 ){
						$items.height(height);
					}

					var mediaHeight = $first.find('.post__media').innerHeight();
					var blogControlHeight = $blogControl.innerHeight();

					$blogControl.css({
						'top': mediaHeight - blogControlHeight,
						'bottom': 'auto'
					});

				});

			// Slider Element
			}else if( elType == 'element' ){

				$item.each(function(){


					var $textContent = $(this).find('.sleek-slider__text');
					var textContentHeight = $textContent.height('').height();

					// Check for height of text, and make it an even number [2/4/6]
					// Centering with translate(-50%)
					// antialiases edges when not snapped to pixel
					if ( textContentHeight % 2 === 1 ) {
						textContentHeight++;
						$textContent.height( textContentHeight );
					}

					// Slider to be full-window height on mobile
					if( sleek.device == 'mobile' ){
						height = Math.max( textContentHeight+140, height, sleek.windowHeight );
					}else{
						if( sleek.mainContentSize == 'xl' ){
							height = Math.max( textContentHeight+140, height, dataHeight );
						}else{
							height = Math.max( textContentHeight+140, height );
						}
					}

				});

				if( height > 0 ){
					$items.height(height);
				}

			// Image Slider
			}else if( elType == 'images' ){

				$item.each(function(){

					$(this).waitForImages(function(){
						var thisHeight = $('.sleek-slider__item-inwrap',this).removeClass('processed').height('').height();
						$('.sleek-slider__item-inwrap',this).addClass('processed');

						height = Math.max( thisHeight, height );

						if( height > 0 ){
							$items.height(height);
						}

					});
				});
			}

			layoutHeightEq();
			nanoScroll();



			$(document).one( 'sleek:resize', sliderHeightEq );
		}

		sliderHeightEq();



		// Function: Activate item, mark animate-out and animate-in
		function activate($activateItem, isPrev){

			var reverseClass = isPrev === true ? 'animate-reverse' : '';
			var slideId = $activateItem.attr('data-id');

			if( !$activateItem.hasClass('active') ){

				// add animate-in class to new active item
				$activateItem.addClass('animate-in '+reverseClass);

				// add animate-out class to last active item
				var $itemOut = $active.addClass('animate-out '+reverseClass);

				setTimeout( function(){
					$itemOut.removeClass('animate-out '+reverseClass);
					$activateItem.removeClass('animate-in '+reverseClass);
					$activateItem.addClass('active').siblings().removeClass('active '+reverseClass);
					$active = $activateItem;
				}, 1000 );

				// update pager
				if( control == 'pager' ){
					$pager.removeClass('active');
					$pager.filter('[data-id="'+slideId+'"]').addClass('active');
				}

				// update arrows info
				if( control == 'arrows' ){
					if (slideId) {
						var infoCurrent = parseInt( slideId.split('-')[2] );
						infoCurrent = infoCurrent + 1;

						$arrows.find('.js-info-current').html( infoCurrent );
					}
				}

				if( sleek.device != 'desktop' && intervalVal !== 0 ){
					startInterval();
				}
			}
		}



		// Function: Activate next item
		function activateNextItem() {
			var $nextItem;

			// if next item - select it, else jump to start
			if( $active.next('.sleek-slider__item').length > 0 ){
				$nextItem = $active.next('.sleek-slider__item');
			}else{
				$nextItem = $first;
			}

			activate($nextItem);
		}

		// Function: Activate prev item
		function activatePrevItem() {
			var $prevItem;

			// if prev item - select it, else jump to end
			if( $active.prev('.sleek-slider__item').length > 0 ){
				$prevItem = $active.prev('.sleek-slider__item');
			}else{
				$prevItem = $last;
			}

			activate($prevItem, true);
		}



		// Automatic animation
		if( intervalVal && intervalVal != '0'){
			startInterval();

			// events
			$(document).off('.stopInterval');
			$(document).on( 'sleek:ajaxPageLoad.stopInterval', stopInterval );
			$el.hover( stopInterval , startInterval );
		}

		// Function: Start interval animation
		function startInterval(){
			clearInterval(interval);

			interval = setInterval( function(){
				activateNextItem();
			}, intervalVal);
		}

		// Function: Stop interval animation
		function stopInterval(){
			clearInterval(interval);
		}



		// Arrows functionality
		$arrowNext.click(function(e){
			e.preventDefault();
			activateNextItem();
		});

		$arrowPrev.click(function(e){
			e.preventDefault();
			activatePrevItem();
		});

		// Touch-Swipe functionality
		$el.swipe( {
			swipeRight: function(){
				activatePrevItem();
			},
			swipeLeft: function(){
				activateNextItem();
			},
			threshold:40
		});

		// Arrow keys
		$(document).keydown(function(e){
			if( e.which == 37 ) {
				activatePrevItem();
			}
			if( e.which == 39 ) {
				activateNextItem();
			}
		});



		// Pager functionality
		$pager.click(function(e){
			e.preventDefault();
			var activeId = $active.attr('data-id');
			var pagerId = $(this).attr('data-id');
			var isPrev = false;


			if( pagerId.replace( /^\D+/g, '') < activeId.replace( /^\D+/g, '') ){
				isPrev = true;
			}
			activate( $items.find('[data-id="'+pagerId+'"]'), isPrev );
		});

		$el.addClass('processed');
	});

}

$(document).ready( slider );
$(document).on( 'sleek:ajaxPageLoad', slider );





/*------------------------------------------------------------
 * FUNCTION: Sleek Carousel
 *------------------------------------------------------------*/

function carousel(){

	$('.js-sleek-carousel:not(.processed)').each(function(e){

		var $el         = $(this).addClass('js-started');
		var $elInwrap   = $el.find('.sleek-carousel__inwrap');
		var $items      = $el.find('.sleek-carousel__items');
		var $item       = $el.find('.sleek-carousel__item');
		var interval;
		var intervalVal = $el.attr('data-interval');
		var arrowsUse   = $el.attr('data-carousel-arrows');
		var gridMax     = parseInt( $el.attr('data-carousel-grid') );
		var grid        = gridMax;
		var itemCount   = $item.length;
		var itemWidth;
		var itemsWidth;
		var elWidth;
		var step;
		var position    = 0;
		var itemHeight  = 0;
		var $arrowPrev  = $el.find('.js-sleek-ui-arrow--prev');
		var $arrowNext  = $el.find('.js-sleek-ui-arrow--next');



		// Calculate & lay-out elements
		function carouselLayout(){

			// get grid based on main content width
			if( sleek.mainContentSize == 's' ){
				grid = 1;
			}
			if( sleek.mainContentSize == 'm' || sleek.mainContentSize == 'l' ){
				grid = gridMax < 3 ? gridMax : 3;
			}
			if( sleek.mainContentSize == 'm' && sleek.device == 'tablet' ){
				grid = gridMax < 2 ? gridMax : 2;
			}
			if( sleek.mainContentSize == 'xl' ){
				grid = gridMax;
			}

			elWidth = Math.floor( $el.innerWidth() );

			itemWidth = Math.floor( elWidth / grid );
			itemsWidth = Math.floor( itemWidth * itemCount );
			step = itemWidth;

			$item.width(itemWidth);
			$items.width(itemsWidth);

			// equalize items height
			itemHeight = 0;
			$item.height('');

			$el.waitForImages(function(){
				$item.each(function(){
					var currentHeight = $(this).innerHeight();
					itemHeight = Math.max( currentHeight, itemHeight );
				});
				$item.height(itemHeight);

				// fire custom scrollbar function if enabled
				if( arrowsUse == 'false' ){
					initCustomScrollbar();
				}

				layoutHeightEq();
				nanoScroll();
			});




			$(document).one( 'sleek:resize', carouselLayout );
		}

		carouselLayout();
		// make sure that layout is fine, even when something delays img load by a bit
		setTimeout(function(){
			carouselLayout();
		},250);



		// Custom Scrollbar
		function initCustomScrollbar(){

			if( sleek.device != 'desktop' ){
				$elInwrap.mCustomScrollbar('destroy');

				return;
			}

			$elInwrap.mCustomScrollbar({
				axis:"x",
				scrollInertia: 500,
				mouseWheel: {
					enable: false
				},
				callbacks: {
					onScroll: function(){
						position = Math.abs(this.mcs.left);
					}
				}
			});

		}



		// Function: Animate Scrolling
		function animate(position) {

			if( typeof position === 'undefined' ){
				return;
			}

			if( sleek.device != 'desktop' || arrowsUse == 'true' ){

				$elInwrap.stop().animate({
					scrollLeft: position
				}, 500 );

			}else{
				$elInwrap.mCustomScrollbar( 'scrollTo', [0, position], { scrollInertia: 1000 } );
			}

		}



		// Function: Scroll Right - Next Slide
		function scrollNext() {

			if( sleek.device != 'desktop' || arrowsUse == 'true' ){
				position = $elInwrap.scrollLeft();
			}

			// if at the end
			if( position + elWidth > itemsWidth - 1 ){
				position = 0;
			}else{
				// scroll for container width
				position = position + step;
			}

			animate(position);
		}

		// Function: Scroll Left - Previous Slide
		function scrollPrev() {

			if( sleek.device != 'desktop' || arrowsUse == 'true' ){
				position = $elInwrap.scrollLeft();
			}

			if( position === 0 ){
				position = itemsWidth - step;
			}else{
				position = position - step;
			}

			animate(position);
		}



		// Automatic animation
		if( intervalVal && intervalVal != '0'){
			startInterval();

			// events
			$(document).off('.stopInterval');
			$(document).on( 'sleek:ajaxPageLoad.stopInterval', stopInterval );
			$el.hover( stopInterval , startInterval );

			// stop auto scrolling on touch event for handheld
			$elInwrap.on( 'touchstart', stopInterval );
		}

		// Function: Stop interval animation
		function stopInterval(){
			clearInterval(interval);
		}

		// Function: Start interval animation
		function startInterval(){
			interval = setInterval( scrollNext, intervalVal);
		}



		// Arrows functionality
		$arrowNext.click(function(e){
			e.preventDefault();
			scrollNext();
		});

		$arrowPrev.click(function(e){
			e.preventDefault();
			scrollPrev();
		});

		// Touch-Swipe functionality for desktop
		$el.swipe( {
			swipeRight: function(){
				activatePrevItem();
				killInterval();
			},
			swipeLeft: function(){
				activateNextItem();
				killInterval();
			},
			threshold:40
		});




		$el.addClass('processed');
	});

}

$(document).ready( carousel );
$(document).on( 'sleek:ajaxPageLoad', carousel );





/*------------------------------------------------------------
 * FUNCTION: Animate Page Anchors
 *------------------------------------------------------------*/

function animateAnchors(){

	$('html').on('click','.js-anchor-link', function(e){
		e.preventDefault();
		var hash = $(this).attr('href');

		// find targeted ID
		var target = $('html').find(hash);
		var targetY = target.offset().top;

		// animate for both layouts: App and Sheet
		$('html').find('#content-wrapper, .main-content-inside')
		.animate({
			scrollTop:targetY
		}, 500);

		history.pushState({page: hash}, '', hash);
	});

}

$(document).ready( animateAnchors );





/*------------------------------------------------------------
 * FUNCTION: Load More of WP Blog Loops
 *------------------------------------------------------------*/

function wpLoopLoadMore(){

	// Event: Load More Button Click
	$('html').off('.load-more--wp-loop');
	$('html').on('click.load-more--wp-loop','.js-load-more--wp-loop', function(e){
		e.preventDefault();
		loadItems( $(this) );
	});



	// Event: Auto Load More when scrolling
	var $autoLoadMore = $('.js-auto-load-more--wp-loop');

	$(document).off('.callAutoLoadMore');

	if( $autoLoadMore.length > 0 && sleek.device != 'mobile' ){
		$(document).on('sleek:scroll.callAutoLoadMore', callAutoLoadMore);
		$(document).on('sleek:resize.callAutoLoadMore', callAutoLoadMore);
	}



	// Function: Auto Load More if in viewport
	var autoLoadMoreTime = 0;
	function callAutoLoadMore(){

		if( sleek.device == 'mobile' ){
			return;
		}

		requestAnimationFrame(function() {

			var now = new Date().getTime();
			var dt = now - autoLoadMoreTime;
			if ( dt < 400 ) { return; }
			autoLoadMoreTime = now;

			if(
				$autoLoadMore.hasClass('pagination--loading') ||
				$autoLoadMore.hasClass('pagination--disabled')
			){
				return;
			}

			if( $autoLoadMore.offset().top - 250 < sleek.windowHeight ){
				loadItems($autoLoadMore);
			}

		});

	}



	// Function: Load More
	function loadItems($target){

		if(
			$target.hasClass('pagination--loading') ||
			$target.hasClass('pagination--disabled')
		){
			return;
		}

		var $el     = $('.loop-container--wp');
		var $this   = $target;
		var href    = $this.attr('href');
		var max     = parseInt($this.attr('data-max'));
		var current = parseInt($this.attr('data-current'));

		if(max > current){
			$this.addClass('pagination--loading');

			if( sleek.xhr ){
				sleek.xhr.abort();
			}

			sleek.xhr = $.ajax({
				type: "GET",
				url: href,
				success: function(data, response, xhr){

					// get, append and animate posts, trigger ajax complete event
					var posts = $(data).find('.loop-container--wp');
					$el.append( posts.html() );

					// wait for images to load before continuing
					$el.waitForImages(function(){
						$(document).trigger('sleek:ajaxPageLoad');

						if( !$el.hasClass('loop-is-masonry') ){
							$this.removeClass('pagination--loading');
						}
					});

					ajaxPushGoogleAnalytics();

					// update load more button
					current = current + 1;

					// if pretty links ON
					if(/\/page\/[0-9]+/.test(href)){
						href = href.replace(/\/page\/[0-9]+/, '/page/'+ (current+1));
					}else{
						href = href.replace(/paged=[0-9]+/, 'paged='+ (current+1));
					}
					$this.attr('data-current', current);
					$this.attr('href', href);

					// if last available page loaded, remove load more button
					if(current == max){
						$this.addClass('pagination--disabled');
					}

				},
				fail: function(){
					$this.removeClass('pagination--loading');
				}

			});

		}
	}

}

$(document).ready( wpLoopLoadMore );
$(document).on( 'sleek:ajaxPageLoad', wpLoopLoadMore );




/*------------------------------------------------------------
 *  FUNCTION: Load More of Sleek Custom Loops
 *  Paginations and loaders for custom loop disabled
 *------------------------------------------------------------*/

function sleekLoopLoadMore(){

	$('html').on('click','.js-load-more--sleek-loop', function(e){
		e.preventDefault();
		var $this           = $(this);
		var $el             = $('#' + $this.attr('data-id'));
		var shortcode       = $el.attr('data-shortcode');
		var postsPerPage    = parseInt($el.attr('data-posts_per_page'));
		var currentPage     = parseInt($el.attr('data-current_page'));
		var maxPages        = parseInt($el.attr('data-max_pages'));
		var style           = $el.attr('data-style');
		var category        = $el.attr('data-category');
		var sort_by         = $el.attr('data-sort_by');
		var sort_order      = $el.attr('data-sort_order');


		if(maxPages > currentPage){
			$this.addClass('ajax-loading');

			$.post(

				// url
				sleekAjax.ajaxurl,

				// post params to send
				{
					action : 'sleek-ajax-loops',
					// send parameters to query
					loop : shortcode + '_loop',
					posts_per_page : postsPerPage,
					paged : currentPage+1,
					style : style,
					category : category,
					sort_by : sort_by,
					sort_order : sort_order
				},

				// success function
				function(data) {

					var $html = $(data.loop.html);

					// get, append, and trigger ajax complete event
					$el.find('.loop-container').append($html);

					// wait for images to load before appearance and continuing
					$el.waitForImages(function(){
						$(document).trigger('sleek:ajaxPageLoad');
					});

					$el.attr('data-current_page', currentPage+1);
					$this.removeClass('ajax-loading');

					// if last available page loaded, remove load more button
					if(currentPage+1 == maxPages){
						$this.addClass('load-more--disabled');
					}
				}
			).fail(function(){
				$this.text('Error');
				$this.removeClass('ajax-loading');
			});
		}
	});

}

// $(document).ready( sleekLoopLoadMore );





/*------------------------------------------------------------
 * FUNCTION: Ajax Load Pages
 *------------------------------------------------------------*/

function ajaxLoadPages(){

	if( sleek.ajaxEnabled === false ) { return; }


	var hashedLink;
	var ajaxLoadPageTime = 0;

	// Chrome Bug: triggers popstate on init page load.
	// Solution: define var and make it true on first popstate/push
	var popped = false;



	// Event: Link clicked
	$('html').on('click','a',function(e) {

		// Suppress double clicks
		var now = new Date().getTime();
		var dt = now - ajaxLoadPageTime;
		if ( dt < 700 ) {
			e.preventDefault();
			return;
		}
		ajaxLoadPageTime = now;

		// assume that clicked link is hashed
		hashedLink = true;

		var href = $(this).attr('href');

		if( isExternal(href) ){
			return;
		}

		if (
			( $(this).not(".ab-item, .comment-reply-link, #cancel-comment-reply-link, .comment-edit-link, .wp-playlist-caption, .js-skip-ajax") ) &&
			// If any of these is false, don't use AJAX
			( href.indexOf('#') == -1 ) &&
			( href.indexOf('wp-login.php') == -1 ) &&
			( href.indexOf('/wp-admin/') == -1 ) &&
			( href.indexOf('wp-content/uploads/') == -1 ) &&
			( $(this).attr('target') != '_blank' ) &&
			( href != sleek.baseUrl + '/feed/' ) &&
			( href != sleek.baseUrl + '/comments/feed/' ) &&

			// WPML: on lang change, full page load
			( $(this).not('[hreflang]') ) &&
			( $(this).parents('#lang_sel').length === 0 ) &&
			( $(this).parents('#lang_sel_click').length === 0 ) &&
			( $(this).parents('#lang_sel_list').length === 0 ) &&
			( $(this).parents('.menu-item-language').length === 0 ) &&
			// Disqus: doesn't support ajax
			( typeof DISQUS === 'undefined' ) &&
			( typeof countVars === 'undefined' || typeof countVars.disqusShortname === 'undefined' )
		){
			e.preventDefault();
			popped = true;
			hashedLink = false;

			// change only main content and leave sidebar intact
			var pagination = $(this).is('.page-numbers') ? true : false;
			push_state(href, pagination);
		}

	});



	// Event: Popstate - Location History Back/Forward
	$(window).on('popstate',function(){
		// if hashed link, load native way
		// popped? don't trigger on init page load [chrome bug]
		if(!hashedLink && popped){
			ajaxLoadPage(location.href);
		}
		popped = true;
	});



	// Event: Search Form Submitted
	$('html').on('submit','form.search-form',function(e) {
		e.preventDefault();

		var action = $(this).attr('action');
		var term = $(this).find('.textfield').val();

		if( action && term ){
			popped = true;
			push_state( action + '/?s=' + term );
		}
	});



	// Function: PushState and trigger ajax loader
	function push_state(href, pagination){
		history.pushState({page: href}, '', href);
		ajaxLoadPage(href, pagination);
	}



	// Function: Ajax Load Page
	function ajaxLoadPage(href, pagination) {


		$('body').removeClass('ajax-main-content-loading-end ajax-content-wrapper-loading-end');
		if( sleek.xhr ){
			sleek.xhr.abort();
		}

		var timeStarted = 0;

		if( pagination ){
			// Classic pagination

			$('body').addClass('ajax-main-content-loading-start');
			$('body').removeClass('touchscreen-header-open'); // close header on touch devices

			timeStarted = new Date().getTime();

			sleek.xhr = $.ajax({
				type: "GET",
				url: href,
				success: function(data, response, xhr){

					// Check if css animation had time to finish
					// before new page load animation starts
					var now = new Date().getTime();
					var timeDiff = now - timeStarted;
					if( timeDiff < 1000 ) {
						setTimeout( ajaxLoadPageCallback, (1000-timeDiff) );
					}else{
						ajaxLoadPageCallback();
					}

					function ajaxLoadPageCallback(){
						var $data = $(data);

						// Update Page Title in browser window
						var pageTitle = $data.filter('title').text();
						document.title = pageTitle;


						$('#main-content').html( $data.find('.main-content__inside') );

						scrollPageToTop();

						$('#main-content').waitForImages(function(){
							$('body').addClass('ajax-main-content-loading-end');
							$('body').removeClass('ajax-main-content-loading-start');
							$(document).trigger('sleek:ajaxPageLoad');
						});

						ajaxPushGoogleAnalytics();
					}
				},

				error: function(){
					$('body').addClass('ajax-main-content-loading-end');
					$('body').removeClass('ajax-main-content-loading-start');
				}
			});

		}else{
			// Page Navigation

			$('body').addClass('ajax-content-wrapper-loading-start');
			$('body').removeClass('touchscreen-header-open'); // close header on touch devices

			timeStarted = new Date().getTime();

			sleek.xhr = $.ajax({
				type: "GET",
				url: href,
				success: function(data, response, xhr){

					// Check if css animation had time to finish
					// before new page load animation starts
					var now = new Date().getTime();
					var timeDiff = now - timeStarted;
					if( timeDiff < 1000 ) {
						setTimeout( ajaxLoadPageCallback, (1000-timeDiff) );
					}else{
						ajaxLoadPageCallback();
					}

					function ajaxLoadPageCallback(){
						var $data = $(data);

						// Update Page Title in browser window
						var pageTitle = $data.filter('title').text();
						document.title = pageTitle;

						$('#content-wrapper').html( $data.find('#content-wrapper-inside') );

						scrollPageToTop();

						$('#content-wrapper').waitForImages(function(){
							$('body').addClass('ajax-content-wrapper-loading-end');
							$('body').removeClass('ajax-content-wrapper-loading-start');
							$(document).trigger('sleek:ajaxPageLoad');
						});

						ajaxPushGoogleAnalytics();
					}
				},

				error: function(){
					$('body').addClass('ajax-content-wrapper-loading-end');
					$('body').removeClass('ajax-content-wrapper-loading-start');
				}
			});

		}
	}



	// Function: RegExp: Check if url external
	function isExternal(url) {

		if( url.match(/^#.*$/) ){
			return false;
		}

		var match = url.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);

		// Check protocol
		if( typeof match[1] === "string" && match[1].length > 0 && match[1].toLowerCase() !== location.protocol ){
			return true;
		}

		// Check hostname
		if( typeof match[2] === "string" && match[2].length > 0 && match[2].replace(new RegExp(":("+{"http:":80,"https:":443}[location.protocol]+")?$"), "") !== location.host ){
			return true;
		}

		// Check if WP baseUrl is exact
		// This enables Ajax to work on subfolder domains
		var regexBaseUrl = new RegExp(sleek.baseUrl+'([^\/]*)');
		match = url.match(regexBaseUrl);

		if( !match || match[1] !== '' ){
			return true;
		}

		return false;
	}



}

$(document).ready( ajaxLoadPages );





/*------------------------------------------------------------
 * FUNCTION: Start Mejs on AJAX load
 * Copied from : /wp-includes/js/mediaelement/wp-mediaelement.js?ver=3.9.1
 *------------------------------------------------------------*/

function sleekMejs(){

	$('audio.wp-audio-shortcode, video.wp-video-shortcode').each(function(){

		var $el = $(this);

		// check if already processed
		if(
			( $(this).parent().hasClass('mejs-mediaelement') ) ||
			( typeof mejs === 'undefined' )
		){
			return;
		}

		// add mime-type aliases to MediaElement plugin support
		mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
		mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');

		$(function () {
			var settings = {};

			if ( $( document.body ).hasClass( 'mce-content-body' ) ) {
				return;
			}

			if ( typeof _wpmejsSettings !== 'undefined' ) {
				settings.pluginPath = _wpmejsSettings.pluginPath;
			}

			settings.success = function (mejs) {
				var autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
				if ( 'flash' === mejs.pluginType && autoplay ) {
					mejs.addEventListener( 'canplay', function () {
						mejs.play();
					}, false );
				}
			};

			$el.mediaelementplayer( settings );
		});
	});

}

$(document).on( 'sleek:ajaxPageLoad', sleekMejs );





/*------------------------------------------------------------
 * FUNCTION: Loop Masonry
 * NOTE: keep masonry function after other layout-changers
 *------------------------------------------------------------*/

function loopMasonry(){
	// if Mobile on init, do nothing
	// if mobile on resize, keep masonry and continue
	if( sleek.device == 'mobile' ){
		if( !$('.js-loop-is-masonry').hasClass('loop-is-masonry--init-processed') ){
			return;
		}
	}



	$('.js-loop-is-masonry').each(function(){

		var el = this;
		var $el = $(this).addClass('loop-is-masonry');
		var $post = $el.find('.post').not('.masonry-processed');

		var masonry = new Masonry( el, {
			columnWidth: '.post--size-small',
			itemSelector: '.post',
			isInitLayout: false,
			isResizeBound: false
		});

		$el.waitForImages(function(){

			masonry.layout();
			$post.addClass('masonry-processed');
			$el.next('.pagination').removeClass('pagination--loading');

			// make loop visible after the initial masonry layout
			$el.addClass('loop-is-masonry--init-processed');
			// update height and scrolls
			layoutHeightEq();
			nanoScroll();

			// Make sure things are correctly laid out
			// Especially for the Safari + AdBlock Pro plugin which
			// delays the image load and breaks masonry
			setTimeout(function(){
				masonry.layout();
				layoutHeightEq();
				nanoScroll();
			},250);

		});

	});

}

$(document).ready( loopMasonry );
$(document).on( 'sleek:resize', loopMasonry );
$(document).on( 'sleek:ajaxPageLoad', loopMasonry );





/*------------------------------------------------------------
 * FUNCTION: Share Block
 *------------------------------------------------------------*/

function sharer(){

	$('.js-sharer').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		var windowFeatures = "height=320, width=640, status=no,resizable=yes,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
		window.open(link,'Sharer', windowFeatures);
	});

}

$(document).ready( sharer );
$(document).on( 'sleek:ajaxPageLoad', sharer );





/*------------------------------------------------------------
 * FUNCTION: Post Comments with AJAX
 *------------------------------------------------------------*/

function commentPostAjax(){

	var $form = $('#commentform');
	var $btn = $form.find('#submit');
	var url = $form.attr('action');
	var $comments = $('.comment__list .comments');

	// on submit click
	$btn.click(function(e){
		e.preventDefault();

		// validate form
		var formValid = true;
		$form.find('.required').each(function(){
			if( !$.trim( $(this).val() ) ){
				formValid = false;
				$(this).addClass('error');
			}else{
				$(this).removeClass('error');
			}

			// e-mail check
			if( $(this).attr('name') == 'email' ){
				if( !validateEmail( $(this).val() ) ){
					formValid = false;
					$(this).addClass('error');
				}else{
					$(this).removeClass('error');
				}
			}
		});

		if( !formValid ) {
			return;
		}

		var $textarea = $form.find('#comment');
		var parent = $form.find('#comment_parent').val();
		var $parent = $comments.find('#comment-'+parent);

		$.ajax({
			type: 'post',
			url: url,
			data: $form.serialize(),

			error: function(XMLHttpRequest, textStatus, errorThrown){
				$btn.val('Error');
			},

			success: function(data, textStatus){
				var $data = $(data).addClass('comment--ajax-loaded');

				// if new top level comment
				if( parent == '0' ){

					// if has no previous comments
					// add .comments wrapper & stuff
					// before appending new comment
					if( $comments.length === 0 ){
						$('#respond').before(
							'<div class="comment__list">'+
							'<h2 id="comments">1 Comment</h2>'+
							'<ul class="comments"></ul>'+
							'</div>'
						);
						$comments = $('.comment__list .comments');
					}

					$data.appendTo($comments);

				}else{

					// check if it already has .children wrapper, or add it
					if( !$parent.hasClass('parent') ){
						$parent.append('<ul class="children"></ul>');
						$parent.addClass('parent');
					}

					$data.appendTo( $parent.find('.children:first') );
					$('#cancel-comment-reply-link').trigger('click');

				}

				$textarea.val('');
				$data.addClass('comment--ajax-loaded-animate');
			}
		});

	});

}

$(document).ready( commentPostAjax );
$(document).on( 'sleek:ajaxPageLoad', commentPostAjax );





/*------------------------------------------------------------
 * FUNCTION: Load More of WP Comments
 *------------------------------------------------------------*/

function wpCommentsLoadMore(){

	$('html').on('click','.comment__pager a', function(e){
		e.preventDefault();
		var $el     = $('.comment__list');
		var $this   = $(this);
		var href    = $this.attr('href');

		$this.addClass('button--loading');

		$.get(href, function(data, status, xhr){
			// Success!

			// get, append and animate comments, trigger ajax complete event
			var comments = $(data).find('.comment__list .comments');
			comments.find('.comment').addClass('sleek-animate-appearance');
			$el.find('.comments').append( comments.html() );

			// wait for images to load before appearance and continuing
			$el.waitForImages(function(){
				$el.find('.sleek-animate-appearance').addClass('sleek-animate-appearance--start sleek-fade-in-bottom-soft');
			});

			// switch button with new
			var btn = $(data).find('.comment__list .comment__pager');
			$this.parent().html( btn.html() );

			// recalculate layout heights
			layoutHeightEq();

		})
		.fail(function(){
			$this.text('Error');
			$this.removeClass('button--loading');
		});
	});

}

$(document).ready( wpCommentsLoadMore );





/*------------------------------------------------------------
 * FUNCTION: Main Navigation Functions
 *------------------------------------------------------------*/

function mainNav(){

	var $el = $('.header__nav');
	var $link = $el.find('.menu-item > a');
	// var $link     = $el.find('.menu-item-has-children > a');
	var $linkTop  = $el.find('ul > .menu-item-has-children > a');
	var $linkLang = $el.find('.menu-item-language:not(.menu-item-has-children) > a');
	var activeCount = 0;

	// Set active state on load
	var $activeLink = $el.find('.current-menu-item');
	$activeLink.addClass('ajax-active');

	var $activeParent = $linkTop.parent().filter('.current-menu-ancestor');
	if( $activeParent.length > 0 ){
		$activeParent.addClass('active');
		$el.addClass('dropdown-open');
	}

	// Event: Parent Link Click - Activating Dropdown Open Mode
	$linkTop.click(function(e){

		if( $(this).attr('href') == '#' ){
			e.preventDefault();
		}

		var $currentParent = $(this).parent();

		if( $currentParent.hasClass('active') ){
			$el.removeClass('dropdown-open');
		}else{
			$el.addClass('dropdown-open');
		}
	});

	// Event: Link Click - Activating Item
	$link.click(function(e){

		if( $(this).attr('href') == '#' ){
			e.preventDefault();
		}

		// If link is not parent triggering dropdown
		if( !$(this).parent().hasClass('menu-item-has-children') ){
			// remove styling class from all
			$link.parent().removeClass('ajax-active');
			// add only for clicked link
			$(this).parent().addClass('ajax-active');
		}

		var $currentParent = $(this).parent();

		if( $currentParent.hasClass('active') ){
			$currentParent.removeClass('active ajax-active-parent');
			$currentParent.find('.menu-item-has-children').removeClass('active ajax-active-parent');
		}else{
			$currentParent.addClass('active ajax-active-parent');
			$currentParent.siblings().removeClass('active ajax-active-parent');
			$currentParent.siblings().find('.menu-item-has-children').removeClass('active ajax-active-parent');
		}

	});

	// Event: Language Link
	$linkLang.click(function(){
		var $currentParent = $(this).parent();
		if( $currentParent.hasClass('active') ){
			$currentParent.removeClass('active');
			$el.removeClass('dropdown-open');
		}else{
			$currentParent.addClass('active');
			$currentParent.siblings().removeClass('active');
			$el.addClass('dropdown-open');
		}
	});

}

$(document).ready( mainNav );





/*------------------------------------------------------------
 * FUNCTION: Animate Appearance
 *------------------------------------------------------------*/

function animateAppearance(){

	var $el = $('.sleek-animate-appearance');
	if ( $el.length === 0 ) {
		return;
	}

	function animateIfInViewport(){

		if( sleek.device == 'mobile' ){
			return;
		}

		$el.each(function(){
			var $this = $(this);

			requestAnimationFrame(function() {
				if ( $this.hasClass('sleek-animate-appearance--start') ){
					return;
				}

				if( $this.offset().top + 60 < sleek.windowHeight ){
					$this.addClass('sleek-animate-appearance--start');
				}
			});
		});
	}

	animateIfInViewport();
	$(document).off('.animateIfInViewport');
	$(document).on('sleek:scroll.animateIfInViewport', animateIfInViewport);
	$(document).on('sleek:resize.animateIfInViewport', animateIfInViewport);
}

$(document).ready( animateAppearance );
$(document).on( 'sleek:ajaxPageLoad', animateAppearance );





/*------------------------------------------------------------
 * FUNCTION: Progress Bar
 *------------------------------------------------------------*/

function progressBar(){

	$(document).off('.animateProgressBar');

	var $el = $('.progress-bar');
	if ( $el.length === 0 ) {
		return;
	}

	// Mobile: set width and skip animating
	if( sleek.device == 'mobile' ){

		$el.each(function(){
			var $this = $(this);

			if ( $this.hasClass('processed') ){
				return;
			}
			var percent = $this.attr('data-percent');
			$this.find('.bar div').width(percent+'%');
			$this.addClass('processed');
		});

		return;
	}

	function animateProgressBar(){
		$el.each(function(){
			var $this = $(this);

			requestAnimationFrame(function() {
				if ( $this.hasClass('processed') ){
					return;
				}

				if( $this.offset().top + 60 < sleek.windowHeight ){
					var percent = $this.attr('data-percent');
					$this.find('.bar div').width(percent+'%');
					$this.addClass('processed');
				}
			});
		});
	}

	animateProgressBar();
	$(document).on('sleek:scroll.animateProgressBar', animateProgressBar);
	$(document).on('sleek:resize.animateProgressBar', animateProgressBar);
}

$(document).ready( progressBar );
$(document).on( 'sleek:ajaxPageLoad', progressBar );





/*------------------------------------------------------------
 * FUNCTION: Fix 1px white line on middle related item
 *
 * 33.3% rounds on higher pixel, leaving image inside not filling it
 * Solution: If not dividable by 3, round the width and set to item
 *------------------------------------------------------------*/

function relatedItemsFix(){

	if( sleek.device == 'mobile' ){
		return;
	}

	var $el = $('.post__related');
	if ( $el.length === 0 ) {
		return;
	}

	var $item = $el.find('.post--related');
	if ( $item.length !== 3 ) {
		return;
	}

	var elWidth = $el.width();

	$item.width('');

	if( sleek.mainContentSize == 's' ){
		return;
	}

	if( elWidth % 3 == 2 ){
		$item.width( Math.floor( elWidth/3 ) );
	}

}

$(document).ready( relatedItemsFix );
$(document).on( 'sleek:ajaxPageLoad', relatedItemsFix );
$(document).on( 'sleek:resize', relatedItemsFix );





/*------------------------------------------------------------
 * FUNCTION: Gallery Masonry
 *------------------------------------------------------------*/

function galleryMasonry(){
	// if mobile on init, do nothing
	// if mobile on resize, keep masonry and carry on
	if( sleek.device == 'mobile' ){
		if( !$('.js-gallery-masonry').hasClass('gallery-masonry--init-processed') ){
			return;
		}
	}



	$('.js-gallery-masonry').each(function(){

		var el = this;
		var $el = $(this);
		var $image = $el.find('.gallery-item').not('.masonry-processed');

		var masonry = new Masonry( el, {
			columnWidth: '.gallery-item',
			itemSelector: '.gallery-item',
			// isInitLayout: false,
			isResizeBound: false
		});

		$el.waitForImages(function(){

			masonry.layout();
			$image.addClass('masonry-processed');
			$el.addClass('gallery-masonry--init-processed');

			// update height and scrolls
			layoutHeightEq();
			nanoScroll();

		});

	});

}

$(document).ready( galleryMasonry );
$(document).on( 'sleek:resize', galleryMasonry );
$(document).on( 'sleek:ajaxPageLoad', galleryMasonry );





/*------------------------------------------------------------
 * FUNCTION: Sleek Lightbox
 * Use 'active' for place of active slide in array of slides
 *------------------------------------------------------------*/

function sleekLightbox( images, active ){

	// Add lightbox html to the page
	if( $('.sleek-lightbox').length === 0 ){
		$('body').append('<div class="sleek-lightbox dark-mode"><div class="sleek-lightbox__mask js-close"></div><div class="sleek-loader"></div><div class="sleek-lightbox__content"></div><div class="sleek-lightbox__close js-close"><i class="icon-cross"></i></div><div class="sleek-lightbox__info"></div><div class="sleek-lightbox__arrow sleek-lightbox__arrow--prev js-arrow-prev"><i class="icon-arrow-left"></i></div><div class="sleek-lightbox__arrow sleek-lightbox__arrow--next js-arrow-next"><i class="icon-arrow-right"></i></div></div>');
	}



	// Init Lightbox
	var $el = $('body').find('.sleek-lightbox').fadeIn(300);
	var $content = $el.find('.sleek-lightbox__content');
	var $loader = $el.find('.sleek-loader');
	active = parseInt(active);

	// activate clicked slide
	activate();



	// Activate lightbox slide
	function activate(){

		var imgUrl = images[active].url;
		var caption= images[active].caption;

		// update info counter
		$el.find('.sleek-lightbox__info').html( (active + 1) + '/' + images.length );

		// get image and caption in
		$content.stop().fadeOut(300, function(){
			$content.html('<img src="'+imgUrl+'">');
			if( caption ){
				$content.append('<div class="sleek-slider__caption">'+caption+'</div>');
			}

			$loader.stop().animate( {'opacity': 1}, 500 );

			$content.waitForImages( function(){
				$content.fadeIn(300);
				$loader.stop().animate( {'opacity': 0}, 300 );
			});
		});
	}



	// Activate Next Item
	function activateNext() {

		// if next item in array - select it, else jump to start
		if( active < images.length - 1 ){
			active++;
		}else{
			active = 0;
		}

		activate();
	}

	// Activate Next Item
	function activatePrev() {

		// if next item in array - select it, else jump to start
		if( active > 0 ){
			active = active - 1;
		}else{
			active = images.length - 1;
		}

		activate();
	}

	// Close lightbox
	$el.find('.js-close').click(function(){
		$el.fadeOut(300, function(){
			$el.remove();
		});
	});

	// Lock Events for a limited time
	var locked;
	var lockTimeout;
	function lockEvents(delay){
		delay = delay ? delay : 200;
		locked = true;
		clearTimeout(lockTimeout);
		lockTimeout = setTimeout( function(){
			locked = false;
		}, delay);
	}

	// Events
	$el.on( 'click', '.js-arrow-next', activateNext );
	$el.on( 'click', '.js-arrow-prev', activatePrev );
	$el.on( 'click', 'img', function(){
		if( !locked ){
			activateNext();
		}
	});

	// Arrow keys
	$(document).keydown(function(e){
		if( e.which == 37 ) {
			activatePrev();
		}
		if( e.which == 39 ) {
			activateNext();
		}
	});

	// Touch-Swipe functionality
	$el.swipe( {
		swipeRight: function(){
			activatePrev();
			lockEvents();
		},
		swipeLeft: function(){
			activateNext();
			lockEvents();
		},
		threshold:40,
		excludedElements:''
	});

}





/*------------------------------------------------------------
 * FUNCTION: Gallery Lightbox trigger
 *------------------------------------------------------------*/

function galleryLightbox(){

	$('.gallery--lightbox').each(function(){

		var $el = $(this);
		var $item = $el.find('.gallery-item');

		// gather array of img + caption for lightbox
		var lightboxArray = [];

		$item.each( function(){

			var imgUrl = $(this).find('.gallery-icon a').attr('href');
			var caption = $(this).find('.gallery-caption').html();

			lightboxArray.push({
				url: imgUrl,
				caption: caption
			});

		});

		$item.on( 'click', '.gallery-icon a', function(e){

			// Don't fire lightbox if on mobile
			// if( sleek.device == 'mobile' ){ return; }

			e.preventDefault();
			var activeId = $(this).closest('.gallery-item').attr('data-item-id');

			sleekLightbox( lightboxArray, activeId );
		});

	});

}

$(document).ready( galleryLightbox );
$(document).on( 'sleek:ajaxPageLoad', galleryLightbox );





/*------------------------------------------------------------
 * FUNCTION: Wrap Select for styling
 *------------------------------------------------------------*/

function sleekWrapSelect(){

	$('select').not('.sleek-js-processed').each(function(){
		var $el = $(this);

		$el.wrap('<div class="sleek-select-wrap"></div>');
		$el.addClass('sleek-js-processed');
	});

}

$(document).ready( sleekWrapSelect );
$(document).on( 'sleek:ajaxPageLoad', sleekWrapSelect );










})(jQuery);

"use strict";

/**
 * Equal sidebar and content height
 */
function ddEqualSidebar() {

	if(jQuery('#sidebar').length){

		jQuery('#sidebar-inner').height('auto');

		var sidebar_height = jQuery('#sidebar-inner').height();
		var content_height = jQuery('#content').height()

		if(content_height > sidebar_height){ jQuery('#sidebar-inner').height(content_height); }

	}

}

/**
 * Multicol Colors
 */
function ddHeaderColors() {

	if ( jQuery('.multicol-colors').length ) {

		jQuery('.multicol-colors').each(function(){

			var color,
			element,
			container = jQuery(this),
			elements = container.find('li'),
			count = elements.length,
			percentage = 100 / count + '%';

			elements.css({ width : percentage });

			elements.each(function(){

				element = jQuery(this);
				color = element.data('color');
				element.css({ background : color });

			});

		});

	}

}

/**
 * Initiate Masonry
 */
function ddMasonry( container, selector ) {

	var itemWidth = jQuery(selector, container).outerWidth();
	var containerWidth = jQuery(container).outerWidth();
	var gutterWidth = 20;

	jQuery(container).masonry({
		itemSelector : selector,
		gutterWidth : gutterWidth,
		columnWidth: function() {
			return jQuery('div', container).width();
		}
	});

}

/**
 * Initiate Slider
 */
function ddSlider() {
	
	jQuery('#slider').each(function(){

		/* Default values */
		var def = {
			autoplay: '0',
			loop: 'enabled',
			animation: 'slide'
		};

		/* User values */
		var usr = {
			autoplay: jQuery(this).data('autoplay'),
			loop: jQuery(this).data('loop'),
			animation: jQuery(this).data('animation')
		};
		
		/* Merge values */
		var opts = jQuery.extend({}, def, usr);
		
		/* Loop value */
		if ( opts.loop == 'enabled' )
			opts.loop = true;
		else
			opts.loop = false;

		/* Other vars */
		var autoplay_state = opts.autoplay != '0' ? true : false;
		
		jQuery('#slider').show();

		/* Find out the width */
		var slide_width = jQuery(this).width();

		/* Init slider */
		jQuery(this).find('.flexslider').flexslider({
			animation: opts.animation,
			slideshow: autoplay_state,
			slideshowSpeed: parseInt(opts.autoplay),
			controlNav: false,
			itemWidth: slide_width,
			animationLoop: opts.loop,
			prevText: '',
			nextText: '',
			useCSS: false,
			smoothHeight: false,
			pauseOnHover: true,
			start: function(){
				ddEqualSidebar();
				ddSliderNav();
			},
			before: function(slider){
				ddCauseRaisedAnimate( '#slider' );
			},
			after: function(slider) {
				var curSlideIndex = slider.currentSlide;
				jQuery('#slider-nav .slide:eq(' + curSlideIndex + ')').click();
			}
		});

		if( jQuery(this).find('.slides li:not(.clone)').length < 2 ){
			jQuery(this).find('.slider-prev, .slider-next').remove();
		}

		jQuery('.slider-prev').on('click', function(e){

			e.preventDefault();
			jQuery('#slider .flexslider').flexslider('prev');

		});

		jQuery('.slider-next').on('click', function(e){

			e.preventDefault();
			jQuery('#slider .flexslider').flexslider('next');

		});
		
	});

}

/**
 * Slider Navigation
 */
function ddSliderNav() {

	var sliderNav = jQuery('#slider-nav');

	if ( sliderNav.length ) {

		if ( jQuery( '#slider .flexslider li.slide' ).length < 2 ) {
			sliderNav.hide();
		}

		// Variables
		var currOffset, maxOffset,
		slidesWrapper = jQuery( 'ul', sliderNav ),
		slides = jQuery( 'li', sliderNav );

		// Set active
		jQuery( 'li:first-child', sliderNav ).addClass('active').next().addClass('next');

		// Calculate max offset

		maxOffset = -1 * ( slidesWrapper.height() - sliderNav.height() + 27 * 2 );

		// Previous

		jQuery(document).on('click', '#slider-nav-prev', function(e){
			
			e.preventDefault();

			var sliderNavHeight = jQuery('#slider-nav').height();
			var sliderNavOffset = jQuery('#slider-nav').offset().top;
			var currSlideRealOffset;

			jQuery('#slider-nav li').each(function(){

				var currSlideOffset = jQuery(this).offset().top;
				currSlideRealOffset = sliderNavOffset - currSlideOffset;

				if ( currSlideRealOffset > ( sliderNavHeight * -1 ) ) {
					jQuery(this).next().addClass('slide-nav-last').siblings().removeClass('slide-nav-last');
				}

				if ( currSlideRealOffset < 0 && currSlideRealOffset > ( -1 * jQuery('#slider-nav li').outerHeight() ) ) {
					if ( jQuery(this).prev().prev().length ) {
						jQuery(this).prev().prev().addClass('slide-nav-first').siblings().removeClass('slide-nav-first');
					} else if ( jQuery(this).prev().length ) {
						jQuery(this).prev().addClass('slide-nav-first').siblings().removeClass('slide-nav-first');
					} else {
						jQuery(this).addClass('slide-nav-first').siblings().removeClass('slide-nav-first');
					}
				}

			});

			var firstSlideOffset = -1 * jQuery('.slide-nav-first').position().top + 27;			

			var currOffset = slidesWrapper.position();
			var newOffset = firstSlideOffset;

			if ( newOffset > 0 )
				newOffset = 0;

			slidesWrapper.stop().animate({ top : newOffset }, 500);

		});

		// Next

		jQuery(document).on('click', '#slider-nav-next', function(e){

			e.preventDefault();

			var sliderNavHeight = jQuery('#slider-nav').height();
			var sliderNavOffset = jQuery('#slider-nav').offset().top;
			var currSlideRealOffset;

			jQuery('#slider-nav li').each(function(){

				var currSlideOffset = jQuery(this).offset().top;
				currSlideRealOffset = sliderNavOffset - currSlideOffset;

				if ( currSlideRealOffset > ( sliderNavHeight * -1 ) ) {
					jQuery(this).next().addClass('slide-nav-last').siblings().removeClass('slide-nav-last');
				}

				if ( currSlideRealOffset < 0 && currSlideRealOffset > ( -1 * jQuery('#slider-nav li').outerHeight() ) ) {
					jQuery(this).prev().prev().addClass('slide-nav-first').siblings().removeClass('slide-nav-first');
				}

			});

			var lastSlideOffset = -1 * ( jQuery('.slide-nav-last').position().top - sliderNavHeight ) - jQuery('.slide-nav-last').outerHeight() - 27;

			var currOffset = slidesWrapper.position();
			var newOffset = lastSlideOffset;

			if ( newOffset < maxOffset )
				newOffset = maxOffset;

			slidesWrapper.stop().animate({ top : newOffset }, 500);

		});

		// Click

		jQuery(document).on('click', '#slider-nav li', function(e){

			e.preventDefault();

			if ( jQuery('#slider .flexslider .slides:not(:animated)').length ) {

				var position = jQuery(this).index();

				jQuery('#slider .next').removeClass('next');
				jQuery(this).addClass('active').siblings('.active').removeClass('active').end().next().addClass('next');

				jQuery('#slider').find('.flexslider').flexslider(position);

				/* If at end slide nav */

				var sliderNavHeight = jQuery('#slider-nav').height();
				var sliderNavOffset = jQuery('#slider-nav').offset().top;
				var currSlideOffset = jQuery(this).offset().top;

				if ( currSlideOffset > ( sliderNavHeight - 60 ) )
					jQuery('#slider-nav-next').click();
				else if ( currSlideOffset < jQuery('#slider-nav .slide').height() * 2.5 )
					jQuery('#slider-nav-prev').click();

			}

		});

		// Hover

		jQuery('#slider-nav li').mouseenter(function(){			

			jQuery('#slider .next-hover').removeClass('next-hover');
			jQuery(this).addClass('active-hover').siblings('.active-hover').removeClass('active-hover').end().next().addClass('next-hover');

		}).mouseleave(function(){

			jQuery('#slider .active-hover').removeClass('active-hover');
			jQuery('#slider .next-hover').removeClass('next-hover');

		});

	}

}

/**
 * Initiate Carousel
 */
function ddCarousel() {
	
	jQuery('.carousel').each(function(){

		var carousel = jQuery(this);
		var container = carousel.closest('.container');
		var autoplay = carousel.data('autoplay');

		if ( jQuery(this).hasClass('events') )
			var minSlides = 3;
		else
			var minSlides = 5;

		if ( jQuery('.flexslider li', carousel).length < minSlides )
			jQuery('.carousel-nav', carousel.closest('.home-section')).hide();

		/* Default values */
		var def = {
			autoplay: false,
			loop: false,
			autoplaybar: true,
			animation: 'slide',
			arrows: true
		};
		
		/* Other vars */
		var autoplay_state = def.autoplay != false ? true : false;

		if ( autoplay == '0' )
			autoplay_state = false;
		else
			autoplay_state = true;
		
		/* Find out the width */
		var slide_width = jQuery('.slides > li', carousel).width();

		if ( carousel.width() < 450 )
			slide_width = '';

		var startAt = 0;

		if ( carousel.find('li.start-at').length )
			startAt = carousel.find('li.start-at').index();

		/* Init slider */
		jQuery(this).find('.flexslider').flexslider({
			animation: def.animation,
			slideshow: autoplay_state,
			slideshowSpeed: parseInt(autoplay),
			controlNav: false,
			itemWidth: slide_width,
			itemMargin: 20,
			animationLoop: def.loop,
			prevText: '',
			nextText: '',
			startAt : startAt,
			start: function(){
				ddEqualSidebar();
				ddCenterButtons();
				ddSponsorsEqualHeight();
				jQuery(window).trigger('resize');
			},
			before: function(){
				ddCauseRaisedAnimate( carousel );
			}
		});

		jQuery('.carousel-prev', container).on('click', function(e){

			e.preventDefault();
			jQuery('.flexslider', carousel).flexslider('prev');

		});

		jQuery('.carousel-next', container).on('click', function(e){

			e.preventDefault();
			jQuery('.flexslider', carousel).flexslider('next');

		});
		
	});

}

/**
 * Center Arrows
 */
function ddCenterArrows() {

	jQuery('.carousel-nav').each(function(){

		var carousel = jQuery(this).closest('.carousel');
		var carouselHeight = carousel.height();
		var arrowHeight = jQuery('a', this).height();
		var centerOffset = carouselHeight / 2 - arrowHeight / 2 + arrowHeight;

		jQuery(this).css({ bottom : centerOffset });

	});

}

/**
 * Initiate Gallery Slider
 */
function ddGallerySlider() {
	
	jQuery('.gallery-single-carousel').each(function(){

		var carousel = jQuery(this);

		/* Default values */
		var def = {
			autoplay: false,
			loop: false,
			autoplaybar: true,
			animation: 'slide',
			arrows: true
		};
		
		/* Other vars */
		var autoplay_state = def.autoplay != false ? true : false;
		
		/* Find out the width */
		var slide_width = 75;

		/* Init slider */
		jQuery(this).find('.flexslider').flexslider({
			animation: def.animation,
			slideshow: autoplay_state,
			slideshowSpeed: parseInt(def.autoplay),
			controlNav: false,
			itemWidth: slide_width,
			itemMargin: 0,
			animationLoop: def.loop,
			prevText: '',
			nextText: '',
			asNavFor: '.gallery-single-slider .flexslider',
			start: function(){

				ddShowHideGalleryArrows();

				/* Init slider */
				jQuery('.gallery-single-slider').find('.flexslider').flexslider({
					animation: def.animation,
					slideshow: autoplay_state,
					slideshowSpeed: parseInt(def.autoplay),
					controlNav: false,
					itemMargin: 0,
					animationLoop: def.loop,
					prevText: '',
					nextText: '',
					sync: '.gallery-single-carousel .flexslider',
					start: function(){
						ddEqualSidebar();
					}
				});

			}
		});

		jQuery('.carousel-prev', carousel).on('click', function(e){

			e.preventDefault();
			jQuery('.flex-prev', carousel).click();

		});

		jQuery('.carousel-next', carousel).on('click', function(e){

			e.preventDefault();
			jQuery('.flex-next', carousel).click();

		});

		jQuery('.gallery-slider-prev', jQuery('.gallery-single-slider')).on('click', function(e){

			e.preventDefault();
			jQuery('.flex-prev', jQuery('.gallery-single-slider')).click();

		});

		jQuery('.gallery-slider-next', jQuery('.gallery-single-slider')).on('click', function(e){

			e.preventDefault();
			jQuery('.flex-next', jQuery('.gallery-single-slider')).click();

		});
		
	});

}

/**
 * Center Buttons
 */
function ddCenterButtons() {

	var overlay, overlayParent, centerOffset;

	jQuery('.gallery-thumb-overlay a').each(function(){

		overlay = jQuery(this);
		overlayParent = overlay.closest('.gallery-thumb-overlay');
		centerOffset = overlayParent.height() / 2 - overlay.height() / 2;

		overlay.css({ marginTop : centerOffset });

	});

	jQuery('.product-thumb-overlay-inner').each(function(){

		overlay = jQuery(this);
		overlayParent = overlay.closest('.product-thumb-overlay');
		centerOffset = overlayParent.height() / 2 - overlay.height() / 2;

		overlay.css({ marginTop : centerOffset });

	});

}

/**
 * Show Hide Gallery Arrows
 */
function ddShowHideGalleryArrows() {

	var containerWidth, itemsWidth;

	if ( jQuery('body').hasClass('single-dd_gallery') ) {

		containerWidth = jQuery('.gallery-single-carousel').width();
		itemsWidth = jQuery('.gallery-single-carousel li.slide').outerWidth(true) * jQuery('.gallery-single-carousel li.slide').length;

		if ( itemsWidth < containerWidth )
			jQuery('.gallery-single-carousel .carousel-nav').hide();
		else
			jQuery('.gallery-single-carousel .carousel-nav').show();

	}

}

/**
 * Initiate Products Slider
 */
function ddProductsSlider() {
	
	jQuery('.products-slider').each(function(){

		var carousel = jQuery('.products-carousel');

		/* Default values */
		var def = {
			autoplay: '0',
			loop: 'enabled',
			animation: 'slide'
		};

		/* User values */
		var usr = {
			autoplay: jQuery(this).data('autoplay'),
			loop: jQuery(this).data('loop'),
			animation: jQuery(this).data('animation')
		};
		
		/* Merge values */
		var opts = jQuery.extend({}, def, usr);
		
		/* Loop value */
		if ( opts.loop == 'enabled' )
			opts.loop = true;
		else
			opts.loop = false;

		/* Other vars */
		var autoplay_state = opts.autoplay != '0' ? true : false;
		
		/* Find out the width */
		var slide_width = jQuery(this).width();

		/* Init slider */

		jQuery('.products-slider').prev('.slider-container-loader').hide();

		jQuery('.products-carousel').find('.flexslider').flexslider({
			animation: def.animation,
			slideshow: autoplay_state,
			slideshowSpeed: parseInt(def.autoplay),
			controlNav: false,
			itemWidth: 65,
			itemMargin: 30,
			animationLoop: def.loop,
			prevText: '',
			nextText: '',
			asNavFor: '.products-slider .flexslider',
			start: function(){

				jQuery('.products-carousel').css({ opacity : 1 });
				jQuery('.products-slider').show();

				ddShowHideGalleryArrows();

				/* Init slider */
				jQuery('.products-slider').find('.flexslider').flexslider({
					animation: def.animation,
					slideshow: autoplay_state,
					slideshowSpeed: parseInt(def.autoplay),
					controlNav: false,
					itemMargin: 0,
					animationLoop: def.loop,
					prevText: '',
					nextText: '',
					smoothHeight: true,
					sync: '.products-carousel .flexslider',
					start: function(){
						ddEqualSidebar();
					}
				});

				if ( jQuery('.flexslider .slides li', carousel).length < 2 )
					carousel.hide();

			}
		});

		jQuery('.products-carousel-nav-prev', carousel).on('click', function(e){

			e.preventDefault();
			jQuery('.flex-prev', carousel).click();

		});

		jQuery('.products-carousel-nav-next', carousel).on('click', function(e){

			e.preventDefault();
			jQuery('.flex-next', carousel).click();

		});
		
	});

	jQuery('.products-slider .flexslider li').each(function(){

		if ( jQuery(this).data('bg-color') !== 'default' )
			jQuery(this).css({ backgroundColor : jQuery(this).data('bg-color') });

	});

}

/**
 * Slider Shortcode
 */
function ddSliderShortcode() {
	
	jQuery('.slider-container').each(function(){

		var slider_container = jQuery(this);
		var slider = jQuery('.slider', this);
		var slider_nav = jQuery('.slider-nav', this);

		/* Default values */
		var def = {
			autoplay: '0',
			loop: 'enabled',
			animation: 'slide'
		};

		/* User values */
		var usr = {
			autoplay: jQuery(this).data('autoplay'),
			loop: jQuery(this).data('loop'),
			animation: jQuery(this).data('animation')
		};
		
		/* Merge values */
		var opts = jQuery.extend({}, def, usr);
		
		/* Loop value */
		if ( opts.loop == 'enabled' )
			opts.loop = true;
		else
			opts.loop = false;

		/* Other vars */
		var autoplay_state = opts.autoplay != '0' ? true : false;

		/* Init slider */
		slider_nav.find('.flexslider').flexslider({
			animation: def.animation,
			slideshow: autoplay_state,
			slideshowSpeed: parseInt(def.autoplay),
			controlNav: false,
			itemWidth: 65,
			itemMargin: 30,
			animationLoop: def.loop,
			prevText: '',
			nextText: '',
			asNavFor: slider.find('.flexslider'),
			start: function(){

				slider_container.prev('.slider-container-loader').hide();

				/* Init slider */
				slider.find('.flexslider').flexslider({
					animation: def.animation,
					slideshow: autoplay_state,
					slideshowSpeed: parseInt(def.autoplay),
					controlNav: false,
					itemMargin: 0,
					animationLoop: def.loop,
					prevText: '',
					nextText: '',
					smoothHeight: true,
					sync: slider_nav.find('.flexslider'),
					start: function(){
						slider_container.css({ opacity : 1 });
						ddEqualSidebar();
					}
				});

			}
		});

		jQuery('.slider-nav-arrow-prev', slider_nav).on('click', function(e){

			e.preventDefault();
			jQuery('.flexslider', slider_nav).flexslider('prev');

		});

		jQuery('.slider-nav-arrow-next', slider_nav).on('click', function(e){

			e.preventDefault();
			jQuery('.flexslider', slider_nav).flexslider('next');

		});
		
	});

}

/**
 * Twitter
 */
function ddTwitter() {

	var containerWidth = jQuery('#footer-top-inner').width();
	var profileWidth = jQuery('#footer-top-inner .footer-twitter-profile').outerWidth();
	var navWidth = jQuery('#footer-top-inner .footer-twitter-nav').outerWidth();
	var tweetsWidth = containerWidth - profileWidth - navWidth;

	jQuery('.footer-twitter-tweets').width(tweetsWidth).find('.flexslider').flexslider({
		animation: 'slide',
		slideshow: false,		
		controlNav: false,
		animationLoop: false,
		prevText: '',
		nextText: ''
	});

	jQuery('.footer-twitter-nav-prev').click(function(e){

		e.preventDefault();

		jQuery('.footer-twitter-tweets').find('.flexslider').flexslider('prev');

	});

	jQuery('.footer-twitter-nav-next').click(function(e){

		e.preventDefault();

		jQuery('.footer-twitter-tweets').find('.flexslider').flexslider('next');

	});

}

/**
 * Tabs
 */
function ddTabs() {

	jQuery('.tabs-container').each(function(){

		var tabs = jQuery(this);
		var tabsNav = tabs.find('.tabs-nav');
		var tabsContent = tabs.find('.tabs-content');

		// First tab active
		tabsNav.find('li:first-child').addClass('active');
		tabsContent.find('.tab-content:first-child').siblings('.tab-content').hide().css( 'opacity', 0);

		tabsNav.find('a').click(function(e){

			e.preventDefault();

			jQuery(this).closest('li').addClass('active').siblings('.active').removeClass('active');
			var tabNew = tabsContent.find('.tab-content').eq(jQuery(this).closest('li').index());

			tabsContent.find('.tab-content').stop().animate({ opacity : 0 }, 200, function(){
				tabNew.siblings('.tab-content').hide().end().stop().show().animate({ opacity : 1 }, 200);
			});

		});

	});

}

/**
 * Equal Donate Overlay
 */
function ddEqualDonateOverlay() {

	var overlayHeight = jQuery('.lb-overlay-inner').outerHeight();
	var windowHeight = jQuery(window).height();
	var centerOffset = windowHeight / 2 - overlayHeight / 2;

	jQuery('.lb-overlay-inner').css({ marginTop : centerOffset });

}

/**
 * Causes Widget
 */
function ddCausesWidgetCarousel() {
	
	jQuery('.causes-widget-carousel').each(function(){

		/* Default values */
		var def = {
			autoplay: '0',
			loop: 'enabled',
			animation: 'fade'
		};

		/* User values */
		var usr = {
			autoplay: jQuery(this).data('autoplay'),
			loop: jQuery(this).data('loop'),
			animation: jQuery(this).data('animation')
		};
		
		/* Merge values */
		var opts = jQuery.extend({}, def, usr);
		
		/* Loop value */
		if ( opts.loop == 'enabled' )
			opts.loop = true;
		else
			opts.loop = false;

		/* Other vars */
		var autoplay_state = opts.autoplay != '0' ? true : false;
		
		/* Find out the width */
		var slide_width = jQuery(this).width();

		/* Init slider */
		jQuery(this).find('.flexslider').flexslider({
			animation: opts.animation,
			slideshow: autoplay_state,
			slideshowSpeed: parseInt(opts.autoplay),
			controlNav: false,
			itemWidth: slide_width,
			animationLoop: opts.loop,
			prevText: '',
			nextText: '',
			useCSS: false,
			start: function(){
				ddEqualSidebar();
			}
		});

		if( jQuery(this).find('.slides li:not(.clone)').length < 2 ){
			jQuery(this).find('.causes-widget-carousel-nav').remove();
		}

		jQuery('.causes-widget-carousel-prev').on('click', function(e){

			e.preventDefault();
			jQuery(this).closest('.causes-widget-carousel').find('.flexslider').flexslider('prev');

		});

		jQuery('.causes-widget-carousel-next').on('click', function(e){

			e.preventDefault();
			jQuery(this).closest('.causes-widget-carousel').find('.flexslider').flexslider('next');

		});
		
	});

}

/**
 * Cause Raised Animate
 */
function ddCauseRaisedAnimate( container ){

	if ( container == undefined) container = 'body';

	var the_container = jQuery(container);

	jQuery('.cause-info-widget-percentage-bar, .cause-info-bar', the_container).each(function(){

		var _this = jQuery(this);
		var percentage = _this.data('raised');

		jQuery('span', _this).css( 'width', 0 ).animate({ width : percentage }, 1000);

	});

}

/**
 * Flickr Feed
 */
function ddFlickrFeed() {

	jQuery('.flickr-feed').each(function(){

		var flickr_id = jQuery(this).data('id');
		var flickr_amount = jQuery(this).data('amount');

		jQuery(this).jflickrfeed({
			limit: flickr_amount,
			qstrings: {
				id: flickr_id
			},
			itemTemplate: '<span><a href="{{image_b}}" target="_blank"><img alt="{{title}}" src="{{image_s}}" /></a></span>'
		});

	});


}

/**
 * Sponsors - Equal Height
 */

function ddSponsorsEqualHeight() {

	jQuery('.sponsors').each(function(){

		var sponsors = jQuery(this);
		var sponsor = jQuery('.sponsor-inner', sponsors);
		var sponsorTallest = 0;

		sponsor.each( function(){
			if ( sponsor.height() > sponsorTallest )
				sponsorTallest = sponsor.height();
		});

		if ( sponsorTallest > 10 ) {
			sponsor.css({ height : sponsorTallest });
		}

	});

}

/**
 * DOM Ready
 */

jQuery(document).ready(function($){

	ddHeaderColors();
	ddTabs();
	ddCauseRaisedAnimate();
	ddFlickrFeed();

	/**
	 * Sticky Header
	 */

	if ( $('body').hasClass('sticky-header') ) {

		$('#page-container').css({ paddingTop : $('#header').outerHeight() });

	}

	/**
	 * Move events/causes widget after slider
	 */

	$('.single-dd_causes #content .widget, .single-dd_events #content .widget').each(function(){

		if ( $(this).next('.slider-container-loader') ) {

			$(this).insertAfter($(this).next('.slider-container-loader').next('.slider-container'));

		}

	});

	$('input, textarea').placeholder();

	$('.sub-menu').each(function(){
		$('li:last-child', this).addClass('last-child');
	});

	/**
	 * Header Search
	 */

	$('.header-search span').click(function(){

		if ( $('.header-search').hasClass('header-search-active') ) {
			$('.header-search').removeClass('header-search-active').find('.header-search-container').animate({ opacity : 0, top : 10 }, 400, function(){
				$('.header-search-container').hide();
			});
		} else {
			$('.header-search').addClass('header-search-active').find('.header-search-container').show().animate({ opacity : 1, top : 33 }, 400);
		}

	});

	/**
	 * Footer Banner
	 */

	var footer_banner_img = $('#footer-banner').data('bg-image');
	if ( footer_banner_img != 'none' )
		$('#footer-banner').css({ 'background-image' : 'url(' + footer_banner_img + ')' });

	/**
	 * Sign in Submit
	 */

	$('.dd-login-submit-hook').click(function(){
		$('#dd-login-submit-form').submit();
	});

	/**
	 * Sign in
	 */
	$('#header .sign-in').click(function(e){

		e.preventDefault();

		$('#lb-overlay-sign-in').fadeIn(200);
		ddEqualDonateOverlay();

	});

	/**
	 * If login errors shown, show the sign in overlay
	 */

	if ( $('.lb-overlay-form-errors').length ) {
		$('#header .sign-in').trigger('click');
	}

	/**
	 * Sub header - Previous of active without border
	 */
	$('#sub-header a.active').prev('a').addClass('no-border-right');

	/**
	 * No posts Events Header
	 */

	$('#sub-header .no-posts').click(function(e){
		e.preventDefault();
	});

	/**
	 * Donate - Load More Causes
	 */

	$('.causes-load-more').on('click', function(e){

		// Stop default behaviour
		e.preventDefault();

		// Declare vars
		var current_page, next_page, next_page_link,
		_this = jQuery(this),
		container = '.causes';

		// If there are more posts
		if ( ! _this.hasClass('causes-load-more-finished') ) {

			// Change text
			_this.find('.causes-load-more-text').html(_this.data('loading'));

			// Get the pages info
			current_page = $('.current', '#pagination');
			next_page = current_page.next('li');
			next_page_link = $('a', next_page).attr('href');

			// Fetch, append and prepare for next page
			$.get(next_page_link, function(data){ 

				// Append the content
				$(container + ' > .cause', data).appendTo(container);

				// Animate the causes percentages
				ddCauseRaisedAnimate(container);

				// Remove current class from previous page
				current_page.removeClass('current');

				// Add current class to current page
				next_page.addClass('current');

				// If there are no more posts
				if ( ! next_page.next('li').length )
					_this.addClass('causes-load-more-finished').find('.causes-load-more-text').html(_this.data('finished'));
				else
					_this.find('.causes-load-more-text').html(_this.data('default'));			

			});

		}

	});

	/**
	 * Cause Single - Donate
	 */

	$('.cause-info-widget-donate a').click(function(e){

		if ( $(this).attr('href') == '#' ) {

			e.preventDefault();

			$('#lb-overlay-donate').fadeIn(200);
			ddEqualDonateOverlay();

		}

	});

	$('.lb-overlay').click(function(e) {

		if (e.target.className === 'lb-overlay')
				$('.lb-overlay').fadeOut(200);	

	});

	/**
	 * Button DropDown
	 */

	$('.dd-button-dropdown').mouseenter(function(){
		$('.dd-button-dropdown-content', this).slideDown(200);
	}).mouseleave(function(){
		$('.dd-button-dropdown-content', this).stop().slideUp(200);
	});

	$('.dd-button-dropdown a').click(function(e){

		if ( $(this).attr('href') == '#' ) {

			e.preventDefault();

			$('.dd-button-dropdown-content', $(this).closest('.dd-button-dropdown')).stop().slideUp(200);

			$(this).closest('.dd-button-dropdown').find('.dd-button-txt').text($(this).text());

		}

	});

	/**
	 * Last Classes
	 */
	 $('#footer .widget:last-child').addClass('last');

	 /**
	  * Events Calendar
	  */

	 $(document).on('click', '.events-calendar td a', function(e){

	 	if ( $(this).closest('.widget').length ) {

	 	} else {

	 		e.preventDefault();

		 	var container = $(this).closest('.home-section');
		 	var slider = container.find('.flexslider');

		 	var day = $(this).data('day');
		 	var firstOnDay = slider.find('li[data-day="' + day + '"]:first').index();
		 	var lastItem = slider.find('li[data-day="' + day + '"]:last-child').index();

		 	if ( firstOnDay == lastItem ) {

		 		$(this).closest('.home-section').find('.flexslider').flexslider(lastItem - 1);

		 	} else {

			 	if ( firstOnDay != -1 )
					$(this).closest('.home-section').find('.flexslider').flexslider(firstOnDay);

			}

		}

	 });

	 $(document).on('click', '.events-calendar-caption a', function(e){

	 	e.preventDefault();

	 	var _this = $(this);
	 	var calendar = _this.closest('.events-calendar');
	 	var goToMonth = _this.data('month');
	 	var goToYear = _this.data('year');

	 	if ( ! calendar.hasClass('loading') ) {

		 	calendar.addClass('loading');

		 	jQuery.post(

				DDAjax.ajaxurl,
				{
					action : 'dd-events-calendar',
					month : goToMonth,
					year : goToYear
				},
				function( response ) {
					
					calendar.after(response.output);
					calendar.animate({ marginLeft : -380 }, 300, function(){
						calendar.remove();
					});
					calendar.removeClass('loading');				

				}

			);

		}

	 });
	
	/**
	 * Thumb Arrows
	 */

	$('.gallery-thumb, .blog-post-thumb, .blog-post-single-thumb').append('<span class="thumb-arrow"></span>');

	/**
	 * Top Info
	 */

		$('.top-info-show').click(function(){
			$('#top-info-inner').stop().slideDown(200);
			$('.top-info-hide').css({ 'z-index' : 1001 });
			$(this).hide();
		});

		$('.top-info-hide').click(function(){
			$('#top-info-inner').stop().slideUp(200);
			$('.top-info-show').show().css({ 'z-index' : 1001 });
			$(this).css({ zIndex : 1 });
		});

	/**
	 * Navigation
	 */

	 	$('#nav li').mouseenter(function(){
	 		$(this).addClass('hover');
	 	}).mouseleave(function(){
	 		$(this).removeClass('hover');
	 	});

	 	$('.sub-menu').hide();

	 	$('#nav li').mouseenter(function(){

	 		$(this).children('.sub-menu').css({ display : 'block', left : '80%' }).stop().animate({ opacity : 1, left : '100%' }, 350);

	 	}).mouseleave(function(){

	 		$(this).children('.sub-menu').stop().animate({ left : '80%', opacity : 0 }, 250, function(){
	 			$(this).css('display', 'none');
	 		});

	 	});

	 /**
	  * Gallery
	  */

	 	$('.gallery-thumb').on('mouseenter', function(){
	 		$('.gallery-thumb-overlay', $(this)).stop().animate( { opacity : 1 }, 300 );
	 	}).on('mouseleave', function(){
	 		$('.gallery-thumb-overlay', $(this)).stop().animate( { opacity : 0 }, 300 );
	 	});

	 /**
	  * Products
	  */

	 	$('.product-thumb').on('mouseenter', function(){
	 		$('.product-thumb-overlay', $(this)).stop().animate( { opacity : 1 }, 300 );
	 	}).on('mouseleave', function(){
	 		$('.product-thumb-overlay', $(this)).stop().animate( { opacity : 0 }, 300 );
	 	});

	 	$(document).on( 'click', '.add-to-cart-ajax', function(e){

	 		e.preventDefault();

	 		var add_to_cart = $(this);
	 		var add_to_cart_url = add_to_cart.attr('href');
	 		var view_cart_url = add_to_cart.data('view-cart-url');
	 		var view_cart_text = add_to_cart.data('view-cart-text');

	 		add_to_cart.append('<span class="icon-cycle"></span>');

			$.get( add_to_cart_url, function(data) {				
				add_to_cart.html( '<span class="icon-cart"></span>' + view_cart_text).attr( 'href', view_cart_url ).removeClass('add-to-cart-ajax');
			});

	 	});

	 /**
	  * Lightbox
	  */

	  	$("a[rel^='prettyPhoto']").prettyPhoto({
	  		theme: 'light_square',
	  		social_tools: ''
	  	});

	  /**
	   * Mobile Nav
	   */

	   	$('#mobile-nav select').change(function() {
			window.location = $(this).val();
		});		

	/**
	 * Init Donate on load
	 */

	if ( $('body').hasClass('init-donate') )
		$('.cause-info-widget-donate a').click();

	/**
	 * Autofocus on donate page
	 */

	if ( $('body').hasClass('page-template-template-donate-php') )
		$('.lb-overlay-form-amount input').focus();

	/**
	 * Autofocus when replying to comment
	 */

	if ( $('#cancel-comment-reply-link:visible').length )
		$('.comment-form-comment textarea').focus();

	/**
	 * Donate Button
	 */

	$('#lb-overlay-donate .lb-overlay-form-submit, #lb-overlay-donate-page .lb-overlay-form-submit').click(function(){

		$('#lb-overlay-donate form, #lb-overlay-donate-page form').submit();

	});

	/**
	 * Subheader (generate mobile version)
	 */

	if ( $('#sub-header').length ) {

		var sh_mobile_opts = '',
		sh_mobile_select = '';

		$('a', '#sub-header').each(function(){

			var sh_title = $(this).text();
			var sh_url = $(this).attr('href');

			if ( $(this).hasClass('active') ) {
				sh_mobile_opts = sh_mobile_opts + '<option selected="selected" value="' + sh_url + '">' + sh_title + '</option>';
			} else {
				sh_mobile_opts = sh_mobile_opts + '<option value="' + sh_url + '">' + sh_title + '</option>';
			}

		});

		if ( ! $('a.active', '#sub-header').length ) {
			sh_mobile_opts = '<option value="#">GO TO</option>' + sh_mobile_opts;
		}

		sh_mobile_select = '<div class="sub-header-mobile"><select>' + sh_mobile_opts + '</select></div>';

		$('#sub-header-inner').append(sh_mobile_select);

		$('.sub-header-mobile select').change(function(){
			window.location = $(this).val();
		});

	}

});

/**
 * Fully Loaded
 */

jQuery(window).load(function(){

	ddMasonry( '.events.masonry', '.event' );
	ddMasonry( '.causes.masonry', '.cause' );
	ddMasonry( '.blog-posts.masonry', '.blog-post' );
	ddSliderShortcode();
	ddSlider();
	ddCarousel();
	ddGallerySlider();
	ddProductsSlider();
	ddTwitter();
	ddEqualSidebar();
	ddEqualDonateOverlay();
	ddCausesWidgetCarousel();

	jQuery(window).resize(function(){
		//ddCenterArrows();
		ddCenterButtons();
		ddShowHideGalleryArrows();
		ddEqualSidebar();

		if ( jQuery('body').hasClass('sticky-header') ) {

			jQuery('#page-container').css({ paddingTop : jQuery('#header').outerHeight() });

		}

	});

});

/**
 * BuddyPress
 */

function ddbpFilters( container ) {

	var optionVal, optionTxt, optionOutput = '', optionOptions = '';

	if ( jQuery(container).length ) {

		jQuery(container).hide();

		jQuery(container).each(function(){

			jQuery('select option', jQuery(this)).each(function(){

				optionVal = jQuery(this).val();
				optionTxt = jQuery(this).text();

				optionOptions += '<li><a href="#" data-option-id="' + optionVal + '">' + optionTxt + '</a></li>';
	 
			});

		});

		optionOutput += '<div class="dd-button-dropdown fr active sub-header-year-selection">'
			optionOutput += '<div class="dd-button-dropdown-content">';
				optionOutput += '<ul>';

					optionOutput += optionOptions;

				optionOutput += '</ul>';
			optionOutput += '</div>';
			optionOutput += '<a href="#" class=""><span class="dd-button-txt">EVERYTHING</span><span class="dd-button-icon"><span class="icon-chevron-down"></span></span></a>';
		optionOutput += '</div>'

		jQuery('#sub-header-bp > .fr').append(optionOutput);

		jQuery('.dd-button-dropdown', '#sub-header').mouseenter(function(){
			jQuery('.dd-button-dropdown-content', this).slideDown(200);
		}).mouseleave(function(){
			jQuery('.dd-button-dropdown-content', this).stop().slideUp(200);
		});

		jQuery('.dd-button-dropdown a', '#sub-header').click(function(e){

			if ( jQuery(this).attr('href') == '#' ) {

				e.preventDefault();

				jQuery('.dd-button-dropdown-content', jQuery(this).closest('.dd-button-dropdown')).stop().slideUp(200);
				jQuery(this).closest('.dd-button-dropdown').find('.dd-button-txt').text( jQuery(this).text() );

				jQuery('select', container).val(jQuery(this).data('option-id')).trigger('change');

			}

		});

	}

}

jQuery(document).ready(function($){

	ddbpFilters( $('#activity-filter-select') );
	ddbpFilters( $('#members-order-select') );
	ddbpFilters( $('#groups-order-select') );

	jQuery('.rev_slider li').each(function(){
		jQuery('.tp-caption.big_orange', this).eq(1).addClass('dd-rev-caption-second');
		jQuery('.tp-caption.big_yellow', this).eq(1).addClass('dd-rev-caption-second');
		jQuery('.tp-caption.big_black', this).eq(1).addClass('dd-rev-caption-second');
		jQuery('.tp-caption.big_white', this).eq(1).addClass('dd-rev-caption-second');
		jQuery('.tp-caption.big_bluee', this).eq(1).addClass('dd-rev-caption-second');
	});

	$('.item-list-tabs .feed').each(function(){
		
		var feedLink = $('a', $(this)).attr('href');
		var feedTxt = $('a', $(this)).text();

		$(this).hide();

		$('#sub-header-bp > .fr').append('<a class="fr" href="' + feedLink + '">' + feedTxt + '</a>');

	});	

	$('.dd-bp-content:empty, .dd-bp-wrapper-primary:empty, .dd-bp-wrapper-secondary:empty').hide();

	$('#group-create-body label, .group-admin #buddypress label, .buddypress .standard-form label').each(function(){

		if ( ! $('form#send_message_form').length && ! $('#signup_form').length ) {

			var bp_input_placeholder = $(this).text();
			if ( $(this).siblings('input[type="text"], textarea').length ) {
				$(this).hide().siblings('input[type="text"], input[type="password"], textarea').attr('placeholder', bp_input_placeholder);
			}

		}

		if ( $('#signup_form').length ) {

			var bp_input_placeholder = $(this).text();
			if ( $(this).next('input[type="text"], textarea, input[type="password"]').length ) {
				$(this).hide().next('input[type="text"], input[type="password"], textarea').attr('placeholder', bp_input_placeholder);
			}

		}

	});

	$('#whats-new').autosize();

	$('#buddypress .button.acomment-reply').addClass('purple');
	$('#buddypress .button.fav').addClass('orange');
	$('#buddypress .button.unfav, #buddypress .button.delete-activity').addClass('red');

	if ( $('#members-list .update').length ) {

		$('#members-list .update').each(function(){

			var bp_update = $(this);
			var bp_action = bp_update.closest('li').find('.action');

			var bp_action_offset = bp_update.outerHeight() / 2 - bp_action.outerHeight() / 2 + 15;

			bp_action.css( 'margin-top', bp_action_offset );

		});

	}

	$('.dd-bp-post-in-fake a').click(function(e){

		if ( $(this).attr('href') == '#' ) {

			e.preventDefault();

			$('#whats-new-post-in option:eq(' + $(this).closest('li').index() + ')').attr('selected', 'selected');

		}

	});

	$('.dd-bp-wrapper-secondary', '#buddypress #members-list').each(function(){

		if( ! $('.update', this).length ) {
			$(this).addClass('dd-bp-no-update');
		}

	});

	if ( $('.item-list-tabs:first').length ) {

		if ( ! $('body').hasClass('group-create') ) {

			var bp_nav = $('.item-list-tabs:first');
			var bp_fake_nav = $('#sub-header-bp .fl');

			bp_nav.hide();

			if ( bp_nav.hasClass('no-ajax') ) {

				$('li', bp_nav).each(function(){

					var bp_nav_item_link = $('a', this).attr('href');
					var bp_nav_item_title = $('a', this).html();

					if ( $(this).hasClass('current') )
						bp_fake_nav.append('<a href="' + bp_nav_item_link + '" class="fl active">' + bp_nav_item_title + '</a>');
					else
						bp_fake_nav.append('<a href="' + bp_nav_item_link + '" class="fl">' + bp_nav_item_title + '</a>');

				});

			} else {

				$('li', bp_nav).each(function(){

					var bp_item_count = $(this).index();

					var bp_nav_item_title = $('a', this).html();

					$('a', this).data('hook', bp_item_count);

					if ( $(this).hasClass('current') )
						bp_fake_nav.append('<a href="#" data-hook="' + bp_item_count + '" class="fl active">' + bp_nav_item_title + '</a>');
					else
						bp_fake_nav.append('<a href="#" data-hook="' + bp_item_count + '" class="fl">' + bp_nav_item_title + '</a>');

				});

				$('a:first', bp_fake_nav).addClass('active');

			}

			$('a span', bp_fake_nav).each(function(){

				$(this).prepend(' (').append(')');

			});

			$('a', bp_fake_nav).click(function(e){

				if ( $(this).attr('href') == '#' ) {

					e.preventDefault();

					$(this).addClass('active').siblings('.active').removeClass('active');

					var bp_hook = $(this).data('hook');

					$('li:eq(' + bp_hook + ') a', bp_nav).click();

				}

			});	

		}

	}

});
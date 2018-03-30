function ddHeaderBg() {

	if ( ! jQuery('body').hasClass('has-slider') ) {

		// Get Info
		var header = jQuery('#header');
		var headerBg = header.data('bg-image');
		
		if ( headerBg )
			header.css({ 'background-image' : 'url("' + headerBg + '")' });
		
	}

}

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
			useCSS: false
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

function ddCarousel() {
	
	jQuery('.carousel').each(function(){

		var carousel = jQuery(this);
		var container = carousel.closest('.container');

		if ( carousel.find('.flexslider li').length < 5 )
			container.find('.carousel-nav').css({ display : 'none' });

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
		var slide_width = jQuery('.slides > li', carousel).width();

		if ( carousel.width() < 450 )
			slide_width = '';

		/* Init slider */
		jQuery(this).find('.flexslider').flexslider({
			animation: def.animation,
			slideshow: autoplay_state,
			slideshowSpeed: parseInt(def.autoplay),
			controlNav: false,
			itemWidth: slide_width,
			itemMargin: 20,
			animationLoop: def.loop,
			prevText: '',
			nextText: '',
			start: function(){
				//ddCenterArrows();
				ddCenterButtons();
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

function ddCenterArrows() {

	jQuery('.carousel-nav').each(function(){

		var carousel = jQuery(this).closest('.carousel');
		var carouselHeight = carousel.height();
		var arrowHeight = jQuery('a', this).height();
		var centerOffset = carouselHeight / 2 - arrowHeight / 2 + arrowHeight;

		jQuery(this).css({ bottom : centerOffset });

	});

}

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
			itemMargin: 20,
			animationLoop: def.loop,
			prevText: '',
			nextText: '',
			asNavFor: '.gallery-single-slider .flexslider',
			start: function(){

				ddShowHideGalleryArrows();

				/* Init slider */
				jQuery('.gallery-single-slider').find('.flexslider').flexslider({
					smoothHeight : true,
					animation: def.animation,
					slideshow: autoplay_state,
					slideshowSpeed: parseInt(def.autoplay),
					controlNav: false,
					itemMargin: 0,
					animationLoop: def.loop,
					prevText: '',
					nextText: '',
					sync: '.gallery-single-carousel .flexslider'
				});

				if ( jQuery('.gallery-single-carousel .flexslider li').length < 2 )
					jQuery('.gallery-single-carousel').hide();

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
 * DOM Ready
 */

jQuery(document).ready(function($){

	ddHeaderBg();

	/**
	 * Last Classes
	 */
	 $('#footer .widget:last-child').addClass('last');

	/**
	 * Thumb Arrows
	 */

	$('.gallery-thumb, .blog-post-thumb, .blog-post-single-thumb').append('<span class="thumb-arrow"></span>');

	/**
	 * Top Info
	 */

		$('.top-info-show').click(function(e){

			e.preventDefault();

			$('#top-info-inner').stop().slideDown(200);
			$('.top-info-hide').css({ 'z-index' : 1001 });
			$(this).hide();
		});

		$('.top-info-hide').click(function(e){

			e.preventDefault();

			$('#top-info-inner').stop().slideUp(200);
			$('.top-info-show').show().css({ 'z-index' : 1001 });
			$(this).css({ zIndex : 1 });
		});

	/**
	 * Navigation
	 */

	 	$('#nav li').mouseenter(function(){
	 		//$(this).addClass('hover');
	 	}).mouseleave(function(){
	 		//$(this).removeClass('hover');
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

			$.get( add_to_cart_url, function(data) {				
				add_to_cart.html( '<span class="icon-cart"></span>' + view_cart_text).attr( 'href', view_cart_url ).removeClass('add-to-cart-ajax');
			});

	 	});

	  /**
	   * Mobile Nav
	   */

	   	$('#mobile-nav select').change(function() {
			window.location = $(this).val();
		});	

		$('#page-container').data( 'start-width', $(window).width() );

	/**
	 * Tablet Nav
	 */

	if ( 'ontouchstart' in window ) {

		$('#nav').find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {

			var el = $( this ).parent( 'li' );

			if ( ! el.hasClass( 'sfHover' ) ) {
				e.preventDefault();
				el.toggleClass( 'sfHover' );
				el.siblings( '.sfHover' ).removeClass( 'sfHover' );
			}

		});

	}

});

/**
 * Fully Loaded
 */

jQuery(window).load(function(){

	jQuery('#loader').animate({ opacity : 0 }, 200, function(){
		jQuery('#loader').hide();
	});
	jQuery('#page-container, #top-info').animate({ opacity : 1 }, 200 );

	ddMasonry( '.galleries.masonry', '.gallery' );
	ddMasonry( '.blog-posts.masonry', '.blog-post' );
	ddSlider();
	ddCarousel();
	ddGallerySlider();
	ddCenterButtons();

	var currentWidth = jQuery(window).width();

	if ( currentWidth > 768 ) {

		jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			theme: 'light_square',
			social_tools: ''
		});

	} else {

		jQuery("a[rel^='prettyPhoto']").on('click', function(e){
			e.preventDefault();
		});

	}

	jQuery(window).resize(function(){

		ddCenterButtons();
		ddShowHideGalleryArrows();

		if ( jQuery('#page-container.reloading').length < 1 ) {

			var startWidth = jQuery('#page-container').data('start-width');
			var currentWidth = jQuery(window).width();

			if ( startWidth < 480 )
				startID = 'portrait'
			else if ( startWidth < 768 )
				startID = 'landscape';
			else if ( startWidth < 959 )
				startID = 'tablet';
			else if ( startWidth < 1200 )
				startID = 'monitor';
			else
				startID = 'big'

			if ( startID == 'big' && currentWidth < 1200 ) {
				location.reload();
				jQuery('#page-container').addClass('reloading');
			} else if ( startID == 'monitor' && ( currentWidth < 959 || currentWidth > 1200 ) ) {
				location.reload();
				jQuery('#page-container').addClass('reloading');
			} else if ( startID == 'tablet' && ( currentWidth < 768 || currentWidth > 959 ) ) {
				location.reload();
				jQuery('#page-container').addClass('reloading');
			} else if ( startID == 'landscape' && ( currentWidth < 480 || currentWidth > 768 ) ) {
				location.reload();			
				jQuery('#page-container').addClass('reloading');
			} else if ( startID == 'portrait' && ( currentWidth > 479 ) ) {
				location.reload();
				jQuery('#page-container').addClass('reloading');
			}

		}

	});

});
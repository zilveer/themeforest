/*===================================================================================*/
/*  GO TO TOP / SCROLL UP
/*===================================================================================*/

! function (a, b, c) {
	a.fn.scrollUp = function (b) {
		a.data(c.body, "scrollUp") || (a.data(c.body, "scrollUp", !0), a.fn.scrollUp.init(b))
	}, a.fn.scrollUp.init = function (d) {
		var e = a.fn.scrollUp.settings = a.extend({}, a.fn.scrollUp.defaults, d),
			f = e.scrollTitle ? e.scrollTitle : e.scrollText,
			g = a("<a/>", {
				id: e.scrollName,
				href: "#top"/*,
				title: f*/
			}).appendTo("body");
		e.scrollImg || g.html(e.scrollText), g.css({
			display: "none",
			position: "fixed",
			zIndex: e.zIndex
		}), e.activeOverlay && a("<div/>", {
			id: e.scrollName + "-active"
		}).css({
			position: "absolute",
			top: e.scrollDistance + "px",
			width: "100%",
			borderTop: "1px dotted" + e.activeOverlay,
			zIndex: e.zIndex
		}).appendTo("body"), scrollEvent = a(b).scroll(function () {
			switch (scrollDis = "top" === e.scrollFrom ? e.scrollDistance : a(c).height() - a(b).height() - e.scrollDistance, e.animation) {
			case "fade":
				a(a(b).scrollTop() > scrollDis ? g.fadeIn(e.animationInSpeed) : g.fadeOut(e.animationOutSpeed));
				break;
			case "slide":
				a(a(b).scrollTop() > scrollDis ? g.slideDown(e.animationInSpeed) : g.slideUp(e.animationOutSpeed));
				break;
			default:
				a(a(b).scrollTop() > scrollDis ? g.show(0) : g.hide(0))
			}
		}), g.click(function (b) {
			b.preventDefault(), a("html, body").animate({
				scrollTop: 0
			}, e.scrollSpeed, e.easingType)
		})
	}, a.fn.scrollUp.defaults = {
		scrollName: "scrollUp",
		scrollDistance: 300,
		scrollFrom: "top",
		scrollSpeed: 300,
		easingType: "linear",
		animation: "fade",
		animationInSpeed: 200,
		animationOutSpeed: 200,
		scrollText: "Scroll to top",
		scrollTitle: !1,
		scrollImg: !1,
		activeOverlay: !1,
		zIndex: 2147483647
	}, a.fn.scrollUp.destroy = function (d) {
		a.removeData(c.body, "scrollUp"), a("#" + a.fn.scrollUp.settings.scrollName).remove(), a("#" + a.fn.scrollUp.settings.scrollName + "-active").remove(), a.fn.jquery.split(".")[1] >= 7 ? a(b).off("scroll", d) : a(b).unbind("scroll", d)
	}, a.scrollUp = a.fn.scrollUp
}(jQuery, window, document);

function createCookie(name, value, days) {
	var expires;

	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toGMTString();
	} else {
		expires = "";
	}
	document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

function readCookie(name) {
	var nameEQ = escape(name) + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) === ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) === 0) return unescape(c.substring(nameEQ.length, c.length));
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name, "", -1);
}

(function($) {
	"use strict";

	if( typeof $.blockUI !== "undefined" ) {
		$.blockUI.defaults.message                      = null;
		$.blockUI.defaults.overlayCSS.background        = '#fff url(' + mc_options.ajax_loader_url + ') no-repeat center';
		$.blockUI.defaults.overlayCSS.backgroundSize    = '16px 16px';
		$.blockUI.defaults.overlayCSS.opacity           = 0.6;
	}

	/*===================================================================================*/
	/*  Visual Composer Row Behavior
	/*===================================================================================*/

	window.vc_rowBehaviour = function () {
		var $ = window.jQuery;
		var local_function = function () {
			var $elements = $( '[data-vc-full-width="true"]' );
			var is_rtl = $('body,html').hasClass('rtl');
			$.each( $elements, function ( key, item ) {
				var $el = $( this );
				var $el_full = $el.next( '.vc_row-full-width' );
				var $el_wrapper = $( '#page.wrapper' );
				var el_margin_left = parseInt( $el.css( 'margin-left' ), 10 );
				var el_margin_right = parseInt( $el.css( 'margin-right' ), 10 );
				var offset = 0 - $el_full.offset().left - el_margin_left + $el_wrapper.offset().left;
				var width = $el_wrapper.width();
				if( is_rtl ){
					$el.css( {
						'position': 'relative',
						'right': offset,
						'box-sizing': 'border-box',
						'width': $el_wrapper.width()
					} );
				} else {
					$el.css( {
						'position': 'relative',
						'left': offset,
						'box-sizing': 'border-box',
						'width': $el_wrapper.width()
					} );
				}
				
				if ( ! $el.data( 'vcStretchContent' ) ) {
					var padding = (- 1 * offset);
					if ( padding < 0 ) {
						padding = 0;
					}
					var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
					if ( paddingRight < 0 ) {
						paddingRight = 0;
					}
					$el.css( { 'padding-left': padding + 'px', 'padding-right': paddingRight + 'px' } );
				}
				$el.attr( "data-vc-full-width-init", "true" );
			} );
		};
		/**
		 * @todo refactor as plugin.
		 * @returns {*}
		 */
		var parallaxRow = function () {
			var vcSkrollrOptions,
				callSkrollInit = false;
			if ( vcParallaxSkroll ) {
				vcParallaxSkroll.destroy();
			}
			$( '.vc_parallax-inner' ).remove();
			$( '[data-5p-top-bottom]' ).removeAttr( 'data-5p-top-bottom data-30p-top-bottom' );
			$( '[data-vc-parallax]' ).each( function () {
				var skrollrSpeed,
					skrollrSize,
					skrollrStart,
					skrollrEnd,
					$parallaxElement,
					parallaxImage;
				callSkrollInit = true; // Enable skrollinit;
				if ( $( this ).data( 'vcParallaxOFade' ) == 'on' ) {
					$( this ).children().attr( 'data-5p-top-bottom', 'opacity:0;' ).attr( 'data-30p-top-bottom',
						'opacity:1;' );
				}

				skrollrSize = $( this ).data( 'vcParallax' ) * 100;
				$parallaxElement = $( '<div />' ).addClass( 'vc_parallax-inner' ).appendTo( $( this ) );
				$parallaxElement.height( skrollrSize + '%' );

				parallaxImage = $( this ).data( 'vcParallaxImage' );

				if ( parallaxImage !== undefined ) {
					$parallaxElement.css( 'background-image', 'url(' + parallaxImage + ')' );
				}

				skrollrSpeed = skrollrSize - 100;
				skrollrStart = - skrollrSpeed;
				skrollrEnd = 0;

				$parallaxElement.attr( 'data-bottom-top', 'top: ' + skrollrStart + '%;' ).attr( 'data-top-bottom',
					'top: ' + skrollrEnd + '%;' );
			} );

			if ( callSkrollInit && window.skrollr ) {
				vcSkrollrOptions = {
					forceHeight: false,
					smoothScrolling: false,
					mobileCheck: function () {
						return false;
					}
				};
				vcParallaxSkroll = skrollr.init( vcSkrollrOptions );
				return vcParallaxSkroll;
			}
			return false;
		};

		$( window ).unbind( 'resize.vcRowBehaviour' ).bind( 'resize.vcRowBehaviour', local_function );
		
		local_function();
		parallaxRow();
	}

	/*===================================================================================*/
	/*  Set Height of Products li
	/*===================================================================================*/

	// these are (ruh-roh) globals. You could wrap in an
	// immediately-Invoked Function Expression (IIFE) if you wanted to...
	var currentTallest = 0,
		currentRowStart = 0,
		rowDivs = new Array();

	function setConformingHeight(el, newHeight) {
		// set the height to something new, but remember the original height in case things change
		el.data("originalHeight", (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight")));
		el.height(newHeight);
	}

	function getOriginalHeight(el) {
		// if the height has changed, send the originalHeight
		return (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight"));
	}

	function columnConform() {

		// find the tallest DIV in the row, and set the heights of all of the DIVs to match it.
		$( '.products > .product' ).each(function() {

			// "caching"
			var $el = $(this);

			if( $el.is( ':visible' ) ) {
			
				var topPosition = $el.position().top;

				if (currentRowStart != topPosition) {

					// we just came to a new row.  Set all the heights on the completed row
					for ( var currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
						setConformingHeight(rowDivs[currentDiv], currentTallest);
					}

					// set the variables for the new row
					rowDivs.length = 0; // empty the array
					currentRowStart = topPosition;
					currentTallest = getOriginalHeight($el);
					rowDivs.push($el);

				} else {

					// another div on the current row.  Add it to the list and check if it's taller
					rowDivs.push($el);
					currentTallest = (currentTallest < getOriginalHeight($el)) ? (getOriginalHeight($el)) : (currentTallest);

				}
				
				// do the last row
				for ( var currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
					setConformingHeight(rowDivs[currentDiv], currentTallest);
				}
			}

		});

	}


	$(window).resize(function() {
		columnConform();
	});

	// Dom Ready
	// You might also want to wait until window.onload if images are the things that
	// are unequalizing the blocks
	$( document ).ready( function() {
		columnConform();
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		columnConform();
		$(window).scrollTop( $(window).scrollTop() - 0.0001 ); // Its a hack to trigger scroll event
	});

	/*===================================================================================*/
	/*  Search Category Dropdown
	/*===================================================================================*/

	$(document).ready(function () {

		$('#product_cat').change(function(){
			var $selectInner    = $( '.mc-search-bar-select > .mc-search-bar-selectInner' );
            $selectInner.width( 'auto' );
            $selectInner.css( 'min-width', '140px' );			
		});
	});

	/*===================================================================================*/
	/*  Products LIVE Search
	/*===================================================================================*/

	$(document).ready(function(){

		if( mc_options.enable_live_search == '1' ) {

			if ( mc_options.ajaxurl.indexOf( '?' ) > 1 ) {
				var prefetch_url    = mc_options.ajaxurl + '&action=products_live_search&fn=get_ajax_search';
				var remote_url      = mc_options.ajaxurl + '&action=products_live_search&fn=get_ajax_search&terms=%QUERY';
			} else {
				var prefetch_url    = mc_options.ajaxurl + '?action=products_live_search&fn=get_ajax_search';
				var remote_url      = mc_options.ajaxurl + '?action=products_live_search&fn=get_ajax_search&terms=%QUERY';
			}
			
			var searchProducts = new Bloodhound({
				identify: function(obj) { return obj.id; },
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace( 'value' ),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				prefetch: prefetch_url,
				remote: {
					url: remote_url,
					wildcard: '%QUERY',
				},
			});

			searchProducts.initialize();

			$( '.mc-search-bar .search-field' ).typeahead(
				{
					hint: true,
					highlight: true
				},
				{
					name: 'search',
					source: searchProducts.ttAdapter(),
					displayKey: 'value',
					templates: {
						empty : [
							'<div class="empty-message">',
							mc_options.live_search_empty_msg,
							'</div>'
						].join('\n'),
						suggestion: Handlebars.compile( mc_options.live_search_template )
					}
				}
			);
		}
	});

	/*===================================================================================*/
	/*  WOW 
	/*===================================================================================*/

	$(document).ready(function () {
		new WOW().init();
	});

	/*===================================================================================*/
	/*  YAMM 
	/*===================================================================================*/
 
	$(document).on('click', '.yamm .dropdown-menu', function(e) {
		e.stopPropagation();
	});

	
	/*===================================================================================*/
	/*  REMEMBER USER SHOP VIEW
	/*===================================================================================*/

	$( document ).on( 'click', '.shop-view-switcher > li > a', function(e) {
		if( mc_options.remember_user_view == '1' ) {
			var href = $(this).attr( 'href' );
			eraseCookie( 'user_shop_view' );
			if( href == '#grid-view' ) {
				createCookie( 'user_shop_view', 'grid-view', 300 );
			} else {
				createCookie( 'user_shop_view', 'list-view', 300 );
			}
		}
	});


	/*===================================================================================*/
	/*  STICKY NAVIGATION
	/*===================================================================================*/

	$(document).ready(function() {
		if( mc_options.should_stick == '1' ) {
			$('#top-megamenu-nav').waypoint('sticky');
		}
	});

	/*===================================================================================*/
	/*  OWL CAROUSEL
	/*===================================================================================*/

	$(document).ready(function () {

		var is_rtl;

		if( mc_options.rtl == '1' ) {
			is_rtl = true;
		} else {
			is_rtl = false;
		}

		$( '.products-carousel-6' ).each( function() {

			var shouldAutoPlay = false;

			if( 'yes' === $( this ).data( 'autoplay' ) ) {
				shouldAutoPlay = true;
			}

			$( this ).owlCarousel({
				autoplayHoverPause: true,
				autoplay: shouldAutoPlay,
				navRewind: true,
				items: 5,
				dots: false,
				margin: -1,
				stagePadding: 1,
				rtl: is_rtl,
				responsive : {
					0 : {
						items : 1,
					},
					480: {
						items : 2,
					},
					768 : {
						items : 3,
					},
					992 : {
						items : 4,
					},
					1199 : {
						items : 6,
					},
				},
				onTranslate : function(){
					echo.render();
				}
			});

		});

		$( '.products-carousel-4' ).each( function() {

			var shouldAutoPlay = false;

			if( 'yes' === $( this ).data( 'autoplay' ) ) {
				shouldAutoPlay = true;
			}

			$( this ).owlCarousel({
				autoplayHoverPause: true,
				autoplay: shouldAutoPlay,
				navRewind: true,
				dots: false,
				margin: -1,
				stagePadding: 1,
				rtl: is_rtl,
				responsive: {
					0: {
						items: 1,
					},
					480 : {
						items: 2,
					},
					768 : {
						items : 3,
					},
					1199 : {
						items : 4,
					},
				},
				onTranslate : function(){
					echo.render();
				}
			});
		});

		$( '.brands-carousel' ).each( function() {

			var shouldAutoPlay = false;

			if( 'yes' === $( this ).data( 'autoplay' ) ) {
				shouldAutoPlay = true;
			}

			$( this ).owlCarousel( {
				autoplayHoverPause: true,
				autoplay: shouldAutoPlay,
				navRewind: true,
				items: 6,
				nav: false,
				dots: false,
				rtl: is_rtl,
				responsive : {
					0: {
						items: 1,
					},
					480 : {
						items: 2,
						margin: 10,
					},
					768 : {
						items : 4,
					},
					992 : {
						items : 5,
					},
					1199 : {
						items : 6,
					}
				},
			});
		});

		$('#owl-single-product').owlCarousel({
			items: 1,
			nav: false,
			dots: false,
			rtl: is_rtl,
		});

		$('.single-product .thumbnails').owlCarousel({
			items: 6,
			dots: true,
			navRewind: true,
			nav: false,
			rtl: is_rtl,
			margin: -1,
			responsive : {
				0 : {
					items : 5,
				},
				479 : {
					items : 6,
				},
				768 : {
					items : 6,
				},
				1199 : {
					items : 6,
				}
			},
		});

		$('.single-product-slider').owlCarousel({
			autoplayHoverPause: true,
			navRewind: true,
			items: 1,
			dots: false,
			nav: false,
			rtl: is_rtl,
			onTranslate : function(){
				echo.render();
			}
		});
		
		$(".slider-next").click(function () {
			var owl = $($(this).data('target'));
			owl.trigger('next.owl.carousel');
			return false;
		});
		
		$(".slider-prev").click(function () {
			var owl = $($(this).data('target'));
			owl.trigger('prev.owl.carousel');
			return false;
		});

		$('.single-product-gallery .horizontal-thumb').click(function(){
			var $this = $(this), owl = $($this.data('target')), slideTo = $this.data('slide');
			owl.trigger('to.owl.carousel', [slideTo, 300, true]);
			$this.addClass('active').parent().siblings().find('.active').removeClass('active');
			return false;
		});

		$(".owl-blog-post-gallery").owlCarousel({
			autoplaySpeed: 5000,
			navSpeed: 200,
			dotsSpeed: 600,
			dragEndSpeed: 800,
			autoplayHoverPause: true,
			dots: true,
			navRewind: true,
			items: 1,
			nav: true,
			autoHeight: true,
			rtl: is_rtl,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
		
	});


	/*===================================================================================*/
	/*  CUSTOM CONTROLS
	/*===================================================================================*/

	$(document).ready(function () {
		
		// Select Dropdown
		if($('.le-select').length > 0){
			$('.le-select select').customSelect({customClass:'le-select-in'});
		}

		// Checkbox
		if($('.le-checkbox').length>0){
			$('.le-checkbox').after('<i class="fake-box"></i>');
		}

		//Radio Button
		if($('.le-radio').length>0){
			$('.le-radio').after('<i class="fake-box"></i>');
		}

		// Buttons
		$('.le-button.disabled').click(function(e){
			e.preventDefault();
		});

		if( $( '.mc-search-bar select' ).length > 0 ) {
			$( '.mc-search-bar select' ).customSelect({
				customClass: 'mc-search-bar-select'
			});
		}

		// Price Slider
		if ($('.price-slider').length > 0) {
			$('.price-slider').slider({
				min: 100,
				max: 700,
				step: 10,
				value: [100, 400],
				handle: "square"

			});
		}

		// Data Placeholder for custom controls

		$('[data-placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('data-placeholder')) {
				input.val('');

			}
		}).blur(function() {
			var input = $(this);
			if (input.val() === '' || input.val() == input.attr('data-placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('data-placeholder'));
			}
		}).blur();

		$('[data-placeholder]').parents('form').submit(function() {
			$(this).find('[data-placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('data-placeholder')) {
					input.val('');
				}
			});
		});

	});

	$(window).resize( function() {
		$( '.mc-search-bar select' ).trigger( 'render' );
	});


	/*===================================================================================*/
	/*  SELECT TOP DROP MENU
	/*===================================================================================*/
	$(document).ready(function() {
		$('.top-drop-menu').change(function() {
			var loc = ($(this).find('option:selected').val());
			window.location = loc;
		});
	});

	/*===================================================================================*/
	/*  LAZY LOAD IMAGES USING ECHO
	/*===================================================================================*/
	$(document).ready(function(){
		echo.init({
			offset: 100,
			throttle: 250,
			unload: false,
			callback: function (element, op) {
				$( element ).removeClass( 'echo-lazy-loading');
			}
		});
	});

	/*===================================================================================*/
	/*  DATA HOVER ANIMATION
	/*===================================================================================*/

	$(document).ready(function(){
		$('[data-hover="animate"]').on('mouseenter', function(){
			var $this = $(this), animation = $this.data('animation');
			$this.addClass('animated ' + animation);
		});
		$('[data-hover="animate"]').on('mouseleave', function(){
			var $this = $(this), animation = $this.data('animation');
			$this.removeClass('animated ' + animation);
		});
	});


	/*===================================================================================*/
	/*  ADDED TO CART ANIMATION
	/*===================================================================================*/

	$('body').on('added_to_cart', function(){
		
		$( '.product-inner' ).unblock();
		$( '.product-list-view-inner' ).unblock();
		$( '.cart-item' ).unblock();
		$( '.compare-list' ).unblock();
		$( '.product-item-inner' ).unblock();
		$( '.single-product-grid' ).unblock();

		return false;
	});

	/*===================================================================================*/
	/*  GO TO TOP / SCROLL UP
	/*===================================================================================*/

	$(document).ready(function () {

		if( mc_options.should_scroll == '1' ) {
			$.scrollUp({
				scrollName: "scrollUp", // Element ID
				scrollDistance: 300, // Distance from top/bottom before showing element (px)
				scrollFrom: "top", // "top" or "bottom"
				scrollSpeed: 1000, // Speed back to top (ms)
				easingType: "easeInOutCubic", // Scroll to top easing (see http://easings.net/)
				animation: "fade", // Fade, slide, none
				animationInSpeed: 200, // Animation in speed (ms)
				animationOutSpeed: 200, // Animation out speed (ms)
				scrollText: "<i class='fa fa-angle-up'></i>", // Text for element, can contain HTML
				scrollTitle: " ", // Set a custom <a> title if required. Defaults to scrollText
				scrollImg: 0, // Set true to use image
				activeOverlay: 0, // Set CSS color to display scrollUp active point, e.g "#00FFFF"
				zIndex: 1001 // Z-Index for the overlay
			});
		}
	});


	/*===================================================================================*/
	/*  ANIMATED / SMOOTH SCROLL TO ANCHOR
	/*===================================================================================*/

	$(document).ready(function() {
		
		$("a.scrollTo").click(function() {
			$("html, body").animate({
				scrollTop: $($(this).attr("href")).offset().top + "px"
			}, {
				duration: 1000,
				easing: "easeInOutCubic"
			});
			return false;
		});
		
	});

	/*===================================================================================*/
	/*  Adding to Cart animation
	/*===================================================================================*/
	$(document).ready(function(){
		$('body').on('adding_to_cart', function( e, $btn, data){
			$btn.closest( '.product-inner' ).block();
			$btn.closest( '.product-list-view-inner' ).block();
			$btn.closest( '.cart-item' ).block();
			$btn.closest( '.compare-list' ).block();
			$btn.closest( '.product-item-inner' ).block();
			$btn.closest( '.single-product-grid' ).block();
		});
	});

	/*===================================================================================*/
	/*  PRODUCT CATEGORIES TOGGLE
	/*===================================================================================*/

	$(document).ready(function(){
		$('.cat-parent > a').each(function(){
			var $childIndicator = $('<span class="child-indicator"></span>');
			
			if($(this).siblings('.children').is(':visible')){
				$childIndicator.addClass( 'open' );
			}
			
			$childIndicator.click(function(){
				$(this).parent().siblings('.children').toggle( 'fast', function(){
					if($(this).is(':visible')){
						$childIndicator.addClass( 'open' );
					}else{
						$childIndicator.removeClass( 'open' );
					}
				});
				return false;
			});
			$(this).append($childIndicator);
		});
	});
	

	/*===================================================================================*/
	/*  WooCompare
	/*===================================================================================*/


	$( document ).on( 'click', '.add-to-compare-link:not(.added)', function(e) {

		e.preventDefault();

		var button = $(this),
			data = {
				_yitnonce_ajax: yith_woocompare.nonceadd,
				action: yith_woocompare.actionadd,
				id: button.data('product_id'),
				context: 'frontend'
			},
			widget_list = $('.yith-woocompare-widget ul.products-list');

		// add ajax loader
		if( typeof woocommerce_params != 'undefined' ) {
			button.closest( '.images-and-summary' ).block();
			button.closest( '.product-inner' ).block();
			button.closest( '.product-list-view-inner' ).block();
			button.closest( '.product-item-inner' ).block();
			widget_list.block();
		}

	   $.ajax({
			type: 'post',
			url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionadd ),
			data: data,
			dataType: 'json',
			success: function(response){

				if( typeof woocommerce_params != 'undefined' ) {
					$( '.images-and-summary' ).unblock();
					$( '.product-inner' ).unblock();
					$( '.product-list-view-inner' ).unblock();
					$( '.product-item-inner' ).unblock();
					widget_list.unblock()
				}

				button.addClass('added')
						.attr( 'href', mc_options.compare_page_url )
						.text( yith_woocompare.added_label );

				// add the product in the widget
				widget_list.html( response.widget_table );

				increment_compare_counter();
			}
		});
	});

	$( document ).on( 'click', '#product-comparison-page-clear-all', function(e) {

		e.preventDefault();
		
		var button = $(this),
		data = {
			_yitnonce_ajax: yith_woocompare.nonceremove,
			action: yith_woocompare.actionremove,
			id: button.data('product_id'),
			context: 'frontend'
		};

		// add ajax loader
		$('#main-content').block();

		$.ajax({
			type: 'post',
			url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionremove ),
			data: data,
			dataType:'html',
			success: function(response){
				$('#main-content').unblock();
				$('#main-content').html(response);

				// removed trigger
				$(window).trigger('yith_woocompare_product_removed');

				set_compare_count(0);
			}
		});
		
	});

	function get_compare_count() {
		return parseInt( $('#top-cart-compare-count').text().replace('(', ''), 10 );
	}

	function increment_compare_counter() {
		var compare_count = get_compare_count();
		compare_count = compare_count + 1;
		return set_compare_count( compare_count );
	}

	function decrement_compare_counter() {
		var compare_count = get_compare_count();
		compare_count = compare_count - 1;
		return set_compare_count( compare_count );
	}

	function set_compare_count( value ) {
		return $( '#top-cart-compare-count' ).text( '(' + value + ')' );
	}

	/**
	 *  Render images in Cart Dropdown
	 */

	$( '.top-cart-holder' ).on( 'shown.bs.dropdown', function () {
		echo.render();
	});


	/*===================================================================================*/
	/*  YITH Wishlist
	/*===================================================================================*/

	$(document).ready( function() {
		
		$( '.add_to_wishlist' ).on( 'click', function() {
			$( this ).closest( '.images-and-summary' ).block();
			$( this ).closest( '.product-inner' ).block();
			$( this ).closest( '.product-list-view-inner' ).block();
			$( this ).closest( '.product-item-inner' ).block();
		});

		$( '.yith-wcwl-wishlistaddedbrowse > .feedback' ).on( 'click', function() {
			var browseWishlistURL = $( this ).next().attr( 'href' );
			window.location.href = browseWishlistURL;
		});

	});

	$( document ).on( 'removed_from_wishlist', function() {
		decrement_wishlist_counter();
	});


	$( document ).on( 'added_to_wishlist', function() {
		increment_wishlist_counter();
		$( '.images-and-summary' ).unblock();
		$( '.product-inner' ).unblock();
		$( '.product-list-view-inner' ).unblock();
		$( '.product-item-inner' ).unblock();
	});

	function get_wishlist_count() {
		return parseInt( $('#top-cart-wishlist-count').text().replace('(', ''), 10 );
	}

	function increment_wishlist_counter() {
		var wishlist_count = get_wishlist_count();
		wishlist_count = wishlist_count + 1;
		return set_wishlist_count( wishlist_count );
	}

	function decrement_wishlist_counter() {
		var wishlist_count = get_wishlist_count();
		wishlist_count = wishlist_count - 1;
		return set_wishlist_count( wishlist_count );
	}

	function set_wishlist_count( value ) {
		return $( '#top-cart-wishlist-count' ).text( '(' + value + ')' );
	}

	/*===================================================================================*/
	/*  CURRENCY SWITCHER
	/*===================================================================================*/

	$(document).ready(function(){
		$('.mc_wcml_currency_switcher > li > a').on('click', function(){
			var $this = $(this),
			currency = $this.data('currency'),
			data = { action : 'wcml_switch_currency', currency : currency, wcml_nonce: mc_options.wcml_switch_currency_nonce },
			mc_wcml_currency_switcher = $('.mc_wcml_currency_switcher');
			mc_wcml_currency_switcher.block();
			$.post( woocommerce_params.ajax_url, data, function(){
				mc_wcml_currency_switcher.unblock();
				location.reload(true);
			});
			return false;
		});
	});

	/*===================================================================================*/
	/*  GMAP ACTIVATOR
	/*===================================================================================*/

	var directionsDisplay;
	var directionsService;
	var map, destination;

	$(document).ready(function(){
		
		if( typeof gmapParams !== 'undefined'){
			var zoom = parseInt(gmapParams.zoom, 10);
			var latitude = parseFloat(gmapParams.latitude, 10);
			var longitude = parseFloat(gmapParams.longitude, 10);
			var mapIsNotActive = true;
			setupCustomMap( zoom, latitude, longitude, mapIsNotActive );
		}

		//$('')

	});


	function setupCustomMap( zoom, latitude, longitude, mapIsNotActive ) {
		if ($('.map-holder').length > 0 && mapIsNotActive) {

			var styles = [
				{
					"featureType": "landscape",
					"elementType": "geometry",
					"stylers": [
						{
							"visibility": "simplified"
						},
						{
							"color": "#E6E6E6"
						}
					]
				}, {
					"featureType": "administrative",
					"stylers": [
						{
							"visibility": "simplified"
						}
					]
				}, {
					"featureType": "road",
					"elementType": "geometry",
					"stylers": [
						{
							"visibility": "on"
						},
						{
							"saturation": -100
						}
					]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"color": "#808080"
						},
						{
							"visibility": "on"
						}
					]
				}, {
					"featureType": "water",
					"stylers": [
						{
							"color": "#CECECE"
						},
						{
							"visibility": "on"
						}
					]
				}, {
					"featureType": "poi",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				}, {
					"featureType": "poi",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#E5E5E5"
						},
						{
							"visibility": "on"
						}
					]
				}, {
					"featureType": "road.local",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#ffffff"
						},
						{
							"visibility": "on"
						}
					]
				}, {}
			];
			
			var lt, ld;

			directionsService = new google.maps.DirectionsService();
			
			if ($('.map').hasClass('center')) {
				lt = (latitude);
				ld = (longitude);
			} else {
				lt = (latitude + 0.0027);
				ld = (longitude - 0.010);
			}

			destination = new google.maps.LatLng(lt, ld);

			var options = {
				mapTypeControlOptions: {
					mapTypeIds: ['Styled']
				},
				center: destination,
				zoom: zoom,
				disableDefaultUI: true,
				scrollwheel: false,
				mapTypeId: 'Styled'
			};
			
			var div = document.getElementById(gmapParams.gmapID);
			directionsDisplay = new google.maps.DirectionsRenderer();

			map = new google.maps.Map(div, options);
			directionsDisplay.setMap(map);

			var styledMapType = new google.maps.StyledMapType(styles, {
				name: 'Styled'
			});

			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(latitude, longitude),
				map: map
			});
			
			map.mapTypes.set('Styled', styledMapType);

			mapIsNotActive = false;
		}

	}

	$('#get-direction').on('click', function(){
		var start = $('#starting-point').val();
		calcRoute(start);
	});

	function calcRoute( start ) {
		var request = {
			origin: start,
			destination: destination,
			travelMode: google.maps.TravelMode.DRIVING
		};
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			}
		});
	}



})(jQuery);
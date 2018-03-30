var publicVars = publicVars || {};

;(function($, window, undefined)
{
	"use strict";

	$(document).ready(function()
	{
		
		// Define global vars
		publicVars.$body          = $("body");
		publicVars.$header        = publicVars.$body.find('.site-header');
		publicVars.$footer        = publicVars.$body.find('.site-footer');
		publicVars.$headerTopMenu = publicVars.$header.find('.top-menu');
		publicVars.$mainMenu      = publicVars.$header.find('nav.main-menu');
		publicVars.$mobileMenu	  = publicVars.$body.find('.mobile-menu').first();

		publicVars.$cartCounter	  = publicVars.$body.find('.cart-counter');
		publicVars.$miniCart	  = publicVars.$body.find('.lab-mini-cart');

		publicVars.$loginForm	  = publicVars.$body.find('.login-form-env');

		// Setup Menu
		var subMenuVisibleClass = 'sub-visible';

		publicVars.$mainMenu.find('li:has(> ul)').each(function(i, el)
		{
			var $li = $(el),
				$a = $li.find( '> a' );

			$a.on( 'click', function( ev ) {
				if ( is_touch_device() ) {
					return false;
				}
			} );
				
			$li.hoverIntent({
				over: function(){
					$li.addClass(subMenuVisibleClass);
				},
				out: function(){
					$li.removeClass(subMenuVisibleClass);
				},
				interval: 50,
				timeout: 250
			});
		});

		// Header Search Form
		var $searchForm = publicVars.$header.find('.search-form');

		if($searchForm.length === 1)
		{
			var $searchInput = $searchForm.find('.search-input');

			$searchInput.blur(function()
			{
				if($.trim($searchInput.val()).length === 0)
				{
					$searchForm.removeClass('input-visible');
				}
			});

			$searchForm.on('click', '.search-btn', function(ev)
			{
				if($.trim($searchInput.val()).length === 0)
				{
					ev.preventDefault();

					$searchForm.addClass('input-visible');
					setTimeout(function(){$searchInput.focus();}, 200);
				}
				else
				{
					$searchForm.submit();
				}
			});
		}


		// Top Menu Subs
		publicVars.$header.find('.top-menu nav li:has(> ul)').each(function(i, el)
		{
			var $li = $(el);

			$li.hoverIntent({
				over: function(){
					$li.addClass(subMenuVisibleClass);
				},
				out: function(){
					$li.removeClass(subMenuVisibleClass);
				},
				timeout: 200,
				interval: 10
			});
		});

		// Sticky Menu
		if(publicVars.$header.hasClass('sticky'))
		{
			setupStickyMenu();
		}


		// Mobile Menu
		setupMobileMenu();

		// Footer Expand
		publicVars.$footer.find('.expand-footer').on('click', function(ev)
		{
			ev.preventDefault();

			publicVars.$footer.find('.footer-widgets').removeClass('hidden-xs').prev().removeClass('visible-xs').addClass('hidden');
		});


		// Autosize
		if($.isFunction($.fn.autosize))
		{
			$(".autosize, .autogrow").autosize();
		}


		// Lightbox
		if($.isFunction($.fn.nivoLightbox))
		{
			var isNivoDisabled = function() {
				return publicVars.$body.hasClass( 'nivo-disabled-product' ) && $( window ).width() < 768;
			}
			
			window.isNivoDisabled = isNivoDisabled;
			
			var lightbox_options = {
				effect: 'fade',
				theme: 'default',
			};
			
			$(".nivo a, a.nivo").nivoLightbox( lightbox_options );
			
			if ( isNivoDisabled() && publicVars.$body.hasClass( 'single-product' ) ) {
				$(".nivo a, a.nivo").unbind().on( 'click', function( ev ) {
					ev.preventDefault();
				} )
			}
			
			if( publicVars.$body.hasClass( 'single-post-lightbox-on' ) ) {
				$( '.single-post-lightbox-on .post-content a:has(img)' ).nivoLightbox( lightbox_options );
			}
		}
		


		// Owl Slider
		if($.isFunction($.fn.owlCarousel))
		{
			$(".owl-slider").each(function(i, el)
			{
				var $el = $(el),
					auto_play = false;


				if($el.data('autoswitch') || $el.data('autoswitch').length)
					auto_play = $el.data('autoswitch') * 1000;

				$el.owlCarousel({
					singleItem: true,
					navigation: true,
					autoPlay: auto_play,
					stopOnHover: true,
					direction: _rtl()
				});

				$el.find('a.hidden').removeClass('hidden');
			});
		}




		// WooCommerce JS
		var $wc_ordering = $(".woocommerce-ordering");

		if($wc_ordering.length)
		{
			$wc_ordering.on('click', '.dropdown-menu a', function(ev)
			{
				ev.preventDefault();

				var id = $(this).attr('href').replace('#', '');

				$('select[name="orderby"] option').each(function(i, el)
				{
					var $el = $(el);

					$el.prop('selected', false);

					if($el.val() == id)
					{
						$el.prop('selected', true);
					}
				});

				$wc_ordering.submit();
			});
		}

		$('[data-toggle="tooltip"]').tooltip();


		// Radio Buttons Replacement
		$('input[type="radio"] + label').each(function(i, el)
		{
			$(el).prev().addClass('replaced-radio-buttons');
		});

		$('input[type="checkbox"] + label').each(function(i, el)
		{
			$(el).prev().addClass('replaced-checkboxes');
		});
		
		// Fix Possible Tooltip Error on Add to Cart
		$( document.body ).on( 'adding_to_cart', function( ev, $button, data ) {
			$.each( data, function( key, val ) {
				if ( typeof val == 'object' ) {
					data[ key ] = '';
				}
			} );
		} );
		
		$( document.body ).on( 'mouseout', '.add_to_cart_button[data-toggle="tooltip"]', function( ev ) {
			$( this ).tooltip( 'hide' );
		} );
		
		// Added to cart update fragments
		$( document.body ).on( 'added_to_cart', function( ev, fragments, cart_hash, $button ) {
			
			// Add to Cart Tooltip
			var title = $button.data( 'title' ),
				title_loaded = $button.data( 'titleLoaded' ),
				tm = $button.data( 'tooltipTimeout' );
				
			$button.attr( 'title', title_loaded );
			
			// Update Cart Fragments
			aurumUpdateWCFragments()
						
			// Toggle success message and/or tooltips
			if ( $button.is( '[data-toggle="tooltip"]' ) ) {
				$button.tooltip( 'fixTitle').tooltip( 'show' );
				$button.data( 'bs.tooltip' ).$tip.addClass( 'tooltip-green' );
						
				if( _is_rtl() ) {
					$button.data('bs.tooltip').options.placement = 'right';
				}
				
				// Hide Tooltip and set back the previous title
				window.clearTimeout( tm );
				
				tm = setTimeout( function() {
					$button.tooltip( 'hide' ).removeClass( 'added' );
					
					setTimeout( function() {
						$button.data( 'bs.tooltip' ).$tip.removeClass( 'tooltip-green' );
						$button.attr( 'title', title ).tooltip( 'fixTitle' )
					}, 250 );
				}, 2500 );
			} else {
				window.clearTimeout( tm );
				
				tm = setTimeout( function() {
					$button.removeClass( 'added' );
				}, 2500 );
			}
		} );
		

		// Shop Images Lazy Loading
		
		function initShopHovers() {

			// Fade effect + with slide
			$(".shop-item.hover-effect-1:has(.lazy-load-shop-image)").each(function(i, el)
			{
				var $el = $(el),
					imagesLoaded = false;
				
				if ( $el.data( 'is-init' ) ) {
					return false;
				}
				
				$el.data( 'is-init', false );

				$el.addClass('has-images');

				$el
				.on('mouseenter', function()
				{
					$el[imagesLoaded ? 'removeClass' : 'addClass']('is-loading');

					startLoadingImages($el.find('.lazy-load-shop-image'), function()
					{
						$el.removeClass('is-loading').unbind();
					});
				})
				.on('mouseout', function()
				{
					$el.removeClass('is-loading');
				});

			});

			// Effect 2 (gallery slides)
			$(".shop-item.hover-effect-2:has(.lazy-load-shop-image)").each(function(i, el)
			{
				var $el            = $(el),
					$images        = $el.find('.item-image img'),
					$nav		   = $('<nav></nav>'),
					images_total   = $images.length;
				
				if ( $el.data( 'is-init' ) ) {
					return false;
				}
				
				$el.data( 'is-init', false );

				$el.addClass('has-images').find('.item-image').append( $nav );
				
				$images.each(function(j, img)
				{
					var $img = $(img),
						$a = $('<a href="#"></a>');

					$a.data({
						index: j
					}).html(j + 1);

					if(j == 0)
						$a.addClass('active');

					$nav.append( $a );
				});

				$nav.on('click', 'a', function(ev)
				{
					ev.preventDefault();

					var $a = $(this),
						$img = $images.eq( $a.data('index') );

					$a.addClass('active');
					$a.siblings().not($a).removeClass('active');


					if( ! $img.data('loaded'))
					{
						$el.addClass('is-loading');

						startLoadingImages($img, function()
						{
							$img.addClass('active');
							$images.not($img).removeClass('active');

							$el.removeClass('is-loading');
						});
					}
					else
					{
						$img.addClass('active');
						$images.not($img).removeClass('active');
					}
				});
			});
		}
		
		initShopHovers();
		
		jQuery( document ).ajaxComplete( function( ev, req, settings ) {
			
			if ( typeof settings.data == 'string' && settings.data.match( /action=prdctfltr_respond/ ) ) {
				initShopHovers();
			}
		} );
		


		// Lazy load all shop images when window has finished loading
		$(window).on('load', function()
		{
			if(publicVars.$body.hasClass('product-images-lazyload'))
			{
				return; // Disable automatic loading
			}

			$('.shop-item img:not(.lazy-load-shop-image)').data('loaded', true);
			startLoadingImages($('.shop-item .lazy-load-shop-image'));
		});


		function startLoadingImages($images, callback)
		{
			var total_images = $images.length,
				loaded_images = 0;

			$images.each(function(i, el)
			{
				var $img = $(el),
					loader = new Image(),
					src = $img.data('src');

				var afterLoaded = function()
				{
					$img.attr('src', src).data('loaded', true).removeAttr('data-src');
					loaded_images++;

					if(loaded_images == total_images)
					{
						if(typeof callback == 'function')
						{
							callback();
						}
					}
				};

				loader.src = src;
				loader.onload = afterLoaded;
				loader.onerror = afterLoaded;

			});
		}

		function updateCartNumber(fragments)
		{
			if(publicVars.$cartCounter.length)
			{
				var $badge = publicVars.$cartCounter.find('.badge'),
					items = fragments.aurumCartItems,
					html = fragments.aurumMinicart;

				publicVars.$cartCounter[items > 0 ? 'addClass' : 'removeClass']('has-notifications');

				TweenMax.to($badge, .25, {css: {transform: "scale(.6)"}, onComplete: function()
				{
					$badge.html(items);
					TweenMax.to($badge, .15, {css: {transform: "scale(1)"}});
									
					if ( items > 0 ) {
						publicVars.$cartCounter.removeClass( 'cart-zero' );
					} else {
						publicVars.$cartCounter.addClass( 'cart-zero' );
					}

					if ( html ) {
						publicVars.$miniCart.html(html);
					}
					
					TweenMax.to(publicVars.$miniCart.find('.cart_list'), .15, {css: {autoAlpha: 1}});

					publicVars.$miniCart.find('.cart_list').perfectScrollbar();
				}});
			}
		}


		// Select Picker
		if($.isFunction($.fn.selectpicker))
		{
			$(".selectpicker").selectpicker();
		}


		// Quantity
		$(".quantity.buttons_added .input-text").attr('type', 'text');


		// Owl Carousel
		var singleItemProductCarousel = {};

		if($.isFunction($.fn.owlCarousel))
		{
			var $mainImages = $(".item-details-single .product-images"),
				$itemThumbs = $(".item-details-single .product-thumbnails a"),
				miAutoswitch = parseInt($mainImages.data('autoswitch'), 10);

			$mainImages.find('a').data('is-general', true);

			singleItemProductCarousel = {
				singleItem: true,
				navigation: true,
				autoPlay: miAutoswitch > 0 ? miAutoswitch : false,
				stopOnHover: true,
				navigationText: ['', ''],
				items: 'a',
				afterMove: function(e)
				{
					var index = $mainImages.data('owlCarousel').currentItem,
						minus = 0;

					$mainImages.find('a').each(function(i, el){

						if( ! $(el).data('is-general'))
						{
							minus++;
						}
					});

					index -= minus;
					index = index < 0 ? 0 : index;

					$itemThumbs.removeClass('active').eq(index).addClass('active');

					if( ! $itemThumbs.eq(index).hasClass('current'))
					{
						if($(".shop.shop-item-single .product-thumbnails").data('anVerticalCarousel'))
						{
							$(".shop.shop-item-single .product-thumbnails").data('anVerticalCarousel').fns.setIndex(index);
						}
					}
				},
				direction: _rtl()
			};

			if($itemThumbs.length > 0)
			{
				$mainImages.owlCarousel(singleItemProductCarousel).find('.hidden').removeClass('hidden');

				$itemThumbs.on('click', function(ev)
				{
					ev.preventDefault();

					var index = $(this).index();

					// Extra Images Added
					$mainImages.find('a').each(function(i, el){

						if( ! $(el).data('is-general'))
						{
							index++;
						}
					});

					$mainImages.data('owlCarousel').goTo(index);
				});

				var $thumbnails = $(".shop.shop-item-single .product-thumbnails[data-show]");

				if($thumbnails.length)
				{
					$thumbnails.anVerticalCarousel({
						items: "a",
						show: $thumbnails.data('show')
					});
				}
			}


			// Variations selector
			$( 'form.variations_form' )
			.on('found_variation', function(ev, variation){

				if(variation.image_src)
				{
					showVariation(variation);
				}
			})
			.on('wc_additional_variation_images_frontend_lightbox', function(a)
			{
				var html = $(".images .thumbnails").html();

				if(html)
					showVariation(null, html);

			})
			.on('reset_image', function(){
				showVariation();
			});

			var showVariation = function(variation, extra)
			{
				if($mainImages.data('owlCarousel'))
					$mainImages.data('owlCarousel').destroy();

				// Remove Non-general images
				if( ! extra)
				{
					$mainImages.find('a').each(function(i, el)
					{
						var $el = $(el);

						if( ! $el.data('is-general'))
						{
							$el.remove();
						}
					});
				}

				if(variation)
				{
					// Variation has Image
					if( variation.image_src )
					{
						var $a = $('<a />'),
							$img = $('<img />');

						$a.attr({
							'href': variation.image_src,
							'title': variation.image_title,
							'data-lightbox-gallery': 'shop-gallery'
						});

						$img.attr({
							src: variation.image_src
						});

						$a.append($img);

						$mainImages.prepend($a)
					}
				}

				if(extra)
				{
					$mainImages.find('a').first().after(extra);
				}

				if($.isFunction($.fn.nivoLightbox))
				{
					if ( ! isNivoDisabled() ) {
						$mainImages.find('a').nivoLightbox({
							effect: 'fade',
							theme: 'default',
						});
					} else {
						$mainImages.find('a').on( 'click', function( ev ) {
							ev.preventDefault();
						} );
					}
				}

				$mainImages.owlCarousel(singleItemProductCarousel);
			};
		}


		// Stars Rating
		$(".comment-form-rating p.stars").on('click', function(ev)
		{
			$(this)[ $(this).has('.active') ? 'addClass' : 'removeClass' ]('has-rating');
		});


		// WooCommerce Review Link
		$(".woocommerce-review-link").on('click', function(ev)
		{
			ev.preventDefault();

			var $reviews = $(".reviews_tab");

			var obj = {pos: $(window).scrollTop()};

			TweenLite.to(obj, 1, {pos: $reviews.offset().top, ease:Power4.easeOut, onUpdate: function()
			{
				$(window).scrollTop(obj.pos);
			}});
		});


		// Coupon Env
		$( 'div.woocommerce' ).on( 'click', '.coupon-env .coupon-enter', function( ev ) {
			ev.preventDefault();
			
			var $couponEnv = $( this ).parent(),
				$input = $couponEnv.find('.form-control');
			
			$couponEnv.addClass('coupon-visible');

			setTimeout(function(){ $input.focus(); }, 200);
		} ).on( 'click', '.coupon-env .close-coupon', function( ev ) {
			ev.preventDefault();
			
			$( this ).closest( '.coupon-env' ).removeClass('coupon-visible');
		} );
		

		$("body").on('country_to_state_changing', function(ev)
		{
			$("#calc_shipping_state").addClass('form-control');
		});

		$('input[name="update_cart"]').show();
		$("#update-cart-btn").on('click', function(ev)
		{
			ev.preventDefault();

			$('input[name="update_cart"]').click();
		});


		// Remove From Cart
		$(".item-image").each(function(i, el)
		{
			var $el = $(el);

			$el.on('click', '.remove-item', function(ev)
			{
				$el.closest('tr').addClass('item-removing');
			});
		});


		// Cart Counter
		publicVars.$cartCounter.on('click', function(ev)
		{
			if ( jQuery( window ).width() <= 768 || publicVars.$cartCounter.hasClass( 'direct-link' ) ) {
				return true;
			}
			
			ev.preventDefault();

			publicVars.$miniCart.toggleClass('cart-visible');

			if(publicVars.$miniCart.hasClass('cart-visible'))
			{
				setTimeout(function()
				{
					$(document).on('click', checkForOutSideEventsToCloseMinicart);
				}, 1);
			}
			else
			{
				$(document).off('click', checkForOutSideEventsToCloseMinicart);
			}
		});

		var checkForOutSideEventsToCloseMinicart = function(ev)
		{
			if( ! $(ev.target).closest(publicVars.$miniCart).length)
			{
				publicVars.$miniCart.removeClass('cart-visible');
				$(document).off('click', checkForOutSideEventsToCloseMinicart);
			}
		};


		// Mini Cart show on Hover
		if(publicVars.$cartCounter.hasClass('hover-activated'))
		{
			publicVars.$cartCounter.hoverIntent({
				over: function()
				{
					publicVars.$miniCart.addClass('cart-visible');
				},

				out: function()
				{
					if(publicVars.$miniCart.hasClass('is-hovered') == false)
					{
						publicVars.$miniCart.removeClass('cart-visible');
					}
				},

				timeout: 400
			});

			publicVars.$miniCart.hoverIntent({
				over: function()
				{
					publicVars.$miniCart.addClass('is-hovered');
				},

				out: function()
				{
					publicVars.$miniCart.removeClass('is-hovered cart-visible');
				},
				interval: 1,
				timeout: 300
			});
		}


		// Cart List Scrollbar
		publicVars.$miniCart.find('.cart_list').perfectScrollbar();


		// Login Form Open
		$(".login-button").on('click', function(ev)
		{
			ev.preventDefault();

			if(publicVars.$loginForm.data('is-busy'))
				return false;

			publicVars.$loginForm.data('is-busy', true);

			if(publicVars.$loginForm.is(':visible'))
			{
				TweenMax.to(publicVars.$loginForm, .5, {css: {height: 0, autoAlpha: 0}, onComplete: function()
				{
					publicVars.$loginForm.attr('style', 'display:none');
					publicVars.$loginForm.data('is-busy', false);
				}});
			}
			else
			{
				var login_height = publicVars.$loginForm.show().outerHeight();

				publicVars.$loginForm.css({
					height: 0,
					opacity: 0
				});

				TweenMax.to(publicVars.$loginForm, .5, {css: {height: login_height, autoAlpha: 1}, onComplete: function()
				{
					publicVars.$loginForm.data('is-busy', false);
					publicVars.$loginForm.attr('style', '');
				}});
			}
		});

		// Styling Select Elements
		$("select.country_select").addClass('form-control');

		// Proceed to Checkout
		$("#proceed-to-checkout").on('click', function(ev)
		{
			ev.preventDefault();

			$('input[name="proceed"]').click();
		});

		// Insert WooCommerce Messages inside Shop
		if($(".woocommerce-error, .woocommerce-message").length && $(".woocommerce .woocommerce-error, .woocommerce .woocommerce-message").length == 0)
		{
			$("section.woocommerce .container").prepend( $(".woocommerce-error, .woocommerce-message") );
		}

		// Bacs
		$(".order_details.bacs_details").each(function(i, el)
		{
			var $el = $(el);

			if($el.prev().is('h3'))
			{
				$el.prepend( $el.prev() );
			}
		});

			// Extra Tabs
			var $wc_social_login_plugin = $(".wc-social-login-profile");

			if($(".content-pane").length > 0 && $wc_social_login_plugin.length)
			{
				var $slp_pane = $('<div class="content-pane" id="woocommerce-social-login"></div>');

				$(".my-account-content").append( $slp_pane );

				$slp_pane.append( $wc_social_login_plugin );
			}

		// Active tab
		var accHash = window.location.hash.toString();

		if(accHash.length > 1 && $my_account_links.length)
		{
			var $mal_active = $my_account_links.find('a[href$="'+accHash+'"]');

			if($mal_active.length)
			{
				$mal_active.parent().siblings().removeClass('active');
				$mal_active.click();
				setTimeout(function(){ $(window).scrollTop(0); }, 1);
			}
		}


		// Search Go Back
		$(".go-back").on('click', function(ev)
		{
			ev.preventDefault();

			window.history.go(-1);
		});


		// WCML Currency Switcher
		var $wcml_currency_switcher = $(".top-menu select.wcml_currency_switcher");

		if($wcml_currency_switcher.length && $.isFunction($.fn.selectpicker))
		{
			setTimeout(function(){

				$wcml_currency_switcher.unbind().selectpicker();

				$wcml_currency_switcher.on('change', function()
				{
					var val = $(this).val();
					load_currency(val);
				});
			}, 100);
		}


		var load_currency = function(currency) // Imported from woocommerce-multilingual/inc/multi-currency-support.class.php
		{
		    jQuery('.wcml_currency_switcher').attr('disabled', 'disabled');
		    jQuery('.wcml_currency_switcher').after();

		    var data = {
		        action: 'wcml_switch_currency',
		        currency: currency
		    }

		    jQuery.post(woocommerce_params.ajax_url, data, function() {
		        jQuery('.wcml_currency_switcher').removeAttr('disabled');
		        location.reload();
		    });
		}
		// End: WooCommerce JS


		// Scroll Reveal
		if(typeof WOW != 'undefined')
		{
			new WOW().init();
		}


		// Testimonials Switcher
		$(".lab_wpb_testimonials").each(function(i, el)
		{
			var $testimonials    	= $(el),
				$inner              = $testimonials.find('.testimonials-inner'),
				$items              = $testimonials.find('.testimonial-entry'),
				$items_hidden       = $items.filter('.hidden'),
				autoswitch          = $testimonials.data('autoswitch'),
				$nav                = $('<div class="testimonials-nav">'),
				current_slide       = 0;

			$items.eq(current_slide).addClass('current');

			$items_hidden.removeClass('hidden').hide();

			if($items.length > 1)
			{
				for(var i=0; i<$items.length; i++)
				{
					$nav.append('<a href="#"'+(i == current_slide ? ' class="active"' : '')+' data-index="'+i+'">'+(i+1)+'</a>');
				}

				$inner.append( $nav );
			}

			var goToSlide = function(index)
			{
				if(current_slide != index)
				{
					index = index % $items.length;

					var $to_hide = $items.filter('.current'),
						$to_show = $items.eq(index);

					$to_show.show();
					$to_hide.hide();

					var next_height = $to_show.outerHeight(true) + $nav.outerHeight();

					$to_hide.show();
					$to_show.hide();

					$nav.find('a').removeClass('active').eq(index).addClass('active');

					var $th_thumbnail = $to_hide.find('.testimonial-thumbnail'),
						$th_blockquote = $to_hide.find('.testimonial-blockquote p'),
						$th_cite = $to_hide.find('.testimonial-blockquote cite');

					var $ts_thumbnail = $to_show.find('.testimonial-thumbnail'),
						$ts_blockquote = $to_show.find('.testimonial-blockquote p'),
						$ts_cite = $to_show.find('.testimonial-blockquote cite');

					TweenLite.to($th_thumbnail, .10, {css: {autoAlpha: 0}});
					TweenLite.to($th_cite, .25, {css: {autoAlpha: 0, top: 20}});

					TweenLite.to($th_blockquote, .25, {css: {autoAlpha: 0}, delay: .1, onComplete: function()
					{
						$th_thumbnail.attr('style', '');
						$th_blockquote.attr('style', '');
						$th_cite.attr('style', '');

						$to_hide.attr('style', '').removeClass('current').hide();
						$to_show.show().addClass('current');

						TweenLite.set($to_show, {css: {autoAlpha: 0}});
						TweenLite.set($ts_cite, {css: {autoAlpha: 0, top: 20}});

						TweenLite.to($ts_cite, .25, {css: {autoAlpha: 1, top: 0}, onComplete: function()
						{
							$ts_cite.attr('style', '');
						}});

						TweenLite.to($to_show, .25, {css: {autoAlpha: 1}, onComplete: function()
						{
							current_slide = index;
						}});

					}});

					TweenLite.to($inner, .35, {css: {height: next_height}, onComplete: function()
					{
						$inner.attr('style', '');
					}});
				}
			};

			$nav.on('click', 'a', function(ev)
			{
				ev.preventDefault();
				goToSlide( parseInt($(this).data('index'), 10) );
			});


			if(autoswitch > 0)
			{
				var hover_tm = 0,
					setupAutoSwitcher = function(on)
					{
						window.clearTimeout(hover_tm);

						if(on)
						{
							hover_tm = setTimeout(function()
							{
								goToSlide(current_slide+1);
								setupAutoSwitcher(1);

							}, autoswitch * 1000);
						}
					};

				$testimonials
				.on('mouseover', function()
				{
					setupAutoSwitcher();
				}).
				on('mouseleave', function()
				{
					setupAutoSwitcher(true);
				});

				setupAutoSwitcher(true);
			}
		});


		// Quantity Buttons for WooCommerce 2.3.x
		var replaceWooCommerceQuantityButtons = function()
		{
			$(".quantity").each(function(i, el)
			{
				var $quantity = $(el),
					$button = $quantity.find('.qty');

				if($quantity.hasClass('buttons_added'))
					return;

				$quantity.addClass('buttons_added');

				$button.before('<input type="button" value="-" class="plusminus minus">');
				$button.after('<input type="button" value="+" class="plusminus plus">');
			});
		};

		replaceWooCommerceQuantityButtons();

		$("body").on('click', 'input[type="button"].plusminus', function()
		{
			var $this = $(this),
				$quantity = $this.prev(),
				add = 1;

			if($this.hasClass('minus'))
			{
				$quantity = $this.next();
				add = -1;
			}
			
			var newVal = parseInt($quantity.val(), 10) + add;
			
			if(newVal < 0)
				newVal = 0;

			$quantity.val(newVal).trigger( 'change' );
		});

		// Image Magnifier
		var $magnifier = $(".product-images.magnify-active");

		if($magnifier.length)
		{
			$magnifier.on('mouseenter', function(){
				$magnifier.addClass('hovered');
				
				if(typeof $magnifier.data('owlCarousel') != 'undefined')
				{
					$magnifier.data('owlCarousel').stop();
				}
			});

			$magnifier.find(".owl-item a, > a").each(function(i, el)
			{
				var $a = $(el),
					$img = $a.find('img');

				$img.attr({
					'data-imagezoom': $a.attr('href')
				});
			});
		}



		// Lightbox for Gallery items inside blog post
		$(".post-content .gallery").each(function(i, el)
		{
			var $gallery = $(el),
				$items = $gallery.find('a'),
				has_gallery_lb = false;

			$items.each(function(j, item)
			{
				var $item = $(item);

				if($item.attr('href').match(/(jpg|jpeg|png|gif)$/i))
				{
					$item.attr('data-lightbox-gallery', 'post-gallery-' + (i+1));
					has_gallery_lb = true;
				}
			});

			if(has_gallery_lb)
			{
				$items.nivoLightbox({
					effect: 'fade',
					theme: 'default',
				});
			}
		});
		
		
		// Add to wishlist
		$(".yith-add-to-wishlist").each(function(i, el)
		{
			var $this = $(el),
				url = $this.data('listid'),
				id = url.match(/add_to_wishlist=([0-9]+)/);

			if(id.length)
				id = id[1];

			$this.on('click', function(ev)
			{
				ev.preventDefault();

				$this.parent().addClass('is-loading');

				$.post(url, {}, function(resp, textStatus, xhr)
				{
					$this.parent().removeClass('is-loading');

					if(resp.match(/true\#\#/) || resp.match(/exists\#\#/) || resp.match(/DOCTYPE html/))
					{
						$this.parent().addClass('wishlisted');

						$("#product-"+id+" .yith-wcwl-wishlistexistsbrowse").removeClass('hide').hide().slideDown();
					}
				});
			});
		});
		
		
		// Sticky in Mobile
		$(".mobile-menu.sticky-mobile").each(function(i, el)
		{
			var $stickyMenu = $(el),
				$spacer = $('<div class="mobile-menu-fixed-spacer"></div>'),
				height = 0;;
			
			$stickyMenu.addClass('is-fixed-mobile');
			
			height = $stickyMenu.outerHeight();
			
			if(publicVars.$body.hasClass('transparent-header') == false)
			{
				$stickyMenu.before($spacer);
				$spacer.height(height);
			}
		});
		
		
					
		// Shop Masonry
		$( '.products.products-masonry' ).each( function( i, el ) {
			
			var $this = $( el );
			
			$this.removeClass( 'hidden ');
		
			if ( $this.prev().is( '.shop-loading-products' ) ) {
				$this.prev().remove();
			}
			
			var $categories = $this.find( '> .product-category' );
			
			if ( $categories.length ) {
				var $categoriesContainer = $( '<div class="products categories-holder"></div>' );
				$this.before( $categoriesContainer );
				
				$categoriesContainer.append( $categories );
				$categories.addClass( 'category-col-item' );
				
				// Categories Isotope
				$categoriesContainer.isotope( {
					itemSelector: '.category-col-item',
					layoutMode: $this.data('layoutMode')
				} );
				
				$categoriesContainer.find( 'img' ).each( function( i, el ) {
					var img = new Image();
					img.src = el.getAttribute( 'src' );
					img.onload = function() {
						$categoriesContainer.isotope( 'layout' );
					}
				} );
				
			}
			
			$this.isotope({
				itemSelector: '.item-column',
				layoutMode: $this.data('layoutMode')
			});
			
			$this.find( 'img' ).each( function( j, el2 ) {
				var img = new Image(),
					img_url = $( this ).attr( 'src' );
				
				if ( img_url ) {
					img.src = img_url;
					img.onload = function() {
						$this.isotope( 'layout' );
					}
				}
			} );
		} );
		
		
		// Product Variation Images (Change Thumbnail)
		$( document ).on( 'found_variation', function( ev, variation ) {
			if ( variation.image_src.length ) {
				var $img = $( '.product-thumbnails .first img' ).attr( 'src', variation.image_src );
				
				var $magnifier = $(".product-images.magnify-active"),
					view_size = $magnifier.data('zoom-viewsize');
				
				if ( $magnifier.length ) {
					var $img = $magnifier.find( '.owl-item:first-child img' );
					
					$img.attr( 'data-imagezoom', variation.image_link ).imageZoom({
					    zoomviewsize: view_size.split(','),
					    magnification: parseFloat($magnifier.data('zoom-level'))
				    });
				}
				
			}
		} );
		
		// First Thumbnail of Variation
		var $variation_thumb = $( '.product-thumbnails a:first-child' );
		
		if ( $variation_thumb.length ) {
			$variation_thumb.data( {
				main: $variation_thumb.attr( 'href' ),
				thumb: $variation_thumb.find( 'img' ).attr( 'src' )
			} );
			
			$( document ).on( 'reset_image', function( ev ) {
				$variation_thumb.find( 'img' ).attr( 'src', $variation_thumb.data( 'thumb' ) );
				$( '.woocommerce-main-image' ).first().find( 'img' ).attr( 'src', $variation_thumb.data( 'main' ) );
			} );
		}
		
		// Update Cart Number
		jQuery( document ).on( 'updated_wc_div', function( e, d ) {
			replaceWooCommerceQuantityButtons();
			
			var itemsInCart = 0;
			
			$( '.quantity input.qty' ).each( function( i, el ) {
				itemsInCart += Number( $( el ).val() );
			} );
		} );
		
		
		// WC Cart Fragments Refresh
		var aurumUpdateWCFragments = function() {
			if ( 'sessionStorage' in window ) {
				updateCartNumber( $.parseJSON( sessionStorage.wc_fragments ) );
			}
		}
		
		jQuery( document.body ).on( 'wc_fragments_refreshed', aurumUpdateWCFragments );
		
		// Update Cart with Session Storage (ex-ajax form)
		if ( publicVars.$cartCounter.hasClass( 'cart-counter-ajax' ) ) {
			aurumUpdateWCFragments();
		}
		
		
		// Social Links open in pop up
		var $links = $( '.share-post .share-product, .share-post .share-post-links' ).find( 'a' );

		$links.each( function(){
			var $this = $( this );
			
			$this.click( function( ev ) {
				ev.preventDefault();
				var url = $( this ).attr( 'href' ),
					w = 500,
					h = 420;
				window.open( url, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=" + ( ( screen.height / 2 ) - ( h / 2 ) ) + ", left=" + ( ( screen.width / 2 ) - ( w / 2 ) ) +", width=" + w + ", height=" + h );
			});
			
		} );
		
		// Fit Vids
		publicVars.$body.fitVids();
		
		// Updated Cart (empty)
		$( document.body ).on( 'updated_wc_div', function() {
			if ( $( '.cart-empty' ).length == 1 ) {
				var $emptyCartPage = $( '.shop-empty-cart-page' );
				
				$emptyCartPage.parent().before( $emptyCartPage );
				
				setTimeout( function() {
					$(".cart-smiley").addClass('shown');
				}, 300 );
			}
		} );

	});

	function setupStickyMenu()
	{
		var headerType = 1;

		if(publicVars.$header.hasClass('header-type-2'))
		{
			headerType = 2;
		}
		else
		if(publicVars.$header.hasClass('header-type-3'))
		{
			headerType = 3;
		}
		else
		if(publicVars.$header.hasClass('header-type-4'))
		{
			headerType = 4;
		}

		// Initialize sticky menu
		var $watcherElement = publicVars.$header.find('.header-menu');

		if(headerType === 2)
		{
			$watcherElement = publicVars.$header.find('.full-menu');
		}
		else
		if(headerType === 3 || headerType === 4)
		{
			$watcherElement = publicVars.$header.find('> .container');
		}

		var watcher      	= window.scrollMonitor.create($watcherElement.get(0), {top: publicVars.$body.hasClass('admin-bar') ? 32 : 0}),
			$spacer         = null,
			headerHeight    = publicVars.$header.outerHeight(),
			minWidth		= 768;

		publicVars.$header.before('<div class="header-spacer hidden"></div>');

		$spacer = publicVars.$header.prev();

		$spacer.height(headerHeight);

		watcher.lock();

		watcher.partiallyExitViewport(function()
		{
			if(minWidth > $(window).width())
			{
				return;
			}

			publicVars.$header.addClass('sticked');
			$spacer.removeClass('hidden');

			// Header Top Menu
			if(publicVars.$headerTopMenu.length)
			{
				publicVars.$headerTopMenu.addClass('hidden');
			}

			// Menu Type 2 Options
			if(headerType === 2)
			{
				publicVars.$header.find('.header-menu').addClass('hidden');
				publicVars.$header.find('.full-menu .logo').addClass('visible').hide().fadeTo(200, 1);
			}
		});

		watcher.fullyEnterViewport(function()
		{
			if(minWidth > $(window).width())
			{
				return;
			}

			publicVars.$header.removeClass('sticked');
			$spacer.addClass('hidden');

			// Header Top Menu
			if(publicVars.$headerTopMenu.length)
			{
				publicVars.$headerTopMenu.removeClass('hidden');
			}

			// Menu Type 2 Options
			if(headerType === 2)
			{
				publicVars.$header.find('.header-menu').removeClass('hidden');
				publicVars.$header.find('.full-menu .logo').removeClass('visible').attr('style', '');
			}
		});
	}

	function setupMobileMenu()
	{
		var subMenuVisibleClass = 'sub-visible',
			expandOrCollapseDelay = 0.2;

		publicVars.$mobileMenu.find('.mobile-menu li:has(> ul)').each(function(i, el)
		{
			var $li  	= $(el),
				$a      = $li.children('a'),
				$sub    = $li.children('ul');

			$a.append('<span class="sub-menu-indicator"><i class="entypo-plus"></i></span>');

			var $sub_i = $a.find('.sub-menu-indicator');

			$sub_i.on('click', function(ev)
			{
				ev.preventDefault();

				if( ! $li.hasClass(subMenuVisibleClass))
				{
					$li.addClass(subMenuVisibleClass);

					var subHeight = $sub.outerHeight();

					$sub.height(0);

					TweenMax.to($sub, expandOrCollapseDelay, {css: {height: subHeight}, onComplete: function()
					{
						$sub.attr('style', '');
					}});
				}
				else
				{
					TweenMax.to($sub, expandOrCollapseDelay, {css: {height: 0}, onComplete: function()
					{
						$sub.attr('style', '');
						$li.removeClass(subMenuVisibleClass);

						$sub.find("."+subMenuVisibleClass).removeClass(subMenuVisibleClass).children('ul').attr('style', '');
					}});
				}
			});
		});

		publicVars.$mobileMenu.find('.toggle-menu').on('click', function(ev)
		{
			ev.preventDefault();

			publicVars.$mobileMenu.find('.mobile-menu').toggle();
			publicVars.$mobileMenu.find('.search-site').toggle();
			publicVars.$mobileMenu.find('.cart-info').toggle();
			publicVars.$mobileMenu.find('.site-header').toggle();

			publicVars.$mobileMenu.find('.cart-info a').unbind();
		});

		publicVars.$mobileMenu.find('.site-header .right-align').removeClass('right-align');
	}

})(jQuery, window);


function _rtl()
{
	return jQuery("html").is('[dir="rtl"]') ? 'rtl' : 'ltr';
}

function _is_rtl()
{
	return _rtl() == 'rtl';
}

function is_touch_device() {
  return 'ontouchstart' in window        // works on most browsers 
      || 'onmsgesturechange' in window;  // works on IE10 with some false positives
};

// Query Parameters
jQuery.extend({
  getQueryParameters : function(str) {
	  return (str || document.location.search).replace(/(^\?)/,'').split("&").map(function(n){return n = n.split("="),this[n[0]] = n[1],this}.bind({}))[0];
  }
});
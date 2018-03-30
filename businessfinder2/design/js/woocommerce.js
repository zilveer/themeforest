


(function($){

	"use strict";

	var WooCommerce;
	var $cartWrapper;

	WooCommerce = {

		init: function(){
			$cartWrapper = $('#ait-woocommerce-cart-wrapper');

			WooCommerce.cartDropdown();

			WooCommerce.productsContainerClasses();

			WooCommerce.productsCarousel($('#container ul.ait-products-carousel'));

			WooCommerce.prodcutThumbnailsCarousel($('body.woocommerce-page').find('.product-details-wrapper .images > .thumbnails'));

			WooCommerce.productReviews();

			WooCommerce.select2Class();
		},



		/**
		 * Cart Dropdown
		 */
		cartDropdown: function(){
			var $cart = $cartWrapper.find('#ait-woocommerce-cart').css({display: 'none', opacity: 0});

			if($cart.children().length){
				$cartWrapper.hover(
					function(){
						$cart.css({display: 'block'}).stop().animate({opacity: 1});
					},
					function(){
						$cart.stop().animate(
							{opacity: 0},
							function(){
								$cart.css({display:'none'});
							});
					}
				);
			}
		},



		/**
		 * Creates products carousel from shortcode
		 * @param  {jQuery} $items Unordered list with products
		 */
		productsCarousel: function($items){
			if($items.length && $items.children().length){

				var $carouselWrraper = $('.ait-products-carousel-wrapper'),
					$itemsWrapper = $('.ait-products-carousel-items-wrapper');

				$carouselWrraper.append('<a class="jcarousel-arrow jcarousel-prev" href="#"></a><a class="jcarousel-arrow jcarousel-next" href="#"></a>');

				$itemsWrapper.jcarousel({'animation': 'slow'});

				$carouselWrraper.find('.jcarousel-prev').jcarouselControl({target: '-=3'});
				$carouselWrraper.find('.jcarousel-next').jcarouselControl({target: '+=3'});
			}
		},



		/**
		 * Creates product thumbnails carousel on product detail page
		 * @param  {jQuery} $items Unordered list with products
		 */
		prodcutThumbnailsCarousel: function($items){
			if($items.length && $items.children().length){

				var $listWrapper = $items.wrapAll('<div class="ait-product-thumbnails-carousel" />').parent();

				var $carouselWrraper = $listWrapper.wrapAll('<div class="ait-product-thumbnails-carousel-wrapper" />').parent();

				$carouselWrraper.append('<a class="jcarousel-arrow jcarousel-prev" href="#"></a><a class="jcarousel-arrow jcarousel-next" href="#"></a>');

				$listWrapper.jcarousel({'animation': 'slow'});

				$carouselWrraper.find('.jcarousel-prev').jcarouselControl({target: '-=3'});
				$carouselWrraper.find('.jcarousel-next').jcarouselControl({target: '+=3'});
			}
		},



		/**
		 * Adds classes with number of columns
		 */
		productsContainerClasses: function(){
			var $uls = $('#content ul.products:not(.ait-products-carousel)'),
				defaultColumns = 4; // see woocommerce shortcodes default values


			$uls.each(function(i){
				var $ul = $(this);
				var lastIndex = $ul.children().index($ul.find('.last'));
				var $children = $ul.children();
				var children = $children.length;
				var isSidebar = $('.sidebar').length;

				lastIndex = lastIndex == -1 ? defaultColumns : lastIndex + 1;

				// special case if there are just 5 items
				if(children == 5 && lastIndex == 4 && !isSidebar){
					$children.eq(lastIndex - 1).removeClass('last');
					$children.eq(lastIndex).attr('class', 'product last');
					lastIndex = 5;
				}

				if(lastIndex >= 3 && lastIndex <= 5)
					$ul.addClass('columns-' + lastIndex);
			});
		},

		/**
		 * Replace reviews form by popup window
		 */
		productReviews: function(){
			var reviewFormHref = $('.woocommerce-tabs #reviews .show_review_form').attr('href');
			var reviewFormHtml = $(reviewFormHref).clone();
			$(reviewFormHref).hide();
			$('.woocommerce-tabs #reviews a.show_review_form').colorbox({
				html: reviewFormHtml,
				width: isResponsive(480)? "100%" : "50%",
				className: 'ait-wc-product-review-form',
			});

			$(document).bind('cbox_complete', function(e, test){
				if( $('#colorbox').hasClass('ait-wc-product-review-form') ){
					// resize colorbox content only for wc product review form
					$.colorbox.resize();
				}
			});
		},

		select2Class : function(){
			$('.woocommerce-page .woocommerce select').on("select2-open", function(){ 
				$('.select2-drop').addClass('ait-woocommerce-select2');
			});

			$('.woocommerce-page .woocommerce select').on("select2-close", function() {
				$('.select2-drop').removeClass('ait-woocommerce-select2');
			});
		},

		/*productVariationsFormFix : function(){
			$('form.variations_form a.reset_variations').on('click', function(e){
				//e.preventDefault();
				var selectId;
				var oldStyle;

				$('form.variations_form select option').removeAttr('selected');
				$('form.variations_form select').selectbox('detach');
				$('form.variations_form select').selectbox({
					onOpen: function(inst){
						selectId = inst.settings.classHolder+"_"+inst.uid;
						$("#"+selectId).attr('style', 'z-index: 100 !important');
					},
					onClose: function(inst){
						$("#"+selectId).delay(100).queue(function(next){
							$(this).removeAttr("style");
							next();
						});
					}
				});
			});
		}*/
	};



	$(function(){
		WooCommerce.init();
	});

	/*$(window).load(function(){
		WooCommerce.productVariationsFormFix();
	});*/

	/* Fix for progressive preloading enabled */
	// woocemmerce updates the checkout form -> specially the payment types are loaded via ajax
	$(document.body).on('updated_checkout', function(){
		var $container = $("body.woocommerce-page.woocommerce-checkout");
		if($container.hasClass('preloading-enabled')){
			var $element = $container.find('.elm-content-main');
			$element.find('img').each(function(){
				$(this).addClass('load-finished');
			});
		}
	});
	/* Fix for progressive preloading enabled */

})(jQuery);

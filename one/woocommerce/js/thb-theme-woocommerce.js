(function($) {
	"use strict";

	document.addEventListener('DOMContentLoaded', function() {
		if( !$('body').hasClass('thb-mobile') ) {
			var thb_cart_over = false;

			$(document)
				.on("mouseenter", ".thb-mini-cart-icon", function() {
					if( thb_cart_over === false ) {
						thb_cart_over = true;

						$(this).find('.thb_mini_cart_wrapper').css('display','block');
						setTimeout(function() {
							$('body').addClass("thb-mini-cart-active");
						}, 1);
					}
				})
				.on("mouseleave", ".thb-mini-cart-icon", function() {
					if( thb_cart_over === true ) {
						// $.thb.transition($(this).find('.thb_mini_cart_wrapper'), function( el ) {
							thb_cart_over = false;
							$(this).find('.thb_mini_cart_wrapper').css('display', 'none');
						// });

						$('body').removeClass("thb-mini-cart-active");
					}
				});
		}
	}, false);

	$(document).ready(function() {

		$('.thb-product-image-wrapper .product_type_simple.add_to_cart_button, .thb-product-image-wrapper .product_type_subscription.add_to_cart_button').on('click', function() {
			var button = $(this),
				added_text = button.attr("data-added_text"),
				add_to_cart_text = button.attr("data-add-to");

			button.addClass("product-added");
			button.text(added_text);

			$("body").removeClass('thb-woocommerce-cartempty');

			setTimeout( function() {
				button.text(add_to_cart_text);
				button.removeClass("product-added");
			}, 2500);
		});

	});

})(jQuery);
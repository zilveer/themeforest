var add_to_cart_button;

(function($){
	"use strict";
	var supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );
	if (supports_html5_storage) { sessionStorage.clear(); }

	$(document).ready(function(){
		var wooInitDropkick = function() {
			if($('body').hasClass('single-product')) {
				if ($('.ul-dropdown-toggle').length>0)
					$('.ul-dropdown-toggle').dropdown();
				if ($('.variations .value select').length>0)
					$('.variations .value select').dropkick({mobile: true});
			}
			if($('body.woocommerce-cart .cart-wrap .shipping select').length > 0)
				$('body.woocommerce-cart .cart-wrap .shipping select').dropkick();
		};
		if(!$('html').hasClass('dfd-ie-detected')) {
			wooInitDropkick();
			$('.cart-collaterals > .cover').observeDOM(function() {
				wooInitDropkick();
			});
			$('.variations .value select').observeDOM(function() {
				if ($('.variations .value select').length>0)
					$('.variations .value select').dropkick('refresh');
			});

			$('.variations_form').on('click touchend', '.dfd-reset-vars', function(e) {
				$('table.variations select').dropkick('reset', true);
			});
		}
		
		$('body').on('adding_to_cart', function(trigger, button) {
			add_to_cart_button = button;
		});
		
		$('body').on('added_to_cart', function (trigger) {
			if (add_to_cart_button != undefined) {
				var $woo_entry_thumb = $(add_to_cart_button).parents('li.product').find('div.woo-entry-thumb');
				var $added_to_cart_notice = $('<div class="added-to-cart-notice moon-checkmark">Added to cart</div>');
				
				if ($woo_entry_thumb.length > 0) {
					$woo_entry_thumb.append($added_to_cart_notice);
					$added_to_cart_notice.stop().animate({opacity: 1}, 800).delay( 1800 ).animate({opacity: 0}, 800, function() {$(this).remove()});
				}
				add_to_cart_button = null;
			}
		});
				
		/* Plus-minus buttons customization */
		$('.single_add_to_cart_button_wrap .quantity, .shop_table .quantity').each(function(){
			var inputNumber, min, max, $self = $(this);
			if($self.length > 0) {
				$self.prepend('<i class="dfd-icon-down_2 minus">').append('<i class="dfd-icon-up_2 plus">');
				$self.find('.minus').unbind('click').bind('click touchend', function() {
					inputNumber = $(this).siblings('.qty');
					min = inputNumber.attr('min');
					max = inputNumber.attr('max');
					var beforeVal = +inputNumber.val();
					var newVal = (beforeVal > min || !min) ? +beforeVal - 1 : min;
					inputNumber.val(newVal);
					$(this).parent().siblings('.single_add_to_cart_button').attr('data-quantity', newVal);
				});
				$self.find('.plus').unbind('click').bind('click touchend', function() {
					inputNumber = $(this).siblings('.qty');
					min = inputNumber.attr('min');
					max = inputNumber.attr('max');
					var beforeVal = +inputNumber.val();
					var newVal = (beforeVal < max || !max) ? +beforeVal + 1 : max;
					inputNumber.val(newVal);
					$(this).parent().siblings('.single_add_to_cart_button').attr('data-quantity', newVal);
				});
			}
			$self.find('.qty').on('input propertychange',function() {
				$('.single_add_to_cart_button').attr('data-quantity', $(this).val());
			});
			if($('.wcmp-quick-view-wrapper').length > 0)
				$('.wcmp-quick-view-wrapper form.cart .single_add_to_cart_button').removeClass('product_type_simple');
		});
	});
	
	var products_li_eq_height = function() {
		jQuery('.products.row').each(function() {
			$(this).find('.product').equalHeights();
		});
	};
	$(document).ready(products_li_eq_height);
	$(window).on('load resize', products_li_eq_height);
	
})(jQuery);

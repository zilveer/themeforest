var $j = jQuery.noConflict();

jQuery(document).ready(function(){
	"use strict";

		wbc_add_to_cart();

		$j('.quantity input[type=number]').each(function(){
			var el = $j(this);

			el.attr('type', 'text');

			$j('<input type="button" class="minus" title="Minus" value="-">').insertBefore(el);
			$j('<input type="button" class="plus" title="Plus" value="+">').insertAfter(el);


		});

		$j('.minus').on('click',function(){
			var parent = $j(this).parents('.quantity'),
			el         = parent.find('.input-text.qty'),
			cur_num    = el.val()
			_minus     = ((parseInt(cur_num, 10) - 1) > 0) ? (parseInt(cur_num, 10) - 1) : 1 ;
			
			el.val(_minus);
		});

		$j('.plus').on('click',function(){
			var parent = $j(this).parents('.quantity'),
			el         = parent.find('.input-text.qty'),
			cur_num    = el.val()
			_plus      = parseInt(cur_num, 10) + 1 ;
			
			el.val(_plus);
		});


});


function wbc_add_to_cart(){
	"use strict";

	$j('body').on('click','.add_to_cart_button', function(){
		var parent = $j(this).parents('.product:eq(0)'),
		img_wrap = parent.find('.wbc-shop-image-wrapper');

		parent.addClass('loading-cart').removeClass('loaded-cart');

		img_wrap.find('.wbc-cart-animation').html('').append('<i class="fa fa-spin fa-spinner"></i>');
	});

	$j('body').bind('added_to_cart', function(){
		var parent = $j('.product.loading-cart'),
		img_wrap = parent.find('.wbc-shop-image-wrapper');

		parent.removeClass('loading-cart').addClass('loaded-cart');

		img_wrap.find('.wbc-cart-animation').html('').append('<i class="fa fa-check"></i>');
	});

}
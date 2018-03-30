jQuery(document).ready(function($) {
	
	jQuery('body').on('click', '.add_to_cart_button', function() {
		jQuery(this).parents('.product:eq(0)').addClass('woocommerce_adding_loading').removeClass('woocommerce_added_check');
		jQuery('.nav-button.nav-cart').parent().find('.cart_wrapper_empty').removeClass("cart_wrapper_empty");
		var nel = jQuery('.nav-button.nav-cart').find('.numofitems');
		var num = nel.data('num');
		nel.text(num+1);
		nel.data('num', num+1);
	})
	
	jQuery('body').bind('added_to_cart', function() {
		jQuery('.woocommerce_adding_loading').removeClass('woocommerce_adding_loading').addClass('woocommerce_added_check');
	});
	
	/* Prettyephoto */
	
	(function($) {
		$(function() {
			$("a.zoom").prettyPhoto({
				hook: 'data-rel',
				social_tools: false,
				horizontal_padding: 20,
				opacity: 0.8,
				deeplinking: false
			});
			$("a[data-rel^='prettyPhoto']").prettyPhoto({
				hook: 'data-rel',
				social_tools: false,
				horizontal_padding: 20,
				opacity: 0.8,
				deeplinking: false
			});
		});
	})(jQuery);
});
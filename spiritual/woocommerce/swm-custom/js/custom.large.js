(function ($) {	$(document).ready(function() {


	$('.swm-woo-sort-order .sortBy .current-select a').html($('.swm-woo-sort-order .sortBy ul li.current a').html());
	$('.swm-woo-sort-order .sort-count .current-select a').html($('.swm-woo-sort-order .sort-count ul li.current a').html());	

	jQuery('a.add_to_cart_button').click(function(e) {
		var link = this;
		jQuery(link).parents('.swm-featured-product-block').find('.cart-loading').find('i').removeClass('fa-check').addClass('fa-spinner');
		jQuery(this).parents('.swm-featured-product-block').find('.cart-loading').fadeIn();
		setTimeout(function(){			
			jQuery(link).parents('.swm-featured-product-block').find('.cart-loading').find('i').hide().removeClass('fa-spinner').addClass('fa-check').fadeIn();			
		}, 2000);
	});

	$('li.product').mouseenter(function() {
		if($(this).find('.cart-loading').find('i').hasClass('fa-check')) {
			$(this).find('.cart-loading').fadeIn();
		}
	}).mouseleave(function() {
		if($(this).find('.cart-loading').find('i').hasClass('fa-check')) {
			$(this).find('.cart-loading').fadeOut();
		}
	});

	// Replace woocommerce button with theme button
	var woo_btn_selectors = '.add_review a.show_review_form.button,button.single_add_to_cart_button.button.alt,form.shipping_calculator p button.button,td.actions input.button,a.added_to_cart,#respond input[type="submit"],form.checkout_coupon input[type="submit"],#payment input[type="submit"]';
	var woo_btn_selectors_tiny = '.woocommerce-message a.button,.price_slider_amount button,table.my_account_orders tbody tr td a.button';

	$(woo_btn_selectors).addClass('swm_button round small shadow_dark skin_color swm_woo_btn');		
	$(woo_btn_selectors_tiny).addClass('swm_button round tiny shadow_dark skin_color');
	

	// Lightbox
	$("a.zoom","a[rel^='prettyPhoto']").prettyPhoto({
		hook:'data-rel',social_tools:'',theme: 'pp_default',slideshow: 5000, deeplinking: false, overlay_gallery:false		
	});
	
	$("a[rel^='prettyPhoto']").prettyPhoto({
		hook:'data-rel',social_tools:'',slideshow: 5000, deeplinking: false, overlay_gallery:false		
	});		

	$(function() {

		var ajax_cart 	= $('.main_hover_cart_menu'),
			empty 		= ajax_cart.find('.empty');

		if(empty.length) {
			ajax_cart.hide();  /* remove this line to display cart if product is not added in the cart */
		} else {			
			$('.swm_woo_cart_hover_menu').stop().fadeOut();			
		}		

		jQuery('body').on('click','.add_to_cart_button', function() {
			ajax_cart.show();
			$('.swm_woo_cart_hover_menu').stop().fadeOut();			
		});		
		
	    $('.main_hover_cart_menu').hover(function() {
	        $('.swm_woo_cart_hover_menu').stop().css('opacity','1').fadeIn('normal');
	     		},
	      	function(){
	        	$('.swm_woo_cart_hover_menu').stop().css('opacity','0').fadeOut('fast');
	      	}
		);

	});


}); })(jQuery);




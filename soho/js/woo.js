// Woocommerce Price Filter
if (jQuery('.price_slider_wrapper').size() > 0) {
	setInterval(function woopricefilter() {
		"use strict";
		var price_from = jQuery('.price_slider_amount').find('span.from').text();
		var price_to = jQuery('.price_slider_amount').find('span.to').text();
		
		jQuery('.price_slider').find('.ui-slider-handle').first().attr('data-width', price_from);
		jQuery('.price_slider').find('.ui-slider-handle').last().attr('data-width-r', price_to);
		
	}, 100);
}

jQuery(document).ready(function(){
	"use strict";	
	if (jQuery('.woocommerce_container').size() > 0) {
		var p_title = jQuery('.woocommerce_container').find('h1.page-title').html();
		if (jQuery('.summary').size() > 0) {		
		} else {
			jQuery('.page_title_block h1.title').empty();
			jQuery('.page_title_block h1.title').append(p_title);
		}					
	}		
	
	// Thumbs Hover	
	jQuery('.woocommerce ul.products li.product, .woocommerce .images .woocommerce-main-image').each(function(){								
		jQuery(this).find("img").wrapAll('<div class="woo_hover_img"></div>');
		jQuery(this).find('.woo_hover_img').append('<span class="featured_items_ico"></span>');								
	});
		 
	// Single Product Meta
	if (jQuery('.summary .product_meta').size() > 0) {
		var product_sku = jQuery('.summary .product_meta').find('.sku_wrapper').html();
		jQuery('.summary .product_meta').find('.posted_in').after('<span class="product_sku">'+product_sku+'</span>');		
	}
	
	// Cart-collaterals	
	if (jQuery('.cart-collaterals').size() > 0) {
		var cart_calc = jQuery('.cart-collaterals').find('.woocommerce-shipping-calculator').parent().html();
		if(typeof cart_calc !== 'undefined') {
			jQuery('.cart-collaterals .order-total').before('<tr><td class="fake_calc" colspan="2">'+cart_calc+'<div class="clea_r"></div></td></div>');										
		}
	}	
});

jQuery(window).load(function(){
	"use strict";
	// Woocommerce
	jQuery(".woocommerce-page .widget_price_filter .price_slider").wrap("<div class='price_filter_wrap'></div>");	
	jQuery("#tab-additional_information .shop_attributes").wrap("<div class='additional_info'></div>");	
	jQuery(".shop_table.cart").wrap("<div class='woo_shop_cart'></div>");	
});

/* Woocommerce */

// Calculation add to cart button 
function addcartbtnHeight() {
	jQuery('.woocommerce ul.products li.product').each(function(){								
		var this_img_height = jQuery(this).find("a img").height();		
		jQuery(this).find("a.add_to_cart_button, a.product_type_variable, a.product_type_grouped, a.product_type_external").css({'top':this_img_height/2});						
	});
}

// Add img wrap end shadow
function addimgShadow() {
	jQuery('.woocommerce ul.products li.product').each(function(){								
		jQuery(this).find("a img").wrap("<div class='img_shadow_block'></div>");	
		jQuery(this).find(".img_shadow_block").append("<span class='img_shadow'></span>");				
	});
}

jQuery(document).ready(function(){	
	jQuery('.woocommerce_container').find('.commentlist').find('img.avatar').each(function(){
		jQuery(this).wrap('<div class="commentava"/>');
	});	
	addimgShadow();
});

jQuery(window).load(function(){
	addcartbtnHeight();	
});

jQuery(window).resize(function(){
	addcartbtnHeight();	
});


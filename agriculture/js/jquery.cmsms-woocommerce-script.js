/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Woocommerce Scripts
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function() {
	
	setTimeout(function() {
		if (
			jQuery('.cmsms_dynamic_cart .widget_shopping_cart_content > ul li').length != 0 && 
			jQuery('.cmsms_dynamic_cart .widget_shopping_cart_content > ul li').hasClass('empty') != true
		) {
			jQuery('.cmsms_dynamic_cart').css('opacity', 1);
		}
	}, 2000);
	
	
	cmsms_ajax_add_to_cart();
	
	jQuery('.cmsms_add_to_cart_button').bind('click', function() {
		jQuery('.cmsms_dynamic_cart').css('opacity', 1);
	});
	
	
	jQuery('body').bind('added_to_cart', update_dynamic_cart);
	
} );

function update_dynamic_cart(event) {
	var product = jQuery.extend({name:"Product", image:""}, cmsms_added_product);


	if (typeof event != 'undefined') {
		var template = jQuery(
				'<div class="cmsms_product_info">' + 
					product.image + 
					'<span class="cmsms_product_info_text">' + product.name + '</span>' + 
				'</div>'
			);
			
		template.appendTo('.cmsms_dynamic_cart').animate({opacity:1}, 500);
		
		template.bind('mouseenter cmsms_hide', function() {
			template.animate({opacity:0, marginLeft:0}, 500, function() {
				template.remove();
			});
		});
		
		setTimeout(function() {
			template.trigger('cmsms_hide');
		}, 2000);
	}
}

var cmsms_added_product = {};

function cmsms_ajax_add_to_cart() {
	jQuery('.cmsms_add_to_cart_button').bind('click', function() {	
		var productInfo = jQuery(this).parents('.product').eq(0), 
			product = {};
			
		product.name = productInfo.find('.entry-title a').text();
		product.image = productInfo.find('figure img');
			
		if (product.image.length) {
			/* Dynamic Cart Update Img Src */
			var str = product.image.get(0).src, 
				ext = /(\..{3,4})$/i.exec(str), 
				extLength = ext[1].length, 
				url = str.slice(0, -extLength), 
				newURL = /(-\d{2,}x\d{2,})$/i.exec(url), 
				newSize = '-50x50', 
				buildURL = '';


			if (newURL !== null) {
				buildURL += url.slice(0, -newURL[1].length) + newSize + ext[1];
			} else {
				buildURL += url + newSize + ext[1];
			}
			
			product.image = '<img class="cmsms_product_info_img" src="' + buildURL + '" />';
		}
			
		cmsms_added_product = product;
	});
}


jQuery(document).ready(function() {
	(function ($) {
		$('.touch .product .product_inner figure').bind('click', function() {
			$('*:not(this)').removeClass('cmsms_mobile_hover');
			$(this).addClass('cmsms_mobile_hover');
		});
	} )(jQuery);
} );
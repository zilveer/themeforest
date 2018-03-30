<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.6
 * 
 * Website Woocommerce Functions
 * Created by CMSMasters
 * 
 */


/* Woocommerce Dynamic Cart */

function cmsms_woocommerce_cart_dropdown() {
	global $woocommerce; 
	
	$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
	$link = $woocommerce->cart->get_cart_url();

	
	$output = '';
	$output .= '<div class="cmsms_dynamic_cart">' .  
		'<a href="javascript:void(0);" class="cmsms_dynamic_cart_button"></a>' . 
		'<div class="widget_shopping_cart_content"></div>' . 
	'</div>';

	echo $output;
}


/* Woocommerce Add to Cart Button */

function cmsms_woocommerce_add_to_cart_button() {
	global $product;
	
	if ($product->is_purchasable() && $product->product_type == 'simple' && $product->is_in_stock()) {
		echo '<a href="' . esc_url($product->add_to_cart_url()) . '" data-product_id="' . esc_attr($product->id) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="add_to_cart_button cmsms_add_to_cart_button product_type_simple ajax_add_to_cart">' . __('To Cart', 'cmsmasters') . '</a>';
	}
	
	echo '<a href="' . get_permalink($product->id) . '" data-product_id="' . esc_attr($product->id) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="cmsms_details_button">' . __('Details', 'cmsmasters') . '</a>';
}


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<div class="cmsms_wrap_basket">
		<a class="cmsms_cart_items cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a>
		<?php echo $woocommerce->cart->get_cart_total(); ?>
	</div>
	<?php
	
	$fragments['div.cmsms_wrap_basket'] = ob_get_clean();
	
	return $fragments;
	
}


add_theme_support('woocommerce');


if (version_compare(WOOCOMMERCE_VERSION, '2.1') >= 0) {
	add_filter('woocommerce_enqueue_styles', '__return_false');
} else {
	define('WOOCOMMERCE_USE_CSS', false);
}


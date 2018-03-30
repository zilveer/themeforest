<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.0.0
 * 
 * Website WooCommerce Functions
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
		'<a href="javascript:void(0);" class="cmsms_dynamic_cart_button cmsms-icon-basket"></a>' . 
		'<div class="widget_shopping_cart_content"></div>' . 
	'</div>';

	echo $output;
}


/* Woocommerce Add to Cart Button */

function cmsms_woocommerce_add_to_cart_button() {
	global $product;
	
	
	if (
		$product->is_purchasable() && 
		$product->product_type == 'simple' && 
		$product->is_in_stock()
	) {
		echo '<a href="' . esc_url($product->add_to_cart_url()) . '" data-product_id="' . esc_attr($product->id) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="add_to_cart_button cmsms_add_to_cart_button product_type_simple cmsms-icon-basket">' . __('Add to Cart', 'cmsmasters') . '</a>';
	}
	
	echo '<a href="' . get_permalink($product->id) . '" data-product_id="' . esc_attr($product->id) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="cmsms_details_button cmsms-icon-menu">' . __('Show Details', 'cmsmasters') . '</a>';
}


/* Woocommerce Rating */

function cmsms_woocommerce_rating($icon_trans = '', $icon_color = '', $in_review = false, $comment_id = '', $show = true) {
	global $product;
	
	
	if (get_option( 'woocommerce_enable_review_rating') === 'no') {
		return;
	}
	
	
	$rating = (($in_review) ? intval(get_comment_meta($comment_id, 'rating', true)) : ($product->get_average_rating() ? $product->get_average_rating() : '0'));
	
	$itemprop = $in_review ? 'reviewRating' : 'aggregateRating';
	
	$itemtype = $in_review ? 'Rating' : 'AggregateRating';
	
	
	$out = "
<div class=\"cmsms_star_rating\" itemprop=\"{$itemprop}\" itemscope itemtype=\"http://schema.org/{$itemtype}\" title=\"" . sprintf(__('Rated %s out of 5', 'cmsmasters'), $rating) . "\">
<div class=\"cmsms_star_trans_wrap\">
	<span class=\"{$icon_trans} cmsms_star\"></span>
	<span class=\"{$icon_trans} cmsms_star\"></span>
	<span class=\"{$icon_trans} cmsms_star\"></span>
	<span class=\"{$icon_trans} cmsms_star\"></span>
	<span class=\"{$icon_trans} cmsms_star\"></span>
</div>
<div class=\"cmsms_star_color_wrap\" style=\"width:" . (($rating / 5) * 100) . "%\">
	<div class=\"cmsms_star_color_inner\">
		<span class=\"{$icon_color} cmsms_star\"></span>
		<span class=\"{$icon_color} cmsms_star\"></span>
		<span class=\"{$icon_color} cmsms_star\"></span>
		<span class=\"{$icon_color} cmsms_star\"></span>
		<span class=\"{$icon_color} cmsms_star\"></span>
	</div>
</div>
<span class=\"rating dn\"><strong itemprop=\"ratingValue\">" . esc_html($rating) . "</strong> " . __('out of 5', 'cmsmasters') . "</span>
</div>
";
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}


add_theme_support( 'woocommerce' );


<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if(isset($class) && !empty($class)) {
	$class = str_replace('button', '', $class);
	$class = str_replace('add_to_cart_', 'add_to_cart_button', $class);
} else {
	$class = 'add_to_cart_button';
}

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( $class ),
		'<span class="cover"><span class="front"><i class="dfd-icon-trolley_input"></i><span>'.esc_html( $product->add_to_cart_text() ).'</span></span><span class="back"><i class="dfd-icon-trolley_input"></i><span>'.esc_html( $product->add_to_cart_text() ).'</span></span></span>'
	),
$product );

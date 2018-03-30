<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="btn button %s product_type_%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr__( $product->id ),
		esc_attr__( $product->get_sku() ),
		esc_attr__( isset( $quantity ) ? $quantity : 1 ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr__( $product->product_type ),
		esc_html__( $product->add_to_cart_text() )
	),
$product );
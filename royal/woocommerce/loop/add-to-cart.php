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

$class = '';
$html = '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn border-grey %s product_type_%s"><i class="ico-smallpacket"></i> %s</a>';

if(etheme_get_option('ajax_addtocart') && $product->is_purchasable() && $product->is_in_stock() > 0 && $product->product_type == 'simple') {
	$class .= 'etheme_add_to_cart_button ';
	$html = '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn border-grey progress-button %s product_type_%s" data-style="shrink" data-horizontal><i class="ico-smallpacket"></i> %s</a>';
}

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( $html,
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		$class,
		esc_attr( $product->product_type ),
		esc_html( $product->add_to_cart_text() )
	),
$product );
<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

switch ( $product->product_type ) {
	case "variable" :
		$icon_class = 'mk-icon-plus';
		break;
	case "grouped" :
		$icon_class = 'mk-moon-search-3';
		break;
	case "external" :
		$icon_class = 'mk-moon-search-3';
		break;
	default :
		$icon_class = 'mk-moon-cart-plus';
		break;
}

if(!$product->is_purchasable() || !$product->is_in_stock()) {
	$icon_class = 'mk-moon-search-3';
}

$button_class = implode( ' ', array(
					'product_loop_button',
					'product_type_' . $product->product_type,
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
			) );


echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $quantity ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( $button_class ),
		Mk_SVG_Icons::get_svg_icon_by_class_name(false,$icon_class,16),
		esc_html( $product->add_to_cart_text() )
	),
$product );

<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

// echo apply_filters('woocommerce_loop_add_to_cart_link',
// 	sprintf( '<div class="shop-button add-to-cart-button-outer"><div class="add-to-cart-button-inner"><div class=""><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="add-to-cart-button button %s product_type_%s btn btn-dark-o btn-sm"><i class="icon-basket"></i>%s</a></div></div></div>',
// 	esc_url( $product->add_to_cart_url() ),
// 	esc_attr( $product->id ),
// 	esc_attr( $product->get_sku() ),
// 	$product->is_purchasable() ? 'add_to_cart_button' : '',
// 	esc_attr( $product->product_type ),
// 	esc_html( $product->add_to_cart_text() )
// 	),
// $product);
;?><div class="shop-button add-to-cart-button-outer"><div class="add-to-cart-button-inner">
<?php 
echo apply_filters( 'woocommerce_loop_add_to_cart_link',

	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" data-added="%s" class="%s add-to-cart-button button btn btn-dark-o btn-sm">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		__('Added to cart', 'BERG'),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_html( $product->add_to_cart_text() )
	),
$product );
?>
</div></div>
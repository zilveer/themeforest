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

global $product, $mango_shop_page_settings;
$classes = array();
if($mango_shop_page_settings['mango_shop_view']=='list'){
    $classes= "list-btn list-btn-add";
    $button_text = esc_html( $product->add_to_cart_text() );
}else{
    $button_text = '<i class="fa fa-shopping-cart"></i><span class="add_cart_loading"><i class=" fa fa-spinner"></i></span>';
    if($mango_shop_page_settings['grid_ver']!='v_3'){
        $classes = 'product-btn product-add-btn';
        $button_text .= esc_html($product->add_to_cart_text());
    }else {
        $classes = 'product-btn btn-icon dark';
    }
}

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s '.$classes.' " title="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
        esc_html($product->add_to_cart_text()),
		$button_text
	),
$product );
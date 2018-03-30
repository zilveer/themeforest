<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

if ( ! $product->is_in_stock() ) return;

$is_active         = get_post_meta( $product->id, '_active_custom_onsale', true );
$preset            = get_post_meta( $product->id, '_preset_onsale_icon', true );
$img               = get_post_meta( $product->id, '_custom_onsale_icon', true );
$regular_price     = get_post_meta( $product->id, '_regular_price', true );
$regular_price_var = get_post_meta( $product->id, '_min_variation_price', true );

$onsale_html = '';

// set a preset image
if ( $is_active == 'yes' && $preset != 'custom' ) {
    $onsale_html = '<span class="onsale preset">' . $preset . '</span>';
}
elseif( $is_active == 'yes' && ! empty( $img ) ) {
    $onsale_html = yit_image( "src=$img&getimagesize=1&class=onsale custom" , false );
}
elseif ( $product->is_on_sale() && ( ! empty( $regular_price ) || ! empty( $regular_price_var ) ) ) {
    $onsale_html =  '<span class="onsale">' . yit_get_option( 'shop-sale-text' ) . '</span>';
}

echo apply_filters( 'woocommerce_sale_flash', $onsale_html, $post, $product );
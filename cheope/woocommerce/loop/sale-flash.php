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

$regular_price = get_post_meta( $product->id, '_regular_price', true );
$regular_price_var = get_post_meta( $product->id, '_min_variation_price', true );

if( $product->is_on_sale() && ( !empty( $regular_price ) || !empty( $regular_price_var ) ) ) :
    echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'. yit_get_option('shop-sale-label') . '</span>', $post, $product);
endif;
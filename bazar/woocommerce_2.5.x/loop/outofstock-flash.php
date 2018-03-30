<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
global $product;                               

if ( $product->is_in_stock() ) return;

$img = apply_filters( 'yit_custom_out_of_stock_badge', get_stylesheet_directory_uri() . '/woocommerce/images/bullets/out-of-stock.png' );

yit_image( "src=$img&getimagesize=1&class=onsale out-of-stock&alt=" . apply_filters( 'yit_outofstock_text_badge', __( 'Out of Stock!', 'yit' ) ) );
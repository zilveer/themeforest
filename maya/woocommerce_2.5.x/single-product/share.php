<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


if ( yiw_get_option( 'shop_show_share_socials' ) ) :
    echo do_shortcode( '[share title="' . yiw_get_option( 'shop_share_title' ) . '" socials="' . yiw_get_option( 'shop_share_socials' ) . '"]' );
endif;


do_action( 'woocommerce_share' ); // Sharing plugins can hook into here
?>
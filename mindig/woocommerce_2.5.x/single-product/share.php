<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

if ( ! isset( $woocommerce_loop ) && yit_get_option('shop-single-share') == 'yes' ) {

    echo '<div class="product-share"><span>'. __( "Share on: ","yit"). '</span>';
       yit_get_social_share( 'text' );
    echo '</div><div class="clearfix"></div>';
}

do_action('woocommerce_share'); // Sharing plugins can hook into here

?>
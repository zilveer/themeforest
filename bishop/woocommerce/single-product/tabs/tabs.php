<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

$dir = yit_get_option( 'shop-products-tab-layout', 'vertical' );

if ( ! empty( $tabs ) ) :

    if(function_exists('woocommerce_get_template'))  {
        woocommerce_get_template( 'single-product/tabs/tabs-' . $dir . '.php', array( 'tabs' => $tabs, 'dir' => $dir ) );
    } else {
        wc_get_template( 'single-product/tabs/tabs-' . $dir . '.php', array( 'tabs' => $tabs, 'dir' => $dir ) );
    }

endif;
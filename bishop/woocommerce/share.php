<?php
/**
 * Share template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 1.1.2
 */

global $yith_wcwl;

global $yith_wcwl;

if( isset( $yith_wcwl ) && function_exists( 'YITH_WCWL' ) ){
    if( function_exists( 'wc_get_template_part' ) ){
        wc_get_template( 'wishlist/share.php', get_defined_vars() );
    }
    else{
        woocommerce_get_template( 'wishlist/share.php', get_defined_vars() );
    }
}
else{
    if( function_exists( 'wc_get_template_part' ) ){
        wc_get_template( 'wishlist_1.1.x/share.php', get_defined_vars() );
    }
    else{
        woocommerce_get_template( 'wishlist_1.1.x/share.php', get_defined_vars() );
    }
}

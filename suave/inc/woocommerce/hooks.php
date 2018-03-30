<?php
/**
 * Suave WooCommerce hooks
 *
 * @package suave
 */

// Remove Cross Sells From Default Position 
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

// Add them back under the Cart
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
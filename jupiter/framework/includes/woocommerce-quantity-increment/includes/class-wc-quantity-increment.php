<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WooCommerce_Quantity_Increment_Init {

    function __construct() {
 
    	add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    }

    public function enqueue_scripts() {

        $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    	wp_register_script( 'wcqi-js', THEME_INCLUDES_URI . '/woocommerce-quantity-increment/assets/js/wc-quantity-increment' . $min . '.js', array( 'jquery' ) );
    	wp_register_script( 'wcqi-number-polyfill', THEME_INCLUDES_URI . '/woocommerce-quantity-increment/assets/js/lib/number-polyfill.min.js' );

    	wp_enqueue_script( 'wcqi-js' );
    	wp_enqueue_style( 'wcqi-css' );

        wp_enqueue_script( 'wcqi-number-polyfill' );

    }

}

new WooCommerce_Quantity_Increment_Init;
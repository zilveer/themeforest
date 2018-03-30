<?php

add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

include_once (SWM_WOO . 'swm-custom/woo-admin-options.php');
include_once (SWM_WOO . 'swm-custom/woo-functions.php');

//remove woocommerce libhtbox scripts and styles
add_action( 'admin_enqueue_scripts', 'swm_deregister_woo_scripts', 100 );
if(!function_exists('swm_deregister_woo_scripts')) {
	function swm_deregister_woo_scripts() {
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );	
	}
}
add_action( 'admin_enqueue_scripts', 'swm_deregister_woo_styles', 100 );
if(!function_exists('swm_deregister_woo_styles')) {
	function swm_deregister_woo_styles() {
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	}
}
<?php
/**
 * This file contains WooCommerce related functions
 */

/*-----------------------------------------------------------------------------------*/
/* Add WooCommerce Support
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'inspiry_woocommerce_support' ) ){
    function inspiry_woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }
    add_action( 'after_setup_theme', 'inspiry_woocommerce_support' );
}


/*-----------------------------------------------------------------------------------*/
/*	Modify WooCommerce Shop Columns
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'inspiry_loop_shop_columns' ) ){
    function inspiry_loop_shop_columns( $columns ) {
        $columns = 3;
        return $columns;
    }
    add_filter( 'loop_shop_columns', 'inspiry_loop_shop_columns' );
}

/*-----------------------------------------------------------------------------------*/
//	Un-Register default WooCommerce hooks
/*-----------------------------------------------------------------------------------*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );




?>
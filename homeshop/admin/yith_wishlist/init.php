<?php
/**
* Plugin Name: YITH WooCommerce Wishlist
* Plugin URI: http://yithemes.com/
* Description: Woocommerce Wishlist Plugin
* Version: 1.0.0
* Author: Your Inspiration Themes
* Author URI: http://yithemes.com/
* Text Domain: yith-wcwl
* Domain Path: /languages/
* 
* @author Your Inspiration Themes
* @package YITH WooCommerce Wishlist
* @version 1.0.0
*/

if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

define( 'YITH_WCWL', true );

if ( ! function_exists('is_plugin_active') ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if( is_plugin_active('yith_wishlist/init.php') ) {
    define( 'YITH_WCWL_URL', plugin_dir_url( __FILE__ ) );
    define( 'YITH_WCWL_DIR', plugin_dir_path( __FILE__ ) );
} else {
    if( !defined( 'YIT_THEME_PLUGINS_URL' ) ) { define( 'YIT_THEME_PLUGINS_URL', get_template_directory_uri() . '/admin' ); }
    define( 'YITH_WCWL_URL', YIT_THEME_PLUGINS_URL . '/yith_wishlist/' );
    define( 'YITH_WCWL_DIR', dirname( __FILE__ ) . '/' );
}
                                       
if ( !function_exists( 'is_plugin_active' ) ) require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
    // Load required classes and functions
    require_once( 'functions.yith-wcwl.php' );
    require_once( 'class.yith-wcwl.php' );
    require_once( 'class.yith-wcwl-init.php' );
    require_once( 'class.yith-wcwl-install.php' );
    
    if( get_option( 'yith_wcwl_enabled' ) == 'yes' ) {
        require_once( 'class.yith-wcwl-ui.php' );
        require_once( 'class.yith-wcwl-shortcode.php' );
    }
    
    // Let's start the game!
    global $yith_wcwl;
    $yith_wcwl = new YITH_WCWL( $_REQUEST );
}
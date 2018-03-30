<?php
/*
Plugin Name: YIT Shortcodes
Plugin URI: http://www.yourinspirationweb.com
Description: Add yit_shortcode function to wordpress
Text Domain: yit
Domain Path: /languages/
Author: YIThemes
Version: 1.1.6
Author URI: http://www.yithemes.com

 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * YIT_Shortcode version
 */
define('YIT_SHORTCODE_VERSION', '1.1.6');


// load the core plugins library from an yit-theme
add_action( 'after_setup_theme', 'yit_shortcodes_loader', 1 );
add_action( 'plugins_loaded', 'yit_shortcodes_load_text_domain' );


/**
 * Load the plugin text domain for localization
 *
 * @return void
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
 */
function yit_shortcodes_load_text_domain(){
    load_plugin_textdomain( 'yit', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );
}


/**
 * Load the core of the plugin, added to "after_theme_setup" so you can load the core only if it isn't loaded by plugin
 *
 * @return void
 * @since  1.0
 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
 * @author Andrea Grillo   <andrea.grillo@yithemes.com>
 */
function yit_shortcodes_loader() {
    if( defined( 'YIT_FREE' ) && YIT_FREE ){
        deactivate_plugins( plugin_basename( __FILE__ ) );
        return;
    }

    if( yit_check_plugin_support() ) {
        require_once 'yit-shortcodes.php';
    }
}
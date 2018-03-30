<?php
/*
Plugin Name: YIT Logos
Plugin URI: http://www.yourinspirationweb.com
Description: Add logos custom post type and logos shortcode to wordpress
Text Domain: yit
Domain Path: /languages/
Author: YIThemes
Version: 1.0.5
Author URI: http://www.yithemes.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * YIT Logos Version
 */
define('YIT_LOGOS_VERSION', '1.0.5');

// load the core plugins library from an yit-theme
add_action( 'after_setup_theme', 'yit_logos_loader', 1 );
add_action( 'plugins_loaded', 'yit_logos_load_text_domain' );


/**
 * Load the plugin text domain for localization
 *
 * @return void
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
 */
function yit_logos_load_text_domain(){
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
function yit_logos_loader() {
    if( yit_check_plugin_support() ) {
        require_once 'yit-logos.php';
    }
}
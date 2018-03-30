<?php
/*
Plugin Name: YIT Google Analytics
Plugin URI: http://www.yourinspirationweb.com
Description: Add Google Analytics feature on the site
Text Domain: yit
Domain Path: /languages/
Author: YIThemes
Version: 1.0.0
Author URI: http://yithemes.com/
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Yit Sidebar Version
 */
define( 'YIT_GA_VERSION', '1.0.0' );

// load the core plugins library from an yit-theme
add_action( 'after_setup_theme', 'yit_ga_loader', 1 );
add_action( 'plugins_loaded', 'yit_ga_load_text_domain' );


/**
 * Load the plugin text domain for localization
 *
 * @return void
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
 */
function yit_ga_load_text_domain(){
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
function yit_ga_loader() {
    if( yit_check_plugin_support() ) {
        require_once 'yit-google-analytics.php';
    }
}
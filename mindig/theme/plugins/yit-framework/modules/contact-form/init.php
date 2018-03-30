<?php
/*
Plugin Name: YIT Contact Form
Plugin URI: http://www.yourinspirationweb.com
Description: YIT plugin for add Contact Form
Author: YIThemes
Text Domain: yit
Domain Path: /languages/
Version: 1.0.9
Author URI: http://www.yithemes.com
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * YIT CONTACT FORM VERSION
 */
define( 'YIT_CONTACT_FORM_VERSION', '1.0.9' );

if ( ! defined( 'YITH_YCF_DIR' ) ) {
    define( 'YITH_YCF_DIR', plugin_dir_path( __FILE__ ) );
}

// load the core plugins library from an yit-theme
add_action( 'after_setup_theme', 'yit_contactform_loader', 1 );
add_action( 'plugins_loaded', 'yit_contactform_load_text_domain' );

// Load required classes and functions
require_once( 'functions.yit-contact-form.php' );
require_once( YITH_YCF_DIR . 'lib/recaptcha/src/autoload.php' );


/**
 * Load the plugin text domain for localization
 *
 * @return void
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
 */
function yit_contactform_load_text_domain(){
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
function yit_contactform_loader() {
    if( yit_check_plugin_support() ) {
        require_once 'yit-contact-form.php';
    }

}
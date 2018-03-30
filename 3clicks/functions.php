<?php
/**
 * Functions and definitions.
 *
 * PLEASE DON'T MODIFY THIS FILE.
 * Use the provided child theme for all your modifications.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
	die ( 'No direct script access allowed' );

// Define paths to common folders
define( 'G1_LIB_DIR',    	trailingslashit( get_template_directory() ) .  'lib' );
define( 'G1_LIB_URI',    	trailingslashit( get_template_directory_uri() ) .  'lib' );

define( 'G1_FRAMEWORK_DIR', trailingslashit( get_template_directory() ) . 'g1-framework' );
define( 'G1_FRAMEWORK_URI', trailingslashit( get_template_directory_uri() ) . 'g1-framework' );

/**
 * Enable translation (i18n)
 */
function g1_init_localization_before_theme() {
    $dir = trailingslashit( get_template_directory() );

    if (!load_child_theme_textdomain( 'g1_theme', get_stylesheet_directory().'/languages' )) {
        load_theme_textdomain( 'g1_theme', $dir . 'languages' );
    }

    $locale = get_locale();
    $locale_file = $dir . "languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );
}

g1_init_localization_before_theme();

require_once( G1_FRAMEWORK_DIR . '/g1-framework.php' );

require_once( G1_LIB_DIR . '/theme-dependencies.php' );
require_once( G1_LIB_DIR . '/theme-functions.php' );
require_once( G1_LIB_DIR . '/theme-features.php' );
require_once( G1_LIB_DIR . '/g1-precontent/g1-precontent.php' );
require_once( G1_LIB_DIR . '/g1-sliders/g1-sliders.php' );
require_once( G1_LIB_DIR . '/g1-pages/g1-pages.php' );
require_once( G1_LIB_DIR . '/g1-posts/g1-posts.php' );

// Include plugin.php file so we can use the is_plugin_active() function
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active('woocommerce/woocommerce.php') ) {
    require_once( G1_LIB_DIR . '/g1-woocommerce/g1-woocommerce.php' );
}

if ( is_plugin_active('sfwd-lms/sfwd_lms.php') ) {
    require_once( G1_LIB_DIR . '/g1-learndash/g1-learndash.php' );
}

// WPML check
define( 'G1_WPML_LOADED', is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) );

/* Do you want to disable the Twitter module completely?
 *
 * Just copy the below line to the functions.php file from your child theme:
 * define( 'G1_TWITTER_MODULE', false );
 */
define( 'G1_TWITTER_MODULE', true );
if ( G1_TWITTER_MODULE ) {
    require_once( G1_LIB_DIR . '/g1-twitter/g1-twitter.php' );
}

/* Do you want to disable the GMap module completely?
 *
 * Just copy the below line to the functions.php file from your child theme:
 * define( 'G1_GMAP_MODULE', false );
 */
define( 'G1_GMAP_MODULE', true );
if ( G1_GMAP_MODULE ) {
    require_once( G1_LIB_DIR . '/g1-gmap/g1-gmap.php' );
}

/* Do you want to disable the Mailchimp module completely?
 *
 * Just copy the below line to the functions.php file from your child theme:
 * define( 'G1_MAILCHIMP_MODULE', false );
 */
define( 'G1_MAILCHIMP_MODULE', true );
if ( G1_MAILCHIMP_MODULE ) {
    require_once( G1_LIB_DIR . '/g1-mailchimp/g1-mailchimp.php' );
}

/* Do you want to disable the Maintenance module completely?
 *
 * Just copy the below line to the functions.php file from your child theme:
 * define( 'G1_MAINTENANCE_MODULE', false );
 */
define( 'G1_MAINTENANCE_MODULE', true );
if ( G1_MAINTENANCE_MODULE ) {
    require_once( G1_LIB_DIR . '/g1-maintenance/g1-maintenance.php' );
}

/* Do you want to disable the Contact Form module completely?
 *
 * Just copy the below line to the functions.php file from your child theme:
 * define( 'G1_TWITTER_MODULE', false );
 */
define( 'G1_CONTACT_FORM_MODULE', true );
if ( G1_CONTACT_FORM_MODULE ) {
    require_once( G1_LIB_DIR . '/g1-contact-form/g1-contact-form.php' );
}



/* Do you want to disable the Work module completely?
 *
 * Just copy the below line to the functions.php file from your child theme:
 * define( 'G1_WORKS_MODULE', false );
 */
define( 'G1_WORKS_MODULE', true );
if ( G1_WORKS_MODULE ) {
    require_once( G1_LIB_DIR . '/g1-works/g1-works.php' );
}

/* Do you want to disable the Simple_Slider module completely?
 *
 * Just copy the below line to the functions.php file from your child theme:
 * define( 'G1_SIMPLE_SLIDER_MODULE', false );
 */
define( 'G1_SIMPLE_SLIDERS_MODULE', true );
if ( G1_SIMPLE_SLIDERS_MODULE ) {
    require_once( G1_LIB_DIR . '/g1-simple-sliders/g1-simple-sliders.php' );
}

require_once( G1_LIB_DIR . '/g1-relations/g1-relations.php' );
require_once( G1_LIB_DIR . '/theme-options.php' );
require_once( G1_LIB_DIR . '/theme-fonts.php' );

// Set standard content width
if ( ! isset( $content_width ) ) $content_width = 686;


/* PLEASE
 * Don't add any code below here, use the child theme for all your modifications
 */







add_filter( 'wp_tag_cloud', 'g1_wp_tag_cloud', 10, 2 );
function g1_wp_tag_cloud( $return, $args ) {
    if ( 'flat' === $args['format'] ) {
        $return = '<div class="g1-tagcloud">' . $return . '</div>';
    }

    return $return;
}
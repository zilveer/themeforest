<?php
	
// Theme Updates
require_once('updates/theme-update-checker.php');
$BoxyThemeUpdateChecker = new ThemeUpdateChecker('espresso','http://boxyupdates.com/get/?action=get_metadata&slug=espresso');	

// FontAwesome Version
define('ESPRESSO_FA_VERSION','4.5.0');

// Initial Load
require('_framework/init.php');

// Add theme support for post thumbnails & post formats
require('_theme_settings/add-theme-support.php');

// Register Sidebars
require('_theme_settings/register-sidebars.php');

// Theme related functions
require('_theme_settings/theme-functions.php');

// Theme colors
require('_theme_settings/theme-colors.php');

// Set up custom meta fields
require('_theme_settings/custom-fields/init.php');

// Shortcodes
require('_theme_settings/theme-shortcodes.php');

// WooCommerce
require('_theme_settings/woocommerce.php');

// Option Tree Settings
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );

// Load the styles and assets if on the OT pane
global $pagenow;
if (isset($_GET['page']) && $_GET['page'] != 'ot-theme-options' || !isset($_GET['page'])) {
    function ot_admin_styles() { /* Block the styles from loading anywhere but the admin page */ }
}

load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
load_template( trailingslashit( get_template_directory() ) . '_theme_settings/theme-options.php' );

// Live Composer Compatibility
if ( ! function_exists( 'ot_get_media_post_ID' ) ) {
  function ot_get_media_post_ID() {
    global $wpdb;
    return $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE `post_name` = 'media' AND `post_type` = 'option-tree' AND `post_status` = 'private'" ); 
  }
}

// Widgets
add_action( 'after_setup_theme', 'boxy_widgets' );
function boxy_widgets() {
	require('_theme_settings/widgets/init.php');
}

// Visual Composer Theme Mode
add_action( 'init', 'boxy_vcSetAsTheme' );
function boxy_vcSetAsTheme() {
	if (function_exists('vc_set_as_theme')) : vc_set_as_theme(true); endif;
}

// Slider Revolution Theme Mode
add_action( 'init', 'boxy_revsliderSetAsTheme' );
function boxy_revsliderSetAsTheme() {
	if (function_exists('set_revslider_as_theme')){ set_revslider_as_theme(); }
}


// Envira Gallery License
add_action( 'after_setup_theme', 'tgm_envira_define_license_key' );
function tgm_envira_define_license_key() {
    
    // If the key has not already been defined, define it now.
    if ( ! defined( 'ENVIRA_LICENSE_KEY' ) ) {
        define( 'ENVIRA_LICENSE_KEY', '93b032dcb25f3564ff1814b3fd777efb' );
    }
    
}

// Soliloquy License
add_action( 'after_setup_theme', 'tgm_soliloquy_define_license_key' );
function tgm_soliloquy_define_license_key() {
    
    // If the key has not already been defined, define it now.
    if ( ! defined( 'SOLILOQUY_LICENSE_KEY' ) ) {
        define( 'SOLILOQUY_LICENSE_KEY', '1dff474a33f27e4481a6716f13f77989' );
    }
    
}

/* REQUIRED PLUGINS */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'espresso_register_required_plugins' );

function espresso_register_required_plugins() {

    $plugins = array(
 
        array(
            'name'                  => 'Restaurant Add-Ons (required)',
            'slug'                  => 'espresso-addons',
            'source'                => 'http://boxycdn-plugins.s3.amazonaws.com/espresso-addons.zip',
            'required'              => true
        ),
        
        array(
            'name'                  => 'Restaurant Reservations',
            'slug'                  => 'restaurant-reservations',
            'required'              => false
        ),
        
        array(
            'name'                  => 'The Events Calendar',
            'slug'                  => 'the-events-calendar',
            'required'              => false
        ),
        
        array(
            'name'                  => 'Contact Form 7',
            'slug'                  => 'contact-form-7',
            'required'              => false
        ),
        
        array(
            'name'                  => 'Envira Gallery',
            'slug'                  => 'envira-gallery',
            'source'                => 'http://boxycdn-plugins.s3.amazonaws.com/envira-gallery.zip',
            'required'              => false
        ),
        
        array(
            'name'                  => 'Soliloquy Slider',
            'slug'                  => 'soliloquy',
            'source'                => 'http://boxycdn-plugins.s3.amazonaws.com/soliloquy.zip',
            'required'              => false
        ),
 
        array(
            'name'                  => 'Slider Revolution',
            'slug'                  => 'revslider',
            'source'                => 'http://boxycdn-plugins.s3.amazonaws.com/revslider.zip',
            'required'              => false
        ),
        
        array(
            'name'                  => 'WPBakery Visual Composer',
            'slug'                  => 'js_composer',
            'source'                => 'http://boxycdn-plugins.s3.amazonaws.com/js_composer.zip',
            'required'              => false
        ),
 
    );
 
    $config = array(
        'domain'            => 'espresso',           			// Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           	// Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',        	 		// Default parent menu slug
        'parent_url_slug'   => 'themes.php',         			// Default parent URL slug
        'menu'              => 'install-required-plugins',   	// Menu slug
        'has_notices'       => true,                         	// Show admin notices or not
        'is_automatic'      => false,            				// Automatically activate plugins after installation or not
        'message'           => '',               				// Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', 'espresso' ),
            'menu_title'                                => __( 'Install Plugins', 'espresso' ),
            'installing'                                => __( 'Installing Plugin: %s', 'espresso' ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', 'espresso' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', 'espresso' ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', 'espresso' ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'espresso' ) // %1$s = dashboard link
        )
    );
 
    tgmpa( $plugins, $config );
 
}
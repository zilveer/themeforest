<?php

define( 'PGL', 'realPGL' );
define( '_PREFIX_', 'PGL_' );
define( 'PGL_VERSION', '1.1' );
define( 'PGL_URI', get_template_directory_uri() . '/' );
define( 'PGL_URI_CSS', PGL_URI . 'assets/css/' );
define( 'PGL_URI_IMG', PGL_URI . 'assets/img/' );
define( 'PGL_URI_JS', PGL_URI . 'assets/js/' );
define( 'PGL_PATH', str_replace( '\\', '/', get_template_directory() ) . '/' );
define( 'USE_REDUX', TRUE );

if ( ! isset( $content_width ) ) $content_width = 940;

function my_theme_setup() {
  load_theme_textdomain( PGL, get_template_directory() . '/languages' );
  include( 'inc/bootstrap.php' );
}
add_action( 'after_setup_theme', 'my_theme_setup' );

require_once(get_template_directory() .'/inc/walkers.php');
/**
 * Load the TGM Plugin Activator class to notify the user
 * to install the Envato WordPress Toolkit Plugin
 */
require_once( get_template_directory() . '/inc/class-tgm-plugin-activation.php' );
function tgmpa_register_toolkit() {

	// Specify the Envato Toolkit plugin
	$plugins = array(
		array(
			'name'                  => 'Envato WordPress Toolkit',
			'slug'                  => 'envato-wordpress-toolkit-master',
			'source'                => get_template_directory() . '/plugins/envato-wordpress-toolkit-master.zip',
			'required'              => true,
			'version'               => '1.5',
			'force_activation'      => true,
			'force_deactivation'    => false
		),
		array(
			'name'                  => 'Revolution Slider',
			'slug'                  => 'revslider',
			'source'                => get_template_directory() . '/plugins/revslider.zip',
			'required'              => false,
			'version'               => '4.1.4',
			'force_activation'      => false,
			'force_deactivation'    => false
		),
		array(
			'name'                  => 'Simple Google Maps Short Code',
			'slug'                  => 'simple-google-maps-short-code',
			'required'              => true,
			'force_activation'      => true,
			'force_deactivation'    => false
		),
        array(
			'name'                  => 'Advanced Custom Fields',
			'slug'                  => 'advanced-custom-fields',
			'required'              => false,
			'force_activation'      => true,
			'force_deactivation'    => false
		),
		array(
			'name'                  => 'Easy Bootstrap Shortcodes',
			'slug'                  => 'easy-bootstrap-shortcodes',
			'required'              => true,
			'force_activation'      => true,
			'force_deactivation'    => false
		),
		array(
			'name'                  => 'Simple And Clean Contact Form',
			'slug'                  => 'clean-and-simple-contact-form-by-meg-nicholas',
			'required'              => false,
			'force_activation'      => true,
			'force_deactivation'    => false
		),
	);

	// i18n text domain used for translation purposes
	$theme_text_domain = PGL;

	// Configuration of TGM
	$config = array(
		'domain'       	   => $theme_text_domain,
		'default_path' 	   => '',
		'parent_menu_slug' => 'admin.php',
		'parent_url_slug'  => 'admin.php',
		'menu'         	   => 'install-required-plugins',
		'has_notices'      => true,
		'is_automatic'     => true,
		'message' 		   => '',
		'strings'      	   => array(
			'page_title'                      => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                      => __( 'Install Plugins', $theme_text_domain ),
			'installing'                      => __( 'Installing Plugin: %s', $theme_text_domain ),
			'oops'                            => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
			'notice_cannot_install'  		  => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
			'notice_cannot_activate' 		  => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			'notice_ask_to_update' 			  => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			'notice_cannot_update' 			  => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			'install_link' 					  => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                          => __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 						  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ),
			'nag_type'						  => 'updated'
		)
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'tgmpa_register_toolkit' );

function init_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'inc/metabox/init.php' );
	}
}

//TODO: Add shortcode button
/*
add_action( 'init', 'realestast_buttons' );
function realestast_buttons() {
	add_filter( "mce_external_plugins", "realestast_add_buttons" );
	add_filter( 'mce_buttons', 'realestast_register_buttons' );
}
function realestast_add_buttons( $plugin_array ) {
	$plugin_array['realestast'] = get_template_directory_uri() . '/assets/js/estate/estate-codes.js';
	return $plugin_array;
}
function realestast_register_buttons( $buttons ) {
	array_push( $buttons, 'realcodes' ); // dropcap', 'recentposts
	return $buttons;
}*/

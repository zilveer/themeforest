<?php

function sleek_version(){
	return '1.4.13';
}



/*------------------------------------------------------------
 * Define paths
 *------------------------------------------------------------*/

define( "THEME_DIR", get_template_directory() );
define( "THEME_DIR_URI", get_template_directory_uri() );

define( "THEME_STYLESHEET", THEME_DIR . "/stylesheet" );
define( "THEME_STYLESHEET_URI", THEME_DIR_URI . "/stylesheet" );
define( "THEME_LESS", THEME_DIR . "/stylesheet/less" );
define( "THEME_LESS_URI", THEME_DIR_URI . "/stylesheet/less" );
define( "THEME_JS_URI", THEME_DIR_URI . "/js" );
define( "THEME_ICONS", THEME_DIR . "/icons" );
define( "THEME_ICONS_URI", THEME_DIR_URI . "/icons" );
define( "THEME_IMG_URI", THEME_DIR_URI . "/img" );
define( "THEME_PATTERNS", THEME_DIR . "/img/patterns" );
define( "THEME_PATTERNS_URI", THEME_DIR_URI . "/img/patterns" );

define( "THEME_FRAMEWORK", THEME_DIR . "/framework" );
define( "THEME_FRAMEWORK_URI", THEME_DIR_URI . "/framework" );
define( "THEME_FUNCTIONS", THEME_FRAMEWORK . "/functions" );
define( "THEME_FUNCTIONS_URI", THEME_FRAMEWORK_URI . "/functions" );
define( "THEME_ADMIN", THEME_FRAMEWORK . "/admin" );
define( "THEME_ADMIN_URI", THEME_FRAMEWORK_URI . "/admin" );

define( "THEME_SHORTCODES", THEME_FRAMEWORK . "/shortcodes" );
define( "THEME_BG_CONTROL", THEME_ADMIN . "/bg_control" );
define( "THEME_BG_CONTROL_URI", THEME_ADMIN_URI . "/bg_control" );
define( "THEME_ICON_PICKER", THEME_ADMIN . "/icon_picker" );
define( "THEME_ICON_PICKER_URI", THEME_ADMIN_URI . "/icon_picker" );

define( "THEME_CUSTOMIZE", THEME_FRAMEWORK . "/theme_customize" );
define( "THEME_CUSTOMIZE_URI", THEME_FRAMEWORK_URI . "/theme_customize" );




/*------------------------------------------------------------
 * External Modules/Files
 *------------------------------------------------------------*/

add_action( 'after_setup_theme', 'sleek_include_files' );

function sleek_include_files(){
	include_once( THEME_FUNCTIONS . '/class-tgm-plugin-activation.php' );
	include_once( THEME_FUNCTIONS . '/general_functions.php' );
	include_once( THEME_FUNCTIONS . '/theme_functions.php' );
	include_once( THEME_FUNCTIONS . '/custom_post_types.php' );
	include_once( THEME_FUNCTIONS . '/navigation_menus.php' );
	include_once( THEME_FUNCTIONS . '/sidebars.php' );
	include_once( THEME_FUNCTIONS . '/widgets.php' );
	include_once( THEME_FUNCTIONS . '/gallery.php' );
	include_once( THEME_FRAMEWORK . '/theme_customize/theme_customize.php' );
	include_once( THEME_FRAMEWORK . '/theme_customize/theme_settings.php' );
	include_once( THEME_SHORTCODES. '/shortcodes.php' );
	include_once( THEME_SHORTCODES. '/loops/ajax_handler.php' );
	include_once( THEME_ADMIN .     '/custom_fields/custom_fields_type_background.php' );
	include_once( THEME_ADMIN .     '/custom_fields/custom_fields_import.php' );
	include_once( THEME_FUNCTIONS . '/custom_comments.php' );
	include_once( THEME_FRAMEWORK . '/tinymce_extend/tinymce_extend.php' );
	include_once( THEME_STYLESHEET. '/customized_style.php' );

	if( is_admin() ){
		add_action( 'in_admin_footer', 'sleek_admin_includes' );

		function sleek_admin_includes(){
			include_once( THEME_ICONS .       '/icons.php' );
			include_once( THEME_ICON_PICKER . '/icon_picker_lightbox.php' );
			include_once( THEME_BG_CONTROL .  '/bg_control_lightbox.php' );
		}
	}
}



/*------------------------------------------------------------
 * Load Scripts and Styles
 *------------------------------------------------------------*/

add_action( 'wp_enqueue_scripts', 'sleek_load_styles' );
add_action( 'wp_enqueue_scripts', 'sleek_load_scripts' );
add_action( 'wp_enqueue_scripts', 'sleek_load_conditional_scripts' );
add_action( 'admin_enqueue_scripts', 'sleek_load_admin_assets' );
add_action( 'after_setup_theme', 'sleek_editor_styles' );



function sleek_load_styles() {

	// enqueue google fonts
	wp_register_style('sleek_google_fonts', sleek_get_google_fonts_embed_url(), array(), sleek_version(), 'all');
	wp_enqueue_style ('sleek_google_fonts');

	wp_register_style('sleek_main_style', THEME_DIR_URI . '/style.css', array(), sleek_version(), 'all');
	wp_enqueue_style ('sleek_main_style');

	// Main WP-LESS styles
	if ( class_exists('WPLessPlugin') ){
		wp_register_style('sleek_main_less', THEME_LESS_URI . '/main.less', array(), sleek_version(), 'all');
		wp_enqueue_style ('sleek_main_less');
	}

	// Icons
	wp_register_style('sleek_icons', THEME_ICONS_URI . '/style.css', array(), sleek_version(), 'all');
	wp_enqueue_style ('sleek_icons');

	// RTL
	if( is_rtl() ){
		wp_register_style('sleek_rtl_style', THEME_DIR_URI . '/rtl.css', array( 'sleek_main_less', 'sleek_icons' ), sleek_version(), 'all');
		wp_enqueue_style ('sleek_rtl_style');
	}

}

function sleek_load_scripts() {

	wp_enqueue_script('masonry');

	// custom plugins
	wp_register_script('sleek_js_plugins', THEME_JS_URI . '/plugins.js', array('jquery'), sleek_version());
	wp_enqueue_script('sleek_js_plugins');

	// main script
	wp_register_script('sleek_main_front_script', THEME_JS_URI . '/main.js', array('sleek_js_plugins'), sleek_version(), true);
	wp_enqueue_script('sleek_main_front_script');

	// MEJS script/style
	wp_enqueue_style('wp-mediaelement');
	wp_enqueue_script('wp-mediaelement');


	// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
	wp_localize_script( 'sleek_main_front_script', 'sleekAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

}

function sleek_load_conditional_scripts() {
	$theme_settings = sleek_theme_settings();

	// Google Maps Script Register
	wp_register_script( 'sleek_google_maps', '//maps.googleapis.com/maps/api/js?key='.$theme_settings->advanced['google_api'].'&language='.get_locale(), array(), NULL, true );



	// Ajax Load Pages Script
	if ( $theme_settings->general['ajax_load_pages'] && $theme_settings->advanced['embed_gmaps_js'] ) {

		// load immediately, or in shortcode if not ajax page load enabled
		wp_enqueue_script('sleek_google_maps');
	}

}

function sleek_load_admin_assets() {

	// admin styles
	wp_register_style('sleek_admin_styles', THEME_ADMIN_URI . '/assets/css/sleek_admin_styles.css', array(), sleek_version(), 'all');
	wp_enqueue_style('sleek_admin_styles');

	// icons stylesheet
	wp_register_style('sleek_icons', THEME_ICONS_URI . '/style.css', array(), sleek_version(), 'all');
	wp_enqueue_style('sleek_icons');

	// admin scripts
	wp_register_script('sleek_admin_scripts', THEME_ADMIN_URI . '/assets/js/sleek_admin_scripts.js', array('jquery'), sleek_version(), true);
	wp_enqueue_script('sleek_admin_scripts');

	// icon picker script
	wp_register_script( 'sleek_icon_picker_script', THEME_ICON_PICKER_URI.'/icon_picker_script.js', array(), sleek_version(), true );
	wp_enqueue_script(array('sleek_icon_picker_script'));

	// background control script
	wp_register_script( 'sleek_bg_control_script', THEME_BG_CONTROL_URI.'/bg_control_script.js', array('wp-color-picker'), sleek_version(), true );
	wp_enqueue_script(array('sleek_bg_control_script'));
}

function sleek_editor_styles() {
	add_editor_style( THEME_FRAMEWORK_URI . '/tinymce_extend/tinymce_styles.css' );
}



/*------------------------------------------------------------
 * Theme Support
 *------------------------------------------------------------*/

add_action( 'after_setup_theme', 'sleek_add_theme_support' );

function sleek_add_theme_support(){
	if( function_exists('add_theme_support') ){

		if( !isset($content_width) ) {
			$content_width = 1075;
		}

		// Add Menu Support
		add_theme_support('menus');

		// Add Thumbnail Theme Support
		add_theme_support('post-thumbnails');
		add_image_size('fit', 1075);
		add_image_size('xl', 1600, 900, true);
		add_image_size('l', 1075, 605, true);
		add_image_size('m', 800, 450, true);
		add_image_size('sm', 600, 338, true);
		add_image_size('s', 355, 200, true);
		add_image_size('xs', 150, 84, true);
		add_image_size('square-l', 1075, 806, true);
		add_image_size('square-m', 800, 600, true);
		add_image_size('square-s', 400, 300, true);
		add_image_size('portrait-m', 450, 800, true);
		add_image_size('gallery-s', 300);
		add_image_size('gallery-m', 400);
		add_image_size('gallery-l', 600);

		// Add Thumbnails to WP Admin to choose from
		add_filter( 'image_size_names_choose', 'sleek_custom_image_sizes' );

		function sleek_custom_image_sizes( $sizes ) {
			return array_merge( $sizes, array(
				'fit' => __( 'Scale to fit', 'sleek' ),
				'l' => __( 'Sleek L (16:9)', 'sleek' ),
				'square-l' => __( 'Sleek L (4:3)', 'sleek' ),
				'm' => __( 'Sleek M (16:9)', 'sleek' ),
				'square-m' => __( 'Sleek M (4:3)', 'sleek' ),
			));
		}

		// Enables post and comment RSS feed links to head
		add_theme_support('automatic-feed-links');

		// Localisation Support
		load_theme_textdomain('sleek', THEME_DIR . '/languages');

		// Add Post Formats Support
		add_theme_support( 'post-formats', array( 'aside', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );

		// Title Tag Support
		add_theme_support( 'title-tag' );
	}
}



/*------------------------------------------------------------
 * Plugins
 *------------------------------------------------------------*/

/* WP Less
 *------------------------------------------------------------*/

add_action( 'init', 'sleek_include_less');

function sleek_include_less(){
	if( class_exists('WPLessPlugin') ){
		include_once( THEME_LESS . '/wp_less_config.php' );
			$less = WPLessPlugin::getInstance();
		$less->setVariables( sleek_wp_less_config() );
	}else{
		add_action( 'wp_enqueue_scripts', 'sleek_load_compiled_style' );
	}
}

function sleek_load_compiled_style(){
	wp_register_style('sleek_compiled_style', THEME_STYLESHEET_URI . '/compiled.css', array(), sleek_version(), 'all');
	wp_enqueue_style ('sleek_compiled_style');
}



/* Envato Market Plugin
 * Currently disabled since the beta version seems
 * not stable enough for being included in the theme
 *------------------------------------------------------------*/

add_action( 'after_setup_theme', 'sleek_include_envato_plugin');

function sleek_include_envato_plugin(){
	// include_once( THEME_FUNCTIONS . '/envato_plugin_installer.php' );
}



/* ACF
 *------------------------------------------------------------*/

// define( 'ACF_LITE' , true ); // hide custom fields from admin panel



/* TGM Require plugins
 *------------------------------------------------------------*/

add_action( 'tgmpa_register', 'sleek_register_required_plugins' );

function sleek_register_required_plugins() {
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme.
		array(
			'name'               => 'WP Less', // The plugin name.
			'slug'               => 'wp-less', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Advanced Custom Fields',
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
		),

	);

	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
			'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
			'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
			'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}



/*------------------------------------------------------------
 * Add Filters
 *------------------------------------------------------------*/

// Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'do_shortcode');
// Remove <p> tags in Dynamic Sidebars (better!)
add_filter('widget_text', 'shortcode_unautop');
// Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'shortcode_unautop');
// Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode');
// Hide Admin Bar on front
// add_filter('show_admin_bar', '__return_false');

<?php 
define('PARENT_DIR', get_template_directory());
define('ETHEME_CODE_DIR', trailingslashit(PARENT_DIR).'framework');

define('PARENT_URL', get_template_directory_uri());
define('ETHEME_CODE_URL', trailingslashit(PARENT_URL).'framework');
define('ETHEME_CODE_IMAGES_URL', trailingslashit(ETHEME_CODE_URL).'css/images');
define('ETHEME_THEME_ASSETS', trailingslashit(PARENT_URL).'theme-assets');
define('ETHEME_CODE_JS_URL', trailingslashit(ETHEME_CODE_URL).'js');
define('ETHEME_CODE_CSS_URL', trailingslashit(ETHEME_CODE_URL).'css');
define('CHILD_URL', get_stylesheet_directory_uri());
define('ET_API', 'http://8theme.com/api/v1/');


require_once( trailingslashit(ETHEME_CODE_DIR). 'theme.php' );



// add_editor_style();
add_action('after_setup_theme', 'etheme_theme_setup');
function etheme_theme_setup(){
	load_theme_textdomain( ETHEME_DOMAIN, get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
}

    
require_once( trailingslashit(ETHEME_CODE_DIR). 'options.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'inc/taxonomy-metadata.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'inc/really-simple-captcha/really-simple-captcha.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'theme-functions.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'images.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'shortcodes.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'widgets.php' );
if(class_exists('WooCommerce'))
	require_once( trailingslashit(ETHEME_CODE_DIR). 'woo.php' );
	
require_once( trailingslashit(ETHEME_CODE_DIR). 'vc.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'twitteroauth/twitteroauth.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'portfolio.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'testimonials/woothemes-testimonials.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'theme-options.php');
if ( is_admin() ) {
	if(!class_exists('WP_Import'))
		require_once( trailingslashit(ETHEME_CODE_DIR) . 'wordpress-importer/wordpress-importer.php');
	require_once( trailingslashit(ETHEME_CODE_DIR) . 'import.php');
	require_once( trailingslashit(ETHEME_CODE_DIR) . 'inc/menu-images/nav-menu-images.php');
    require_once( trailingslashit(ETHEME_CODE_DIR) . 'plugins.php' );

	/*
	* Check theme version
	* ******************************************************************* */
	require_once( trailingslashit(ETHEME_CODE_DIR) .  'version-check.php' );
}
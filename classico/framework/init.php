<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Define base constants
// **********************************************************************//

define('ET_FW', 'etheme');
define('ET_FW_VERSION', '0.2');
define('ET_BASE', get_template_directory() .'/');
define('ET_CHILD', get_stylesheet_directory() .'/');
define('ET_BASE_URI', get_template_directory_uri() .'/');
define('ET_CHILD_URI', get_stylesheet_directory() .'/');

define('ET_CODE', 'framework/');
define('ET_CODE_DIR', ET_BASE.'framework/');
define('ET_TEMPLATES', ET_CODE . 'templates/');
define('ET_THEME', 'theme/');
define('ET_TEMPLATES_THEME', ET_THEME . 'templates/');
define('ET_CODE_3D', ET_CODE .'thirdparty/');
define('ET_CODE_3D_URI', ET_BASE_URI.ET_CODE .'thirdparty/');
define('ET_CODE_WIDGETS', ET_CODE .'widgets/');
define('ET_CODE_POST_TYPES', ET_CODE .'post-types/');
define('ET_CODE_SHORTCODES', ET_CODE .'shortcodes/');
define('ET_CODE_CSS', ET_BASE_URI . ET_THEME .'assets/css/');
define('ET_CODE_JS', ET_BASE_URI . ET_THEME .'assets/js/');
define('ET_CODE_IMAGES', ET_BASE_URI . ET_THEME .'assets/images/');
define('ET_API', 'http://8theme.com/api/v1/');

define('ET_PREFIX', '_et_');

define('ET_DOMAIN', 'etheme');


// **********************************************************************// 
// ! Helper Framework functions
// **********************************************************************//
require_once( ET_BASE . ET_CODE . 'helpers.php' );

/*
* Theme f-ns
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE . 'theme-functions.php') );

// **********************************************************************// 
// ! Framework setup
// **********************************************************************//
require_once( apply_filters('et_file_url', ET_CODE . 'theme-init.php') );

/*
* Sidebars
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE . 'sidebars.php') );

/*
* Widgets
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE . 'widgets.php') );

/*
* Post types
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE_POST_TYPES . 'static-blocks.php') );
require_once( apply_filters('et_file_url', ET_CODE_POST_TYPES . 'portfolio.php') );

/*
* Configure Visual Composer
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE . 'vc.php') );

/*
* Shortcodes (depends on Visual Composer plugin)
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE . 'shortcodes.php') );


/*
* Plugins activation
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE_3D . 'tgm-plugin-activation/class-tgm-plugin-activation.php') );

/*
* WooCommerce f-ns
* ******************************************************************* */
if(class_exists('WooCommerce')) {
	require_once( apply_filters('et_file_url', ET_CODE . 'woo.php') );
}
/*
* Options Framework 
* ******************************************************************* */
if ( !class_exists( 'ReduxFramework' ) && file_exists( apply_filters('et_file_url', ET_CODE_3D . 'options-framework/ReduxCore/framework.php') ) ) {
	
	/* extension loader */
    require_once( apply_filters('et_file_url', ET_CODE_3D . 'options-framework/loader.php') );
    
    require_once( apply_filters('et_file_url', ET_CODE_3D . 'options-framework/ReduxCore/framework.php') );
}

	/* load theme specific options */
	if ( file_exists( apply_filters('et_file_url', ET_THEME . 'theme-options.php') ) ) {
	    require_once( apply_filters('et_file_url', ET_THEME . 'theme-options.php') );
	}

	/* load base framework options */
	if ( !isset( $redux_demo ) && file_exists( apply_filters('et_file_url', ET_CODE . 'theme-options.php') ) ) {
	    require_once( apply_filters('et_file_url', ET_CODE . 'theme-options.php') );
	}

	

/*
* Custom Metaboxes for pages
* ******************************************************************* */


add_action( 'init', 'et_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
if(!function_exists('et_initialize_cmb_meta_boxes')) {
	function et_initialize_cmb_meta_boxes() {
	
		if ( ! class_exists( 'cmb_Meta_Box' ) ) {
	    	require_once( apply_filters('et_file_url', ET_CODE . 'custom-metaboxes.php') );
			require_once( apply_filters('et_file_url', ET_CODE_3D . 'custom-metaboxes/init.php') );
		}
	
	}
}

/*
* Twitter API
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE_3D. 'twitteroauth/twitteroauth.php') );


/*
* Testimonials
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE_3D. 'testimonials/woothemes-testimonials.php') );



/*
* Captcha Plugin
* ******************************************************************* */
require_once( apply_filters('et_file_url', ET_CODE_3D. 'really-simple-captcha/really-simple-captcha.php') );


/*
* Admin panel setup
* ******************************************************************* */

if ( is_admin() ) {
	if(!class_exists('WP_Import'))
		require_once( apply_filters('et_file_url', ET_CODE_3D . 'wordpress-importer/wordpress-importer.php'));
	
	require_once( apply_filters('et_file_url', ET_CODE . 'admin.php') );
	
	require_once( apply_filters('et_file_url', ET_CODE . 'import.php'));
	
	require_once( apply_filters('et_file_url', ET_CODE . 'updater.php'));
	
	require_once( apply_filters('et_file_url', ET_CODE_3D . 'menu-images/nav-menu-images.php'));
	
	/*
	* Check theme version
	* ******************************************************************* */
	require_once( apply_filters('et_file_url', ET_CODE . 'version-check.php') );

}
<?php

/**
 * Framework bootstrap.
 *
 * This file serves as a bootstrap for the framework, defining global constants
 * and loading the core libraries.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Lib
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

// Framework utilities ---------------------------------------------------------

/**
 * Define a constant if not already defined.
 *
 * @param string $key The constant name.
 * @param string $value The constant value.
 * @return void
 */
if( !function_exists('thb_define') ) {
	function thb_define( $key, $value ) {
		if( !defined($key) ) {
			define( $key, $value );
		}
	}
}

// Theme -----------------------------------------------------------------------

/**
 * Theme data
 */
$theme_data = wp_get_theme();
$thb_master_version = $theme_data->Version;
thb_define( 'THB_THEME_NAME', $theme_data->Name );
thb_define( 'THB_THEME_VERSION', $theme_data->Version );

if( is_child_theme() ) {
	$parent_data = wp_get_theme( $theme_data->Template );
	thb_define( 'THB_PARENT_THEME_NAME', $parent_data->Name );
	thb_define( 'THB_PARENT_THEME_VERSION', $parent_data->Version );
	$thb_master_version = $parent_data->Version;
}

thb_define( 'THB_MASTER_THEME_VERSION', $thb_master_version );

// Framework global constants --------------------------------------------------

/**
 * Framework name
 */
thb_define( 'THB_FRAMEWORK_NAME', 'The Happy Framework' );

/**
 * Framework version
 */
thb_define( 'THB_FRAMEWORK_VERSION', '2.0.2' );

/**
 * Framework directory name
 */
thb_define( 'THB_FRAMEWORK_DIR_NAME', 'framework' );

/**
 * Theme template directory
 */
thb_define( 'THB_TEMPLATE_DIR', get_template_directory() );

/**
 * Theme template URL
 */
thb_define( 'THB_TEMPLATE_URL', get_template_directory_uri() );

/**
 * Framework directory
 */
thb_define( 'THB_DIR', THB_TEMPLATE_DIR . '/' . THB_FRAMEWORK_DIR_NAME );

/**
 * Framework URL
 */
thb_define( 'THB_URL', esc_url( get_template_directory_uri() . '/' . THB_FRAMEWORK_DIR_NAME ) );

/**
 * Framework languages dir
 */
thb_define( 'THB_LANGUAGES_DIR', THB_DIR . '/languages' );

/**
 * Framework languages URL
 */
thb_define( 'THB_LANGUAGES_URL', THB_URL . '/languages' );

/**
 * Framework libraries dir
 */
thb_define( 'THB_LIBS_DIR', THB_DIR . '/lib' );

/**
 * Framework core dir
 */
thb_define( 'THB_CORE_DIR', THB_DIR . '/core' );

/**
 * Framework core fields dir
 */
thb_define( 'THB_CORE_FIELDS_DIR', THB_CORE_DIR . '/fields' );

/**
 * Framework core customization dir
 */
thb_define( 'THB_CORE_CUSTOMIZATION_DIR', THB_CORE_DIR . '/customization' );

/**
 * Framework helpers dir
 */
thb_define( 'THB_HELPERS_DIR', THB_DIR . '/helpers' );

/**
 * Framework templates dir
 */
thb_define( 'THB_TEMPLATES', 'templates' );
thb_define( 'THB_TEMPLATES_DIR', THB_DIR . '/' . THB_TEMPLATES );

/**
 * Framework resources dir.
 */
thb_define( 'THB_RESOURCES_DIR', THB_DIR . '/resources' );

/**
 * The framework assets path
 */
thb_define( 'THB_ASSETS_PATH', THB_DIR . '/assets' );

/**
 * The framework assets URL
 */
thb_define( 'THB_ASSETS_URL', THB_URL . '/assets' );

/**
 * The framework admin assets path
 */
thb_define( 'THB_ADMIN_ASSETS_PATH', THB_ASSETS_PATH . '/admin' );

/**
 * The framework admin assets URL
 */
thb_define( 'THB_ADMIN_ASSETS_URL', THB_ASSETS_URL . '/admin' );

/**
 * The framework admin JavaScript assets path
 */
thb_define( 'THB_ADMIN_JS_PATH', THB_ADMIN_ASSETS_PATH . '/js' );

/**
 * The framework admin JavaScript assets URL
 */
thb_define( 'THB_ADMIN_JS_URL', THB_ADMIN_ASSETS_URL . '/js' );

/**
 * The framework admin CSS assets URL
 */
thb_define( 'THB_ADMIN_CSS_URL', THB_ADMIN_ASSETS_URL . '/css' );

/**
 * The framework frontend assets path
 */
thb_define( 'THB_FRONTEND_ASSETS_PATH', THB_ASSETS_PATH . '/frontend' );

/**
 * The framework frontend assets URL
 */
thb_define( 'THB_FRONTEND_ASSETS_URL', THB_ASSETS_URL . '/frontend' );

/**
 * The framework frontend JavaScript assets path
 */
thb_define( 'THB_FRONTEND_JS_PATH', THB_FRONTEND_ASSETS_PATH . '/js' );

/**
 * The framework frontend JavaScript assets URL
 */
thb_define( 'THB_FRONTEND_JS_URL', THB_FRONTEND_ASSETS_URL . '/js' );

/**
 * The framework frontend CSS assets URL
 */
thb_define( 'THB_FRONTEND_CSS_URL', THB_FRONTEND_ASSETS_URL . '/css' );

/**
 * The framework shared assets path
 */
thb_define( 'THB_SHARED_ASSETS_PATH', THB_ASSETS_PATH . '/shared' );

/**
 * The framework shared assets URL
 */
thb_define( 'THB_SHARED_ASSETS_URL', THB_ASSETS_URL . '/shared' );

/**
 * The framework shared JavaScript assets URL
 */
thb_define( 'THB_SHARED_JS_URL', THB_SHARED_ASSETS_URL . '/js' );

/**
 * The framework shared CSS assets URL
 */
thb_define( 'THB_SHARED_CSS_URL', THB_SHARED_ASSETS_URL . '/css' );


// Theme global constants ------------------------------------------------------


/**
 * Config folder constants
 */
if( !defined('THB_THEME_CONFIG') ) {
	thb_define( 'THB_THEME_CONFIG', 'config' );
}
thb_define( 'THB_THEME_CONFIG_DIR', THB_TEMPLATE_DIR . '/' . THB_THEME_CONFIG );
thb_define( 'THB_THEME_CONFIG_URL', get_template_directory_uri() . '/' . THB_THEME_CONFIG );

/**
 * The theme installation details
 */
thb_define( 'THB_INSTALLATION_KEY', 'thb_theme_details_' . THB_THEME_KEY );

/**
 * The theme options key
 */
thb_define( 'THB_OPTIONS_KEY', 'thb_theme_options_' . THB_THEME_KEY );

/**
 * Meta field.
 */
thb_define( 'THB_META_KEY', 'thb_meta_' );

/**
 * Duplicable table and key.
 */
thb_define( 'THB_DUPLICABLE_KEY', 'thb_duplicable' );

/**
 * The theme CSS folder.
 */
thb_define( 'THB_THEME_CSS', THB_TEMPLATE_DIR . '/css' );

/**
 * The theme CSS URL.
 */
thb_define( 'THB_THEME_CSS_URL', THB_TEMPLATE_URL . '/css' );

/**
 * The theme modules folder.
 */
thb_define( 'THB_THEME_MODULES', THB_THEME_CONFIG_DIR . '/modules' );

/**
 * The theme modules URL.
 */
thb_define( 'THB_THEME_MODULES_URL', THB_THEME_CONFIG_URL . '/modules' );

/**
 * The theme templates folder.
 */
thb_define( 'THB_THEME_TEMPLATES_DIR', THB_THEME_CONFIG_DIR . '/' . THB_TEMPLATES );

/**
 * The theme resources folder.
 */
thb_define( 'THB_THEME_RESOURCES_DIR', THB_THEME_CONFIG_DIR . '/resources' );

/**
 * The theme environment
 */
if( !defined('THB_THEME_ENVIRONMENT') ) {
	thb_define( 'THB_THEME_ENVIRONMENT', 'development' );
}

/**
 * User created sidebars duplicable table entries
 */
thb_define( 'THB_DUPLICABLE_SIDEBARS', 'sidebar' );

/**
 * Slides key definition.
 */
thb_define( 'THB_SLIDES', 'slide' );

/**
 * Frontend translation
 */
load_theme_textdomain( 'thb_text_domain', get_template_directory() . '/languages' );

if ( is_child_theme() ) {
	load_theme_textdomain( 'thb_text_domain', get_stylesheet_directory() . '/languages' );
}


// Core imports ----------------------------------------------------------------

if( ! function_exists( 'thb_autoload' ) ) {
	/**
	 * Class autoloader.
	 *
	 * @param string $class
	 */
	function thb_autoload( $class ) {
		$paths = array(
			THB_CORE_FIELDS_DIR,
			THB_CORE_CUSTOMIZATION_DIR,
			THB_CORE_CUSTOMIZATION_DIR . '/settings',
			THB_CORE_CUSTOMIZATION_DIR . '/controls',
			THB_CORE_DIR,
			THB_LIBS_DIR
		);

		$class = str_replace('THB_', '', $class);
		$file = 'class.' . strtolower( $class ) . '.php';

		foreach ( $paths as $path ) {
			$class_path = $path . '/' . $file;

			if ( file_exists( $class_path ) ) {
				require_once $class_path;
				return;
			}
		}
	}

	spl_autoload_register( 'thb_autoload' );
}

if( ! function_exists( 'thb_require_custom_functions' ) ) {
	/**
	 * Optionally load a "functions-custom.php" file after the theme setup.
	 */
	function thb_require_custom_functions() {
		$path = locate_template( 'functions-custom.php' );

		if ( ! empty( $path ) ) {
			require_once $path;
		}
	}
}


// Core imports ----------------------------------------------------------------


/**
 * Helpers
 */
require_once THB_HELPERS_DIR . '/helper.array.php';
require_once THB_HELPERS_DIR . '/helper.color.php';
require_once THB_HELPERS_DIR . '/helper.duplicable.php';
require_once THB_HELPERS_DIR . '/helper.options.php';
require_once THB_HELPERS_DIR . '/helper.post.php';
require_once THB_HELPERS_DIR . '/helper.system.php';
require_once THB_HELPERS_DIR . '/helper.text.php';
require_once THB_HELPERS_DIR . '/helper.image.php';
require_once THB_HELPERS_DIR . '/helper.frontend.php';
require_once THB_HELPERS_DIR . '/helper.sidebars.php';
require_once THB_HELPERS_DIR . '/helper.query.php';
require_once THB_HELPERS_DIR . '/helper.comments.php';
require_once THB_HELPERS_DIR . '/helper.translation.php';
require_once THB_HELPERS_DIR . '/helper.upload.php';
require_once THB_HELPERS_DIR . '/helper.html.php';
require_once THB_HELPERS_DIR . '/helper.css.php';

/**
 * DB migrations
 */
// require_once THB_DIR . '/db/migrations.php';


// Framework bootstrap ---------------------------------------------------------


$thb_theme = thb_theme();

/**
 * Framework translation
 */
thb_load_admin_translation();

$sidebars_count = 0;


// Run -------------------------------------------------------------------------


add_action( 'after_setup_theme', array($thb_theme, 'run'), 9999 );

if ( ! defined( 'THB_COMPILER' ) || THB_COMPILER == true ) {
	
}
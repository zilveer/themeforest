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
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Lib
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
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
thb_define( 'THB_THEME_NAME', $theme_data->Name );
thb_define( 'THB_THEME_VERSION', $theme_data->Version );

if( is_child_theme() ) {
	$parent_data = wp_get_theme( $theme_data->Template );
	thb_define( 'THB_PARENT_THEME_NAME', $parent_data->Name );
	thb_define( 'THB_PARENT_THEME_VERSION', $parent_data->Version );
}


// Framework global constants --------------------------------------------------

/**
 * Framework name
 */
thb_define( 'THB_FRAMEWORK_NAME', 'The Happy Framework' );

/**
 * Framework version
 */
thb_define( 'THB_FRAMEWORK_VERSION', '1.0' );

/**
 * Database version
 */
thb_define( 'THB_DB_VERSION', '1' );

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
thb_define( 'THB_URL', get_template_directory_uri() . '/' . THB_FRAMEWORK_DIR_NAME );

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
 * Framework core shortcodes dir
 */
thb_define( 'THB_CORE_SHORTCODES_DIR', THB_CORE_DIR . '/shortcodes' );

/**
 * Framework core widgets dir
 */
thb_define( 'THB_CORE_WIDGETS_DIR', THB_CORE_DIR . '/widgets' );

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
 * The framework assets URL
 */
thb_define( 'THB_ASSETS_URL', THB_URL . '/assets' );

/**
 * The framework admin assets URL
 */
thb_define( 'THB_ADMIN_ASSETS_URL', THB_ASSETS_URL . '/admin' );

/**
 * The framework admin JavaScript assets URL
 */
thb_define( 'THB_ADMIN_JS_URL', THB_ADMIN_ASSETS_URL . '/js' );

/**
 * The framework admin CSS assets URL
 */
thb_define( 'THB_ADMIN_CSS_URL', THB_ADMIN_ASSETS_URL . '/css' );

/**
 * The framework frontend assets URL
 */
thb_define( 'THB_FRONTEND_ASSETS_URL', THB_ASSETS_URL . '/frontend' );

/**
 * The framework frontend JavaScript assets URL
 */
thb_define( 'THB_FRONTEND_JS_URL', THB_FRONTEND_ASSETS_URL . '/js' );

/**
 * The framework frontend CSS assets URL
 */
thb_define( 'THB_FRONTEND_CSS_URL', THB_FRONTEND_ASSETS_URL . '/css' );

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

/**
 * The framework data namespace
 */
thb_define( 'THB_DATA_NAMESPACE', 'data' );


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
thb_define( 'THB_INSTALLATION_KEY', 'thb_theme_installation_' . THB_THEME_KEY );

/**
 * The theme options key
 */
thb_define( 'THB_OPTIONS_KEY', 'thb_theme_options_' . THB_THEME_KEY );

/**
 * Meta field.
 */
thb_define( 'THB_META_KEY', 'thb_meta_' . THB_THEME_KEY . '_' );

/**
 * Duplicable table and key.
 */
thb_define( 'THB_DUPLICABLE_TABLE', 'thb_duplicable_' . THB_THEME_KEY );
thb_define( 'THB_DUPLICABLE_KEY', 'thb_duplicable_' . THB_THEME_KEY );

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
 * Frontend translation
 */
load_theme_textdomain( 'thb_text_domain', get_template_directory() . '/languages' );


// Core imports ----------------------------------------------------------------


/**
 * Helpers
 */
include THB_HELPERS_DIR . '/helper.array.php';
include THB_HELPERS_DIR . '/helper.color.php';
include THB_HELPERS_DIR . '/helper.data.php';
include THB_HELPERS_DIR . '/helper.duplicable.php';
include THB_HELPERS_DIR . '/helper.options.php';
include THB_HELPERS_DIR . '/helper.post.php';
include THB_HELPERS_DIR . '/helper.system.php';
include THB_HELPERS_DIR . '/helper.text.php';
include THB_HELPERS_DIR . '/helper.image.php';
include THB_HELPERS_DIR . '/helper.frontend.php';
include THB_HELPERS_DIR . '/helper.sidebars.php';
include THB_HELPERS_DIR . '/helper.query.php';
include THB_HELPERS_DIR . '/helper.comments.php';
include THB_HELPERS_DIR . '/helper.translation.php';
include THB_HELPERS_DIR . '/helper.upload.php';
include THB_HELPERS_DIR . '/helper.html.php';
include THB_HELPERS_DIR . '/helper.css.php';

/**
 * Utility libraries
 */
include THB_LIBS_DIR . '/class.template.php';
include THB_LIBS_DIR . '/class.templateloader.php';
include THB_LIBS_DIR . '/twitteroauth.php';
include THB_LIBS_DIR . '/class-tgm-plugin-activation.php';

/**
 * DB migrations
 */
include THB_DIR . '/db/migrations.php';

/**
 * Core classes
 */
include THB_CORE_DIR . '/class.field.php';
include THB_CORE_FIELDS_DIR . '/class.textfield.php';
include THB_CORE_FIELDS_DIR . '/class.numberfield.php';
include THB_CORE_FIELDS_DIR . '/class.textareafield.php';
include THB_CORE_FIELDS_DIR . '/class.selectfield.php';
include THB_CORE_FIELDS_DIR . '/class.graphicradiofield.php';
include THB_CORE_FIELDS_DIR . '/class.datefield.php';
include THB_CORE_FIELDS_DIR . '/class.slidefield.php';
include THB_CORE_FIELDS_DIR . '/class.uploadfield.php';
include THB_CORE_FIELDS_DIR . '/class.classicuploadfield.php';
include THB_CORE_FIELDS_DIR . '/class.checkboxfield.php';
include THB_CORE_FIELDS_DIR . '/class.fontfield.php';
include THB_CORE_FIELDS_DIR . '/class.galleryfield.php';
include THB_CORE_FIELDS_DIR . '/class.queryfilterfield.php';
include THB_CORE_FIELDS_DIR . '/class.colorfield.php';
include THB_CORE_FIELDS_DIR . '/class.keyvaluefield.php';
include THB_CORE_DIR . '/class.collection.php';
include THB_CORE_DIR . '/class.tabfieldscontainer.php';
include THB_CORE_DIR . '/class.tabduplicablefieldscontainer.php';
include THB_CORE_DIR . '/class.tabcustomfieldscontainer.php';
include THB_CORE_DIR . '/class.tab.php';
include THB_CORE_DIR . '/class.statictab.php';
include THB_CORE_DIR . '/class.metaboxfieldscontainer.php';
include THB_CORE_DIR . '/class.metaboxduplicablefieldscontainer.php';
include THB_CORE_DIR . '/class.metabox.php';
include THB_CORE_DIR . '/class.adminpage.php';

include THB_CORE_DIR . '/class.taxonomy.php';
include THB_CORE_DIR . '/class.posttype.php';
include THB_CORE_DIR . '/class.shortcode.php';
include THB_CORE_DIR . '/class.widget.php';
include THB_CORE_DIR . '/class.admintweaks.php';
include THB_CORE_DIR . '/class.admin.php';
include THB_CORE_DIR . '/class.frontend.php';
include THB_CORE_DIR . '/class.theme.php';


// Framework bootstrap ---------------------------------------------------------


$thb_theme = thb_theme();

/**
 * Framework translation
 */
if( defined('QT_SUPPORTED_WP_VERSION') ) {
	// qTranslate
	global $q_config;
	$thb_admin_language = $q_config['locale'][$q_config['language']];
}
else if( defined('ICL_LANGUAGE_CODE') ) {
	// WPML
	$thb_admin_language = get_locale();
}
else {
	$thb_admin_language = defined( 'WPLANG' ) ? WPLANG : 'en_US';
}
$thb_admin_default_language = 'en_US';

$thb_admin = $thb_theme->getAdmin();
$thb_admin->setLanguage($thb_admin_language);
$thb_admin->setDefaultLanguage($thb_admin_default_language);

$thb_lang = array();

thb_load_admin_translation();


// Theme updater ---------------------------------------------------------------


if( thb_system_is_development() && ! is_child_theme() && is_admin() && (!defined('THB_UPDATE_CHECK') || THB_UPDATE_CHECK == true) ) {
	/**
	 * Theme update check interval
	 */
	thb_define( 'THB_UPDATE_CHECK_INTERVAL', 86400 ); // Check once a day

	/**
	 * Theme update changelog dispatcher
	 */
	thb_define( 'THB_UPDATE_CHANGELOG_DISPATCHER', 'http://thbthemes.com/update-checker/?product=' . THB_THEME_KEY );

	include THB_CORE_DIR . '/class.update.php';
}

/**
 * Shortcodes loading
 */
include THB_CORE_SHORTCODES_DIR . '/post_type.php';
include THB_CORE_SHORTCODES_DIR . '/utility.php';
include THB_CORE_SHORTCODES_DIR . '/social.php';
include THB_CORE_SHORTCODES_DIR . '/media.php';
include THB_CORE_SHORTCODES_DIR . '/general.php';

/**
 * Widgets loading
 */
if( thb_system_is_development() ) {
	include THB_CORE_WIDGETS_DIR . '/post_type.php';
	include THB_CORE_WIDGETS_DIR . '/utility.php';
	include THB_CORE_WIDGETS_DIR . '/social.php';
	include THB_CORE_WIDGETS_DIR . '/media.php';
}

/**
 * Customization controls loading
 */
if( thb_system_is_development() ) {
	include THB_CORE_DIR . '/class.themecustomization.php';

	global $wp_customize;

	if( isset( $wp_customize ) ) {
		include THB_CORE_CUSTOMIZATION_DIR . '/controls.php';
	}
}

/**
 * Template loader configuration
 */
$thb_templates_queue = array();

if( is_child_theme() ) {
	$thb_templates_queue[] = get_stylesheet_directory() . '/' . THB_THEME_CONFIG . '/' . THB_TEMPLATES;
}

$thb_templates_queue[] = THB_THEME_TEMPLATES_DIR;
$thb_templates_queue[] = THB_TEMPLATES_DIR;

THB_TemplateLoader::$queue = $thb_templates_queue;

// Run -------------------------------------------------------------------------

if( !did_action('after_setup_theme') ) {
	add_action( 'after_setup_theme', array($thb_theme, 'run'), 9999 );
}
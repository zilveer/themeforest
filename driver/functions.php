<?php

/*-----------------------------------------------------------------------------------*/
/* Set Proper Parent/Child theme paths for inclusion
/*-----------------------------------------------------------------------------------*/


@define( 'IRON_TEXT_DOMAIN', 'driver' );
@define( 'IRON_WIDGET_PREFIX', 'DRIVER : ' );
@define( 'IRON_SIDEBAR_PREFIX', IRON_TEXT_DOMAIN . '_sidebar_' );

@define( 'IRON_PARENT_DIR', get_template_directory() );
@define( 'IRON_CHILD_DIR',  get_stylesheet_directory() );

@define( 'IRON_PARENT_URL', get_template_directory_uri() );
@define( 'IRON_CHILD_URL',  get_stylesheet_directory_uri() );

@define( 'IRON_ENVATO_ITEM_ID', ''); // HARDCODED

global $xt_styles;

/**
 * Sets up the content width value based on the theme's design.
 * @see iron_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 696;


// Load functions
require_once(IRON_PARENT_DIR.'/includes/functions.php');

// Load upgrades/migrations
require_once(IRON_PARENT_DIR.'/includes/upgrade.php');

// Load Updates
include_once(IRON_PARENT_DIR.'/admin/updates.php');

// Load Admin Panel
require_once(IRON_PARENT_DIR.'/admin/options.php');

// Load dynamic styles class
require_once(IRON_PARENT_DIR.'/includes/classes/styles.class.php');


// Load Plugin installation and activation
require_once(IRON_PARENT_DIR.'/includes/classes/tgmpa.class.php');
require_once(IRON_PARENT_DIR.'/includes/plugins.php');


// Load ACF
$acflite = get_iron_option('acf_lite');

if ( is_null($acflite) )
	$acflite = true;

define( 'ACF_LITE', (bool) $acflite );

if ( ! class_exists('acf') )
	require_once('includes/advanced-custom-fields/acf.php');

// Load Custom Post types
require_once(IRON_PARENT_DIR.'/includes/post-types.php');

// Load Taxonomies
require_once(IRON_PARENT_DIR.'/includes/taxonomies.php');

// Load Widgets
require_once(IRON_PARENT_DIR.'/includes/classes/widget.class.php');
require_once(IRON_PARENT_DIR.'/includes/widgets.php');

// Load Shortcodes
require_once(IRON_PARENT_DIR.'/includes/shortcodes.php');

// Load Visual Composer Addons
require_once(IRON_PARENT_DIR.'/includes/vc-extend/vc-custom-params.php');
require_once(IRON_PARENT_DIR.'/includes/vc-extend/vc-map.php');
require_once(IRON_PARENT_DIR.'/includes/vc-extend/vc-helpers.php');

// Load Iron Nav 
require_once(IRON_PARENT_DIR.'/includes/classes/nav.class.php');

// Load Custom Fields
require_once(IRON_PARENT_DIR.'/includes/custom-fields.php');

// Setup Theme
require_once('includes/setup.php');

// Init Customizer (Preview Only)
/*
if($_SERVER['HTTP_HOST'] == 'irontemplates.com' || $_SERVER['HTTP_HOST'] == 'driver.dev') {
	require_once('customizer/init.php');
}
*/

/*-----------------------------------------------------------------------------------*/
/* WOOCOMMERCE
/*-----------------------------------------------------------------------------------*/

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

/*-----------------------------------------------------------------------------------*/
/* PLUGINS CONTROL
/*-----------------------------------------------------------------------------------*/

add_filter('site_transient_update_plugins', 'plugin_remove_update_nag');

function plugin_remove_update_nag($value) {
	unset($value->response[ "revslider/revslider.php" ]);
	unset($value->response[ "js_composer/js_composer.php" ]);
	unset($value->response[ "nmedia-mailchimp-widget/nm_mailchimp.php" ]);
	unset($value->response[ "essential-grid/essential-grid.php" ]);
	return $value;
}

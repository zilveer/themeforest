<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Functions
*	--------------------------------------------------------------------- 
*/

// Define directories
define('MNKY_PATH', get_template_directory_uri());
define('MNKY_INCLUDE', get_template_directory() . '/inc');
define('MNKY_ADMIN', get_template_directory() . '/inc/theme-options');
define('MNKY_GLOBAL', get_template_directory() . '/inc/global');
define('MNKY_GLOBAL_URL', get_template_directory_uri() . '/inc/global');
define('MNKY_PLUGIN', get_template_directory() . '/inc/plugin');
define('MNKY_PLUGIN_URL', get_template_directory_uri() . '/inc/plugin');
define('MNKY_CSS', get_template_directory_uri() . '/inc/stylesheet');
define('MNKY_JS', get_template_directory_uri() . '/js');
define('MNKY_IMAGES', get_template_directory_uri() . '/images');

// Admin
include_once(MNKY_ADMIN . '/ot-loader.php');
include_once(MNKY_ADMIN . '/assets/theme-options.php' );
include_once(MNKY_ADMIN . '/assets/theme-options-config.php' );
include_once(MNKY_ADMIN . '/assets/google-fonts.php' );
include_once(MNKY_ADMIN . '/assets/meta-boxes.php' );

// Include basic functions & scripts
include_once(MNKY_INCLUDE . '/basic-functions.php');
include_once(MNKY_INCLUDE . '/add-scripts.php');

// Global elements
include_once(MNKY_GLOBAL . '/vector-icons.php');
include_once(MNKY_GLOBAL . '/content-elements.php');
include_once(MNKY_GLOBAL . '/sidebars.php');
include_once(MNKY_GLOBAL . '/portfolio.php');

// Plugins
include_once(MNKY_PLUGIN . '/shortcodes/shortcodes.php');
include_once(MNKY_PLUGIN . '/aq_resizer.php');
include_once(MNKY_PLUGIN . '/per-page-sidebars.php');
include_once(MNKY_PLUGIN . '/breadcrumb-trail.php');
include_once(MNKY_PLUGIN . '/widgets/recent-posts-widget.php');
include_once(MNKY_PLUGIN . '/widgets/side-menu-widget.php');
include_once(MNKY_PLUGIN . '/mobile-detect.php');
include_once(MNKY_PLUGIN . '/woocommerce/index.php');


?>
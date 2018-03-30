<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; 
}

/* Sets the path to the parent theme directory. */
define( 'THEME_DIR', get_template_directory() );

/* Sets the path to the parent theme directory URI. */
define( 'THEME_URI', get_template_directory_uri() );


// Tier 0
if( !defined('INC_DIR') )  define('INC_DIR', trailingslashit(trailingslashit(THEME_DIR) . 'includes'));
if( !defined('INC_URI') )  define('INC_URI', trailingslashit(trailingslashit(THEME_URI) . 'includes')); 
// Tier 1
define('ADMIN_DIR', trailingslashit(trailingslashit(INC_DIR) . 'admin'));
define('ADMIN_URI', trailingslashit(trailingslashit(INC_URI) . 'admin'));
define('ASSETS_DIR', trailingslashit(trailingslashit(INC_DIR) . 'assets'));
define('ASSETS_URI', trailingslashit(trailingslashit(INC_URI) . 'assets'));
// Tier 2
define('CUSTOMIZER_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'customizer'));
define('CUSTOMIZER_OPTION_SETT_DIR', trailingslashit(trailingslashit(CUSTOMIZER_DIR) . 'option-settings'));
define('CUSTOMIZER_OUTPUT_SETT_DIR', trailingslashit(trailingslashit(CUSTOMIZER_DIR) . 'output-settings'));
define('ENQUEUE_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'enqueue'));
define('CLASSES_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'classes'));
define('FUNCTIONS_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'functions'));
define('EXTENSIONS_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'extensions'));
define('EXTENSIONS_URI', trailingslashit(trailingslashit(ADMIN_URI) . 'extensions'));
define('THEME_OUTPUTS_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'theme-outputs'));

/*-----------------------------------------------------------------------------------*/
/* Load all php theme output options.                                                */
/*-----------------------------------------------------------------------------------*/
require_once THEME_OUTPUTS_DIR . 'googlefont.php';
require_once THEME_OUTPUTS_DIR . 'general-section-output.php';
require_once THEME_OUTPUTS_DIR . 'typo-section-output.php';
require_once THEME_OUTPUTS_DIR . 'customcss-section-output.php';

/*-----------------------------------------------------------------------------------*/
/* Load all php admin folder.                                                        */
/*-----------------------------------------------------------------------------------*/

require_once ADMIN_DIR . 'theme-comments.php'; 		// Custom comments/pingback loop
require_once ADMIN_DIR . 'theme-customizer.php';	// Options Panel layout settings
require_once ADMIN_DIR . 'theme-options.php'; 		// Options panel settings and custom settings
require_once ADMIN_DIR . 'theme-shortcodes.php';    // Custom theme shortcodes
require_once ADMIN_DIR . 'theme-setup.php'; 	    // Custom setup theme

/*-----------------------------------------------------------------------------------*/
/* Load all php function folder.                                                     */
/*-----------------------------------------------------------------------------------*/

require_once FUNCTIONS_DIR . 'functions-classes.php';             // init layout classes
require_once FUNCTIONS_DIR . 'functions-featured-slider.php';     // custom function featured slider
require_once FUNCTIONS_DIR . 'functions-footer.php';              // custom function header
require_once FUNCTIONS_DIR . 'functions-header.php';              // custom function header
require_once FUNCTIONS_DIR . 'functions-misc.php';  	          // custom function misc
require_once FUNCTIONS_DIR . 'functions-mobile-detect.php';       // function for detect a mobile
require_once FUNCTIONS_DIR . 'functions-page.php';                // custom function page
require_once FUNCTIONS_DIR . 'functions-post.php';                // custom function post
require_once FUNCTIONS_DIR . 'functions-post-type.php';           // custom function post type
require_once FUNCTIONS_DIR . 'functions-recipe.php';              // custom function recipe
require_once FUNCTIONS_DIR . 'functions-sidebar.php';             // init sidebar
require_once FUNCTIONS_DIR . 'functions-template.php';            // function get_template
require_once FUNCTIONS_DIR . 'functions-title-controller.php';    // load title controller for site

/*-----------------------------------------------------------------------------------*/
/* Load all php enqueue folder to load all css and js.                               */
/*-----------------------------------------------------------------------------------*/

require_once ENQUEUE_DIR . 'styles.php'; // Loads the includes/admin/enqueue/styles.php.
require_once ENQUEUE_DIR . 'script.php'; // Loads the includes/admin/enqueue/script.php.

/*-----------------------------------------------------------------------------------*/
/*	Rilwis Metabox                                                                   */
/*-----------------------------------------------------------------------------------*/

define( 'RWMB_URL', EXTENSIONS_URI . 'meta-box/' );
define( 'RWMB_DIR', EXTENSIONS_DIR . 'meta-box/' );

require_once RWMB_DIR . 'meta-box.php';
require_once RWMB_DIR . 'config-meta-boxes.php';

/*-----------------------------------------------------------------------------------*/
/*  Get the image                                                                    */
/*-----------------------------------------------------------------------------------*/
require_once EXTENSIONS_DIR . 'get-the-image.php';

/*-----------------------------------------------------------------------------------*/
/*	Mega menu                                                                        */
/*-----------------------------------------------------------------------------------*/

require_once EXTENSIONS_DIR . 'mega-menu/custom-menu.class.php';
require_once EXTENSIONS_DIR . 'mega-menu/custom-menu-admin.class.php';

$mega_menu = new Df_Mega_Menu();

/*-----------------------------------------------------------------------------------*/
/*	Tgm Plugin                                                                       */
/*-----------------------------------------------------------------------------------*/

require_once EXTENSIONS_DIR . 'tgm/class-tgm-plugin-activation.php';

/*-----------------------------------------------------------------------------------*/
/* widget all load.                                                                  */
/*-----------------------------------------------------------------------------------*/

$widgets = array(
    'includes/admin/widgets/widget-woo-adspace.php', 
    'includes/admin/widgets/widget-woo-blogauthor.php', 
    'includes/admin/widgets/widget-woo-embed.php', 
    'includes/admin/widgets/widget-woo-flickr.php',
    'includes/admin/widgets/widget-woo-contact.php',  
    'includes/admin/widgets/widget-woo-search.php', 
    'includes/admin/widgets/widget-woo-subscribe.php',
    'includes/admin/widgets/recipe-tabs-widget.php',
    'includes/admin/widgets/recipe-types-widget.php',
    'includes/admin/widgets/recent-recipe-footer-widget.php',
    'includes/admin/widgets/recent-recipe-sidebar-widget.php',
    'includes/admin/widgets/popular-recipe-widget.php',
    'includes/admin/widgets/calories-widget.php',
    'includes/admin/widgets/courses-widget.php',
    'includes/admin/widgets/cuisines-widget.php',
    'includes/admin/widgets/ingredients-widget.php',
    'includes/admin/widgets/skill-level-widget.php'
);

// Allow child themes/plugins to add widgets to be loaded.
$widgets = apply_filters('dahz_widgets', $widgets);

foreach ( $widgets as $w ) {
    locate_template( $w, true );
}

/*-----------------------------------------------------------------------------------*/
/* Load woocommrce php , if applicable..                                             */
/*-----------------------------------------------------------------------------------*/

// Load WooCommerce functions, if applicable.
if ( is_woocommerce_activated() ) :
	require_once ADMIN_DIR . 'theme-woocommerce.php'; 		// Theme widgets
endif;
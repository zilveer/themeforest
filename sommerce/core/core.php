<?php        
/**
 * Core of Framework  
 * 
 * Main includes for all framework.     
 * 
 * @package WordPress
 * @subpackage WP Framework YI
 * @since 1.0
 */
 
define( 'YIW_THEME_PATH', dirname(__FILE__) . '/../' );
define( 'YIW_FRAMEWORK_PATH', dirname(__FILE__) . '/' );
define( 'YIW_FRAMEWORK_URL', get_template_directory_uri() . '/core/' );

// paths
define( 'YIW_THEME_CSS_DIR', 	YIW_THEME_PATH . 'css/' );
define( 'YIW_THEME_JS_DIR', 	YIW_THEME_PATH . 'js/' );
define( 'YIW_THEME_IMG_DIR', 	YIW_THEME_PATH . 'images/' );
define( 'YIW_THEME_I18N_DIR', 	YIW_THEME_PATH . 'languages/' );
define( 'YIW_THEME_FUNC_DIR', 	YIW_THEME_PATH . 'inc/' );
define( 'YIW_THEME_PLUGINS_DIR', 	YIW_THEME_FUNC_DIR . 'plugins' );

// url
define( 'YIW_THEME_CSS_URL', 	get_template_directory_uri() . '/css/' );
define( 'YIW_THEME_JS_URL', 	get_template_directory_uri() . '/js/' );
define( 'YIW_THEME_IMG_URL', 	get_template_directory_uri() . '/images/' );
define( 'YIW_THEME_I18N_URL', 	get_template_directory_uri() . '/languages/' );
define( 'YIW_THEME_FUNC_URL', 	get_template_directory_uri() . '/inc/' );
 
// the configuration of theme
require_once YIW_THEME_FUNC_DIR . 'config-theme.php';
 
// core functions
require_once YIW_FRAMEWORK_PATH . 'functions-core.php';
 
// templates functions
require_once YIW_FRAMEWORK_PATH . 'functions-template.php';
 
// theme functions functions
require_once YIW_THEME_FUNC_DIR . 'functions-theme.php';
 
// functions for including widgets
require_once YIW_FRAMEWORK_PATH . 'functions-widgets.php';  
 
// all shortcodes
require_once YIW_FRAMEWORK_PATH . 'shortcodes.php';
 
// functions for including widgets
require_once YIW_FRAMEWORK_PATH . 'functions-fonts.php';
 
// functions for including widgets
require_once YIW_FRAMEWORK_PATH . 'functions-colors.php';
 
// functions for sliders management
require_once YIW_FRAMEWORK_PATH . 'functions-sliders.php';
 
// class for mobile detecting
require_once YIW_FRAMEWORK_PATH . 'mobile-detect.php';
 

/* ADMIN PANEL
------------------------------------------------------------- */

// include the post types
require_once YIW_THEME_FUNC_DIR . 'post-types.php';

// include the metaboxes
require_once YIW_FRAMEWORK_PATH . 'functions-metaboxes.php';

// include the metaboxes
require_once YIW_FRAMEWORK_PATH . 'theme-options/yiw-panel.php';

// include widgets for dashboard
require_once YIW_FRAMEWORK_PATH . 'functions-dashboard.php';

// notify when there is some update for the theme
require_once YIW_FRAMEWORK_PATH . 'notifier/update-notifier.php';   
 
// functions for the contact forms manage
require_once YIW_FRAMEWORK_PATH . 'sendemail.php';  
 
// functions for the contact forms manage
require_once YIW_FRAMEWORK_PATH . 'tinymce/tinymce.php'; 
                                                        
 
// settings of framework
require_once YIW_FRAMEWORK_PATH . 'settings.php';
 
// all filters and actions
require_once YIW_FRAMEWORK_PATH . 'hooks.php';

?>
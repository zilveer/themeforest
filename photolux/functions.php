<?php

/**
 * Functions
 * 
 * This is the main functions file that can add some additional functionality to the theme.
 * It calls an object from a manager class that inits all the needed functionality.
 */

//declare some global variables that will be used everywhere
$new_meta_boxes=array();
$new_meta_post_boxes=array();
$new_meta_portfolio_boxes=array();
$pexeto_buttons=array();
$pexeto_data=new stdClass();
$pexeto_scripts_to_print=array();


/*----------------------------------------------------------------
 *  DEFINE THE MAIN CONSTANTS
 *---------------------------------------------------------------*/

//main theme info constants
define("PEXETO_THEMENAME", 'Photolux');
define("PEXETO_SHORTNAME", 'photolux');

$theme_data = wp_get_theme();
define("PEXETO_VERSION", $theme_data->Version);

//define the main paths and URLs
define("PEXETO_LIB_PATH", TEMPLATEPATH . '/lib/');
define("PEXETO_LIB_URL", get_template_directory_uri().'/lib/');
define("PEXETO_FRONT_SCRIPT_URL", get_template_directory_uri().'/js/');

define("PEXETO_FUNCTIONS_PATH", PEXETO_LIB_PATH . 'functions/');
define("PEXETO_FUNCTIONS_URL", PEXETO_LIB_URL.'functions/');
define("PEXETO_CLASSES_PATH", PEXETO_LIB_PATH.'classes/');
define("PEXETO_OPTIONS_PATH", PEXETO_LIB_PATH.'options/');
define("PEXETO_PLUGINS_PATH", PEXETO_LIB_PATH.'plugins/');
define("PEXETO_UTILS_URL", PEXETO_LIB_URL.'utils/');
define("PEXETO_TIMTHUMB_URL", PEXETO_UTILS_URL.'timthumb.php');

define("PEXETO_IMAGES_URL", PEXETO_LIB_URL.'images/');
define("PEXETO_FRONT_IMAGES_URL", get_template_directory_uri().'/images/');
define("PEXETO_CSS_URL", PEXETO_LIB_URL.'css/');
define("PEXETO_SCRIPT_URL", PEXETO_LIB_URL.'js/');
define("PEXETO_PATTERNS_URL", PEXETO_IMAGES_URL.'pattern_samples/');
$uploadsdir=wp_upload_dir();
define("PEXETO_UPLOADS_URL", $uploadsdir['url']);

//other constants
define("PEXETO_PORTFOLIO_POST_TYPE", 'portfolio');
define("PEXETO_SEPARATOR", '|*|');
define("PEXETO_OPTIONS_PAGE", 'pexeto_options');
define("PEXETO_GOOGLE_FONTS", "http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700".PEXETO_SEPARATOR);


if(basename($_SERVER['PHP_SELF']) != 'update-core.php'){
require('update-notifier.php');
}

/*----------------------------------------------------------------
 *  INCLUDE THE FUNCTIONS FILES
 *---------------------------------------------------------------*/

require_once (PEXETO_LIB_PATH.'utils/aq_resizer.php');  //image resizing script
require_once (PEXETO_LIB_PATH.'utils/image-crop-from-position.php');  //image resizing script

if(is_admin()){
	require_once (PEXETO_CLASSES_PATH.'class-pexeto-order-manager.php');
	require_once (PEXETO_FUNCTIONS_PATH.'init-admin.php');  //the init functionality for the admin section
}
require_once (PEXETO_FUNCTIONS_PATH.'init-front.php');  //the init functionality for the front-end section

require_once (PEXETO_FUNCTIONS_PATH.'general.php');  //some main common functions
require_once (PEXETO_FUNCTIONS_PATH.'sidebars.php');  //the sidebar functionality
if ( isset($_GET['page']) && $_GET['page'] == PEXETO_OPTIONS_PAGE ){
	require_once (PEXETO_CLASSES_PATH.'pexeto-options-manager.php');  //the theme options manager functionality
}

require_once (PEXETO_CLASSES_PATH.'pexeto-templater.php');  
require_once (PEXETO_CLASSES_PATH.'pexeto-custom-data-manager.php');  
require_once (PEXETO_CLASSES_PATH.'pexeto-custom-page.php');  
require_once (PEXETO_CLASSES_PATH.'pexeto-custom-page-manager.php');  
require_once (PEXETO_FUNCTIONS_PATH.'custom-pages.php');  //the custom post types (sliders) functionality

require_once (PEXETO_FUNCTIONS_PATH.'ajax.php');  //AJAX handler functions
require_once (PEXETO_FUNCTIONS_PATH.'portfolio.php');  //portfolio functionality
require_once (PEXETO_FUNCTIONS_PATH.'options.php');  //the theme options functionality
require_once (PEXETO_FUNCTIONS_PATH.'comments.php');  //the comments functionality


require_once (PEXETO_FUNCTIONS_PATH.'meta.php');  //adds the custom meta fields to the posts and pages
require_once (PEXETO_FUNCTIONS_PATH.'shortcodes.php');  //the shortcodes functionality
require_once ('includes/send-email.php');

function pexeto_load_captcha_lib() {
	require_once PEXETO_LIB_PATH.'utils/recaptchalib.php';
}

if(!is_admin()){
	require_once(TEMPLATEPATH.'/css/cssLoader.php');
}



?>
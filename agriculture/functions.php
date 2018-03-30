<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Main Theme Functions File
 * Created by CMSMasters
 * 
 */


// Current Theme Constants
define('CMSMS_SHORTNAME', 'agriculture');
define('CMSMS_FULLNAME', 'Agriculture');


// CMSMasters Framework Directories Constants
define('CMSMS_FRAMEWORK', get_template_directory() . '/framework');
define('CMSMS_ADMIN', CMSMS_FRAMEWORK . '/admin');
define('CMSMS_COMPOSER', CMSMS_ADMIN . '/composer');
define('CMSMS_SETTINGS', CMSMS_ADMIN . '/settings');
define('CMSMS_OPTIONS', CMSMS_ADMIN . '/options');
define('CMSMS_ADMIN_INC', CMSMS_ADMIN . '/inc');
define('CMSMS_CLASS', CMSMS_FRAMEWORK . '/class');
define('CMSMS_FUNCTION', CMSMS_FRAMEWORK . '/function');



// Load Theme Local File
$locale = get_locale();

if (is_admin()) {
    load_theme_textdomain('cmsmasters', CMSMS_ADMIN_INC . '/languages');
	
    $locale_file = CMSMS_ADMIN_INC . '/languages/' . $locale . '.php';
} else {
    load_theme_textdomain('cmsmasters', CMSMS_FRAMEWORK . '/languages');
	
    $locale_file = CMSMS_FRAMEWORK . '/languages/' . $locale . '.php';
}

if (is_readable($locale_file)) {
    require_once($locale_file);
}



// Load Framework Parts
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings.php');

require_once(CMSMS_OPTIONS . '/cmsms-theme-options.php');

require_once(CMSMS_COMPOSER . '/cmsms-content-composer.php');

require_once(CMSMS_ADMIN_INC . '/editor-additions.php');

require_once(CMSMS_ADMIN_INC . '/admin-scripts.php');

require_once(CMSMS_ADMIN_INC . '/plugin-activator.php');

require_once(CMSMS_CLASS . '/projects-posttype.php');

require_once(CMSMS_CLASS . '/testimonials-posttype.php');

require_once(CMSMS_CLASS . '/widgets-default.php');

require_once(CMSMS_CLASS . '/widgets.php');

require_once(CMSMS_CLASS . '/shortcodes.php');

require_once(CMSMS_CLASS . '/likes.php');

require_once(CMSMS_FUNCTION . '/breadcrumbs.php');

require_once(CMSMS_FUNCTION . '/pagination.php');

require_once(CMSMS_FUNCTION . '/single-comment.php');

require_once(CMSMS_FUNCTION . '/theme-functions.php');

require_once(CMSMS_FUNCTION . '/template-functions.php');


// Woocommerce functions
if (class_exists('woocommerce')) {
	require_once(get_template_directory() . '/woocommerce/cmsms-woocommerce-functions.php');
}


// Framework Activation Import
if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
	cmsms_add_global_options();
	
	require_once(CMSMS_ADMIN_INC . '/database-import.php');
}


// Theme Settings System Fonts List
function cmsms_system_fonts_list() {
	$fonts = array( 
		"Arial, Helvetica, 'Nimbus Sans L', sans-serif" => 'Arial', 
		"Calibri, 'AppleGothic', 'MgOpen Modata', sans-serif" => 'Calibri', 
		"'Trebuchet MS', Helvetica, Garuda, sans-serif" => 'Trebuchet MS', 
		"'Comic Sans MS', Monaco, 'TSCu_Comic', cursive" => 'Comic Sans MS', 
		"Georgia, Times, 'Century Schoolbook L', serif" => 'Georgia', 
		"Verdana, Geneva, 'DejaVu Sans', sans-serif" => 'Verdana', 
		"Tahoma, Geneva, Kalimati, sans-serif" => 'Tahoma', 
		"'Lucida Sans Unicode', 'Lucida Grande', Garuda, sans-serif" => 'Lucida Sans', 
		"'Times New Roman', Times, 'Nimbus Roman No9 L', serif" => 'Times New Roman', 
		"'Courier New', Courier, 'Nimbus Mono L', monospace" => 'Courier New' 
	);
	
	return $fonts;
}


// Theme Settings Google Fonts List
function cmsms_google_fonts_list() {
	$fonts = array( 
		'' => __('None', 'cmsmasters'), 
		'Headland+One' => 'Headland One', 
		'BenchNine:400,700' => 'BenchNine', 
		'Open+Sans:300,300italic,400,400italic,700,700italic' => 'Open Sans', 
		'Droid+Sans:400,700' => 'Droid Sans', 
		'Droid+Serif:400,400italic,700,700italic' => 'Droid Serif', 
		'Lobster' => 'Lobster', 
		'PT+Sans:400,400italic,700,700italic' => 'PT Sans', 
		'Ubuntu:400,400italic,700,700italic' => 'Ubuntu', 
		'Open+Sans+Condensed:300,300italic,700' => 'Open Sans Condensed', 
		'Lato:400,400italic,700,700italic' => 'Lato', 
		'PT+Sans+Narrow:400,700' => 'PT Sans Narrow', 
		'Cuprum:400,400italic,700,700italic' => 'Cuprum' 
	);
	
	return $fonts;
}


// Theme Settings Font Weights List
function cmsms_font_weight_list() {
	$list = array( 
		'normal' => 'normal', 
		'100' => '100', 
		'200' => '200', 
		'300' => '300', 
		'400' => '400', 
		'500' => '500', 
		'600' => '600', 
		'700' => '700', 
		'800' => '800', 
		'900' => '900', 
		'bold' => 'bold', 
		'bolder' => 'bolder', 
		'lighter' => 'lighter' 
	);
	
	return $list;
}


// Theme Settings Font Styles List
function cmsms_font_style_list() {
	$list = array( 
		'normal' => 'normal', 
		'italic' => 'italic', 
		'oblique' => 'oblique', 
		'inherit' => 'inherit' 
	);
	
	return $list;
}


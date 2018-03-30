<?php
/*
Author: Multia-Studio
URL: http://multia.in/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

//Define constants
define('SITE_URL', home_url().'/');
define('AJAX_URL', admin_url('admin-ajax.php'));
define('THEME_PATH', get_template_directory().'/');
define('BLOG_ADMIN_EMAIL', get_option('admin_email'));
define('CHILD_PATH', get_stylesheet_directory().'/');
define('THEME_URI', get_template_directory_uri().'/');
define('CHILD_URI', get_template_directory_uri().'/');
define('MTHEME_PATH', THEME_PATH.'mtheme/');
define('MTHEME_URI', THEME_URI.'mtheme/');
define('MTHEME_ASSESTS', THEME_URI.'mtheme/assets/');
define('MTHEME_CSS', THEME_URI.'mtheme/assets/css/');
define('MTHEME_JS', THEME_URI.'mtheme/assets/js/');
define('MTHEME_IMAGES', THEME_URI.'mtheme/assets/images/');
define('MTHEME_PREFIX', 'mtheme_');
define('WP_ALLOW_REPAIR', true);


//Set content width
$content_width=1170;

//Include theme functions
include(MTHEME_PATH.'functions.php');

//Include configuration
include(MTHEME_PATH.'config.php');

//Include core class
include(MTHEME_PATH.'classes/mtheme.core.php');

//Create theme instance
$mtheme=new MthemeCore($config);
/* DON'T DELETE THIS CLOSING TAG */

/*Load language files*/
load_theme_textdomain('mtheme', THEME_PATH.'languages');

add_editor_style();
/* Add theme support */
add_theme_support( "title-tag" ) ;
add_theme_support( "post-thumbnails" ) ;
add_theme_support( "automatic-feed-links" );
add_theme_support( "custom-header");
add_theme_support( "custom-background");
/* Add theme support */

/** Plugin Activation */
if( is_admin() )
require_once(get_template_directory().DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'plugins.php');
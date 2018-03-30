<?php
/**
 * @package by Theme Record
 * @auther: MattMao
*/
if(! session_id())
{ 
	session_start(); 
}

#
#Set theme constants
#
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());
define('THEME_NAME', 'Rover');
define('THEME_SLUG', 'rover');
define('THEME_FOLDER_NAME', 'rover');
define('THEME_VERSION', '2.6');


#
#Set folder constants
#
define('ASSETS_URI', THEME_URI. '/assets');
define('MODULES_DIR', THEME_DIR. '/modules');
define('PHP_DIR', THEME_DIR. '/php');
define('LANG_DIR', THEME_DIR. '/languages');
define('FUNCTIONS_DIR', THEME_DIR. '/functions');
define('FUNCTIONS_URI', THEME_URI. '/functions');


require_once(FUNCTIONS_DIR.'/themes.php');
require_once(MODULES_DIR.'/portfolio.php');
require_once(MODULES_DIR.'/blog-slide.php');
require_once(MODULES_DIR.'/portfolio-slide.php');
require_once(MODULES_DIR.'/product-slide.php');
require_once(MODULES_DIR.'/slideshow.php');
require_once(MODULES_DIR.'/slogan.php');
require_once(PHP_DIR.'/header.php');
require_once(PHP_DIR.'/footer.php');
require_once(PHP_DIR.'/page-header.php');
require_once(PHP_DIR.'/pagination.php');
require_once(PHP_DIR.'/sidebar.php');
require_once(PHP_DIR.'/related-posts.php');
require_once(PHP_DIR.'/extend-css.php');
require_once(PHP_DIR.'/comments.php');
require_once(PHP_DIR.'/content-gallery.php');
require_once(PHP_DIR.'/content-image.php');
require_once(PHP_DIR.'/content-video.php');
require_once(PHP_DIR.'/format-audio.php');
require_once(PHP_DIR.'/format-gallery.php');
require_once(PHP_DIR.'/format-image.php');
require_once(PHP_DIR.'/format-link.php');
require_once(PHP_DIR.'/format-quote.php');
require_once(PHP_DIR.'/format-video.php');

?>
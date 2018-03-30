<?php
define('TEXTDOMAIN', 'profession');
define('THEME_SLUG', 'Pr');

/**************************************************
	FOLDERS
**************************************************/

define('THEME_DIR',         get_template_directory());
define('THEME_LIB',			THEME_DIR . '/lib');
define('THEME_ADMIN',		THEME_LIB . '/admin');
define('THEME_LANGUAGES',	THEME_LIB . '/languages');
define('THEME_CACHE',	    THEME_DIR . '/cache');
define('THEME_ASSETS',   	THEME_DIR . '/assets');
define('THEME_JS',			THEME_ASSETS . '/js');
define('THEME_CSS',			THEME_ASSETS . '/css');
define('THEME_IMAGES',		THEME_ASSETS . '/img');

/**************************************************
	FOLDER URI
**************************************************/

define('THEME_URI',		    	get_template_directory_uri());
define('THEME_LIB_URI',		    THEME_URI . '/lib');
define('THEME_ADMIN_URI',	    THEME_LIB_URI . '/admin');
define('THEME_LANGUAGES_URI',	THEME_LIB_URI . '/languages');
define('THEME_CACHE_URI',	    THEME_URI     . '/cache');
define('THEME_ASSETS_URI',	    THEME_URI     . '/assets');
define('THEME_JS_URI',			THEME_ASSETS_URI . '/js');
define('THEME_CSS_URI',			THEME_ASSETS_URI . '/css');
define('THEME_IMAGES_URI',		THEME_ASSETS_URI . '/img');

/**************************************************
	Text Domain
**************************************************/

load_theme_textdomain( TEXTDOMAIN, THEME_DIR . '/languages' );

/**************************************************
	Content Width
**************************************************/

if ( !isset( $content_width ) ) $content_width = 940;

/**************************************************
	LIBRARIES
**************************************************/

include_once(THEME_LIB . '/theme-constants.php');
include_once(THEME_LIB . '/utilities.php');
include_once(THEME_LIB . '/theme-customPart-post-type.php');
include_once(THEME_LIB . '/theme-customPart-meta.php');
include_once(THEME_LIB . '/theme-page-meta.php');
include_once(THEME_LIB . '/portfolio-walker.php');
include_once(THEME_LIB . '/theme-portfolio-post-type.php');
include_once(THEME_LIB . '/theme-portfolio-meta.php');
include_once(THEME_LIB . '/theme-post-meta.php');
include_once(THEME_LIB . '/nav-walker.php');
include_once(THEME_LIB . '/theme-sidebars.php');
include_once(THEME_LIB . '/theme-support.php');
include_once(THEME_LIB . '/theme-scripts.php');
include_once(THEME_LIB . '/widget-search.php');
include_once(THEME_LIB . '/widget-flickr.php');
include_once(THEME_LIB . '/widget-video.php');
include_once(THEME_LIB . '/shortcodes.php');
include_once(THEME_LIB . '/tinymce/mcewrapper.php');
include_once(THEME_ADMIN . '/admin.php');

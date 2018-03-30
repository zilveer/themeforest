<?php
/**
* 
* Theme functions 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
* Define Theme Constants
*****************************************/
define('VAN_THEME_DIR', get_template_directory());
define('VAN_THEME_URI', get_template_directory_uri());

define ('VAN_ADMIN', VAN_THEME_DIR .  "/admin");
define ('VAN_PANEL', VAN_ADMIN . "/options-panel");
define ('VAN_WIDGETS', VAN_ADMIN . "/widgets");
define ('VAN_SHORTCODES', VAN_ADMIN . "/shortcodes");
define ('VAN_META', VAN_ADMIN . "/metaboxes");
define ('VAN_FUNCTIONS', VAN_THEME_DIR . "/functions");
define ('VAN_SCRIPTS', VAN_THEME_DIR . "/scripts");

define('VAN_JS', VAN_THEME_URI . "/assets/js");
define('VAN_CSS', VAN_THEME_URI . "/assets/css");
define('VAN_IMG', VAN_THEME_URI . "/assets/images");

define('VAN_ADMIN_URI', VAN_THEME_URI . "/admin");
define('ADMIN_ASSETS', VAN_THEME_URI . "/admin/assets");
define('ADMIN_JS', VAN_THEME_URI . "/admin/assets/js");
define('ADMIN_IMG', VAN_THEME_URI . "/admin/assets/images");

/**
*      Load Theme Setup
*********************************************/
require VAN_FUNCTIONS . "/theme-setup.php";

/**
*	Load necessary functions
******************************************/

require_once VAN_FUNCTIONS . "/global-functions.php";
require_once VAN_FUNCTIONS . "/theme-functions.php";
require_once VAN_FUNCTIONS . "/media.php";
require_once VAN_FUNCTIONS . "/theme-widgets.php";
require_once VAN_FUNCTIONS . "/user-profile.php";
require_once VAN_FUNCTIONS  . "/comments-style.php";
require_once VAN_FUNCTIONS  . "/social-api.php";
require_once VAN_FUNCTIONS . "/theme-styling.php";

/**
*	Options panel  
******************************************/

require VAN_PANEL . "/panel.class.php";
require VAN_PANEL . "/panel-init.php";

/**
*	Shortcodes
******************************************/

require VAN_SHORTCODES  . "/shortcodes.php";
require VAN_ADMIN  . "/tinymce/tiny-functions.php";

/**
*   widgets
******************************************/

require VAN_WIDGETS  . "/widgets.php";

/**
*	Meta Box
******************************************/
require VAN_META . "/metaboxes-init.php";

/*
* Update Notifier
****************************************/
if( van_get_option("update_notifier") && is_admin() ){
	require_once VAN_ADMIN . "/update-notifier/update-notifier.php";
}
?>
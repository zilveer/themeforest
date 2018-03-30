<?php
/*-----------------------------OPTIONS CORE------------------------------*/
require_once get_template_directory().'/framework/core.options.php';
/*-----------------------------POST TYPE------------------------------*/
/**
* Post Type Header
*/
require_once get_template_directory().'/framework/views/posttype/header.php';
/**
* Post Type Portfolio
*/
require_once get_template_directory().'/framework/views/posttype/portfolio.php';
/**
 * Post Type Restaurantmenu
 */
require_once get_template_directory().'/framework/views/posttype/restaurantmenu.php';
/**
 * Post Type Point of Sale
 */
require_once get_template_directory().'/framework/views/posttype/pointofsale.php';
/*-------------------------------LIB--------------------------------*/
/**
* Lib resize images
*/
require_once get_template_directory().'/framework/includes/mr-image-resize.php';
require_once get_template_directory().'/framework/includes/resize.php';
/**
 *
 */
require_once get_template_directory().'/framework/includes/post_favorite.php';
/*------------------------------PLUGIN----------------------------*/
/**
 * Social Sharing
 */
require_once get_template_directory().'/framework/plugins/socialsharing/socialsharing.php';
/*---------------------------------POST-------------------------------*/
/**
 * multiple-blog
 */
require_once get_template_directory().'/framework/templates/multiple-blog.php';
/*---------------------------------VC-------------------------------*/
/**
 * Vc extra shorcodes
 */
if (function_exists("vc_map")){
	require_once get_template_directory().'/framework/includes/vc_extra_shorcodes.php';
}
/**
* Vc extra Fields
*/
if (function_exists("vc_add_shortcode_param")){
	require_once get_template_directory().'/framework/includes/vc_extra_fields.php';
}
/**
* Vc extra params
*/
if (function_exists("vc_add_param")){
	require_once get_template_directory().'/framework/includes/vc_extra_params.php';
}
/*------------------------------Extra Fields----------------------------*/
/**
 * Metaboxes
 */
require_once get_template_directory().'/framework/metaboxes.php';
/**
 * Taxonomys Extra Fields
 */
require_once get_template_directory().'/framework/views/extrafields/taxonomys.php';


/*--------------------------------Mega Menu------------------------------*/
require_once get_template_directory().'/framework/megamenu/mega-menu.php';
/*------------------------------Load Shortcodes--------------------------*/
require_once get_template_directory() . '/framework/shortcodes/shortcodes.php' ;
/*-------------------------------Load Widgets----------------------------*/
get_template_part('framework/widgets');
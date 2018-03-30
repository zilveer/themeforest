<?php
/**
*	init.php
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	1.0 - TMG plugin activation
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_FRAMEWORK . '/class-tgm-plugin-activation.php' );
require_once( FAVE_FRAMEWORK . '/register-plugins.php' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	2.0 - Register Script
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_FUNCTION . '/register-scripts.php' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	3.0 - Visual Composer
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
if (is_plugin_active('js_composer/js_composer.php')) {

	// vc_disable_frontend();

	function fave_include_composer() {
		require_once( FAVE_FRAMEWORK . '/vc_extend.php' );
	}
	add_action('init', 'fave_include_composer', 9999);
}

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	4.0 - VC Shortcodes
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/

locate_template('framework/vc_shortcodes/post-slider.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/post-slider.php' );
locate_template('framework/vc_shortcodes/magzilla-grids.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/magzilla-grids.php' );
locate_template('framework/vc_shortcodes/ad_box.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/ad_box.php' );
locate_template('framework/vc_shortcodes/module-1.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-1.php' );
locate_template('framework/vc_shortcodes/module-2.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-2.php' );
locate_template('framework/vc_shortcodes/module-3.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-3.php' );
locate_template('framework/vc_shortcodes/module-4.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-4.php' );
locate_template('framework/vc_shortcodes/module-5.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-5.php' );
locate_template('framework/vc_shortcodes/module-6.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-6.php' );
locate_template('framework/vc_shortcodes/module-7.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-7.php' );
locate_template('framework/vc_shortcodes/module-8.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-8.php' );
locate_template('framework/vc_shortcodes/module-9.php', true);//require_once( FAVE_FRAMEWORK . '/vc_shortcodes/module-9.php' );

if (is_plugin_active('favethemes-theme-functionality/favethemes-theme-functionality.php')) {
	locate_template('framework/vc_shortcodes/video-module-1.php', true);//require_once(FAVE_FRAMEWORK . '/vc_shortcodes/video-module-1.php');
	locate_template('framework/vc_shortcodes/video-module-2.php', true);//require_once(FAVE_FRAMEWORK . '/vc_shortcodes/video-module-2.php');
	locate_template('framework/vc_shortcodes/video-module-3.php', true);//require_once(FAVE_FRAMEWORK . '/vc_shortcodes/video-module-3.php');
	locate_template('framework/vc_shortcodes/video-gallery.php', true);//require_once(FAVE_FRAMEWORK . '/vc_shortcodes/video-gallery.php');

	locate_template('framework/vc_shortcodes/gallery-module-1.php', true);//require_once(FAVE_FRAMEWORK . '/vc_shortcodes/gallery-module-1.php');
	locate_template('framework/vc_shortcodes/gallery-module-2.php', true);//require_once(FAVE_FRAMEWORK . '/vc_shortcodes/gallery-module-2.php');
	locate_template('framework/vc_shortcodes/gallery-module-3.php', true);//require_once(FAVE_FRAMEWORK . '/vc_shortcodes/gallery-module-3.php');
	locate_template('framework/vc_shortcodes/custom-post-gallery.php', true);//require_once(FAVE_FRAMEWORK . '/vc_shortcodes/custom-post-gallery.php');
}


/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	5.0 - Functions
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_FRAMEWORK . '/fave_functions.php' );
require_once( FAVE_FUNCTION . '/fave-views.php' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	6.0 - Classes
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_FRAMEWORK . '/classes/fave_data_source.php' );
require_once( FAVE_FRAMEWORK . '/classes/fave_video_post_type_data_source.php' );
require_once( FAVE_FRAMEWORK . '/classes/fave_gallery_post_type_data_source.php' );


/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	7.0 - Category And Pages Meta Box
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_FRAMEWORK . '/category-meta.php' );
require_once( FAVE_FRAMEWORK . '/page-meta.php' );
require_once( FAVE_FRAMEWORK . '/video-categories-meta.php' );
require_once( FAVE_FRAMEWORK . '/gallery-categories-meta.php' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	9.0 - Image Resize
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_FRAMEWORK . '/favethemes_image_resizer.php' );


/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	10.0 - Include Metabox framework
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/framework/meta-box' ) );

require_once ( RWMB_DIR . 'meta-box.php' );
require_once ( RWMB_DIR . '/fave-meta.php' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	12.0 - Menu Walkers
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
locate_template('inc/megamenu/menu-walker-edit.php', true);//require_once( FAVE_FUNCTION . '/megamenu/menu-walker-edit.php' );
locate_template('inc/megamenu/menu-walker.php', true);//require_once( FAVE_FUNCTION . '/megamenu/menu-walker.php' );
locate_template('inc/secondary-walker.php', true);//require_once( FAVE_FUNCTION . '/secondary-walker.php' );
locate_template('inc/mobile-walker.php', true);//require_once( FAVE_FUNCTION . '/mobile-walker.php' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	14.0 - Theme Options
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_ADMIN. '/index.php' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	15.0 - Styling Options
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
locate_template('inc/styling-options.php', true);//require_once( FAVE_FUNCTION. '/styling-options.php' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	16.0 - Google Fonts
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_FRAMEWORK. '/google-fonts.php' );

/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	17.0 - One Click Demo Install
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
require_once( FAVE_FUNCTION. '/one-click-install/init.php' );

/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	18.0 - Twitter Oauth
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if(!class_exists('TwitterOAuth',false)) {
	require_once( FAVE_FUNCTION . '/twitteroauth/twitteroauth.php' );
}

?>
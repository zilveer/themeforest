<?php
/*
Title		: SMOF
Description	: Slightly Modified Options Framework
Version		: 1.4.4
Author		: Syamil MJ
Author URI	: http://aquagraphite.com
License		: GPLv3 - http://www.gnu.org/copyleft/gpl.html
Credits		: Thematic Options Panel - http://wptheming.com/2010/11/thematic-options-panel-v2/
		 	  KIA Thematic Options Panel - https://github.com/helgatheviking/thematic-options-KIA
		 	  Woo Themes - http://woothemes.com/
		 	  Option Tree - http://wordpress.org/extend/plugins/option-tree/
*/

/**
 * Definitions
 *
 * @since 1.4.0
 */
$theme_version = '';
	    
if ( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}

	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');
} else {
	$theme_data = get_theme_data( IYB_TEMPLATE_DIR . '/style.css' );
	$theme_version = $theme_data['Version'];
	$theme_name = $theme_data['Name'];
	$theme_uri = $theme_data['ThemeURI'];
	$author_uri = $theme_data['AuthorURI'];
}

// Added by IshYoBoy
$smof_wpml_default_lng = '';
$smof_wpml_prefix = '';

global $sitepress;
if ( is_object( $sitepress ) ){
    $smof_wpml_default_lng = $sitepress->get_default_language();

    if ( is_admin() && isset($_POST['wpml_lang']) ){
        // Read the language parameter we have set, as WMPL ignores the current admin language in ajax calls
        $cur_language = $_POST['wpml_lang'];
    }else{
        $cur_language = ICL_LANGUAGE_CODE;
    }
}

if(( isset($cur_language) && $smof_wpml_default_lng != $cur_language) && 'all' != $cur_language && "" != $cur_language)
{
    $smof_wpml_prefix = "_" . $cur_language;
    define( 'ISH_LNG', $cur_language);
    define( 'ISH_PREFIX', $smof_wpml_prefix);
}else{
    define( 'ISH_LNG', '');
    define( 'ISH_PREFIX', '');
}

define( 'SMOF_VERSION', '1.4.2' );
define( 'ADMIN_PATH', IYB_TEMPLATE_DIR . '/admin/' );
define( 'ADMIN_DIR', IYB_TEMPLATE_URI . '/admin/' );
define( 'LAYOUT_PATH', ADMIN_PATH . 'layouts/' );
define( 'THEMENAME', $theme_name );
/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'THEMEVERSION', $theme_version );
define( 'THEMEURI', $theme_uri );
define( 'THEMEAUTHORURI', $author_uri );

// Updated by IshYoBoy
define( 'OPTIONS_BASE', $theme_name . '_options');
define( 'BACKUPS_BASE', $theme_name . '_backups');
define( 'GENERATEDCSS_BASE', 'ishyoboy_' . $theme_name . '_generated_css_version');

define( 'OPTIONS', OPTIONS_BASE . $smof_wpml_prefix );
define( 'BACKUPS', BACKUPS_BASE . $smof_wpml_prefix );
define( 'GENERATEDCSS', GENERATEDCSS_BASE . $smof_wpml_prefix );

/**
 * Required action filters
 *
 * @uses add_action()
 *
 * @since 1.0.0
 */
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) add_action('admin_head','of_option_setup');
add_action('admin_head', 'optionsframework_admin_message');
add_action('admin_init','optionsframework_admin_init');
add_action('admin_menu', 'optionsframework_add_admin');
add_action( 'init', 'optionsframework_mlu_init');

// Added by IshYoBoy
if ( ! function_exists( 'ishyoboy_admin_bar_render' ) ) {
    function ishyoboy_admin_bar_render() {
    if ( current_user_can('edit_theme_options') ) {
        global $wp_admin_bar;

        $wp_admin_bar->add_menu( array(
            'id'    => 'ishyoboy-options',
            'title' => __( 'Theme Options', 'ishyoboy' ),
            'href'  => admin_url('themes.php?page=optionsframework'),
            'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
        ));

        /*
        $wp_admin_bar->add_menu( array(
            'id'    => 'my-link-sub-1',
            'title' => 'Sublink 1',
            'href'  => admin_url(),
            'parent'=>'ishyoboy-options',
            'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
        ));
        /**/
    }
}
}
add_action( 'wp_before_admin_bar_render', 'ishyoboy_admin_bar_render');

/**
 * Required Files
 *
 * @since 1.0.0
 */ 
require_once ( ADMIN_PATH . 'functions/functions.load.php' );
require_once ( ADMIN_PATH . 'classes/class.options_machine.php' );

/**
 * AJAX Saving Options
 *
 * @since 1.0.0
 */
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

?>

<?php
/**
 * G5Plus Theme Framework includes
 *
 * The $g5plus_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link http://g5plus.net
 */

define( 'HOME_URL', trailingslashit( home_url() ) );
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URL', trailingslashit( get_template_directory_uri() ) );


function g5plus_check_vc_status() {
	include_once(ABSPATH.'wp-admin/includes/plugin.php');
	if(is_plugin_active('js_composer/js_composer.php')) {
		return true;
	}
	else{
		return false;
	}
}
zorka_include_one();
// include lib for theme framework
function zorka_include_one() {
	require_once( THEME_DIR . 'lib/install-demo/install-demo.php');
    require_once( THEME_DIR . 'admin/index.php'); // SMOF theme options
	require_once( THEME_DIR . 'lib/common-lib.php'); // Common functions
    require_once( THEME_DIR . 'lib/tax-meta.php'); // tax-meta
	require_once( THEME_DIR . 'lib/widgets.php'); // Utility functions
	require_once( THEME_DIR . 'lib/sidebar.php'); // Register Sidebar
    require_once( THEME_DIR . 'lib/breadcrumb.php'); // Register Sidebar
	require_once( THEME_DIR . 'lib/ajax-action/search-ajax-action.php'); // search ajax action
	require_once( THEME_DIR . 'lib/ajax-action/search-product-ajax-action.php'); // search ajax action
    require_once( THEME_DIR . 'lib/ajax-action/register-ajax-action.php'); // search ajax action
	require_once( THEME_DIR . 'lib/ajax-action/login-link-action.php'); // search ajax action
    require_once( THEME_DIR . 'lib/template-tags.php'); // Plugin installation and activation for WordPress themes
    require_once( THEME_DIR . 'lib/filter.php'); // register filter
    require_once( THEME_DIR . 'lib/woocommerce-lib.php'); // Plugin installation and activation for WordPress themes
    require_once( THEME_DIR . 'lib/inc-functions/theme-setup.php'); // Plugin installation and activation for WordPress themes
    require_once( THEME_DIR . 'lib/inc-functions/register-require-plugin.php'); // Plugin installation and activation for WordPress themes
    require_once( THEME_DIR . 'lib/inc-functions/enqueue-script-css.php'); // Plugin installation and activation for WordPress themes
    require_once( THEME_DIR . 'lib/inc-functions/use-less-js.php'); // Plugin installation and activation for WordPress themes
    require_once( THEME_DIR . 'lib/inc-functions/resize.php');
    require_once( THEME_DIR . 'lib/meta-box.php');
	if( g5plus_check_vc_status() == true) {
		require_once(THEME_DIR. 'lib/vc-functions.php');
	}
}
function zorka_vc_remove_wp_admin_bar_button() {
    remove_action( 'admin_bar_menu', array( vc_frontend_editor(), 'adminBarEditLink' ), 1000 );
}
add_action( 'vc_after_init', 'zorka_vc_remove_wp_admin_bar_button' );


if(!function_exists('zorka_template_loop_product_thumbnail')){
    function zorka_template_loop_product_thumbnail($width=330, $height=440){
        global $post;
        if ( has_post_thumbnail() ) {
            $post_thumbnail_id = get_post_thumbnail_id($post->ID);
            $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
            if(count($arrImages)>0){
                $resize = matthewruddy_image_resize($arrImages[0], $width, $height);
                if($resize!=null ){
                    echo sprintf('<img src="%s" width="%s" height="%s" alt="%s" />',$resize['url'], $width, $height, $post->post_title);
                }
            }
        } elseif ( wc_placeholder_img_src() ) {
            return wc_placeholder_img( 'shop_thumbnail' );
        }
    }
}

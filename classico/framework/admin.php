<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Add admin styles and scripts
// **********************************************************************// 

if(!function_exists('etheme_load_admin_styles')) {
	add_action( 'admin_enqueue_scripts', 'etheme_load_admin_styles', 150 );
	function etheme_load_admin_styles() {
		global $pagenow;
	    wp_enqueue_style('farbtastic');
	    $depends = '';
	    if(class_exists('Redux') && $pagenow == 'admin.php' && @$_GET['page'] == '_options') {
	    	$depends = array('redux-admin-css', 'select2-css');
	    	wp_dequeue_style( 'woocommerce_admin_styles' );
	    }
	    wp_enqueue_style('etheme_admin_css', ET_CODE_CSS.'admin.css', $depends);
	    wp_enqueue_style("font-awesome", get_template_directory_uri().'/css/font-awesome.min.css');
	}
}

if(!function_exists('etheme_add_admin_script')) {
	add_action('admin_init','etheme_add_admin_script', 1130);
	function etheme_add_admin_script(){
	    add_thickbox();
	    wp_enqueue_script('theme-preview');
	    wp_enqueue_script('common');
	    wp_enqueue_script('wp-lists');
	    wp_enqueue_script('postbox');
	    wp_enqueue_script('farbtastic');
	    //wp_enqueue_script('et_masonry', get_template_directory_uri().'/js/jquery.masonry.min.js',array(),false,true);
	    wp_enqueue_script('etheme_admin_js', ET_CODE_JS.'admin.js',array('wpb_php_js','wpb_js_composer_js_view','wpb_js_composer_js_custom_views'),false,true);   
	}
}

// **********************************************************************// 
// ! Add admin Theme Options links in menu
// **********************************************************************// 

if(!function_exists('et_admin_menu_items')) {
	add_action( 'admin_menu', 'et_admin_menu_items', 3000 );
	function et_admin_menu_items() {
		/*add_submenu_page(
		    '_options',
		    'Update Theme',
		    'Update Theme',
		    'manage_options',
		    '_et_theme_updater',
		    //create_function( '$a', "return null;" )
		    '_et_theme_updater'
		);*/
		add_submenu_page(
		    '_options',
		    'Rate Theme',
		    'Rate Theme',
		    'manage_options',
		    '_et_rate_theme',
		    //create_function( '$a', "return null;" )
		    '__return_null'
		);
		add_submenu_page(
		    '_options',
		    'Free Support',
		    'Free Support',
		    'manage_options',
		    '_et_open_support',
		    //create_function( '$a', "return null;" )
		    '__return_null'
		);
		add_submenu_page(
		    '_options',
		    'Documentation',
		    'Documentation',
		    'manage_options',
		    '_et_open_documentation',
		    //create_function( '$a', "return null;" )
		    '__return_null'
		);
	}
}


if(!function_exists('et_rate_redirect')) {
	add_action( 'init', 'et_rate_redirect' );
	function et_rate_redirect() {
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_open_support' && false === headers_sent() ) {
			wp_redirect( ET_SUPPORT_LINK );
			exit;
		}
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_rate_theme' && false === headers_sent() ) {
			wp_redirect( ET_RATE_LINK );
			exit;
		}
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_open_documentation' && false === headers_sent() ) {
			wp_redirect( ET_DOCS_LINK );
			exit;
		}
	}
}
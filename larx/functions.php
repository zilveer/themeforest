<?php
//
// LARX Theme Functions
//
// Author: WossThemes
// URL: http://themeforest.net/user/WossThemes/
// Design: WossThemes Themes
//
//


/*-----------------------------------------------------------------------------------*/
/*	Theme Setup
/*-----------------------------------------------------------------------------------*/

if (!function_exists('woss_theme_setup')) :
	function woss_theme_setup() {
		add_theme_support( 'title-tag' );
		register_nav_menu('main-menu', __('Main Navigation', 'larx'));
		load_theme_textdomain( 'larx', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'index-thumb', 405, 207, true );
		add_image_size( 'blog-thumb', 370, 247, true );
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		if ( ! isset( $content_width ) ) {
			$content_width = 1170;
		}
	}
endif;
add_action( 'after_setup_theme', 'woss_theme_setup' );

require get_template_directory() .'/framework/theme-options/importer/init.php';

/*-----------------------------------------------------------------------------------*/
/*	Functions and Definitions
/*-----------------------------------------------------------------------------------*/

define('TH1_JS', get_template_directory_uri()  . '/assets/js/');
define('TH1_CSS', get_template_directory_uri()  . '/assets/css/');
define('TH1_PLUGINS', get_template_directory_uri()  . '/assets/plugins/');

/*-----------------------------------------------------------------------------------*/
/*	Start Setup Theme
/*-----------------------------------------------------------------------------------*/

if ( file_exists( dirname( __FILE__ ) . '/framework/theme-options/config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/framework/theme-options/config.php' );
}

require_once('framework/plugins/plugins-config.php'); 			                            // Plugins Manager
require_once('framework/functions/scripts-load.php'); 			                            // Load Scripts
require_once('framework/functions/css-load.php'); 			                                // Load CSS
require_once('framework/functions/additional-functions.php'); 			                    // Additional theme functions

require_once('framework/testimonials/testimonials-functions.php');                          // Testimonial Post Type
require_once('framework/portfolio/portfolio-functions.php');                                // Portfolio Post Type
require_once('framework/shortcodes/shortcodes.php'); 			                            // Shortcodes
require_once dirname( __FILE__ ) . '/framework/plugins/Metaboxes/metabox-functions.php';    // Metaboxes


/*remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);*/

/*-----------------------------------------------------------------------------------*/
/*	Register Custom Navigation Walker
/*-----------------------------------------------------------------------------------*/

require_once('framework/wp_bootstrap_navwalker.php');

/*-----------------------------------------------------------------------------------*/
/*	Register theme widget areas
/*-----------------------------------------------------------------------------------*/

if ( !function_exists('th_register_sidebar') ){
	function th_register_sidebar() {
		register_sidebar(array(
			'name' => 'Blog-Sidebar',
			'id' => 'blog_sidebar',
			'before_widget' => '<div id="%1$s" class="bar %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="blog_sidebar">',
			'after_title' => '</div>',
		));

		register_sidebar(array(
			'name' => 'Page-Sidebar',
			'id' => 'page_sidebar',
			'before_widget' => '<div id="%1$s" class="bar %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="page_sidebar">',
			'after_title' => '</div>',
		));
	}
}
add_action( 'widgets_init', 'th_register_sidebar' );

/*-----------------------------------------------------------------------------------*/
/*	Extend VC
/*-----------------------------------------------------------------------------------*/

if(class_exists('Vc_Manager')) {

    function th_extend_composer() {
        require_once locate_template('/wpbakery/vc-extend.php');
    }

    add_action('init', 'th_extend_composer', 20);
}
/*-----------------------------------------------------------------------------------*/
/*	Get ID of the page
/*-----------------------------------------------------------------------------------*/

function th_get_id() {

    global $post;

    $post_id = '';

    if(is_object($post)) {
        $post_id = $post->ID;
    }
    if(is_home()) {
        $post_id = get_option('page_for_posts');
    }

    return $post_id;
}

/*-----------------------------------------------------------------------------------*/
/*	Menu scripts for navigation
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_head', 'th_nav_page' );
function th_nav_page() {
	$output = '';
	
	$th_nav_data=th_theme_data('th_nav_data');
	
	if($th_nav_data == 1){
		$output .= "<script>(function ($, window, document, undefined) {
						'use strict';
							$(function() {
								  $('a[href*=\"#\"]:not([href=\"#\"])').click(function() {
									if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
									  var target = $(this.hash);
									  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
									  if (target.length) {
										$('html,body').animate({
										  scrollTop: target.offset().top
										}, 1000);
										return false;
									  }
									}
								  });
								});
					})(jQuery, window, document);</script>";	
	}
	if($th_nav_data == 0){
		$output .= "<script>jQuery(document).ready(function($){
						jQuery('body').scrollspy();

						jQuery(\".navbar ul li a[href^='#']\").on('click', function(e) {
							e.preventDefault();
							var hash = this.hash;
							jQuery('html, body').animate({
								scrollTop: jQuery(this.hash).offset().top
							}, 1000, function(){
								window.location.hash = hash;
							});
						});
					});</script>";
	}
	
	echo $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Custom CSS from theme options page
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_head', 'woss_theme_page_css' );
function woss_theme_page_css() {
	echo '<style>'. wp_kses_post(th_theme_data('opt-ace-editor-css')).'</style>';
}

/*-----------------------------------------------------------------------------------*/
/*	Deregister default Visual Composer font-awesome
/*-----------------------------------------------------------------------------------*/
add_action( 'vc_base_register_admin_css', 'th_vc_iconpicker_editor_jscss' );
add_action( 'vc_base_register_front_css', 'th_vc_iconpicker_editor_jscss' );

function th_vc_iconpicker_editor_jscss() {
	wp_deregister_style( 'font-awesome' );
}
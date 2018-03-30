<?php

define('OM_THEME_PREFIX', 'om_expo18_');
define('OM_THEME_SHORT_PREFIX', 'om_');
define('OM_THEME_NAME', 'expo18');
define('TEMPLATE_DIR', get_template_directory());
define('TEMPLATE_DIR_URI', get_template_directory_uri());
define('OM_THEME_VERSION', '1.2.4');

/*************************************************************************************
 *	WordPress version control
 *************************************************************************************/
if( version_compare(get_bloginfo('version'), '3.5', '<') ) {
	function om_show_version_notice() {
		echo '<div id="message" class="error"><p><strong>'.__('This theme requires WordPress version 3.5 or greater to work properly. Please, update WordPress','om_theme').'</strong></p></div>';
	}
	add_action('admin_notices', 'om_show_version_notice');     
}

/*************************************************************************************
 *	Translation Text Domain
 *************************************************************************************/

load_theme_textdomain('om_theme');

/*************************************************************************************
 *	Register WP3.0+ Menu
 *************************************************************************************/
 
if( !function_exists( 'om_register_menu' ) ) {
	function om_register_menu() {
	  register_nav_menu('primary-menu', __('Primary Menu', 'om_theme'));
	  register_nav_menu('secondary-menu', __('Secondary Menu', 'om_theme'));
	  //register_nav_menu('reserved-menu', __('Reserved Menu (can be used in widget)', 'om_theme'));
	}

	add_action('init', 'om_register_menu');
}

if( !function_exists( 'om_primary_menu_fallback' ) ) {
	function om_primary_menu_fallback($args) {
	  $menu=wp_page_menu(array(
	  	'echo' => false,
	 	));
	 	$args['menu_class'].=' primary-menu-fallback';
	 	$menu=str_replace('<div class="menu"><ul>','<div class="menu"><ul class="'.esc_attr($args['menu_class']).'">',$menu);
	 	if(isset($args) && $args['echo'] == false)
	 		return $menu;
	 	else
	 		echo $menu;
	}
}
/*************************************************************************************
 *	Set Max Content Width
 *************************************************************************************/
 
if ( ! isset( $content_width ) ) $content_width = 920;

/*************************************************************************************
 *	Post Thumbnails
 *************************************************************************************/

if( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 125, '', false );
	add_image_size( 'thumbnail-post-single', 615, '', false); // for blog single page and blog posts list
}

/*************************************************************************************
 *	Automatic Feed Links
 *************************************************************************************/

function om_feedburner_hook() {
	echo '<link rel="alternate" type="application/rss+xml" title="'. get_bloginfo( 'name' ) .' RSS Feed" href="'. get_option(OM_THEME_PREFIX.'feedburner') .'" />';
}

if (get_option(OM_THEME_PREFIX.'feedburner')) {
	add_action('wp_head','om_feedburner_hook');
} else {
	add_theme_support( 'automatic-feed-links' );
}

/*************************************************************************************
 *	Excerpt Length
 *************************************************************************************/
 
if( !function_exists( 'om_excerpt_length' ) ) {
	function om_excerpt_length($length) {
		return 15; 
	}
	add_filter('excerpt_length', 'om_excerpt_length');
}

if( !function_exists( 'om_excerpt_more' ) ) {
	function om_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'om_excerpt_more');
}

/*************************************************************************************
 *	Register Sidebars
 *************************************************************************************/

if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Main Sidebar','om_theme'),
		'id' => 'sidebar-1',
		'before_widget' => '',
		'after_widget' => '<div class="sidebar-divider"></div>',
		'before_title' => '<h2 class="h-sidebar">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => __('Footer Left Column','om_theme'),
		'id' => 'footer-column-left',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2 class="h-sidebar">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => __('Footer Center Column','om_theme'),
		'id' => 'footer-column-center',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2 class="h-sidebar">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => __('Footer Right Column','om_theme'),
		'id' => 'footer-column-right',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2 class="h-sidebar">',
		'after_title' => '</h2>',
	));

	$sidebars_num=intval(get_option(OM_THEME_PREFIX."sidebars_num"));
	for($i=1;$i<=$sidebars_num;$i++)
	{
		register_sidebar(array(
			'name' => __('Main Alternative Sidebar','om_theme').' '.$i,
			'id' => 'alt-sidebar-'.$i,
			'before_widget' => '',
			'after_widget' => '<div class="sidebar-divider"></div>',
			'before_title' => '<h2 class="h-sidebar">',
			'after_title' => '</h2>',
		));	
	}
	
}

/*************************************************************************************
 *	Widgets
 *************************************************************************************/

// Latest Tweets
include_once("widgets/tweets/tweets.php");

// Flickr
include_once("widgets/flickr/flickr.php");

// Video
include_once("widgets/video/video.php");

// Recent Posts
include_once("widgets/recent-posts/recent-posts.php");

// Apply Shortcodes for Widgets
add_filter('widget_text', 'do_shortcode');

/*************************************************************************************
 *	Front-end JS/CSS
 *************************************************************************************/
 
if(!function_exists('om_enqueue_scripts')) {
	function om_enqueue_scripts() {

		// styles
		wp_enqueue_style('om_style', get_stylesheet_uri(), array(), OM_THEME_VERSION);
		if(get_option(OM_THEME_PREFIX . 'responsive') == 'true') {
			wp_enqueue_style('responsive', TEMPLATE_DIR_URI.'/css/responsive.css');
		}

		wp_register_script('cycle', TEMPLATE_DIR_URI.'/js/jquery.cycle.all.min.js', array('jquery'), false, true);
		wp_register_script('isotope', TEMPLATE_DIR_URI.'/js/jquery.isotope.min.js', array('jquery'), false, true);
		wp_register_script('prettyPhoto', TEMPLATE_DIR_URI.'/js/jquery.prettyPhoto.js', array('jquery'), false, true);
		wp_register_script('countdown', TEMPLATE_DIR_URI.'/js/jquery.countdown.pack.js', array('jquery'), false, true);
		wp_register_script('validate', TEMPLATE_DIR_URI.'/js/jquery.validate.min.js', array('jquery'), false, true);
		wp_register_script('form', TEMPLATE_DIR_URI.'/js/jquery.form.min.js', array('jquery'), false, true);
		wp_register_script('libraries', TEMPLATE_DIR_URI.'/js/libraries.js', array('jquery'), false, true);
		wp_register_script('om_custom', TEMPLATE_DIR_URI.'/js/custom.js', array('jquery','cycle','prettyPhoto','libraries','isotope','countdown'), OM_THEME_VERSION, true);

		// Enqueue
		// All scripts can be used at any page, so there is no include conditions
		wp_enqueue_script('jquery');
		wp_enqueue_script('cycle');
		wp_enqueue_script('isotope');
		wp_enqueue_script('validate');
		wp_enqueue_script('form');
		wp_enqueue_script('prettyPhoto');
		wp_enqueue_script('libraries');
		wp_enqueue_script('om_custom');
		
		// styles
		wp_register_style('prettyPhoto', TEMPLATE_DIR_URI.'/css/prettyPhoto.css');
		wp_enqueue_style('prettyPhoto');
  }
    
	add_action('wp_enqueue_scripts', 'om_enqueue_scripts');
}

// theme custom css block
if(!function_exists('om_custom_css_block')) {
	function om_custom_css_block() {
		
		$custom_css=get_option(OM_THEME_PREFIX . 'code_custom_css');
		if($custom_css)
			echo '<style>'.$custom_css.'</style>';
	
  }
	add_action('wp_head', 'om_custom_css_block');
}

/*************************************************************************************
 *	More Functions
 *************************************************************************************/

require_once ( locate_template ( '/functions/styling.php' ) );
require_once ( locate_template ( '/functions/misc.php' ) );
require_once ( locate_template ( '/functions/comments.php' ) );
require_once ( locate_template ( '/functions/shortcodes.php' ) );
require_once ( locate_template ( '/functions/homepage-slider.php' ) );
require_once ( locate_template ( '/functions/registration-form.php' ) );

if(is_admin()) {
	require_once (TEMPLATE_DIR . '/libraries/om-import-tool/om-import-tool.php');
	
	require_once ( locate_template ( '/functions/post-meta.php' ) );
	require_once ( locate_template ( '/functions/page-meta.php' ) );
	require_once ( locate_template ( '/tinymce/tinymce.php' ) );
	require_once ( locate_template ( '/admin/admin-functions.php' ) );
	require_once ( locate_template ( '/admin/admin-interface.php' ) );
	require_once ( locate_template ( '/functions/theme-options.php' ) );
	require_once ( locate_template ( '/functions/theme-update.php' ) );
}

/*************************************************************************************
 *	Animated background
 *************************************************************************************/
 
function om_animated_bg_init() {
	if(get_option(OM_THEME_PREFIX.'background_disable_animation') != 'true')
		echo '<script>jQuery(function(){headline_init();})</script>';
}
add_action('wp_head', 'om_animated_bg_init');

/*************************************************************************************
 *	Title
 *************************************************************************************/

function om_title_tag() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'om_title_tag' );

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function om_wp_title($title) {
		$title .= get_bloginfo('name');
		return $title;
	}
	
	function om_theme_render_title() {
		if (!defined('WPSEO_VERSION')) {
			add_filter('wp_title','om_wp_title');
			?><title><?php wp_title('|', true, 'right'); ?></title><?php
    } else { //If WordPress SEO by Yoast is activated
			?><title><?php wp_title(''); ?></title><?php
    }
	}
	add_action( 'wp_head', 'om_theme_render_title' );
}

/*************************************************************************************
 *	Embed wrap
 *************************************************************************************/

function om_embed_oembed_html($html) {
	
	if(strpos($html, '<blockquote class="twitter-tweet"') === false)
		return '<div class="responsive-embed">'.$html.'</div>';
	else
		return $html;
	
}
add_filter('embed_oembed_html', 'om_embed_oembed_html');
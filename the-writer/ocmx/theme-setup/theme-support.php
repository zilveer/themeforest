<?php global $themename, $input_prefix;

if(!get_option("ocmx_font_support"))
	update_option("ocmx_font_support", true);

/*********************/
/* Load Localization */
load_theme_textdomain('ocmx', get_template_directory() . '/lang');

/*****************/
/* Add Nav Menus */

if (function_exists('register_nav_menus')) :
	register_nav_menus( array(
		'primary' => __('Primary Navigation', 'ocmx' )
	) );
endif;

/**********************************/
/* Remove default gallery styling */
add_filter( 'use_default_gallery_style', '__return_false' );

/************************************************/
/* Fallback Function for WordPress Custom Menus */
if( !function_exists( 'ocmx_fallback' ) ) {
	function ocmx_fallback() {
		echo '<ul id="nav" class="clearfix">';
			wp_list_pages('title_li=&');
		echo '</ul>';
	}
}

/**************************/
/* WP 3.4 Support         */
global $wp_version;
if ( version_compare( $wp_version, '3.4', '>=' ) ) {
	// add_theme_support( 'custom-background' ); // Pending approval to put back
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
}
if ( ! isset( $content_width ) ) $content_width = 800;
/************************/
/* Add WP Custom Header */
function ocmx_header_style() { $do = "nothing"; }
function ocmx_admin_header_style() { $do = "nothing"; }
$headerargs = array( 'wp-head-callback' => 'ocmx_header_style', 'admin-head-callback' => 'ocmx_admin_header_style', 'width' => '2000', 'height' => '520',  'header-text' => false, 'random-default' => true);
add_theme_support( 'custom-header', $headerargs );


/*********************/
/* Load Localization */
load_theme_textdomain('ocmx', get_template_directory() . '/lang');

/******************************/
/* Display custom login logo */
function ocmx_login_logo() {
	echo '<style type="text/css">
		h1 a { background-image:url('.get_option("ocmx_custom_login", true).') !important; }
	</style>';
}

add_action('login_head', 'ocmx_login_logo');

/****************************/
/* Add theme body classes */
function ocmx_body_classes( $classes ){
	if( is_single() || is_page() )
		{
			global $post;
			if( '' != get_post_meta( $post->ID , "header_image", true) )
				{ $classes[] = 'has-title-background'; }
		}
	return $classes;
}
add_filter( 'body_class' , 'ocmx_body_classes' );

/******************/
/* Add IS support */
add_theme_support( 'infinite-scroll', array(
	'container' => 'post-list',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'footer'    => 'content-container',
	'render' => 'ocmx_infinite_scroll_render',
	'wrapper'	=> false,
) );

function ocmx_infinite_scroll_render(){
	if (have_posts()) :
		while (have_posts()) :
			global $post;
			the_post();
			setup_postdata($post);
			get_template_part("/functions/post-list");
		endwhile;
	endif;
}
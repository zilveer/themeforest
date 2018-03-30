<?php
/////////////
//STYLESHEETS
/////////////
function pharm_enqueue_style() {
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );
	$light = get_theme_mod('themolitor_customizer_theme_skin', FALSE);
	if($light == 1){
		wp_enqueue_style( 'light', get_template_directory_uri() . '/light.css');
	}
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/responsive.css');
}
add_action( 'wp_enqueue_scripts', 'pharm_enqueue_style' );


/////////
//SCRIPTS
/////////
function pharm_enqueue_scripts() {
	if(is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	wp_enqueue_script('jquery');
	wp_enqueue_script('backs',get_template_directory_uri() . '/scripts/backstretch.js',array(),false,true);
	wp_enqueue_script('pace',get_template_directory_uri() . '/scripts/pace.js',array(),false,true);
	wp_enqueue_script('custom',get_template_directory_uri() . '/scripts/custom.js',array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'pharm_enqueue_scripts' );


//////////////////
// TITLE TAG STUFF
//////////////////
add_theme_support( 'title-tag' );


///////////////////////
// LOCALIZATION SUPPORT
///////////////////////
load_theme_textdomain( 'themolitor', get_template_directory().'/languages' );
$locale = get_locale();
$locale_file = get_template_directory().'/languages/$locale.php';
if ( is_readable($locale_file) )
    require_once($locale_file);
    
    
////////////
//FEED LINKS
////////////
add_theme_support('automatic-feed-links' );


////////////////
//CONTENT WIDTH
////////////////
if ( ! isset( $content_width ) ) $content_width = 420;


///////////////////////////////////
//REMOVE TAGS FROM CAT DESCRIPTION
///////////////////////////////////
remove_filter('term_description','wpautop');


////////////////////////
//FEATURED IMAGE SUPPORT
////////////////////////
add_theme_support( 'post-thumbnails', array( 'post' ) );
set_post_thumbnail_size( 420, 200, true );
add_image_size( 'gallery',420 ,9999 );


//////////////////////////////////////////
//CATEGORY ID FROM NAME FOR PAGE TEMPLATES
//////////////////////////////////////////
function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}


///////////////
//EXCERPT STUFF
///////////////
function new_excerpt_length($length) {
	return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');
function new_excerpt_more($more) {
       global $post;
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');


///////////////////////////
//IMAGE ATTACHMENTS TOOLBOX
///////////////////////////
function attachment_toolbox($size = 'full') {

	if($images = get_children(array(
		'order'   => 'ASC',
		'orderby' => 'menu_order',
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image'
	))) {
		foreach($images as $image) {
			$attimg   = wp_get_attachment_image($image->ID,$size);
			$atturl   = wp_get_attachment_url($image->ID);
			$atttitle = apply_filters('the_title',$image->post_title);
			echo'<li class="wrapperli"><a href="'.$atturl.'" title="'.$atttitle.'">'.$attimg.'</a></li>';
		}
	}
}


//////////////////
//ADD MENU SUPPORT
//////////////////
add_theme_support( 'menus' );
register_nav_menu('main', 'Main Navigation Menu');


////////////////////
//ADD WIDGET SUPPORT
////////////////////
function pharm_widgets_init() {
	register_sidebar(array(
		'name'=>'Live Widgets',
		'id' => 'sidebar-1',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}
add_action( 'widgets_init', 'pharm_widgets_init' );


/////////////
//BREADCRUMBS
/////////////
include(TEMPLATEPATH . '/include/breadcrumbs.php');


//////////////
//POST OPTIONS
//////////////
include(TEMPLATEPATH . '/include/post-options.php');


///////////////
//THEME OPTIONS
///////////////
include(TEMPLATEPATH . '/include/theme-options.php');
<?php 
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
 
/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
 /*-----------------------------------------------------------------------------------*/
/* Set Proper Parent/Child theme paths for inclusion
/*-----------------------------------------------------------------------------------*/

@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );


/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

    define('OPTIONS_FRAMEWORK_URL', PARENT_URL . '/theme-options/');
    define('OPTIONS_FRAMEWORK_DIRECTORY', PARENT_DIR . '/theme-options/');

require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'options-framework.php');

}

if ( !function_exists( 'popularpost_init' ) ) {
	define( 'POPULAR_POST_WIDGET_DIRECTORY', PARENT_URL . '/includes/wp-most-popular/' );
	require_once dirname( __FILE__ ) . '/includes/wp-most-popular/wp-most-popular.php';
}

if ( !function_exists( 'recentpostplus_init' ) ) {
	define( 'RECENT_POST_WIDGET_DIRECTORY', PARENT_URL . '/includes/' );
	require_once dirname( __FILE__ ) . '/includes/recent-posts-widget-plus.php';
}

if ( !function_exists( 'carouselwidget_init' ) ) {
	define( 'POST_CAROUSEL_WIDGET_DIRECTORY', PARENT_URL . '/includes/' );
	require_once dirname( __FILE__ ) . '/includes/carousel-widget.php';
}

require_once (PARENT_DIR . '/shortcodes.php');
 
if ( !function_exists( 'ar_registerstyles' ) ) {
	add_action('get_header', 'ar_registerstyles');
	function ar_registerstyles() {
		$theme  = wp_get_theme();
		$version = $theme['Version'];
		$stylesheets = wp_enqueue_style('theme', get_template_directory_uri().'/style.css', 'theme', $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('skeleton', get_template_directory_uri().'/stylesheets/skeleton.css', false, $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('layout', get_template_directory_uri().'/stylesheets/layout.css', 'theme', $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('base', get_template_directory_uri().'/stylesheets/base.css', 'theme', $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('prettyPhoto', get_template_directory_uri().'/stylesheets/prettyPhoto.css', 'theme', $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('superfish', get_template_directory_uri().'/stylesheets/superfish.css', 'theme', $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('style1', get_template_directory_uri().'/stylesheets/style1.php', false, $version, 'screen, projection');
		$stylesheets .= wp_enqueue_style('custom', get_template_directory_uri().'/stylesheets/custom.css', 'theme', $version, 'screen, projection');
	}
}

if ( !function_exists( 'ar_header_scripts' ) ) {
add_action('wp_enqueue_scripts', 'ar_header_scripts');
function ar_header_scripts() {
	wp_register_script('prettyPhoto_script', get_template_directory_uri() . '/javascripts/jquery.prettyPhoto.js', array('jquery'), '3.1.4', false);
	wp_register_script('quicksand',get_template_directory_uri() . '/javascripts/jquery.quicksand.js', array('jquery'),'1.2.2', false);
	wp_register_script('easing',get_template_directory_uri() . '/javascripts/jquery.easing.1.3.js', array('jquery'),'1.3', false);
	wp_register_script('jcarousellite', get_template_directory_uri() . '/javascripts/jcarousellite_1.0.1.min.js', array('jquery'), '1.0.1', false);
	wp_register_script('application', get_template_directory_uri() . '/javascripts/app.js', array('jquery'), '1.2.3', true);
	wp_register_script('superfish',get_template_directory_uri() . '/javascripts/superfish.js', array('jquery'),'1.2.3', true);
	wp_register_script('formalize',get_template_directory_uri() . '/javascripts/jquery.formalize.min.js', array('jquery'),'1.2.3', true);
	wp_register_script('rotate', get_template_directory_uri() . '/javascripts/jquery-ui-tabs-rotate.js', array('jquery', 'jquery-ui-tabs'), true);
	wp_register_script('template', get_template_directory_uri() . '/javascripts/template.js', array('jquery-ui-tabs'), true);
	
	wp_enqueue_script( 'application' );
	wp_enqueue_script( 'prettyPhoto_script' );
	wp_enqueue_script( 'superfish' );
	wp_enqueue_script( 'easing' );
	wp_enqueue_script( 'formalize' );
	wp_enqueue_script( 'jcarousellite' );
	wp_enqueue_script( 'rotate' );
	wp_enqueue_script( 'template' );
	
	if ( is_page_template('template-filterable-portfolio.php') || is_page_template('template-filterable-portfolio-tax.php') ) {
	wp_enqueue_script( 'quicksand' );	
	}
}
}

if ( ! isset( $content_width ) ) $content_width = 700;


// drag and drop menu support
register_nav_menu( 'primary', 'Primary Menu' );
register_nav_menu( 'social', 'Social Menu' );


//widget support for a topest sidebar
register_sidebar(array(
  'name' => 'Topest SideBar',
  'id' => 'topest-sidebar',
  'description' => 'Widgets in this area will be shown on the topest side.',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

register_sidebar(array(
  'name' => 'Promo Bar',
  'id' => 'promobar',
  'description' => 'Widgets in this area will be shown on the Promo Section.',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for a home sidebar
register_sidebar(array(
  'name' => 'Home SideBar',
  'id' => 'home-sidebar',
  'description' => 'Widgets in this area will be shown on the right-hand side on home page.',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for a blog sidebar
register_sidebar(array(
  'name' => 'Blog SideBar',
  'id' => 'blog-sidebar',
  'description' => 'Widgets in this area will be shown on the right-hand side on blog page.',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for a blog sidebar
register_sidebar(array(
  'name' => 'Page SideBar',
  'id' => 'page-sidebar',
  'description' => 'Widgets in this area will be shown on the right-hand side on page.',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for a blog sidebar
register_sidebar(array(
  'name' => 'Page Left SideBar',
  'id' => 'left-page-sidebar',
  'description' => 'Widgets in this area will be shown on the left-hand side on page.',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for the footer sidebar
register_sidebar(array(
  'name' => 'Bottom SideBar',
  'id' => 'bottom-sidebar',
  'description' => 'Widgets in this area will be shown in the footer.',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for a contact sidebar
register_sidebar(array(
  'name' => 'Contact SideBar',
  'id' => 'contact-sidebar',
  'description' => 'Widgets in this area will be shown on the right-hand side on contact page.',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
$defaults_header = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults_header );
add_theme_support( 'automatic-feed-links' );

// New Thumbnail Size
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'def-slider-image', 700, 315,true ); 
	add_image_size( 'def-carou-image', 325, 210, true ); 
	add_image_size( 'def-blog-thumb', 250, 167, true ); 
	add_image_size( 'portf-4col-img', 234, 157, true );
	add_image_size( 'carou-widget-image', 342, 219, true ); 
}

//Apply do_shortcode() to widgets so that shortcodes will be executed in widgets
add_filter('widget_text', 'do_shortcode');

/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 */
function widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}
add_filter('dynamic_sidebar_params','widget_first_last_classes');

add_filter( 'the_category', 'add_nofollow_cat' ); 
function add_nofollow_cat( $text ) { 
$text = str_replace('rel="category tag"', "", $text); return $text; 
}

	// Include the portfolio functionality
	include("includes/portfolio-post-type.php");

// function: add_portfolio_category BEGIN
function add_portfolio_category() {

	register_taxonomy('portfolio_category', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Portfolio Category', 'taxonomy general name', 'eatoreh_wp' ),
			'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', 'eatoreh_wp' ),
			'search_items' =>  __( 'Search Portfolio Category', 'eatoreh_wp' ),
			'all_items' => __( 'All Portfolio Category', 'eatoreh_wp' ),
			'parent_item' => __( 'Parent Portfolio Category', 'eatoreh_wp' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'eatoreh_wp' ),
			'edit_item' => __( 'Edit Portfolio Category', 'eatoreh_wp' ),
			'update_item' => __( 'Update Portfolio Category', 'eatoreh_wp' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'eatoreh_wp' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'eatoreh_wp' ),
			'menu_name' => __( 'Portfolio Category', 'eatoreh_wp' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'portfolio-category', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
} // function: add_portfolio_category END

add_action( 'init', 'add_portfolio_category', 0 );

?>
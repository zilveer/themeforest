<?php
/********************* DEFINE MAIN PATHS ********************/

define('Evolution_PLUGINS',  get_template_directory() . '/plugins' ); // Shortcut to the /plugins/ directory

$adminPath 	=  get_template_directory() . '/library/admin/';
$funcPath 	=  get_template_directory() . '/library/functions/';
$incPath 	=  get_template_directory() . '/library/includes/';
require_once ($incPath . 'helper_functions.php');
require_once ($incPath . 'the_breadcrumb.php');
require_once ($incPath . 'oauth.php');
require_once ($incPath . 'twitteroauth.php');
require_once ($incPath . 'portfolio_walker.php');
require_once ($funcPath . 'sidebar-generator.php');
require_once ($funcPath . 'options.php');
require_once ($funcPath . 'post-types.php');
require_once ($funcPath . 'widgets.php');
require_once ($funcPath . '/shortcodes/shortcode.php');
require_once ($adminPath . 'custom-fields.php');
require_once ($adminPath . 'scripts.php');
require_once ($adminPath . 'admin-panel/admin-panel.php');
global $alc_options;
$alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');

/************************************************************/


/*********** LOAD ALL REQUIRED SCRIPTS AND STYLES ***********/
function evolution_load_scripts()
{
	$alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');
	if( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin())
	{           
		wp_enqueue_style('foundation-styles',  get_template_directory_uri().'/css/foundation.css');
		wp_enqueue_style('fgx-styles', get_template_directory_uri().'/css/fgx-foundation.css');
		wp_enqueue_style('main-styles', get_stylesheet_directory_uri().'/style.css');	
		wp_enqueue_style('dynamic-styles',  get_template_directory_uri().'/css/dynamic-styles.php');
		wp_enqueue_style('normalize',  get_template_directory_uri().'/plugins/prettyphoto/prettyPhoto.css');
		wp_enqueue_style('font-awesome',  get_template_directory_uri().'/plugins/fontawesome/css/font-awesome.min.css');
		wp_enqueue_style('smallipop',  get_template_directory_uri().'/plugins/smallipop/css/jquery.smallipop.css');
		wp_enqueue_style('jplayer-styles',  get_template_directory_uri().'/js/jplayer/skin/pink.flag/jplayer.pink.flag.css',false,'3.0.1','all');
        
		wp_enqueue_script('jquery');
        wp_enqueue_script('modernizr', get_template_directory_uri() .'/js/vendor/custom.modernizr.js', array('jquery'), '3.2', true);
		wp_enqueue_script('foundation-min',  get_template_directory_uri(). '/js/foundation.min.js');
		wp_enqueue_script('quicksand', get_template_directory_uri() .'/js/jquery.quicksand.js', array('jquery'), '3.2', true);
		wp_enqueue_script('jplayer-audio',  get_template_directory_uri().'/js/jplayer/jquery.jplayer.min.js', array('jquery'), '3.2', true);
        wp_enqueue_script('prettyphoto', get_template_directory_uri().'/plugins/prettyphoto/jquery.prettyPhoto.js', array('jquery'), '3.2', true);
		wp_enqueue_script('prettify', get_template_directory_uri().'/plugins/smallipop/lib/contrib/prettify.js', array('jquery'), '3.2', true);
		wp_enqueue_script('smallipop', get_template_directory_uri().'/plugins/smallipop/lib/jquery.smallipop.js', array('jquery'), '3.2', true);
		wp_enqueue_script('smallipop-calls', get_template_directory_uri().'/plugins/smallipop/lib/smallipop.calls.js', array('jquery'), '3.2', true);;
	  	wp_enqueue_script('carouFredSel',  get_template_directory_uri(). '/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js', array('jquery'), '3.0.1' );
		wp_enqueue_script('touchSwipe',  get_template_directory_uri().'/plugins/carouFredSel/helper-plugins/jquery.touchSwipe.min.js', array('jquery'), '3.2', true);
        wp_enqueue_script('flickr', get_template_directory_uri().'/plugins/flickr/jflickrfeed.min.js', array('jquery'), '3.2', true);
        wp_enqueue_script('Validate',  get_template_directory_uri().'/js/jquery.validate.min.js',array('jquery'), array('jquery'), '3.2', true);
        wp_enqueue_script('app-head-js', get_template_directory_uri() .'/js/app-head-calls.js', array('jquery'), '3.2', true);
		
		wp_enqueue_script('app-footer-js', get_template_directory_uri() .'/js/app-bottom-calls.js', array('jquery'), '3.2', true);        

		if (is_page_template('contact-template.php')){
			$alc_options = get_option('alc_general_settings'); 
			if (!empty($alc_options['alc_contact_address']))
			{
				wp_enqueue_script('Google-map-api',  'http://maps.google.com/maps/api/js?sensor=false');
				wp_enqueue_script('Google-map',  get_template_directory_uri().'/js/gmap3.min.js');
			}			
		}		
		if (is_page_template('under-construction.php'))
		{
			wp_enqueue_script('Under-construction',  get_template_directory_uri().'/js/jquery.countdown.js');
		}
	}
}
add_action( 'wp_enqueue_scripts', 'evolution_load_scripts' ); //Load All Scripts
/************************************************************/


/*********** LOAD GOOGLE FONTS IN A CORRECT WAY *************/

function evolution_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'evolution-ptsans', "$protocol://fonts.googleapis.com/css?family=PT+Sans:300,400,700" );
    wp_enqueue_style( 'evolution-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" );
    }
add_action( 'wp_enqueue_scripts', 'evolution_fonts' );

/************************************************************/


/************** ADD SUPPORT FOR LOCALIZATION ****************/

load_theme_textdomain( 'Evolution',  get_template_directory() . '/languages' );
$locale = get_locale();
$locale_file =  get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) ){
	require_once( $locale_file );
}
/************************************************************/


/**************** ADD SUPPORT FOR POST THUMBS ***************/

add_theme_support( 'post-thumbnails');
// Define various thumbnail sizes
add_image_size('portfolio-2-col', 378, 286, true); 
add_image_size('portfolio-3-col', 370, 278, true);
add_image_size('portfolio-4-col', 326, 245, true);
add_image_size('portfolio-5-col', 257, 193, true);
add_image_size('blog-list1', 960, 450, true); 
add_image_size('blog-thumb', 100, 50, true);
add_image_size('blog-thumb2', 50, 50, true);

/************************************************************/


/************ FIX PORTFOLIO CATEGORY PAGINATION *************/

$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
    global $option_posts_per_page;
    if ( is_tax( 'portfolio_category') ) {
		$pageId = get_page_ID_by_page_template('portfolio-template3.php');
		if ($pageId)
		{
			$custom =  get_post_custom($pageId);
			$items_per_page = isset ($custom['_page_portfolio_num_items_page']) ? $custom['_page_portfolio_num_items_page'][0] : '777';
			return $items_per_page;
		}
		else
		{
			return 4;
		}
    } else {
        return $option_posts_per_page;
    }
}

/************************************************************/


/************** ADD AND REGISTER WP 3.0+ MENUS **************/

add_theme_support( 'menus' );
add_action( 'init', 'my_custom_menus' );

function my_custom_menus() {
    register_nav_menus(
        array(
            'primary_nav' => __( 'Primary Navigation', 'Evolution'),
            'footer_nav' => __( 'Footer Navigation', 'Evolution')
        )
    );
}

/************************************************************/


/******* ADD SHORTCODE SUPPORT FOR VARIOUS ELEMENTS *********/

add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');

/************************************************************/


/*********** CUSTOM TAG CLOUD WIDGET RENDERING **************/

function evolution_custom_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'evolution_custom_tag_cloud_widget' );

/************************************************************/


/*************** MISCELLANEOUS FUNCTIONS ********************/

add_theme_support( 'automatic-feed-links' );
if ( ! isset( $content_width ) ) $content_width = 960;

// Redirect To Theme Options Page on Activation
if (is_admin() && isset($_GET['activated'])){
	wp_redirect(admin_url('admin.php?page=adminpanel'));
}

/************************************************************/
?>
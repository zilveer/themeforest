<?php

/*
 * wpml multi site config file
 * needs to be loaded before the framework
 */

require_once( 'config-wpml/config.php' );


##################################################################
# AVIA FRAMEWORK by Kriesi

# this include calls a file that automatically includes all
# the files within the folder framework and therefore makes
# all functions and classes available for later use

add_theme_support('avia_mega_menu');
require_once( 'framework/avia_framework.php' );

##################################################################


//register additional image thumbnail sizes that should be generated when user uploads an image:
global $avia_config;

$avia_config['imgSize']['widget'] 		= array('width'=>36,  'height'=>36 );		// small preview pics eg sidebar news
$avia_config['imgSize']['small'] 		= array('width'=>130, 'height'=>130);		// small images for small blog overview images
$avia_config['imgSize']['related'] 		= array('width'=>163, 'height'=>120);		// small images for related items
$avia_config['imgSize']['page'] 		= array('width'=>690, 'height'=>200);		// image for pages and one column portfolio
$avia_config['imgSize']['blog'] 		= array('width'=>530, 'height'=>255);		// image for blog posts (big)
$avia_config['imgSize']['featured'] 	= array('width'=>930, 'height'=>340);		// big images for fullsize pages and fullsize 2D & 3D slider
$avia_config['imgSize']['fullsize'] 	= array('width'=>930, 'height'=>930, 'crop'=>false);		// big images for lightbox
$avia_config['imgSize']['aviacordion'] 	= array('width'=>697, 'height'=>340);		// big Image for aviacordion
$avia_config['imgSize']['slide_thumbs'] = array('width'=>210, 'height'=>100);		// small preview pic for slideshow thumbs


/*preview images for special column sizes of the dynamic template. you can remove those if you dont use them, it will save performance while uploading images and will also save ftp storage*/
$avia_config['imgSize']['portfolio4'] 	= array('width'=>210, 'height'=>120);		// small preview pic for default portfolio (4 columns )
$avia_config['imgSize']['portfolio3'] 	= array('width'=>290, 'height'=>150);		// medium preview pic for 3 column portfolio
$avia_config['imgSize']['portfolio3_sb']= array('width'=>210, 'height'=>120);		// medium preview pic for 3 column portfolio with sidebar
$avia_config['imgSize']['portfolio2'] 	= array('width'=>450, 'height'=>300);		// medium preview pic for 2 column portfolio and small 3d slider
$avia_config['imgSize']['grid6'] 		= array('width'=>450, 'height'=>120); 		// half sized images when using 4 columns
$avia_config['imgSize']['grid8'] 		= array('width'=>450, 'height'=>120);		// two/third image
$avia_config['imgSize']['grid9'] 		= array('width'=>690, 'height'=>120);		// three/fourth image


///////



avia_backend_add_thumbnail_size($avia_config);





/*
 * compat mode for easier theme switching from one avia framework theme to another
 */
add_theme_support( 'avia_post_meta_compat');

##################################################################
# Frontend Stuff necessary for the theme:
##################################################################


$lang = TEMPLATEPATH . '/lang';
load_theme_textdomain('avia_framework', $lang);


/* Register frontend javascripts: */
/* Register frontend javascripts: */
if(!is_admin()){
	add_action('init', 'avia_frontend_js');
}

function avia_frontend_js()
{
	wp_register_script( 'avia-default', AVIA_BASE_URL.'js/avia.js', array('jquery','avia-html5-video'), 1, false );
	wp_register_script( 'avia-prettyPhoto',  AVIA_BASE_URL.'js/prettyPhoto/js/jquery.prettyPhoto.js', 'jquery', "3.0.1", true);
	wp_register_script( 'avia-html5-video',  AVIA_BASE_URL.'js/projekktor/projekktor.min.js', 'jquery', "1", true);
	wp_register_script( 'avia-slider',  AVIA_BASE_URL.'js/aviaslider-dev.js', 'jquery', "2.5.2", true);
	wp_register_script( 'aviacordion',  AVIA_BASE_URL.'js/aviacordion-dev.js', 'jquery', "1.0.0", true);
	wp_register_script( 'avia_fade_slider',  AVIA_BASE_URL.'js/avia_fade_slider-dev.js', 'jquery', "1.0.0", true);
}


/* Activate native wordpress navigation menu and register a menu location */
add_theme_support('nav_menus');
$avia_config['nav_menus'] = array('avia' => 'Main Menu', 'avia2'=> 'Sub Menu');
foreach($avia_config['nav_menus'] as $key => $value){ register_nav_menu($key, THEMENAME.' '.$value); }




//load some frontend functions in folder include:

require_once( 'includes/admin/register-widget-area.php' );		// register sidebar widgets for the sidebar and footer
require_once( 'includes/admin/register-styles.php' );			// register the styles for dynamic frontend styling
require_once( 'includes/admin/register-shortcodes.php' );		// register wordpress shortcodes
require_once( 'includes/loop-comments.php' );					// necessary to display the comments properly
require_once( 'includes/helper-slideshow.php' ); 				// holds the class that generates the 2d & 3d slideshows, as well as feature images
require_once( 'includes/helper-templates.php' ); 				// holds some helper functions necessary for dynamic templates
require_once( 'includes/admin/compat.php' );					// compatibility functions for 3rd party plugins

//adds the woocommerce initalisation scripts that add styles and functions
require_once( 'woocommerce-config/config.php' );

//activate framework widgets
register_widget( 'avia_tweetbox');
register_widget( 'avia_newsbox' );
//register_widget( 'avia_portfoliobox' );
register_widget( 'avia_socialcount' );
register_widget( 'avia_combo_widget' );
register_widget( 'avia_partner_widget' );

//call functions for the theme
add_filter('the_content_more_link', 'avia_remove_more_jump_link');
add_post_type_support('page', 'excerpt');


//allow mp4, webm and ogv file uploads
add_filter('upload_mimes','avia_upload_mimes');
function avia_upload_mimes($mimes){ return array_merge($mimes, array ('mp4' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm')); }


//change default thumbnail size on theme activation
add_action('avia_backend_theme_activation', 'avia_set_thumb_size');
function avia_set_thumb_size() {update_option( 'thumbnail_size_h', 80 ); update_option( 'thumbnail_size_w', 80 );}

//remove post thumbnails from pages, posts and various custom post types
if(!function_exists('avia_remove_post_thumbnails'))
{
	add_theme_support( 'post-thumbnails' );

	add_action('posts_selection', 'avia_remove_post_thumbnails');
	add_action('init', 'avia_remove_post_thumbnails');
	add_filter('post_updated_messages','avia_remove_post_thumbnails');
	function avia_remove_post_thumbnails($msg)
	{
		global $post_type;
		$remove_when = array('post','page');

		if(is_admin())
		{
			foreach($remove_when as $remove)
			{
				if($post_type == $remove || (isset($_GET['post_type']) && $_GET['post_type'] == $remove)) { remove_theme_support( 'post-thumbnails' ); };
			}
		}

		return $msg;
	}
}





/*advanced title + breadcrumb function*/
function avia_title($post = "", $_product = "", $title = "")
{
	if(!$_product)
	{
		global $product;
		$_product = $product;
	}

	if(!$title) $title = get_the_title();
	if(!$title)
	{
		$id = avia_get_the_ID();
		$title = get_the_title($id);
	}


	echo "<div class='title_container'>";
	if(!is_front_page()) echo avia_breadcrumbs();
	echo '<h1 class="page-title">'.$title.'</h1>';
	if($_product && is_singular())
	{
		echo "<div class='price_container'>";
		woocommerce_template_single_price($post, $_product);
		echo "</div>";
	}
	echo "</div>";
}



/*wordpress 3.4 changed 404 check -  this is the mod for the avia framework to operate*/
function avia_disable_404( $query = false ) {

	global $avia_config, $wp_query;

	if(!isset($avia_config['first_query_run']) && is_front_page() && is_paged())
	{
		$wp_query->is_paged = false;
		$avia_config['first_query_run'] = true;
		add_action( 'wp', 'avia_enable_404' );
	}
}

function avia_enable_404() {

	global $wp_query;
	$wp_query->is_paged = true;

}

add_action( 'pre_get_posts', 'avia_disable_404' ,1 ,10000);

// deactivate default theme seo if third party plugin is used. Currently supported plugins: Yoast WP SEO and All in One SEO
if(defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) $avia_config['deactivate_seo'] = true;
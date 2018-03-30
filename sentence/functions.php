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

require_once( 'framework/avia_framework.php' );

##################################################################


//register additional image thumbnail sizes that should be generated when user uploads an image:
global $avia_config;

$avia_config['imgSize']['widget'] 			 	= array('width'=>36,  'height'=>36 );						// small preview pics eg sidebar news
$avia_config['imgSize']['fullsize'] 		 	= array('width'=>930, 'height'=>930, 'crop'=>false);		// big images for lightbox
$avia_config['imgSize']['featured'] 		 	= array('width'=>765, 'height'=>415);						// images for fullsize pages and fullsize slider
$avia_config['imgSize']['portfolio'] 		 	= array('width'=>765, 'height'=>10000, 'crop'=>false);		// images for single portfolio entries
$avia_config['imgSize']['portfolio_fixed'] 		= array('width'=>410, 'height'=>300);						// images for related portfolio entries


avia_backend_add_thumbnail_size($avia_config);



/*
 * compat mode for easier theme switching from one avia framework theme to another
 */
add_theme_support( 'avia_post_meta_compat');



##################################################################
# Frontend Stuff necessary for the theme:
##################################################################
$avia_config['content_class'] = 'eight alpha';

$lang = TEMPLATEPATH . '/lang';
load_theme_textdomain('avia_framework', $lang);


/* Register frontend javascripts: */
if(!is_admin()){
	add_action('init', 'avia_frontend_js');
}

function avia_frontend_js()
{
	wp_register_script( 'avia-default', AVIA_BASE_URL.'js/avia.js', array('jquery'), 2, false );
	wp_register_script( 'avia-prettyPhoto',  AVIA_BASE_URL.'js/prettyPhoto/js/jquery.prettyPhoto.js', 'jquery', "3.0.1", true);
	//wp_register_script( 'avia-html5-video',  AVIA_BASE_URL.'js/projekktor/projekktor.min.js', 'jquery', "1", true);
	wp_register_script( 'aviapoly-slider',  AVIA_BASE_URL.'js/aviapoly.js', 'jquery', "1.1.0", true);
}



/* Activate native wordpress navigation menu and register a menu location */
add_theme_support('nav_menus');
$avia_config['nav_menus'] = array('avia' => 'Main Menu');
foreach($avia_config['nav_menus'] as $key => $value){ register_nav_menu($key, THEMENAME.' '.$value); }


//load some frontend functions in folder include:

require_once( 'includes/admin/register-portfolio.php' );		// register custom post types for portfolio entries
require_once( 'includes/admin/register-widget-area.php' );		// register sidebar widgets for the sidebar and footer
require_once( 'css/dynamic-css.php' );							// register the styles for dynamic frontend styling
require_once( 'includes/admin/register-shortcodes.php' );		// register wordpress shortcodes
require_once( 'includes/loop-comments.php' );					// necessary to display the comments properly
require_once( 'includes/helper-slideshow.php' ); 				// holds the class that generates the 2d & 3d slideshows, as well as feature images
require_once( 'includes/helper-templates.php' ); 				// holds some helper functions necessary for dynamic templates
require_once( 'includes/helper-social-media.php' ); 			// holds some helper functions necessary for twitter and facebook buttons
require_once( 'includes/admin/compat.php' );					// compatibility functions for 3rd party plugins
require_once( 'includes/admin/register-menu-walker.php' );		// menu walker for advanced menu output







//activate framework widgets

register_widget( 'avia_newsbox' );
register_widget( 'avia_portfoliobox' );
register_widget( 'avia_socialcount' );
register_widget( 'avia_combo_widget' );
register_widget( 'avia_partner_widget' );




//add post format options
add_theme_support( 'post-formats', array('link', 'quote', 'image', 'gallery', 'video' ) );






######################################################################
# CUSTOM THEME FUNCTIONS
######################################################################


//call functions for the theme
add_filter('the_content_more_link', 'avia_remove_more_jump_link');
add_post_type_support('page', 'excerpt');


//allow mp4, webm and ogv file uploads
add_filter('upload_mimes','avia_upload_mimes');
function avia_upload_mimes($mimes){ return array_merge($mimes, array ('mp4' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm')); }


add_filter('avia_ampersand','avia_ampersand');
function avia_ampersand($content){
$content = str_replace(" &amp; "," <span class='special_amp'>&amp;</span> ",$content);
$content = str_replace(" &#038; "," <span class='special_amp'>&amp;</span> ",$content);
return $content; }

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
		$remove_when = array('post','page','portfolio');

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






######################################################################
# /*advanced title + subtitle function*/
######################################################################
function avia_title($title = "", $subtitle = false, $meta = false, $extraClass = "")
{
	if(is_object($title)) $title = $title->post_title;
	if(!$title) $title = get_the_title(avia_get_the_id());

	if(!$meta) $extraClass .= " no_padding_title";
	if($subtitle === false) $subtitle = avia_post_meta('subtitle');

	echo "<div class='$extraClass title_container extralight-border'>";
	echo '<h1 class="page-title heading-color">'.$title.'</h1>';
	if($subtitle) echo '<div class="page-subtitle meta-color">'.do_shortcode($subtitle).'</div>';
	echo '<span class="extralight-border seperator-addon seperator-bottom"></span>';


	/*
	*	display the theme search form
	*   the tempalte file that is called is searchform.php in case you want to edit it
	*/
	if($meta !== false)
	{
		echo "<div class='title_meta'>";
		if($meta === true)
		{
			get_search_form();
		}
		else if(function_exists($meta))
		{
			$meta();
		}
		echo "</div>";
	}

	echo "</div>";
}



######################################################################
# /*crates the hr separator with the colored flag by using divs without images. Therefore complete color customization from the backend is possible */
######################################################################
function avia_advanced_hr($text = "", $class = "")
{
	$output  = "";
	$output .= '<div class="hr hr_flag '.$class.'">';

	if($text !== false)
	{
		$output .= '		<div class="primary-background hr_color">';
		$output .= '    		<span class="flag-text on-primary-color">'.$text.'</span>';
		$output .= '    	</div>';
	}
	else
	{
		$output .= '    	<span class="primary-background seperator-addon"></span>';
	}

	$output .= '    	<span class="hr-seperator extralight-border"></span>';
	$output .= '</div>';

	return $output;
}



######################################################################
# set post excerpt to be visible on theme acivation in user backend
######################################################################
//add_action('avia_backend_theme_activation', 'avia_show_excerpt');
function avia_show_excerpt()
{
	global $current_user;
    get_currentuserinfo();
	$old_meta_data = $meta_data = get_user_meta($current_user->ID, 'metaboxhidden_page', true);

	if(is_array($meta_data) && isset($meta_data[0]))
	{
		$key = array_search('postexcerpt', $meta_data);

		if($key !== false)
		{
			unset($meta_data[$key]);
			update_user_meta( $current_user->ID, 'metaboxhidden_page', $meta_data, $old_meta_data );
		}
	}
	else
	{
			update_user_meta( $current_user->ID, 'metaboxhidden_page', array('postcustom', 'commentstatusdiv', 'commentsdiv', 'slugdiv', 'authordiv', 'revisionsdiv') );
	}
}


######################################################################
# set menu description to be visible on theme acivation
######################################################################
add_action('avia_backend_theme_activation', 'avia_show_menu_description');
function avia_show_menu_description()
{
	global $current_user;
    get_currentuserinfo();
	$old_meta_data = $meta_data = get_user_meta($current_user->ID, 'managenav-menuscolumnshidden', true);

	if(is_array($meta_data) && isset($meta_data[0]))
	{
		$key = array_search('description', $meta_data);

		if($key !== false)
		{
			unset($meta_data[$key]);
			update_user_meta( $current_user->ID, 'managenav-menuscolumnshidden', $meta_data, $old_meta_data );
		}
	}
	else
	{
			update_user_meta( $current_user->ID, 'managenav-menuscolumnshidden', array('link-target', 'css-classes', 'xfn') );
	}
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
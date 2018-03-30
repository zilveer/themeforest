<?php



global $avia_config;
if(isset($avia_config['use_child_theme_functions_only'])) return;

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

$avia_config['imgSize']['widget'] 		= array('width'=>48,  'height'=>48 );						// small preview pics eg sidebar news, fullscreen slideshow thumbnails
$avia_config['imgSize']['related'] 		= array('width'=>130, 'height'=>130);						// small images for related items
$avia_config['imgSize']['masonry'] 		= array('width'=>240, 'height'=>9999, 'crop'=>false);		// masonry images
$avia_config['imgSize']['portfolio'] 	= array('width'=>200, 'height'=>140);						// medium preview pic portfolio
$avia_config['imgSize']['blog'] 		= array('width'=>430, 'height'=>9999, 'crop'=>false);		// image for blog posts
$avia_config['imgSize']['fullsize'] 	= array('width'=>1500, 'height'=>1500, 'crop'=>false);		// big images for fuöösize slider


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

if(!function_exists('avia_frontend_js'))
{
	function avia_frontend_js()
	{
		wp_register_script( 'avia-default', AVIA_BASE_URL.'js/avia.js', array('jquery','avia-html5-video'), 1, false );
		wp_register_script( 'avia-prettyPhoto',  AVIA_BASE_URL.'js/prettyPhoto/js/jquery.prettyPhoto.js', 'jquery', "3.0.1", true);
		wp_register_script( 'avia-html5-video',  AVIA_BASE_URL.'js/projekktor/projekktor.min.js', 'jquery', "1", true);
		wp_register_script( 'avia_fullscreen_slider',  AVIA_BASE_URL.'js/avia_fullscreen_slider.js', 'jquery', "1.0.0", true);
		wp_register_script( 'avia_fade_slider',  AVIA_BASE_URL.'js/avia_fade_slider.js', 'jquery', "1.0.0", true);
		wp_register_script( 'avia_masonry',  AVIA_BASE_URL.'js/jquery.masonry.min.js', 'jquery', "1.0.0", true);
	}
}

//adds the woocommerce initalisation scripts that add styles and functions
require_once( 'woocommerce-config/config.php' );



/* Activate native wordpress navigation menu and register a menu location */
add_theme_support('nav_menus');
$avia_config['nav_menus'] = array('avia' => 'Main Menu');
if(function_exists('avia_woocommerce_enabled') && avia_woocommerce_enabled()) $avia_config['nav_menus']['avia2'] = "Shop Menu";
foreach($avia_config['nav_menus'] as $key => $value){ register_nav_menu($key, THEMENAME.' '.$value); }




//load some frontend functions in folder include:

require_once( 'includes/admin/register-widget-area.php' );		// register sidebar widgets for the sidebar and footer
require_once( 'includes/admin/register-portfolio.php' );		// register custom post types for portfolio entries
require_once( 'includes/admin/register-styles.php' );			// register the styles for dynamic frontend styling
require_once( 'includes/admin/register-shortcodes.php' );		// register wordpress shortcodes
require_once( 'includes/loop-comments.php' );					// necessary to display the comments properly
require_once( 'includes/helper-slideshow.php' ); 				// holds the class that generates the 2d & 3d slideshows, as well as feature images
require_once( 'includes/helper-templates.php' ); 				// holds some helper functions necessary for dynamic templates
require_once( 'includes/admin/compat.php' );					// compatibility functions for 3rd party plugins
require_once( 'includes/admin/register-menu-walker.php' );		// custom menu walker that allows for description bellow the menu item
require_once( 'includes/admin/register-plugins.php' );			// registers plugin loader



//activate framework widgets

register_widget( 'avia_newsbox' );
register_widget( 'avia_portfoliobox' );
register_widget( 'avia_socialcount' );
if(!is_admin()) register_widget( 'avia_combo_widget' );

//register_widget( 'avia_partner_widget' );

//call functions for the theme
add_filter('the_content_more_link', 'avia_remove_more_jump_link');
add_post_type_support('page', 'excerpt');


//allow mp4, webm and ogv file uploads
add_filter('upload_mimes','avia_upload_mimes');
if(!function_exists('avia_upload_mimes'))
{
	function avia_upload_mimes($mimes){ return array_merge($mimes, array ('mp4' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm')); }
}

//change default thumbnail size on theme activation
add_action('avia_backend_theme_activation', 'avia_set_thumb_size');
if(!function_exists('avia_set_thumb_size'))
{
	function avia_set_thumb_size() {update_option( 'thumbnail_size_h', 80 ); update_option( 'thumbnail_size_w', 80 );}
}

//set menu description to be visible on theme acivation
add_action('avia_backend_theme_activation', 'avia_show_menu_description');
if(!function_exists('avia_show_menu_description'))
{
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
}

//add thumbnail support only for frontend so the user doesnt see the backend interface which gets automatically populated by the theme
//remove post thumbnails from page and posts
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










/*converter for old to new image gallery*/

add_action( 'admin_init', 'avia_convert_flashlight_galleries');
add_action( 'avia_after_import_hook', 'avia_do_gallery_conversion');


function avia_convert_flashlight_galleries()
{
	if(!get_option('avia_images_converted'))
	{
		avia_do_gallery_conversion();
		//set the avia_images_converted key so this function will never be executed again
		update_option('avia_images_converted', 1);
	}
}


function avia_do_gallery_conversion()
{
		$post_types = array('post','page','portfolio','product');
		$count = 0;

		//iterate over each post type
		foreach($post_types as $type)
		{
			//get all posts of a certain type
			$the_query = new WP_Query( array('post_type' => $type, 'posts_per_page'=>-1) );

			//check if any post were retrieved
			if(!empty($the_query->posts))
			{
				//iterate over each post and check if the post has a gallery key
				foreach($the_query->posts as $entry)
				{
					//since there might be hundreds of posts make sure php doesnt time out
					@set_time_limit(45);

					$post_id =  $entry->ID;

					//get meta array and check for the gallery_image key
					$meta = avia_post_meta($post_id);
					if(!empty($meta['gallery_image']))
					{
						//check if the current post has a hidden post attached
						$attachment_holder = avia_get_post_by_title( "avia_smart-gallery-of-post-".$meta['gallery_image']);

						if(!empty($attachment_holder['ID']))
					    {
					    	//check if the hidden image-contaienr post has attachments
					        $attachments = get_children(array('post_parent' => $attachment_holder['ID'],
					            'post_type' => 'attachment',
					            'post_mime_type' => 'image',
					            'order' => 'ASC',
                        		'orderby' => 'menu_order ID'));

							//if images were found convert them to an array and save that array as slideshow meta array so it can be used by the new image manager
					        if(!empty($attachments))
					        {
					        	$slides = array();

					            foreach($attachments as $attachment)
					            {
					            	//attach image to real post instead of the hidden avia_framework_post so that the [gallery] shortcode works
					            	$update = array();
  									$update['ID'] = $attachment->ID;
  									$update['post_parent'] = $post_id;
					            	wp_update_post( $update );

					            	//create the slides array and then save it as meta value
					            	$caption = empty($attachment->post_content) ? $attachment->post_excerpt : $attachment->post_content;

					                $slides[] = array(
					                			'slideshow_image' => $attachment->ID,
					                			'slideshow_caption_title' => $attachment->post_title,
					                			'slideshow_caption'	=> $caption
					                			);
					            }

					            if(!empty($slides))
					            {
					            	$meta['slideshow'] = $slides;
					            }
					        }
						}

						// wheter or not we found any images, destroy the linking to hidden post by renaming the key.
						$meta['gallery_image'] = $meta['gallery_image']."-imported";
						update_post_meta($post_id , '_avia_elements_theme_compatibility_mode', $meta);

					}
				}
			}
		}

}

// deactivate default theme seo if third party plugin is used. Currently supported plugins: Yoast WP SEO and All in One SEO
if(defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) $avia_config['deactivate_seo'] = true;

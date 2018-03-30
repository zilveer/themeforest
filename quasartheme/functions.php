<?php

/*Globals*/

//Debug mode
//define('ROCK_DEBUG',true);

//Demo Mode
//define('ROCK_DEMO', true);


//Define the required global file ways.
if(!defined('F_WAY')):
define('F_WAY', get_template_directory_uri());
endif;


/**
 * Sets up the content width value based on the theme's design.
 * @see quasar_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 900;

if(!function_exists('quasar_after_setup')):
//Activate Theme Theme Domain
function quasar_after_setup() {
 
    // Retrieve the directory for the localization files
    $lang_dir = get_template_directory() . '/languages';
     
    // Set the theme's text domain using the unique identifier from above
    load_theme_textdomain('quasar', $lang_dir);
	
	/*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );
	
		
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	//add_editor_style( array( 'css/editor-style.css', 'css/font-awesome.css') );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'quasar' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
 
} // end custom_theme_setup
endif;
add_action('after_setup_theme', 'quasar_after_setup');


/*
**	Global functions included earlier to use special global variables and functions
**	in all theme files
*/
include_once(get_template_directory().'/libs/global-functions.php');




if(!function_exists('quasar_enqueue_frontend_files')):
/*
**	Enqueue all frontend files. All default styles and javascript files enqueued here. 
**
**	Some feature specific files are not enqueued here for better performance
**
*/
function quasar_enqueue_frontend_files(){
	global $rockthemes_browser;
	
	$dec = '';

	
	//Wordpress Default Style (Specially for tinyMCE Content)
	wp_enqueue_style( 'wp-core', F_WAY.'/css/wp-core.css', '', '', 'all' );
	
	//Responsive Foundation Layout
	wp_enqueue_style( 'foundation-elements', F_WAY.'/css/foundation-scss.css', '', '', 'all' );
	
	/*
	**	Disabled for W3 Total Cache and BWM
	*/
	//if($rockthemes_browser && strpos($rockthemes_browser['name'],'xplorer') > -1 && intval($rockthemes_browser['version']) < 9){
		wp_enqueue_style( 'foundation-ie7', F_WAY.'/css/foundation-ie8.css', '', '', 'all' );
	//}
	
	
	//IcoMoon
	wp_enqueue_style('icomoon-css',  F_WAY.'/css/icomoon.css', '','', 'all');
	
	//FontAwesome 
	wp_enqueue_style('font-awesome-css',  F_WAY.'/css/font-awesome.min.css', '','', 'all');
	
	//Buttons
	wp_enqueue_style('quasar-buttons',  F_WAY.'/css/buttons.css', '','', 'all');
	
	//Loads our main stylesheet.
	wp_enqueue_style( 'quasar-style', get_stylesheet_uri() );
	
	//Load Menu Stylesheet
	wp_enqueue_style( 'quasar-menu-style', F_WAY.'/menu-ltr.css','','','all' );
	
	/*Responsivity*/
	$disable_responsivity = xr_get_option('disable_responsivity',false);
	if($disable_responsivity){
		//Responsivity disabled
		wp_enqueue_style( 'foundation-nonresponsive', F_WAY.'/css/foundation-nonresponsive.css', '', '', 'all' );
	}else{
		//Responsive Design
		wp_enqueue_style( 'quasar-media-queries', F_WAY.'/media-queries.css', '', '', 'all' );
	}
	
	/*
	 *	Check if user using dynamic.css mode. Otherwise activate wp_footer action
	 */
	if(xr_get_option('content_padding','') == '10px'){
		//Enqueue dynamic.css
	}else{
		add_filter('wp_head', 'xr_style_callback'); //TO DO : add_action ?
	}
		
		
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('jquery-color');
	
	wp_enqueue_script('jquery-effects-core');
	
	wp_enqueue_script('modernizr-js', F_WAY.'/js/modernizr.js', array('jquery'));
	
	
	wp_enqueue_script('jquery-parallax', F_WAY.'/js/jquery-parallax-set.min.js', array('jquery'));
	
	wp_enqueue_script('rockthemes-parallax', F_WAY.'/js/rockthemes-parallax.min.js', array('jquery'));
	
	wp_enqueue_script('quasar-jquery', F_WAY.'/js/quasar.jquery.min.js', array('jquery'));
	
	wp_enqueue_script('navgoco-jquery', F_WAY.'/js/jquery.navgoco.min.js', array('jquery'));
	
	$ajax_call = array('ajaxurl' => admin_url('admin-ajax.php'), 'ajax_nonce' => wp_create_nonce("rockthemes_security_nonce"), 'f_way' => F_WAY,
					   'frontend_options' => array(
					   		'activate_smooth_scroll' 		=>	xr_get_option('activate_smooth_scroll', false),
							'disable_top_links_for_ipad'	=>	xr_get_option('disable_top_links_for_ipad', true),
					   ));
	
	wp_localize_script('quasar-jquery', 'rockthemes', $ajax_call);
		
	//Some Hooks
	if(xr_get_option('google_analytics_code', '') !== ''){
		add_action('wp_footer', 'quasar_google_analytics_hook');
	}

}
endif;
add_action('wp_enqueue_scripts','quasar_enqueue_frontend_files');



/*
**	Load Required files and Softwares. These files contains special options and features.
*/

//Rock Options
include_once(get_template_directory().'/rock-options/options_loader.php');

//Load Rock Wigets
include_once(get_template_directory().'/rock-widgets/load_widgets.php');

//Rock Page Builder
include_once(get_template_directory().'/rock-builder/rock-builder.php');

//Rock Page Builder
include_once(get_template_directory().'/rock-builder/rock-builder-ui.php');

//Shortcodes get_stylesheet_directory() should be used in the child theme
include_once(get_template_directory().'/shortcodes.php');

//Post meta, Plugins, Widgets (Custom Sidebar)
include_once(get_template_directory().'/post_meta.php');






//Plugin Activation (Now Mandatory for Themeforest)
if ((defined( 'ROCK_DEMO' ) && ROCK_DEMO)){
	include_once(get_template_directory().'/rock-style-editor/demo-style-editor.php');
}


//Plugin Activation (Now Mandatory for Themeforest)
if ((defined( 'WP_ADMIN' ) && WP_ADMIN )){
	include_once(get_template_directory().'/libs/plugin-activation.php');
}

//compatibility with woocommerce plugin
if(rockthemes_woocommerce_active()){
	include_once(get_template_directory().'/woocommerce-settings.php');
}






if(!function_exists('quasar_before_page_content')):
/*
**	Rock Before Page hook is called right after "get_header()" function in pages
**	
**	This function adds specific details and options according to the page
**
*/
function quasar_before_page_content(){
	global $post, $wp_query, $quasar_disable_regular_title, $rockthemes_advanced_post_details;
	
	$rockthemes_advanced_post_details = rockthemes_ad_get_post_details_metabox();
	
	$current_page_id = $wp_query->get_queried_object_id();
	
	echo '</div></div>';
	
	
	if(is_array($rockthemes_advanced_post_details) && 
	(isset($rockthemes_advanced_post_details['disable_title_breadcrumbs_area']) && 
	$rockthemes_advanced_post_details['disable_title_breadcrumbs_area'] === 'true')){
		//Do not include anything if disabled
		if(rockthemes_woocommerce_active() && is_woocommerce()){
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
		}
	}elseif(xr_get_option('disable_breadcrumbs_title_area', false)){
		//Get the title and breadcrumb template
		//get_template_part('title','default');
		
		$quasar_disable_regular_title = true;
	}else{
		//Get the title and breadcrumb template
		get_template_part('title','default');
		
		$quasar_disable_regular_title = true;
	}
	
	//Deactivate regular title entirely
	$quasar_disable_regular_title = true;

	
	if(is_array($rockthemes_advanced_post_details) && 
	(isset($rockthemes_advanced_post_details['activate_space_under_menu']))){
		if($rockthemes_advanced_post_details['activate_space_under_menu'] === 'true'){
			//Add extra vertical spacing
			echo '<div class="vertical-space"></div>';
		}
	}elseif(!xr_get_option('disable_space_under_header', false)){
		//Add extra vertical spacing
		echo '<div class="vertical-space"></div>';
	}
	
	
	echo '<div class="row">';
}

endif;
add_action('rockthemes_pb_frontend_before_page','quasar_before_page_content', 1);





if(!function_exists('quasar_after_page_content')):
/*
**	Rock After Page hook is called right before "get_footer()" function in pages
**	
**	This function adds specific details and options according to the page
**
*/
function quasar_after_page_content(){
	global $rockthemes_advanced_post_details;
	
	//Clear any uncleared float
	echo '<div class="clear"></div>';
		
	if((isset($rockthemes_advanced_post_details['activate_space_under_menu']))){
		if($rockthemes_advanced_post_details['activate_space_under_menu'] === 'true'){
			//Add extra vertical spacing
			echo '<div class="vertical-space"></div>';
		}
	}elseif(!xr_get_option('disable_space_under_header', false)){
		//Add extra vertical spacing
		echo '<div class="vertical-space"></div>';
	}
	
	//Add an empty div for footer to close. This way both Quasar and 3rd party pages will stay in layout.
	echo '<div>';
}

endif;
add_action('rockthemes_pb_frontend_after_page','quasar_after_page_content', 1);






if(!function_exists('quasar_after_header_title_hook')):
/*
**	This function or hook can be used to add extra content after header title and breadcrumbs.
**	This function is called from "title-default.php"
**
*/
function quasar_after_header_title_hook(){
	//Do Nothing
}
endif;
add_action('quasar_after_header_title','quasar_after_header_title_hook');


if(!function_exists('quasar_before_footer_hook')):
/*
**	This function or hook can be used to add extra content before footer.
**	This function is called from "footer.php"
**
*/
function quasar_before_footer_hook(){
	//Do Nothing
}
endif;
add_action('quasar_before_footer','quasar_before_footer_hook');







/*
**	Set Image sizes as default. Dimension 4/3
*/

//Ajax Filtered Hover
$rockthemes_ajax_filtered_hover_width = xr_get_option('ajax_filtered_hover_width','590px');
$rockthemes_ajax_filtered_hover_height = xr_get_option('ajax_filtered_hover_height','300px');
add_image_size('ajax-filtered-hover',$rockthemes_ajax_filtered_hover_width,$rockthemes_ajax_filtered_hover_height,true);
//Ajax Filtered
$rockthemes_ajaxfiltered_thumbnail_width = xr_get_option('rockthemes_ajaxfiltered_thumbnail_width','125px');
$rockthemes_ajaxfiltered_thumbnail_height = xr_get_option('rockthemes_ajaxfiltered_thumbnail_height','125px');
add_image_size('rockthemes_ajaxfiltered_thumbnail',$rockthemes_ajaxfiltered_thumbnail_width,$rockthemes_ajaxfiltered_thumbnail_height,true);
/*
//Portfolio List Wide Screen Image : Ratio 16 / 9
$rockthemes_portfolio_list_image_width = xr_get_option('rockthemes_portfolio_list_image_width','125px');
$rockthemes_portfolio_list_image_height = xr_get_option('rockthemes_portfolio_list_image_height','125px');
add_image_size('rockthemes_ajaxfiltered_thumbnail',$rockthemes_ajaxfiltered_thumbnail_width,$rockthemes_ajaxfiltered_thumbnail_height,true);
*/
//General Image Thumbnail
$rockthemes_thumbnail_image_width = xr_get_option('rockthemes_thumbnail_image_width','200px');
$rockthemes_thumbnail_image_height = xr_get_option('rockthemes_thumbnail_image_height','150px');
add_image_size('rockthemes_thumbnail',$rockthemes_thumbnail_image_width,$rockthemes_thumbnail_image_height,true);
//General Image Medium
$rockthemes_medium_image_width = xr_get_option('rockthemes_medium_image_width','400px');
$rockthemes_medium_image_height = xr_get_option('rockthemes_medium_image_height','200px');
add_image_size('rockthemes_medium',$rockthemes_medium_image_width,$rockthemes_medium_image_height,true);
//General Image Large
$rockthemes_large_image_width = xr_get_option('rockthemes_large_image_width','960px');
$rockthemes_large_image_height = xr_get_option('rockthemes_large_image_height','720px');
add_image_size('rockthemes_large',$rockthemes_large_image_width,$rockthemes_large_image_height,true);
//General Featured Image (Mostly for blog posts)
$rockthemes_featured_image_width = xr_get_option('rockthemes_featured_image_width','960px');
$rockthemes_featured_image_height = xr_get_option('rockthemes_featured_image_height','720px');
add_image_size('rockthemes_featured',$rockthemes_featured_image_width,$rockthemes_featured_image_height,true);






if(!function_exists('quasar_register_products')):
/*
**	Quasar Custom Post Type Products
**	We use custom post type for products. This function will register the custom post type and it's taxonomy
**
**	@return	:	Void
*/
function quasar_register_products(){
	//'menu_icon' => F_WAY .'/images/admin-icons/products.png',
	register_post_type('quasarproducts', array(
		'label' => 'Quasar Products',
		'singular_label' => 'Quasar Product',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'page',
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> false,
		'hierarchical' => false,
		'rewrite' => array(
			'slug' => xr_get_option('quasar_product_slug', 'quasarproducts'),
			'with_front' => false,
		  ),
		'query_var' => true,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', 'page-attributes' ),
		'show_in_nav_menus' 	=> true
	));
	register_taxonomy("quasarproduct_cat",
					 array("quasarproducts"), 
					 array("hierarchical" => true,
					 		"label" => __("Quasar Product Categories", "quasar"),
							"singular_label" => "Category",
							"rewrite" => array(
								"slug" => xr_get_option("quasar_product_category_slug", "quasarproduct_cat_slug"),
								"with_front"=>false
							)));
}
endif;
add_action('init', 'quasar_register_products');



if(!function_exists('quasar_register_gallery')):
/*
**	Quasar Custom Post Type Gallery
**	We use custom post type for gallery. This function will register the custom post type and it's taxonomy
**
**	@return	:	Void
*/
function quasar_register_gallery(){
	//'menu_icon' => F_WAY .'/images/admin-icons/products.png',
	register_post_type('quasargallery', array(
		'label' => 'Quasar Gallery',
		'singular_label' => 'Quasar Gallery',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'page',
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> false,
		'hierarchical' => false,
		'rewrite' => array(
			'slug' => xr_get_option('quasar_gallery_slug', 'gallery-item'),
			'with_front' => false,
		  ),
		'query_var' => true,
		'supports' => array('title', 'excerpt', 'thumbnail'),
		'show_in_nav_menus' 	=> true
	));
	register_taxonomy("quasargallery_cat",
					 array("quasargallery"), 
					 array("hierarchical" => true,
					 		"label" => __("Quasar Gallery Categories", "quasar"),
							"singular_label" => "Category",
							"rewrite" => array(
								"slug" => xr_get_option("quasar_gallery_category_slug", "gallery-category"),
								"with_front"=>false
							)));
}
endif;
add_action('init', 'quasar_register_gallery');





if(!function_exists('quasar_frontend_init')):
/*
** 	Add Required Filters
*/
function quasar_frontend_init(){
	add_post_type_support( 'post', 'excerpt');
}
endif;
add_action('init', 'quasar_frontend_init');





if(!function_exists('quasar_alter_default_comment_form')):
/*
**	Alter the Wordpress Comment Form values and variables
**
*/
function quasar_alter_default_comment_form($defaults){
	$fields = array('author' => '<div class="large-4 columns"><input name="author" id="author" class="comments-field inputs-class" title="'.__('Name :','quasar').'" type="text" value="'.__('Name :','quasar').'"></div>',
					'email' => '<div class="large-4 columns"><input name="email" id="email" class="comments-field inputs-class" style="margin-right:0px;" title="'.__('Email :','quasar').'" type="text" value="'.__('Email :','quasar').'"></div>',
					'url' => '<div class="large-4 columns"><input name="url" id="url" class="comments-field inputs-class" title="'.__('Website :','quasar').'" type="text" value="'.__('Website :','quasar').'"></div>');
	
	$defaults['fields'] = apply_filters( 'comment_form_default_fields', $fields );
	$defaults['title_reply'] = '<div class="leave-a-comment large-12 columns">'.__('Leave a Comment','quasar').'</div>';
    $defaults['comment_notes_before'] = '';
    $defaults['comment_notes_after'] = '';
	$defaults['comment_field'] = '<div class="large-12 columns"><textarea class="comments-field inputs-class" title="'.__('Your Message :','quasar').'" name="comment" id="comment" cols="45" rows="45">'.__('Your Message :','quasar').'</textarea></div>';
	$defaults['id_submit'] = 'comments-submit';

    return $defaults;
	//apply_filters( 'comment_form_defaults', $defaults );
}
endif;
add_filter('comment_form_defaults','quasar_alter_default_comment_form');






/*
**	Wrap content form with "row" divs.
**
**
*/
if(!function_exists('quasar_alter_comment_form_before')):
function quasar_alter_comment_form_before(){
	echo '<div class="row">';
}
endif;
add_action('comment_form_before','quasar_alter_comment_form_before');

if(!function_exists('quasar_alter_comment_form_after')):
function quasar_alter_comment_form_after(){
	echo '</div>';	
}
endif;
add_action('comment_form_after','quasar_alter_comment_form_after');







/*
**	You can always change the background in "Appearance > Background". This hook will activate
**	custom-background and add a default value
**
**
*/
$quasar_custom_background_args = array(
	'default-color' => 'f0f0f0',
	'default-image' => get_template_directory_uri() . '/images/demo/greyzz.png',
);
add_theme_support( 'custom-background', $quasar_custom_background_args );





/*
**	Core Functions. 
**	###############
**	
**	These functions should not be overriden. If you override any of these functions it may cause errors and conflicts
*/

if(!function_exists('rockthemes_get_image_id_from_url')):
/*
**	Some of our special elements allow you to choose different image size. This function will
**	retrive the "image id" according to the image url
**
**	@param	:	$image_url:String	URL of the image to get id from
**	@return	:	$attachment[0]:String	ID of the image
*/
function rockthemes_get_image_id_from_url($image_url) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
	if(!empty($attachment) && $attachment[0]){
        return $attachment[0]; 
	}else{
		$new_image_url = '';
		
		if(strpos($image_url, 'https') > -1){
			$new_image_url = str_replace('https', 'http', $image_url);
		}elseif(strpos($image_url, 'http') > -1){
			$new_image_url = str_replace('http', 'https', $image_url);
		}

		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $new_image_url)); 

		if(!empty($attachment) && $attachment[0]){
        		return $attachment[0]; 
		}	

	}
	return '';
}
endif;




if(!function_exists('rock_check_p')):
/*
**	To use TinyMCE in full power, we check if the string wrapped with "<p>" tags correctly
**
**	@param	:	$string:String	String to check if wrapped correctly
**	@return	:	$string:String	String wrapped with "<p>" tags
*/
function rock_check_p($string){
	return wpautop($string);
	
	if(substr($string,0,2) != '<p') return '<p>'.$string.'</p>';
	return $string;
}
endif;


/*
**	End of Core Functions
**	##################################
*/





/*
**	Wordpress's Required Functions
*/

if(!function_exists('quasar_content_width')):
/*
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @since Quasar 1.0
 *
 * @return void
 */
function quasar_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 900;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 800;
}
endif;
add_action( 'template_redirect', 'quasar_content_width' );



if(!function_exists('quasar_favico')):
/*
**	Add Favico to header
**	@since	:	Quasar 1.0
*/
function quasar_favico() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.xr_get_option('company_logo_favicon', F_WAY.'/images/demo/favico.ico').'" />';
}
endif;
add_action( 'wp_head', 'quasar_favico' );







/*
**	#######	Overridable Functions	#########
**	
**	Functions down below are overridable. This functions can be override by a child theme.
**	You can use our child theme to change any of these functions. You can also change these functions as well.
**	But we strongly recommend using a childtheme for file based changes to prevent any updating problem in further.
*/


/*
**	Alter title with site name and current page/post details. Improves the SEO
**
*/
if(!function_exists('quasar_wp_title_prefix')){
	function quasar_wp_title_prefix() {
		$title = '';
	 
		// Single post
		if ( is_single() ) {
			$title .= single_post_title( '', false );
			$title .= ' | ';
			$title .= get_bloginfo( 'name' );
		}
	 
		// Home page
		elseif ( is_home() ) {
			$title .= get_bloginfo( 'name' );
			$title .= ' | ';
			$title .= get_bloginfo( 'description' );
			if ( get_query_var( 'paged' ) )
				$title .= ' | ' . __( 'Page', 'quasar' ) . ' ' . get_query_var( 'paged' );
		}
	 
		// Static page
		elseif ( is_page() ) {
			$title .= single_post_title( '', false );
			$title .= ' | ';
			$title .= get_bloginfo( 'name' );
		}
		
		// Category page
		elseif ( is_category() ) {
			$title .= single_cat_title( '', false );
			$title .= ' | ';
			$title .= get_bloginfo( 'name' );
		}
	 
		// Search page
		elseif ( is_search() ) {
			$title .= get_bloginfo( 'name' );
			$title .= ' | '. __( 'Search Results for: '.get_search_query(), 'quasar' )  ; 
			if ( get_query_var( 'paged' ) )
				$title .= ' | ' . __( 'Page', 'quasar' ) . ' ' . get_query_var( 'paged' );
		}
	 
		// 404 not found error
		elseif ( is_404() ) {
			$title .= get_bloginfo( 'name' );
			$title .= ' | ' . __( 'Not Found', 'quasar' );
		}
	 
		// Anything else
		else {
			$title .= get_bloginfo( 'name' );
			if ( get_query_var( 'paged' ) )
				$title .= ' | ' . __( 'Page', 'quasar' ) . ' ' . get_query_var( 'paged' );
		}
	 
		return $title;
	}
}
if ( ! function_exists( '_wp_render_title_tag' ) ) :
	function quasar_slug_render_title() {
		echo '<title>' . wp_title( '|', false, 'right' ) . "</title>\n";
	}
	add_action( 'wp_head', 'quasar_slug_render_title' );
	add_filter( 'wp_title', 'quasar_wp_title_prefix', 1 );
endif;








/*
**	Uses theme options to check if user entered any Google Analytics Code. Adds action to
**	the footer if the user used Google Analytics Code.
**
**	@return	:	This function adds action hook to wp_footer. wp_footer will echo the function result
*/
if(!function_exists('quasar_google_analytics_hook')):
function quasar_google_analytics_hook(){
	echo '<div class="hide">';
		echo xr_get_option('google_analytics_code', '');
	echo '</div>';
}
endif;








if( ! function_exists('quasar_get_featured_image')):
/*
**	Gets the current posts featured image or video or images in Swiper Slider
**
**	@param	:	$echo Boolean, 
**	@param	:	$featured_image_size String, Optional image size - Default : rockthemes_featured
**	@return	:	Returns HTML of the values in order : Video, Swiper Slider, Image
**
*/
function quasar_get_featured_image($echo=true, $featured_image_size = 'rockthemes_featured', $hover_active = true){
	global $post, $rockthemes_advanced_details;
	
	$display_video_directly = true;
		
	if(!$rockthemes_advanced_details){
		$rockthemes_advanced_details = get_post_meta($post->ID,'advanced_post_details',true);	
	}
		
	$post_format = get_post_format();
	if($post_format === 'gallery') return;
	
	$return = '<div class="relative-container rockthemes-hover">';
	
	$media = '';
	
	//First check if there is a video for this post
	if(isset($rockthemes_advanced_details['video_iframe_code']) && !empty($rockthemes_advanced_details['video_iframe_code'])){
		//Post contains a video in the Advanced Details field
		if($display_video_directly){
			$media .= quasar_embed_video($rockthemes_advanced_details['video_iframe_code']);
		}
	}
	
	//Check if post contains extra images for Swiper Slider
	elseif(isset($rockthemes_advanced_details['extra_featured_images']) && 
		is_array($rockthemes_advanced_details['extra_featured_images']) && 
		count($rockthemes_advanced_details['extra_featured_images']) &&
		$rockthemes_advanced_details['extra_featured_images'][0] != ''){
		//There are extra images bound to this post. We will return as Swiper Slider
		$media .= rockthemes_make_swiperslider_shortcode($post->ID,$featured_image_size);
	}
	
	//There is no video or extra images for Swiper Slider. We will return regular Featured image with hover
	elseif(wp_get_attachment_image(get_post_thumbnail_id($post->ID),$featured_image_size)){
		$media .= wp_get_attachment_image(get_post_thumbnail_id($post->ID),$featured_image_size);
		if($hover_active){
			$media .= quasar_hover_effect($post->ID,true, ((isset($post) && is_single()) ? false : true));
		}
	}
	
	if($media){
		$return .= $media;	
	}else{
		return '';	
	}
	
	//If there is no value entered for the $return we will turn back as empty string.
	$return .= '</div>';//Close relative-container div
	
		
	if($echo) echo $return;
	else return $return;
}


endif;






if(!function_exists('quasar_embed_video')):
/*
**	Embed iframe videos in responsive container
**
**	@param	:	$url:String, URL of the video
**	@return	:	$return:String,	HTML iframe element wrapped in flex-video class
*/
function quasar_embed_video($url=null){
	if(!$url) return;
	
	$iframe_code = '';
	
	if(strpos($url, 'youtube') > -1){
		$iframe_code = str_replace('watch?v=', 'embed/', $url).'?rel=0';
	}
	
	if(strpos($url, 'vimeo') > -1){
		$iframe_code = str_replace('vimeo.com', 'player.vimeo.com/video', $url);
	}
	
	$return = '
	<div class="quasar-iframe-container">
         <iframe src="'.$iframe_code.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	</div>
	';
	
	return $return;
}
endif;






if ( ! function_exists( 'quasar_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * @return void
 */
function quasar_entry_meta() {
	$return = '';
	
	if ( is_sticky() && is_home() && ! is_paged() )
		$return .= '<span class="featured-post">' . __( 'Sticky', 'quasar' ) . '</span>';

	/*
	Currently Disabled. We have used the Date in the right side
	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		$return .= quasar_entry_date(false);
	
	*/

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'quasar' ) );
	if ( $categories_list ) {
		$return .= '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'quasar' ) );
	if ( $tag_list ) {
		$return .= '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		/*
		Linking to Author's archive currently disabled
		
		$return .= sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'quasar' ), get_the_author() ) ),
			get_the_author()
		);
		*/
		$return .= sprintf( '<span class="author vcard"><a class="url fn n" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'quasar' ), get_the_author() ) ),
			get_the_author()
		);
	}
	
	return $return;
}
endif;








if ( ! function_exists( 'quasar_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string
 */
function quasar_entry_date( $echo = true ) {
	$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'quasar' ): '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'quasar' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;









if ( ! function_exists( 'quasar_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 */
function quasar_paging_nav($echo=false) {
	global $wp_query;
	
	$total_pages = $wp_query->max_num_pages;

	// Don't print empty markup if there's only one page.
	if ( $total_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;
		
	//Define current page
	$current_page = max(1, get_query_var('paged'));  
	$big = 999999999;
	$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
	
	//If echo value is true echo the output
	if($echo){
		echo '<div class="quasar-pagination">';
		echo paginate_links(array(  
			'base'		=> $base,  
			'format'	=> 'page/%#%',  
			'prev_text'	=> '« '.__('Previous','quasar'),
			'next_text'	=> __('Next','quasar').' »',
			'current'	=> $current_page,  
			'total'		=> $total_pages,  
		));  
		echo '<div class="clear"></div>';
		echo '</div>';
	}else{
		//If echo is false, only return the output. Useful for shortcodes
		return '<div class="quasar-pagination">'.paginate_links(array(  
			'base'		=> $base,  
			'format'	=> 'page/%#%',  
			'prev_text'	=> '« '.__('Previous','quasar'),
			'next_text'	=> __('Next','quasar').' »',
			'current'	=> $current_page,  
			'total'		=> $total_pages,  
		)).'<div class="clear"></div></div>';  
	}
}
endif;






if(!function_exists('quasar_tinymce_add_page_button')):
/*
**	Add pagination button to TinyMCE. 
**
**	This function filters TinyMCE plugins and adds pagination button to TinyMCE.
**	Pagination button in TinyMCE allows you to add pagination in any page and split
**	your content into multiple pages for your pages and blog posts
**	
*/
function quasar_tinymce_add_page_button($mce_buttons) { 
	$pos = array_search('wp_more',$mce_buttons,true); 
	if ($pos !== false) { 
		$tmp_buttons = array_slice($mce_buttons, 0, $pos+1); 
		$tmp_buttons[] = 'wp_page'; 
		$mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1)); 
	} 
	return $mce_buttons;
}
endif;
add_filter('mce_buttons','quasar_tinymce_add_page_button'); 








if(!function_exists('quasar_get_link_pages')):
/*
**	Alters the wp_link_pages function for the visuality
**
**	@return	:	Echo the page numbers and links in HTML
*/
function quasar_get_link_pages(){
	global $post;
	if(!$post) return;
	
	wp_link_pages( 
		array( 
			'before'			=>	'<div class="quasar-pagination quasar-link_pages">', 
			'after'				=>	'</div><div class="clear"></div>', 
			'link_before'		=>	'<span class="page-numbers">', 
			'link_after'		=>	'</span>',
			'previouspagelink'	=>	'« '.__('Previous','quasar'),
			'nextpagelink'		=>	__('Next','quasar').' »',
		) 
	);
}

endif;






if(!function_exists('quasar_get_comments_pages')):
/*
**	Alters the wp_link_pages function for the visuality
**
**	@return	:	Echo the page numbers and links in HTML
*/
function quasar_get_comments_pages(){
	global $post;
	if(!$post) return;
	
	echo '<div class="quasar-pagination quasar-link_pages">';
	paginate_comments_links( 
		array( 
			'before'			=>	'<div class="quasar-pagination quasar-link_pages">', 
			'after'				=>	'</div>', 
			'link_before'		=>	'<span class="page-numbers">', 
			'link_after'		=>	'</span>',
			'previouspagelink'	=>	'« '.__('Previous','quasar'),
			'nextpagelink'		=>	__('Next','quasar').' »',
		) 
	);
	
	echo '</div>';
	echo '<br/>';
}

endif;







if ( ! function_exists( 'quasar_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function quasar_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'rockthemes_large', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;






if(!function_exists('quasar_get_post_format_icon')):
/*
**	Uses FontAwesome icons and returns post format icon
**
**	@return	:	Returns the post type icon
*/
function quasar_get_post_format_icon(){
	global $post;

	if(!$post) return false;
	
	$post_format = get_post_format();
	
	$return = '';
	
	//Check if the post format is default
	if(!$post_format){
		//Post format is default. Default post format returns false from get_post_format() function
		$return = '<img src="'.F_WAY.'/images/icomoon/pencil.svg" class="use_svg" />';
		$return = '<div class="icomoon-icon" data-icomoon="&#xe005;"></div>';
	}else{
		switch($post_format){
			case 'gallery':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe00e;"></div>';
			break;	
			
			case 'image':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe00c;"></div>';
			break;
			
			case 'audio':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe011;"></div>';
			break;
			
			case 'video':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe013;"></div>';
			break;
			
			case 'aside':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe025;"></div>';
			break;
			
			case 'status':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe06d;"></div>';
			break;
			
			case 'link':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe0c3;"></div>';
			break;
			
			case 'quote':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe076;"></div>';
			break;
			
			case 'chat':
			$return = '<div class="icomoon-icon" data-icomoon="&#xe06e;"></div>';
			break;
		}
	}
	
	
	return $return;
}

endif;







if(!function_exists('quasar_get_title_with_date')):
/*
**	Generates the title and the date for the posts
**
**	@return	:	Returns the Title, Date and Post Format in HTML
*/
function quasar_get_title_with_date(){
	global $post;
	if(!$post) return false;
	
	$title = quasar_get_the_title();

	$date = '
		<div class="date-area">
			<a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">
				<div class="day-area">'.get_the_time('d', $post->ID).'</div>
				<span class="month-area">'.get_the_date('M').'</span>
				<span class="year-area">'.get_the_time('Y', $post->ID).'</span>
			</a>
		</div>
	';

	$post_format = quasar_get_post_format_icon();
	
	$edit_text = '';
	
	if(current_user_can('edit_posts')){
		$edit_text = '<span class="edit-link"><a href="'.get_edit_post_link($post->ID).'">'.__( 'Edit', 'quasar' ).'</a></span>';	
	}
	
	$return = '';
	
	/*
	**	<span class="title-container"> changed to 	<h2 class="title-container">
	*/
	
	$return .= '
		<div class="quasar-title-date-container row">
			<div class="large-9 medium-9 small-9 columns">
				<'.((is_single() && !xr_get_option('show_post_name_on_title', true)) ? 'h1' : 'h2').' class="title-container entry-title post-title">
				'.$title.'
				</'.((is_single() && !xr_get_option('show_post_name_on_title', true)) ? 'h1' : 'h2').'>
				<span class="entry-meta">
				'.quasar_entry_meta().'
				'.$edit_text.'
				</span>
			</div>
		
			<div class="large-3 medium-3 small-3 columns">
				<div class="post-format-container">'.$post_format.'</div>
				<div class="date-area-container main-gradient updated">'.$date.'</div>
				<div class="clear"></div>
			</div>
		</div>
	';
	
	$return .= '<br/>';
	
	return $return;
}

endif;







if(!function_exists('quasar_get_the_title')):
/*
**	Returns the title with or without link
**
**	@return	:	Returns the post/article title with or without link in HTML
*/

function quasar_get_the_title(){
	global $post,$title_link_active;//Global variable to set link to the title.
	$title_link_active = true; //Varible name can be changed later
	
	$return = '';
	
	//TO DO	:	Title will be wrapped with a special class for styling. 
	
	if($title_link_active){
		//Link is active. Wrap a tag for link around the title
		$return = '<a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a>';
	}else{
		//Link is not active. Return only the title.
		$return = get_the_title();	
	}
	
	return $return;
	
}

endif;






if(!function_exists('quasar_get_post_loop_description')):
/*
**	This function will generate the summary for the blog post loop. 
**
**
**	@return	:	Returns the excerpt or the content according to the choice	
**
**	TO DO	:	Usage of the function can be extended
*/
function quasar_get_post_loop_description(){
	global $post;
	if(!$post) return;
	
	$summary_choice = xr_get_option('post_summary','content');//or excerpt;
	
	$return = '';
	
	if($summary_choice === 'content'){
		$return = quasar_get_the_content();
	}elseif($summary_choice === 'excerpt'){
		$return = rock_check_p(get_the_excerpt());
		$return .= quasar_get_read_more_link();
	}
	
	return $return;
}

endif;






if(!function_exists('quasar_get_entry_header')):
/*
**	Post contents will have a header. We will add two options for these headers. 
**	These options will be setted with Theme Options. Options are :
**	1 - Featured Image at the top and the header title and details
**	2 - Header title and the details are at the top and then the featured image
**
**	@return	:	Entry header content in HTML
*/

function quasar_get_entry_header(){
	global $post;
	if(!$post) return;
	
	$image_at_top = true;
	
	$return = '';
	
	if($image_at_top){
		if ( has_post_thumbnail() && ! post_password_required() ) :
		$return .= '
		<div class="entry-thumbnail">
			'.quasar_get_featured_image(false).'
		</div>
		';
		endif;
		
		if ( is_single() ) :
		$return .= quasar_get_title_with_date();
		else :
		$return .= quasar_get_title_with_date();
		endif; // is_single()		
	}else{
		if ( is_single() ) :
		$return .= quasar_get_title_with_date();
		else :
		$return .= quasar_get_title_with_date();
		endif; // is_single()
		
		if ( has_post_thumbnail() && ! post_password_required() ) :
		$return .= '
		<div class="entry-thumbnail">
			'.quasar_get_featured_image(false).'
		</div>
		';
		endif;
	}
	
	return $return;
}
endif;







if(!function_exists('quasar_get_read_more_text')):
/*
**	Instead of using the same read more text a lot of place, we will use this function to return read more text
**
**	@return	:	read more text
*/
function quasar_get_read_more_text(){
	
	$return = '';
	
	$return .= __('Read More <i class="fa-angle-double-right"></i>','quasar');
	
	return $return;	
}

endif;








if(!function_exists('quasar_get_read_more_link')):
/*
**	Returns the read more as link
**
**	@param	:	$target link target. _self or _blank
**	@return	:	Returns the "read more" link in HTML format
*/
function quasar_get_read_more_link($target='_self'){
	global $post;
	if(!$post) return;
	
	$is_button = false;
	
	$return = '';
	
	if($is_button){
		$return .= '<a href="'.get_permalink().'" class="more-link button button-custom"  target="'.$target.'">'.quasar_get_read_more_text().'</a>';
	}else{
		$return .= '<a href="'.get_permalink().'" class="more-link"  target="'.$target.'">'.quasar_get_read_more_text().'</a>';
	}
	

	return $return;
}

endif;






/*This will be removed and the above function will be in use*/
if(!function_exists('quasar_read_more')):
/*
**	Qusar read more link
**
**	@param	:	postID
**	@return	:	read more text with post link in HTML format 
*/
function quasar_read_more($target='_self'){
	global $post;

	if(!$post || (!$post->ID)) return;
	
	$return = ' <a href="'.get_permalink().'" target="'.$target.'">'.__('read more','quasar').' <i class="fa-angle-double-right"></i></a>';
	
	return $return;
}

endif;






if(!function_exists('quasar_get_post_views')):
/*
**	Gets the post view number
**
**	@return	:	Returns the post number
*/
function quasar_get_post_views(){
	global $post;
	if(!$post) return;
	
	$count_key = 'post_views_count';
	$count = get_post_meta($post->ID, $count_key, true);
	if ($count == '') {
		delete_post_meta($post->ID, $count_key);
		add_post_meta($post->ID, $count_key, '0');
		return "0".__(' View', 'quasar');
	}
	
	$return = $count.__(' View', 'quasar');
	
	return $return;
}
endif;








if(!function_exists('quasar_set_post_views')):
/*
**	Set the post view number for the current post. This function will be called fonr the "single.php" file
**	and only will set the view if the post is single
**
**	@return	:	Does not return any value
*/
function quasar_set_post_views(){
	global $post;
	if(!$post) return;
	
	if(!is_single()) return;
	
	$count_key = 'post_views_count';
	$count = get_post_meta($post->ID, $count_key, true);
	if ($count == '') {
		$count = 0;
		delete_post_meta($post->ID, $count_key);
		add_post_meta($post->ID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($post->ID, $count_key, $count);
	}
}
endif;







if(!function_exists('quasar_get_the_content')):
/*
**	Wordpress's default get_the_content returns unfiltered content. Without <p> and <br/> tags. This function will 
**	recover that issue
**
**	@return	:	The content of the post with filtered tags such as <p> and <br/>
*/
function quasar_get_the_content(){
	global $post;
	$content = get_the_content('',FALSE);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);	
	if(!is_single()):
		$content = $content.quasar_get_read_more_link();
	endif;
	return $content;
}

endif;






if(!function_exists('quasar_get_post_share')):
/*
**	Social share buttons for the blog posts. Currently support 4 social buttons :
**
**	Facebook
**	Twitter
**	Google+
**	Pinterest
**
**	@param	:	$args array with $social_html and $social_js. Allows to add extra entry at the beginning
**	@return	:	Returns the social media button in HTML
*/
function quasar_get_post_share($args=null){
	global $post;
		
	$social_html	=	'';
	$social_js		=	'';
	
	if($args && is_array($args)){
		extract($args);
	}
		
	//Facebook
	$social_html	.=	'<div class="fb-like" data-href="'.get_permalink().'" data-width="90" data-layout="button_count" data-show-faces="false" data-send="false"></div>';	
	$social_js		.=	'
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, "script", "facebook-jssdk"));
	';
	
	//Twitter
	$social_html	.=	'<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>';
	$social_js		.=	'!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");';

	//Google+
	$social_html	.=	'<div class="g-plusone" data-size="medium"></div>';
	$social_js		.=	'
	  (function() {
		var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
		po.src = "https://apis.google.com/js/plusone.js";
		var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
	  })();
	';
	
	//Pinterest
	$social_html	.=	'<a href="//pinterest.com/pin/create/button/?url='.get_permalink().'&media='.get_permalink().'&description='.get_permalink().'" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>';

	
	$social_html	=	apply_filters('quasar_post_social_html',$social_html);
	$social_js		=	apply_filters('quasar_post_social_js',$social_js);
	
	$return		=	'';
	
	$return		.=	'<script type="text/javascript">'.$social_js.'</script>';
	
	$return		.=	'<div class="quasar-post-social">'.$social_html.'</div><div class="clear"></div>';
	
	return $return;
}
endif;







if(!function_exists('quasar_hr_shadow')):
/*
**	Quasar hr object with shadow
**
**	@return	:	Returns the hr element wrapped with div.
*/
function quasar_hr_shadow(){
	return '<div class="hr-shadow-mask"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div>';	
}

endif;







if(!function_exists('quasar_image_shadow_up')):
/*
**	Quasar hr object with shadow
**
**	@return	:	Returns the hr element wrapped with div.
*/
function quasar_image_shadow_up(){
	return '<div class="shadow-divider-up"><img src="'.F_WAY.'/images/shadow-divider-up.png" /></div>';	
}

endif;








if(!function_exists('quasar_image_shadow_down')):
/*
**	Quasar hr object with shadow
**
**	@return	:	Returns the hr element wrapped with div.
*/
function quasar_image_shadow_down(){
	return '<div class="shadow-divider-down"><img src="'.F_WAY.'/images/shadow-divider-down.png" /></div>';	
}

endif;







if(!function_exists('quasar_call_portfolio_shortcode')):
/*
**	Calls the Quasar Portfolio Shortcode function and uses the return HTML of Quasar Portfolio Shortcode
**
**	@param	:	$atts Quasar shortcode attributes.
**	@return	:	Does not return any data
**	@echo	:	Echo the return value from Quasar Portfolio Shortcode
*/
	function quasar_call_portfolio_shortcode($atts=null){
		if(!$atts) return;
		
		if(!function_exists('rockthemes_make_swiperslider_shortcode') && $atts['use_swiper_for_thumbnails'] === 'true'){
			$atts['use_swiper_for_thumbnails'] = 'false';
		}
		
		if(function_exists('rockthemes_shortcode_make_portfolio')){
			echo rockthemes_shortcode_make_portfolio($atts);
		}
		
		return;
	}
endif;





if(!function_exists('quasar_call_gallery_shortcode')):
/*
**	Calls the Quasar Gallery Shortcode function and uses the return HTML of Quasar Gallery Shortcode
**
**	@param	:	$atts Quasar shortcode attributes.
**	@return	:	Does not return any data
**	@echo	:	Echo the return value from Quasar Gallery Shortcode
*/
	function quasar_call_gallery_shortcode($atts=null){
		if(!$atts) return;
		
		if(!function_exists('rockthemes_make_swiperslider_shortcode') && $atts['use_swiper_for_thumbnails'] === 'true'){
			$atts['use_swiper_for_thumbnails'] = 'false';
		}
		
		if(function_exists('rockthemes_shortcode_make_gallery')){
			echo rockthemes_shortcode_make_gallery($atts);
		}
		
		return;
	}
endif;








if(!function_exists('quasar_hover_effect')):
/*
**	Returns HTML codes for hover effect.
**
**	@param	:	$postID 		ID of the current post
**	@param	:	$insert_shadow	If there should be shadow under the image
*/

	function quasar_hover_effect($postID,$insert_shadow = false, $activate_link = true, $gallery_id = ''){
		$alt = get_post_meta(get_post_thumbnail_id($postID), '_wp_attachment_image_alt', true);
		$alt_tag = $alt ? $alt : '';
		
		$post_format = get_post_format();

		if($post_format === 'gallery' || $post_format === 'image'){
			$full_image= wp_get_attachment_image_src( $postID, 'full' );
		}else{
			$post_img_id = get_post_thumbnail_id($postID);
			if($post_img_id){
				$full_image= wp_get_attachment_image_src( $post_img_id, 'full' );
			}else{
				$full_image= wp_get_attachment_image_src( $postID,'full' );
			}
		}

		$link = get_post_permalink($postID);
		$rockthemes_advanced_details = get_post_meta($postID,'advanced_post_details',true);
		
		$rel = 'prettyPhoto';
		$title = '';
		
		if($gallery_id != ''){
			$rel = 'prettyPhoto['.$gallery_id.']';
			$title = 'title=""';
		}
			
		$return = '';	
		$return .= '
			<div class="regular-hover-container">
				<div class="hover-bg">
					<div class="hover-icon-container '.(!$activate_link ? 'icon-no-link' : '').'">
		';
		
		if($activate_link){
			$return .=	'<a href="'.$link.'" class="iconeffect">
							<img src="'.F_WAY.'/images/icomoon/link.svg" class="use_svg" />
						</a>
						';
		}
		
		if(isset($rockthemes_advanced_details['video_iframe_code']) && $rockthemes_advanced_details['video_iframe_code'] != ''){
			$return .=
				'
						<a href="'.$rockthemes_advanced_details['video_iframe_code'].'" rel="'.esc_attr($rel).'" class="iconeffect">
							<img src="'.F_WAY.'/images/icomoon/play3.svg" class="use_svg" width="32" height="32" alt="'.$alt_tag.'" />
						</a>
			';	
		}else{

			$return .= '			
						<a href="'.$full_image[0].'" rel="'.esc_attr($rel).'" class="iconeffect">
							<img src="'.F_WAY.'/images/icomoon/search.svg" class="use_svg" width="32" height="32" alt="'.$alt_tag.'" />
						</a>
			';
		}
		
		$return .= '
							</div>
				</div>
		';
		
		if($insert_shadow){
			$return .= '<div class="hr-shadow-mask shadow-absolute"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div>';
		}
			
		$return .= '</div>
		';
		
		return $return;
	}
endif;







if(!function_exists('quasar_breadcrumb')):
function quasar_breadcrumb() {
	global $wp_query;
	
	/*
	if (get_deactivate_breadcrumbs()) {
		return;
	}
	*/
	$delimiter = '<li> | </li>';
	$home = __('Home', 'quasar'); // text for the 'Home' link
	$before = '<li>'; // tag before the current crumb
	$after = '</li>'; // tag after the current crumb
	$product_parent_page_id = xr_get_option('quasar_products_page', false);// product page id will be setted in theme options
	if(function_exists('icl_link_to_element')){
		$product_parent_page_id = icl_link_to_element($product_parent_page_id);	
	}
	
	$posts_page_id = get_option( 'page_for_posts');
	$blog_page_html = '';
	if($posts_page_id){
		$posts_page = get_page( $posts_page_id);
		$posts_page_title = $posts_page->post_title;
		$posts_page_url = get_page_link($posts_page_id  );
		$blog_page_html = $before.'<a href="'.$posts_page_url.'">'.$posts_page_title.'</a>'.$after.$delimiter;
		//$blog_page_html = $before.'<a href="'.get_permalink($posts_page_id).'">'.$posts_page_title.'</a>'.$after.$delimiter;
	}
	
	

	if (!is_home() && !is_front_page() || is_paged()) {

		echo '<ul class="quasar-breadcrumbs">';

		global $post;
		$homeLink = home_url();
		echo '<li><a href="'.$homeLink.'">'.$home.'</a> '.$after.$delimiter.' ';

		if (is_category()) {
			global $wp_query;
			$cat_obj = $wp_query -> get_queried_object();
			$thisCat = $cat_obj -> term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat -> parent);
			
			echo $blog_page_html;
			if ($thisCat -> parent != 0) echo $before.(get_category_parents($parentCat, TRUE, ' '.$delimiter.' ')).$after;
			echo $before.single_cat_title('', false).$after;
		}
		elseif(is_day()) {
			echo $blog_page_html;
			echo $before.'<a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$after.$delimiter.' ';
			echo $before.'<a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_time('F').'</a> '.$after.$delimiter.' ';
			echo $before.get_the_time('d').$after;

		}
		elseif(is_month()) {
			echo $blog_page_html;
			echo $before.'<a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$after.$delimiter.' ';
			echo $before.get_the_time('F').$after;

		}
		elseif(is_year()) {
			echo $blog_page_html;
			echo $before.get_the_time('Y').$after;

		}
		elseif(is_archive() && !is_tag()){
				
			if(get_post_type() === 'quasarproducts'){
				
				if($product_parent_page_id !== ''){
					echo $before.'<a href="'.get_page_link($product_parent_page_id).'">'.get_the_title($product_parent_page_id).'</a>'.$after.$delimiter;
				}
				
				$q_parents = array();	
				
				$parent = wp_get_post_terms($post->ID, 'quasarproduct_cat');
				if($parent && !empty($parent)) $parent = $parent[0];
				echo $before.$parent->name.$after;
				
				
			}else{
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo $before . '<a href="' .get_permalink($post->post_parent) . '/">' . get_the_title($post->post_parent) . '</a> '.$after . $delimiter;
			}
			//echo $before.get_the_title().$after;
		}
		elseif(is_single() && !is_attachment()) {
			if (get_post_type() != 'post') {
				
				if(get_post_type() === 'quasarproducts'){
					
					if($product_parent_page_id !== ''){
						echo $before.'<a href="'.get_page_link($product_parent_page_id).'">'.get_the_title($product_parent_page_id).'</a>'.$after.$delimiter;
					}
					
					$q_parents = array();	
					
					$parent = wp_get_post_terms($post->ID, 'quasarproduct_cat');
					if($parent && !empty($parent)) $parent = $parent[0];

					if(!empty($parent)){
						echo $before.'<a href="'.get_term_link($parent, 'quasarproduct').'">'.$parent->name.'</a>'.$after.$delimiter;
					}

				}else{
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo $before . '<a href="' .get_permalink($post->post_parent) . '/">' . get_the_title($post->post_parent) . '</a> '.$after . $delimiter;
				}
				echo $before.get_the_title().$after;
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				echo $blog_page_html;
				echo $before.get_category_parents($cat, TRUE, ' '.$delimiter.' ').$after;
				echo $before.get_the_title().$after;
			}

		}
		elseif(!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search()) {
			$post_type = get_post_type_object(get_post_type());
			echo $before.$post_type -> labels -> singular_name.$after;

		}
		elseif(is_attachment()) {
			/*
			$parent = get_post($post -> post_parent);
			$cat = get_the_category($parent -> ID);
			$cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' '.$delimiter.' ');
			echo $before.'<a href="'.get_permalink($parent).'">'.$parent -> post_title.'</a> '.$after.$delimiter.' ';
			echo $before.get_the_title().$after;
			*/
		}
		elseif(is_page() && !$post -> post_parent) {
			echo $before.get_the_title().$after;
		}
		elseif(is_page() && $post -> post_parent) {
			
			$parent_id = $post -> post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = $before.'<a href="'.get_permalink($page -> ID).'">'.get_the_title($page -> ID).'</a>'.$after;
				$parent_id = $page -> post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach($breadcrumbs as $crumb) echo $crumb.' '.$delimiter.' ';
			echo $before.get_the_title().$after;

		}
		elseif(is_search()) {
			echo $before.__('Search Results For : ', 'quasar').get_search_query().$after;

		}
		elseif(is_tag()) {
			echo $blog_page_html;
			echo $before.single_tag_title('', false).$after;

		}
		elseif(is_author()) {
			global $author;
			$userdata = get_userdata($author);
			echo $before.$userdata -> display_name.$after;

		}
		elseif(is_404()) {
			echo $before.$after;
		}


		if (get_query_var('paged')) {
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
			echo __('Page','quasar').' '.get_query_var('paged');
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
		}

		echo '</ul>';

	}
}
endif;

if(!function_exists('quasar_is_post_type')):
function quasar_is_post_type($type) {
	global $wp_query;
	if ($type == get_post_type($wp_query -> post -> ID)) return true;
	return false;
}
endif;


if(!function_exists('quasar_strict_sidebars')):
/*
**	Register the Strict Sidebars and Widget Areas. These will not be removed via Custom Sidebar options
**
*/
function quasar_strict_sidebars(){
	
	$footer_large_num = xr_get_option('large_footer_blocks', 3);
	if(isset($footer_large_num)) $footer_large_num = (int) $footer_large_num;
	
	$i=0;
	for($i; $i<$footer_large_num; $i++){
		// + 1 is to make old footer large nums to work
		//Register Footer Large Block
		register_sidebar( array(  
			'name'			=>	'Footer Large '.($i+1),  
			'class'			=>	'',
			'id'			=>	'footer-large-'.($i+1),  
			'description'	=>	'Footer Large '.($i+1).' Content',
			'before_widget' =>	'<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=>	'</aside>',
			'before_title'	=>	'<h3 class="widget-title">',  
			'after_title'	=>	'</h3><hr class="footer-inline-hr" />',  
		) );  
	}
	
	//Footer 1 Widget Area
	/*
	register_sidebar( array(  
		'name'			=>	'Footer Large 1',  
		'class'			=>	'',
		'id'			=>	'footer-large-1',  
		'description'	=>	'Footer Large 1 Content',
		'before_widget' =>	'<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=>	'</aside>',
		'before_title'	=>	'<h3 class="widget-title">',  
		'after_title'	=>	'</h3><hr class="footer-inline-hr" />',  
	) );  
	*/
	/*
	//Footer 2 Widget Area
	register_sidebar( array(  
		'name'			=>	'Footer Large 2',  
		'class'			=>	'',
		'id'			=>	'footer-large-2',  
		'description'	=>	'Footer Large 2 Content',
		'before_widget' =>	'<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=>	'</aside>',
		'before_title'	=>	'<h3 class="widget-title">',  
		'after_title'	=>	'</h3><hr class="footer-inline-hr" />',  
	) );  
	*/


	//Footer 3 Widget Area
	/*
	register_sidebar( array(  
		'name'			=>	'Footer Large 3',  
		'class'			=>	'',
		'id'			=>	'footer-large-3',  
		'description'	=>	'Footer Large 3 Content',
		'before_widget' =>	'<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=>	'</aside>',
		'before_title'	=>	'<h3 class="widget-title">',  
		'after_title'	=>	'</h3><hr class="footer-inline-hr" />',  
	) );  
	
	*/
	//Footer 4 Widget Area
	/*
	register_sidebar( array(  
		'name'			=>	'Footer Large 4',  
		'class'			=>	'',
		'id'			=>	'footer-large-4',  
		'description'	=>	'Footer Large 4 Content',
		'before_widget' =>	'<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=>	'</aside>',
		'before_title'	=>	'<h3 class="widget-title">',  
		'after_title'	=>	'</h3><hr class="footer-inline-hr" />',  
	) );  
	*/
	//Footer Bottom Widget Area
	register_sidebar( array(  
		'name'			=>	'Footer Bottom',  
		'class'			=>	'',
		'id'			=>	'footer-bottom',  
		'description'	=>	'Footer Bottom Content',
		'before_widget' =>	'<aside class="footer-bottom-widget">',
		'after_widget'	=>	'</aside>',
		'before_title'	=>	'<h3 class="widget-title">',  
		'after_title'	=>	'</h3>',  
	) );  
	
	
	/*
	Currently Disabled
	
	//Header Top Left Sidebar
	register_sidebar( array(  
		'name'			=>	'Header Top Left',  
		'class'			=>	'',
		'id'			=>	'header-top-left',  
		'description'	=>	'Header Top left content',
		'before_widget'	=>	'',
		'after_widget'	=>	'',
		'before_title'	=>	'<h3 class="widget-title">',  
		'after_title'	=>	'</h3>',  
	) );  
	*/
	//Header Top Right Sidebar
	register_sidebar( array(  
		'name'			=>	'Header Top Right',  
		'class'			=>	'',
		'id'			=>	'header-top-right',  
		'description'	=>	'Header Top right content',
		'before_widget'	=>	'',
		'after_widget'	=>	'',
		'before_title'	=>	'<h3 class="widget-title">',  
		'after_title'	=>	'</h3>',  
	) );  
	
}
endif;
// Add strict widget areas
add_action( 'init', 'quasar_strict_sidebars' );
//Add shortcode to widget text
add_filter( 'widget_text', 'do_shortcode');






/*
**	Adds search to menu. This function will be called from "header-models.php" file
**
**	@params	:	Filter Params
*/

if(!function_exists('quasar_add_search_to_menu')){
	function quasar_add_search_to_menu($items, $args) {
  		if( $args->theme_location !== 'primary' ) return $items;
			
		$search_icon = '
			<div class="special-search-container">
				<a class="special-search-icon"><i class="fa fa-search"></i></a>
				<div class="special-search-overlay-box padding">
					<form role="search" method="get" id="searchform" class="searchform" action="'. home_url( '/' ).'">
						<div>
							<input type="text" value="" name="s" id="s" placeholder="'.__('Search for:','quasar').'">
							<input type="submit" class="button buttom-custom" id="searchsubmit" value="'.__('Search','quasar').'">
						</div>
					</form>
				</div>
			</div>		
		';
  
        $homeMenuItem =
                '<li class="right">' .
                $args->before .
				$search_icon.
                $args->after .
                '</li>';
  
        $items = $items.$homeMenuItem;
  
		return $items;
	}
}




/*
**	Adds logo to menu. This function will be called from "header-models.php" file
**
**	@params	:	Filter Params
*/

if(!function_exists('rockthemes_logo_in_menu_filter')){
	function rockthemes_logo_in_menu_filter($items, $args) {
  		if( $args->theme_location !== 'primary' ) return $items;
		
		$logo = xr_get_option('company_logo','');
		$logo_html = '<div class="logo-container left"><a href="'.get_site_url().'"><img src="'.$logo.'" alt="'.get_bloginfo('name').'" style="max-width:'.xr_get_option('logo_width','190px').'; max-height:'.xr_get_option('logo_height','80px').'; width:100%;" /></a></div>';
  
        $items = $logo_html.$items;
  
		return $items;
	}
}




/*
**	Check the menu chosen in the Theme Options and add or remove Menu Walker
**	Menu walker is "rock_menu_walker" class below
**
*/
if(!function_exists('quasar_get_nav_menu')){
	function quasar_get_nav_menu($echo = true){
		$activate_menu_description = xr_get_option('activate_menu_description','');

		//var_dump($activate_menu_description);
		if($activate_menu_description){
			//Menu with description uses this walker class down below
			if($echo):
				wp_nav_menu( array( 'echo' => $echo, 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_id'=>'nav', 'walker' => (new rock_menu_walker) ) );
			else:
				return wp_nav_menu( array( 'echo' => $echo, 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_id'=>'nav', 'walker' => (new rock_menu_walker) ) );
			endif;
		}else{
			if($echo):
				wp_nav_menu( array( 'echo' => $echo, 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_id'=>'nav', 'fallback_cb' => 'quasar_empty_nav' ) );
			else:
				return wp_nav_menu( array( 'echo' => $echo, 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_id'=>'nav', 'fallback_cb' => 'quasar_empty_nav' ) );
			endif;
		}
	}
}

if(!function_exists('quasar_empty_nav')):
function quasar_empty_nav(){
	//Do Nothing
}
endif;

if(!class_exists('rock_menu_walker')):
class rock_menu_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		if(is_object($args)){
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '<div class="desc">' . $item->description . '</div>';
			$item_output .= '</a>';
			$item_output .= $args->after;
		}elseif(is_array($args)){
			$item_output = $args['before'];
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args['link_before'] . apply_filters( 'the_title', $item->title, $item->ID ) . $args['link_after'];
			$item_output .= '<div class="desc">' . $item->description . '</div>';
			$item_output .= '</a>';
			$item_output .= $args['after'];
		}

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
endif;




?>
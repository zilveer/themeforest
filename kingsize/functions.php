<?php
error_reporting(E_ALL & ~(E_DEPRECATED | E_STRICT | E_NOTICE));

/**
 * @KingSize since 2011 - 2016
 * Developed by OurWebMedia - https://www.ourwebmedia.com
 **/
 
 
#---------------------------------------------------------------#
###################### Get custom function ######################
#---------------------------------------------------------------#

include (get_template_directory() . "/lib/custom.lib.php");

#---------------------------------------------------------------#
###################### Update notification ######################
#---------------------------------------------------------------#

include (get_template_directory() . "/lib/theme-update-notification.php");

#--------------------------------------------------------------------------#
###################### Setup Theme page custom fields ######################
#--------------------------------------------------------------------------#

include (get_template_directory() . "/lib/theme-page-custom-fields.php");

#--------------------------------------------------------------------------#
###################### Setup Theme post custom fields ######################
#--------------------------------------------------------------------------#

include (get_template_directory() . "/lib/theme-post-custom-fields.php");

#--------------------------------------------------------------------------#
###################### Setup Theme download custom fields ######################
#--------------------------------------------------------------------------#
if (file_exists('easy-digital-downloads/easy-digital-downloads.php')) {
if ( is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' ) ) {
 include (get_template_directory() . "/lib/theme-download-custom-fields.php");
}
}
#---------------------------------------------------------------#
######################  Widget for sidebar ######################
#---------------------------------------------------------------#

require_once (get_template_directory() . '/lib/widget-contact-info.php');
require_once (get_template_directory() . '/lib/widget-twitter.php');
require_once (get_template_directory() . '/lib/gallery-widget/gallery_widget.php');

#------------------------------------------------------------#
###################### Image Resizer V4 ######################
#------------------------------------------------------------#

require_once(get_template_directory() . '/lib/image-resizer.php');

#------------------------------------------------------------#
###################### WooCommerce v5.1 ######################
#------------------------------------------------------------#

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

require_once (get_template_directory() . '/woocommerce/functions-woocomerce.php');

#---------------------------------------------------------------#
###################### WordPress Functions ######################
#---------------------------------------------------------------#

/** Tell WordPress to run kingsize_setup() when the 'after_setup_theme' hook is run. **/
add_action( 'after_setup_theme', 'kingsize_setup' );

if ( ! function_exists( 'kingsize_setup' ) ):

 /**
 * Sets up theme defaults and registers support for various WordPress features.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 **/
 
function kingsize_setup() {
	// This theme uses post thumbnails
	//Deprecated from WP 3.9 add_theme_support( 'post-thumbnails', array( 'post', 'slider', 'track' ) );
	
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 460, 180, true );
		add_image_size( 'thumbnail-post', 200, 150, true ); // Post portfolio thumbnails
	}	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );	
	
	
	 ################## Fixing Theme Check Errors #################
	// Set up the content width value based on the theme's design and stylesheet.
	if ( ! isset( $content_width ) )
		$content_width = 1000;

	//Theme to support Title Tag
	add_theme_support( 'title-tag' );
	

	$defaults_custom_headers = array();
	add_theme_support( 'custom-header', $defaults_custom_headers );

	$args_custom_background = array();
	add_theme_support( "custom-background", $args_custom_background );  

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	################## End Theme Check #################


}
endif;



/**
 * 
 * This removes the ability to add the FULL image size into a post, it does not alter or delete the image
 * Add whataever extra image sizes to the insert dropdown in WordPress you create via add_image_size
 * 
 *  For now we have to do it this way to make the labels translatable, see trac ref below.
 *
 *  If your theme has $content_width GLOBAL make sure and remove it
*/
//example to add post-size instead of using $content_width and a max-size
add_image_size( 'post-size', 460, 9999, true);
add_image_size( 'max-size', 680, 9999, true);
 
// over-ride image_size_names_choose
function add_image_insert_override($size_names){
 
  global $_wp_additional_image_sizes;
 
       //default array with hardcoded values for add_image_size
        $size_names = array(
                          'thumbnail' => __('Thumbnail', 'kslang'), 
                          'medium'    => __('Medium', 'kslang'), 
                          'large'     => __('Large', 'kslang'),
                          'post-size' => __('Post Size', 'kslang'),
                          'max-size'  => __('Max Size', 'kslang'),
                          'full'      => __('Full Size', 'kslang') 
                        );
 
      return $size_names;
 
};
 
add_filter('image_size_names_choose', 'add_image_insert_override' );
 
#--------------------------------------------------------------------------#
######################  Change Default Excerpt Length ######################
#--------------------------------------------------------------------------#

function kingsize_excerpt_length($length) {
return 30; }
add_filter('excerpt_length', 'kingsize_excerpt_length');

#---------------------------------------------------------------------#
######################  Configure Excerpt String ######################
#---------------------------------------------------------------------#

function kingsize_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'kingsize_excerpt_more');

#------------------------------------------------------------------------------------------#
###################### Get our wp_nav_menu() fallback, wp_page_menu() ######################
#------------------------------------------------------------------------------------------#

function kingsize_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'kingsize_page_menu_args' );

#---------------------------------------------------------------------------#
###################### Widget Ready / Enabled Sidebars ######################
#---------------------------------------------------------------------------#

function kingsize_widgets_init() {
	register_sidebar( array(
		'name' => 'Main Blog Sidebar',
		'id' => 'primary-widget-area',
		'description' => 'The main WordPress sidebar.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => 'Pages Sidebar',
		'id' => 'pages-sidebar',
		'description' => 'Sidebar specific to Pages.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => 'Contact Page Sidebar',
		'id' => 'contact-page-sidebar',
		'description' => 'Ideal for additional contact details, displayed as the Sidebar on the Contact Page. Can be used for anything.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => 'Easy Digital Downloads Sidebar',
		'id' => 'easy-dd-widget-area',
		'description' => 'Sidebar specific to the Easy Digital Downloads plugin when installed.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Column Left',
		'id' => 'first-footer-widget-area',
		'description' => 'The first footer widget area / column.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Column Center',
		'id' => 'second-footer-widget-area',
		'description' => 'The second footer widget area / column.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Column Right',
		'id' => 'third-footer-widget-area',
		'description' => 'The third footer widget area / column.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}

#--------------------------------------------------------------------#
###################### Register Widget Sidebars ######################
#--------------------------------------------------------------------#

add_action( 'widgets_init', 'kingsize_widgets_init' );

#------------------------------------------------------------------#
###################### Comment Style Settings ######################
#------------------------------------------------------------------#

function kingsize_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'kingsize_remove_recent_comments_style' );

#-----------------------------------------------------------------#
###################### Theme Options Setting ######################
#-----------------------------------------------------------------#

global $data;
require_once ('admin/index.php');

#-----------------------------------------------------------------#
###################### Menu Navitation Setup ######################
#-----------------------------------------------------------------#

require_once ('lib/menu-walker.php');

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
register_nav_menus(array(
'header-nav' => __( 'Header Navigation', 'kslang' )
));
}

#-----------------------------------------------------#
###################### Home Body ######################
#-----------------------------------------------------#

function my_plugin_body_class($classes) {
    $classes[] = 'body_portfolio body_colorbox body_gallery_2col_cb';
    return $classes;
}
add_filter('body_class', 'my_plugin_body_class');
 
#-------------------------------------------------------------#
###################### Admin E-MAIL HERE ######################
#-------------------------------------------------------------#

define("webmaster_email", $data['wm_contact_email']);
define("thanks_message", $data['wm_contact_email_template']);

#-----------------------------------------------------------------------#
######################  Enqueue Scripts and Styles ######################
#-----------------------------------------------------------------------#
function my_init_method() {
global $data;

    if (!is_admin()) {
        wp_dequeue_script( 'jquery' );
        wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
        wp_enqueue_script( 'jquery' );
        
        //enque foundation framework script
		wp_register_script( 'foundation', get_template_directory_uri().'/js/foundation.min.js'); 
	
	    // register Google Fonts stylesheet
		if($data['wm_google_fonts']!='')
			wp_register_style( 'google-fonts', $data['wm_google_fonts']);
		else
			wp_register_style( 'google-fonts', '//fonts.googleapis.com/css?family=PT+Sans+Narrow|PT+Sans:i,b,bi');

		// enqueue Google Fonts stylesheet
		wp_enqueue_style( 'google-fonts');
		
		if($data["wm_lazyloader_option"] == "Enable Lazyloader") :
			wp_register_script('lazyload', get_template_directory_uri() . "/js/jquery.lazyload.min.js");
			wp_enqueue_script('lazyload');
		endif;


		wp_register_script('custom', get_template_directory_uri() . "/js/custom.js");
		wp_enqueue_script('custom');

        wp_register_script('tipsy', get_template_directory_uri() . "/js/jquery.tipsy.js");
		wp_enqueue_script('tipsy');   
		
		##### V4.0.2 update ########
		if($data["wm_prettyphoto_enabled"] == "0" || $data["wm_prettyphoto_enabled"] == "") :
			//registering prettyphoto style and script
			wp_register_style( 'prettyphoto-css', get_template_directory_uri().'/css/prettyPhoto.css');
			wp_register_script('prettyphoto-js', get_template_directory_uri() . "/js/jquery.prettyPhoto.js");
		endif;
		
		//Google Map
        wp_register_script( 'google-map', '//maps.google.com/maps/api/js?sensor=true');

		//isotopes
		wp_register_script( 'isotope', get_template_directory_uri() . "/js/isotope.pkgd.min.js");

    }
}    
 
add_action('init', 'my_init_method');

#-----------------------------------------------------------#
######################  Add shortcodes ######################
#-----------------------------------------------------------#

include (get_template_directory() . "/lib/shortcodes.php");

#----------------------------------------------------#
######################  TinyMCE ######################
#----------------------------------------------------#

require_once (get_template_directory() . '/lib/tinymce/tinymce.php');

#--------------------------------------------------------------------#
######################  Password protected page ######################
#--------------------------------------------------------------------#

function wm_the_password_form() {
    global $post;

    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
    $output = '<form action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
    <p><strong>' . __("Content is password protected. Please enter password:", "kslang") . '</strong></p>
    <p><div for="' . $label . '" style="padding-top:10px;">' . __("Password", "kslang") . '</div><div style="padding-top:10px;"> <input name="post_password" id="' . $label . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr__("Login") . '" /></div></p>
    </form>';

    return $output;
}
add_filter('the_password_form', 'wm_the_password_form');

#-----------------------------------------------------------------#
######################  Get the Blog Content ######################
#-----------------------------------------------------------------#

function get_content($more_link_text = '(more...)', $stripteaser = 0, $more_file = '')
{
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

#------------------------------------------------------------------------------------------#
######################  List categories for the portfolio in frontend ######################
#------------------------------------------------------------------------------------------#

class Portfolio_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link = '<a href="#" data-value="'.strtolower(preg_replace('/\s+/', '-', $cat_name)).'" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all items filed under %s', 'kslang' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      // $link .= $cat_name . '</a>';
      $link .= $cat_name;
      if(!empty($category->description)) {
         $link .= ' <span>'.$category->description.'</span>';
      }
      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'kslang' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-'.rand(2, 99).'"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}

#---------------------------------------------------------------#
######################  Portfolio in Admin ######################
#---------------------------------------------------------------#

// create the portfolio Post types for admin
include(get_template_directory() ."/lib/portfolio/portfolio-posttype.php");

// Add the Portfolio Custom Meta
include(get_template_directory() ."/lib/portfolio/portfolio-meta.php");

// Add the portfolio Custom Fields
// 6/26/2013 commented in V 4.1 include(get_template_directory() ."/lib/portfolio/portfolio-custom-fields.php");

include(get_template_directory() ."/lib/portfolio/portfolio-functions.php");

///removing the custom field from the writeup panel
function remove_metaboxes() {
 remove_meta_box( 'postcustom' , 'portfolio' , 'normal' ); //removes custom fields for page
 remove_meta_box( 'postcustom' , 'post' , 'normal' ); //removes custom fields for page
 remove_meta_box( 'postcustom' , 'page' , 'normal' ); //removes custom fields for page
}
add_action( 'admin_menu' , 'remove_metaboxes' );

////Include Custom Post Types Portfolio in Search Results and Archives
function filter_search($query) {
    if ($query->is_search) {
	$query->set('post_type', array('post','page','Portfolio'));
    };
    return $query;
};
if (!is_admin())	{
add_filter('pre_get_posts', 'filter_search');
}


//// add a default-gravatar to options ////
function newgravatar ($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/images/comment_avatar.jpg';
    $avatar_defaults[$myavatar] = "KingSize Gravatar";
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'newgravatar' );

//// translate reply for comments ////
function custom_comment_reply($content) {
	$content = str_replace('Reply', __('Reply', 'kslang'), $content);
	return $content;
}
add_filter('comment_reply_link', 'custom_comment_reply');

########### To identify the first and last menu item ##########
function mytheme_options() {
	global $wpdb;
	
	$topmenuid = get_theme_mod('nav_menu_locations');
	if ($topmenuid['header-nav'] != '0') {
		$menutermtax = $wpdb->get_var("SELECT term_taxonomy_id FROM $wpdb->term_taxonomy WHERE term_id = " . $topmenuid['header-nav']);
		
		$menuitem_post_ids = $wpdb->get_var("
		SELECT posts.ID
		FROM " . $wpdb->prefix . "posts AS posts
		INNER JOIN (
		SELECT object_id
		FROM " . $wpdb->prefix . "term_relationships
		WHERE term_taxonomy_id = " . $menutermtax . "
		) AS termid ON termid.object_id = posts.ID
		ORDER BY posts.menu_order DESC
		LIMIT 1
		");
		
		set_theme_mod('lastmenuitem',$menuitem_post_ids);
	}
}
// To fix the some server issues add_action('init', 'mytheme_options');

#----------------------------------------------------------------------#
###################### New Additions in Version 4 ######################
#----------------------------------------------------------------------#

// create the slider Post types for admin
include(get_template_directory() ."/lib/slider/slider-posttype.php");

// Add the slider Custom Meta
include(get_template_directory() ."/lib/slider/slider-meta.php");

// create the gallery Post types for admin
include(get_template_directory() ."/lib/gallery/gallery-posttype.php");

// Add the gallery Custom Meta
include(get_template_directory() ."/lib/gallery/gallery-meta.php");

// Add Gallery Shortcodes
include(get_template_directory() ."/lib/gallery/gallery_shortcodes.php");

// language files
load_theme_textdomain('kslang', get_template_directory() . '/lang');
$locale = get_locale();
$locale_file = get_template_directory()."/lang/$locale.php";
if(is_readable($locale_file)) require_once($locale_file);

//ON activation of theme update data of the theme
require_once get_template_directory()."/lib/theme_activation_hook.php";

//Simply shows the ID of Posts, Pages, Media, Links, Categories, Tags and Users in the admin tables for easy access.
include(get_template_directory() ."/lib/simply-show-ids.php");

#### Check this box if you want to hide/collapse the navigation by default. #####
if($data['wm_navigation_hide_enabled'] == "Hide the Navigation on All Pages" || $data['wm_navigation_hide_enabled'] == "1")
{
	add_filter('body_class','kingsize_body_menu_hide');
}
elseif($data['wm_navigation_hide_enabled'] == "Hide the Navigation only on Homepage"){
  
   add_action('get_header', 'kingsize_get_method'); //Call the get header action hook to call is_home function etc
	function kingsize_get_method() {
	  if (is_page('home')) { //have also used is_page('home') to no avail
		 add_filter('body_class','kingsize_body_menu_hide');		  
	  }
	  elseif(is_home()){
		   add_filter('body_class','kingsize_body_menu_hide');		   
	   }
	}
}

// Slider controller positions
$slider_controller_position = '';

// getting the post ID
$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
$ID = url_to_postid($url[0]);


##### Exclude the_post_thumbnail from gallery shortcode ########
function exclude_thumbnail_from_gallery($null, $attr)
{
    if (!$thumbnail_ID = get_post_thumbnail_id())
        return $null; // no point carrying on if no thumbnail ID

    // temporarily remove the filter, otherwise endless loop!
    remove_filter('post_gallery', 'exclude_thumbnail_from_gallery');

    // pop in our excluded thumbnail
    if (!isset($attr['exclude']) || empty($attr['exclude']))
        $attr['exclude'] = array($thumbnail_ID);
    elseif (is_array($attr['exclude']))
        $attr['exclude'][] = $thumbnail_ID;

    // now manually invoke the shortcode handler
    $gallery = gallery_shortcode($attr);

    // add the filter back
    add_filter('post_gallery', 'exclude_thumbnail_from_gallery', 10, 2);

    // return output to the calling instance of gallery_shortcode()
    return $gallery;
}
add_filter('post_gallery', 'exclude_thumbnail_from_gallery', 10, 2);

// Removes WYSIWYG Editor from Gallery Post-type
function wpse_78595_hide_editor() {
    global $current_screen;

    if( $current_screen->post_type == 'galleries' ) {
        $css = '<style type="text/css">';
            $css .= '#wp-content-editor-container, #post-status-info, .wp-switch-editor, #postexcerpt { display: none; }';
        $css .= '</style>';

        echo $css;
    }
}
add_action('admin_footer', 'wpse_78595_hide_editor');

// Calls uploaded logo for WordPress Login Branding
function custom_login_logo() {
	global $data;

	if($data["wm_login_branding"] == 1)
	{
		$theme_custom_logo = $data['wm_logo_upload'];
		$login_background_color = $data['wm_login_background_color'];
		$login_label_color = $data['wm_login_label_color'];
		$login_link_color = $data['wm_login_link_color'];
		echo '<style type="text/css">'.
				 '.login h1 a { background-image:url('.$theme_custom_logo.') !important; width: 200px !important; height: 220px !important; background-size: auto !important; }'.
				'#login { padding: 3% 0 0 !important; }'.
				'body.login, html { background: '.$login_background_color.'  !important; }'.
				'.login label { color: '.$login_label_color.'  !important; }'.
				'.login #nav a, .login #backtoblog a { color: '.$login_link_color.'  !important; }'.
			 '</style>';
	}

}
add_action( 'login_head', 'custom_login_logo' );

// Changes WordPress Login Logo Link to use the WordPress Installation Link
function custom_login_url() {
    return home_url( '/' );
}
add_filter( 'login_headerurl', 'custom_login_url' );
 
// Changes the Alt tag to use the WordPress Installation Title
function custom_login_title() {
    return get_option( 'blogname' );
}
add_filter( 'login_headertitle', 'custom_login_title' );


#---------------------------------------------------------------#
############ Get Unlimited Sidebar function #####################
#---------------------------------------------------------------#
include (get_template_directory() . "/lib/sidebar-generator/sidebar_generator.php");



#---------------------------------------------------------------#
############ Plugin update notification #####################
#---------------------------------------------------------------#
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( $notifier = true ); // Disable auto updates
}					

#---------------------------------------------------------------#
############ Plugin Activation  #####################
#---------------------------------------------------------------#
require_once( get_template_directory() . '/lib/plugins/class-tgm-plugin-activation.php' );

if ( ! function_exists( 'ks_register_required_plugins' ) ) {
	
	function ks_register_required_plugins() {

		$plugins = array(
		
			array(
				'name'               => 'Fullwidth Audio Player',
				'slug'               => 'fullwidth-audio-player',
				'source'             => get_template_directory() . '/lib/plugins/' . 'fullwidth-audio-player.zip',
				'required'           => false,
				'version'            => '1.1.61',
				'force_activation'   => false,
				'force_deactivation' => false,
			),

			array(
				'name'               => 'WPBakery Visual Composer',
				'slug'               => 'js_composer',
				'source'             => get_template_directory() . '/lib/plugins/' . 'js_composer.zip',
				'required'           => false,
				'version'            => '4.11.2.1',
				'force_activation'	 => false,
				'force_deactivation' => false,
			),
			
			array(
				'name'      => 'Contact Form 7',
				'slug'      => 'contact-form-7',
				'required' 	=> false,
			),
			
			array(
				'name'      => 'Yoast SEO',
				'slug'      => 'wordpress-seo',
				'required' 	=> false,
			),
			
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
				'required' 	=> false,
			),
				
		);

		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);
 
		tgmpa( $plugins, $config );

	}
	
}
add_action( 'tgmpa_register', 'ks_register_required_plugins' );

/* Mobile detect */
require_once( get_template_directory() . '/lib/plugins/Mobile_Detect.php' );



/* Media Upload */
 add_action ( 'admin_enqueue_scripts', media_upload_to_new);
function media_upload_to_new(){
  if (is_admin ())
    wp_enqueue_media();
}

/* remove the H3 tag for the reply-title I.D */
function my_comment_form_before() {
    ob_start();
}
add_action( 'comment_form_before', 'my_comment_form_before' );

function my_comment_form_after() {
    $html = ob_get_clean();
    $html = preg_replace(
        '/<h3 id="reply-title"(.*)>(.*)<\/h3>/',
        '<h4 id="reply-title" class="comment-reply-title"\1>\2</h4>',
        $html
    );
    echo $html;
}
add_action( 'comment_form_after', 'my_comment_form_after' );

// Easy Digital Downloads Comments
function modify_edd_product_supports($supports) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter('edd_download_supports', 'modify_edd_product_supports');

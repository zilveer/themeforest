<?php

// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Set Content Width
if ( ! isset( $content_width ) )
	$content_width = 960;

if (!class_exists('Mobile_Detect')) {
require_once( get_template_directory() . '/inc/config/mobile-detect.php' );
}

// Mobile Detection Plugin
$detect = new Mobile_Detect;

$gorilla_is_ipad = $detect->isIpad();
$gorilla_is_iphone = $detect->isIphone();
$gorilla_is_mobile = $detect->isMobile();
$gorilla_is_tablet = $detect->isTablet();

// Theme Setup
add_action( 'after_setup_theme', 'gorilla_theme_setup' );

if ( !function_exists('gorilla_theme_setup') ) {

	function gorilla_theme_setup() {
	
		// Register navigation menu
		register_nav_menus(
			array(
				'main-menu' => 'Primary Menu',
				'secondary-menu' => 'Footer Menu',
			)
		);
		
		// Localization support
		load_theme_textdomain('alison', get_template_directory() . '/lang');
		
		// Feed Links
		add_theme_support( 'automatic-feed-links' );

		// Title Tag Support
		add_theme_support( 'title-tag' );
		
		// Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'quote', 'link' ) );

		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'thumbnail-full', 1100, 0, true );
		add_image_size( 'thumbnail-carousel', 800, 600, true );
		add_image_size( 'thumbnail-grid', 650, 440, true );
		add_image_size( 'thumbnail-grid-2', 500, 380, true );
		add_image_size( 'thumbnail-slider', 650, 0, true );
		add_image_size( 'thumbnail-masonry', 440, 0, true );
	
	}

}

// Register & enqueue styles/scripts

add_action( 'wp_enqueue_scripts','gorilla_load_scripts',20 );

function gorilla_load_scripts() {

	global $gorilla_home_layout;

	$gorilla_template_uri = get_template_directory_uri();
	$gorilla_template_directory = get_template_directory();

	$upload_dir = wp_upload_dir();
	$upload_style_dir = $upload_dir['basedir'] . '/alison_styles';
	$upload_style_url = $upload_dir['baseurl'] . '/alison_styles';

	$gorilla_content_font = get_theme_mod("gorilla_content_font") ? get_theme_mod("gorilla_content_font") : "//fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext";
	$gorilla_heading_font = get_theme_mod("gorilla_headings_font") && (get_theme_mod("gorilla_content_font") != get_theme_mod("gorilla_headings_font")) ? get_theme_mod("gorilla_headings_font") : "//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900&subset=latin,latin-ext";
	$gorilla_navigation_font = "//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900&subset=latin,latin-ext";

	
	if(get_theme_mod("gorilla_navigation_font")) {
		 $gorilla_navigation_font =  get_theme_mod("gorilla_navigation_font");
		 if(get_theme_mod("gorilla_navigation_font") == get_theme_mod("gorilla_content_font") || get_theme_mod("gorilla_navigation_font") == get_theme_mod("gorilla_headings_font")) {
		 	$gorilla_navigation_font="";
		 }
	}


	// Register scripts and styles
	wp_register_style('components', $gorilla_template_uri . '/assets/css/components.css',array(),NULL);
	wp_register_style('icon-fonts', $gorilla_template_uri . '/assets/css/icon-fonts.css',array(),NULL);
	wp_register_style('headings-font', $gorilla_heading_font,array(),NULL);
	wp_register_style('body-font', $gorilla_content_font,array(),NULL);
	if ($gorilla_navigation_font) {wp_register_style('navigation-font', $gorilla_navigation_font,array(),NULL); }
	wp_register_style('core-style', $gorilla_template_uri . '/style.css',array(),NULL);
	wp_register_style('core-responsive', $gorilla_template_uri . '/assets/css/style-responsive.css',array(),NULL);
	wp_register_style( 'custom', $upload_style_url.'/custom.css', null, null );
	
	wp_register_script('components', $gorilla_template_uri . '/assets/js/components.js', array(), NULL, true);
	wp_register_script('masonry', $gorilla_template_uri . '/assets/js/masonry.pkgd.min.js', array(), NULL, true);
	wp_register_script('smoothscroll', $gorilla_template_uri . '/assets/js/smooth-scroll.js', array(), NULL, true);
	wp_register_script('core-js', $gorilla_template_uri . '/assets/js/core.js', array(), NULL, true);
	
	// Enqueue scripts and styles
	wp_enqueue_style('components');
	wp_enqueue_style('icon-fonts');
	wp_enqueue_style('body-font');
	wp_enqueue_style('headings-font');
	if ($gorilla_navigation_font) {wp_enqueue_style('navigation-font'); }
	wp_enqueue_style('wp-mediaelement');
	wp_enqueue_style('core-style');
	wp_enqueue_style('core-responsive');
	if( file_exists( $upload_style_dir.'/custom.css' )) {
		wp_enqueue_style( 'custom' );
	}
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('components');
	wp_enqueue_script('wp-mediaelement');

	if(get_theme_mod( 'gorilla_enable_smoothscrolling' ) == true){
		wp_enqueue_script('smoothscroll');
	}

	if($gorilla_home_layout == 'masonry' || get_theme_mod( 'gorilla_archive_layout' ) == 'masonry') {
		wp_enqueue_script('masonry');
	}

	wp_enqueue_script('core-js');
	
	if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');
	
}

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package   TGM-Plugin-Activation
 * @version   2.5.0-alpha
 * @link      http://tgmpluginactivation.com/
 * @author    Thomas Griffin
 * @author    Gary Jones
 * @copyright Copyright (c) 2011, Thomas Griffin
 * @license   GPL-2.0+
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/extensions/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'gorilla_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function gorilla_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     				=> 'Alison Featured Slider', // The plugin name
			'slug'     				=> 'alison-featured-slider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/plugins/alison-featured-slider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'     				=> 'Meta Box', // The plugin name
			'slug'     				=> 'meta-box', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/plugins/metabox-core.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.5.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'     				=> 'Flickr Badges Widget', // The plugin name
			'slug'     				=> 'flickr-badges-widget', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'     				=> 'Instagram Slider Widget', // The plugin name
			'slug'     				=> 'instagram-slider-widget', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'     				=> 'Latest Tweets Widget', // The plugin name
			'slug'     				=> 'latest-tweets-widget', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		)
	);

	tgmpa( $plugins );

}

// Included Customizer Controls
include('inc/customizer/theme_custom_controller.php');
include('inc/customizer/theme_customizer_settings.php');
include('inc/customizer/theme_customizer_style.php');

// Included Custom Widgets
include("inc/widgets/wgt_about.php");
include("inc/widgets/wgt_facebook.php");
include("inc/widgets/wgt_latest_posts.php");
include("inc/widgets/wgt_social_network.php");
include("inc/widgets/wgt_ads.php");
include("inc/widgets/wgt_recent_post_with_thumbs.php");

function gorilla_include(){
	global $gorilla_pagination_type;
	// Included Load More Functionality
	if($gorilla_pagination_type == "load-more"){
		include("inc/extensions/ajax-load-posts.php");
	}
}

add_action('init', 'gorilla_include');

// Admin Controls
if ( is_admin() ) {
	include('inc/admin/admin-function.php');
}


// Register footer widgets
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
    	'id'   => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Sidebar (Detail Page)',
    	'id'   => 'detail_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'After Content Widget Area ',
    	'id'   => 'after-content-widget-area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Footer Column-1',
    	'id'   => 'footer-1',
		'before_widget' => '<div id="%1$s" class="widget first %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Footer Column-2',
    	'id'   => 'footer-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	
	register_sidebar(array(
		'name' => 'Footer Column-3',
    	'id'   => 'footer-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => 'Footer Column-4',
    	'id'   => 'footer-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
}

/*---------- FEATURED SLIDER ----------------- */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('alison-featured-slider/featured.php')) {
	function gorilla_featured_slider_shortcode(){
		echo do_shortcode("[gorilla_featured_slider]");
	}

	add_action('gorilla_featured_slider_container', 'gorilla_featured_slider_shortcode');
}

/*---------- METABOX ----------------- */

function gorilla_metabox_setup(){
	if (is_plugin_active('meta-box/meta-box.php')) {
		require_once( get_template_directory() . '/inc/extensions/meta-box/meta-box-config.php' );
	}
}

add_action('init', 'gorilla_metabox_setup', 1);


/*---------- METABOX ----------------- */

// Customizer Global Variables
function gorilla_customizer_global_variables(){

	global $gorilla_featured_area, $gorilla_layout_enable_home_intro, $gorilla_after_content_area_width,
	$gorilla_featured_area_width, $gorilla_sidebar_home, $gorilla_home_layout, $gorilla_pagination_type,
	$gorilla_footer_widget_area, $gorilla_sidebar_posts, $gorilla_enable_featured_post_area, $gorilla_select_featured_post_area_category;

	$gorilla_featured_area = get_theme_mod( 'gorilla_featured_area',true);
	$gorilla_featured_area_width = get_theme_mod( 'gorilla_featured_area_width',"boxed" );
	$gorilla_layout_enable_home_intro = get_theme_mod( 'gorilla_layout_enable_home_intro' );
	$gorilla_sidebar_home = get_theme_mod( 'gorilla_sidebar_home',true );
	$gorilla_sidebar_posts = get_theme_mod( 'gorilla_sidebar_posts',true );
	$gorilla_home_layout = get_theme_mod( 'gorilla_home_layout','full' );
	$gorilla_pagination_type = get_theme_mod( 'gorilla_pagination_type','classic' );
	$gorilla_footer_widget_area = get_theme_mod( 'gorilla_footer_widget_area',true );
	$gorilla_after_content_area_width = get_theme_mod( 'gorilla_after_content_area_width', "full" );
	$gorilla_enable_featured_post_area = get_theme_mod( 'gorilla_enable_featured_post_area',false);
	$gorilla_select_featured_post_area_category = get_theme_mod( 'gorilla_select_featured_post_area_category');

}

add_action('init', 'gorilla_customizer_global_variables',1);

// Featured Posts
function gorilla_get_featured_posts(){
	require_once( get_template_directory() . '/inc/includes/featured_posts.php' );
}

add_action('gorilla_get_featured_posts', 'gorilla_get_featured_posts', 1);


// Post like System

function gorilla_post_like_setup(){
	require_once( get_template_directory() . '/inc/extensions/post-like.php' );
}

add_action('init', 'gorilla_post_like_setup', 2);

// Pagination
function gorilla_pagination() {

	global $gorilla_pagination_type;

	if($gorilla_pagination_type == "classic" && (get_previous_posts_link() || get_next_posts_link())){

?>
	
	<div class="pagination clearfix">
		<div class="older animative-btn"><?php next_posts_link( __("Older Posts", 'alison') ); ?></div>
		<div class="newer animative-btn"><?php previous_posts_link( __("Newer Posts", 'alison') ); ?></div>
	</div>
					
	<?php
	
	}
	elseif($gorilla_pagination_type == "load-more"){ ?>
		<div class="pagination load-more">
			<p id="pbd-alp-load-posts"><a href="#" class="animative-btn"><span class="throbber-loader"></span><span class="text"><?php _e('Want to See More Stories?', 'alison'); ?></span></a></p>
		</div>

<?php }

}


// Share Box

function gorilla_get_share_buttons() {
	if(!get_theme_mod('gorilla_post_share')) : 
		global $post;
	?>
		<div class="post-share">
			<div class="box-title-area"><h4 class="title"><?php _e('Share This Post!', 'alison'); ?></h4></div>
			<div class="post-share-inner">
				<ul>
					<li class="share-item facebook"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode(get_the_permalink()); ?>"><span class="share-box"><i class="fa fa-facebook"></i></span></a></li>
					<li class="share-item twitter"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(strip_tags(get_the_title())); ?>+-+<?php echo rawurlencode(get_the_permalink());; ?>"><span class="share-box"><i class="fa fa-twitter"></i></span></a></li>
					<?php $pin_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),"thumbnail-full"); ?>
					<li class="share-item pinterest"><a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo rawurlencode(get_the_permalink()); ?>&amp;media=<?php echo rawurlencode($pin_image[0]); ?>&amp;description=<?php echo urlencode(strip_tags(get_the_title())); ?>"><span class="share-box"><i class="fa fa-pinterest"></i></span></a></li>
					<li class="share-item google"><a target="_blank" href="https://plus.google.com/share?url=<?php echo rawurlencode(get_the_permalink()); ?>"><span class="share-box"><i class="fa fa-google-plus"></i></span></a></li>
					<li class="share-item e-mail"><a target="_blank" href="mailto:?Subject=<?php echo urlencode(strip_tags(get_the_title()));?>&amp;Body=<?php echo rawurlencode(get_the_permalink()); ?>"><span class="share-box"><i class="fa fa-envelope-o"></i></span></a></li>
				</ul>
			</div>
		</div>
	<?php endif;
}

add_action('gorilla_get_share_buttons', 'gorilla_get_share_buttons', 1);


// Comments Layout

function gorilla_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		
		<div class="comment-item">
					
			<div class="author-img">
				<?php echo get_avatar($comment,60); ?>
			</div>
			
			<div class="comment-text">
				<span class="author"><?php echo get_comment_author_link(); ?></span>
				<span class="date"><?php printf(__('%1$s at %2$s', 'alison'), get_comment_date(),  get_comment_time()) ?></span>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><i class="icon-info-sign"></i> <?php _e('Comment awaiting approval', 'alison'); ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text(); ?>

				<span class="reply">
					<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'alison'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
					<?php edit_comment_link(__('Edit', 'alison')); ?>
				</span>
				
			</div>
					
		</div>
		
		
	</li>

	<?php 
}

// Author Social Links
function gorilla_contactmethods( $contactmethods ) {

	$contactmethods['twitter']   = 'Twitter Username';
	$contactmethods['facebook']  = 'Facebook Username';
	$contactmethods['google']    = 'Google Plus Username';
	$contactmethods['tumblr']    = 'Tumblr Username';
	$contactmethods['instagram'] = 'Instagram Username';
	$contactmethods['pinterest'] = 'Pinterest Username';

	return $contactmethods;
}
add_filter('user_contactmethods','gorilla_contactmethods',10,1);



// Category

function gorilla_category($id = "", $separator, $html_output = "link") {
		
	$first_time = 1;

	foreach((get_the_category($id)) as $category) {

		if ($first_time == 1) {
			$first_time = 0;
			$seperator = "";
		}
		else {
			$seperator = ", ";
		}

		if($html_output == "link"){
			$output = '<a href="' . get_category_link( $category->term_id ) . '">'  . esc_html($category->name).'</a>';
		}
		elseif($html_output == "text"){
			$output = $category->name;
		}

		echo esc_html($seperator).wp_kses($output, wp_kses_allowed_html( 'post' ));
	}
}

// Excerpt
function new_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


// Comment button
function gorilla_comment_button($id) {

	if ( comments_open() || have_comments() ) :
	$output = '<a class="comment-button" href="'.esc_url(get_comments_link( $id )).'"><i class="fa fa-comment-o"></i> '.get_comments_number( $id ).'</a>';
	else :
	$output = "";
	endif;

	return $output;
}

// If Navigasyon is not set
function gorilla_menu_add_alert(){
	$alert_html = '<div class="nav-menu add-menu-alert"><p>'.esc_html__("Please add a menu from Appearance > Menus Panel", 'alison').'</p></div>';
	echo wp_kses($alert_html, wp_kses_allowed_html( 'post' ));
}

function gorilla_format_icon($id){

	$post_format_name = get_post_format($id);

?>
	<div class="format-icon">
<?php
	
	if($post_format_name == false){
		echo '<i class="elegant elegant-pencil2"></i>';
	}
	elseif($post_format_name == "gallery"){
		echo '<i class="elegant elegant-camera4"></i>';
	}
	elseif($post_format_name == "video"){
		echo '<i class="elegant elegant-video"></i>';
	}
	elseif($post_format_name == "audio"){
		echo '<i class="elegant elegant-mic"></i>';
	}
	else {
		echo '<i class="elegant elegant-scope"></i>';
	}
		
?>
	</div>
<?php
}

// Page Title Set Function
add_filter( 'wp_title', 'ev_set_title' );
if(!function_exists('ev_set_title'))
{

	function ev_set_title($ev_title){

		global $gorilla,$seplocation,$sep;

		if (!empty($gorilla['val_site_name'])) {
			$ev_blog_name = $gorilla['val_site_name'];
		}
		else {
			$ev_blog_name = get_bloginfo('name');
		};


		global $wp_locale;

		$m = get_query_var('m');
		$year = get_query_var('year');
		$monthnum = get_query_var('monthnum');
		$day = get_query_var('day');
		$search = get_query_var('s');
		$ev_title = '';
		$ev_blog_desc = '';

		$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

		// If there is a post
		if ( is_single() || ( is_home() && !is_front_page() ) || ( is_page() && !is_front_page() ) ) {
			$ev_title = single_post_title( '', false );
		}

		// If there's a post type archive
		if ( is_post_type_archive() ) {
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) )
				$post_type = reset( $post_type );
			$post_type_object = get_post_type_object( $post_type );
			if ( ! $post_type_object->has_archive )
				$ev_title = post_type_archive_title( '', false );
		}

		// If there's a category or tag
		if ( is_category() || is_tag() ) {
			$ev_title = single_term_title( '', false );
		}

		// If there's a taxonomy
		if ( is_tax() ) {
			$term = get_queried_object();
			if ( $term ) {
				$tax = get_taxonomy( $term->taxonomy );
				$ev_title = single_term_title( $tax->labels->name . $t_sep, false );
			}
		}

		// If there's an author
		if ( is_author() && ! is_post_type_archive() ) {
			$author = get_queried_object();
			if ( $author )
				$ev_title = $author->display_name;
		}

		// Post type archives with has_archive should override terms.
		if ( is_post_type_archive() && $post_type_object->has_archive )
			$ev_title = post_type_archive_title( '', false );

		// If there's a month
		if ( is_archive() && !empty($m) ) {
			$my_year = substr($m, 0, 4);
			$my_month = $wp_locale->get_month(substr($m, 4, 2));
			$my_day = intval(substr($m, 6, 2));
			$ev_title = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
		}

		// If there's a year
		if ( is_archive() && !empty($year) ) {
			$ev_title = $year;
			if ( !empty($monthnum) )
				$ev_title .= $t_sep . $wp_locale->get_month($monthnum);
			if ( !empty($day) )
				$ev_title .= $t_sep . zeroise($day, 2);
		}

		// If it's a search
		if ( is_search() ) {
			/* translators: 1: separator, 2: search phrase */
			$ev_title = sprintf(esc_html__('Search Results %1$s %2$s','alison'), $t_sep, strip_tags($search));
		}

		// If it's a 404 page
		if ( is_404() ) {
			$ev_title = esc_html__('Page not found','alison');
		}

		$prefix = '';
		if ( !empty($ev_title) )
			$prefix = " $sep ";


		$ev_title_array = apply_filters( 'wp_title_parts', explode( $t_sep, $ev_title ) );

	 	// Determines position of the separator and direction of the breadcrumb
		if ( 'right' == $seplocation ) { // sep on right, so reverse the order
			$ev_title_array = array_reverse( $ev_title_array );
			$ev_title = implode( " $sep ", $ev_title_array ) . $prefix;
		} else {
			$ev_title = $prefix . implode( " $sep ", $ev_title_array );
		}

		if( is_front_page() ) {
			if(get_bloginfo('description')){
				$ev_blog_desc = ' | ' . get_bloginfo('description');
			}
			$ev_title = $ev_blog_name . $ev_blog_desc;
		}
		else {
			$ev_title = $ev_title. " | " .$ev_blog_name;
		}

		return $ev_title;

	}
}

function gorilla_most_popular_post_id_update(){
	global $post;
	$args = array(
		'post_type' => array( 'post' ),
		'meta_query' => array(
		  array(
			  'key' => '_post_like_count',
			  'value' => '0',
			  'compare' => '>'
		  )
		),
		'meta_key' => '_post_like_count',
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
		'post__not_in' => get_option( 'sticky_posts' ),
		'posts_per_page' => 3
	 );

	$most_popular_posts_ids = array();
	$most_popular_posts = new WP_Query( $args );
	$i = 0;
	while ( $most_popular_posts->have_posts() ) {
		$most_popular_posts->the_post();
		$most_popular_posts_ids[$i]["post_id"] = $post->ID;
		$most_popular_posts_ids[$i]["like_count"] = get_post_meta($post->ID, "_post_like_count");
		$i++;
	}
	wp_reset_postdata();
	$most_popular_posts_ids = serialize($most_popular_posts_ids);
	update_option("gorilla_most_popular_posts", $most_popular_posts_ids);
}

add_action('wp', 'gorilla_most_popular_post_id_update', 1);

/*---------- FACEBOOK OPEN GRAPH AND SHARING ----------------- */

if ( ! function_exists( 'ev_openGraph' ) ) :
function ev_openGraph() {
	global $post;
	global $gorilla;
	$excerpt = "";

	echo "<meta property='og:site_name' content='". get_bloginfo('name') ."'/>";
	echo "<meta property='og:url' content='" . get_permalink() . "'/>";

	if(has_excerpt()){
		$excerpt = strip_tags($post->post_excerpt);
        $excerpt = str_replace("", "'", $excerpt);
		echo '<meta property="og:description" content="'.$excerpt.'">';
	}

	if (is_single() && $post->post_type == "post") {
        echo "<meta property='og:title' content='" . strip_tags(get_the_title()) . "'/>"; 
        echo "<meta property='og:type' content='article'/>"; 
    }
    elseif(is_front_page() or is_home()) { 
    	echo "<meta property='og:title' content='" . get_bloginfo("name") . "'/>"; 
    	echo "<meta property='og:type' content='website'/>"; 
    }
    else {
    	echo "<meta property='og:title' content='" . strip_tags(get_the_title()) . "'/>";
        echo "<meta property='og:type' content='website'/>";
    }

	if(is_single() && has_post_thumbnail( $post->ID )) {
		$ev_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-grid' );
		echo "<meta property='og:image' content='" . esc_attr( $ev_thumbnail[0] ) . "'/>"; 
	}

}

add_action( 'wp_head', 'ev_openGraph', 5 );

endif;

/*---------- FACEBOOK OPEN GRAPH AND SHARING ----------------- */

<?php
	
/*-----------------------------------------------------------------------------------

	Below we have all of the custom functions for the theme
	Please be extremely cautious editing this file!
	
-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Global theme variables
/*-----------------------------------------------------------------------------------*/
$theme = wp_get_theme();
$themename = $theme->Name;
$shortname = "t2t";

// Customizer
require_once(get_template_directory() . '/includes/customizer.php');

// Plugin activation
require_once(get_template_directory()  . '/includes/plugins.php');

// Shortcode filters and extensions
require_once(get_template_directory()  . '/includes/shortcodes.php');

// Widget filters and extensions
require_once(get_template_directory()  . '/includes/widgets.php');

// Metabox filters and extensions
require_once(get_template_directory()  . '/includes/meta_boxes.php');

// Theme colors
require_once(get_template_directory()  . '/stylesheets/theme_colors.php');

/**
 * meta boxes
 *
 */
foreach(scandir(get_template_directory() . "/includes/page_template_options") as $filename) {
  $path = get_template_directory() . '/includes/page_template_options/' . $filename;

  if(is_file($path) && preg_match("/template-[a-z_-]+.php/", $filename)) {
    require_once($path);
  }
}

/*-----------------------------------------------------------------------------------*/
/*	Add Localization Support
/*-----------------------------------------------------------------------------------*/

function t2t_load_textdomain(){
	load_theme_textdomain('framework', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 't2t_load_textdomain');

/*-----------------------------------------------------------------------------------*/
/*	Set Max Content Width
/*-----------------------------------------------------------------------------------*/

if(!isset($content_width)) {
 $content_width = 980;   
}

add_theme_support('automatic-feed-links');

function t2t_layout_style($classes) {
  
  $current_layout = array();

	$is_fullscreen_template = false;

	$template_name = get_page_template_slug(); 
	if(strpos($template_name, "fullscreen") !== false) {
		$is_fullscreen_template = true;
	}

	if($is_fullscreen_template) {
		$classes[] = "fullscreen";
	}

	$classes[] = "body-push auto-close-menu";

	return $classes;
}
add_filter('body_class','t2t_layout_style');

/*-----------------------------------------------------------------------------------*/
/*	WooCommerce support
/*-----------------------------------------------------------------------------------*/

add_theme_support('woocommerce');

/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if(function_exists('register_sidebar')) {
	register_sidebar(array(
		"id"                => "blog-sidebar",
		"name"              => __("Blog", "framework"),
		"description"       => __("Appears on the blog template.", "framework"),
    "before_widget"     => '<div id="%1$s" class="widget %2$s">',
		"after_widget"      => "</div>",
		"before_title"      => "<h5>",
		"after_title"       => "</h5>"
	));
	
	register_sidebar(array(
		"id"                => "page-sidebar",
		"name"              => __("Page", "framework"),
		"description"       => __("Appears on page templates.", "framework"),
    "before_widget"     => '<div id="%1$s" class="widget %2$s">',
		"after_widget"      => "</div>",
		"before_title"      => "<h5>",
		"after_title"       => "</h5>"
	));
	
  register_sidebar(array(
    "id"                => "footer-widget-1",
    "name"              => __("Footer Widget 1", "framework"),
    "description"       => __("Appears in the footer area.", "framework"),
    "before_widget"     => '<div id="%1$s" class="widget %2$s">',
    "after_widget"      => "</div>",
    "before_title"      => "<h5 class=\"widget-title\">",
    "after_title"       => "</h5>"
  ));

  register_sidebar(array(
    "id"                => "footer-widget-2",
    "name"              => __("Footer Widget 2", "framework"),
    "description"       => __("Appears in the footer area.", "framework"),
    "before_widget"     => '<div id="%1$s" class="widget %2$s">',
    "after_widget"      => "</div>",
    "before_title"      => "<h5 class=\"widget-title\">",
    "after_title"       => "</h5>"
  ));

  register_sidebar(array(
    "id"                => "footer-widget-3",
    "name"              => __("Footer Widget 3", "framework"),
    "description"       => __("Appears in the footer area.", "framework"),
    "before_widget"     => '<div id="%1$s" class="widget %2$s">',
    "after_widget"      => "</div>",
    "before_title"      => "<h5 class=\"widget-title\">",
    "after_title"       => "</h5>"
  ));

  register_sidebar(array(
    "id"                => "footer-widget-4",
    "name"              => __("Footer Widget 4", "framework"),
    "description"       => __("Appears in the footer area.", "framework"),
    "before_widget"     => '<div id="%1$s" class="widget %2$s">',
    "after_widget"      => "</div>",
    "before_title"      => "<h5 class=\"widget-title\">",
    "after_title"       => "</h5>"
  ));
}

/*-----------------------------------------------------------------------------------*/
/*	Google typography settings
/*-----------------------------------------------------------------------------------*/

if(function_exists('register_typography')) {	
  register_typography(array(
    'logo' => array(
    	'preview_text' => 'Website Name',
    	'preview_color' => 'light',
    	'font_family' => 'Yesteryear',
    	'font_variant' => 'normal',
    	'font_size' => '35px',
    	'font_color' => '#444444',
    	'css_selectors' => 'header .logo a'
    ),
		'slider_titles' => array(
    	'preview_text' => 'Slider Titles',
    	'preview_color' => 'light',
    	'font_family' => 'Open Sans',
    	'font_variant' => '300',
    	'font_size' => '45px',
    	'font_color' => '#555555',
    	'css_selectors' => '.slide-content .title'
    ),
		'slider_captions' => array(
    	'preview_text' => 'Slider Captions',
    	'preview_color' => 'light',
    	'font_family' => 'Open Sans',
    	'font_variant' => '300',
    	'font_size' => '18px',
    	'font_color' => '#555555',
    	'css_selectors' => '.slide-content .caption'
    ),
		'paragraphs' => array(
    	'preview_text' => 'Paragraph Text',
    	'preview_color' => 'light',
    	'font_family' => 'Open Sans',
    	'font_variant' => 'normal',
    	'font_size' => '14px',
    	'font_color' => '#8a8a8a',
    	'css_selectors' => 'p'
    )
  ));
}

/*-----------------------------------------------------------------------------------*/
/*	If WP 3.0 or > include support for wp_nav_menu()
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'primary-menu' => __('Main Menu', 'framework' )
		)
	);
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/
function t2t_custom_gravatar( $avatar_defaults ) {
    $tz_avatar = get_template_directory_uri() . '/images/gravatar.png';
    $avatar_defaults[$tz_avatar] = 'Custom Gravatar (/images/gravatar.png)';
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 't2t_custom_gravatar' );

/*-----------------------------------------------------------------------------------*/
/*	Add Comment Reply JS
/*-----------------------------------------------------------------------------------*/
function theme_queue_js(){
  if (!is_admin()){
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
      wp_enqueue_script( 'comment-reply' );
  }
}
add_action('wp_print_scripts', 'theme_queue_js');

/*-----------------------------------------------------------------------------------*/
/*	Add/configure thumbnails
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	    
	// change the default thumbnail size
	update_option("thumbnail_size_w", 100);
	update_option("thumbnail_size_h", 100);
	update_option("thumbnail_crop", 1);

	// change the default medium size
	update_option("medium_size_w", 480);
	update_option("medium_size_h", 268);
	update_option("medium_crop", 1);

	// change the default medium size
	update_option("large_size_w", 1000);
	update_option("large_size_h", 999999);
	update_option("large_crop", 0);

	// Add style for masonry
	add_image_size("masonry-thumb", 560, 560, true);
	add_image_size("masonry-thumb-natural", 560, 99999);
}

/*-----------------------------------------------------------------------------------*/
/*	Register and load javascripts
/*-----------------------------------------------------------------------------------*/
function t2t_register_js() {
	global $theme;

	if (!is_admin()) {

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-effects-slide');
		
		// For development
		// wp_enqueue_script('html5shiv', get_template_directory_uri() . '/javascripts/html5shiv.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('pace', get_template_directory_uri() . '/javascripts/pace.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('easing', get_template_directory_uri() . '/javascripts/jquery.easing.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('tipsy', get_template_directory_uri() . '/javascripts/jquery.tipsy.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('ba-cond', get_template_directory_uri() . '/javascripts/jquery.ba-cond.min.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('imgliquid', get_template_directory_uri() . '/javascripts/imgLiquid.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('isotope', get_template_directory_uri() . '/javascripts/jquery.isotope.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('perfectmasonry', get_template_directory_uri() . '/javascripts/jquery.isotope.perfectmasonry.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/javascripts/jquery.imagesloaded.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('scrubnails', get_template_directory_uri() . '/javascripts/jquery.scrubnails.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('retinise', get_template_directory_uri() . '/javascripts/jquery.retinise.js', array('jquery'), $theme->version, true);
		// wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/javascripts/jquery.hoverIntent.js', array('jquery'), $theme->version, true);

		wp_enqueue_script('combined', get_template_directory_uri() . '/javascripts/_combined.js', array('jquery'), $theme->version, true);
		wp_enqueue_script('uitotop', get_template_directory_uri() . '/javascripts/jquery.ui.totop.js', array('jquery'), $theme->version, true);
		wp_enqueue_script('addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52201ac3444196d2', array('jquery'), $theme->version, true);
		wp_enqueue_script('custom', get_template_directory_uri() . '/javascripts/custom.js', array('jquery'), $theme->version, true);
	}
	
}
add_action('wp_enqueue_scripts', 't2t_register_js');

/*-----------------------------------------------------------------------------------*/
/*	Register and load css
/*-----------------------------------------------------------------------------------*/
function t2t_register_css() {
	global $theme;

	if (!is_admin()) {
	  
    wp_enqueue_style("google-fonts", 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800|Yesteryear', false, false, "all");
		
		wp_register_style('tipsy', get_template_directory_uri() . '/stylesheets/tipsy.css', array(), $theme->version);
		wp_register_style('style', get_stylesheet_uri(), array(), $theme->version);
		
		wp_enqueue_style('tipsy');
		wp_enqueue_style('style');
	}
}
add_action('wp_enqueue_scripts', 't2t_register_css');


function t2t_register_admin_css() {
	// Google typography tweaks
	$css = '<style type="text/css">';
  $css .= '#google_typography .wp-picker-container { display: none; }';
	$css .= '#google_typography .preview_color { display: none; }';
	$css .= 'div#google_typography .font_options a.delete_collection { display: none; }';
	$css .= '</style>';

	echo $css;
}
add_action('admin_head', 't2t_register_admin_css');

function themeit_add_editor_style() {
  add_editor_style( 'style-editor.css' );
}
add_action( 'after_setup_theme', 'themeit_add_editor_style' );

/*-----------------------------------------------------------------------------------*/
/*	Theme customizer hooks
/*-----------------------------------------------------------------------------------*/

function t2t_customizer_css() {
  
	$css = '<style type="text/css">';
	$css .= get_theme_mod('t2t_customizer_css');
	$css .= '</style>';

	echo $css;
}
add_action('wp_head', 't2t_customizer_css');

function t2t_customizer_js() {
  
  $js = '<script type="text/javascript">';
  $js .=  get_theme_mod('t2t_customizer_js');
  if(get_theme_mod("t2t_disable_right_click")) {
    $js .= 'jQuery(document).ready(function($) { $("body").on("contextmenu", "img", function(e){ return false; }); });';
  }
  $js .= '</script>';
  
  echo $js;
}
add_action('wp_head', 't2t_customizer_js');

function t2t_customizer_analytics() {
  
  echo get_theme_mod('t2t_customizer_analytics');
  
}
add_action('wp_footer', 't2t_customizer_analytics');

/*-----------------------------------------------------------------------------------*/
/*	Function to output social links
/*-----------------------------------------------------------------------------------*/
function get_t2t_social_links() {
	$social_links = array(
		"twitter"   => array(
			"rounded"  => "entypo-twitter-circled",
			"circular" => "typicons-social-twitter-circular",
			"simple"   => "typicons-social-twitter",
			"href"     => get_theme_mod("t2t_customizer_social_twitter")
		),
		"facebook"  => array(
			"rounded"  => "entypo-facebook-circled",
			"circular" => "typicons-social-facebook-circular",
			"simple"   => "typicons-social-facebook",
			"href"     => get_theme_mod("t2t_customizer_social_facebook")
		),
		"flickr"    => array(
			"rounded"  => "entypo-flickr-circled",
			"circular" => "typicons-social-flickr-circular",
			"simple"   => "typicons-social-flickr",
			"href"     => get_theme_mod("t2t_customizer_social_flickr")
		),
		"github"    => array(
			"rounded"  => "entypo-github-circled",
			"circular" => "typicons-social-github-circular",
			"simple"   => "typicons-social-github",
			"href"     => get_theme_mod("t2t_customizer_social_github")
		),
		"vimeo"     => array(
			"rounded"  => "entypo-vimeo-circled",
			"circular" => "typicons-social-vimeo-circular",
			"simple"   => "typicons-social-vimeo",
			"href"     => get_theme_mod("t2t_customizer_social_vimeo")
		),
		"pinterest" => array(
			"rounded"  => "entypo-pinterest-circled",
			"circular" => "typicons-social-pinterest-circular",
			"simple"   => "typicons-social-pinterest",
			"href"     => get_theme_mod("t2t_customizer_social_pinterest")
		),
		"linkedin"  => array(
			"rounded"  => "entypo-linkedin-circled",
			"circular" => "typicons-social-linkedin-circular",
			"simple"   => "typicons-social-linkedin",
			"href"     => get_theme_mod("t2t_customizer_social_linked")
		),
		"dribbble"  => array(
			"rounded"  => "entypo-dribbble-circled",
			"circular" => "typicons-social-dribbble-circular",
			"simple"   => "typicons-social-dribbble",
			"href"     => get_theme_mod("t2t_customizer_social_dribbble")
		),
		"lastfm"    => array(
			"rounded"  => "entypo-lastfm-circled",
			"circular" => "typicons-social-last-fm-circular",
			"simple"   => "typicons-social-last-fm",
			"href"     => get_theme_mod("t2t_customizer_social_lastfm")
		),
		"skype"     => array(
			"rounded"  => "entypo-skype-circled",
			"circular" => "typicons-social-skype-outline",
			"simple"   => "typicons-social-skype",
			"href"     => get_theme_mod("t2t_customizer_social_skype")
		),
		"email"     => array(
			"rounded"  => "typicons-at",
			"circular" => "typicons-at",
			"simple"   => "typicons-mail",
			"href"     => get_theme_mod("t2t_customizer_social_email")
		)
	);

	$social_style = get_theme_mod("t2t_customizer_social_style", "rounded");

	$html = "<ul class=\"social " . $social_style . "\">";

	foreach($social_links as $site => $settings) {
		// only include the link if a url was provided
		if(!empty($settings["href"]) && $settings["href"] != "") {
			$html .= "<li><a href=\"" . $settings["href"] . "\" title=\"" . $site . "\"><span class=\"" . $settings[$social_style] . "\"></span></a></li>";
		}
	}

	$html .= '</ul>';
	
	return $html;
}

// same as get_t2t_social_links method but rather than
// returning the markup, it prints it by default
function t2t_social_links() {
	echo get_t2t_social_links();
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Excerpt Functions
/*-----------------------------------------------------------------------------------*/
function custom_excerpt_length( $length ) {
	return 13;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*-----------------------------------------------------------------------------------*/
/*	Password protected posts
/*-----------------------------------------------------------------------------------*/

function custom_password_text($content) {
	$before = 'Password:';
	$after = '';
	$content = str_replace($before, $after, $content);
	return $content;
}
add_filter('the_password_form', 'custom_password_text');

function custom_password_prompt($content) {
	$before = 'This post is password protected. To view it please enter your password below:';
	$after = 'This content is password protected. To view it please enter your password below:';
	$content = str_replace($before, $after, $content);
	return $content;
}
add_filter('the_password_form', 'custom_password_prompt');

/*-----------------------------------------------------------------------------------*/
/*	Register plugins
/*-----------------------------------------------------------------------------------*/
function t2t_required_plugins() {
	$plugins = array(
		array(
			'name' 		      => 'T2T Toolkit',
			'slug' 		      => 't2t-toolkit',
			'source' 			  => 'http://assets.t2themes.com/plugins/t2t-toolkit/t2t-toolkit-latest.zip',
			'external_url'  => 'http://t2themes.com',
			'required' 	    => true
		),
		array(
			'name' 		=> 'Google Typography',
			'slug' 		=> 'google-typography',
			'required' 	=> false
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false
		),
		array(
			'name' 		=> 'Image Watermark',
			'slug' 		=> 'image-watermark',
			'required' 	=> false
		),
		array(
			'name' 		=> 'Post Types Order',
			'slug' 		=> 'post-types-order',
			'required' 	=> false
		),
		array(
			'name' 		=> 'Easy Theme and Plugin Upgrades',
			'slug' 		=> 'easy-theme-and-plugin-upgrades',
			'required' 	=> false
		)
	);
	
	$theme_text_domain = 'framework';
	
	$config = array('domain' => $theme_text_domain, 'menu' => 'install-required-plugins');
	
	tgmpa($plugins, $config);
}
add_action( 'tgmpa_register', 't2t_required_plugins' );

add_theme_support( 'post-formats' );

/*-----------------------------------------------------------------------------------*/
/*	T2T_Toolkit-ness
/*-----------------------------------------------------------------------------------*/
function enable_t2t_post_types($post_types) {
	if(class_exists("T2T_Post")) {
		array_push($post_types, new T2T_Post());
	}
	if(class_exists("T2T_Page")) {
		array_push($post_types, new T2T_Page());
	}
	if(class_exists("T2T_Album")) {
		array_push($post_types, new T2T_Album());
	}
	if(class_exists("T2T_Portfolio")) {
		array_push($post_types, new T2T_Portfolio(array(
			"args" => array(
				"supports" => array("title", "editor", "thumbnail", "post-formats")
			)
		)));
	}
	if(class_exists("T2T_Service")) {
		array_push($post_types, new T2T_Service());
	}
	if(class_exists("T2T_Testimonial")) {
		array_push($post_types, new T2T_Testimonial());
	}
	if(class_exists("T2T_SlitSlider")) {
		array_push($post_types, new T2T_SlitSlider(array(
			"show_shortcodes" => false
		)));
	}
	if(class_exists("T2T_ElasticSlider")) {
		array_push($post_types, new T2T_ElasticSlider(array(
			"show_shortcodes" => false
		)));
	}
	if(class_exists("T2T_FlexSlider")) {
		array_push($post_types, new T2T_FlexSlider(array(
			"show_shortcodes" => false
		)));
	}

	return $post_types;
}
add_filter("t2t_toolkit_enabled_post_types", "enable_t2t_post_types");

function t2t_portfolio_post_formats($formats) {
	return array("video", "audio", "image", "gallery");
}
add_filter("t2t_portfolio_post_formats", "t2t_portfolio_post_formats");
?>
<?php
/* ======================================= */
/* Gordon Theme Functions */
/* ======================================= */
if ( ! isset( $content_width ) ) $content_width = 1100; /* pixels */

/* Makes theme available for translation. */
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
load_theme_textdomain( 'orangeidea', get_template_directory() . '/languages' );
}

/**
 * Include Framework. (Theme options)
 */ 
if ( !class_exists( 'ReduxFramework' ) && file_exists(get_template_directory() . '/theme-options/ReduxCore/framework.php' ) ) {
	require_once( get_template_directory() . '/theme-options/ReduxCore/framework.php' );
}

if ( !isset( $ct_options ) && file_exists( get_template_directory() . '/theme-options/options.php' ) ) {
	require_once( get_template_directory() . '/theme-options/options.php' );
}

/* ======================================= */
/* Theme Stylesheets */
/* ======================================= */

function oi_theme_styles_basic()  
{
	/* Enqueue Stylesheets */
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' ); // Main Stylesheet
	wp_enqueue_style( 'flex-slider', get_template_directory_uri() . '/framework/FlexSlider/flexslider.css', array(), '1', 'all' );
	wp_enqueue_style( 'owl_carousel', get_template_directory_uri() . '/framework/css/owl.carousel.css', array(), '1', 'all' );
	wp_enqueue_style( 'owl_remodal', get_template_directory_uri() . '/framework/css/remodal.css', array(), '1', 'all' );
	wp_enqueue_style( 'owl_remodal_theme', get_template_directory_uri() . '/framework/css/remodal-default-theme.css', array(), '1', 'all' );
	wp_enqueue_style( 'oi_tipso', get_template_directory_uri() . '/framework/css/tipso.min.css', array(), '1', 'all' );
	wp_enqueue_style( 'oi_woo', get_template_directory_uri() . '/framework/css/woocommerce.css',  array(), '1', 'all');
	
}  
add_action( 'wp_enqueue_scripts', 'oi_theme_styles_basic', 1 ); 

function oi_load_custom_wp_admin_style() {
	wp_register_style( 'oi_custom_wp_admin_css', get_template_directory_uri() . '/framework/css/wp-admin.css', false, '1.0.0' );
	wp_enqueue_style( 'oi_custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'oi_load_custom_wp_admin_style' );



/* ======================================= */
/* Loading Theme Scripts */
/* ======================================= */
add_action('wp_enqueue_scripts', 'oi_load_scripts');
if ( !function_exists( 'oi_load_scripts' ) ) {
	function oi_load_scripts() {
		global $oi_options;
		wp_enqueue_script('oi_bootstrap', get_template_directory_uri().'/framework/bootstrap/bootstrap.min.js', false, null , true);
		wp_enqueue_script('oi_lightbox', get_template_directory_uri().'/framework/js/lightbox.min.js', false, null , true);
		wp_enqueue_script('oi_flexslider', get_template_directory_uri().'/framework/FlexSlider/jquery.flexslider-min.js', false, null , true);
		wp_enqueue_script('oi_flic', get_template_directory_uri().'/framework/js/jflickrfeed.min.js', false, null , true);
		wp_enqueue_script('oi_gmap', get_template_directory_uri().'/framework/js/gmap3.min.js', false, null , true);
		wp_enqueue_script('oi_owl', get_template_directory_uri().'/framework/js/owl.carousel.min.js', false, null , true);
		wp_enqueue_script('oi_tipso', get_template_directory_uri().'/framework/js/tipso.min.js', false, null , true);
		wp_enqueue_script('oi_remodal', get_template_directory_uri().'/framework/js/remodal.min.js', false, null , true);
		wp_enqueue_script('oi_custom', get_template_directory_uri().'/framework/js/custom.js', false, null , true);
		wp_enqueue_script('oi_vc_custom', get_template_directory_uri().'/framework/vc_extend/vc_custom.js', false, null , true);
		wp_enqueue_script('oi_woo', get_template_directory_uri().'/woocommerce/woo.js', false, null , true);
		
		$oi_theme = array( 
				'theme_url' => get_template_directory_uri(),
				'page_layout' => $oi_options['oi_web_page_layout']
			);
    	wp_localize_script( 'oi_custom', 'oi_theme', $oi_theme );
	}    
}

function custom_register_admin_scripts() {

wp_register_script( 'oi_custom-javascript', get_template_directory_uri().'/framework/js/admin-custom.js' );
wp_enqueue_script( 'oi_custom-javascript' );

} // end custom_register_admin_scripts
add_action( 'admin_enqueue_scripts', 'custom_register_admin_scripts' );


/*=======================================
	Includes
=======================================*/
include(get_template_directory().'/framework/functions/menus.php'); //Theme Menu
include(get_template_directory().'/framework/functions/sidebars.php'); //Sidebars
include(get_template_directory().'/framework/functions/thumbs.php'); //Thumbnails
include(get_template_directory().'/framework/functions/misc.php'); //Misc
include(get_template_directory().'/framework/functions/extrafields.php'); //ExtraFields
include(get_template_directory().'/framework/functions/breadcrumbs.php'); //Thumbnails
include(get_template_directory().'/framework/functions/woo.php'); //WooCommerce
include(get_template_directory().'/framework/functions/vc.php'); //Visual Composer

/*=======================================
	Widgets
=======================================*/
include(get_template_directory().'/framework/widgets/oi_about_widget.php');
include(get_template_directory().'/framework/widgets/oi_popular_posts.php');
include(get_template_directory().'/framework/widgets/oi_latest_posts.php');
include(get_template_directory().'/framework/widgets/oi_latest_posts_simple.php');
include(get_template_directory().'/framework/widgets/oi_recent_posts_comments.php');
include(get_template_directory().'/framework/widgets/oi_instagram_widget.php');
include(get_template_directory().'/framework/widgets/twitter/oi_twitter_widget.php');

/*=======================================
	TGM Plugins Activations
=======================================*/
require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {
	$plugins = array(

		 array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Slider Revolution', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		
		array(
			'name'     				=> 'OI Portfolio', // The plugin name
			'slug'     				=> 'oi-portfolio', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/oi-portfolio.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'OI Testimonials', // The plugin name
			'slug'     				=> 'oi-testimonials', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/oi-testimonials.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),


	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
};


/* ------------------------------------------------------------------------ */
/* Post Formats  */
/* ------------------------------------------------------------------------ */
add_theme_support( 'post-formats',      // post formats
	array(
		'image', 
		'video', 
		'audio',
		'gallery',
		'quote',
	)
);

?>
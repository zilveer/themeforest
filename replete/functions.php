<?php

global $avia_config;

/*
 * if you run a child theme and dont want to load the default functions.php file
 * set the global var bellow in you childthemes function.php to true:
 *
 * example: global $avia_config; $avia_config['use_child_theme_functions_only'] = true;
 * The default functions.php file will then no longer be loaded. You need to make sure than
 * of course to include framework and functions that you want to use by yourself.
 *
 * This is only recommended for advanced users
 */

 if(isset($avia_config['use_child_theme_functions_only'])) return;





/*
 * wpml multi site config file
 * needs to be loaded before the framework
 */

require_once( 'config-wpml/config.php' );




/*
 * These are the available color sets in your backend.
 * If more sets are added users will be able to create additional color schemes for certain areas
 *
 * The array key has to be the class name, the value is only used as tab heading on the styling page
 */

 $avia_config['color_sets'] = array('header_color' => 'Header', 'slideshow_color' => 'Big Slideshow Area', 'main_color' => 'Main Content', 'alternate_color' => 'Alternate Content',  'footer_color' => 'Footer', 'socket_color' => 'Socket');




/*add support for responsive mega menus*/
add_theme_support('avia_mega_menu');
add_filter('avia_mega_menu_walker', 'disable_default_mega_menu');
function disable_default_mega_menu(){ return false; } // deactivates the default mega menu and allows us to pass individual menu walkers when calling a menu


##################################################################
# AVIA FRAMEWORK by Kriesi

# this include calls a file that automatically includes all
# the files within the folder framework and therefore makes
# all functions and classes available for later use

require_once( 'framework/avia_framework.php' );

##################################################################


/*
 * Register additional image thumbnail sizes
 * Those thumbnails are generated on image upload!
 *
 * If the size of an array was changed after an image was uploaded you either need to re-upload the image
 * or use the thumbnail regeneration plugin: http://wordpress.org/extend/plugins/regenerate-thumbnails/
 */

$avia_config['imgSize']['widget'] 			 	= array('width'=>36,  'height'=>36);						// small preview pics eg sidebar news
$avia_config['imgSize']['slider_thumb'] 		= array('width'=>70,  'height'=>50);						// slideshow preview pics
$avia_config['imgSize']['fullsize'] 		 	= array('width'=>930, 'height'=>930, 'crop'=>false);		// big images for lightbox and portfolio single entries
$avia_config['imgSize']['featured'] 		 	= array('width'=>1500, 'height'=>430 );						// images for fullsize pages and fullsize slider
$avia_config['imgSize']['featured_small'] 		= array('width'=>990, 'height'=>280 );						// images for fullsize pages and fullsize slider
$avia_config['imgSize']['portfolio'] 		 	= array('width'=>495, 'height'=>400 );						// images for portfolio entries (2,3 column)
$avia_config['imgSize']['portfolio_small'] 		= array('width'=>241, 'height'=>179 );						// images for portfolio 4 columns
$avia_config['imgSize']['logo'] 		 		= array('width'=>446, 'height'=>218, 'copy'=>'greyscale');   // images for dynamic logo/partner element


//dynamic columns
$avia_config['imgSize']['dynamic_1'] 		 	= array('width'=>492, 'height'=>165);						// images for 2/4 (aka 1/2) dynamic portfolio columns when using 3 columns
$avia_config['imgSize']['dynamic_2'] 		 	= array('width'=>676, 'height'=>151);						// images for 2/3 dynamic portfolio columns
$avia_config['imgSize']['dynamic_3'] 		 	= array('width'=>765, 'height'=>107);						// images for 3/4 dynamic portfolio columns

avia_backend_add_thumbnail_size($avia_config);






/*
 * register the layout sizes: the written number represents the grid size, if the elemnt should not have a left margin add "alpha"
 *
 * Calculation of the with: the layout is based on a twelve column grid system, so content + sidebar must equal twelve.
 * example:  'content' => 'nine alpha',  'sidebar' => 'three'
 *
 * if the theme uses fancy blog layouts ( meta data beside the content for example) use the meta and entry values.
 * calculation of those: meta + entry = content
 *
 */

$avia_config['layout']['fullsize'] 		= array('content' => 'twelve alpha', 'sidebar' => 'hidden', 	 'meta' => 'two alpha', 'entry' => 'eleven');
$avia_config['layout']['sidebar_left'] 	= array('content' => 'nine', 		 'sidebar' => 'three alpha' ,'meta' => 'two alpha', 'entry' => 'seven');
$avia_config['layout']['sidebar_right'] = array('content' => 'nine alpha',   'sidebar' => 'three', 		 'meta' => 'two alpha', 'entry' => 'seven');



if ( ! isset( $content_width ) ) $content_width = 850;
add_theme_support( 'automatic-feed-links' );

##################################################################
# Frontend Stuff necessary for the theme:
##################################################################
/*
 * Register theme text domain
 */
if(!function_exists('avia_lang_setup'))
{
	add_action('after_setup_theme', 'avia_lang_setup');
	function avia_lang_setup()
	{
		$lang = get_template_directory()  . '/lang';
		load_theme_textdomain('avia_framework', $lang);
	}
}


/*
 * Register frontend javascripts:
 */
if(!function_exists('avia_frontend_js'))
{
	if(!is_admin()){
		add_action('wp_enqueue_scripts', 'avia_register_frontend_scripts');
	}

	function avia_register_frontend_scripts()
	{
		//register js
		wp_register_script( 'avia-default', AVIA_BASE_URL.'js/avia.js', array('jquery'), 4, false );
		wp_register_script( 'avia-prettyPhoto',  AVIA_BASE_URL.'js/prettyPhoto/js/jquery.prettyPhoto.js', 'jquery', "3.0.1", true);
		wp_register_script( 'aviapoly-slider',  AVIA_BASE_URL.'js/aviapoly2.js', 'jquery', "1.0.0", true);

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'avia-default' );
		wp_enqueue_script( 'avia-prettyPhoto' );
		wp_enqueue_script( 'aviapoly-slider' );

		if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }


		//register styles
		wp_register_style( 'avia-style', get_stylesheet_directory_uri()."/style.css", array(), '1', 'all' );
		wp_register_style( 'avia-grid' , get_template_directory_uri()."/css/grid.css", array(), '1', 'screen' );
		wp_register_style( 'avia-base' , get_template_directory_uri()."/css/base.css", array(), '1', 'screen' );
		wp_register_style( 'avia-layout',get_template_directory_uri()."/css/layout.css", array(), '1', 'screen' );
		wp_register_style( 'avia-scs',   get_template_directory_uri()."/css/shortcodes.css", array(), '1', 'screen' );
		wp_register_style( 'avia-slide', get_template_directory_uri()."/css/slideshow.css", array(), '1', 'screen' );
		wp_register_style( 'avia-pf',    get_template_directory_uri()."/js/prettyPhoto/css/prettyPhoto.css", array(), '1', 'screen' );
		wp_register_style( 'avia-custom',get_template_directory_uri()."/css/custom.css", array(), '1', 'screen' );

		//register styles

		wp_enqueue_style( 'avia-grid');
		wp_enqueue_style( 'avia-base');
		wp_enqueue_style( 'avia-layout');
		wp_enqueue_style( 'avia-scs');
		wp_enqueue_style( 'avia-slide');
		wp_enqueue_style( 'avia-pf');
		wp_enqueue_style( 'avia-style');

		global $avia;
        $safe_name = avia_backend_safe_string($avia->base_data['prefix']);
        if( get_option('avia_stylesheet_exists'.$safe_name) == 'true' )
        {
            $avia_upload_dir = wp_upload_dir();

            $avia_dyn_stylesheet_url = $avia_upload_dir['baseurl'] . '/dynamic_avia/'.$safe_name.'.css';
			$version_number = get_option('avia_stylesheet_dynamic_version'.$safe_name);
			if(empty($version_number)) $version_number = '1';

            wp_register_style( 'avia-dynamic', $avia_dyn_stylesheet_url, array(), $version_number, 'screen' );
            wp_enqueue_style( 'avia-dynamic');
        }

        wp_enqueue_style( 'avia-custom');
	}
}




/*
 * Activate native wordpress navigation menu and register a menu location
 */
if(!function_exists('avia_nav_menus'))
{
	function avia_nav_menus()
	{
		global $avia_config;

		add_theme_support('nav_menus');
		foreach($avia_config['nav_menus'] as $key => $value){ register_nav_menu($key, THEMENAME.' '.$value); }
	}

	$avia_config['nav_menus'] = array('avia' => 'Main Menu' , 'avia2' => 'Header Small Menu' , 'avia3' => 'Socket Menu (no drowpdowns)');
	avia_nav_menus(); //call the function immediatly to activate
}









/*
 *  load some frontend functions in folder include:
 */

require_once( 'includes/admin/register-portfolio.php' );		// register custom post types for portfolio entries
require_once( 'includes/admin/register-widget-area.php' );		// register sidebar widgets for the sidebar and footer

require_once( 'includes/admin/register-shortcodes.php' );		// register wordpress shortcodes
require_once( 'includes/loop-comments.php' );					// necessary to display the comments properly
require_once( 'includes/helper-slideshow.php' ); 				// holds the class that generates the 2d & 3d slideshows, as well as feature images
require_once( 'includes/helper-template-dynamic.php' ); 		// holds some helper functions necessary for dynamic templates
require_once( 'includes/helper-template-logic.php' ); 			// holds the template logic so the theme knows which tempaltes to use
require_once( 'includes/helper-social-media.php' ); 			// holds some helper functions necessary for twitter and facebook buttons
require_once( 'includes/helper-post-format.php' ); 				// holds actions and filter necessary for post formats
require_once( 'includes/admin/compat.php' );					// compatibility functions for 3rd party plugins
require_once( 'includes/admin/register-plugins.php');			// register the plugins we need
require_once( 'includes/helper-responsive-megamenu.php' ); 		// holds the walker for the responsive mega menu

//adds the plugin initalization scripts that add styles and functions
require_once( 'config-bbpress/config.php' );					//bbpress forum plugin
require_once( 'config-woocommerce/config.php' );				//woocommerce shop plugin



/*
 *  dynamic styles for front and backend
 */
if(!function_exists('avia_custom_styles'))
{
	function avia_custom_styles()
	{
		require_once( 'includes/admin/register-dynamic-styles.php' );	// register the styles for dynamic frontend styling
		avia_prepare_dynamic_styles();
	}

	add_action('init', 'avia_custom_styles', 20);
	add_action('admin_init', 'avia_custom_styles', 20);
}




/*
 *  activate framework widgets
 */
if(!function_exists('avia_register_avia_widgets'))
{
	function avia_register_avia_widgets()
	{
		register_widget( 'avia_newsbox' );
		register_widget( 'avia_portfoliobox' );
		register_widget( 'avia_socialcount' );
		register_widget( 'avia_combo_widget' );
		register_widget( 'avia_partner_widget' );
		register_widget( 'avia_google_maps' );
	}

	avia_register_avia_widgets(); //call the function immediatly to activate
}





/*
 *  add post format options
 */
add_theme_support( 'post-formats', array('link', 'quote', 'gallery','video','image' ) );



/*
 *  add shortcode editor functions
 *
 *  allowed positions: inline, small_box, content, widget
 */
add_theme_support( 'avia-shortcodes', array( 'content' => array('sidebar_tabs'=>'Sidebar Tabs', 'table'=>'Table'), 'small_box' => array('iconbox_top'=>'Icon Box (Icon on Top)', 'big_box'=>'Superbig Content Box') ) );


/*
 * compat mode for easier theme switching from one avia framework theme to another
 */
add_theme_support( 'avia_post_meta_compat');




/*
 *  register custom functions that are not related to the framework but necessary for the theme to run
 */

require_once( 'functions-replete.php');

// deactivate default theme seo if third party plugin is used. Currently supported plugins: Yoast WP SEO and All in One SEO
if(defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) $avia_config['deactivate_seo'] = true;

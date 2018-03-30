<?php
/**
 * Functions
 *
 * This is the main functions file that can add some additional functionality to the theme.
 * It calls an object from a manager class that inits all the needed functionality.
 */

global $allowedtags;

if ( !defined( 'PEXETO_SHORTNAME' ) )
	define( 'PEXETO_SHORTNAME', 'thestory' );

$pexeto_theme_data = wp_get_theme(PEXETO_SHORTNAME);
if(!$pexeto_theme_data->Version){
	$pexeto_theme_data = wp_get_theme();
}
global $pexeto;
$pexeto = new stdClass();
$pexeto->fullwidth_section_counter = 0;
$pexeto_scripts = array();

if(!isset($pexeto_content_sizes)){
	$pexeto_content_sizes = array(
		'content' => 864,
		'fullwidth' => 1170,
		'container' => 1500, //this is dynamic depending on the window screen, 
		//that's just an indicative value for the image cropping

		'column_spacing' => array(
			'blog' => 30,
			'gallery' => 15,
			'carousel' => 6,
			'quick_gallery' => 10,
			'services' => 33,
			'content_slider' => 33,
			'fullpage_slider'=>30
			),
		'header-height' => 400 //used for static header image
	);

	//calculate the slider width as 70% of the full width
	$pexeto_content_sizes['sliderside'] = 70*$pexeto_content_sizes['fullwidth']/100;
}

if ( ! isset( $content_width ) ) $content_width = $pexeto_content_sizes['fullwidth'];

if ( !defined( 'PEXETO_VERSION' ) )
	define( 'PEXETO_VERSION', $pexeto_theme_data->Version );

//main theme info constants
if ( !defined( 'PEXETO_THEMENAME' ) )
	define( 'PEXETO_THEMENAME', $pexeto_theme_data->Name );


if ( !defined( 'PEXETO_LIB_PATH' ) )
	define( 'PEXETO_LIB_PATH', get_template_directory() . '/lib/' );
if ( !defined( 'PEXETO_FUNCTIONS_PATH' ) )
	define( 'PEXETO_FUNCTIONS_PATH', get_template_directory() . '/functions/' );
if ( !defined( 'PEXETO_LIB_URL' ) )
	define( 'PEXETO_LIB_URL', get_template_directory_uri().'/lib/' );
if ( !defined( 'PEXETO_FUNCTIONS_URL' ) )
	define( 'PEXETO_FUNCTIONS_URL', get_template_directory_uri().'/functions/' );
if ( !defined( 'PEXETO_IMAGES_URL' ) )
	define( 'PEXETO_IMAGES_URL', PEXETO_LIB_URL.'images/' );
if ( !defined( 'PEXETO_FRONT_IMAGES_URL' ) )
	define( 'PEXETO_FRONT_IMAGES_URL', get_template_directory_uri().'/images/' );
if ( !defined( 'PEXETO_PATTERNS_URL' ) )
	define( 'PEXETO_PATTERNS_URL', PEXETO_IMAGES_URL.'pattern_samples/' );
if ( !defined( 'PEXETO_FRONT_SCRIPT_URL' ) )
	define( 'PEXETO_FRONT_SCRIPT_URL', get_template_directory_uri().'/js/' );
if ( !defined( 'PEXETO_OPTIONS_PAGE' ) )
	define( 'PEXETO_OPTIONS_PAGE', 'pexeto_options' );
if ( !defined( 'PEXETO_CP_THUMB_RESIZE' ) )
	define( 'PEXETO_CP_THUMB_RESIZE', true ); //resize thumbnails in the custom pages in admin
// set this option to false if your server can't allocate enough memory to crop all of the thumbnails on the page

if(!function_exists('pexeto_is_woocommerce_activated')){
	/**
	 * Checks whether WooCommerce is activated
	 */
	function pexeto_is_woocommerce_activated(){

		$activated = in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
		if(is_multisite() && !$activated){
			$active_plugins = get_site_option('active_sitewide_plugins') ;
			if(!empty($active_plugins) && isset($active_plugins['woocommerce/woocommerce.php'])){
				$activated = true;
			}
		}
		return $activated;
	}
}

if ( pexeto_is_woocommerce_activated() ) {
	define( 'PEXETO_WOOCOMMERCE_ACTIVE', true);
}else{
	define( 'PEXETO_WOOCOMMERCE_ACTIVE', false);
}

require PEXETO_LIB_PATH.'init.php';  //init file of the Pexeto library
require PEXETO_FUNCTIONS_PATH.'init.php';  //init file of the theme functions




/* ENQUEUE THE SCRIPTS AND STYLES: */

add_action( 'wp_enqueue_scripts', 'pexeto_register_scripts' );
add_action( 'wp_enqueue_scripts', 'pexeto_enqueue_styles' );
add_action( 'wp_footer', 'pexeto_dequeue_nonrequired_scripts' );


if ( !function_exists( 'pexeto_register_scripts' ) ) {
	/**
	 * Registers all the main scripts for the theme and calls a function
	 * to enqueue them after this.
	 */
	function pexeto_register_scripts() {
		$ver = PEXETO_VERSION;


		$jsuri=get_template_directory_uri().'/js/';

		$in_footer = true;

		wp_register_script( 'pexeto-youtube-api', 'https://www.youtube.com/iframe_api', array(), $ver, $in_footer);
		wp_register_script( 'pexeto-main', $jsuri.'main.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-portfolio-gallery', $jsuri.'portfolio-gallery.js', array( 'jquery', 'pexeto-main' ), $ver, $in_footer );
		wp_register_script( 'pexeto-masonry', $jsuri.'masonry.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-nivo', $jsuri.'nivo-slider.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-contentslider', $jsuri.'content-slider.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-thumbslider', $jsuri.'thumbnail-slider.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-fullpage', $jsuri.'fullpage.js', array( 'jquery', 'pexeto-main' ), $ver, $in_footer );

		pexeto_enqueue_scripts();

	}
}


if ( !function_exists( 'pexeto_enqueue_scripts' ) ) {
	/**
	 * Enqueues all the scripts needed for the theme depending on the current
	 * page/post type and settings.
	 */
	function pexeto_enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'pexeto-nivo' );
		wp_enqueue_script( 'pexeto-masonry' );
		wp_enqueue_script( 'pexeto-main' );
		wp_enqueue_script( 'pexeto-youtube-api' );
		wp_enqueue_script( 'pexeto-contentslider' );


		if ( is_page_template( 'template-portfolio-gallery.php' )
			|| ( is_single() && get_post_type() == PEXETO_PORTFOLIO_POST_TYPE ) ) {
			//load the scripts for the portfolio gallery template
			wp_enqueue_script( 'pexeto-portfolio-gallery' );
		}

		if (is_page_template('template-fullscreen-slider.php' )){
			wp_enqueue_script('pexeto-fullpage' );
		}

		//GET THE SLIDER DATA
		$slider_type = pexeto_get_slider_type();

		//nivo slider script
		if ( $slider_type == PEXETO_NIVOSLIDER_POSTTYPE ) {
			wp_enqueue_script( 'pexeto-nivo' );
		}

		//include the comment reply script
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}


	}
}


if(!function_exists('pexeto_dequeue_nonrequired_scripts')){

	/**
	 * Loads the additional scripts that are needed by some of the content in
	 * the current page.
	 */
	function pexeto_dequeue_nonrequired_scripts(){
		global $pexeto_scripts;

		if (!isset( $pexeto_scripts['nivo'] )){
			//dequeue the nivo slider script
			wp_dequeue_script('pexeto-nivo');
		}

		if (!isset( $pexeto_scripts['contentslider'] )){
			//dequeue the content slider script
			wp_dequeue_script('pexeto-contentslider');
			wp_dequeue_script('pexeto-youtube-api');
		}

		$load_masonry = false;
		if ( isset( $pexeto_scripts['masonry'] ) 
			|| isset( $pexeto_scripts['blog_masonry'] )
			|| ( is_page_template( 'template-portfolio-gallery.php' ) ) 
			|| ( get_post_type() == PEXETO_PORTFOLIO_POST_TYPE && pexeto_option( 'qg_masonry_'.PEXETO_PORTFOLIO_POST_TYPE) === true ) ) {
			//load the masonry script
			$load_masonry = true;
		}

		if(!$load_masonry){
			wp_dequeue_script( 'pexeto-masonry' );
		}
	}
}




if ( !function_exists( 'pexeto_enqueue_styles' ) ) {
	/**
	 * Enqueues the CSS styles for the theme.
	 */
	function pexeto_enqueue_styles() {
		$ver = PEXETO_VERSION;

		if ( pexeto_option( 'enable_google_fonts' ) ) {

			//INCLUDE THE GOOGLE FONTS
			$fonts=pexeto_option( 'google_fonts' );
			for ( $i=0; $i<sizeof( $fonts ); $i++ ) {
				wp_enqueue_style( 'pexeto-font-'.$i,  $fonts[$i]['link'] );
			}
		}


		//INCLUDE THE CSS FILES
		$cssuri = get_template_directory_uri().'/css/';
		
		if (is_page_template('template-fullscreen-slider.php' )){
			wp_enqueue_style('pexeto-fullpage-css',  $cssuri.'fullpage.css', array(), $ver);
		}

		wp_enqueue_style( 'pexeto-pretty-photo', $cssuri.'prettyPhoto.css', array(), $ver );

		if(PEXETO_WOOCOMMERCE_ACTIVE){
			wp_enqueue_style('pexeto-woocommerce', $cssuri.'woocommerce.css', array(), $ver );
		}

		wp_enqueue_style( 'pexeto-stylesheet', get_stylesheet_uri(), array(), $ver );

		wp_register_style( 'pexeto-ie8', $cssuri.'style_ie8.css', array(), $ver );
		$GLOBALS['wp_styles']->add_data( 'pexeto-ie8', 'conditional', 'lte IE 8' );
		wp_enqueue_style( 'pexeto-ie8' );

		pexeto_print_options_styles();
	}
}



?>
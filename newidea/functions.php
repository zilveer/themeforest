<?php
/**
 * All newidea common functions.
 * Don't remove it.
 *
 * @since newidea 4.0
 */
require_once("inc/newidea-functions.php");
include("inc/penguin-config.php");

global $newidea_options;
$newidea_options = get_option("newidea_options");

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) ){
	$content_width = 680;
}
	
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses init options managa.
 *
 * @since newidea 4.0
 */
function newidea_setup() {
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Load the Themes' Translations throught domain
	load_theme_textdomain( 'newidea', get_template_directory() . '/languages' );
    
 	// Registers main/footer menus
	register_nav_menus(array(
			'newidea_primary' => esc_html__('New Idea Menu' , 'newidea' )
			));
	
	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( 200, 140 , true );
	//portfolio image
	add_image_size('portfolio-thumbnails' , 210 , 150 , true);
	add_image_size('portfolio-cats-thumbnails' , 200 , 260 , true);
	//services image
	add_image_size('services-thumbnails', 260 , 110 , true);
	//about image
	add_image_size('about-thumbnails', 225 , 160 , true);
}
add_action( 'after_setup_theme', 'newidea_setup' );


/**
 * Sets up theme defaults styles and scripts.
 *
 * @since newidea 1.0
 */
function newidea_init_styles_scripts() {	
	global $google_load_fonts;
	
	$dir = get_template_directory_uri();
	$theme_data = wp_get_theme();
	$ver = $theme_data['Version'];
	//Stylesheets
	wp_enqueue_style( 'reset', $dir . '/style/reset.css');
	wp_enqueue_style( 'text', $dir . '/style/text.css');
	wp_enqueue_style( 'fancybox', $dir . '/js/fancybox/jquery.fancybox.css',array(),$ver);
	wp_enqueue_style( 'fancybox-button', $dir . '/js/fancybox/helpers/jquery.fancybox-buttons.css',array(),$ver);
	wp_enqueue_style( 'jcarousel', $dir . '/js/newidea-jcarousel/newidea-jcarousel.css',array(),$ver);
	wp_enqueue_style( 'jscrollpane', $dir . '/style/jquery.jscrollpane.css',array(),$ver);
	wp_enqueue_style( 'vegasbackground', $dir . '/js/vegas/jquery.vegas.css',array(),$ver);
	wp_enqueue_style( 'newidea', $dir . '/style.css',array(),$ver);
	//Custom
	$newidea_options_update = get_option('newidea_options_update');
	if(isset($newidea_options_update['version']) ){
		$uploads = wp_upload_dir();
		if (file_exists($uploads['basedir'] . '/newidea/newidea-styles.css')) {
			$custom_css = $uploads['baseurl'] . '/newidea/newidea-styles.css';
			wp_enqueue_style( 'newidea_style', $custom_css  , array() , $newidea_options_update['version'] );
		}
	}
	wp_enqueue_style( 'responsive', $dir . '/style/responsive.css',array(),$ver);
	
	newidea_get_custom_font();
	if($google_load_fonts != null && $google_load_fonts != ""){
		wp_enqueue_style( 'custom-font', 'http://fonts.googleapis.com/css?family='.$google_load_fonts);
	}
	
	//Javascripts
	wp_enqueue_script( 'jquery');
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	wp_enqueue_script( 'jquery-effect', $dir . '/js/jquery.effects.core.js');
	wp_enqueue_script( 'queryloader2', $dir . '/js/queryloader2.min.js',array(),$ver);
    wp_enqueue_script( 'fancybox', $dir . '/js/fancybox/jquery.fancybox.pack.js',array(),$ver);
	wp_enqueue_script( 'fancybox-media', $dir . '/js/fancybox/helpers/jquery.fancybox-media.js',array(),$ver);
	wp_enqueue_script( 'fancybox-button', $dir . '/js/fancybox/helpers/jquery.fancybox-buttons.js',array(),$ver);
    wp_enqueue_script( 'jcarousel', $dir . '/js/newidea-jcarousel/newidea-jcarousel.js',array(),$ver);
    wp_enqueue_script( 'mousewheel', $dir . '/js/jquery.mousewheel.min.js',array(),$ver);
	wp_enqueue_script( 'slidelite', $dir . '/js/jquery.atf.slidelite.js',array(),$ver);
    wp_enqueue_script( 'jscrollpane', $dir . '/js/jquery.jscrollpane.min.js',array(),$ver);
   	wp_enqueue_script( 'vegasbackground', $dir . '/js/vegas/jquery.vegas.js',array(),$ver);
    wp_enqueue_script( 'newidea', $dir . '/js/jquery.theme.js',array(),$ver);
}
add_action('wp_enqueue_scripts', 'newidea_init_styles_scripts');

/**
 * Sets up custom title
 *
 * @since newidea 4.0
 */
function newidea_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ){return $title;	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ){
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ){
		$title = "$title $sep " . sprintf( __( 'Page %s', 'newidea' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'newidea_wp_title', 10, 2 );

/**
 * Sets up custom theme styles
 *
 * @since newidea 1.0
 */
function newidea_custom_styles(){
	if(newidea_get_options_key('custom-css-content') != ""){
	?>
	<style id="newidea-custom-css" type="text/css">
		<?php echo newidea_get_options_key('custom-css-content'); ?>
	</style>
	<?php 
	}
	if(newidea_get_options_key('custom-mobile-css-content') != ""){
	?>
	<style id="newidea-custom-mobile-css" type="text/css">
		/* Landscape phones and down */
		@media (max-width: 767px) {
			<?php echo newidea_get_options_key('custom-mobile-css-content'); ?>
		}
	</style>
	<?php 
	}
	// get gogole analytics
	echo intval(newidea_get_options_key('google_analytics-position')) == 0 ? newidea_get_options_key('google_analytics-content') : "";
}
add_action( 'wp_head', 'newidea_custom_styles' );

/**
 * Sets up footer custom theme styles
 *
 * @since newidea 4.0
 */
function newidea_wp_footer_scripts(){
	if(newidea_get_options_key('custom-scripts-content') != ""){
?>
	<script type="text/javascript">
    <?php 
		echo newidea_get_options_key('custom-scripts-content'); 
	?>
    </script>
<?php 
	}

	echo intval(newidea_get_options_key('google_analytics-position')) == 1 ? newidea_get_options_key('google_analytics-content') : "";
}
add_action( 'wp_footer', 'newidea_wp_footer_scripts' );
 
/**
 * Use shortcodes
 *
 * newidea v1.0.5 added
 */
include("inc/shortcodes.php");

/**
 * Redesign login page
 *
 */
function newidea_login_logo() { 
?>
    <style type="text/css">
        body.login div#login h1 a {
			background: url(<?php echo newidea_get_options_key('logo-image') == "" ?  get_template_directory_uri()."/images/logo.png" : newidea_get_options_key('logo-image'); ?>) no-repeat top center;
			width:<?php echo newidea_get_options_key('logo-image-width'); ?>px;
			height:<?php echo newidea_get_options_key('logo-image-height'); ?>px;
        }
		<?php 
		//here you can delete it,just for white logo of default
		if(newidea_get_options_key('logo-image') == "") : 
		?>
			.login { background:#e6e6e6 !important; }
		<?php endif;?>
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'newidea_login_logo' );

function newidea_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'newidea_login_logo_url' );

function newidea_login_logo_url_title() {
    return get_bloginfo('title');
}
add_filter( 'login_headertitle', 'newidea_login_logo_url_title' );
?>
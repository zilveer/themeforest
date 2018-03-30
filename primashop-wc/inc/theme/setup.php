<?php
/**
 * Setup theme specific functions
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Setup
 * @subpackage Init
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since PrimaShop 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 600;

/**
 * Add PrimaShop's features using standard add_theme_support method.
 *
 * @since PrimaShop 1.0
 */
add_action( 'after_setup_theme', 'primashop_add_theme_support', 5 );
function primashop_add_theme_support() {
	/* this theme supports localization */
	load_theme_textdomain( 'primathemes', PRIMA_DIR . '/languages' );
	/* this theme supports automatic RSS feed links on the header */
	add_theme_support( 'automatic-feed-links' );
	/* this theme supports menus management */
	add_theme_support( 'menus' );
	/* this theme supports widgets management */
	add_theme_support( 'widgets' );
	/* this theme supports title tag */
	add_theme_support( 'title-tag' );

	/* this theme supports editor style for better user experience */
	// add_theme_support( 'editor-style' ); add_editor_style();

	/* this theme supports featured image */
	add_theme_support( 'post-thumbnails' );

	/* this theme supports layout settings for POST type */
	add_post_type_support( 'post', 'prima-layout-settings' );
	/* this theme supports layout settings for PAGE type */
	add_post_type_support( 'page', 'prima-layout-settings' );
	/* this theme supports layout settings for PRODUCT type */
	add_post_type_support( 'product', 'prima-layout-settings' );

	/* this theme supports design settings using WordPress customizer */
	add_theme_support( 'prima-design-settings' );

	/* this theme supports sidebar settings to provide custom sidebar area feature */
	add_theme_support( 'prima-sidebar-settings' );
		
}

/**
 * Register PrimaShop's navigation menu.
 *
 * @since PrimaShop 1.0
 */
add_action( 'init', 'primashop_register_nav_menu', 5 );
function primashop_register_nav_menu() {
	register_nav_menu( 'header-menu', __( 'Header Menu', 'primathemes' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'primathemes' ) );
}

/**
 * Register PrimaShop's content layout.
 *
 * @since PrimaShop 1.0
 */
add_action( 'init', 'primashop_register_layout', 5 );
function primashop_register_layout() {
	global $prima_default_layout;
	$prima_default_layout = array(
			'id' => 'content-sidebar', 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-default.png'
		);
    prima_register_layout(
		array(
			'id' => 'content-sidebar', 
			'label' => __("Content - Sidebar", 'primathemes'), 'description' => '', 
			'sidebar' => true, 
			'sidebarmini' => false, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/content-sidebar.png'
		));
    prima_register_layout(
		array(
			'id' => 'sidebar-content', 
			'label' => __("Sidebar - Content", 'primathemes'), 'description' => '', 
			'sidebar' => true, 
			'sidebarmini' => false, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/sidebar-content.png'
		));
    prima_register_layout(
		array(
			'id' => 'sidebarmini-content-sidebar', 
			'label' => __("Sidebar Mini - Content - Sidebar", 'primathemes'), 'description' => '', 
			'sidebar' => true, 
			'sidebarmini' => true, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/sidebarmini-content-sidebar.png'
		));
    prima_register_layout(
		array(
			'id' => 'sidebar-content-sidebarmini', 
			'label' => __("Sidebar - Content - Sidebar Mini", 'primathemes'), 'description' => '', 
			'sidebar' => true, 
			'sidebarmini' => true, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/sidebar-content-sidebarmini.png'
		));
    prima_register_layout(
		array(
			'id' => 'content-sidebar-sidebarmini', 
			'label' => __("Content - Sidebar - Sidebar Mini", 'primathemes'), 'description' => '', 
			'sidebar' => true, 
			'sidebarmini' => true, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/content-sidebar-sidebarmini.png'
		));
    prima_register_layout(
		array(
			'id' => 'sidebarmini-sidebar-content', 
			'label' => __("Sidebar Mini - Sidebar - Content", 'primathemes'), 'description' => '', 
			'sidebar' => true, 
			'sidebarmini' => true, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/sidebarmini-sidebar-content.png'
		));
    prima_register_layout(
		array(
			'id' => 'content-sidebarmini', 
			'label' => __("Content - Sidebar Mini", 'primathemes'), 'description' => '', 
			'sidebar' => false, 
			'sidebarmini' => true, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/content-sidebarmini.png'
		));
    prima_register_layout(
		array(
			'id' => 'sidebarmini-content', 
			'label' => __("Sidebar Mini - Content", 'primathemes'), 'description' => '', 
			'sidebar' => false, 
			'sidebarmini' => true, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/sidebarmini-content.png'
		));
    prima_register_layout(
		array(
			'id' => 'full-width-content', 
			'label' => __("Full Width Content", 'primathemes'), 'description' => '', 
			'sidebar' => false, 
			'sidebarmini' => false, 
			'image' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/full-width-content.png'
		));
}

/**
 * Register PrimaShop's sidebar area
 *
 * @since PrimaShop 1.0
 */
add_action( 'init', 'primashop_register_sidebar_area', 5 );
function primashop_register_sidebar_area() {
	prima_register_sidebar_area( array(
		'id' => 'sidebar',
		'label' => __( 'Main Sidebar Area', 'primathemes' )
	));
	prima_register_sidebar_area( array(
		'id' => 'sidebarmini',
		'label' => __( 'Mini Sidebar Area', 'primathemes' )
	));
}

/**
 * Register PrimaShop's sidebar
 *
 * @since PrimaShop 1.0
 */
add_action( 'init', 'primashop_register_sidebar', 5 );
function primashop_register_sidebar() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'primathemes' ),
		'id' => 'sidebar',
		'description' => __( 'Main sidebar area', 'primathemes' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container widget-sidebar %2$s group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar( array(
		'name' => __( 'Mini Sidebar', 'primathemes' ),
		'id' => 'sidebarmini',
		'description' => __( 'Mini sidebar area', 'primathemes' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container widget-sidebar %2$s group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	if( (int)prima_get_setting('footer_widgets') >= 10 ) :
		register_sidebar(array(
			'name' => __('Footer Widget #1', 'primathemes'),
			'id' => 'footer-widget-1', 
			'description' => __( 'First footer widget area', 'primathemes' ),
			'before_widget' => '<div id="%1$s" class="widget widget-container %2$s group">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));
	endif;
	if( (int)prima_get_setting('footer_widgets') >= 20 ) :
		register_sidebar(array(
			'name' => __('Footer Widget #2', 'primathemes'),
			'id' => 'footer-widget-2', 
			'description' => __( 'Second footer widget area', 'primathemes' ),
			'before_widget' => '<div id="%1$s" class="widget widget-container %2$s group">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));
	endif;
	if( (int)prima_get_setting('footer_widgets') >= 30 ) :
		register_sidebar(array(
			'name' => __('Footer Widget #3', 'primathemes'),
			'id' => 'footer-widget-3', 
			'description' => __( 'Third footer widget area', 'primathemes' ),
			'before_widget' => '<div id="%1$s" class="widget widget-container %2$s group">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));
	endif;
	if( (int)prima_get_setting('footer_widgets') >= 40 ) :
		register_sidebar(array(
			'name' => __('Footer Widget #4', 'primathemes'),
			'id' => 'footer-widget-4', 
			'description' => __( 'Fourth footer widget area', 'primathemes' ),
			'before_widget' => '<div id="%1$s" class="widget widget-container %2$s group">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));
	endif;
}

/**
 * Add PrimaShop's custom background feature
 *
 * @since PrimaShop 1.0
 */
add_theme_support( 'custom-background', array( 'wp-head-callback' => 'prima_custom_background_cb' ) );

/**
 * Add PrimaShop's custom header feature
 *
 * @since PrimaShop 1.0
 */
add_theme_support( 'custom-header', array(
	'header-text'     		 => '',
	'header-color'     		 => '',
	'default-image'          => false,

	'height'                 => 400,
	'width'                  => 960,

	'flex-height'            => true,
	'flex-width'             => true,

	'random-default'         => false,

	'wp-head-callback'       => false,
	'admin-head-callback'    => 'prima_admin_header_style',
	'admin-preview-callback' => 'prima_admin_header_image',
) );

/**
 * Helper function for stylesheet on custom header admin page
 *
 * @since PrimaShop 1.0
 */
function prima_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		background: #2BA6CB;
		text-align: center;
		padding: 30px;
	}
	.appearance_page_custom-header #headimg img {
		width: auto;
	}
	<?php if ( prima_get_setting ( "header_featured_nopadding" ) == 'true' ) : ?>
	.appearance_page_custom-header #headimg {
		padding: 0;
	}
	<?php endif; ?>
	<?php if ( prima_get_setting ( "header_featured_fullscreen" ) == 'true' ) : ?>
	.appearance_page_custom-header #headimg img {
		width: 100%;
	}
	<?php endif; ?>
	</style>
<?php
}

/**
 * Helper function for html output on custom header admin page
 *
 * @since PrimaShop 1.0
 */
function prima_admin_header_image() {
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) :
		echo '<div id="headimg">';
		echo '<img src="'.esc_url( $header_image ).'" class="header-image" width="'.get_custom_header()->width.'" alt="" />';
		echo '</div>';
	endif;
}

/**
 * Set favicon on frontend, admin, login, and customizer page.
 *
 * @since PrimaShop 1.0
 */
add_action( 'wp_head', 'prima_branding_favicon');
add_action( 'admin_head', 'prima_branding_favicon');
add_action( 'login_head', 'prima_branding_favicon' );
add_action( 'customize_controls_print_scripts', 'prima_branding_favicon' );
function prima_branding_favicon() {
	$icon = prima_get_setting( 'favicon_url' );
	if ( !$icon ) return;
	echo '<link rel="shortcut icon" type="image/x-icon" href="'.$icon.'" />' . "\n";
}

/**
 * Set login logo on login page.
 *
 * @since PrimaShop 1.0
 */
add_action( 'login_head', 'prima_branding_loginlogo' );
function prima_branding_loginlogo() {
	$icon = prima_get_setting( "loginlogo_url" );
	if ( !$icon ) return;
	$width = prima_get_setting( "loginlogo_width" );
	if ( !$width ) $width = 320;
	$height = prima_get_setting( "loginlogo_height" );
	if ( !$height ) $height = 80;
	echo '
	<style type="text/css">
	#login h1 a { background-image: url('.$icon.') !important; -webkit-background-size:'.$width.'px '.$height.'px; background-size:'.$width.'px '.$height.'px; width:'.$width.'px; height:'.$height.'px; }
	</style>
	';
}

/**
 * Set admin logo on admin (dashboard) page.
 *
 * @since PrimaShop 1.0
 */
add_action( 'admin_head', 'prima_branding_adminlogo' );
function prima_branding_adminlogo() {
	$icon = prima_get_setting( "adminlogo_url" );
	if ( !$icon ) return;
	echo '
	<style type="text/css">
	#wp-admin-bar-wp-logo > .ab-item .ab-icon, #wpadminbar > #wp-toolbar > #wp-admin-bar-root-default #wp-admin-bar-wp-logo .ab-icon { background: url('.$icon.') no-repeat center center !important; background-size: 20px 20px !important; }
	#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before { content: ""; }
	</style>
	';
}

/**
 * Set admin footer text on admin (dashboard) page.
 *
 * @since PrimaShop 1.0
 */
add_filter('admin_footer_text', 'prima_branding_adminfooter');
function prima_branding_adminfooter() {
	echo do_shortcode( prima_get_setting( 'adminfooter' ) );
}


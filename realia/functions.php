<?php

/**
 * Constants
 */
define( 'PROPERTY_EXCERPT_LENGTH', 17 );
define( 'AGENCY_EXCERPT_LENGTH', 17 );

/**
 * Widgets
 */
require_once 'widgets/features.php';
require_once 'widgets/features-circles.php';
require_once 'widgets/features-simple.php';
require_once 'widgets/call-to-action.php';

/**
 * Libraries
 */
require_once 'libraries/class-tgm-plugin-activation.php';

/**
 * Custom excerpt length
 *
 * @param $length
 * @return int
 */
function realia_excerpt_length( $length ) {
	global $post;

	if ( $post->post_type == 'property' ) {
		return PROPERTY_EXCERPT_LENGTH;
	} elseif ( $post->post_type == 'agency' ) {
		return AGENCY_EXCERPT_LENGTH;
	}

	return $length;
}
add_filter('excerpt_length', 'realia_excerpt_length' );

/**
 * Registers custom widgets
 *
 * @return void
 */
function aviators_widgets_init() {
	register_widget( 'Aviators_Widget_Features' );
	register_widget( 'Aviators_Widget_Features_Circles' );
	register_widget( 'Aviators_Widget_Features_Simple' );
	register_widget( 'Aviators_Widget_Call_To_Action' );
}
add_action( 'widgets_init', 'aviators_widgets_init' );

/**
 * Enqueue scripts & styles
 *
 * @return void
 */
function realia_enqueue_files() {
	wp_enqueue_style( 'open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700&amp;subset=latin,latin-ext' );
	wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/assets/libraries/colorbox/example1/colorbox.css' );
	wp_enqueue_style( 'pictopro', get_template_directory_uri() . '/assets/libraries/fonts/PictoPro/style.css' );
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/assets/libraries/owl.carousel/assets/owl.carousel.css' );
	wp_enqueue_style( 'realia-css', get_template_directory_uri() . '/assets/css/realia.css', array(), '20160623' );
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );

	wp_enqueue_script( 'bootstrap-collapse', get_template_directory_uri() . '/assets/libraries/bootstrap/javascripts/bootstrap/collapse.js' );
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/libraries/owl.carousel/owl.carousel.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'realia-js', get_template_directory_uri() . '/assets/js/realia.js', array(), '20160530' );
	wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/assets/libraries/colorbox/jquery.colorbox-min.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'realia_enqueue_files' );

/**
 * Additional after theme setup functions
 *
 * @return void
 */
function realia_after_theme_setup() {
	load_theme_textdomain( 'realia', get_template_directory() . '/languages' );

	add_theme_support( 'realia-custom-styles' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header', array() );
	add_theme_support( 'custom-background' );
	add_theme_support( 'menus' );
	add_theme_support( 'title-tag' );

	add_image_size( 'property-slider-thumbnail', 70, 55, true );
	add_image_size( 'agent-detail-thumbnail', 300, 300, true );

	if ( ! isset( $content_width ) ) {
		$content_width = 1170;
	}
}
add_action( 'after_setup_theme', 'realia_after_theme_setup' );

function realia_custom_image_sizes() {
	add_image_size( 'property-box-thumbnail', 270, 226, true );
}
add_action( 'init', 'realia_custom_image_sizes' );

/**
 * Register menus
 *
 * @return void
 */
function realia_menus() {
	register_nav_menu( 'primary', __( 'Primary', 'realia' ) );
	register_nav_menu( 'topbar-anonymous', __( 'Topbar Anonymous', 'realia' ) );
	register_nav_menu( 'topbar-authenticated', __( 'Topbar Authenticated', 'realia' ) );
}
add_action( 'init', 'realia_menus' );

/**
 * Custom widget areas
 *
 * @return void
 */
function realia_sidebars() {
	register_sidebar( array( 'name' => __( 'Primary', 'realia' ), 'id' => 'sidebar-1', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Top Fullwidth', 'realia' ), 'id' => 'sidebar-top-fullwidth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Top', 'realia' ), 'id' => 'sidebar-top', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Content Top', 'realia' ), 'id' => 'sidebar-content-top', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Content Bottom', 'realia' ), 'id' => 'sidebar-content-bottom', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Bottom', 'realia' ), 'id' => 'sidebar-bottom', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer First', 'realia' ), 'id' => 'footer-first', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Second', 'realia' ), 'id' => 'footer-second', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Third', 'realia' ), 'id' => 'footer-third', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Fourth', 'realia' ), 'id' => 'footer-fourth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Bottom Left', 'realia' ), 'id' => 'footer-bottom-left', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Bottom Right', 'realia' ), 'id' => 'footer-bottom-right', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
}
add_action( 'widgets_init', 'realia_sidebars' );

/**
 * Disable admin's bar top margin
 *
 * @return void
 */
function realia_disable_admin_bar_top_margin() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'realia_disable_admin_bar_top_margin' );

/**
 * Read more for post excerpt
 *
 * @param $more
 * @return void|string
 */
function realia_excerpt_read_more( $more ) {
	global $post;

	if ( $post->post_type == 'property' || $post->post_type == 'agency' ) {
		return null;
	}

	return '<a class="post-read-more" href="'. get_permalink( $post->ID ) . '">' . __( 'Read more', 'realia' ) . '</a>';
}
add_filter( 'excerpt_more', 'realia_excerpt_read_more' );

/**
 * Registers sessions
 *
 * @return void
 */
function realia_register_session(){
	if( ! session_id() ) {
		session_start();
	}
}
add_action( 'init', 'realia_register_session' );


function realia_title( $title, $sep ) {
	return strip_tags(html_entity_decode( $title ) );
}

add_action( 'wp_title', 'realia_title', 10, 2 );

/**
 * Customizations
 *
 * @param $wp_customize
 * @return void
 */
function realia_customizations( $wp_customize ) {
	$wp_customize->add_section( 'realia_header', array( 'title' => __( 'Realia Header', 'realia' ), 'priority' => 0 ) );

	// Logo
	$wp_customize->add_setting( 'realia_header_logo', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'realia_header_logo', array(
		'label'         => __( 'Logo', 'realia' ),
		'section'       => 'realia_header',
		'settings'      => 'realia_header_logo',
		'description'   => __( 'Logo displayed in header. By default it has some opacity added by CSS which will change after hover.', 'realia' ),
	) ) );

	// Action Text
	$wp_customize->add_setting( 'realia_header_action_text', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'realia_header_action_text', array(
		'label'     => __( 'Action Text', 'realia' ),
		'section'   => 'realia_header',
		'settings'  => 'realia_header_action_text',
	) );

	// Action Link
	$wp_customize->add_setting( 'realia_header_action_link', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'realia_header_action_link', array(
		'label'     => __( 'Action Link', 'realia' ),
		'section'   => 'realia_header',
		'settings'  => 'realia_header_action_link',
	) );

	// 1. Information Box
	$wp_customize->add_setting( 'realia_header_1_information_box_text', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'realia_header_1_information_box_text', array(
		'label'     => __( '1. Information Box Title ', 'realia' ),
		'section'   => 'realia_header',
		'settings'  => 'realia_header_1_information_box_text',
	) );

	// 1. Information Icon
	$wp_customize->add_setting( 'realia_header_1_information_box_icon', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'realia_header_1_information_box_icon', array(
		'label'     => __( '1. Information Box Icon', 'realia' ),
		'section'   => 'realia_header',
		'settings'  => 'realia_header_1_information_box_icon',
	) );

	// 2. Information Box
	$wp_customize->add_setting( 'realia_header_2_information_box_text', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'realia_header_2_information_box_text', array(
		'label'     => __( '2. Information Box Title ', 'realia' ),
		'section'   => 'realia_header',
		'settings'  => 'realia_header_2_information_box_text',
	) );

	// 2. Information Icon
	$wp_customize->add_setting( 'realia_header_2_information_box_icon', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'realia_header_2_information_box_icon', array(
		'label'     => __( '2. Information Box Icon', 'realia' ),
		'section'   => 'realia_header',
		'settings'  => 'realia_header_2_information_box_icon',
	) );
}
add_action( 'customize_register', 'realia_customizations' );

/**
 * Register plugins
 *
 * @return void
 */
function realia_register_required_plugins() {
	$plugins = array(
		array(
			'name'      			=> 'CMB2',
			'slug'      			=> 'cmb2',
			'is_automatic'          => true,
			'required'  			=> false,
		),
		array(
			'name'      			=> 'WP REST API (WP API)',
			'slug'      			=> 'json-rest-api',
			'required'  			=> false,
		),
		array(
			'name'                  => 'Contact Form 7',
			'slug'                  => 'contact-form-7',
			'required'              => false,
			'is_automatic'          => true,
		),
		array(
			'name'                  => 'One Click',
			'slug'                  => 'one-click',
			'source'                => realia_get_plugin_package( 'one-click' ),
			'required'              => false,
			'force_deactivation'    => true,
			'is_automatic'          => true,
			'version'               => '0.6.1',
		),
	);

	$realia_plugins = array(
		'realia'					=> array( 'Realia', '0.9.3' ),
		'realia-partners'			=> array( 'Realia Partners', '0.2.0' ),
		'realia-paypal'				=> array( 'Realia PayPal', '0.3.1' ),
		'realia-property-carousel'	=> array( 'Realia Property Carousel', '0.2.1' ),
		'realia-property-slider'	=> array( 'Realia Property Slider', '0.2.1' ),
	);

	foreach ( $realia_plugins as $slug => $info ) {
		$name = $info[0];
		$version = $info[1];

		$realia_plugin = array(
			'name'                  => $name,
			'slug'                  => $slug,
			'required'              => $slug == 'realia',
			'force_activation'    	=> $slug == 'realia',
			'force_deactivation'    => false,
			'is_automatic'          => true,
			'version'               => $version,
		);

		if ( 'realia' != $slug ) {
			$realia_plugin['source'] = realia_get_plugin_package( $slug );
		}

		array_push( $plugins, $realia_plugin );
	}

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'realia_register_required_plugins' );


/**
 * Gets plugins package filepath
 *
 * @param string $plugin_slug
 * @return string
 */
function realia_get_plugin_package( $plugin_slug ) {
	$prefix = get_template_directory() . '/plugins/';
	return $prefix . $plugin_slug . '.zip';
}


/**
 * Class realia_Menu_Walker
 */
class Realia_Menu_Walker extends Walker_Nav_Menu {
	/**
	 * Custom parent menu item class
	 *
	 * @param string $output
	 * @param int $depth
	 * @param array $args
	 * @return void
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu sub-menu\">\n";
	}
}

/**
 * Comments template
 */
function aviators_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );
	include 'templates/misc/comment.php';
}

/**
 * Added property meta at the end of property box
 */
function aviators_realia_after_property_box_body( $id ) {
	if ( class_exists( 'Realia_Template_Loader' ) ) {
		include Realia_Template_Loader::locate( 'property_box_meta' );
	}
}
add_action( 'realia_after_property_box_body', 'aviators_realia_after_property_box_body' );

/**
 * Adds property price on property box image
 */
function aviators_realia_after_property_box_image( $id ) {
	if ( class_exists( 'Realia_Template_Loader' ) ) {
		include Realia_Template_Loader::locate( 'property_box_price' );
	}
}
add_action( 'realia_after_property_box_image', 'aviators_realia_after_property_box_image' );

/**
 * Adds links after rent sale navigation tabs
 */
function aviators_realia_after_rent_sale_widget_navigation_items() {
	if ( class_exists( 'Realia_Template_Loader' ) ) {
		include Realia_Template_Loader::locate( 'rent-sale-widget-items' );
	}
}
add_action( 'realia_after_rent_sale_widget_navigation_items', 'aviators_realia_after_rent_sale_widget_navigation_items' );


function realia_remove_responsive_images( $attr ) {
	if( isset( $attr['sizes'] ) ) {
		unset( $attr['sizes'] );
	}

	if( isset( $attr['srcset'] ) ) {
		unset( $attr['srcset'] );
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'realia_remove_responsive_images', 9999 );
<?php

/*
*	Main theme functions and definitions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Theme Definitions
 * Please leave these settings unchanged
 */

define( 'BLADE_GRVE_THEME_SHORT_NAME', 'blade' );
define( 'BLADE_GRVE_THEME_NAME', 'Blade' );
define( 'BLADE_GRVE_THEME_MAJOR_VERSION', 2 );
define( 'BLADE_GRVE_THEME_MINOR_VERSION', 2 );
define( 'BLADE_GRVE_THEME_HOTFIX_VERSION', 6 );
define( 'BLADE_GRVE_THEME_REDUX_CUSTOM_PANEL', false);

/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1080;
}

/**
 * Theme textdomain - must be loaded before redux
 */
load_theme_textdomain( 'blade', get_template_directory() . '/languages' );

/**
 * Include Global helper files
 */
require_once get_template_directory() . '/includes/grve-global.php';
require_once get_template_directory() . '/includes/grve-woocommerce-functions.php';

/**
 * Register Plugins Libraries
 */
if ( is_admin() ) {
	require_once get_template_directory() . '/includes/plugins/tgm-plugin-activation/register-plugins.php';
	require_once get_template_directory() . '/includes/plugins/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php';
}

/**
 * ReduxFramework
 */
require_once get_template_directory() . '/includes/admin/grve-redux-extension-loader.php';

if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/includes/framework/framework.php' ) ) {
    require_once get_template_directory() . '/includes/framework/framework.php';
}

if ( !isset( $redux_demo ) ) {
	require_once get_template_directory() . '/includes/admin/grve-redux-framework-config.php';
}

function blade_grve_remove_redux_demo_link() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'blade_grve_remove_redux_demo_link');

/**
 * Custom Nav Menus
 */
require_once get_template_directory() . '/includes/custom-menu/grve-custom-nav-menu.php';

/**
 * Visual Composer Extentions
 */
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {

	function blade_grve_add_vc_extentions() {
		require_once get_template_directory() . '/vc_extend/grve-shortcodes-vc-helper.php';
		require_once get_template_directory() . '/vc_extend/grve-shortcodes-vc-remove.php';
		require_once get_template_directory() . '/vc_extend/grve-shortcodes-vc-add.php';
	}
	add_action( 'init', 'blade_grve_add_vc_extentions', 5 );

}

/**
 * Include admin helper files
 */
require_once get_template_directory() . '/includes/admin/grve-admin-functions.php';
require_once get_template_directory() . '/includes/admin/grve-admin-custom-sidebars.php';
require_once get_template_directory() . '/includes/admin/grve-admin-option-functions.php';
require_once get_template_directory() . '/includes/admin/grve-admin-feature-functions.php';

require_once get_template_directory() . '/includes/admin/grve-update-functions.php';
require_once get_template_directory() . '/includes/admin/grve-meta-functions.php';
require_once get_template_directory() . '/includes/admin/grve-category-meta.php';
require_once get_template_directory() . '/includes/admin/grve-post-meta.php';

require_once get_template_directory() . '/includes/admin/grve-portfolio-meta.php';
require_once get_template_directory() . '/includes/admin/grve-testimonial-meta.php';
require_once get_template_directory() . '/includes/grve-wp-gallery.php';

/**
 * Include Dynamic css
 */
require_once get_template_directory() . '/includes/grve-dynamic-css-loader.php';

/**
 * Include helper files
 */
require_once get_template_directory() . '/includes/grve-breadcrumbs.php';
require_once get_template_directory() . '/includes/grve-excerpt.php';
require_once get_template_directory() . '/includes/grve-vce-functions.php';
require_once get_template_directory() . '/includes/grve-header-functions.php';
require_once get_template_directory() . '/includes/grve-feature-functions.php';
require_once get_template_directory() . '/includes/grve-layout-functions.php';
require_once get_template_directory() . '/includes/grve-blog-functions.php';
require_once get_template_directory() . '/includes/grve-media-functions.php';
require_once get_template_directory() . '/includes/grve-portfolio-functions.php';
require_once get_template_directory() . '/includes/grve-footer-functions.php';

/**
 * Include Theme Widgets
 */
require_once get_template_directory() . '/includes/widgets/grve-widget-social.php';
require_once get_template_directory() . '/includes/widgets/grve-widget-latest-posts.php';
require_once get_template_directory() . '/includes/widgets/grve-widget-latest-comments.php';
require_once get_template_directory() . '/includes/widgets/grve-widget-latest-portfolio.php';
require_once get_template_directory() . '/includes/widgets/grve-widget-contact-info.php';
require_once get_template_directory() . '/includes/widgets/grve-widget-instagram-feed.php';

//Add shortcodes to widget text
add_filter( 'widget_text' , 'do_shortcode' );

add_action( 'after_switch_theme', 'blade_grve_theme_activate' );
add_action( 'after_setup_theme', 'blade_grve_theme_setup' );
add_action( 'widgets_init', 'blade_grve_register_sidebars' );

/**
 * Theme activation function
 * Used whe activating the theme
 */
function blade_grve_theme_activate() {

	$grve_version = array (
		"major" => BLADE_GRVE_THEME_MAJOR_VERSION,
		"minor" => BLADE_GRVE_THEME_MINOR_VERSION,
		"hotfix" => BLADE_GRVE_THEME_HOTFIX_VERSION,
	);
	update_option( 'blade_grve_theme_version', $grve_version );

	$blade_grve_term_migration = get_option( 'blade_grve_term_migration' );
	if ( !$blade_grve_term_migration ) {
		blade_grve_term_migration();
	}

	flush_rewrite_rules();
}

function blade_grve_term_migration() {

	if ( function_exists( 'update_term_meta' ) ) {

		global $wpdb;
		$grve_old_term_meta_data = $wpdb->get_results( "SELECT
			option_name AS meta_key,
			TRIM(LEADING 'grve_term_meta_' FROM option_name) AS term_id
			FROM `wp_options` WHERE `option_name` LIKE  'grve_term_meta_%'");

		if( $grve_old_term_meta_data ) {
			foreach ( $grve_old_term_meta_data as $term_meta ) {
				$meta_value = get_option( $term_meta->meta_key );
				update_term_meta( $term_meta->term_id, 'grve_custom_title_options', $meta_value );
				delete_option( $term_meta->meta_key );
			}
		}
		update_option( 'blade_grve_term_migration', true );
	}

}

/**
 * Theme setup function
 * Theme support
 */
function blade_grve_theme_setup() {

	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails', array( 'post', 'portfolio' ) );
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );
	add_theme_support( 'title-tag' );

	add_image_size( 'blade-grve-large-rect-horizontal', 1170, 658, true );
	add_image_size( 'blade-grve-small-square', 600, 600, true );
	add_image_size( 'blade-grve-small-rect-horizontal', 800, 600, true );
	add_image_size( 'blade-grve-small-rect-horizontal-wide', 800, 450, true );
	add_image_size( 'blade-grve-small-rect-vertical', 600, 800, true );
	add_image_size( 'blade-grve-medium-rect-vertical', 560, 1120, true );
	add_image_size( 'blade-grve-medium-square', 1120, 1120, true );
	add_image_size( 'blade-grve-fullscreen', 1920, 1920, false );

	register_nav_menus(
		array(
			'grve_header_nav' => esc_html__( 'Header Menu', 'blade' ),
			'grve_top_left_nav' => esc_html__( 'Top Left Menu', 'blade' ),
			'grve_top_right_nav' => esc_html__( 'Top Right Menu', 'blade' ),
			'grve_footer_nav' => esc_html__( 'Footer Menu', 'blade' ),
		)
	);

}

/**
 * Navigation Menus
 */
function blade_grve_get_header_nav() {

	$grve_main_menu = '';

	if ( 'default' == blade_grve_option( 'menu_header_integration', 'default' ) ) {

		if ( is_singular() ) {
			if ( 'yes' == blade_grve_post_meta( 'grve_disable_menu' ) ) {
				return 'disabled';
			} else {
				$grve_main_menu	= blade_grve_post_meta( 'grve_main_navigation_menu' );
			}
		} else if ( blade_grve_is_woo_shop() ) {
			if ( 'yes' == blade_grve_post_meta_shop( 'grve_disable_menu' ) ) {
				return 'disabled';
			} else {
				$grve_main_menu	= blade_grve_post_meta_shop( 'grve_main_navigation_menu' );
			}
		}
	} else {
		$grve_main_menu = 'disabled';
	}

	return $grve_main_menu;
}

function blade_grve_header_nav( $grve_main_menu = '') {

	if ( empty( $grve_main_menu ) ) {
		wp_nav_menu(
			array(
				'menu_class' => 'grve-menu', /* menu class */
				'theme_location' => 'grve_header_nav', /* where in the theme it's assigned */
				'container' => false,
				'fallback_cb' => 'blade_grve_fallback_menu',
				'link_before' => '<span class="grve-item">',
				'link_after' => '</span>',
				'walker' => new Blade_Grve_Main_Navigation_Walker(),
			)
		);
	} else {
		//Custom Alternative Menu
		wp_nav_menu(
			array(
				'menu_class' => 'grve-menu', /* menu class */
				'menu' => $grve_main_menu, /* menu name */
				'container' => false,
				'fallback_cb' => 'blade_grve_fallback_menu',
				'link_before' => '<span class="grve-item">',
				'link_after' => '</span>',
				'walker' => new Blade_Grve_Main_Navigation_Walker(),
			)
		);
	}
}

/**
 * Main Navigation FallBack Menu
 */
if ( ! function_exists( 'blade_grve_fallback_menu' ) ) {
	function blade_grve_fallback_menu(){

		if( current_user_can( 'administrator' ) ) {
			echo '<span class="grve-no-assigned-menu grve-small-text">';
			echo esc_html__( 'Header Menu is not assigned!', 'blade'  ) . " " .
			"<a href='" . admin_url() . "nav-menus.php?action=locations' target='_blank'>" . esc_html__( "Manage Locations", 'blade' ) . "</a>";
			echo '</span>';
		}
	}
}

function blade_grve_footer_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'grve_footer_nav',
			'container' => false, /* no container */
			'depth' => '1',
			'fallback_cb' => false,
		)
	);

}

function blade_grve_top_left_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'grve_top_left_nav',
			'container' => false, /* no container */
			'depth' => '2',
			'fallback_cb' => false,
		)
	);

}

function blade_grve_top_right_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'grve_top_right_nav',
			'container' => false, /* no container */
			'depth' => '2',
			'fallback_cb' => false,
		)
	);

}

/**
 * Sidebars & Widgetized Areas
 */
function blade_grve_register_sidebars() {

	$sidebar_heading_tag = blade_grve_option( 'sidebar_heading_tag', 'div' );
	$footer_heading_tag = blade_grve_option( 'footer_heading_tag', 'div' );

	register_sidebar( array(
		'id' => 'grve-default-sidebar',
		'name' => esc_html__( 'Main Sidebar', 'blade' ),
		'description' => esc_html__( 'Main Sidebar Widget Area', 'blade' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
	));

	register_sidebar( array(
		'id' => 'grve-single-portfolio-sidebar',
		'name' => esc_html__( 'Single Portfolio', 'blade' ),
		'description' => esc_html__( 'Single Portfolio Sidebar Widget Area', 'blade' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
	));

	register_sidebar( array(
		'id' => 'grve-footer-1-sidebar',
		'name' => esc_html__( 'Footer 1', 'blade' ),
		'description' => esc_html__( 'Footer 1 Widget Area', 'blade' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-2-sidebar',
		'name' => esc_html__( 'Footer 2', 'blade' ),
		'description' => esc_html__( 'Footer 2 Widget Area', 'blade' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-3-sidebar',
		'name' => esc_html__( 'Footer 3', 'blade' ),
		'description' => esc_html__( 'Footer 3 Widget Area', 'blade' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-4-sidebar',
		'name' => esc_html__( 'Footer 4', 'blade' ),
		'description' => esc_html__( 'Footer 4 Widget Area', 'blade' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));

	$grve_custom_sidebars = get_option( 'grve-blade-custom-sidebars' );
	if ( ! empty( $grve_custom_sidebars ) ) {
		foreach ( $grve_custom_sidebars as $grve_custom_sidebar ) {
			register_sidebar( array(
				'id' => $grve_custom_sidebar['id'],
				'name' => esc_html__( 'Custom Sidebar', 'blade' ) . ': ' . esc_html( $grve_custom_sidebar['name'] ),
				'description' => '',
				'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="grve-widget-title">',
				'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
			));
		}
	}

}

/**
 * Custom Search Form
 */
 function blade_grve_modal_wpsearch( $form ) {
	$form = '';
	$form .= '<form class="grve-search" method="get" action="' . esc_url( home_url( '/' ) ) . '" >';
	$form .= '  <button type="submit" class="grve-search-btn grve-custom-btn grve-text-primary-1"><i class="grve-icon-search"></i></button>';
	$form .= '  <input type="text" class="grve-search-textfield grve-h1" value="' . get_search_query() . '" name="s" placeholder="' . esc_attr__( 'SEARCH FOR ...', 'blade' ) . '" autocomplete="off"/>';
	if ( defined( 'ICL_SITEPRESS_VERSION' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {
		$form .= '<input type="hidden" name="lang" value="'. esc_attr( ICL_LANGUAGE_CODE ) .'"/>';
	}
	$form .= '</form>';
	return $form;
}

function blade_grve_wpsearch( $form ) {
	$form =  '<form class="grve-search" method="get" action="' . esc_url( home_url( '/' ) ) . '" >';
	$form .= '  <button type="submit" class="grve-search-btn grve-custom-btn"><i class="grve-icon-search"></i></button>';
	$form .= '  <input type="text" class="grve-search-textfield" value="' . get_search_query() . '" name="s" placeholder="' . esc_attr__( 'Search for ...', 'blade' ) . '" />';
	$form .= '</form>';
	return $form;
}
//add_filter( 'get_search_form', 'blade_grve_wpsearch' );

/**
 * Enqueue scripts and styles for the front end.
 */
function blade_grve_frontend_scripts() {

	$grve_ver = BLADE_GRVE_THEME_MAJOR_VERSION . '.' . BLADE_GRVE_THEME_MINOR_VERSION . '.' . BLADE_GRVE_THEME_HOTFIX_VERSION;

	wp_register_style( 'blade-grve-style', get_stylesheet_directory_uri()."/style.css", array(), esc_attr( $grve_ver ), 'all' );
	wp_enqueue_style( 'blade-grve-awsome-fonts', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0' );


	wp_enqueue_style( 'blade-grve-basic', get_template_directory_uri() . '/css/basic.css', array(), esc_attr( $grve_ver ) );
	wp_enqueue_style( 'blade-grve-grid', get_template_directory_uri() . '/css/grid.css', array(), esc_attr( $grve_ver ) );
	wp_enqueue_style( 'blade-grve-theme-style', get_template_directory_uri() . '/css/theme-style.css', array(), esc_attr( $grve_ver ) );
	wp_enqueue_style( 'blade-grve-elements', get_template_directory_uri() . '/css/elements.css', array(), esc_attr( $grve_ver ) );


	if ( blade_grve_woocommerce_enabled() ) {
		wp_enqueue_style( 'blade-grve-woocommerce-custom', get_template_directory_uri() . '/css/woocommerce-custom.css', array(), esc_attr( $grve_ver ), 'all' );
	}

	if ( get_stylesheet_directory_uri() !=  get_template_directory_uri() ) {
		wp_enqueue_style( 'blade-grve-style');
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'blade-grve-responsive', get_template_directory_uri() . '/css/responsive.css', array(), esc_attr( $grve_ver ) );

	$gmap_api_key = blade_grve_option( 'gmap_api_key' );

	if ( !empty( $gmap_api_key ) ) {
		wp_register_script( 'blade-grve-googleapi-script', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $gmap_api_key ), NULL, NULL, true );
	} else {
		wp_register_script( 'blade-grve-googleapi-script', '//maps.googleapis.com/maps/api/js?v=3', NULL, NULL, true );
	}

	wp_register_script( 'blade-grve-maps-script', get_template_directory_uri() . '/js/maps.js', array( 'jquery', 'blade-grve-googleapi-script' ), esc_attr( $grve_ver ), true );
	$grve_maps_data = array(
		'custom_enabled' => blade_grve_option( 'gmap_custom_enabled', '0' ) ,
		'water_color' => blade_grve_option( 'gmap_water_color', '#e9e9e9' ) ,
		'lanscape_color' => blade_grve_option( 'gmap_landscape_color', '#f1b144' ) ,
		'poi_color' => blade_grve_option( 'gmap_poi_color', '#f1b144' ) ,
		'road_color' => blade_grve_option( 'gmap_road_color', '#f2c77d' ) ,
		'label_color' => blade_grve_option( 'gmap_label_color', '#000000' ) ,
		'label_enabled' => blade_grve_option( 'gmap_label_enabled', '0' ) ,
		'country_color' => blade_grve_option( 'gmap_country_color', '#f1b144' ) ,
		'zoom_enabled' => blade_grve_option( 'gmap_zoom_enabled', '0' ) ,
	);
	wp_localize_script( 'blade-grve-maps-script', 'grve_maps_data', $grve_maps_data );
	wp_enqueue_script( 'blade-grve-modernizr-script', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '2.8.3', false );
	if ( blade_grve_browser_webkit_check() ) {
		wp_enqueue_script( 'blade-grve-smoothscrolling-script', get_template_directory_uri() . '/js/smoothscrolling.js', array( 'jquery' ), esc_attr( $grve_ver ), true );
	}

	wp_enqueue_script( 'blade-grve-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), esc_attr( $grve_ver ), true );
	$grve_plugins_data = array(
		'retina_support' => blade_grve_option( 'retina_support', 'default' ),
	);
	wp_localize_script( 'blade-grve-plugins', 'grve_plugins_data', $grve_plugins_data );

	if ( is_page_template( 'page-templates/template-full-page.php' ) ) {
		wp_enqueue_script( 'blade-grve-full-page', get_template_directory_uri() . '/js/jquery.fullPage.js', array( 'jquery' ), '2.6.9', true );
	}

	wp_enqueue_script( 'blade-grve-main-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), esc_attr( $grve_ver ), true );

	$grve_main_data = array(
		'siteurl' => get_template_directory_uri() ,
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'grve_wp_gallery_popup' => blade_grve_option( 'wp_gallery_popup', '0' ),
		'grve_back_top_top' => blade_grve_option( 'back_to_top_enabled', '1' ),
		'grve_string_weeks' => esc_html__( 'Weeks', 'blade' ),
		'grve_string_days' => esc_html__( 'Days', 'blade' ),
		'grve_string_hours' => esc_html__( 'Hours', 'blade' ),
		'grve_string_minutes' => esc_html__( 'Min', 'blade' ),
		'grve_string_seconds' => esc_html__( 'Sec', 'blade' ),
	);
	wp_localize_script( 'blade-grve-main-script', 'grve_main_data', $grve_main_data );



}
add_action( 'wp_enqueue_scripts', 'blade_grve_frontend_scripts' );

function blade_grve_remove_conflict_frontend_css() {

	//Deregister VC awesome fonts as it is already enqueued
	if ( wp_style_is( 'font-awesome', 'registered' ) ) {
		wp_deregister_style( 'font-awesome' );
	}

}
add_action( 'wp_head', 'blade_grve_remove_conflict_frontend_css', 2000 );

/**
 * Pagination functions
 */
function blade_grve_paginate_links() {
	global $wp_query;

	$paged = 1;
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}

	$total = $wp_query->max_num_pages;
	$big = 999999999; // need an unlikely integer
	if( $total > 1 )  {
		 echo '<div class="grve-pagination grve-link-text">';

		 if( get_option('permalink_structure') ) {
			 $format = 'page/%#%/';
		 } else {
			 $format = '&paged=%#%';
		 }
		 echo paginate_links(array(
			'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'		=> $format,
			'current'		=> max( 1, $paged ),
			'total'			=> $total,
			'mid_size'		=> 2,
			'type'			=> 'list',
			'prev_text'    => "<i class='grve-icon-arrow-left'></i>",
			'next_text'    => "<i class='grve-icon-arrow-right'></i>",
			'add_args' => false,
		 ));
		 echo '</div>';
	}
}

function blade_grve_wp_link_pages_args( $args ) {

	$args = array(
		'before'           => '<div class="grve-pagination grve-link-text"><ul><li>',
		'after'            => '</li></ul></div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => '</li><li>',
		'nextpagelink'     => "<i class='grve-icon-arrow-right'></i>",
		'previouspagelink' => "<i class='grve-icon-arrow-left'></i>",
		'pagelink'         => '%',
		'echo'             => 1
	);

	return $args;
}
add_filter( 'wp_link_pages_args', 'blade_grve_wp_link_pages_args' );

/**
 * Comments
 */
function blade_grve_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li class="grve-comment-item">
		<!-- Comment -->
		<div id="comment-<?php comment_ID(); ?>"  <?php comment_class(); ?>>
			<?php echo get_avatar( $comment, 50 ); ?>
			<div class="grve-comment-content">
				<span class="grve-author grve-text-dark grve-h6"><?php comment_author(); ?></span>
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" class="grve-small-text grve-comment-date grve-text-content grve-text-dark-hover"><?php printf( ' %1$s ' . esc_html__( 'at', 'blade' ) . ' %2$s', get_comment_date(),  get_comment_time() ); ?></a>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p><?php esc_html_e( 'Your comment is awaiting moderation.', 'blade' ); ?></p>
				<?php endif; ?>
				<div class="grve-comment-text"><?php comment_text(); ?></div>
				<div class="grve-reply-edit">
					<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => esc_html__( 'Reply', 'blade' ) ) ) ); ?>
					<?php edit_comment_link( esc_html__( 'Edit', 'blade' ), '  ', '' ); ?>
				</div>
			</div>
		</div>

	<!-- </li> is added by WordPress automatically -->
<?php
}

/**
 * Navigation links for prev/next in comments
 */
function blade_grve_replace_reply_link_class( $output ) {
	$class = 'grve-comment-reply grve-small-text grve-text-primary-1 grve-text-dark-hover';
	return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $class, $output, 1 );
}
add_filter('comment_reply_link', 'blade_grve_replace_reply_link_class');

function blade_grve_replace_edit_link_class( $output ) {
	$class = 'grve-comment-edit grve-small-text grve-text-primary-1 grve-text-dark-hover';
	return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $class, $output, 1 );
}
add_filter('edit_comment_link', 'blade_grve_replace_edit_link_class');


/**
 * Title Render Fallback before WordPress 4.1
 */
 if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function blade_grve_theme_render_title() {
?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'blade_grve_theme_render_title' );
}

/**
 * Theme identifier function
 * Used to get theme information
 */
function blade_grve_info() {

	$grve_info = array (
		"major_version" => BLADE_GRVE_THEME_MAJOR_VERSION,
		"minor_version" => BLADE_GRVE_THEME_MINOR_VERSION,
		"hotfix_version" => BLADE_GRVE_THEME_HOTFIX_VERSION,
		"short_name" => BLADE_GRVE_THEME_SHORT_NAME,
	);

	return $grve_info;
}

/**
 * Add Container
 */
add_action('the_content','blade_grve_container_div');

function blade_grve_container_div( $content ){

	if( is_singular() && !has_shortcode( $content, 'vc_row') ) {
		return '<div class="grve-container">' . $content . '</div>';
	} else {
		return $content;
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.

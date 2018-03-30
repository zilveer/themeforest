<?php
/**
 * Adds classes to the body tag
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

function wpex_body_classes( $classes ) {

	// Save some vars
	$post_id      = wpex_global_obj( 'post_id' );
	$main_layout  = wpex_global_obj( 'main_layout' );
	$post_layout  = wpex_global_obj( 'post_layout' );
	$header_style = wpex_global_obj( 'header_style' );

	// RTL
	if ( is_RTL() ) {
		$classes[] = 'rtl';
	}

	// Customizer
	if ( is_customize_preview() ) {
		$classes[] = 'is_customize_preview';
	}
	
	// Main class
	$classes[] = 'wpex-theme';

	// Responsive
	if ( wpex_global_obj( 'responsive' ) ) {
		$classes[] = 'wpex-responsive';
	}

	// Layout Style
	$classes[] = $main_layout .'-main-layout';
	
	// Add skin to body classes
	if ( 'base' != wpex_global_obj( 'skin' ) ) {
		$classes[] = 'skin-'. wpex_global_obj( 'skin' );
	}

	// Check if the Visual Composer is being used on this page
	if ( wpex_global_obj( 'has_composer' ) ) {
		$classes[] = 'has-composer';
	} else {
		$classes[] = 'no-composer';
	}

	// Live site class
	if ( ! wpex_global_obj( 'vc_is_inline' ) ) {
		$classes[] = 'wpex-live-site';
	}

	// Boxed Layout dropshadow
	if ( 'boxed' == $main_layout
		&& wpex_get_mod( 'boxed_dropdshadow' )
		&& 'gaps' != wpex_global_obj( 'skin' )
	) {
		$classes[] = 'wrap-boxshadow';
	}

	// Sidebar enabled
	if ( 'left-sidebar' == $post_layout || 'right-sidebar' == $post_layout ) {
		$classes[] = 'has-sidebar';
	}

	// Content layout
	if ( $post_layout ) {
		$classes[] = 'content-'. $post_layout;
	}

	// Single Post cagegories
	if ( is_singular( 'post' ) ) {
		$cats = get_the_category( $post_id );
		foreach ( $cats as $cat ) {
			$classes[] = 'post-in-category-'. $cat->category_nicename;
		}
	}

	// Breadcrumbs
	if ( wpex_global_obj( 'has_breadcrumbs' ) ) {
		$classes[] = 'has-breadcrumbs';
	}

	// Topbar
	if ( wpex_global_obj( 'has_top_bar' ) ) {
		$classes[] = 'has-topbar';
	}

	// Widget Icons
	if ( wpex_get_mod( 'has_widget_icons', true ) ) {
		$classes[] = 'sidebar-widget-icons';
	}

	// Overlay header style
	if ( wpex_global_obj( 'has_overlay_header' ) ) {
		$classes[] = 'has-overlay-header';
	} else {
		$classes[] = 'hasnt-overlay-header';
	}

	// Footer reveal
	if ( wpex_global_obj( 'has_footer_reveal' ) ) {
		$classes[] = 'footer-has-reveal';
	}

	// Slider
	if ( wpex_global_obj( 'has_post_slider' ) ) {
		$classes[] = 'page-with-slider';
	}

	// No header margin
	if ( 'on' == get_post_meta( $post_id, 'wpex_disable_header_margin', true ) ) {
		$classes[] = 'no-header-margin';
	}

	// Title with Background Image
	if ( 'background-image' == wpex_global_obj( 'page_header_style' ) ) {
		$classes[] = 'page-with-background-title';
	}

	// Disabled header
	if ( ! wpex_global_obj( 'has_page_header' ) ) {
		$classes[] = 'page-header-disabled';
	}

	// Disabled main header
	if ( ! wpex_global_obj( 'has_header' ) ) {
		$classes[] = 'wpex-site-header-disabled';
	}

	// Page slider
	if ( wpex_global_obj( 'has_post_slider' )
		&& $slider_position = wpex_global_obj( 'post_slider_position' )
	) {
		$classes[] = 'has-post-slider';
		$slider_position = str_replace( '_', '-', $slider_position );
		$classes[] = 'post-slider-'. $slider_position;
	}

	// Font smoothing
	if ( wpex_get_mod( 'enable_font_smoothing' ) ) {
		$classes[] = 'smooth-fonts';
	}

	// Vertical header style
	if ( 'six' == $header_style ) {
		$classes[] = 'wpex-has-vertical-header';
		if ( 'fixed' == wpex_get_mod( 'vertical_header_style' ) ) {
			$classes[] = 'wpex-fixed-vertical-header';
		}
	}

	// Mobile menu toggle style
	if ( wpex_global_obj( 'has_mobile_menu' ) ) {
		
		// Mobile menu toggle style
		$classes[] = 'wpex-mobile-toggle-menu-'. wpex_global_obj( 'mobile_menu_toggle_style' );

		// Mobile menu style
		if ( 'disabled' == wpex_global_obj( 'mobile_menu_style' ) ) {
			$classes[] = 'mobile-menu-disabled';
		} else {
			$classes[] = 'has-mobile-menu';
		}

	}

	// Fixed Footer - adds min-height to main wraper
	if ( wpex_get_mod( 'fixed_footer', false ) ) {
		$classes[] = 'wpex-has-fixed-footer';
	}

	// Navbar inner span bg
	if ( wpex_get_mod( 'menu_link_span_background' ) ) {
		$classes[] = 'navbar-has-inner-span-bg';
	}

	// Check if avatars are enabled
	if ( is_singular() && ! get_option( 'show_avatars' ) ) {
		$classes[] = 'comment-avatars-disabled';
	}

	// Togglebar
	if ( 'inline' == wpex_get_mod( 'toggle_bar_display', 'overlay' ) ) {
		$classes[] = 'togglebar-is-inline';
	}
	
	// Return classes
	return $classes;

}
add_filter( 'body_class', 'wpex_body_classes' );
<?php
/**
 *	Visual Composer Config for Laborator Themes
 * 	Only certtain elements are supported for this theme (not all developed by Laborator)
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $curr_dir;

# ! Layout Element
$curr_dir = dirname(__FILE__);

# Register Own Param Types
include_once($curr_dir . '/param-types/fontelloicon/fontelloicon_param_type.php');


# Shortcodes
add_action('init', 'laborator_vc_shortcodes');

function laborator_vc_shortcodes() {
	global $curr_dir;

	include_once( $curr_dir . '/laborator-shortcodes/laborator_banner.php' );
	include_once( $curr_dir . '/laborator-shortcodes/laborator_image_banner.php' );
	include_once( $curr_dir . '/laborator-shortcodes/laborator_featuretab.php' );
	include_once( $curr_dir . '/laborator-shortcodes/laborator_testimonials.php' );
	include_once( $curr_dir . '/laborator-shortcodes/laborator_heading.php' );
	include_once( $curr_dir . '/laborator-shortcodes/laborator_logo_carousel.php' );

	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins') ) ) || class_exists( 'WooCommerce' ) ) {
		include_once( $curr_dir . '/laborator-shortcodes/laborator_products.php' );
		include_once( $curr_dir . '/laborator-shortcodes/laborator_products_carousel.php' );
	}
}

// Admin Styles
add_action( 'admin_enqueue_scripts', 'laborator_vc_styles' );

function laborator_vc_styles() {

	$laborator_vc_style = THEMEURL . 'inc/lib/visual-composer/assets/laborator_vc_main.css';

	wp_enqueue_style( 'laborator_vc_main', $laborator_vc_style );
}



// VC Tabs 4.7
add_action( 'vc_after_mapping', 'lab_vc_tta_tabs_setup' );

function lab_vc_tta_tabs_setup() {
	
	$new_param = array( 'Theme Styled (if selected, other style settings will be ignored)' => 'theme-styled' );
	$new_param_border = array( 'Theme Styled with Borders (if selected, other style settings will be ignored)' => 'theme-styled theme-styled-bordered' );
	
	$tabs_param        = WPBMap::getParam( 'vc_tta_tabs', 'style' );
	$accordion_param   = WPBMap::getParam( 'vc_tta_accordion', 'style' );
	
	if( ! is_array( $tabs_param ) || ! is_array( $accordion_param ) ) {
		return;
	}
	
	$tabs_param['value']       = array_merge( $new_param, $new_param_border, $tabs_param['value'] );
	$accordion_param['value']  = array_merge( $new_param, $accordion_param['value'] );

	vc_update_shortcode_param( 'vc_tta_tabs', $tabs_param );
	vc_update_shortcode_param( 'vc_tta_accordion', $accordion_param );
}
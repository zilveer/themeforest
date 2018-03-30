<?php

/**
 * Visual Composer Functions
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
// Change VC templates dir

$dir = SD_FRAMEWORK_INC . 'vc/vc-templates/';
vc_set_shortcodes_templates_dir( $dir );

// Set Visual Composer to run in Theme Mode
if ( !function_exists( 'sd_vc_as_theme' ) ) {
function sd_vc_as_theme() {
		vc_set_as_theme( true );
	}
	add_action( 'vc_before_init', 'sd_vc_as_theme' );
}
// Enable Visual Composer page builder for theme defined post types
$sd_vb_post_types = array(
	'page',
	'download',
	'events',
);
vc_set_default_editor_post_types( $sd_vb_post_types );

// Disable frontend mode (still in beta)

//vc_disable_frontend();

// Remove params and elements
require_once( SD_FRAMEWORK_INC . 'vc/sd-vc-remove.php' );
	
// Update params
require_once( SD_FRAMEWORK_INC . 'vc/sd-vc-update.php' );

// Include theme's shortcodes
require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-blog.php' );

if ( class_exists( 'SdThemeFunctions' ) ) {
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-staff.php' );
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-testimonials.php' );
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-events.php' );
}
if ( class_exists( 'SdThemeFunctions' ) ) {
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-event-countdown.php' );
}
if ( sd_is_crowdfunding() ) {
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-single-campaign.php' );
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-single-campaign-featured.php' );
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-campaign-carousel.php' );
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-campaign-slider.php' );
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-campaign-listing.php' );
}
if ( sd_is_woo() ) {
	require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-woo.php' );
}
// Remove default layout templates
if ( !function_exists( 'sd_remove_default_layout_templates' ) ) {
	function sd_remove_default_layout_templates( $data ) {
    	return array(); // This will remove all default templates
	}
}
add_filter( 'vc_load_default_templates', 'sd_remove_default_layout_templates' );
// Include SD layout templates

require_once( SD_FRAMEWORK_INC . 'vc/sd-layout-templates.php' );

// Run code in admin only
if ( !is_admin() ) {
	return;
	} else {

		// Remove VC Teaser metabox
		if ( ! function_exists( 'sd_remove_vc_boxes' ) ) {
			function sd_remove_vc_boxes() {
				$post_types = get_post_types( '', 'names' ); 
				foreach ( $post_types as $post_type ) {
					remove_meta_box( 'vc_teaser',  $post_type, 'side' );
				}
			} 
		}
	add_action( 'do_meta_boxes', 'sd_remove_vc_boxes' );
}
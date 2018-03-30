<?php
/**
 * Remove Parameters and Elements from Visual Composer
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */


// Remove VC Params

vc_remove_param( 'vc_row', 'css' );
vc_remove_param( 'vc_icon', 'background' );
vc_remove_param( 'vc_icon', 'size' );
vc_remove_param( 'vc_icon', 'align' );
vc_remove_param( 'vc_icon', 'color' );
vc_remove_param( 'vc_icon', 'background_style' );
vc_remove_param( 'vc_icon', 'vc_link' );

// Remove VC Elements

if ( !function_exists( 'sd_vc_remove_elements' ) ) {
	function sd_vc_remove_elements() {
		vc_remove_element( 'vc_wp_tagcloud' );
		vc_remove_element( 'vc_wp_archives' );
		vc_remove_element( 'vc_wp_calendar' );
		vc_remove_element( 'vc_wp_pages' );
		vc_remove_element( 'vc_wp_links' );
		vc_remove_element( 'vc_wp_posts' );
		vc_remove_element( 'vc_gallery' );
		vc_remove_element( 'vc_wp_rss' );
		vc_remove_element( 'vc_wp_text' );
		vc_remove_element( 'vc_wp_meta' );
		vc_remove_element( 'vc_wp_recentcomments' );
		vc_remove_element( 'vc_wp_categories' );
		vc_remove_element( 'vc_button' );
		vc_remove_element( 'vc_cta_button2' );
		vc_remove_element( 'vc_gmaps' );
		vc_remove_element( 'vc_posts_grid' );
		vc_remove_element( 'vc_carousel' );
		vc_remove_element( 'vc_widget_sidebar' );
	}
	add_action( 'init', 'sd_vc_remove_elements' );	
}
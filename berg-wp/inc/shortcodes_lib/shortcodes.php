<?php
/**
 * shortcodes init
 */


/**
 * remove vc shortcodes
 */

if (defined('WPB_VC_VERSION')) {
	vc_map_update( 'vc_tabs', array('deprecated'=>false) );
	vc_map_update( 'vc_tour', array('deprecated'=>false) );
	vc_map_update( 'vc_accordion', array('deprecated'=>false) );
	vc_map_update( 'vc_cta_button', array('deprecated'=>false) );
	vc_remove_element("vc_button2");
	vc_remove_element("vc_cta_button2");
	vc_remove_element("vc_posts_slider");
	vc_remove_element("vc_carousel");
	vc_remove_element("vc_facebook");
	vc_remove_element("vc_tweetmeme");
	vc_remove_element("vc_googleplus");
	vc_remove_element("vc_pinterest");
	vc_remove_element("vc_flickr");
	vc_remove_element("vc_line_chart");
	vc_remove_element("vc_round_chart");
	vc_remove_element("vc_media_grid");
	// vc_remove_element("vc_masonry_grid");
	// vc_remove_element("vc_masonry_media_grid");
	vc_remove_element("vc_tta_pageable");
	vc_remove_element("rev_slider_vc");
	vc_remove_element("vc_btn");

}
include_once 'param_config/map_config.php';
$hidden = array('content_element' => false);

if (class_exists('WPCF7_ContactForm')) {
	vc_map_update('contact-form-7', $hidden);
}

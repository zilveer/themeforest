<?php

if ( function_exists( 'vc_set_as_theme' ) ) {

	// Init functions

	add_action( 'vc_before_init', 'krown_vc_set_as_theme' );
	function krown_vc_set_as_theme() {
	    vc_set_as_theme();
	}

	vc_disable_frontend();
	vc_set_default_editor_post_types( array( 'page', 'portfolio' ) );
	vc_set_shortcodes_templates_dir( get_template_directory() . '/includes/extend-vc/vc_templates/');

	// Include proper files

	include( 'dependencies.php' );
	include( 'map.php' );
	include( 'shortcode-functions.php' );
	include( 'shortcodes.php' );

	// Remove some of the elements

	vc_remove_element('vc_posts_grid');
	vc_remove_element('vc_accordion');
	vc_remove_element('vc_carousel');
	vc_remove_element('vc_cta_button');
	vc_remove_element('vc_cta_button2');
	vc_remove_element('vc_button2');
	vc_remove_element('vc_facebook');
	vc_remove_element('vc_gallery');
	vc_remove_element('vc_googleplus');
	vc_remove_element('vc_images_carousel');
	vc_remove_element('vc_item');
	vc_remove_element('vc_items');
	vc_remove_element('vc_pinterest');
	vc_remove_element('vc_posts_slider');
	vc_remove_element('vc_toggle');
	vc_remove_element('vc_tweetmeme');
	vc_remove_element('vc_pie');
	vc_remove_element('vc_progress_bar');
	vc_remove_element('vc_video');
	vc_remove_element('vc_gmaps');
	vc_remove_element('vc_empty_space');
	vc_remove_element('vc_custom_heading');
	
	vc_remove_element('vc_basic_grid');
	vc_remove_element('vc_media_grid');
	vc_remove_element('vc_masonry_grid');
	vc_remove_element('vc_masonry_media_grid');
	vc_remove_element('vc_icon');
	vc_remove_element('vc_cta');
	vc_remove_element('vc_btn');
	
	vc_remove_element('vc_round_chart');
	vc_remove_element('vc_line_chart');
	vc_remove_element('vc_tta_pageable');
	
	include( 'vc_templates/vc_tt_shortcodes.php' );

	// Replace the classes for the vc_row and vc_column shortcodes

	function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {

		if ($tag=='vc_row' || $tag=='vc_row_inner') {
			$class_string = str_replace(array('vc_row', 'vc_row_inner'), 'krown-column-row clearfix', $class_string);
		}

		if ($tag=='vc_column' || $tag=='vc_column_inner') {
			$class_string = preg_replace('/vc_col\-(xs|sm|md|lg)\-(\d{1,2})/', 'span$2', $class_string);
			$class_string = str_replace(array('wpb_column','vc_row'), 'krown-column-container clearfix', $class_string);
		}

		return $class_string;

	}

	add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);

}

?>
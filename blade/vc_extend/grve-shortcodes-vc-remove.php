<?php
/*
*	Greatives Visual Composer Remove Unsupported Elements
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( function_exists( 'vc_remove_element' ) ) {

	add_action( 'init', 'blade_grve_remove_vc_shortcodes' );

	if ( !function_exists( 'blade_grve_remove_vc_shortcodes' ) && function_exists( 'vc_remove_element' ) ) {

		function blade_grve_remove_vc_shortcodes() {

			if ( !blade_grve_vc_social_elements_visibility() ) {
				//Social
				vc_remove_element("vc_facebook");
				vc_remove_element("vc_flickr");
				vc_remove_element("vc_googleplus");
				vc_remove_element("vc_pinterest");
				vc_remove_element("vc_tweetmeme");
			}

			if ( !blade_grve_vc_wp_elements_visibility() ) {
				//WordPress
				vc_remove_element('vc_wp_custommenu');
				vc_remove_element('vc_wp_tagcloud');
				vc_remove_element('vc_wp_archives');
				vc_remove_element('vc_wp_calendar');
				vc_remove_element('vc_wp_pages');
				vc_remove_element('vc_wp_links');
				vc_remove_element('vc_wp_posts');
				vc_remove_element('vc_wp_categories');
				vc_remove_element('vc_wp_rss');
				vc_remove_element('vc_wp_text');
				vc_remove_element('vc_wp_meta');
				vc_remove_element('vc_wp_recentcomments');
			}

			if ( !blade_grve_vc_grid_visibility() ) {
				//Grid Item related
				vc_remove_element('vc_basic_grid');
				vc_remove_element('vc_media_grid');
				vc_remove_element('vc_masonry_grid');
				vc_remove_element('vc_masonry_media_grid');
				vc_remove_element('vc_icon');
				vc_remove_element('vc_single_image');
				vc_remove_element('vc_separator');
				vc_remove_element("vc_text_separator");
				vc_remove_element('vc_btn');
				vc_remove_element('vc_button2');
			}

			if ( !blade_grve_vc_charts_visibility() ) {
				//Charts
				vc_remove_element('vc_round_chart');
				vc_remove_element('vc_line_chart');
			}

			if ( !blade_grve_vc_other_elements_visibility() ) {
				//Other
				vc_remove_element("vc_toggle");
				vc_remove_element("vc_message");
				vc_remove_element("vc_pie");
				vc_remove_element("vc_progress_bar");
				vc_remove_element("vc_tour");
				vc_remove_element('vc_teaser_grid');
				vc_remove_element('vc_posts_grid');
				vc_remove_element('vc_posts_slider');
				vc_remove_element('vc_gallery');
				vc_remove_element('vc_button');
				vc_remove_element('vc_cta_button');
				vc_remove_element('vc_cta_button2');
				vc_remove_element('vc_carousel');
				vc_remove_element('vc_images_carousel');
				vc_remove_element('vc_video');
				vc_remove_element('vc_gmaps');
				vc_remove_element('vc_cta');
				vc_remove_element('vc_tabs');
				vc_remove_element('vc_tab');
				vc_remove_element('vc_accordion');
				vc_remove_element('vc_accordion_tab');
				vc_remove_element('vc_tta_pageable');
			}

		}
	}
}

if ( function_exists( 'vc_remove_param' ) ) {

	vc_remove_param('vc_row', 'font_color');
	vc_remove_param('vc_row', 'bg_color');
	vc_remove_param('vc_row', 'bg_image');
	vc_remove_param('vc_row', 'bg_image_repeat');
	vc_remove_param('vc_row', 'padding');
	vc_remove_param('vc_row', 'margin_bottom');
	vc_remove_param('vc_row', 'el_class');
	vc_remove_param('vc_row', 'css');
	vc_remove_param('vc_row', 'full_width');

	vc_remove_param('vc_row', 'full_height');
	vc_remove_param('vc_row', 'content_placement');
	vc_remove_param('vc_row', 'video_bg');
	vc_remove_param('vc_row', 'video_bg_url');
	vc_remove_param('vc_row', 'video_bg_parallax');

	vc_remove_param('vc_row', 'parallax');
	vc_remove_param('vc_row', 'parallax_image');
	vc_remove_param('vc_row', 'el_id');
	
	//since 4.9
	vc_remove_param('vc_row', 'gap');
	vc_remove_param('vc_row', 'columns_placement');
	vc_remove_param('vc_row', 'equal_height');
	
	vc_remove_param('vc_row_inner', 'gap');
	vc_remove_param('vc_row_inner', 'content_placement');
	vc_remove_param('vc_row_inner', 'equal_height');

	//since 4.10
	vc_remove_param('vc_row', 'parallax_speed_video');
	vc_remove_param('vc_row', 'parallax_speed_bg');
	
	vc_remove_param('vc_column', 'offset');
	vc_remove_param('vc_column_inner', 'offset');
	vc_remove_param('vc_column', 'width');
	vc_remove_param('vc_column_inner', 'width');
	
	//since 4.12
	vc_remove_param('vc_row', 'disable_element');
	vc_remove_param('vc_row_inner', 'disable_element');



	if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, '4.6', '>=') ) {

		vc_remove_param('vc_tta_tabs', 'title');
		vc_remove_param('vc_tta_tabs', 'style');
		vc_remove_param('vc_tta_tabs', 'shape');
		vc_remove_param('vc_tta_tabs', 'color');
		vc_remove_param('vc_tta_tabs', 'no_fill_content_area');
		vc_remove_param('vc_tta_tabs', 'spacing');
		vc_remove_param('vc_tta_tabs', 'gap');
		vc_remove_param('vc_tta_tabs', 'pagination_style');
		vc_remove_param('vc_tta_tabs', 'pagination_color');
		vc_remove_param('vc_tta_tabs', 'tab_position');

		vc_remove_param('vc_tta_accordion', 'title');
		vc_remove_param('vc_tta_accordion', 'style');
		vc_remove_param('vc_tta_accordion', 'shape');
		vc_remove_param('vc_tta_accordion', 'color');
		vc_remove_param('vc_tta_accordion', 'no_fill_content_area');
		vc_remove_param('vc_tta_accordion', 'spacing');
		vc_remove_param('vc_tta_accordion', 'gap');
		vc_remove_param('vc_tta_accordion', 'pagination_style');
		vc_remove_param('vc_tta_accordion', 'pagination_color');

		vc_remove_param('vc_tta_tour', 'title');
		vc_remove_param('vc_tta_tour', 'style');
		vc_remove_param('vc_tta_tour', 'shape');
		vc_remove_param('vc_tta_tour', 'color');
		vc_remove_param('vc_tta_tour', 'no_fill_content_area');
		vc_remove_param('vc_tta_tour', 'spacing');
		vc_remove_param('vc_tta_tour', 'gap');
		vc_remove_param('vc_tta_tour', 'pagination_style');
		vc_remove_param('vc_tta_tour', 'pagination_color');

	}

	vc_remove_param('vc_column_text', 'css_animation');

	vc_remove_param('vc_widget_sidebar', 'title');

}

if ( is_admin() ) {
	if ( ! function_exists('blade_grve_remove_vc_boxes') ) {
		function blade_grve_remove_vc_boxes(){
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box('vc_teaser',  $post_type, 'side');
			}
		}
	}
	add_action('do_meta_boxes', 'blade_grve_remove_vc_boxes');
}

//Omit closing PHP tag to avoid accidental whitespace output errors.

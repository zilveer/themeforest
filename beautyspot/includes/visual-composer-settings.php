<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

	// DISABLE FRONTED EDITOR
	if ( function_exists( 'vc_disable_frontend' ) ) {
		vc_disable_frontend();
	}

	// CHANGE TEMPLATES DIR
	$dir = get_template_directory() . '/components/visualcomposer';
	if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
		vc_set_shortcodes_templates_dir( $dir );
	}

	// DEACTIVATE ELEMENTS
	if ( function_exists( 'vc_remove_element' ) ) {
		vc_remove_element( 'vc_accordion' );
		vc_remove_element( 'vc_separator' );
		vc_remove_element( 'vc_text_separator' );
		vc_remove_element( 'vc_message' );
		vc_remove_element( 'vc_toggle' );
		vc_remove_element( 'vc_gallery' );
		vc_remove_element( 'vc_images_carousel' );
		vc_remove_element( 'vc_tabs' );
		vc_remove_element( 'vc_tour' );
		vc_remove_element( 'vc_posts_slider' );
		vc_remove_element( 'vc_widget_sidebar' );
		vc_remove_element( 'vc_button' );
		vc_remove_element( 'vc_button2' );
		vc_remove_element( 'vc_cta_button' );
		vc_remove_element( 'vc_cta_button2' );
		vc_remove_element( 'vc_progress_bar' );
		vc_remove_element( 'vc_pie' );
		vc_remove_element( 'vc_basic_grid' );
		vc_remove_element( 'vc_media_grid' );
		vc_remove_element( 'vc_masonry_grid' );
		vc_remove_element( 'vc_masonry_media_grid' );
		vc_remove_element( 'vc_icon' );
		vc_remove_element( 'vc_tta_tabs' );
		vc_remove_element( 'vc_tta_tour' );
		vc_remove_element( 'vc_tta_accordion' );
		vc_remove_element( 'vc_tta_pageable' );
		vc_remove_element( 'vc_round_chart' );
		vc_remove_element( 'vc_line_chart' );
		vc_remove_element( 'vc_btn' );
		vc_remove_element( 'vc_cta' );
	}

	// MODIFY LAYOUT TEMPLATES
	if ( ! function_exists( 'lsvr_vc_modify_layout_templates' ) ) {
		function lsvr_vc_modify_layout_templates( $data ) {

			// DEACTIVATE LAYOUT TEMPLATES
			$removed_arr = array( 'vc_default_template-9', 'vc_default_template-29', 'vc_default_template-40',
				'vc_default_template-31', 'vc_default_template-7', 'vc_default_template-17', 'vc_default_template-15',
				'vc_default_template-11', 'vc_default_template-22', 'vc_default_template-1', 'vc_default_template-19',
				'vc_default_template-19', 'vc_default_template-5', 'vc_default_template-44', 'vc_default_template-6',
				'vc_default_template-14', 'vc_default_template-32', 'vc_default_template-13', 'vc_default_template-12' );

			// PARSE ALL TEMPLATES
			$modified_arr = array();
			if ( is_array( $data ) ){
				foreach( $data as $template ) {
					if ( is_array( $template ) && array_key_exists( 'custom_class', $template ) ) {
						if ( ! in_array( $template['custom_class'], $removed_arr ) ) {
							array_push( $modified_arr, $template );
						}
					}
				}
			}

			// ADD CUSTOM TEMPLATES
			$custom_layouts_arr = array();
			$custom_layout_id_arr = array( 'home-page', 'contact-page', 'about-page', 'gallery-page', 'services-page' );

			foreach( $custom_layout_id_arr as $id ) {
				if ( is_file( dirname( __FILE__ ) . '/../components/visualcomposer/layouts/' . $id . '.php' ) ) {
					$template = include( dirname( __FILE__ ) . '/../components/visualcomposer/layouts/' . $id . '.php' );
					if ( is_array( $template ) ) {
						array_push( $custom_layouts_arr, $template );
					}
				}
			}

			return $custom_layouts_arr + $modified_arr;

		}
	}
	add_filter( 'vc_load_default_templates', 'lsvr_vc_modify_layout_templates' );

} ?>
<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* Removing shortcode */
if ( function_exists( 'vc_remove_element' ) ) {
	vc_remove_element( 'vc_custom_heading' );
	vc_remove_element( 'vc_images_carousel' );
	vc_remove_element( 'vc_text_separator' );
	vc_remove_element( 'vc_message' );
	vc_remove_element( 'vc_gallery' );
	vc_remove_element( 'vc_carousel' );
	vc_remove_element( 'vc_posts_grid' );
	vc_remove_element( 'vc_single_image' );
	vc_remove_element( 'vc_video' );
	vc_remove_element( 'vc_basic_grid' );
	vc_remove_element( 'vc_masonry_grid' );
	vc_remove_element( 'vc_media_grid' );
	vc_remove_element( 'vc_masonry_media_grid' );
}

/* Removing parameters */
if ( function_exists( 'vc_remove_param' ) ) {
	vc_remove_param( 'vc_row', 'el_id' );
	vc_remove_param( 'vc_row', 'full_width' );
	vc_remove_param( 'vc_row', 'full_height' );
	vc_remove_param( 'vc_row', 'video_bg' );
	vc_remove_param( 'vc_row', 'content_placement' );
	vc_remove_param( 'vc_row', 'video_bg_url' );
	vc_remove_param( 'vc_row', 'video_bg_parallax' );
	vc_remove_param( 'vc_row', 'parallax' );
	vc_remove_param( 'vc_row', 'parallax_image' );
	vc_remove_param( 'vc_row', 'bg_image' );
	vc_remove_param( 'vc_row', 'bg_color' );
	vc_remove_param( 'vc_row', 'font_color' );
	vc_remove_param( 'vc_row', 'margin_bottom' );
	vc_remove_param( 'vc_row', 'bg_image_repeat' );
	vc_remove_param( 'vc_separator', 'style' );
	vc_remove_param( 'vc_separator', 'border_width' );
	vc_remove_param( 'vc_separator', 'color' );
	vc_remove_param( 'vc_separator', 'accent_color' );
	vc_remove_param( 'vc_separator', 'el_width' );
	vc_remove_param( 'vc_separator', 'align' );
	vc_remove_param( 'vc_column_text', 'css_animation' );
	vc_remove_param( 'vc_gmaps', 'title' );
	vc_remove_param( 'vc_progress_bar', 'title' );
	vc_remove_param( 'vc_progress_bar', 'bgcolor' );
	vc_remove_param( 'vc_progress_bar', 'custombgcolor' );
	vc_remove_param( 'vc_progress_bar', 'options' );
	vc_remove_element( 'vc_button' );
	vc_remove_element( 'vc_button2' );
	vc_remove_element( 'vc_cta_button' );
	vc_remove_element( 'vc_cta_button2' );

	if ( defined( 'WPCF7_VERSION' ) ) { // contact form 7
		vc_remove_param( 'contact-form-7', 'title' );
	}
}

/* Disable front end editor */
if ( function_exists( 'vc_disable_frontend' ) ) {
	vc_disable_frontend();
}

if ( ! function_exists( 'single_file_settings_field' ) ) {
	/**
	 * We will create a custom attribute for videos & images
	 */
	function single_file_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		$output = '<div class="single_file_block">';
		$output .= '<input type="text" class="wpb_vc_param_value wpb-textinput '
			. $settings['param_name'].' '
			. $settings['type'].'_field" name="'
			. $settings['param_name'] . '" id="" value="' . esc_url( $value ) . '" ' . $dependency . '>';
		$output .= '<br><br>';
		$output .= '<a href="#" class="button wolf-options-reset-file">' . __( 'Clear', 'wolf' ) . '</a>';
		$output .= '<a href="#" class="button wolf-options-set-file">' . __( 'Choose a file', 'wolf' ) . '</a>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode_param( 'single_file', 'single_file_settings_field' );
}

if ( ! function_exists( 'single_image_settings_field' ) ) {
	/**
	 * Another custom attribute for a single image
	 *
	 * We will use it for background image
	 *
	 */
	function single_image_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		$img = null;
		$output = '<div class="single_image_block">';
		$output .= '<input type="hidden" class="wpb_vc_param_value wpb-textinput '
			. $settings['param_name'] . ' '
			. $settings['type'].'_field" name="'
			. $settings['param_name'] . '" id="" value="' . absint( $value ) . '" ' . $dependency . '>';
		$output .= '<img ';

		if ( ! $value ) {
			$output .= 'style="display:none;"';

		} else {
			$img = wolf_get_url_from_attachment_id( absint( $value ), 'thumbnail' );
		}

		$output .= ' class="wolf-options-img-preview" src="' . esc_url( $img ) .'" alt="' . $settings['param_name'] . '">';

		$output .= '<br>';
		$output .= '<a href="#" class="button wolf-options-reset-img">' . __( 'Clear', 'wolf' ) . '</a>';
		$output .= '<a href="#" class="button wolf-options-set-img">' . __( 'Choose an image', 'wolf' ) . '</a>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode_param( 'single_image', 'single_image_settings_field' );
}

if ( ! function_exists( 'searchable_settings_field' ) ) {
	/**
	 * We will create a custom attribute for videos & images
	 */
	function searchable_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		//var_dump($value);
		$output = '<div class="searchable_block">';
		$output .= '<select class="wpb_vc_param_value wolf-searchable '
			. $settings['param_name'].' '
			. $settings['type'].'_field" name="'
			. $settings['param_name'] . '" id="" value="' . $value . '" ' . $dependency . '>';
		foreach ( $settings['value'] as $k => $v ) {
			$selected = ( $v == $value ) ? ' selected="selected"' : '';
			$output .= "<option value='$v'$selected>$k</option>";
		}
		$output .= '</select>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode_param( 'searchable', 'searchable_settings_field' );
}

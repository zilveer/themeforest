<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_image_attachment_add_custom_fields' ) ) {
	/**
	 * Add custom field to attachment to customize mosaic gallery
	 */
	function wolf_image_attachment_add_custom_fields( $form_fields, $post ) {

		/* Image disposition */
		$field_value = get_post_meta( $post->ID, 'wolf_custom_size', true );

		$form_fields['wolf_custom_size'] = array(
			'label' => __( 'Custom Size', 'wolf' ),
			'input' => 'html',
			'helps' => __( 'This settings will be applied for the "mosaic gallery" only.', 'wolf' ),
			'application' => 'image',
			'exclusions'   => array( 'audio', 'video' ),
		);

		$selected = 'selected="selected"';
		$options = array(
			'small-square' => __( 'Small Square', 'wolf' ),
			'big-square' => __( 'Big Square', 'wolf' ),
			'portrait' => __( 'portrtait', 'wolf' ),
			'landscape' => __( 'landscape', 'wolf' ),

		);

		$html = '<select name="attachments[' . $post->ID . '][wolf_custom_size]">';

		// Browse and add the options
		foreach ( $options as $k => $v ) {
			// Set the option selected or not
			if ( $field_value == $k )
				$selected = ' selected="selected"';
			else
				$selected = '';

			$html .= '<option' . $selected . ' value="' . $k . '">' . $v . '</option>';
		}

		$html .= '</select>';


		$form_fields['wolf_custom_size']['html'] = $html;

		/* Image position */
		$field_value = get_post_meta( $post->ID, 'wolf_custom_position', true );

		$form_fields["wolf_custom_position"] = array(
			'label' => __( 'Position', 'wolf' ),
			'input' => 'html',
			'helps' => __( 'This settings will be applied for the "mosaic gallery" only.', 'wolf' ),
			'application' => 'image',
			'exclusions'   => array( 'audio', 'video' ),
		);

		$selected = 'selected="selected"';

		$options = array(
			'center center' => 'center center',
			'center top' => 'center top',
			'left top' => 'left top',
			'right top' => 'right top',
			'center bottom' => 'center bottom',
			'left bottom' => 'left bottom',
			'right bottom' => 'right bottom',
			'left center' => 'left center',
			'right center' => 'right center',
		);

		$html = '<select name="attachments[' . $post->ID . '][wolf_custom_position]">';

		// Browse and add the options
		foreach ( $options as $k => $v ) {
			// Set the option selected or not
			if ( $field_value == $k )
				$selected = ' selected="selected"';
			else
				$selected = '';

			$html .= '<option' . $selected . ' value="' . $k . '">' . $v . '</option>';
		}

		$html .= '</select>';

		$form_fields['wolf_custom_position']['html'] = $html;

		return $form_fields;
	}
	// add_filter( 'attachment_fields_to_edit', 'wolf_image_attachment_add_custom_fields', null, 2);
}


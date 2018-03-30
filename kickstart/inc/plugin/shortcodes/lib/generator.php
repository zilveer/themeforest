<?php

	// Start WordPress
	require_once( '../../../../../../../wp-load.php' );

	// Capability check
	if ( !current_user_can( 'author' ) && !current_user_can( 'editor' ) && !current_user_can( 'administrator' ) )
		die( 'Access denied' );

	// Param check
	if ( empty( $_GET['shortcode'] ) )
		die( 'Shortcode not specified' );

	$shortcode = su_shortcodes( $_GET['shortcode'] );
	$return = '';

	// Shortcode has atts
	if ( count( $shortcode['atts'] ) && $shortcode['atts'] ) {
		foreach ( $shortcode['atts'] as $attr_name => $attr_info ) {
			$return .= '<p>';
			$return .= '<label for="su-generator-attr-' . $attr_name . '">' . $attr_info['desc'] . '</label>';

			// Select
			if ( count( $attr_info['values'] ) && $attr_info['values'] ) {
				$return .= '<select name="' . $attr_name . '" id="su-generator-attr-' . $attr_name . '" class="su-generator-attr">';
				foreach ( $attr_info['values'] as $attr_value ) {
					$attr_value_selected = ( $attr_info['default'] == $attr_value ) ? ' selected="selected"' : '';
					$return .= '<option' . $attr_value_selected . '>' . $attr_value . '</option>';
				}
				$return .= '</select>';
			}

			// Text & color input
			else {

				// Color picker
				if ( !empty($attr_info['type']) && ($attr_info['type'] == 'color') ) {
					$return .= '<span class="su-generator-select-color"><input type="text" name="' . $attr_name . '" value="' . $attr_info['default'] . '" id="su-generator-attr-' . $attr_name . '" class="su-generator-attr su-generator-select-color-value" /></span>';
				}
				elseif ( !empty($attr_info['type']) && ($attr_info['type'] == 'icon') ) {
					$return .= '<span class="su-generator-select-icon"><input type="text" name="' . $attr_name . '" value="' . $attr_info['default'] . '" id="su-generator-attr-' . $attr_name . '" class="su-generator-attr su-generator-select-icon-value" /><input name="add-icon-button" type="submit" class="add-icon-button button button-primary" value="Add icon"></span>';
				}

				// Text input
				else {
					$return .= '<input type="text" name="' . $attr_name . '" value="' . $attr_info['default'] . '" id="su-generator-attr-' . $attr_name . '" class="su-generator-attr" />';
				}
			}
			$return .= '</p>';
		}
	}

	// Single shortcode (not closed)
	if ( $shortcode['type'] == 'single' ) {
		$return .= '<input type="hidden" name="su-generator-content" id="su-generator-content" value="false" />';
	}

	// Wrapping shortcode
	else {
		$return .= '<p><label>Content</label><input type="text" name="su-generator-content" id="su-generator-content" value="' . $shortcode['content'] . '" /></p>';
	}

	$return .= '<p><a href="#" class="button button-primary button-large" id="su-generator-insert">Insert</a></p>';

	$return .= '<input type="hidden" name="su-generator-result" id="su-generator-result" value="" />';

	echo $return;
?>
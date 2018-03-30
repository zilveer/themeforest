<?php

/* Text */
add_filter( 'mpcth_of_sanitize_text', 'mpcth_of_sanitize_textarea' );
add_filter( 'mpcth_of_sanitize_text-big', 'mpcth_of_sanitize_textarea' );

/* Textarea */
function mpcth_of_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}

add_filter( 'mpcth_of_sanitize_slider', 'mpcth_of_sanitize_slider' );
function mpcth_of_sanitize_slider($input) {
	return $input;
}

add_filter( 'mpcth_of_sanitize_textarea', 'mpcth_of_sanitize_textarea' );
add_filter( 'mpcth_of_sanitize_textarea-big', 'mpcth_of_sanitize_textarea' );

/* Select */
add_filter( 'mpcth_of_sanitize_select', 'mpcth_of_sanitize_enum', 10, 2);

/* Radio */
add_filter( 'mpcth_of_sanitize_radio', 'mpcth_of_sanitize_enum', 10, 2);

/* Sidebar */
add_filter( 'mpcth_of_sanitize_sidebar', 'mpcth_of_sanitize_enum', 10, 2);

/* Images */
function mpcth_of_sanitize_images( $input ) {
	return $input;
}
add_filter( 'mpcth_of_sanitize_images', 'mpcth_of_sanitize_enum', 10, 2);

/* Checkbox */
function mpcth_of_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
add_filter( 'mpcth_of_sanitize_checkbox', 'mpcth_of_sanitize_checkbox' );

/* Multicheck */
function mpcth_of_sanitize_multicheck( $input, $option ) {
	$output = '';
	if ( is_array( $input ) ) {
		foreach( $option['options'] as $key => $value ) {
			$output[$key] = "0";
		}
		foreach( $input as $key => $value ) {
			if ( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = "1";
			}
		}
	}
	return $output;
}
add_filter( 'mpcth_of_sanitize_multicheck', 'mpcth_of_sanitize_multicheck', 10, 2 );

/* Color Picker */
add_filter( 'mpcth_of_sanitize_color', 'mpcth_of_sanitize_hex' );

/* Uploader */
function mpcth_of_sanitize_upload( $input ) {
	$output = '';
	$filetype = wp_check_filetype($input);
	if ( $filetype["ext"] ) {
		$output = $input;
	}
	return $output;
}
add_filter( 'mpcth_of_sanitize_upload', 'mpcth_of_sanitize_upload' );

/* Font Uploader */
function mpcth_of_sanitize_font_upload( $input ) {
	return $input;
}
add_filter( 'mpcth_of_sanitize_font_upload', 'mpcth_of_sanitize_font_upload' );

/* Editor */
function mpcth_of_sanitize_editor($input) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		$output = $input;
	} else {
		global $allowedtags;
		$output = wpautop(wp_kses( $input, $allowedtags));
	}
	return $output;
}
add_filter( 'mpcth_of_sanitize_editor', 'mpcth_of_sanitize_editor' );

/* Allowed Tags */
function mpcth_of_sanitize_allowedtags($input) {
	global $allowedtags;
	$output = wpautop(wp_kses( $input, $allowedtags));
	return $output;
}

/* Allowed Post Tags */
function mpcth_of_sanitize_allowedposttags($input) {
	global $allowedposttags;
	$output = wpautop(wp_kses( $input, $allowedposttags));
	return $output;
}

add_filter( 'mpcth_of_sanitize_info', 'mpcth_of_sanitize_allowedposttags' );

/* Check that the key value sent is valid */
function mpcth_of_sanitize_enum( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option['options'] ) ) {
		$output = $input;
	}
	return $output;
}

/* Font Select */
/* Check that the key value sent is valid */
function mpcth_of_sanitize_font_select( $input ) {
	return $input;
}

add_filter( 'mpcth_of_sanitize_font_select', 'mpcth_of_sanitize_font_select', 10, 1);

/* Font Select */
/* Check that the key value sent is valid */
function mpcth_of_sanitize_custom_fonts( $input ) {
	return $input;
}

add_filter( 'mpcth_of_sanitize_custom_fonts', 'mpcth_of_sanitize_custom_fonts', 10, 1);

/* Background */
function mpcth_of_sanitize_background( $input ) {
	$output = wp_parse_args( $input, array(
		'color' => '',
		'image'  => '',
		'repeat'  => 'repeat',
		'position' => 'top center',
		'attachment' => 'scroll'
	) );

	$output['color'] = apply_filters( 'mpcth_of_sanitize_hex', $input['color'] );
	$output['image'] = apply_filters( 'mpcth_of_sanitize_upload', $input['image'] );
	$output['repeat'] = apply_filters( 'mpcth_of_background_repeat', $input['repeat'] );
	$output['position'] = apply_filters( 'mpcth_of_background_position', $input['position'] );
	$output['attachment'] = apply_filters( 'mpcth_of_background_attachment', $input['attachment'] );

	return $output;
}
add_filter( 'mpcth_of_sanitize_background', 'mpcth_of_sanitize_background' );

function mpcth_of_sanitize_background_repeat( $value ) {
	$recognized = mpcth_of_recognized_background_repeat();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mpcth_of_default_background_repeat', current( $recognized ) );
}
add_filter( 'mpcth_of_background_repeat', 'mpcth_of_sanitize_background_repeat' );

function mpcth_of_sanitize_background_position( $value ) {
	$recognized = mpcth_of_recognized_background_position();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mpcth_of_default_background_position', current( $recognized ) );
}
add_filter( 'mpcth_of_background_position', 'mpcth_of_sanitize_background_position' );

function mpcth_of_sanitize_background_attachment( $value ) {
	$recognized = mpcth_of_recognized_background_attachment();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mpcth_of_default_background_attachment', current( $recognized ) );
}
add_filter( 'mpcth_of_background_attachment', 'mpcth_of_sanitize_background_attachment' );

/* Typography */
function mpcth_of_sanitize_typography( $input, $option ) {
	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'color' => ''
	) );

	if ( isset( $option['options']['faces'] ) && isset( $input['face'] ) ) {
		if ( !( array_key_exists( $input['face'], $option['options']['faces'] ) ) ) {
			$output['face'] = '';
		}
	}
	else {
		$output['face']  = apply_filters( 'mpcth_of_font_face', $output['face'] );
	}

	$output['size']  = apply_filters( 'mpcth_of_font_size', $output['size'] );
	$output['style'] = apply_filters( 'mpcth_of_font_style', $output['style'] );
	$output['color'] = apply_filters( 'mpcth_of_sanitize_color', $output['color'] );
	return $output;
}

add_filter( 'mpcth_of_sanitize_typography', 'mpcth_of_sanitize_typography', 10, 2 );

function mpcth_of_sanitize_font_size( $value ) {
	$recognized = mpcth_of_recognized_font_sizes();
	$value_check = preg_replace('/px/','', $value);
	if ( in_array( (int) $value_check, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mpcth_of_default_font_size', $recognized );
}
add_filter( 'mpcth_of_font_size', 'mpcth_of_sanitize_font_size' );

function mpcth_of_sanitize_font_style( $value ) {
	$recognized = mpcth_of_recognized_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mpcth_of_default_font_style', current( $recognized ) );
}
add_filter( 'mpcth_of_font_style', 'mpcth_of_sanitize_font_style' );

function mpcth_of_sanitize_font_face( $value ) {
	$recognized = mpcth_of_recognized_font_faces();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mpcth_of_default_font_face', current( $recognized ) );
}
add_filter( 'mpcth_of_font_face', 'mpcth_of_sanitize_font_face' );

/**
 * Get recognized background repeat settings
 *
 * @return   array
 *
 */
function mpcth_of_recognized_background_repeat() {
	$default = array(
		'no-repeat' => __('No Repeat', 'mpcth'),
		'repeat-x'  => __('Repeat Horizontally', 'mpcth'),
		'repeat-y'  => __('Repeat Vertically', 'mpcth'),
		'repeat'    => __('Repeat All', 'mpcth'),
		);
	return apply_filters( 'mpcth_of_recognized_background_repeat', $default );
}

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function mpcth_of_recognized_background_position() {
	$default = array(
		'top left'      => __('Top Left', 'mpcth'),
		'top center'    => __('Top Center', 'mpcth'),
		'top right'     => __('Top Right', 'mpcth'),
		'center left'   => __('Middle Left', 'mpcth'),
		'center center' => __('Middle Center', 'mpcth'),
		'center right'  => __('Middle Right', 'mpcth'),
		'bottom left'   => __('Bottom Left', 'mpcth'),
		'bottom center' => __('Bottom Center', 'mpcth'),
		'bottom right'  => __('Bottom Right', 'mpcth')
		);
	return apply_filters( 'mpcth_of_recognized_background_position', $default );
}

/**
 * Get recognized background attachment
 *
 * @return   array
 *
 */
function mpcth_of_recognized_background_attachment() {
	$default = array(
		'scroll' => __('Scroll Normally', 'mpcth'),
		'fixed'  => __('Fixed in Place', 'mpcth')
		);
	return apply_filters( 'mpcth_of_recognized_background_attachment', $default );
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 *
 */
function mpcth_of_sanitize_hex( $hex, $default = '' ) {
	if ( mpcth_of_validate_hex( $hex ) ) {
		return $hex;
	}
	return $default;
}

/**
 * Get recognized font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return   array
 */
function mpcth_of_recognized_font_sizes() {
	$sizes = range( 9, 71 );
	$sizes = apply_filters( 'mpcth_of_recognized_font_sizes', $sizes );
	$sizes = array_map( 'absint', $sizes );
	return $sizes;
}

/**
 * Get recognized font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function mpcth_of_recognized_font_faces() {
	$default = array(
		'arial'     => 'Arial',
		'verdana'   => 'Verdana, Geneva',
		'trebuchet' => 'Trebuchet',
		'georgia'   => 'Georgia',
		'times'     => 'Times New Roman',
		'tahoma'    => 'Tahoma, Geneva',
		'palatino'  => 'Palatino',
		'helvetica' => 'Helvetica*'
		);
	return apply_filters( 'mpcth_of_recognized_font_faces', $default );
}

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function mpcth_of_recognized_font_styles() {
	$default = array(
		'normal'      => __('Normal', 'mpcth'),
		'italic'      => __('Italic', 'mpcth'),
		'bold'        => __('Bold', 'mpcth'),
		'bold italic' => __('Bold Italic', 'mpcth')
		);
	return apply_filters( 'mpcth_of_recognized_font_styles', $default );
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 *
 */
function mpcth_of_validate_hex( $hex ) {
	$hex = trim( $hex );
	/* Strip recognized prefixes. */
	if ( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	} elseif ( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}
	/* Regex match. */
	if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	} else {
		return true;
	}
}
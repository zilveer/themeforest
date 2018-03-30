<?php
/**
 * PixCodes Compatibility File.
 *
 * @link https://wordpress.org/plugins/pixcodes/
 *
 * @package Pile
 * @since Pile 2.0
 */

/**
 * Add a list of shortcodes required
 */
function pile_callbacks_setup_shortcodes_plugin() {
	$current_options = get_option( 'wpgrade_shortcodes_list' );

	$shortcodes = array(
		'Columns',
		'Button',
		'Icon',
		'Tabs',
		'Separator',
		'Slider',
	);

	// create an array with shortcodes which are needed by the
	// current theme
	if ( $current_options ) {
		$diff_added   = array_diff( $shortcodes, $current_options );
		$diff_removed = array_diff( $current_options, $shortcodes );
		if ( ( ! empty( $diff_added ) || ! empty( $diff_removed ) ) && is_admin() ) {
			update_option( 'wpgrade_shortcodes_list', $shortcodes );
		}
	} else { // there is no current shortcodes list
		update_option( 'wpgrade_shortcodes_list', $shortcodes );
	}

	// we need to remember the prefix of the metaboxes so it can be used
	// by the shortcodes plugin
	$current_prefix = get_option( 'wpgrade_metaboxes_prefix' );
	if ( empty( $current_prefix ) ) {
		update_option( 'wpgrade_metaboxes_prefix', '_pile_' );
	}
}
add_action( 'admin_head', 'pile_callbacks_setup_shortcodes_plugin' );


/**
 * hook shortcodes params
 */

add_filter( 'pixcodes_filter_params_for_separator', 'pile_callback_change_separator_params', 10, 1 );

function pile_callback_change_separator_params( $params ) {
	//we only need alignment, color and style

	// unset unneeded params
	if ( isset( $params['style'] ) ) {
		unset( $params['style'] );
	}
	if ( isset( $params['align'] ) ) {
		unset( $params['align'] );
	}
	if ( isset( $params['size'] ) ) {
		unset( $params['size'] );
	}
	if ( isset( $params['weight'] ) ) {
		unset( $params['weight'] );
	}

	return $params;
}
add_filter( 'pixcodes_filter_params_for_button', 'pile_callback_change_button_params', 10, 1 );

function pile_callback_change_button_params( $params ) {

	// unset unneeded params
	if ( isset( $params['text_size'] ) ) {
		unset( $params['text_size'] );
	}

	if ( isset( $params['size'] ) ) {
		unset( $params['size'] );
	}

	return $params;
}


add_filter( 'pixcodes_filter_params_for_columns', 'pile_callback_remove_columns_params', 10, 1 );

function pile_callback_remove_columns_params( $params ) {

	// unset unneeded params
	if ( isset( $params['full_width'] ) ) {
		unset( $params['full_width'] );
	}

	if ( isset( $params['bg_color'] ) ) {
		unset( $params['bg_color'] );
	}

	if ( isset( $params['inner'] ) ) {
		unset( $params['inner'] );
	}

	if ( isset( $params[0] ) ) {
		unset( $params[0] );
	}

	if ( isset( $params['inner_info'] ) ) {
		unset( $params['inner_info'] );
	}

	return $params;
}


add_filter( 'pixcodes_filter_params_for_icon', 'pile_callback_change_icon_params', 10, 1 );

function pile_callback_change_icon_params( $params ) {

	//add new params in the right order
	$params = pile_array_insert_after( 'size', $params, 'link', array(
		'type'        => 'text',
		'name'        => 'Link',
		'options'     => array(),
		'admin_class' => 'span6'
	) );

	$params = pile_array_insert_after( 'link', $params, 'link_target_blank', array(
		'type'        => 'switch',
		'name'        => 'Open in new window',
		'options'     => array(),
		'admin_class' => 'span3 push3'
	) );

	return $params;
}
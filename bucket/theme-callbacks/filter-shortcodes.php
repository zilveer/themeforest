<?php
/**
 * hook shortcodes params
 */

add_filter('pixcodes_filter_params_for_separator', 'wpgrade_callback_remove_separator_params', 10, 1);
function wpgrade_callback_remove_separator_params( $params ){
	//unset unneeded params and keep only the style one
	if ( isset( $params['style'] )) {
		$params['style']['admin_class'] = '';
		return array('style' =>  $params['style']);
	}
	return $params;
}

add_filter('pixcodes_filter_params_for_columns', 'wpgrade_callback_remove_columns_params', 10, 1);
function wpgrade_callback_remove_columns_params( $params ){

	// unset unneeded params
	if ( isset( $params['full_width'] )) {
		unset($params['full_width']);
	}

	return $params;
}
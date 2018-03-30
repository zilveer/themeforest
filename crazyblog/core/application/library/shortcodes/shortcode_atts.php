<?php

$method = get_class_methods( get_class() );
$func = crazyblog_set( $method, '0' );
$get_array = self::$func( 'crazyblog_Shortcodes_Map' );
$get_params = crazyblog_set( $get_array, 'params' );
$create_array = array();
$temp = '';
include crazyblog_ROOT . 'core/application/library/shortcodes_default_attr.php';
$get_params = array_merge( $get_params, $shortcode_section );
foreach ( $get_params as $param ) {
	if ( array_key_exists( 'value', $param ) ) {
		if ( crazyblog_set( $param, 'type' ) == 'checkbox' ) {
			$param['value'] = '';
		}
		$temp_val = crazyblog_set( $param, 'value' );
		if ( is_array( $temp_val ) ) {
			$temp = array_shift( $temp_val );
		} else {
			$temp = $temp_val;
		}
	} else {
		$temp = '';
	}
	$create_array[crazyblog_set( $param, 'param_name' )] = $temp;
}

$values = wp_parse_args( $atts, $create_array );
extract( $values );

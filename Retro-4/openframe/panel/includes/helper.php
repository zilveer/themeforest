<?php
/*
*	openframe
*	written by stefano giliberti (stfno@me.com),
*	opendept.net
*/

function op_panel_opt_selected( $option_name, $key ) {
	$option_value = op_theme_opt( $option_name );
	echo is_array( $option_value ) && in_array( $key, $option_value ) || $option_value == $key ? 'selected="selected"' : null;
}

function op_panel_opt_checked( $option_name ) {
	echo op_theme_opt( $option_name ) == $option_name ? 'checked="checked"' : null;
}

function op_panel_opt_store_do() {
	check_ajax_referer( 'op-panel-ajax', 'referer' );
	$form_contents = $_POST;
	unset( $form_contents['action'], $form_contents['referer'] );	
	$current_options = get_option( op_config( 'theme' ) );
	if ( update_option( op_config( 'theme' ), $form_contents ) )  {
		$response = ':)';
	}
	else {
		$response = ':(';
	}
	die( $response );
}

add_action( 'wp_ajax_op_panel_opt_store', 'op_panel_opt_store_do' );

?>
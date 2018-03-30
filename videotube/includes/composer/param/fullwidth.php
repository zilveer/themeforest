<?php
if( !function_exists( 'mars_add_vc_column_param_fullwidth' ) ){
	
	function mars_add_vc_column_param_fullwidth(){
		if( !function_exists( 'vc_add_param' ) ) return;
		$attributes = array(
			'type' => 'checkbox',
			'heading' => '',
			'param_name' => 'fullwidth',
			'value' => array(
				__('Fullwidth (no wrapper)','mars') 	=>	'on'
			)
		);
		vc_add_param('vc_column', $attributes);
	}	
	add_action( 'init' , 'mars_add_vc_column_param_fullwidth');
}
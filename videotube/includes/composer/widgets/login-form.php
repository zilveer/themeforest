<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_vc_login_form' ) ){
	function mars_vc_login_form() {
		// add the shortcode.
		add_shortcode( 'mars_vc_login_form' , 'mars_vc_login_form_shortcode');
		// map the widget.
		if( !function_exists( 'vc_map' ) )
			return;
		$args = array(
			'name'	=>	__('VT Login Widget','mars'),
			'base'	=>	'mars_vc_login_form',
			'category'	=>	__('WordPress Widgets','mars'),
			'class'	=>	'videotube',
			'icon'	=>	'videotube',
			'description'	=>	__('Display the Login Form Widget.','mars'),
			'admin_enqueue_css' => array(get_template_directory_uri().'/assets/css/vc.css'),
			'params'	=>	array(
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Title','mars'),
					'param_name'	=>	'title',
					'value'	=>	__('Profile','mars')
				),
				array(
					'type'	=>	'dropdown',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Video Upload Page','mars'),
					'param_name'	=>	'uploader_url',
					'value'	=>mars_get_page_array()
				),
				array(
					'type'	=>	'dropdown',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Profile Page','mars'),
					'param_name'	=>	'profile_url',
					'value'	=>mars_get_page_array()
				),					
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'mars' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'mars' )
				)
			)
		);
		vc_map( $args );		
	}
	add_action( 'init' , 'mars_vc_login_form');
}

if( !function_exists( 'mars_vc_login_form_shortcode' ) ){
	/**
	 * call the widget
	 * @param unknown_type $atts
	 * @param unknown_type $content
	 * @return string
	 */
	function mars_vc_login_form_shortcode( $atts, $content = null ) {
		$output = $title = $el_class = '';
		extract( shortcode_atts( array(
			'title' => '',
			'uploader_url'	=>	'',
			'profile_url'	=>	'',
			'el_class' => ''
		), $atts ) );
		
		ob_start();
		the_widget( 'Mars_LoginForm_Widget_Class', $atts, array() );
			$output .= ob_get_clean();
		return $output;
	}
}

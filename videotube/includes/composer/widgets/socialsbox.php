<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_vc_socialsbox' ) ){
	function mars_vc_socialsbox() {
		// add the shortcode.
		add_shortcode( 'mars_vc_socialsbox' , 'mars_vc_socialsbox_shortcode');
		// map the widget.
		if( !function_exists( 'vc_map' ) )
			return;
		$args = array(
			'name'	=>	__('VT Socials Box','mars'),
			'base'	=>	'mars_vc_socialsbox',
			'category'	=>	__('WordPress Widgets','mars'),
			'class'	=>	'videotube',
			'icon'	=>	'videotube',
			'description'	=>	__('Display the Social count box.','mars'),
			'admin_enqueue_css' => array(get_template_directory_uri().'/assets/css/vc.css'),
			'params'	=>	array(
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Title','mars'),
					'param_name'	=>	'title'
				)				
			)
		);
		vc_map( $args );		
	}
	add_action( 'init' , 'mars_vc_socialsbox');
}

if( !function_exists( 'mars_vc_socialsbox_shortcode' ) ){
	/**
	 * call the widget
	 * @param unknown_type $atts
	 * @param unknown_type $content
	 * @return string
	 */
	function mars_vc_socialsbox_shortcode( $atts, $content = null ) {
		$output = $title = $el_class = '';
		extract( shortcode_atts( array(
			'title' => '',
			'el_class' => ''
		), $atts ) );
		
		ob_start();
		the_widget( 'Mars_Subscribox_Widget_Class', $atts, array() );
			$output .= ob_get_clean();
		return $output;
	}
}

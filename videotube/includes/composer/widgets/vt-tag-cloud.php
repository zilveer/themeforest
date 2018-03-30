<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_vc_vt_tag_cloud' ) ){
	function mars_vc_vt_tag_cloud() {
		// add the shortcode.
		add_shortcode( 'mars_vc_vt_tag_cloud' , 'mars_vc_vt_tag_cloud_shortcode');
		// map the widget.
		if( !function_exists( 'vc_map' ) )
			return;
		$args = array(
			'name'	=>	__('VT Tag Cloud','mars'),
			'base'	=>	'mars_vc_vt_tag_cloud',
			'category'	=>	__('WordPress Widgets','mars'),
			'class'	=>	'videotube',
			'icon'	=>	'videotube',
			'description'	=>	__('Display the Tags Cloud (Popular Keys) Widget.','mars'),
			'admin_enqueue_css' => array(get_template_directory_uri().'/assets/css/vc.css'),
			'params'	=>	array(
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Title','mars'),
					'param_name'	=>	'title'
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Taxonomies','mars'),
					'param_name'	=>	'taxonomy',
					'value'	=>	'post_tag,video_tag',
					'description'	=>	__('Separated by commas(,)','mars')
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Smallest Size','mars'),
					'param_name'	=>	'smallest'
				),	
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Largest Size','mars'),
					'param_name'	=>	'largest'
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Nmber Size','mars'),
					'param_name'	=>	'number'
				)					
			)
		);
		vc_map( $args );
	}
	add_action( 'init' , 'mars_vc_vt_tag_cloud');
}

if( !function_exists( 'mars_vc_vt_tag_cloud_shortcode' ) ){
	/**
	 * call the widget
	 * @param unknown_type $atts
	 * @param unknown_type $content
	 * @return string
	 */
	function mars_vc_vt_tag_cloud_shortcode( $atts, $content = null ) {
		$output = $title = $el_class = '';
		extract( shortcode_atts( array(
			'title' => '',
			'taxonomy'	=>	'post_tag,video_tag',
			'smallest'	=>	8,
			'largest'	=>	15,
			'number'	=>	20,
			'el_class' => ''
		), $atts ) );
		
		ob_start();
		the_widget( 'Mars_KeyCloud_Widgets_Class', $atts, array() );
			$output .= ob_get_clean();
		return $output;
	}
}

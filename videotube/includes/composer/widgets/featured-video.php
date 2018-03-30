<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_vc_featured_videos' ) ){
	function mars_vc_featured_videos() {
		// add the shortcode.
		add_shortcode( 'mars_vc_featured_videos' , 'mars_vc_featured_videos_shortcode');
		// map the widget.
		if( !function_exists( 'vc_map' ) )
			return;
		$args = array(
			'name'	=>	__('Featured Video Widget','mars'),
			'base'	=>	'mars_vc_featured_videos',
			'category'	=>	__('VideoTube','mars'),
			'class'	=>	'videotube',
			'icon'	=>	'videotube',
			'description'	=>	__('Display the Featured Video Widget.','mars'),
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
					'type'	=>	'checkbox',
					'param_name'	=>	'hide_if_empty',
					'value'	=>array( __('Hide if empty','mars') => 1 )	
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
	add_action( 'init' , 'mars_vc_featured_videos');
}

if( !function_exists( 'mars_vc_featured_videos_shortcode' ) ){
	/**
	 * call the widget
	 * @param unknown_type $atts
	 * @param unknown_type $content
	 * @return string
	 */
	function mars_vc_featured_videos_shortcode( $atts, $content = null ) {
		$output = $title = $el_class = '';
		extract( shortcode_atts( array(
			'title' => '',
			'el_class' => ''
		), $atts ) );
		
		ob_start();
		the_widget( 'Mars_FeaturedVideos_Widgets_Class', $atts, array() );
		$output = '<div class="vt_featured '.$el_class.'">';
			$output .= ob_get_clean();
		$output .= '</div>';
		return $output;
	}
}
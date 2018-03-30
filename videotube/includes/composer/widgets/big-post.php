<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_vc_big_post' ) ){
	function mars_vc_big_post() {
		$image_sizes = array();
		global $_wp_additional_image_sizes;
		if( is_array( $_wp_additional_image_sizes ) ){
			foreach ( $_wp_additional_image_sizes  as $key=>$value) {
				$image_sizes[]	=	$key;
			}
		}
		$image_sizes = !empty( $image_sizes ) ? implode(", ", $image_sizes) : null;
		// add the shortcode.
		add_shortcode( 'mars_vc_big_post' , 'mars_vc_big_post_shortcode');
		// map the widget.
		if( !function_exists( 'vc_map' ) )
			return;
		$args = array(
			'name'	=>	__('VT Big Post','mars'),
			'base'	=>	'mars_vc_big_post',
			'category'	=>	__('VideoTube','mars'),
			'class'	=>	'videotube',
			'icon'	=>	'videotube',
			'description'	=>	__('Display the One Big Post.','mars'),
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
					'heading'	=>	__('Video/Post ID','mars'),
					'param_name'	=>	'video_id',
					'description'	=>	__('Put the Post/Video ID','mars')
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Thumbnail Image Size','mars'),
					'param_name'	=>	'thumbnail_size',
					'description' => sprintf( __( 'Enter image size. Example: thumbnail, medium, large, full, %s. Leave empty to use "blog-large-thumb" size.', 'mars' )	, $image_sizes ) 					
				),					
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('View more url','mars'),
					'param_name'	=>	'view_more',
					'description'	=>	__('You can link this to the archive page or something else, or put "#" for default.','mars')
				)					
			)
		);
		vc_map( $args );		
	}
	add_action( 'init' , 'mars_vc_big_post');
}

if( !function_exists( 'mars_vc_big_post_shortcode' ) ){
	/**
	 * call the widget
	 * @param unknown_type $atts
	 * @param unknown_type $content
	 * @return string
	 */
	function mars_vc_big_post_shortcode( $atts, $content = null ) {
		$output = $title = $el_class = '';
		extract( shortcode_atts( array(
			'title' => '',
			'video_id'	=>	'',
			'thumbnail_size'	=>	'blog-large-thumb',
			'view_more'	=>	'',
			'el_class' => ''
		), $atts ) );
		
		ob_start();
		the_widget( 'Mars_OneBigVideo_Widgets_Class', $atts, array() );
			$output .= ob_get_clean();
		return $output;
	}
}


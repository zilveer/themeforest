<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_vc_post1col' ) ){
	function mars_vc_post1col() {
		// add the shortcode.
		add_shortcode( 'mars_vc_post1col' , 'mars_vc_post1col_shortcode');
		// map the widget.
		if( !function_exists( 'vc_map' ) )
			return;
		global $_wp_additional_image_sizes;
		$image_size = array();
		if( is_array( $_wp_additional_image_sizes ) ){
			foreach ($_wp_additional_image_sizes as $k=>$v) {
				$image_size[]	=	$k;
			}
		}		
		$args = array(
			'name'	=>	__('Post 1 Column','mars'),
			'base'	=>	'mars_vc_post1col',
			'category'	=>	__('WordPress Widgets','mars'),
			'class'	=>	'videotube',
			'icon'	=>	'videotube',
			'description'	=>	__('Display the 1 Column Post widget.','mars'),
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
					'type'	=>	'fontawesome',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Icon','mars'),
					'param_name'	=>	'icon'
				),					
				array(
					'type'	=>	'dropdown',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Post Type','mars'),
					'param_name'	=>	'post_type',
					'value'	=>array(
						__('Video','mars') 	=>	'video',
						__('Post','mars') 	=>	'post'
					),
					'std'	=>	'video'
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'param_name'	=>	'carousel',
					'value'	=>	array(
						__('Carousel','mars') 	=>	'on'		
					),
					'dependency'	=>	array(
						'element'	=>	'type',
						'value'	=>	'widget'
					)
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'param_name'	=>	'autoplay',
					'value'	=>	array(
						__('Auto Play','mars') 	=>	'on'
					),
					'dependency'	=>	array(
						'element'	=>	'type',
						'value'	=>	'widget'
					)
				),					
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Show Posts','mars'),
					'param_name'	=>	'video_shows',
					'value'	=>	10,
					'description'	=>	__('How many video will be shown?','mars')
				),				
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Rows','mars'),
					'param_name'	=>	'rows',
					'description'	=>	__('How many Rows will be shown?','mars'),
					'value'	=>	1,
					'dependency'	=>	array(
						'element'	=>	'carousel',
						'value'	=>	'on'
					)
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Thumbnail Image Size','mars'),
					'param_name'	=>	'thumbnail_size',
					'description'	=>	 sprintf(__('Enter image size. Example: <strong>%s , thumbnail, medium, large, full</strong> or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "video-featured" size.','mars'), implode(", ",$image_size))
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Video Category','mars'),
					'param_name'	=>	'cat',
					'description'	=>	__('Choose the Video Category or leave for default.','mars'),
					'value'	=>	mars_get_video_category_array( 'categories' ),
					'dependency'	=>	array(
						'element'	=>	'post_type',
						'value'	=>	'video'
					)
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Post Category','mars'),
					'param_name'	=>	'post_category',
					'description'	=>	__('Choose the Post Category or leave for default.','mars'),
					'value'	=>	mars_get_video_category_array( 'category' ),
					'dependency'	=>	array(
						'element'	=>	'post_type',
						'value'	=>	'post'
					)
				),	
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Post Tags','mars'),
					'param_name'	=>	'post_tags',
					'description'	=>	__('Set Post Tag to a comma separated list of Post Tag slug to only show those.','mars'),
					'dependency'	=>	array(
						'element'	=>	'post_type',
						'value'	=>	'post'
					)
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Video Tags','mars'),
					'param_name'	=>	'tag',
					'description'	=>	__('Set Video Tag to a comma separated list of Video Tag ID to only show those.','mars'),
					'dependency'	=>	array(
						'element'	=>	'post_type',
						'value'	=>	'video'
					)						
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('IDs','mars'),
					'param_name'	=>	'ids',
					'description'	=>	__('Set the Video/Post ID to a comma separated list of Video/Post ID to only show those.','mars')					
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Authors','mars'),
					'param_name'	=>	'author',
					'description'	=>	__('Set Author ID to a comma separated list of Video/Post to only show those.','mars')
				),	
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Date','mars'),
					'param_name'	=>	'date',
					'description'	=>	__('Show posts associated with a certain time, (yyyy-mm-dd)','mars')
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'param_name'	=>	'today',
					'value'	=>	array( __('Today','mars')	=>	'on' ),
					'description'	=>	__('Show posts today','mars')
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'param_name'	=>	'thisweek',
					'value'	=>	array( __('This Week','mars')	=>	'on' ),
					'description'	=>	__('Show posts this week','mars')
				),																
				array(
					'type'	=>	'orderby',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Order by','mars'),
					'param_name'	=>	'orderby',
					'description'	=>	__('Order by Views/Likes is not available for the Regular Post.','mars')
				),
				array(
					'type'	=>	'order',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Order','mars'),
					'param_name'	=>	'order'
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'param_name'	=>	'navigation',
					'value'	=>	array( __('Display the Page Navigation.','mars') => 'on' ),
					'dependency'	=>	array(
						'element'	=>	'type',
						'value'	=>	'main'
					)
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
	add_action( 'init' , 'mars_vc_post1col');
}

if( !function_exists( 'mars_vc_post1col_shortcode' ) ){
	/**
	 * call the widget
	 * @param unknown_type $atts
	 * @param unknown_type $content
	 * @return string
	 */
	function mars_vc_post1col_shortcode( $atts, $content = null ) {
		ob_start();
		$output = $title = $el_class = '';
		extract( shortcode_atts( array(
			'title' 			=> '',
			'el_class' 			=> ''
		), $atts ) );
		
		$atts['widget_column']	=	1;
		
		the_widget( 'Mars_MainVideos_Widgets_Class', $atts, array() );
			$output .= ob_get_clean();
		return $output;
	}
}

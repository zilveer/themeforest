<?php

if ( ! function_exists( 'uxbarn_create_theme_custom_elements' ) ) {
	
	function uxbarn_create_theme_custom_elements() {
		
		// Remove some default elements
		if ( function_exists( 'vc_remove_element' ) ) {
			
			//vc_remove_element( 'vc_single_image' ); // will be overridden in the theme
			vc_remove_element( 'vc_posts_grid' );
			vc_remove_element( 'vc_gmaps' );
			
			/*vc_remove_element('vc_wp_search');
			vc_remove_element('vc_wp_meta');
			vc_remove_element('vc_wp_recentcomments');
			vc_remove_element('vc_wp_calendar');
			vc_remove_element('vc_wp_pages');
			vc_remove_element('vc_wp_tagcloud');
			vc_remove_element('vc_wp_custommenu');
			vc_remove_element('vc_wp_text');
			vc_remove_element('vc_wp_posts');
			vc_remove_element('vc_wp_links');
			vc_remove_element('vc_wp_categories');
			vc_remove_element('vc_wp_archives');
			vc_remove_element('vc_wp_rss');*/
			
		}
		
		if ( function_exists( 'vc_map' ) ) {
			
			uxbarn_create_uxb_heading_element();
			uxbarn_create_uxb_button_element();
			uxbarn_create_uxb_icon_element();
			uxbarn_create_uxb_video_element();
			uxbarn_create_uxb_blockquote_element();
			uxbarn_create_uxb_messagebox_element();
			uxbarn_create_uxb_googlemap_element();
			uxbarn_create_uxb_gallery_element();
			uxbarn_create_uxb_divider_element();
			uxbarn_create_uxb_cta_box_element();
			uxbarn_create_uxb_portfolio_element();
			uxbarn_create_uxb_team_member_element();
			uxbarn_create_uxb_testimonial_slider_element();
			uxbarn_create_uxb_blog_posts_element();
			uxbarn_create_uxb_searchform_element();

			uxbarn_create_vc_single_image_element();
			
		}
		
	}

}



function uxbarn_get_icon_field_description() {
	return sprintf( __('<a href="%s" target="_blank">Click here to see all available icons</a>. Just copy and paste the icon code into the text field. For example: <em>"asterisk"</em>. Leave this field blank when not to use icon.', 'uxbarn'), 'http://fontawesome.io/icons/' );	
}



if ( ! function_exists( 'uxbarn_create_uxb_heading_element' ) ) {

	function uxbarn_create_uxb_heading_element() {
		
		vc_map( array(
		   'name' => __('Heading (Custom)', 'uxbarn'),
		   'base' => 'uxb_heading',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Heading text', 'uxbarn'),
				 'param_name' => 'text',
				 'value' => __('Title', 'uxbarn'),
				 'description' => '',
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Type', 'uxbarn'),
				 'param_name' => 'type',
				 'value' => array(
								'H1'=>'h1', 
								'H2'=>'h2',
								'H3'=>'h3',
								'H4'=>'h4',
								'H5'=>'h5',
							),
				 'std'	=> 'h2',
				 'description' => __('Choose the heading type.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Style', 'uxbarn'),
				 'param_name' => 'style',
				 'value' => array(
								__('Default', 'uxbarn') => '', 
								__('Light', 'uxbarn') =>'light',
							),
				 'description' => __('Choose the style.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Alignment', 'uxbarn'),
				 'param_name' => 'alignment',
				 'value' => array(
								__('Left', 'uxbarn') => '', 
								__('Center', 'uxbarn') =>'h-center',
								__('Right', 'uxbarn') =>'h-right',
							),
				 'description' => __('Select text alignment for this heading.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Has line?', 'uxbarn'),
				 'param_name' => 'has_line',
				 'value' => array(
								__('No', 'uxbarn') => 'false', 
								__('Yes', 'uxbarn') =>'true',
							),
				 'std'	=> 'false',
				 'description' => __('Whether to display a line at the bottom of the heading.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Has icon?', 'uxbarn'),
				 'param_name' => 'has_icon',
				 'value' => array(
								__('No', 'uxbarn') => '', 
								__('Yes', 'uxbarn') =>'true',
							),
				 'description' => __('Whether to display the icon before heading text.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Icon code', 'uxbarn'),
				 'param_name' => 'icon',
				 'value' => '',
				 'description' => uxbarn_get_icon_field_description(),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'has_icon',
									'value' => array('true'),
								),
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Icon Size', 'uxbarn'),
				 'param_name' => 'icon_size',
				 'value' => '16',
				 'description' => __('Specify the size number for the icon (px). Only number is allowed.', 'uxbarn'),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'has_icon',
									'value' => array('true'),
								),
			  ),
			  array(
				 'type' => 'colorpicker',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Icon Color', 'uxbarn'),
				 'param_name' => 'icon_color',
				 'value' => '',
				 'description' => __('Choose the color.', 'uxbarn'),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'has_icon',
									'value' => array('true'),
								),
			  ),
			  uxbarn_get_css_animation_param(),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_button_element' ) ) {

	function uxbarn_create_uxb_button_element() {
		
		vc_map( array(
		   'name' => __('Button (Custom)', 'uxbarn'),
		   'base' => 'uxb_button',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  uxbarn_get_button_text(),
			  uxbarn_get_link_param(),
			  uxbarn_get_open_new_window_param(),
			  uxbarn_get_button_color(),
			  uxbarn_get_button_custom_color('button_color', array('custom')),
			  uxbarn_get_button_size(),
			  uxbarn_get_button_border_style(),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Expanded?', 'uxbarn'),
				 'param_name' => 'expanded',
				 'value' => array(
								'No' => '', 
								'Yes'=>'true',
							),
				 'description' => __('Whether to expand the button to fit the width of its containing column.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Bottom right position?', 'uxbarn'),
				 'param_name' => 'bottom_right',
				 'value' => array(
								'No' => '', 
								'Yes'=>'true',
							),
				 'description' => __('Whether to display the button at the bottom right of its containing column.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Display right angle icon?', 'uxbarn'),
				 'param_name' => 'display_angle',
				 'value' => array(
								'No' => '', 
								'Yes'=>'true',
							),
				 'description' => __('Whether to display the right angle icon.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Icon code', 'uxbarn'),
				 'param_name' => 'icon',
				 'value' => '',
				 'description' => uxbarn_get_icon_field_description(),
				 'admin_label' => false,
			  ),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_icon_element' ) ) {

	function uxbarn_create_uxb_icon_element() {
		
		vc_map( array(
		   'name' => __('Icon (Custom)', 'uxbarn'),
		   'base' => 'uxb_icon',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Icon code', 'uxbarn'),
				 'param_name' => 'code',
				 'value' => 'icon-',
				 'description' => uxbarn_get_icon_field_description(),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Size', 'uxbarn'),
				 'param_name' => 'size',
				 'value' => '16',
				 'description' => __('Specify the size number for the icon (px). Only number is allowed.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'colorpicker',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Color', 'uxbarn'),
				 'param_name' => 'color',
				 'value' => '',
				 'description' => __('Choose the color.', 'uxbarn'),
				 'admin_label' => false,
			  ), 
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Alignment', 'uxbarn'),
				 'param_name' => 'alignment',
				 'value' => array(
								__('Left', 'uxbarn') => 'normal-align-left', 
								__('Center', 'uxbarn') =>'normal-align-center',
								__('Right', 'uxbarn') =>'normal-align-right',
							),
				 'std'	=> 'normal-align-left',
				 'description' => __('Select the alignment for this icon.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_video_element' ) ) {

	function uxbarn_create_uxb_video_element() {
		
		vc_map( array(
		   'name' => __('Video (Custom)', 'uxbarn'),
		   'base' => 'uxb_video',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Source', 'uxbarn'),
				 'param_name' => 'source',
				 'value' => array(
								'Vimeo' => 'vimeo', 
								'YouTube' => 'youtube',
							),
				 'std'	=> 'vimeo',
				 'description' => '',
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Video ID', 'uxbarn'),
				 'param_name' => 'video_id',
				 'value' => '',
				 'description' => __('Example: <em>23534361</em> for Vimeo. <em>G_G8SdXktHg</em> for YouTube.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			)	
		 ));
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_blockquote_element' ) ) {

	function uxbarn_create_uxb_blockquote_element() {
		
		vc_map( array(
		   'name' => __('Blockquote (Custom)', 'uxbarn'),
		   'base' => 'uxb_blockquote',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'textarea_html',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Text', 'uxbarn'),
				 'param_name' => 'content',
				 'value' => 'Everything is okay in the end, if it\'s not ok, then it\'s not the end.',
				 'description' => __('Enter the text for this quote.', 'uxbarn'),
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Cite', 'uxbarn'),
				 'param_name' => 'cite',
				 'value' => '',
				 'description' => __('Enter the name or source of the quote.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Type', 'uxbarn'),
				 'param_name' => 'type',
				 'value' => array(
								'Normal' => '', 
								'Float left' => 'left',
								'Float right' => 'right',
							),
				 'description' => __('Choose the display type.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  uxbarn_get_extra_class_name(),
		   )
		) );

		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_messagebox_element' ) ) {

	function uxbarn_create_uxb_messagebox_element() {
		
		vc_map( array(
		   'name' => __('Message Box (Custom)', 'uxbarn'),
		   'base' => 'uxb_messagebox',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Type', 'uxbarn'),
				 'param_name' => 'type',
				 'value' => array(
								__('Success', 'uxbarn') => 'success',
								__('Error', 'uxbarn') => 'error',
								__('Info', 'uxbarn') => 'info', 
								__('Warning', 'uxbarn') => 'warning',
							),
				 'std'	=> 'success',
				 'description' => __('Choose the message box type.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'textarea_html',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Text', 'uxbarn'),
				 'param_name' => 'content',
				 'value' => __('The message goes here...', 'uxbarn'),
				 'description' => __('Enter the text for this box.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  uxbarn_get_extra_class_name(),
		   )
		) );

		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_googlemap_element' ) ) {

	function uxbarn_create_uxb_googlemap_element() {
		
		vc_map( array(
		   'name' => __('Google Map (Custom)', 'uxbarn'),
		   'base' => 'uxb_googlemap',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'textarea',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Address', 'uxbarn'),
				 'param_name' => 'address',
				 'value' => '',
				 'description' => __('By default, the theme will use this address field as a primary value for generating the map. For example: <em>New York, US</em>. <br/><strong>NOTE:</strong> In case you want to use latitude and logitude values below, just leave this field blank.', 'uxbarn'),
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Latitude', 'uxbarn'),
				 'param_name' => 'latitude',
				 'value' => '',
				 'description' => __('Enter the latitude value. <a href="http://itouchmap.com/latlong.html" target="_blank">Click here to find yours</a>', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Logitude', 'uxbarn'),
				 'param_name' => 'longitude',
				 'value' => '',
				 'description' => __('Enter the longitude value. <a href="http://itouchmap.com/latlong.html" target="_blank">Click here to find yours</a>', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Zoom level', 'uxbarn'),
				 'param_name' => 'zoom',
				 'value' => array(
								'7' => '7', 
								'8' => '8',
								'9' => '9',
								'10' => '10',
								'11' => '11', 
								'12' => '12',
								'13' => '13',
								'14' => '14',
								'15' => '15',
								'16' => '16',
								'17' => '17',
								'18' => '18',
								'19' => '19',
								'20' => '20',
							),
				 'std'	=> '17',
				 'description' => __('Select the zoom level.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Display type', 'uxbarn'),
				 'param_name' => 'display_type',
				 'value' => array(
								__('Roadmap', 'uxbarn') => 'ROADMAP', 
								__('Satellite', 'uxbarn') => 'SATELLITE',
								__('Hybrid', 'uxbarn') => 'HYBRID',
								__('Terrain', 'uxbarn') => 'TERRAIN',
							),
				 'std'	=> 'ROADMAP',
				 'description' => __('Choose the display type.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Height', 'uxbarn'),
				 'param_name' => 'height',
				 'value' => '250',
				 'description' => __('Enter the height in pixel unit. Enter only a number.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_gallery_element' ) ) {

	function uxbarn_create_uxb_gallery_element() {
		
		vc_map( array(
		   'name' => __('Image Gallery/Slider (Custom)', 'uxbarn'),
		   'base' => 'uxb_gallery',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'attach_images',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Images', 'uxbarn'),
				 'param_name' => 'images',
				 'value' => '',
				 'description' => __('Select images.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Type', 'uxbarn'),
				 'param_name' => 'type',
				 'value' => array(
								__('Grid', 'uxbarn') => 'grid', 
								__('Slider', 'uxbarn') => 'slider',
							),
				 'std'	=> 'grid',
				 'description' => __('Select which type of the gallery to be displayed.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Grid style', 'uxbarn'),
				 'param_name' => 'style',
				 'value' => array(
								__('Style 1 (no border, no margin)', 'uxbarn') => 'gallery1', 
								__('Style 2 (has border and margin)', 'uxbarn') => 'gallery2',
							),
				 'std'	=> 'gallery1',
				 'description' => __('Select the style for grid gallery.', 'uxbarn'),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'type',
									'value' => array('grid'),
								),
			  ),
			array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Thumbnail size', 'uxbarn'),
				 'param_name' => 'size',
				 'value' => uxbarn_get_image_size_array(),
				 'std'	=> 'full',
				 'description' => __('Select which size to be used for the thumbnails. Anyway, the image will be scaled depending on its original size and containing column. If you are not sure which one to use, try <em>Large Square</em> or <em>Original size</em>.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Grid columns', 'uxbarn'),
				 'param_name' => 'columns',
				 'value' => array(
								__('3 Columns', 'uxbarn') => 'col3',
								__('4 Columns', 'uxbarn') => 'col4',
								__('5 Columns', 'uxbarn') => 'col5',
							),
				 'std'	=> 'col4',
				 'description' => __('Choose the number of columns.', 'uxbarn'),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'type',
									'value' => array('grid'),
								),
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Link type', 'uxbarn'),
				 'param_name' => 'link',
				 'value' => array(
								__('Display full image on lightbox', 'uxbarn') => 'lightbox', 
								__('Display full image on new window/tab', 'uxbarn') => 'link-window',
								__('No link', 'uxbarn') => 'none',
							),
				 'std'	=> 'lightbox',
				 'description' => __('Select the type of the link for each gallery thumbnail.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  uxbarn_get_auto_rotation('type', array('slider')),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_divider_element' ) ) {

	function uxbarn_create_uxb_divider_element() {
		
		vc_map( array(
		   'name' => __('Divider (Custom)', 'uxbarn'),
		   'base' => 'uxb_divider',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Style', 'uxbarn'),
				 'param_name' => 'style',
				 'value' => array(
								__('Thin', 'uxbarn') => 'thin',
								__('Light', 'uxbarn') => 'light',
								__('Bold', 'uxbarn') => 'bold',
								__('Thin + Dashed', 'uxbarn') => 'thin dashed',
								__('Light + Dashed', 'uxbarn') => 'light dashed',
								__('Bold + Dashed', 'uxbarn') => 'bold dashed',
							),
				 'std'	=> 'thin',
				 'description' => __('Choose the style for divider.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_cta_box_element' ) ) {

	function uxbarn_create_uxb_cta_box_element() {
		
		vc_map( array(
		  "name" => __("CTA Box (Custom)", "uxbarn"),
		  "base" => "uxb_cta_box",
		  "category" => __('Theme Custom', 'uxbarn'),
		  "params" => array(
			array(
			  "type" => "textarea_html",
			  'admin_label' => true,
			  "heading" => __("Content", "uxbarn"),
			  "param_name" => "content",
			  "value" => __("Welcome! This is an example text for CTA box. Grab it now for 20% off!", "uxbarn"),
			  "description" => __("Enter your content.", "uxbarn")
			),
			array(
			  "type" => "dropdown",
			  "heading" => __("Display button?", "uxbarn"),
			  "param_name" => "display_button",
			  "value" => array(
							__('Yes', 'uxbarn') => 'true',
							__('No', 'uxbarn') => 'false',
						),
			  'std'	=> 'true',
			),
			
			array(
			  "type" => "dropdown",
			  "heading" => __("Button position", "uxbarn"),
			  "param_name" => "button_position",
			  "value" => array(
							__('Right', 'uxbarn') => 'right',
							__('Bottom', 'uxbarn') => 'bottom',
						),
			  'std'	=> 'right',
				'dependency' => array(
									'element' => 'display_button',
									'value' => array('true'),
								),
			),
			uxbarn_get_button_text('display_button', array('true')),
			uxbarn_get_link_param('display_button', array('true')),
			uxbarn_get_open_new_window_param('display_button'),
			uxbarn_get_button_color('display_button', array('true')),
			uxbarn_get_button_custom_color('button_color', array('custom'), ''),
			uxbarn_get_button_size('display_button', array('true')),
			uxbarn_get_button_border_style('display_button', array('true')),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Icon code', 'uxbarn'),
				 'param_name' => 'icon_code',
				 'value' => '',
				 'description' => uxbarn_get_icon_field_description(),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'display_button',
									'value' => array('true'),
								),
			  ),
			uxbarn_get_extra_class_name(),
			),
		) );
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_searchform_element' ) ) {

	function uxbarn_create_uxb_searchform_element() {
		
		vc_map( array(
		  'name' => __('Search Box (Custom)', 'uxbarn'),
		  'base' => 'uxb_searchform',
		  'category' => __('Theme Custom', 'uxbarn'),
		  'params' => array(
				array(
				  'type' => 'textfield',
				  'admin_label' => true,
				  'heading' => __('Title', 'uxbarn'),
				  'param_name' => 'title',
				  'value' => __('Search', 'uxbarn'),
				  'description' => __('Enter the title. Leave it blank to hide it.', 'uxbarn')
				),
			)
		));
		
	}

}



if ( ! function_exists( 'uxb_port_generate_subcategories' ) ) {
		
	function uxb_port_generate_subcategories( $id_array, $term, $taxonomy_name, $wpml = false, $default_lang = '' ) {
		
		$child_terms_array = get_term_children( $term->term_id, $taxonomy_name );
		//echo var_dump($child_terms_array);
		
		if ( ! empty( $child_terms_array ) ) {
			foreach ( $child_terms_array as $child_term_id ) {
				
				$child_term = get_term( $child_term_id, $taxonomy_name );
				
				if ( $child_term && ! is_wp_error( $child_term ) )  {
						
					$child_term_id_value = $child_term->term_id;
					
					if ( $wpml ) {
						$child_term_id_value = icl_object_id( $child_term->term_id, $taxonomy_name, true, $default_lang );
					}
					
					$id_array[ '--- ' . $child_term->name . ' <span style="display: none">(ID: ' . $child_term->term_id . ' )</span>' ] = $child_term_id_value;
					
				}
				
			}
		}
		
		return $id_array;
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_portfolio_element' ) ) {

	function uxbarn_create_uxb_portfolio_element() {
		
		// Prepare ID list array for selection
		$id_array = array();
		//$id_array[''] = ''; // Set first dummy item (not used)
		$args = array(
					'hide_empty' 	=> 0,
					'orderby' 		=> 'title',
					'order' 		=> 'ASC',
					'parent'		=> 0,
				);
		
		$taxonomy_name = 'portfolio-category';
		$terms = get_terms( $taxonomy_name, $args );
		//echo var_dump($terms);
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
			
			foreach ( $terms as $term ) {
				
				$term_id_text =  ' <span style="display: none">(ID: ' . $term->term_id . ' )</span>';
				
				// If WPML is active (function is available)
				if ( function_exists( 'icl_object_id' ) && is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
					
					global $sitepress;
					
					if ( isset( $sitepress ) ) {
						
						$default_lang = $sitepress->get_default_language();
						
						// Text will be changed depending on current active lang, but the IDs are still original ones from default lang
						$id_array[ $term->name . $term_id_text ] = icl_object_id( $term->term_id, $taxonomy_name, true, $default_lang );
						$id_array = uxb_port_generate_subcategories( $id_array, $term, $taxonomy_name, true, $default_lang );
						
					} else {
						$id_array[ $term->name . $term_id_text ] = $term->term_id;
						$id_array = uxb_port_generate_subcategories( $id_array, $term, $taxonomy_name );
					}
						
				} else { // If there is no WPML
				
					$id_array[ $term->name . $term_id_text ] = $term->term_id;
					$id_array = uxb_port_generate_subcategories( $id_array, $term, $taxonomy_name );
					
				}
				
			}
			
		}
		 
		 

		vc_map( array(
		   'name' => __('Portfolio', 'uxbarn'),
		   'base' => 'uxb_portfolio',
		   'class' => '',
		   'category' => __('Content', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'checkbox',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Portfolio categories', 'uxbarn'),
				 'param_name' => 'categories',
				 'value' => $id_array,
				 'save_always'	=> true,
				 'description' => __('Select the categories from the list.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Maximum number of items to be displayed', 'uxbarn'),
				 'param_name' => 'max_item',
				 'value' => '',
				 'description' => __('Enter a number to limit the max number of items to be listed. Leave it blank to show all items from the selected categories above. Only number is allowed.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Display description box?', 'uxbarn'),
				 'param_name' => 'display_desc',
				 'value' => array(
								__('Yes', 'uxbarn') => 'true',
								__('No', 'uxbarn') => 'false',
							),
				 'std'	=> 'true',
				 'description' => __('Whether to display the description box.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Title', 'uxbarn'),
				 'param_name' => 'title',
				 'value' => '',
				 'description' => __('Enter the title.', 'uxbarn'),
				 'dependency' => array(
									'element' => 'display_desc',
									'value' => array('true'),
								),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'textarea',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Box description', 'uxbarn'),
				 'param_name' => 'desc',
				 'value' => '',
				 'description' => __('Enter the description.', 'uxbarn'),
				 'dependency' => array(
									'element' => 'display_desc',
									'value' => array('true'),
								),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Display line at the bottom?', 'uxbarn'),
				 'param_name' => 'display_line',
				 'value' => array(
								__('Yes', 'uxbarn') => 'true',
								__('No', 'uxbarn') => 'false',
							),
				 'std'	=> 'true',
				 'description' => __('Whether to display a line at the bottom of the description box.', 'uxbarn'),
				 'dependency' => array(
									'element' => 'display_desc',
									'value' => array('true'),
								),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Button style', 'uxbarn'),
				 'param_name' => 'button_style',
				 'value' => array(
								__('No angle icon + default position below text', 'uxbarn') => 'no-angle-default',
								__('No angle icon + bottom right position of the box', 'uxbarn') => 'no-angle-bottom',
								__('Has angle icon + default position below text', 'uxbarn') => 'angle-default',
								__('Has angle icon + bottom right position of the box', 'uxbarn') => 'angle-bottom',
								__('No button', 'uxbarn') => 'none',
							),
				 'std'	=> 'angle-default',
				 'description' => __('Select the style of the description box\'s button.', 'uxbarn'),
				 'dependency' => array(
									'element' => 'display_desc',
									'value' => array('true'),
								),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Button text', 'uxbarn'),
				 'param_name' => 'button_text',
				 'value' => __('View all projects', 'uxbarn'),
				 'description' => __('Enter the button text.', 'uxbarn'),
				 'dependency' => array(
									'element' => 'display_desc',
									'value' => array('true'),
								),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Button target URL', 'uxbarn'),
				 'param_name' => 'button_url',
				 'value' => '',
				 'description' => __('Enter the target URL for the button. Example: <em>http://www.uxbarn.com</em>', 'uxbarn'),
				 'dependency' => array(
									'element' => 'display_desc',
									'value' => array('true'),
								),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Columns', 'uxbarn'),
				 'param_name' => 'columns',
				 'value' => array(
								__('3 Columns', 'uxbarn') => 'col3',
								__('4 Columns', 'uxbarn') => 'col4',
							),
				 'std'	=> 'col4',
				 'description' => __('Choose the number of columns.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Category filter', 'uxbarn'),
				 'param_name' => 'category_filter_style',
				 'value' => array(
								__('No filter', 'uxbarn') => 'none',
								__('Inside description box', 'uxbarn') => 'inside',
								__('Outside description box', 'uxbarn') => 'outside',
							),
				 'std'	=> 'none',
				 'description' => __('Select the location for the category filter.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  uxbarn_get_orderby(),
			  uxbarn_get_order(),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
		
	}

}



if ( ! function_exists( 'uxbarn_create_uxb_team_member_element' ) ) {

	function uxbarn_create_uxb_team_member_element() {
		
		// Prepare ID list array for selection
		global $post; // required 
		
		$id_array = array();
		
		$args = array(
		            'post_type' => 'team',
		            'nopaging' 	=> true,
		            'orderby' 	=> 'title',
		            'order' 	=> 'ASC',
		        );
				
		$items = get_posts( $args );
		
		if ( ! empty( $items ) ) {
			
			foreach ( $items as $post ) : setup_postdata( $post );
				
				$post_id_text =  ' (ID: ' . $post->ID . ')';
				
				// If WPML is active
				if ( function_exists( 'icl_object_id' ) && is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
					
					$original_id = $post->ID;
					
					global $sitepress;
					
					if ( isset( $sitepress ) ) {
						
						$default_lang = $sitepress->get_default_language();
						
						// WPML's function
						$post_lang_info = array();
						
						if ( version_compare( ICL_SITEPRESS_VERSION, '3.2', '>=' ) ) {
							$post_lang_info = apply_filters( 'wpml_post_language_details', NULL, $original_id );
							//Code for the new version greater than or equal to 3.2
						} else {
							$post_lang_info = wpml_get_language_information( $original_id );
							//support for older versions
						}
						
						// If the post is the translated one (not default lang)
						if ( ! empty( $post_lang_info ) && strpos( $post_lang_info['locale'], $default_lang ) !== false ) {
							
							// If the post is translated, display it or else, display the original title
							$title = get_the_title( icl_object_id( $original_id, 'uxbarn_team', true ) );
							$id_array[ $title . $post_id_text ] = get_the_title( $original_id ) . '|' . $original_id;
							
						}
						
					} else {
						$id_array[ $post->post_title . $post_id_text ] = get_the_title() . '|' . get_the_ID();
					}
					
				} else { // If there is no WPML
					$id_array[ $post->post_title . $post_id_text ] = get_the_title() . '|' . get_the_ID();
				}
				
			endforeach;
			
		}
		
		array_unshift( $id_array, __( '--- Select Member ---', 'uxbarn' ) );
		
		wp_reset_postdata();
		 
		 

		vc_map( array(
		   'name' => __('Team Member', 'uxbarn'),
		   'base' => 'uxb_team_member',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Team member', 'uxbarn'),
				 'param_name' => 'member_id',
				 'value' => $id_array,
				 'save_always'	=> true,
				 'description' => __('Select a member to be added into the column.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Thumbnail size', 'uxbarn'),
				 'param_name' => 'image_size',
				 'value' => uxbarn_get_image_size_array(),
				 'std'	=> 'full',
				 'description' => __('Select which size to be used for the member thumbnail. Anyway, the image will be scaled depending on its original size and containing column. If you are not sure which one to use, try <em>Original size, Rectangle or Large Square</em>.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Link?', 'uxbarn'),
				 'param_name' => 'link',
				 'value' => array(
								__('Yes, enable link on thumbnail and member name to the single page', 'uxbarn') => 'true',
								__('No link', 'uxbarn') => 'false',
							),
				 'std'	=> 'true',
				 'description' => __('Whether to have a link to member\'s single page.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Heading size', 'uxbarn'),
				 'param_name' => 'heading_size',
				 'value' => array(
								__('Large', 'uxbarn') => 'large',
								__('Small', 'uxbarn') => 'small',
							),
				 'std'	=> 'large',
				 'description' => __('Select the size for heading which is used to display name and position.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Display social icons?', 'uxbarn'),
				 'param_name' => 'display_social',
				 'value' => array(
								__('Yes', 'uxbarn') => 'true',
								__('No', 'uxbarn') => 'false',
							),
				 'std'	=>	'true',
				 'description' => __('Whether to display the social network icons.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  uxbarn_get_css_animation_param(),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}
		
}



if ( ! function_exists( 'uxbarn_create_uxb_testimonial_slider_element' ) ) {

	function uxbarn_create_uxb_testimonial_slider_element() {
		
		// Prepare ID list array for selection
		$id_array = array();
		
		$args = array(
		            'post_type' => 'testimonials',
		            'nopaging' 	=> true,
		            'orderby' 	=> 'title',
		            'order' 	=> 'ASC',
		        );
				
		$testimonials = get_posts( $args );
		
		if ( ! empty( $testimonials ) ) {
			
			foreach ( $testimonials as $post ) : setup_postdata( $post );
			
				// If WPML is active
				if ( function_exists( 'icl_object_id' ) && is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
					
					$original_id = $post->ID;
					
					global $sitepress;
					
					if ( isset( $sitepress ) ) {
						
						$default_lang = $sitepress->get_default_language();
						
						// WPML's function
						$post_lang_info = array();
						
						if ( version_compare( ICL_SITEPRESS_VERSION, '3.2', '>=' ) ) {
							$post_lang_info = apply_filters( 'wpml_post_language_details', NULL, $original_id );
							//Code for the new version greater than or equal to 3.2
						} else {
							$post_lang_info = wpml_get_language_information( $original_id );
							//support for older versions
						}
						
						// If the post is the translated one (not default lang)
						if ( ! empty( $post_lang_info ) && strpos( $post_lang_info['locale'], $default_lang ) !== false ) {
							
							// If the post is translated, display it or else, display the original title
							$title = get_the_title( icl_object_id( $original_id, 'uxbarn_testimonials', true ) );
							$id_array[ $title ] = $original_id;
							
						}
						
					} else {
						$id_array[ $post->post_title ] = $post->ID;
					}
					
				} else { // If there is no WPML
					$id_array[ $post->post_title ] = $post->ID;
				}
				
			endforeach;
			
		} else {
			$id_array = array( 'No items' => -1 );
		}

		wp_reset_postdata();
		
		

		$list_heading = __('Available items', 'uxbarn');

		vc_map( array(
		   'name' => __('Testimonial Slider', 'uxbarn'),
		   'base' => 'uxb_testimonial_slider',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'checkbox',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => $list_heading,
				 'param_name' => 'id_list',
				 'value' => $id_array,
				 'save_always'	=> true,
				 'description' => __('Select the items from the list.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Style', 'uxbarn'),
				 'param_name' => 'type',
				 'value' => array(
								__('Full-width + thumbnail (work best on 1/1 column with "no-padding" option)', 'uxbarn') => 'full-width', 
								__('Text only + float left', 'uxbarn') => 'left',
								__('Text only + float right', 'uxbarn') => 'right',
							),
				 'std'	=> 'full-width',
				 'description' => __('Choose the testimonial style.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Width', 'uxbarn'),
				 'param_name' => 'width',
				 'value' => '',
				 'description' => __('Specify the width in % or px unit. Example: <em>400px</em> OR <em>50%</em>. Leave it blank to use 100% width as default.', 'uxbarn'),
				 'dependency' => array(
									'element' => 'type',
									'value' => array('left', 'right'),
								),
				 'admin_label' => false,
			  ),
			  uxbarn_get_auto_rotation(),
			  uxbarn_get_orderby(),
			  uxbarn_get_order(),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}
		
}



if ( ! function_exists( 'uxbarn_create_uxb_blog_posts_element' ) ) {

	function uxbarn_create_uxb_blog_posts_element() {
		
		// Prepare ID list array for selection
		$id_array = array();
		//$id_array[''] = ''; // Set first dummy item (not used)
		$args = array(
					'hide_empty' => 0,
					'orderby' => 'title',
					'order' => 'ASC',
				);
		$categories = get_categories($args);
		if(count($categories) > 0) {
			foreach($categories as $category) {
					
				// If WPML is active
				if ( function_exists( 'icl_object_id' ) && is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
					
					global $sitepress;
					
					if ( isset( $sitepress ) ) {
							
						$default_lang = $sitepress->get_default_language();
						
						// Text will be changed depending on current active lang, but the IDs are still original ones from default lang
						$id_array[$category->name . '<br/>'] = icl_object_id($category->term_id, 'category', true, $default_lang);
						
					} else {
						$id_array[$category->name . '<br/>'] = $category->term_id;
					}
					
				} else { // If there is no WPML
					$id_array[$category->name . '<br/>'] = $category->term_id;
				}
				
			}
		}
		 

		vc_map( array(
		   'name' => __('Blog Posts (Custom)', 'uxbarn'),
		   'base' => 'uxb_blog_posts',
		   'class' => '',
		   'category' => __('Theme Custom', 'uxbarn'),
		   'params' => array(
			  array(
				 'type' => 'checkbox',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Blog categories', 'uxbarn'),
				 'param_name' => 'categories',
				 'value' => $id_array,
				 'save_always'	=> true,
				 'description' => __('Select the categories from the list.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'textfield',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Maximum number of items to be displayed', 'uxbarn'),
				 'param_name' => 'max_item',
				 'value' => '',
				 'description' => __('Enter a number to limit the max number of items to be listed. Leave it blank to show all items from the selected categories above. Only number is allowed.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Blog posts style', 'uxbarn'),
				 'param_name' => 'blog_style',
				 'value' => array(
								__('Grid with large first post (work best on 1/1 column with "no-padding" option)', 'uxbarn') => 'grid',
								__('Grid 2 columns (work best on 1/1 column with "no-padding" option)', 'uxbarn') => 'grid-2-cols',
								__('List Items', 'uxbarn') => 'list',
								//__('Full Size (as using on actual blog page, work best on 3/4 column with "no-padding" option)', 'uxbarn') => 'full',
							),
				 'std'	=> 'grid',
				 'description' => __('Select the blog style to use.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Thumbnail style', 'uxbarn'),
				 'param_name' => 'thumbnail_style',
				 'value' => array(
								__('Below blog title', 'uxbarn') => 'below',
								__('Above blog title', 'uxbarn') => 'above',
								__('No thumbnail', 'uxbarn') => 'none',
							),
				 'std'	=> 'below',
				 'description' => __('Select the style for post thumbnail.', 'uxbarn'),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'blog_style',
									'value' => array('grid', 'grid-2-cols'),
								)
			  ),
			  
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Display thumbnail?', 'uxbarn'),
				 'param_name' => 'list_display_thumbnail',
				 'value' => array(
								__('Yes', 'uxbarn') => 'true',
								__('No', 'uxbarn') => 'false',
							),
				 'std'	=> 'true',
				 'description' => __('Whether to display post thumbnail with the list.', 'uxbarn'),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'blog_style',
									'value' => array('list'),
								)
			  ),
			  array(
				 'type' => 'checkbox',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Meta info display', 'uxbarn'),
				 'param_name' => 'meta_info_display',
				 'value' => array(
								__('Date', 'uxbarn') . '<br/>' => 'date',
								__('Author', 'uxbarn') . '<br/>' => 'author',
								__('Comment', 'uxbarn') . '<br/>' => 'comment',
							),
				 'description' => __('Select which meta info to be displayed. <strong>* NOTE:</strong> The first Grid style will display "Author" and "Comment" only in the first item. Other items will show only date.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  uxbarn_get_orderby(),
			  uxbarn_get_order(),
			  uxbarn_get_extra_class_name(),
		   )
		) );
		
	}
		
}



if ( ! function_exists( 'uxbarn_create_vc_single_image_element' ) ) {

	function uxbarn_create_vc_single_image_element() {
		
		vc_map( array(
		  'name' => __('Image (Custom)', 'uxbarn'),
		  'base' => 'vc_single_image',
		  'category' => __('Theme Custom', 'uxbarn'),
		  'params' => array(
			array(
			  'type' => 'attach_image',
			  'heading' => __('Image', 'uxbarn'),
			  'param_name' => 'image',
			  'value' => '',
			  'description' => __('Select image from media library.', 'uxbarn'),
				'admin_label' => false,
			),
			array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Image size', 'uxbarn'),
				 'param_name' => 'img_size',
				 'value' => uxbarn_get_image_size_array(),
				 'std'	=> 'full',
				 'description' => __('Select the image size you want from the list.', 'uxbarn'),
				 'admin_label' => true,
			  ),
			  uxbarn_get_stretch_image(),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Image position', 'uxbarn'),
				 'param_name' => 'image_position',
				 'value' => array(
								__('Left', 'uxbarn') => 'normal-align-left', 
								__('Center', 'uxbarn') => 'normal-align-center',
								__('Right', 'uxbarn') => 'normal-align-right',
								__('Float left (text will wrap around image)', 'uxbarn') => 'alignleft',
								__('Float right (text will wrap around image)', 'uxbarn') => 'alignright',
							),
				 'std'	=> 'normal-align-left',
				 'description' => __('Select how this image will be aligned.', 'uxbarn'),
				 'admin_label' => true,
				 'dependency' => array(
									'element' => 'stretch_image',
									'value' => array('false'),
								),
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Has link?', 'uxbarn'),
				 'param_name' => 'has_link',
				 'value' => array(
								__('No', 'uxbarn') => 'false', 
								__('Yes', 'uxbarn') =>'true',
							),
				 'std'	=> 'false',
				 'description' => __('Whether to has a link on the image.', 'uxbarn'),
				 'admin_label' => false,
			  ),
			  array(
				 'type' => 'dropdown',
				 'holder' => 'div',
				 'class' => '',
				 'heading' => __('Link type', 'uxbarn'),
				 'param_name' => 'link_type',
				 'value' => array(
								__('Link to normal URL, same window', 'uxbarn') => 'normal', 
								__('Link to normal URL on a new window/tab', 'uxbarn') => 'normal-window',
								__('Link to its own full-size image file showing on lightbox (will ignore the Target URL below)', 'uxbarn') => 'image',
							),
				 'std'	=> 'normal',
				 'description' => __('Specify which type for the target link of this image.', 'uxbarn'),
				 'admin_label' => false,
				 'dependency' => array(
									'element' => 'has_link',
									'value' => array('true'),
								),
			  ),
			uxbarn_get_link_param('has_link', array('true'), __('<strong>Note that this URL only works with "Link to normal URL ..." of "Link type" option above.</strong>', 'uxbarn')),
			uxbarn_get_css_animation_param(),
			uxbarn_get_extra_class_name(),
		  )
		));
		
	}

}
		
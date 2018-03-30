<?php

$mobileHomePage = getMobilePages();

return array(
	'title'  => __( 'Home', 'BERG') ,
	'icon' 	 => 'el-icon-pencil',
	'fields' => array(
		array(
			'id' => 'section_home',
			'type' => 'select',
			
			'options' => array(
				'section_home_1' => __('Static background', 'BERG'),
				'section_home_2' => __('Parallax background', 'BERG'),
				'section_home_3' => __('Fullscreen slider', 'BERG'),
				'section_home_4' => __('Video background', 'BERG'),
				'section_home_5' => __('Revolution slider', 'BERG'),
			),
			'select2' => array('allowClear'=>false),
			'title'	=> __( 'Select home background', 'BERG' ),
			'default' => 'section_home_1'
		),

		array(
			'id' => 'home_slider',
			'type' => 'gallery',
			'title' => __('Background slides', 'BERG'),
			'required' => array('section_home', '=', 'section_home_3'),
		),
		array(
			'id' => 'slides_duration',
			'type' => 'text',
			'title' => __('Insert slides duration', 'BERG'),
			'subtitle' => __('In miliseconds. For example, insert 5000 for 5sec', 'BERG'),
			'required' => array('section_home', '=', 'section_home_3'),
			'default' => '5000',
		),
		array(
			'id' => 'section_home_opacity',
			'type' => 'select',
			'options' => array(
				'0' => '0',
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
				'70' => '70',
				'80' => '80',
				'90' => '90',
				'100' => '100',
			),
			'title' => __('Select overlay opacity', 'BERG'),
			'subtitle' => __('(opacity 0 - solid overlay color, opacity 100 - transparent)', 'BERG'),
			'required' => array('section_home', '=', 'section_home_3'),
			'default' => '70',
			'selected' => '70',
			'select2'  => array( 'allowClear' => false ),

		),

		array(
			'id' => 'section_home_video',
			'type' => 'text',
			'title' => __('YouTube video link', 'BERG'),
			'required' => array('section_home', '=', 'section_home_4'),
		),
		array(
			'id' => 'section_video_overlay1',
			'type' => 'button_set',
			'title' => __('Video overlay', 'BERG'),
   			'options'  => array(
				'none' => __('None', 'BERG'),
				'mask' => __( 'Mask overlay', 'BERG' ),
				'color_overlay' => __( 'Color overlay', 'BERG' ),
			),
			'required' => array('section_home', '=', 'section_home_4'),
		),
		array(
			'id' => 'section_video_color_overlay1',
			'type' => 'color',
			'title' => __( 'Color overlay', 'BERG'),
			'validate' => '',
			'required' => array('section_video_overlay1', '!=', 'none'),
		),

		array(
			'id' => 'revslider_select',
			'type' => 'select',
			'title' => __('Select Revolution Slider', 'BERG'),
			'options' => berg_get_rev_sliders_array(),
			'required' => array('section_home', '=', 'section_home_5'),
			'select2'  => array( 'allowClear' => false ),

		),

		array(
			'id'=>'mobile_homepage',
			'type' => 'select',
			'title' => __('Select mobile homepage', 'BERG'),
			'selected' => YSettings::g('mobile_homepage', 0),
			'select2'  => array( 'allowClear' => false ),
			'options' => $mobileHomePage,
			'default' => 0,
		),
		// array(
		// 	'id'=>'mobile_homepage_logo_width',
		// 	'type' => 'text',
		// 	'title' => __('Mobile logo width in %', 'BERG'),
		// 	'default' => '100'
		// ),
		// array(
		// 	'id' => 'mobile_sticky_navigation',
		// 	'type' => 'checkbox',
		// 	'title' => __('Sticky Navigation on Mobile', 'BERG'),
		// 	'default' => '0',
		// 	'htmlOptions' => array()
		// ),

		array(
			'id' => 'navigation_divide',
			'type' => 'divide',
			'title' => __('Navigation', 'BERG')
		),


		array(
			'id' => 'navigation_text_color',
			'type' => 'button_set',
			'title' => __( 'Navigation text color & logo version', 'BERG' ),
			'subtitle' => __('Select logo and color for links in navigation. Default value - if intro section is present it will take light colors.', 'BERG'),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'light' => __( 'Light', 'BERG' ),
				'dark' => __( 'Dark', 'BERG' ),
			),
			'default' => 'default',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'nav_settings',
			'type' => 'button_set',
			'title' => __( 'Open / Close navigation', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'show' => __( 'Open', 'BERG' ),
				'close' => __( 'Close', 'BERG' ),
			),
			'default' => 'default',
			// 'required' => array('navigation_type', '=', '1')
		),

		array(
			'id' => 'nav_position',
			'type' => 'button_set',
			'title' => __('Navigation position', 'BERG'),
			'options' => array(
				'top' => __('Top', 'BERG'),
				'center' => __('Center', 'BERG')
			),
			'default' => 'top',
			'required' => array('navigation_type', '=', '1')
		),

		array(
			'id' => 'nav_transparent',
			'type' => 'select',
			'options' => array(
				'default' => __('Default', 'BERG'),
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
				'70' => '70',
				'80' => '80',
				'90' => '90',
				'100' => '100',
			),
			'title' => __('Navigation background opacity', 'BERG'),
			'subtitle' => __('(opacity 0 - solid color, opacity 100 - transparent)', 'BERG'),
			'required' => array('navigation_type', '=', '1'),
			'default' => 'default',
			'select2'  => array( 'allowClear' => false ),

		),

		array(
			'id' => 'footer_divide',
			'type' => 'divide',
			'title' => __('Footer', 'BERG'),
		),
		array(
			'id' => 'section_footer',
			'type' => 'button_set',
			'title' => __( 'Enable / Disable footer', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'enabled' => __( 'Enabled', 'BERG' ),
				'disabled' => __( 'Disabled', 'BERG' ),
			),
			'default' => 'default',
		),
	)
);
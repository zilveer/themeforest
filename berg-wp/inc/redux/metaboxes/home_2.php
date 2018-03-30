<?php
return array(
	'icon'   => 'el el-edit',
	'title'  => __( 'Home', 'BERG' ),
	'fields' => array(


		array(
			'id' => 'home_background_type',
			'type' => 'select',
			'options' => array(
				'static' => __('Static background', 'BERG'),
				'slider' => __('Fullscreen slider', 'BERG'),
				'video' => __('Video background', 'BERG'),
				'revslider' => __('Revolution slider', 'BERG'),
			),
			'select2' => array('allowClear'=>false),
			'title'	=> __( 'Select home background', 'BERG' ),
		),

		array(
			'id' => 'home_background_images',
			'type' => 'gallery',
			'title' => __('Background slides', 'BERG'),
			'required' => array('home_background_type', '=', 'slider'),
		),
		array(
			'id' => 'home_slides_duration',
			'type' => 'text',
			'title' => __('Insert slides duration', 'BERG'),
			'subtitle' => __('In miliseconds. For example, insert 5000 for 5sec', 'BERG'),
			'default' => '5000',
			'required' => array('home_background_type', '=', 'slider'),
		),
		array(
			'id' => 'home_slider_opacity',
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
			'title' => __('Select background opacity', 'BERG'),
			'subtitle' => __('(opacity 0 - transparent, opacity 100 - solid color)', 'BERG'),
			'required' => array('home_background_type', '=', 'slider'),
			'default' => '30',
			'selected' => '30',
			'select2'  => array( 'allowClear' => false ),

		),

		array(
			'id' => 'home_background_video',
			'type' => 'text',
			'title' => __('YouTube video link', 'BERG'),
			'required' => array('home_background_type', '=', 'video'),
		),
		array(
			'id' => 'home_background_video_mute',
			'type' => 'checkbox',
			'title' => __('Mute video', 'BERG'),
			'required' => array('home_background_type', '=', 'video'),
			'default' => 1,
		),
		array(
			'id' => 'section_video_overlay',
			'type' => 'button_set',
			'title' => __('Video overlay', 'BERG'),
   			'options'  => array(
				'none' => __('None', 'BERG'),
				'mask' => __( 'Mask overlay', 'BERG' ),
				'color_overlay' => __( 'Color overlay', 'BERG' ),
			),
			'required' => array('home_background_type', '=', 'video'),
		),
		array(
			'id' => 'section_video_color_overlay',
			'type' => 'color',
			'title' => __( 'Color overlay', 'BERG'),
			'validate' => '',
			'required' => array('section_video_overlay', '!=', 'none'),
		),

		array(
			'id' => 'home_background_revslider',
			'type' => 'select',
			'title' => __('Select Revolution Slider', 'BERG'),
			'options' => berg_get_rev_sliders_array(),
			'required' => array('home_background_type', '=', 'revslider'),
			'select2'  => array( 'allowClear' => false ),
		),

		array(
			'id' => 'home_header_text',
			'type' => 'text',
			'title' => __( 'Home header', 'BERG' ),
			'default' => 'WELCOME'
		),

		array(
			'id' => 'home_button_text',
			'type' => 'text',
			'title' => __( 'Home button text', 'BERG' ),
			'default' => 'CHECK OUR MENU'
		),

		array(
			'id' => 'home_button_link',
			'type' => 'text',
			'title' => __( 'Home button link', 'BERG' ),
			'default' => 'http://'
		),

		array(
			'id' => 'home_left_mobile_version',
			'type' => 'button_set',
			'title' => __('Mobile version', 'BERG'),
			'options' => array(
				'responsive' => __('Responsive', 'BERG'),
				'different' => __('Different content', 'BERG'),
			),
			'default' => 'responsive',
		),
		array(
			'id'=>'home_left_mobile_homepage',
			'type' => 'select',
			'title' => __('Select mobile homepage', 'BERG'),
			// 'selected' => YSettings::g('mobile_homepage', 0),
			'select2'  => array( 'allowClear' => false ),
			'options' => $mobileHomePage,
			'default' => 0,
			'required' => array('home_left_mobile_version', '=', 'different')
		),

		array(
		    'id' =>'home_left_panel_settings',
		    'title' => __('Left panel settings', 'BERG'),
		    'type' => 'divide'
		),

		array(
			'id' => 'logo_image_home',
			'type' => 'media',
			'title' => __('Home logo image', 'BERG'),
			'default' => array(
				'url' => THEME_DIR_URI.'/img/logo2.png',
				'id' => '',
				'height' => '',
				'width' => '',
				'thumbnail' => '',
			),
		),

		array(
			'id' => 'logo_image_home_padding',
			'type' => 'spacing',
			'output' => array('.home-logo'),
			'mode' => 'padding',
			'units' => array('px'),
			'units_extended' => 'false',
			'title' => __('Logo padding', 'BERG'),
			'default' => array(
				'padding-top' => '60px', 
				'padding-right' => '0px', 
				'padding-bottom' => '60px', 
				'padding-left' => '0px',
				'units' => 'px', 
			)
		),

		array(
			'id' => 'logo_image_home_align',
			'type' => 'button_set',
			'title' => __('Logo align', 'BERG'),
			'options' => array(
				'left' => __('Left', 'BERG'),
				'center' => __('Center', 'BERG'),
				'right' => __('Right', 'BERG'),
			),
			'default' => 'left',
		),

		array(
			'id' => 'home_left_footer_text',
			'type' => 'text',
			'title' => __('Footer text', 'BERG'),
			'default' => 'BERG © 2016',
		),		

		array(
		    'id' =>'home_left_panel_reservation_settings',
		    'title' => __('Reservation', 'BERG'),
		    'type' => 'divide'
		),

		array(
			'id' => 'home_left_reservation',
			'type' => 'switch',
			'title' => __('Show reservation', 'BERG'),
			'on' => 'On',
			'off' => 'Off',
			'default' => true,
		),

		array(
			'id' => 'home_left_reservation_text',
			'type' => 'text',
			'title' => __('Reservation button text', 'BERG'),
			'default' => 'Book your table',
			'required' => array('home_left_reservation', '=', '1'),
		),

		array(
			'id' => 'home_left_reservation_type',
			'type' => 'button_set',
			'title' => __('Reservation type', 'BERG'),
			'options' => array(
				'opentable' => 'OpenTable',
				'custom' => __('Custom', 'BERG'),
			),
			'default' => 'opentable',
			'required' => array('home_left_reservation', '=', '1'),
		),

		array(
			'id' => 'home_left_reservation_custom_link',
			'type' => 'text',
			'title' => __('Custom reservation url', 'BERG'),
			'default' => '',
			'required' => array('home_left_reservation_type', '=', 'custom'),
		),

		array(
			'id' => 'home_left_reservation_opentable_id',
			'type' => 'text',
			'title' => __('Restaurant OpenTable ID', 'BERG'),
			'default' => '',
			'required' => array('home_left_reservation_type', '=', 'opentable'),
		),

		array(
			'id' => 'home_left_reservation_date_format',
			'type' => 'button_set',
			'title' => __('Date format', 'BERG'),
			'options' => array(
				'd-m-Y' => 'd-m-Y',
				'm-d-Y' => 'm-d-Y',
				'Y-m-d' => 'Y-m-d',
			),
			'default' => 'd-m-Y',
			'required' => array('home_left_reservation', '=', '1'),
		),
		
		array(
			'id' => 'home_left_reservation_time_format',
			'type' => 'button_set',
			'title' => __('Time format', 'BERG'),
			'options' => array(
				'24' => __('24 hour', 'BERG'),
				'12' => __('12 hour', 'BERG'),
			),
			'default' => '12',
			'required' => array('home_left_reservation', '=', '1'),
		),




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
			'id' => 'home_left_nav_settings',
			'type' => 'button_set',
			'title' => __( 'Open / Close navigation', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'show' => __( 'Open', 'BERG' ),
				'close' => __( 'Close', 'BERG' ),
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
			'required' => array('navigation_type', '=', '1')
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
			// 'required' => array('navigation_type', '=', '1')
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
	),
);

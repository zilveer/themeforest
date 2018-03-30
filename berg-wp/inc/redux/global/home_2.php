<?php


return array(
	'icon'   => 'el el-home',
	'title'  => __( 'Home 2', 'BERG' ),
	'class' => 'hidden',
	'hidden' => true,
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
			'default' => 'slider',
			'class' => 'hidden',
			'select2'  => array( 'allowClear' => false ),
		),

		array(
			'id' => 'home_background_images',
			'type' => 'gallery',
			'title' => __('Background slides', 'BERG'),
			'required' => array('home_background_type', '=', 'slider'),
			'default' => array(),
			'class' => 'hidden',
		),

		array(
			'id' => 'home_background_video',
			'type' => 'text',
			'title' => __('YouTube video link', 'BERG'),
			'required' => array('home_background_type', '=', 'video'),
			'class' => 'hidden',
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
			'default' => 'mask',
			'required' => array('home_background_type', '=', 'video'),
		),
		array(
			'id' => 'section_video_color_overlay',
			'type' => 'color',
			'title' => __( 'Color overlay', 'BERG'),
			'default' => 'rgba(0,0,0,0.2)',
			'validate' => '',
			'required' => array('section_video_overlay', '!=', 'none'),
		),

		array(
			'id' => 'home_background_revslider',
			'type' => 'select',
			'title' => __('Select Revolution Slider', 'BERG'),
			'options' => berg_get_rev_sliders_array(),
			'required' => array('home_background_type', '=', 'revslider'),
			'class' => 'hidden',
			'select2'  => array( 'allowClear' => false ),
		),

		array(
			'id' => 'home_header_text',
			'type' => 'text',
			'title' => __( 'Home header', 'BERG' ),
			'default' => 'WELCOME',
			'class' => 'hidden',
		),

		array(
			'id' => 'home_button_text',
			'type' => 'text',
			'title' => __( 'Home button text', 'BERG' ),
			'default' => 'CHECK OUR MENU',
			'class' => 'hidden',
		),

		array(
			'id' => 'home_button_link',
			'type' => 'text',
			'title' => __( 'Home button link', 'BERG' ),
			'default' => 'http://',
			'class' => 'hidden',
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
			'class' => 'hidden',
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
			),
			'class' => 'hidden',
		),
		array(
			'id' => 'logo_image_home_align',
			'type' => 'button_set',
			'title' => __('Logo align', 'BERG'),
			'options' => array(
				'left' => __('Left', 'BERG'),
				'center' => __('Center', 'BERG'),
				'right' => __('Right', 'BERG')
			),
			'default' => 'left',
			'class' => 'hidden',
		),
		array(
			'id' => 'home_left_footer_text',
			'type' => 'text',
			'title' => __('Footer text', 'BERG'),
			'default' => 'BERG © 2016',
			'class' => 'hidden',
		),		


		array(
			'id' => 'home_left_reservation',
			'type' => 'switch',
			'title' => __('Show reservation', 'BERG'),
			'on' => 'On',
			'off' => 'Off',
			'default' => true,
			'class' => 'hidden',
		),
		array(
			'id' => 'home_left_reservation_text',
			'type' => 'text',
			'title' => __('Reservation button text', 'BERG'),
			'default' => 'Book your table',
			'required' => array('home_left_reservation', '=', '1'),
			'class' => 'hidden',
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
			'class' => 'hidden',
		),
		array(
			'id' => 'home_left_reservation_custom_link',
			'type' => 'text',
			'title' => __('Custom reservation url', 'BERG'),
			'default' => '',
			'required' => array('home_left_reservation_type', '=', 'custom'),
			'class' => 'hidden',
		),
		array(
			'id' => 'home_left_reservation_opentable_id',
			'type' => 'text',
			'title' => __('Restaurant OpenTable ID', 'BERG'),
			'default' => '',
			'required' => array('home_left_reservation_type', '=', 'opentable'),
			'class' => 'hidden',
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
			'class' => 'hidden',
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
			'class' => 'hidden',
		),
	),
);

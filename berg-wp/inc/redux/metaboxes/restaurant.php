<?php

return array(
	'title'  => __( 'Blog', 'BERG') ,
	'icon' 	 => 'el-icon-pencil',
	'fields' => array(
		array(
			'id' => 'restaurant_categories',
			'type' => 'select',
			'data' => 'categories',
			'args' => array('taxonomy' => array('berg_restaurant_categories'), 'hide_empty' => 0),
			'multi'	=> true,
			'title'	=> __( 'Slider categories', 'BERG' ),
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

		// array(
		// 	'id' => 'nav_position',
		// 	'type' => 'button_set',
		// 	'title' => __('Navigation position', 'BERG'),
		// 	'options' => array(
		// 		'top' => __('Top', 'BERG'),
		// 		'center' => __('Center', 'BERG')
		// 	),
		// 	'default' => 'top',
		// 	'required' => array('navigation_type', '=', '1')
		// ),

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
	)
);
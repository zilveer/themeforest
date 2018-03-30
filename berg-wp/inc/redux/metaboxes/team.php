<?php

return array(
	'title'  => __( 'Team', 'BERG' ),
	'icon'   => 'el el-edit',
	'fields' => array(

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
			'title' => __('Footer', 'BERG')
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
	),
);
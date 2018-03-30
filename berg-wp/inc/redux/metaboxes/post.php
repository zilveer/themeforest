<?php

return array(
	'title'  => __( 'Post', 'BERG' ),
	'icon'   => 'el el-edit',
	'fields' => array(
		array(
			'id' => 'post_template',
			'type' => 'button_set',
			'title' => __( 'Post template', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'post_template_1' => __( 'Side by side', 'BERG' ),
				'post_template_2' => __( 'Image on top', 'BERG' ),
			),
			'default' => 'default',
		),
		array(
			'id' => 'sidebar_posts',
			'type' => 'button_set',
			'title' => __( 'Sidebar', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'left' => __( 'Left', 'BERG' ),
				'right' => __( 'Right', 'BERG' ),
				'disabled' => __( 'Disabled', 'BERG' ),
			),
			'default' => 'default',
		),
		array(
			'id' => 'post_width',
			'type' => 'button_set',
			'title' => __( 'Content width', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'post_width_1' => __( 'Medium', 'BERG' ),
				'post_width_2' => __( 'Narrow', 'BERG' ),
				'post_width_3' => __( 'Wide', 'BERG' ),
			),
			'default' => 'default',
		),
		array(
			'id' => 'social_media_share',
			'type' => 'button_set',
			'title' => __( 'Show "Share"', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'enabled' => __( 'Enabled', 'BERG' ),
				'disabled' => __( 'Disabled', 'BERG' ),
			),
			'default' => 'default',
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

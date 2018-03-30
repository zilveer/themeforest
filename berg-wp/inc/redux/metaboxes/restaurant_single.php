<?php

return array(
	'title'  => __('Single slide', 'BERG' ),
	'icon'   => 'el el-edit',
	'fields' => array(
		// array(
		// 	'id' => 'section_restaurant_opacity',
		// 	'type' => 'select',
		// 	'options' => array(
		// 		// 'default' => __('Default', 'BERG'),
		// 		'0' => '0',
		// 		'10' => '10',
		// 		'20' => '20',
		// 		'30' => '30',
		// 		'40' => '40',
		// 		'50' => '50',
		// 		'60' => '60',
		// 		'70' => '70',
		// 		'80' => '80',
		// 		'90' => '90',
		// 		'100' => '100',
		// 	),
		// 	'title' => __('Select overlay opacity', 'BERG'),
		// 	'subtitle' => __('(opacity 0 - overlay solid color, opacity 100 - overlay transparent)', 'BERG'),
		// 	'select2'  => array( 'allowClear' => false ),
		// 	'default' => '50',
		// ),

		array(
			'id' => 'section_restaurant_color',
			'type' => 'color',
			'title' => __('Overlay color', 'BERG'),
			'validate' => '',
			'transparent' => false,
		),

		array(
			'id' => 'section_restaurant_video_link',
			'type' => 'text',
			'title' => __('YouTube video link', 'BERG'),
			'subtitle' => __('Required if post has video format', 'BERG')
		),
	),
);

<?php


return array(
	'icon'   => 'el el-edit',
	'title'  => __( 'Home', 'BERG' ),
	'class' => 'hidden',
	'hidden' => true,
	'fields' => array(
		array(
			'id' => 'section_video_overlay1',
			'type' => 'button_set',
			'title' => __('Video overlay', 'BERG'),
   			'options'  => array(
				'none' => __('None', 'BERG'),
				'mask' => __( 'Mask overlay', 'BERG' ),
				'color_overlay' => __( 'Color overlay', 'BERG' ),
			),
			'default' => 'mask',
			'required' => array('section_home', '=', 'section_home_4'),
		),
		array(
			'id' => 'section_video_color_overlay1',
			'type' => 'color',
			'title' => __( 'Color overlay', 'BERG'),
			'default' => 'rgba(0,0,0,0.2)',
			'validate' => '',
			'required' => array('section_video_overlay1', '!=', 'none'),
		),
	),
);

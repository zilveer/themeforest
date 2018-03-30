<?php

return array(
	'icon'   => 'el el-picture',
	'title'  => __( 'Intro section', 'BERG' ),
	'fields' => array(
		array(
			'id' => 'berg_intro_type',
			'type' => 'select',
			'title' => __('Select type of intro', 'BERG'),
			'options' => array( 1 => __('No intro', 'BERG'), 2 => __('Fullscreen intro', 'BERG'), 3 => __('Half screen intro', 'BERG'), 4 => __('Custom height', 'BERG')),
			'select2'  => array( 'allowClear' => false ),
			'default' => 3,
		),

		array(
			'id' => 'berg_intro_custom_height',
			'type' => 'text',
			'title' => __('Intro height in px', 'BERG'),
			'default' => '300',
			'required' => array('berg_intro_type', '=', 4),
		),

		array(
			'id' => 'berg_intro_opacity_start',
			'type' => 'select',
			'title' => __('Select opacity at the start<br/><small>(opacity 0 - solid color, opacity 100 - transparent)</small>', 'BERG'),
			'options' => array( '0' => 'Opacity 0', '10' => 'Opacity 10', '20' => 'Opacity 20', '30' => 'Opacity 30', '40' => 'Opacity 40', '50' => 'Opacity 50', '60' => 'Opacity 60', '70' => 'Opacity 70', '80' => 'Opacity 80', '90' => 'Opacity 90', '100' => 'Opacity 100'),
			'select2'  => array( 'allowClear' => false ),
			'default' => '30',
		),
		array(
			'id' => 'berg_intro_opacity_end',
			'type' => 'select',
			'title' => __('Select opacity at the end<br/><small>(opacity 0 - solid color, opacity 100 - transparent)</small>', 'BERG'),
			'options' => array( '0' => 'Opacity 0', '10' => 'Opacity 10', '20' => 'Opacity 20', '30' => 'Opacity 30', '40' => 'Opacity 40', '50' => 'Opacity 50', '60' => 'Opacity 60', '70' => 'Opacity 70', '80' => 'Opacity 80', '90' => 'Opacity 90', '100' => 'Opacity 100'),
			'select2'  => array( 'allowClear' => false ),
			'default' => '100',
		),
		array(
			'id' => 'berg_intro_text_alignment',
			'type' => 'select',
			'title' => __('Select text alignment', 'BERG'),
			'options' => array( 
				'left' => __('Left', 'BERG'),
				'center' => __('Center', 'BERG'),
				'right' => __('Right', 'BERG'),
			),
			'default' => 'left',
			'select2'  => array( 'allowClear' => false ),
		)
	)
);
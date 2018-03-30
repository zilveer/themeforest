<?php
return array(
	'name' => __('Contact Form 7', 'health-center') ,
	'desc' => __('Please note that the theme uses the Contact Form 7 plugin for building forms and its option panel is found in the WordPress navigation menu on the left. ' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('pencil1'),
		'size' => '26px',
		'lheight' => '39px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'contact-form-7',
	'controls' => 'size name clone edit delete',
	'options' => array(
		array(
			'name' => __('Choose By ID', 'health-center') ,
			'id' => 'id',
			'default' => '',
			'prompt' => '',
			'options' => WPV_Editor::get_wpcf7_posts('ID'),
			'type' => 'select',
		) ,

		array(
			'name' => __('Choose By Title', 'health-center') ,
			'id' => 'title',
			'default' => '',
			'prompt' => '',
			'options' => WPV_Editor::get_wpcf7_posts('post_title'),
			'type' => 'select',
		) ,

		array(
			'name' => __('Title (optional)', 'health-center') ,
			'desc' => __('The title is placed just above the element.', 'health-center'),
			'id' => 'column_title',
			'default' => '',
			'type' => 'text'
		) ,
		array(
			'name' => __('Title Type (optional)', 'health-center') ,
			'id' => 'column_title_type',
			'default' => 'single',
			'type' => 'select',
			'options' => array(
				'single' => __('Title with divider next to it', 'health-center'),
				'double' => __('Title with divider under it ', 'health-center'),
				'no-divider' => __('No Divider', 'health-center'),
			),
		) ,
		array(
			'name' => __('Element Animation (optional)', 'health-center') ,
			'id' => 'column_animation',
			'default' => 'none',
			'type' => 'select',
			'options' => array(
				'none' => __('No animation', 'health-center'),
				'from-left' => __('Appear from left', 'health-center'),
				'from-right' => __('Appear from right', 'health-center'),
				'fade-in' => __('Fade in', 'health-center'),
				'zoom-in' => __('Zoom in', 'health-center'),
			),
		) ,
	) ,
);

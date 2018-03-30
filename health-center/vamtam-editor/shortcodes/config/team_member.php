<?php
return 	array(
	'name' => __('Team Member', 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('profile'),
		'size' => '26px',
		'lheight' => '39px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'team_member',
	'controls' => 'size name clone edit delete',
	'options' => array(

		array(
			'name' => __('Name', 'health-center'),
			'id' => 'name',
			'default' => 'Nikolay Yordanov',
			'type' => 'text',
			'holder' => 'h5',
		),
		array(
			'name' => __('Position', 'health-center'),
			'id' => 'position',
			'default' => 'Web Developer',
			'type' => 'text'
		),
		array(
			'name' => __('Link', 'health-center'),
			'id' => 'url',
			'default' => '/',
			'type' => 'text'
		),
		array(
			'name' => __('Email', 'health-center'),
			'id' => 'email',
			'default' => 'support@vamtam.com',
			'type' => 'text'
		),
		array(
			'name' => __('Phone', 'health-center'),
			'id' => 'phone',
			'default' => '+448786562223',
			'type' => 'text'
		),
		array(
			'name' => __('Picture url', 'health-center'),
			'id' => 'picture',
			'default' => 'http://makalu.vamtam.com/wp-content/uploads/2013/03/people4.png',
			'type' => 'upload'
		),
		array(
			'name' => __('Google+', 'health-center'),
			'id' => 'googleplus',
			'default' => '/',
			'type' => 'text'
		),
		array(
			'name' => __('LinkedIn', 'health-center'),
			'id' => 'linkedin',
			'default' => '',
			'type' => 'text'
		),
		array(
			'name' => __('Facebook', 'health-center'),
			'id' => 'facebook',
			'default' => '/',
			'type' => 'text'
		),
		array(
			'name' => __('Twitter', 'health-center'),
			'id' => 'twitter',
			'default' => '/',
			'type' => 'text'
		),
		array(
			'name' => __('YouTube', 'health-center'),
			'id' => 'youtube',
			'default' => '/',
			'type' => 'text'
		),
		array(
			'name' => __('Instagram', 'health-center'),
			'id' => 'instagram',
			'default' => '/',
			'type' => 'text'
		),
		array(
			'name' => __('Dribble', 'health-center'),
			'id' => 'dribble',
			'default' => '/',
			'type' => 'text'
		),
		array(
			'name' => __('Vimeo', 'health-center'),
			'id' => 'vimeo',
			'default' => '/',
			'type' => 'text'
		),

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
	),
);

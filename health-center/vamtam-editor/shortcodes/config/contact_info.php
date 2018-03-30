<?php

/**
 * Contact info shortcode options
 *
 * @package wpv
 * @subpackage editor
 */

return array(
	'name' => __('Contact Info', 'health-center') ,
	'icon' => array(
		'char' => WPV_Editor::get_icon('vcard'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'contact_info',
	'controls' => 'size name clone edit delete',
	'options' => array(

		array(
			'name' => __('Name', 'health-center'),
			'id' => 'name',
			'default' => 'Nick Perry',
			'size' => 30,
			'type' => 'text'
		),
		array(
			'name' => __('Color', 'health-center'),
			'id' => 'color',
			'default' => 'accent2',
			'prompt' => __('---', 'health-center'),
			'options' => array(
				'accent1' => __('Accent 1', 'health-center'),
				'accent2' => __('Accent 2', 'health-center'),
				'accent3' => __('Accent 3', 'health-center'),
				'accent4' => __('Accent 4', 'health-center'),
				'accent5' => __('Accent 5', 'health-center'),
				'accent6' => __('Accent 6', 'health-center'),
				'accent7' => __('Accent 7', 'health-center'),
				'accent8' => __('Accent 8', 'health-center'),

			),
			'type' => 'select',
		),
		array(
			'name' => __('Phone', 'health-center'),
			'id' => 'phone',
			'default' => '+23898933i',
			'size' => 30,
			'type' => 'text'
		),
		array(
			'name' => __('Cell Phone', 'health-center'),
			'id' => 'cellphone',
			'default' => '+23898933i',
			'size' => 30,
			'type' => 'text'
		),
		array(
			'name' => __('Email', 'health-center'),
			'id' => 'email',
			'default' => 'office@test.com',
			'type' => 'text'
		),
		array(
			'name' => __('Address', 'health-center'),
			'id' => 'address',
			'default' => 'London',
			'size' => 30,
			'type' => 'textarea'
		),


		array(
			'name' => __('Title (optional)', 'health-center') ,
			'desc' => __('The column title is placed just above the element.', 'health-center'),
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
				'double' => __('Title with divider below', 'health-center'),
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

<?php

/**
 * Slogan shortcode options
 *
 * @package wpv
 * @subpackage editor
 */

return array(
	'name' => __('Call Out Box', 'health-center') ,
	'desc' => __('You can place the call out box into а column - color box elemnent in order to have background color.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('font-size'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'slogan',
	'controls' => 'size name clone edit delete handle',
	'options' => array(
		array(
			'name' => __('Content', 'health-center') ,
			'id' => 'html-content',
			'default' => __('<h1>You can place your call out box text here</h1>', 'health-center'),
			'type' => 'editor',
			'holder' => 'textarea',
		) ,
		array(
			'name' => __('Button Text', 'health-center') ,
			'id' => 'button_text',
			'default' => 'Button Text',
			'type' => 'text'
		) ,
		array(
			'name' => __('Button Link', 'health-center') ,
			'id' => 'link',
			'default' => '',
			'type' => 'text'
		) ,
		array(
			'name' => __('Button Icon', 'health-center') ,
			'id' => 'button_icon',
			'default' => 'cart',
			'type' => 'icons',
		) ,
		array(
			'name' => __('Button Icon Style', 'health-center'),
			'type' => 'select-row',
			'selects' => array(
				'button_icon_color' => array(
					'desc' => __('Color:', 'health-center'),
					"default" => "accent 1",
					"prompt" => '',
					"options" => array(
						'accent1' => __('Accent 1', 'health-center'),
						'accent2' => __('Accent 2', 'health-center'),
						'accent3' => __('Accent 3', 'health-center'),
						'accent4' => __('Accent 4', 'health-center'),
						'accent5' => __('Accent 5', 'health-center'),
						'accent6' => __('Accent 6', 'health-center'),
						'accent7' => __('Accent 7', 'health-center'),
						'accent8' => __('Accent 8', 'health-center'),
					) ,
				),
				'button_icon_placement' => array(
					'desc' => __('Placement:', 'health-center'),
					"default" => 'left',
					"options" => array(
						'left' => __('Left', 'health-center'),
						'right' => __('Right', 'health-center'),
					) ,
				),
				),
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

	) ,
);

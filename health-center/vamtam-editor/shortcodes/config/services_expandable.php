<?php

/**
 * Expandable services shortcode options
 *
 * @package wpv
 * @subpackage editor
 */

return array(
	'name' => __('Expandable Box ', 'health-center') ,
	'desc' => __('You have open and closed states of the box and you can set diffrenet content and background of each state.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('expand1'),
		'size' => '26px',
		'lheight' => '39px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'services_expandable',
	'controls' => 'size name clone edit delete',
	'callbacks' => array(
		'init' => 'init-expandable-services',
		'generated-shortcode' => 'generate-expandable-services',
	),
	'options' => array(
		array(
			'name' => __('Backgrounds', 'health-center') ,
			'type' => 'color-row',
			'inputs' => array(
				'background' => array(
					'name' => __('Closed state:', 'health-center'),
					'default' => 'accent1',
				),
				'hover_background' => array(
					'name' => __('Expanded state:', 'health-center'),
					'default' => 'accent2',
				),
			),
		) ,

		array(
			'name' => __('Closed state image', 'health-center') ,
			'id' => 'image',
			'default' => '',
			'type' => 'upload'
		) ,

		array(
			'name' => __(' Closed state icon', 'health-center') ,
			'desc' => __('The icon will not be visable if you have an image in the option above.', 'health-center'),
			'id' => 'icon',
			'default' => '',
			'type' => 'icons',
		) ,
		array(
			"name" => __("Icon Color", 'health-center') ,
			"id" => "icon_color",
			"default" => 'accent6',
			"type" => "color",
		) ,
		array(
			'name' => __('Icon Size', 'health-center'),
			'id' => 'icon_size',
			'type' => 'range',
			'default' => 62,
			'min' => 8,
			'max' => 100,
		),
		array(
			'name' => __('Closed state text', 'health-center') ,
			'id' => 'closed',
			'default' => __('This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.', 'health-center'),
			'type' => 'textarea',
			'class' => 'noattr',
		) ,

        array(
			'name' => __('Expanded state', 'health-center') ,
			'id' => 'html-content',
			'default' => __('This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.', 'health-center').'[split]'.
			             __('This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.', 'health-center'),
			'type' => 'editor',
			'holder' => 'textarea',
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

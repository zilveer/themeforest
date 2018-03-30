<?php
return array(
	'name' => __('Box with a Link', 'health-center') ,
	'desc' => __('You can set a link, background color and hover color to a section of the website and place your content there.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('link5'),
		'size' => '30px',
		'lheight' => '40px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'linkarea',
	'controls' => 'size name clone edit delete',
	'options' => array(
		array(
			'name' => __('Background Color', 'health-center') ,
			'id' => 'background_color',
			'default' => '',
			'prompt' => __('No background', 'health-center'),
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
			'type' => 'select'
		) ,
		array(
			'name' => __('Hover Color', 'health-center') ,
			'id' => 'hover_color',
			'default' => 'accent1',
			'prompt' => __('No background', 'health-center'),
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
			'type' => 'select'
		) ,

		array(
			'name' => __('Link', 'health-center') ,
			'id' => 'href',
			'default' => '',
			'type' => 'text',
		) ,

		array(
			"name" => __("Target", 'health-center') ,
			"id" => "target",
			"default" => '_self',
			"options" => array(
				"_blank" => __('Load in a new window', 'health-center') ,
				"_self" => __('Load in the same frame as it was clicked', 'health-center') ,
			) ,
			"type" => "select",
		) ,

		array(
			'name' => __('Contents', 'health-center') ,
			'id' => 'html-content',
			'default' => __('This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.', 'health-center'),
			'type' => 'editor',
			'holder' => 'textarea',
		) ,

		array(
			'name' => __('Icon', 'health-center') ,
			'desc' => __('This option overrides the "Image" option.', 'health-center'),
			'id' => 'icon',
			'default' => '',
			'type' => 'icons',
		) ,
		array(
			"name" => __("Icon Color", 'health-center') ,
			"id" => "icon_color",
			"default" => 'accent6',
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
			"type" => "select",
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
			'name' => __('Image', 'health-center') ,
			'desc' => __('The image will appear above the content.<br><br>', 'health-center'),
			'id' => 'image',
			'default' => '',
			'type' => 'upload',
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

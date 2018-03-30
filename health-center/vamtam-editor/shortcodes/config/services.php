<?php
return array(
	'name' => __('Service Box', 'health-center') ,
	'desc' => __('Please note that the service box may not work properly in one half to full width layouts.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('cog1'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'services',
	'controls' => 'size name clone edit delete',
	'options' => array(
		array(
			'name' => __('Style', 'health-center') ,
			'id' => 'fullimage',
			'default' => 'false',
			'type' => 'select',
			'options' => array(
				'false' => __('Style big icon with zoom out', 'health-center'),
				'true' => __('Style standard with an image or an icon ', 'health-center'),
			),
			'field_filter' => 'fbs',
		) ,

		array(
			'name' => __('Icon', 'health-center') ,
			'desc' => __('This option overrides the "Image" option.', 'health-center'),
			'id' => 'icon',
			'default' => 'apple',
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
			'class' => 'fbs fbs-true',
		),
		array(
			'name' => __('Icon Background', 'health-center'),
			'id' => 'background',
			'default' => 'accent1',
			'type' => 'color',
			'class' => 'fbs fbs-false',
		),

		array(
			'name' => __('Image', 'health-center') ,
			'desc' => __('This option can be overridden by the "Icon" option.', 'health-center'),
			'id' => 'image',
			'default' => '',
			'type' => 'upload',
		) ,

		array(
			'name' => __('Title', 'health-center') ,
			'id' => 'title',
			'default' => 'This is a title',
			'type' => 'text',
		) ,

		array(
			'name' => __('Description', 'health-center') ,
			'id' => 'html-content',
			'default' => 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.

Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.',
			'type' => 'editor',
			'holder' => 'textarea',
		) ,

		array(
			'name' => __('Text Alignment', 'health-center') ,
			'id' => 'text_align',
			'default' => 'justify',
			'type' => 'select',
			'options' => array(
				'justify' => 'justify',
				'left' => 'left',
				'center' => 'center',
				'right' => 'right',
			)
		) ,
		array(
			'name' => __('Link', 'health-center') ,
			'id' => 'button_link',
			'default' => '/',
			'type' => 'text'
		) ,

		array(
			'name' => __('Button Text', 'health-center') ,
			'id' => 'button_text',
			'default' => 'learn more',
			'type' => 'text'
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

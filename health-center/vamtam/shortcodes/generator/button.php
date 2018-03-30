<?php
return array(
	'name' => __('Buttons', 'health-center') ,
	'value' => 'button',
	'options' => array(
		array(
			'name' => __('Text', 'health-center') ,
			'id' => 'text',
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Style', 'health-center') ,
			'id' => 'style',
			'default' => 'filled-small',
			'options' => array(
				'filled' => __('Filled', 'health-center'),
				'filled-small' => __('Filled, small', 'health-center'),
				'border' => __('Border', 'health-center'),
			),
			'type' => 'select'
		) ,
		array(
			'name' => __('Font size', 'health-center') ,
			'id' => 'font',
			'default' => 24,
			'type' => 'range',
			'min' => 10,
			'max' => 64,
		) ,
		array(
			'name' => __('Background', 'health-center') ,
			'id' => 'bgColor',
			'default' => 'accent1',
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
			'name' => __('Hover Background', 'health-center') ,
			'id' => 'hover_color',
			'default' => 'accent1',
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
			'name' => __('Alignment', 'health-center') ,
			'id' => 'align',
			'default' => '',
			'prompt' => '',
			'options' => array(
				'left' => __('Left', 'health-center') ,
				'right' => __('Right', 'health-center') ,
				'center' => __('Center', 'health-center') ,
			) ,
			'type' => 'select',
		) ,
		array(
			'name' => __('Link', 'health-center') ,
			'id' => 'link',
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Link Target', 'health-center') ,
			'id' => 'linkTarget',
			'default' => '_self',
			'options' => array(
				'_blank' => __('Load in a new window', 'health-center') ,
				'_self' => __('Load in the same frame as it was clicked', 'health-center') ,
			) ,
			'type' => 'select',
		) ,
		array(
			'name' => __('Icon', 'health-center') ,
			'id' => 'icon',
			'default' => '',
			'type' => 'icons',
		) ,
		array(
			'name' => __('Icon Style', 'health-center'),
			'type' => 'select-row',
			'selects' => array(
				'icon_color' => array(
					'desc' => __('Color:', 'health-center'),
					"default" => "",
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
				'icon_placement' => array(
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
			'name' => __('ID', 'health-center') ,
			'desc' => __('ID attribute added to the button element.', 'health-center'),
			'id' => 'id',
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Class', 'health-center') ,
			'desc' => __('Class attribute added to the button element.', 'health-center'),
			'id' => 'class',
			'default' => '',
			'type' => 'text',
		) ,
	) ,
);

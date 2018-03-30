<?php
return array(
	'name' => __('Progress Indicator', 'health-center') ,
	'desc' => __('You can chose from % indicator or animateed number.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('meter-medium'),
		'size' => '26px',
		'lheight' => '39px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'wpv_progress',
	'controls' => 'size name clone edit delete',
	'options' => array(
		array(
			'name' => __('Type', 'health-center'),
			'id' => 'type',
			'type' => 'select',
			'default' => 'percentage',
			'options' => array(
				'percentage' => __('Percentage', 'health-center'),
				'number' => __('Number', 'health-center'),
			),
			'field_filter' => 'fpis',
		),

		array(
			'name' => __('Percentage', 'health-center') ,
			'id' => 'percentage',
			'default' => 0,
			'type' => 'range',
			'min' => 0,
			'max' => 100,
			'unit' => '%',
			'class' => 'fpis fpis-percentage',
		) ,

		array(
			'name' => __('Value', 'health-center') ,
			'id' => 'value',
			'default' => 0,
			'type' => 'range',
			'min' => 0,
			'max' => 100000,
			'class' => 'fpis fpis-number',
		) ,

		array(
			'name' => __('Track Color', 'health-center') ,
			'id' => 'bar_color',
			'default' => 'accent1',
			'type' => 'color',
			'class' => 'fpis fpis-percentage',
		) ,

		array(
			'name' => __('Bar Color', 'health-center') ,
			'id' => 'track_color',
			'default' => 'accent7',
			'type' => 'color',
			'class' => 'fpis fpis-percentage',
		) ,

		array(
			'name' => __('Value Color', 'health-center') ,
			'id' => 'value_color',
			'default' => 'accent2',
			'type' => 'color',
		) ,

	) ,


);

<?php
return array(
	'name' => __('Featured Products', 'health-center') ,
	'icon' => array(
		'char' => WPV_Editor::get_icon('cart1'),
		'size' => '26px',
		'lheight' => '39px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'wpv_featured_products',
	'controls' => 'size name clone edit delete',
	'options' => array(
		array(
			'name' => __('Columns', 'health-center') ,
			'id' => 'columns',
			'default' => 4,
			'min' => 2,
			'max' => 4,
			'type' => 'range',
		) ,
		array(
			'name' => __('Limit', 'health-center') ,
			'desc' => __('Maximum number of products.', 'health-center') ,
			'id' => 'per_page',
			'default' => 3,
			'min' => 1,
			'max' => 50,
			'type' => 'range',
		) ,

		array(
			'name' => __('Order By', 'health-center') ,
			'id' => 'orderby',
			'default' => 'date',
			'type' => 'radio',
			'options' => array(
				'date' => __('Date', 'health-center'),
				'menu_order' => __('Menu Order', 'health-center'),
			),
		) ,

		array(
			'name' => __('Order', 'health-center') ,
			'id' => 'order',
			'default' => 'desc',
			'type' => 'radio',
			'options' => array(
				'desc' => __('Descending', 'health-center'),
				'asc' => __('Ascending', 'health-center'),
			),
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
			),
		) ,
	) ,
);

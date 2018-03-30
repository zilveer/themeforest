<?php
return array(
	'name' => __('Price Box', 'health-center') ,
	'icon' => array(
		'char' => WPV_Editor::get_icon('basket1'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'price',
	'controls' => 'size name clone edit delete',
	'options' => array(

		array(
			'name' => __('Title', 'health-center') ,
			'id' => 'title',
			'default' => __('Title', 'health-center'),
			'type' => 'text',
			'holder' => 'h5',
		) ,
		array(
			'name' => __('Price', 'health-center') ,
			'id' => 'price',
			'default' => '69',
			'type' => 'text',
		) ,
		array(
			'name' => __('Currency', 'health-center') ,
			'id' => 'currency',
			'default' => '$',
			'type' => 'text',
		) ,
		array(
			'name' => __('Duration', 'health-center') ,
			'id' => 'duration',
			'default' => 'per month',
			'type' => 'text',
		) ,
		array(
			'name' => __('Summary', 'health-center') ,
			'id' => 'summary',
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Description', 'health-center') ,
			'id' => 'html-content',
			'default' => '<ul>
	<li>list item</li>
	<li>list item</li>
	<li>list item</li>
	<li>list item</li>
	<li>list item</li>
	<li>list item</li>
</ul>',
			'type' => 'editor',
			'holder' => 'textarea',
		) ,
		array(
			'name' => __('Button Text', 'health-center') ,
			'id' => 'button_text',
			'default' => 'Buy',
			'type' => 'text'
		) ,
		array(
			'name' => __('Button Link', 'health-center') ,
			'id' => 'button_link',
			'default' => '',
			'type' => 'text'
		) ,
		array(
			'name' => __('Featured', 'health-center') ,
			'id' => 'featured',
			'default' => 'false',
			'type' => 'toggle'
		) ,


		array(
			'name' => __('Title', 'health-center') ,
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
				'zoom-in' => __('Zoom in', 'health-center'),
			),
		) ,
	) ,
);

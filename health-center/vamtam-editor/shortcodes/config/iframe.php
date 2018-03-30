<?php
return array(
	'name' => __('IFrame', 'health-center') ,
	'desc' => __('You can embed a website using this element.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('tablet'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'iframe',
	'controls' => 'size name clone edit delete',
	'options' => array(

		array(
			'name' => __('Source', 'health-center') ,
			'desc' => __('The URL of the page you want to display. Please note that the link should be in this format - http://www.google.com.<br><br>', 'health-center'),
			'id' => 'src',
			'size' => 30,
			'default' => 'http://apple.com',
			'type' => 'text',
			'holder' => 'div',
			'placeholder' => __('Click edit to set iframe source url', 'health-center'),
		) ,
		array(
			'name' => __('Width', 'health-center') ,
			'desc' => __('You can use % or px as units for width.<br><br>', 'health-center') ,
			'id' => 'width',
			'size' => 30,
			'default' => '100%',
			'type' => 'text',
		) ,
		array(
			'name' => __('Height', 'health-center') ,
			'desc' => __('You can use px as units for height.<br><br>', 'health-center') ,
			'id' => 'height',
			'size' => 30,
			'default' => '400px',
			'type' => 'text',
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
	) ,
);

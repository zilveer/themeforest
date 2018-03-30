<?php
return array(
	'name' => __('Text Divider', 'health-center') ,
	'icon' => array(
		'char' => WPV_Editor::get_icon('minus'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'text_divider',
	'controls' => 'name clone edit delete',
	'options' => array(
		array(
			'name' => __('Type', 'health-center') ,
			'id' => 'type',
			'default' => 'single',
			'options' => array(
				'single' => __('Title in the middle', 'health-center') ,
				'double' => __('Title above divider', 'health-center') ,
			) ,
			'type' => 'select',
			'class' => 'add-to-container',
			'field_filter' => 'ftds',
		) ,
		array(
			'name' => __('Text', 'health-center') ,
			'id' => 'html-content',
			'default' => __('Text Divider', 'health-center'),
			'type' => 'editor',
			'class' => 'ftds ftds-single ftds-double',
		) ,
	) ,
);

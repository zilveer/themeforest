<?php
return array(
	'name' => __('Tabs', 'health-center') ,
	'desc' => __('Change to vertical or horizontal tabs from the element option panel.  Add an icon by clicking on the "pencil" icon next to the pane title. Adding tabs, changing the name of the tab and adding content into the tabs is done when the tab element is toggled.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('storage1'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'tabs',
	'controls' => 'size name clone edit delete always-expanded',
	'callbacks' => array(
		'init' => 'init-tabs',
		'generated-shortcode' => 'generate-tabs',
	),
	'options' => array(

		array(
			'name' => __('Layout', 'health-center') ,
			"id" => "layout",
			"default" => 'horizontal',
			"type" => "radio",
			'options' => array(
				'horizontal' => __('Horizontal', 'health-center'),
				'vertical' => __('Vertical', 'health-center'),
			),
			'field_filter' => 'fts',
		) ,
		array(
			'name' => __('Navigation Color', 'health-center') ,
			'id' => 'nav_color',
			'type' => 'color',
			'default' => 'accent2',
		) ,
		array(
			'name' => __('Navigation Background', 'health-center') ,
			'id' => 'left_color',
			'type' => 'color',
			'default' => 'accent8',
		) ,
		array(
			'name' => __('Content Background', 'health-center') ,
			'id' => 'right_color',
			'type' => 'color',
			'default' => 'accent1',
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
				'single' => __('Title with divider next to it.', 'health-center'),
				'double' => __('Title with divider below', 'health-center'),
				'no-divider' => __('No Divider', 'health-center'),
			),
			'class' => 'fts fts-horizontal',
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

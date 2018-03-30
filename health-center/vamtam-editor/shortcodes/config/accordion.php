<?php
return array(
	"name" => __("Accordion", 'health-center'),
	'desc' => __('Adding panes, changing the name of the pane and adding content into the panes is done when the accordion element is toggled.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('menu1'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	"value" => "accordion",
	'controls' => 'size name clone edit delete always-expanded',
	'callbacks' => array(
		'init' => 'init-accordion',
		'generated-shortcode' => 'generate-accordion',
	),
	"options" => array(

		array(
			'name' => __('Allow All Panes to be Closed', 'health-center') ,
			'desc' => __('If enabled, the accordion will load with collapsed panes. Clicking on the title of the currently active pane will close it. Clicking on the title of an inactive pane will change the active pane.', 'health-center'),
			'id' => 'collapsible',
			'default' => true,
			'type' => 'toggle'
		) ,

		array(
			'name' => __('Pane Background', 'health-center') ,
			'id' => 'closed_bg',
			'default' => 'accent1',
			'type' => 'color'
		) ,

		array(
			'name' => __('Title Color', 'health-center') ,
			'id' => 'title_color',
			'default' => 'accent8',
			'type' => 'color'
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
				'double' => __('Title with divider under it ', 'health-center'),
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
	),
);

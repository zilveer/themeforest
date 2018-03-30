<?php
return array(
	"name" => __("Upcoming Events", 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('calendar'),
		'size' => '26px',
		'lheight' => '39px',
		'family' => 'vamtam-editor-icomoon',
	),
	"value" => "wpv_tribe_events",
	'controls' => 'size name clone edit delete',
	"options" => array(

		array(
			'name' => __('Layout', 'health-center') ,
			'id' => 'layout',
			'default' => 'single',
			'type' => 'select',
			'options' => array(
				'single' => __('Single event per line', 'health-center'),
				'multiple' => __('Multiple events per line ', 'health-center'),
			),
			'field_filter' => 'fbl',
		) ,

		array(
			'name' => __('Style', 'health-center') ,
			'id' => 'style',
			'default' => 'light',
			'type' => 'select',
			'options' => array(
				'light' => __('Light Text', 'health-center'),
				'dark' => __('Dark Text', 'health-center'),
			),
			'field_filter' => 'fbl',
		) ,

		array(
			'name' => __('Number of Events', 'health-center') ,
			'id' => 'count',
			'default' => '',
			'type' => 'range',
			'min' => 1,
			'max' => 30,
		) ,

		array(
			'name' => __('Ongoing Event Text', 'health-center') ,
			'id' => 'ongoing',
			'default' => '',
			'type' => 'text',
			'class' => 'fbl fbl-single',
		) ,

		array(
			'name'    => __('"Read More" Text', 'health-center') ,
			'id'      => 'read_more_text',
			'default' => '',
			'type'    => 'text',
		) ,

		array(
			'name' => __('Categories (optional)', 'health-center') ,
			'desc' => __('All categories will be shown if none are selected. Please note that if you do not see categories, there are none created most probably. You can use ctr + click to select multiple categories.', 'health-center') ,
			'id' => 'cat',
			'default' => array() ,
			'target' => 'tribe_events_category',
			'type' => 'multiselect',
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

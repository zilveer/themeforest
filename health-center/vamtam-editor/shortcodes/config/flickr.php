<?php
return array(
	'name' => __('Flickr', 'health-center') ,
	'desc' => __('This element is usefull if you have a Flickr account. Use <a href="http://idgettr.com/" target="_blank">idGettr</a> if you don\'t know your ID.<br><br>.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('flickr'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'flickr',
	'controls' => 'size name clone edit delete',
	'options' => array(

		array(
			'name' => __('Flickr ID', 'health-center'),
			'desc' => __('Use <a href="http://idgettr.com/" target="_blank">idGettr</a> if you don\'t know your ID.<br><br>', 'health-center'),
			'id' => 'id',
			'default' => '',
			'type' => 'text'
		),

		array(
			'name' => __('Type', 'health-center'),
			'id' => 'type',
			'default' => 'page',
			'options' => array(
				'user' => __('User', 'health-center'),
				'group' => __('Group', 'health-center'),
			),
			'type' => 'select',
		),

		array(
			'name' => __('Count', 'health-center'),
			'desc' => '',
			'id' => 'count',
			'default' => 4,
			'min' => 0,
			'max' => 20,
			'type' => 'range'
		),
		array(
			'name' => __('Display', 'health-center'),
			'id' => 'display',
			'default' => 'latest',
			'options' => array(
				'latest' => __('Latest', 'health-center'),
				'random' => __('Random', 'health-center'),
			),
			'type' => 'select',
		),

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

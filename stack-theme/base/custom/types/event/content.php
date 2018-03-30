<?php

$config = array(
	'title' 	=> __('Event Detail', 'theme_admin'),
	'group_id' 	=> 'info',
	'context'	=> 'normal',
	'priority' 	=> 'high',
	'types' 	=> array( 'event' )
);

$extend_detail_template[] = array(
	'id' => 'extend_detail',
	'type' => 'stack_template',
	'title' => __('Features', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'name',
			'title' 		=> __('Name', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'value',
			'title' 		=> __('Value', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
		),
	)
);

$options = array(
	array(
		'type' 			=> 'on_off',
		'id' 			=> 'show_date',
		'toggle'		=> 'toggle_show_date',
		'title' 		=> __('Show Date', 'theme_admin'),
		'description' 	=> '',
		'default' 		=> 'on'
	),
	array(
		'type' 			=> 'date',
		'id' 			=> 'first_date',
		'toggle_group'	=> 'toggle_show_date toggle_show_date_on',
		'title' 		=> __('First Date', 'theme_admin'),
		'description' 	=> __('Event starting date.', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'date',
		'id' 			=> 'last_date',
		'toggle_group'	=> 'toggle_show_date toggle_show_date_on',
		'title' 		=> __('Last Date', 'theme_admin'),
		'description' 	=> __('Set same as the first date for one-day event.', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'images',
		'id' 			=> 'images',
		'title' 		=> __('Images', 'theme_admin'),
		'description' 	=> __('min width 600px', 'theme_admin'),
		'default' 		=> ''
	),

	array(
		'type' 			=> 'separator',
		'title' 		=> __('Google Map', 'theme_admin'),
		'description' 	=> '',
	),
	array(
		'type' 			=> 'text',
		'id' 			=> 'gmap',
		'title' 		=> __('Lat Lng', 'theme_admin'),
		'description' 	=> __('ex: 27.175009,78.041849<br />get it <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'range',
		'id'			=> 'map_zoom',
		'title' 		=> __('Zoom Level', 'theme_admin'),
		'description' 	=> __('', 'theme_admin'),
		'default' 		=> '5',
		'min' 			=> '0',
		'max' 			=> '15',
		'step' 			=> '1',
		'unit'			=> '',
	),

	array(
		'type' 			=> 'separator',
		'title' 		=> __('Event Metas', 'theme_admin'),
		'description' 	=> '',
	),
	array(
		'type' 			=> 'textarea',
		'id' 			=> 'location',
		'title' 		=> __('Location', 'theme_admin'),
		'description' 	=> __('Leave it blank to disable this option.', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'stack',
		'id' 			=> 'extend_detail',
		'title' 		=> __('More event details', 'theme_admin'),
		'description' 	=> __('Leave it blank to disable this option.', 'theme_admin'),
		'templates'		=> $extend_detail_template,
		'stack_button'	=> __('Add more details', 'theme_admin'),
	),
	array(
		'type' 			=> 'text',
		'id' 			=> 'button_text',
		'title' 		=> __('Button Text', 'theme_admin'),
		'description' 	=> __('Leave it blank to hidden this button.', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'text',
		'id' 			=> 'button_link',
		'title' 		=> __('Button Link', 'theme_admin'),
		'description' 	=> __('eg. http://www.wegrass.com', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'radio',
		'id' 			=> 'button_target',
		'title' 		=> __('Button Target Window', 'theme_admin'),
		'description' 	=> __('Choose the target window when click the button.', 'theme_admin'),
		'default' 		=> '_self',
		'options' 		=> array(
			'_self' 	=> __('Same window', 'theme_admin'),
			'_blank' 	=> __('New window', 'theme_admin'),
		),
	),
	
);

new metaboxes_tool($config, $options);

?>
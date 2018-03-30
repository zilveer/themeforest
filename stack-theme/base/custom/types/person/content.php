<?php

$config = array(
	'title' 	=> __('Person Info', 'theme_admin'),
	'group_id' 	=> 'info',
	'context'	=> 'normal',
	'priority' 	=> 'high',
	'types' 	=> array( 'person' )
);

$social_list_template[] = array(
	'id' => 'social_stack',
	'type' => 'stack_template',
	'title' => __('Social', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'select',
			'id'			=> 'stack_title',
			'title' 		=> __('Type', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> 'facebook',
			'options' => array(
				'facebook' => 'Facebook',
				'google-plus' => 'Google+',
				'linkedin' => 'Linkedin',
				'pinterest' => 'Pinterest',
				'twitter' => 'Twitter',
				'dribbble' => 'Dribbble',
				'tumblr' => 'Tumblr',
				'envelope' => 'Email',
				'globe' => 'Website',
			)
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'social_url',
			'title' 		=> __('Link', 'theme_admin'),
			'description' 	=> 'eg. http://facebook.com/wegrass/',
		),
	)
);

$options = array(
	array(
		'type' 			=> 'image',
		'id' 			=> 'image',
		'title' 		=> __('Image', 'theme_admin'),
		'description' 	=> __('Optional, the recommended respect ratio is 1:1', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'text',
		'id' 			=> 'meta',
		'title' 		=> __('Meta', 'theme_admin'),
		'description' 	=> __('eg. Software Engineer, Envato', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'textarea',
		'id' 			=> 'short_desc_text',
		'row'			=> 4,
		'title' 		=> __('Short Description', 'theme_admin'),
		'description' 	=> '',
		'default' 		=> ''
	),
	array(
		'type' 			=> 'stack',
		'id' 			=> 'social_list',
		'title' 		=> __('Social', 'theme_admin'),
		'description' 	=> __('social links', 'theme_admin'),
		'templates'		=> $social_list_template,
		'stack_button'	=> __('Add', 'theme_admin')
	),
);
new metaboxes_tool($config, $options);

?>
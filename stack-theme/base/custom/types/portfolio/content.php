<?php
$config = array(
	'title' 	=> __('Portfolio Info', 'theme_admin'),
	'group_id' 	=> 'info',
	'context'	=> 'normal',
	'priority' 	=> 'high',
	'types' 	=> array( 'portfolio' )
);

$features_list_template[] = array(
	'id' => 'feature_stack',
	'type' => 'stack_template',
	'title' => __('Features', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Feature Name', 'theme_admin'),
			'description' 	=> '',
		),
		array(
			'type' 			=> 'textarea',
			'id'			=> 'feature_detail',
			'title' 		=> 'Detail',
			'description' 	=> '',
		),
	)
);

$options = array(
	array(
		'type' 			=> 'textarea',
		'id' 			=> 'short_desc_text',
		'title' 		=> __('Short Description', 'theme_admin'),
		'description' 	=> __('will show on portfolio thumb view', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'images',
		'id' 			=> 'gallery',
		'title' 		=> __('Images', 'theme_admin'),
		'description' 	=> __('min width 600px', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'on_off',
		'id' 			=> 'featured',
		'title' 		=> __('Featured', 'theme_admin'),
		'description' 	=> __('enable to highlight this item in Filter view', 'theme_admin'),
		'default' 		=> 'off'
	),
	array(
		'type' 			=> 'date',
		'id' 			=> 'publish_date',
		'title' 		=> __('Date', 'theme_admin'),
		'description' 	=> __('Leave it blank to disable this option.', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'stack',
		'id' 			=> 'features_list',
		'title' 		=> __('Feautes', 'theme_admin'),
		'description' 	=> __('features of your portfolio', 'theme_admin'),
		'templates'		=> $features_list_template,
		'stack_button'	=> __('Add Feature', 'theme_admin')
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
new metaboxes_tool($config,$options);

?>
<?php

$config = array(
	'title' 	=> __('Testimonial Info', 'theme_admin'),
	'group_id' 	=> 'info',
	'context'	=> 'normal',
	'priority' 	=> 'high',
	'types' 	=> array( 'testimonial' )
);

$options = array(
	array(
		'type' 			=> 'image',
		'id' 			=> 'author_image',
		'title' 		=> __('Author Image', 'theme_admin'),
		'description' 	=> __('minimum size: 96x96', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'text',
		'id' 			=> 'author_info',
		'title' 		=> __('Author Info', 'theme_admin'),
		'description' 	=> __('Optional, the author job info or description', 'theme_admin'),
		'default' 		=> ''
	),
	array(
		'type' 			=> 'textarea',
		'id' 			=> 'testimonial',
		'row'			=> 10,
		'title' 		=> __('Testimonial', 'theme_admin'),
		'description' 	=> __('Required', 'theme_admin'),
		'default' 		=> ''
	),
);
new metaboxes_tool($config, $options);

?>
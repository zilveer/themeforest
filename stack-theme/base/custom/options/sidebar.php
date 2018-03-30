<?php 

$custom_sidebar_stack[] = array(
	'id' => 'custom_sidebar',
	'type' => 'stack_template',
	'title' => __('Sidebar', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> 'Title',
			'description'	=> ''
		)
	)
);
	
// Option
$options = array(
	array(
		'title' 	=> __('Custom Sidebar', 'theme_admin'),
		'options' 	=> array(
			
			array(
				'type' 			=> 'stack',
				'id' 			=> 'custom_sidebars',
				'title' 		=> __('Custom Sidebars', 'theme_admin'),
				'description' 	=> __('', 'theme_admin'),
				'templates'		=> $custom_sidebar_stack,
				'stack_button'	=> __('Add Custom Sidebar', 'theme_admin')
			),
			
		)
	),

);

$config = array(
	'title' 		=> __('Sidebar', 'theme_admin'),
	'group_id' 		=> 'sidebar',
	'active_first' 	=> false
);
	
return array( 'options' => $options, 'config' => $config );

?>
<?php 
	
	// Option
	$options = array(
		array(
			'title' 	=> __('Page', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'radio',
					'id' 			=> 'default_layout',
					'title' 		=> __('Default Layout', 'theme_admin'),
					'description' 	=> __('choose page default layout', 'theme_admin'),
					'default' 		=> 'full-width',
					'options' 		=> array(
						'full-width' 	=> __('Full Width', 'theme_admin'),
						'sidebar' => __('Sidebar', 'theme_admin')
					)
				),
				array(
					'type' => 'on_off',
					'id' => 'comment_enable',
					'default' => 'off',
					'title' => __('Enable Comment', 'theme_admin'),
					'description' => __('show comment form in page', 'theme_admin'),
				),
				
			)
		),

		array(
			'title' 	=> __('404 Page', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'select',
					'id' 			=> '404_page',
					'title' 		=> __('404 Page', 'theme_admin'),
					'description' 	=> __('page to show when page not found', 'theme_admin'),
					'default' 		=> '',
					'source'		=> array(
						'post_type'	=> 'page'
					)
				),
				
			)
		),

	);
	
	$config = array(
		'title' 		=> __('Page', 'theme_admin'),
		'group_id' 		=> 'page',
		'active_first' 	=> false
	);
	
return array( 'options' => $options, 'config' => $config );

?>
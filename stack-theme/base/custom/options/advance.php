<?php 
	
	// Option
	$options = array(

		// Google Analytic
		array(
			'title' 	=> __('Google Analytic', 'theme_admin'),
			'options' 	=> array(
				array(
					'type' 			=> 'text',
					'id' 			=> 'analytic_ua',
					'title' 		=> __('Google Analytic Tracking ID', 'theme_admin'),
					'description' 	=> 'UA-XXXXXXXX-X',
					'default' 		=> ''
				),
			)
		),

		// Twitter API
		array(
			'title' 	=> __('Twitter App <small><a href="https://dev.twitter.com/apps" target="_blank">get them here</a></small>', 'theme_admin'),
			'options' 	=> array(
				array(
					'type' 			=> 'text',
					'id' 			=> 'twitter_consumer_key',
					'title' 		=> 'Consumer key',
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'twitter_consumer_secret',
					'title' 		=> 'Consumer secret',
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'twitter_user_token',
					'title' 		=> 'Access token',
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'twitter_user_secret',
					'title' 		=> 'Access token secret',
					'description' 	=> '',
					'default' 		=> ''
				),
			)
		),
		
		// Misc
		array(
			'title' 	=> __('Misc', 'theme_admin'),
			'options' 	=> array(
				// array(
				// 	'type' 			=> 'on_off',
				// 	'id' 			=> 'show_debug',
				// 	'title' 		=> __('Show Theme Options', 'theme_admin'),
				// 	'description' 	=> __('show theme options below theme setting panel (refresh this page to see the change)', 'theme_admin'),
				// 	'default' 		=> 'off'
				// ),
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'show_customize',
					'title' 		=> __('Show Customize Panel', 'theme_admin'),
					'description' 	=> __('show customize panel on frontend, should turn off in live site.', 'theme_admin'),
					'default' 		=> 'off'
				),
				// array(
				// 	'type' 			=> 'on_off',
				// 	'id' 			=> 'show_helper',
				// 	'title' 		=> __('Show Helper Text', 'theme_admin'),
				// 	'description' 	=> __('helper text will help you to setup the theme more easily', 'theme_admin'),
				// 	'default' 		=> 'on'
				// ),
				array(
					'type' 			=> 'textarea',
					'id' 			=> 'custom_css',
					'row'			=> 10,
					'title' 		=> __('Custom CSS', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'textarea',
					'id' 			=> 'custom_js',
					'row'			=> 10,
					'title' 		=> __('Custom JS', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
			)
		),
		
		// Save & Load Configuration
		array(
			'title' 	=> 'Save & Load Configuration',
			'options'	=> array(
				array(
					'type' 			=> 'export_options',
					'id' 			=> 'theme_export_options',
					'title' 		=> __('Export Option', 'theme_admin'),
					'description' 	=> __('backup options as .txt file', 'theme_admin'),
					'default' 		=> ''
				),
				array(
					'type' 			=> 'import_options',
					'id' 			=> 'theme_import_options',
					'title' 		=> __('Import Option', 'theme_admin'),
					'description' 	=> __('import options from .txt file', 'theme_admin'),
					'default' 		=> ''
				),
			)
		),
		
	);
	
	$config = array(
		'title' => __('Advance', 'theme_admin'),
		'group_id' => 'advance',
		'active_first' => false
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>
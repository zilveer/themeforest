<?php if(! defined('ABSPATH')){ return; }
	global $zn_framework;
	$page_options = array();

	$options = array(
		'has_tabs'  => true,
		'general' => array(
			'title' => 'General options',
			'options' => array (
				array(
					"slug" => array( 'page' , 'post', 'portfolio', 'product' ),
					'id'         	=> 'show_header',
					'name'       	=> 'Show header',
					'description' 	=> 'Choose if you want to show the main header or not on this page. ',
					'type'        	=> 'toggle2',
					'std'			=> 'show_header',
					'value'			=> 'show_header',
					'live' => array(
						'type'		=> 'hide',
						'css_class' => '#header'
					),
				),
				array (
					"slug" => array( 'page' , 'post', 'portfolio', 'product'),
					'id'         	=> 'show_footer',
					'name'       	=> 'Show footer',
					'description' 	=> 'Choose if you want to show the main footer on this page. ',
					'type'        	=> 'toggle2',
					'std'			=> 'show_footer',
					'value'			=> 'show_footer',
					'live' => array(
						'type'		=> 'hide',
						'css_class' => '.site-footer, .znpb-footer-smart-area'
					)
				),
			),
		),
		'custom_css' => array(
			'title' => 'Custom css',
			'options' => array(
					array(
						'id'          => 'zn_page_custom_css',
						'name'        => 'Custom CSS',
						'description' => 'Use this field to add your own custom css that will be applied to the current page.',
						'type'        => 'custom_code',
						'class'       => 'zn_full',
						'editor_type' => 'css',
					),
			),
		),
		'custom_js' => array(
			'title' => 'Custom js',
			'options' => array(
				array(
						'id'          => 'zn_page_custom_js',
						'name'        => 'Custom JS',
						'description' => 'Use this field to add your own custom javascript code that will be applied to the current page.',
						'type'        => 'custom_code',
						'class'       => 'zn_full',
						'editor_type' => 'javascript',
				),
			),
		),
	);



?>

<?php
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file contains the admin option setting 
	*	---------------------------------------------------------------------
	*/

	// page excerpt
	add_action('init', 'gdlr_init_page_feature');
	if( !function_exists('gdlr_init_page_feature') ){
		function gdlr_init_page_feature() {
			add_post_type_support( 'page', 'excerpt' );
			
			// create page categories
			register_taxonomy(
				'page_category', array("page"), array(
					'hierarchical' => true,
					'label' => __('Page Categories', 'gdlr_translate'), 
					'singular_label' => __('Page Category', 'gdlr_translate'), 
					'rewrite' => array( 'slug' => 'page_category' )));
			register_taxonomy_for_object_type('page_category', 'page');			
		}	
	}	
	
	// create the page option
	add_action('init', 'gdlr_create_page_options');
	if( !function_exists('gdlr_create_page_options') ){
	
		function gdlr_create_page_options(){
			global $gdlr_sidebar_controller;
		
			new gdlr_page_options( 
				
				// page option attribute
				array(
					'post_type' => array('page'),
					'meta_title' => __('Goodlayers Page Option', 'gdlr_translate'),
					'meta_slug' => 'goodlayers-page-option',
					'option_name' => 'post-option',
					'position' => 'side',
					'priority' => 'core',
				),
					  
				// page option settings
				array(
					'page-layout' => array(
						'title' => __('Page Layout', 'gdlr_translate'),
						'options' => array(
								'sidebar' => array(
									'type' => 'radioimage',
									'options' => array(
										'no-sidebar'=>GDLR_PATH . '/include/images/no-sidebar-2.png',
										'both-sidebar'=>GDLR_PATH . '/include/images/both-sidebar-2.png', 
										'right-sidebar'=>GDLR_PATH . '/include/images/right-sidebar-2.png',
										'left-sidebar'=>GDLR_PATH . '/include/images/left-sidebar-2.png'
									),
									'default'=>'no-sidebar'
								),	
								'left-sidebar' => array(
									'title' => __('Left Sidebar' , 'gdlr_translate'),
									'type' => 'combobox',
									'options' => $gdlr_sidebar_controller->get_sidebar_array(),
									'wrapper-class' => 'sidebar-wrapper left-sidebar-wrapper both-sidebar-wrapper'
								),
								'right-sidebar' => array(
									'title' => __('Right Sidebar' , 'gdlr_translate'),
									'type' => 'combobox',
									'options' => $gdlr_sidebar_controller->get_sidebar_array(),
									'wrapper-class' => 'sidebar-wrapper right-sidebar-wrapper both-sidebar-wrapper'
								),		
								'page-style' => array(
									'title' => __('Page Style' , 'gdlr_translate'),
									'type' => 'combobox',
									'options' => array(
										'normal'=> __('Normal', 'gdlr_translate'),
										'no-header'=> __('No Header', 'gdlr_translate'),
										'no-footer'=> __('No Footer', 'gdlr_translate'),
										'no-header-footer'=> __('No Header / No Footer', 'gdlr_translate'),
									)
								),
						)
					),
					
					'page-option' => array(
						'title' => __('Page Option', 'gdlr_translate'),
						'options' => array(
							'show-title' => array(
								'title' => __('Show Title' , 'gdlr_translate'),
								'type' => 'checkbox',
								'default' => 'enable',
							),						
							'page-caption' => array(
								'title' => __('Page Caption' , 'gdlr_translate'),
								'type' => 'textarea'
							),		
							'show-content' => array(
								'title' => __('Show Content (From Default Editor)' , 'gdlr_translate'),
								'type' => 'checkbox',
								'default' => 'enable',
							),								
							'header-background' => array(
								'title' => __('Header Background Image' , 'gdlr_translate'),
								'button' => __('Upload', 'gdlr_translate'),
								'type' => 'upload',
							),						
							'no-header-height' => array(
								'title' => __('Push Slider Behind Navigation' , 'gdlr_translate'),
								'type' => 'checkbox',
								'default' => 'disable'
							)						
						)
					),

				)
			);
			
		}
	}

?>
<?php 
	
	// Option
	$options = array(
		array(
			'title' 	=> __('Pre-Footer', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'pre_footer_show',
					'toggle' 		=> 'toggle-pre-footer-show',
					'title' 		=> __('Show Pre-Footer', 'theme_admin'),
					'description' 	=> __('turn off to disable pre-footer', 'theme_admin'),
					'default' 		=> 'on'
				),
				
				array(
					'type' 			=> 'radio_img',
					'id' 			=> 'pre_footer_layout',
					'toggle_group' 	=> 'toggle-pre-footer-show',
					'title' 		=> __('Pre-Footer Column Layout', 'theme_admin'),
					'description' 	=> __('choose the pre-footer layout to contain widgets', 'theme_admin'),
					'default' 		=> '3-columns',
					'options' 		=> array(
						'1-column' 		=> __('1 Col', 'theme_admin'),
						'2-columns' 	=> __('2 Cols', 'theme_admin'),
						'2-columns-2' 	=> __('2 Cols #2', 'theme_admin'),
						'2-columns-3' 	=> __('2 Cols #3', 'theme_admin'),
						'3-columns' 	=> __('3 Cols', 'theme_admin'),
						'3-columns-2' 	=> __('3 Cols #2', 'theme_admin'),
						'3-columns-3' 	=> __('3 Cols #3', 'theme_admin'),
						'4-columns' 	=> __('4 Cols', 'theme_admin')
					),
					'images' 		=> array(
						'1-column' 		=> THEME_CUSTOM_ASSETS_URI . '/images/pre-footer-layout/1-column.png',
						'2-columns' 	=> THEME_CUSTOM_ASSETS_URI . '/images/pre-footer-layout/2-columns.png',
						'2-columns-2' 	=> THEME_CUSTOM_ASSETS_URI . '/images/pre-footer-layout/2-columns-2.png',
						'2-columns-3' 	=> THEME_CUSTOM_ASSETS_URI . '/images/pre-footer-layout/2-columns-3.png',
						'3-columns' 	=> THEME_CUSTOM_ASSETS_URI . '/images/pre-footer-layout/3-columns.png',
						'3-columns-2' 	=> THEME_CUSTOM_ASSETS_URI . '/images/pre-footer-layout/3-columns-2.png',
						'3-columns-3' 	=> THEME_CUSTOM_ASSETS_URI . '/images/pre-footer-layout/3-columns-3.png',
						'4-columns' 	=> THEME_CUSTOM_ASSETS_URI . '/images/pre-footer-layout/4-columns.png'
					)
				)
				
				
			)
		),
		array(
			'title' 	=> __('Footer', 'theme_admin'),
			'options' 	=> array(
				
				/* array(
					'type' 			=> 'color',
					'id' 			=> 'footer_bg_color',
					'title' 		=> __('Footer BG Color', 'theme_admin'),
					'description' 	=> __('footer background color', 'theme_admin'),
					'default' 		=> '#333333'
				), */
				array(
					'type' 			=> 'textarea',
					'id' 			=> 'footer_copyright_text',
					'title' 		=> __('Copyright Text', 'theme_admin'),
					'description' 	=> __('copyright text you\'d like to display in footer', 'theme_admin'),
					'default' 		=> 'Copyright &copy; 2012 MySite.com. All Rights Reserved'
				),
				
			)
		)
	);
	
	$config = array(
		'title' 		=> __('Footer', 'theme_admin'),
		'group_id' 		=> 'footer',
		'active_first' 	=> false
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>
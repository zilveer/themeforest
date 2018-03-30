<?php 
	
	// Option
	$options = array(
		
		// Slide
		array(
			'title' 	=> __('Slide', 'theme_admin'),
			'options' 	=> array(
				
				
				array(
					'type' 			=> 'select',
					'id' 			=> 'img_slide_effect',
					'title' 		=> __('Slide Effect', 'theme_admin'),
					'description' 	=> __('Choose slide effect', 'theme_admin'),
					'default' 		=> 'fade',
					'options' 		=> array(
						'fade' 				=> __('Fade', 'theme_admin'),
						'slide' 			=> __('Slide', 'theme_admin')
					)
				),
				array(
					'type' 			=> 'range',
					'id' 			=> 'img_slide_pause',
					'title'			=> __('Pause Time', 'theme_admin'),
					'description' 	=> __('0.5 - 10 sec', 'theme_admin'),
					'unit' 			=> 'sec',
					'default' 		=> '3',
					'min' 			=> '0.5',
					'max' 			=> '10',
					'step' 			=> '0.5'
				),
				array(
					'type' 			=> 'range',
					'id' 			=> 'img_slide_animate_speed',
					'title' 		=> __('Animation Speed', 'theme_admin'),
					'description' 	=> __('0.1 - 3 sec', 'theme_admin'),
					'unit' 			=> 'sec',
					'default' 		=> '0.5',
					'min' 			=> '0.1',
					'max' 			=> '3',
					'step' 			=> '0.1'
				),
				
				
						
			)
		),
		array(
			'title' 	=> __('Structure', 'theme_admin'),
			'options' 	=> array(
				array(
					'type' 			=> 'text',
					'id' 			=> 'slug',
					'title' 		=> __('Custom Slug', 'theme_admin'),
					'description' 	=> __('if you change this field, you have to go to <strong>setting > permalink</strong> and <strong>save</strong> to flush rewrite rule', 'theme_admin'),
					'default' 		=> 'portfolio',
				),
				array(
					'type' 			=> 'select',
					'id' 			=> 'archive',
					'title' 		=> __('Archive Page', 'theme_admin'),
					'description' 	=> __('will show in breadcrumb of single portfolio', 'theme_admin'),
					'default' 		=> '',
					'source'		=> array(
						'post_type'	=> 'page'
					)
				),
			)
		),

	);
	
	$config = array(
		'title'	 	=> __('Portfolio', 'theme_admin'),
		'group_id' 	=> 'portfolio',
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>
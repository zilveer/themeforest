<?php 
	
	// Option
	$options = array(
		
		// Type
		array(
			'title' 	=> __('Home Type', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'radio',
					'id' 			=> 'home_type',
					'toggle' 		=> 'toggle-home-type',
					'title' 		=> __('Type', 'theme_admin'),
					'description' 	=> __('choose page type to set as home page', 'theme_admin'),
					'default' 		=> 'page',
					'options' 		=> array(
						'page' 			=> 'Page',
						'app' 			=> 'Single Application',
						'blog' 			=> 'Blog'
					),
				),
				array(
					'type' 			=> 'select',
					'id' 			=> 'home_page',
					'toggle_group' 	=> 'toggle-home-type toggle-home-type-page',
					'title' 		=> __('Home Page', 'theme_admin'),
					'description' 	=> __('this page will be displayed as a Home Page', 'theme_admin'),
					'default' 		=> '0',
					'options'		=>	array(
						'0'			=>	'&mdash; Select &mdash;'
					),
					'source' 		=> array(
						'post_type' 	=> 'page'
					)
				),
				
				array(
					'type' 			=> 'select',
					'id' 			=> 'home_layout',
					'toggle_group' 	=> 'toggle-home-type toggle-home-type-page',
					'title' 		=> __('Layout', 'theme_admin'),
					'description' 	=> __('choose layout of the home page, some element work nice only on full width layout', 'theme_admin'),
					'default' 		=> 'full-width',
					'options' 		=> array(
						'full-width' 	=> __('Full Width', 'theme_admin'),
						'sidebar-right' => __('Sidebar', 'theme_admin')
					)
				),
				
				
				array(
					'type' 			=> 'select',
					'id' 			=> 'home_app_page',
					'toggle_group' 	=> 'toggle-home-type toggle-home-type-app',
					'title' 		=> __('Application', 'theme_admin'),
					'description' 	=> __('this page will be displayed as a Home Page', 'theme_admin'),
					'default' 		=> '',
					'source' 		=> array(
						'post_type' 	=> 'app'
					)
				),
				
			)
		),
		
		// Slide & Apps Dock
		array(
			'title' 	=> __('Slide & Apps Dock', 'theme_admin'),
			'options' 	=> array(
				
				
				array(
					'type' 			=> 'radio_img',
					'id' 			=> 'home_feature_style',
					'toggle' 		=> 'toggle-home-feature-style',
					'title' 		=> __('Style', 'theme_admin'),
					'description' 	=> __('choose home page style', 'theme_admin'),
					'default' 		=> 'imgs-slide',
					'options' 		=> array(
						'imgs-slide' 	=> __('Slide', 'theme_admin'),
						'apps-slide' 	=> __('Apps Dock', 'theme_admin')
					),
					'images' => array(
						'imgs-slide' => 'home-style/img-slide.png',
						'apps-slide' => 'home-style/apps-slide.png'
					)
				),
				
				
				// Apps Slide
				array(
					'type' 			=> 'range',
					'id' 			=> 'apps_slide_number',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-apps-slide',
					'title' 		=> __('App Count', 'theme_admin'),
					'description' 	=> __('amount of App to show each time', 'theme_admin'),
					'unit' 			=> 'icon',
					'default' 		=> '4',
					'min' 			=> '1',
					'max' 			=> '5',
					'step' 			=> '1'
				),
				
				// IMGs Slide
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'img_slide_full_frame',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Full Width', 'theme_admin'),
					'description' 	=> __('Turn off if you want a 950px width & non-scaled slide', 'theme_admin'),
					'default' 		=> 'on'
				),
				array(
					'type' 			=> 'select',
					'id' 			=> 'img_slide_effect',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Slide Effect', 'theme_admin'),
					'description' 	=> __('Choose slide effect', 'theme_admin'),
					'default' 		=> 'slide',
					'options' 		=> array(
						'fade' 				=> __('Fade', 'theme_admin'),
						'slide' 			=> __('Slide', 'theme_admin')
					)
				),
				array(
					'type' 			=> 'select',
					'id' 			=> 'img_slide_direction',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Slide Direction', 'theme_admin'),
					'description' 	=> __('Choose slide Direction', 'theme_admin'),
					'default' 		=> 'horizontal',
					'options' 		=> array(
						'horizontal' 		=> __('Horizontal', 'theme_admin'),
						'vertical' 			=> __('Vertical', 'theme_admin')
					)
				),
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'img_slide_auto',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Auto Start', 'theme_admin'),
					'description' 	=> __('Animate slider automatically', 'theme_admin'),
					'default' 		=> 'on'
				),
				array(
					'type' 			=> 'range',
					'id' 			=> 'img_slide_pause',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Pause Time', 'theme_admin'),
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
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Animation Speed', 'theme_admin'),
					'description' 	=> __('0.1 - 3 sec', 'theme_admin'),
					'unit' 			=> 'sec',
					'default' 		=> '0.5',
					'min' 			=> '0.1',
					'max' 			=> '3',
					'step' 			=> '0.1'
				),
				/*
				array(
					'type' 			=> 'range',
					'id' 			=> 'img_slide_width',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Frame\'s Width', 'theme_admin'),
					'description' 	=> __('500 - 954 px', 'theme_admin'),
					'unit' 			=> 'px',
					'default' 		=> '750',
					'min' 			=> '500',
					'max' 			=> '954',
					'step' 			=> '10'
				),
				*/
				array(
					'type' 			=> 'range',
					'id' 			=> 'img_slide_height',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Frame\'s Height', 'theme_admin'),
					'description' 	=> __('200 - 400 px', 'theme_admin'),
					'unit' 			=> 'px',
					'default' 		=> '300',
					'min' 			=> '200',
					'max' 			=> '400',
					'step' 			=> '10'
				),
				/*
				array(
					'type' 			=> 'range',
					'id' 			=> 'img_slide_border',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Frame Border Size', 'theme_admin'),
					'description' 	=> __('0 - 15 px', 'theme_admin'),
					'unit' 			=> 'px',
					'default' 		=> '3',
					'min' 			=> '0',
					'max' 			=> '15',
					'step' 			=> '1'
				),
				array(
					'type' 			=> 'color',
					'id' 			=> 'img_slide_border_color',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Frame Color', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> '#FFFFFF'
				),
				*/
				array(
					'type' 			=> 'color',
					'id' 			=> 'img_slide_caption_title_bg_color',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Caption Title BG Color', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> '#FF5400'
				),
				array(
					'type' 			=> 'color',
					'id' 			=> 'img_slide_caption_title_text_color',
					'toggle_group' 	=> 'toggle-home-feature-style toggle-home-feature-style-imgs-slide',
					'title' 		=> __('Caption Title Text Color', 'theme_admin'),
					'description' 	=> __('Leave blank to let the theme automatically choose.', 'theme_admin'),
					'default' 		=> '#FFFFFF'
				),
				
						
			)
		),
		
	);
	
	$config = array(
		'title' => 'Home',
		'group_id' => 'home',
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>
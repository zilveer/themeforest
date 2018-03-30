<?php 
	
	// Option
	$options = array(
		
		// Header
		array(
			'title' 	=> __('Header Options', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'radio',
					'id' 			=> 'style',
					'toggle'	=>	'toggle-header-style',
					'title' 		=> __('Style', 'theme_admin'),
					'description' 	=> __('header style', 'theme_admin'),
					'default' 		=> 'light',
					'options' 		=> array(
						'light' 	=> __('Light', 'theme_admin'),
						'dark' 		=> __('Dark', 'theme_admin'),
					),
				),
				array(
					'type' 			=> 'color',
					'id' 			=> 'bg_color',
					'toggle_group'	=>	'toggle-header-style toggle-header-style-dark',
					'title' 		=> __('Header BG Color', 'theme_admin'),
					'description' 	=> __('leave blank to use the same color as primary color (recommended)', 'theme_admin'),
					'default' 		=> ''
				),
				// Image
				array(
					'type' 			=> 'image',
					'id' 			=> 'logo',
					'title' 		=> __('Logo Image', 'theme_admin'),
					'description' 	=> __('recommended height is 60px', 'theme_admin')
				),
				array(
					'type' 			=> 'image',
					'id' 			=> 'logo_2x',
					'title' 		=> __('Logo Image 2x', 'theme_admin'),
					'description' 	=> __('2x size for retina display', 'theme_admin')
				),
				array(
					'type' 			=> 'range',
					'id' 			=> 'logo_margin_top',
					'title' 		=> __('Space above Logo', 'theme_admin'),
					'description' 	=> __('header height is related to this value', 'theme_admin'),
					'unit' 			=> 'px',
					'default' 		=> '45',
					'min' 			=> '0',
					'max' 			=> '100',
					'step' 			=> '1'
				),	
			)
		),

		// Social
		array(
			'title' 	=> __('Social Options', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'rss',
					'title' 		=> __('Show RSS', 'theme_admin'),
					'description' 	=> __('enable to show RSS feed link', 'theme_admin'),
					'default' 		=> 'on'
				),
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'search',
					'title' 		=> __('Show Search', 'theme_admin'),
					'description' 	=> __('enable to show search form', 'theme_admin'),
					'default' 		=> 'on'
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'phone',
					'title' 		=> __('Phone Number', 'theme_admin'),
					'description' 	=> __('eg: +1-541-754-3010', 'theme_admin'),
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'email',
					'title' 		=> __('Email', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),

				array(
					'type' 			=> 'text',
					'id' 			=> 'facebook',
					'title' 		=> __('Facebook', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'twitter',
					'title' 		=> __('Twitter', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'google-plus',
					'title' 		=> __('Google+', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'linkedin',
					'title' 		=> __('LinkedIn', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'pinterest',
					'title' 		=> __('Pinterest', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),

				array(
					'type' 			=> 'text',
					'id' 			=> 'dribbble',
					'title' 		=> __('Dribbble', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'tumblr',
					'title' 		=> __('Tumblr', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'flickr',
					'title' 		=> __('Flickr', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'instagram',
					'title' 		=> __('Instagram', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'youtube',
					'title' 		=> __('Youtube', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
					
			)
		),
		
	);
	
	$config = array(
		'title' 		=> __('Header', 'theme_admin'),
		'group_id' 		=> 'header',
		'active_first' 	=> false
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>
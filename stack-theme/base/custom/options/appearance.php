<?php 
	
// Option
$options = array(
	
	// Background
	array(
		'title' 	=> 'Layout & Background',
		'options' 	=> array(
			
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'enable_responsive',
				'title' 		=> __('Responsive', 'theme_admin'),
				'description' 	=> __('Turn off to disable responsive layout. <a href="http://johnpolacek.github.com/scrolldeck.js/decks/responsive/">What is responsive web design?</a>', 'theme_admin'),
				'default' 		=> 'on'
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'text_rtl',
				'title' 		=> __('RTL text direction', 'theme_admin'),
				'description' 	=> __('turn on for language that read from right to left', 'theme_admin'),
				'default' 		=> 'off'
			),
			array(
				'type' 			=>	'color',
				'id' 			=>	'site_color',
				'title' 		=>	__('Primary Color', 'theme_admin'),
				'description' 	=>	__('this color will be used sitewide', 'theme_admin'),
				'default' 		=>	'#00c5fb',
			),

			array(
				'type' 			=> 'radio',
				'id' 			=> 'site_layout',
				'title'		 	=> __('Layout', 'theme_admin'),
				'description' 	=> __('site layout', 'theme_admin'),
				'toggle'		=>	'toggle-site-layout',
				'default' 		=> 'full-width',
				'options' 		=> array(
					'full-width' 	=> __('Full Width', 'theme_admin'),
					'boxed' 		=> __('Boxed', 'theme_admin'),
				)
			),
			array(
				'type' 			=>	'color',
				'id' 			=>	'site_bg_color',
				'title' 		=>	__('Background Color', 'theme_admin'),
				'description' 	=>	__('choose color to use as background', 'theme_admin'),
				'default' 		=>	'#00c5fb',
				'toggle_group'	=>	'toggle-site-layout toggle-site-layout-boxed'
			),
			array(
				'type' 			=> 'radio_img',
				'id' 			=> 'site_bg_pattern',
				'title'		 	=> __('Background Pattern', 'theme_admin'),
				'description' 	=> __('choose pattern to overlay the background color', 'theme_admin'),
				'toggle_group'	=>	'toggle-site-layout toggle-site-layout-boxed',
				'default' 		=> '',
				'options' 		=> array(
					'' 			=> __('None', 'theme_admin'),
					'bedge_grunge.png' 		=> __('Bedge Grunge', 'theme_admin'),
					'diamond_upholstery.png' 	=> __('Diamond', 'theme_admin'),
					'extra_clean_paper.png' 	=> __('Paper', 'theme_admin'),
					'low_contrast_linen.png' 	=> __('Linen', 'theme_admin'),
					'mochaGrunge.png' 	=> __('Mocha Grunge', 'theme_admin'),
					'noisy_grid.png' 	=> __('Noisy Grid', 'theme_admin'),
					'square_bg.png' 	=> __('Square BG', 'theme_admin'),
					'stressed_linen.png' 	=> __('Diamond', 'theme_admin'),
					'subtle_freckles.png' 	=> __('Freckles', 'theme_admin'),
					'subtle_grunge.png' 	=> __('Subtle Grunge', 'theme_admin'),
					'subtle_white_feathers.png' 	=> __('Feathers', 'theme_admin'),
					'wavegrid.png' 	=> __('Wave Grid', 'theme_admin'),
					'wood_pattern.png' 	=> __('Wood Pattern', 'theme_admin'),
				),
				'images' 		=> array(
					'' 			=> '',
					'bedge_grunge.png' 		=> THEME_URI . '/images/patterns/bedge_grunge.png',
					'diamond_upholstery.png' 	=> THEME_URI . '/images/patterns/diamond_upholstery.png',
					'extra_clean_paper.png' 	=> THEME_URI . '/images/patterns/extra_clean_paper.png',
					'low_contrast_linen.png' 	=> THEME_URI . '/images/patterns/low_contrast_linen.png',
					'mochaGrunge.png' 	=> THEME_URI . '/images/patterns/mochaGrunge.png',
					'noisy_grid.png' 	=> THEME_URI . '/images/patterns/noisy_grid.png',
					'square_bg.png' 	=> THEME_URI . '/images/patterns/square_bg.png',
					'stressed_linen.png' 	=> THEME_URI . '/images/patterns/stressed_linen.png',
					'subtle_freckles.png' 	=> THEME_URI . '/images/patterns/subtle_freckles.png',
					'subtle_grunge.png' 	=> THEME_URI . '/images/patterns/subtle_grunge.png',
					'subtle_white_feathers.png' 	=> THEME_URI . '/images/patterns/subtle_white_feathers.png',
					'wavegrid.png' 	=> THEME_URI . '/images/patterns/wavegrid.png',
					'wood_pattern.png' 	=> THEME_URI . '/images/patterns/wood_pattern.png',
				)
			),

			array(
				'type' 			=> 'image',
				'id' 			=> 'site_bg_image',
				'title' 		=> __('Background Image', 'theme_admin'),
				'description' 	=> __('choose image to use as background', 'theme_admin'),
				'toggle_group'	=>	'toggle-site-layout toggle-site-layout-boxed'
			),
			array(
				'type' 			=> 'select',
				'id' 			=> 'site_bg_repeat',
				'title' 		=> __('Background Repeat', 'theme_admin'),
				'description' 	=> __('choose the repeat type of site background', 'theme_admin'),
				'default' 		=> 'stretch',
				'options' 		=> array(
					'stretch' 		=> __('Stretch', 'theme_admin'),
					'no-repeat' 	=> __('No Repeat', 'theme_admin'),
					'repeat' 		=> __('Repeat', 'theme_admin'),
					'repeat-x' 		=> __('Repeat X', 'theme_admin'),
					'repeat-y' 		=> __('Repeat Y', 'theme_admin')
				),
				'toggle_group'	=>	'toggle-site-layout toggle-site-layout-boxed'
			),		
					
		)
	),


	// Background
	array(
		'title' 	=> 'Title',
		'options' 	=> array(
			
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'enable_breadcrumb',
				'title' 		=> __('Show Breadcrumb', 'theme_admin'),
				'description' 	=> __('Turn off to disable breadcrumb', 'theme_admin'),
				'default' 		=> 'on'
			),	
					
		)
	),
	
);

$config = array(
	'title'			=> __('Appearance', 'theme_admin'),
	'group_id' 		=> 'appearance',
	'active_first' 	=> false
);
	
	
return array( 'options' => $options, 'config' => $config );

?>
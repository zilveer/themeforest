<?php 
	
	// Option
	$options = array(
		
		// Branding
		array(
				'title' 	=> 'Branding',
				'options' 	=> array(
					
					array(
						'type' 			=> 'image',
						'id' 			=> 'branding_favicon',
						'extensions' 	=> 'ico',
						'title' 		=> __('Favicon', 'theme_admin'),
						'description' 	=> __('must be "png" file with 1:1 ratio<br />32 x 32 pixel is recomended', 'theme_admin')
					),
					array(
						'type' 			=> 'image',
						'id' 			=> 'branding_admin_logo',
						'title' 		=> __('WP Login Logo', 'theme_admin'),
						'description' 	=> __('logo to be shown on WP-Admin Login Page<br />recomend image width 320px+', 'theme_admin')
					)
					
				)
			),
		
	);
	
	$config = array(
		'title'			=> __('Branding', 'theme_admin'),
		'group_id' 		=> 'branding',
		'active_first' 	=> false
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>
<?php
require_once(GDLR_LOCAL_PATH . '/include/plugin/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'gdlr_register_required_plugins' );
if( !function_exists('gdlr_register_required_plugins') ){
	function gdlr_register_required_plugins(){
		$plugins = array(
			array(
				'name'     				=> 'masterslider',
				'slug'     				=> 'masterslider', 
				'source'   				=> GDLR_LOCAL_PATH . '/include/plugin/plugins/masterslider.zip',
				'version'               => '2.25.4',
				'required' 				=> true,
				'force_activation' 		=> false,
				'force_deactivation' 	=> true, 
			),
			array(
				'name'     				=> 'Goodlayers Soccer',
				'slug'     				=> 'goodlayers-soccer', 
				'source'   				=> GDLR_LOCAL_PATH . '/include/plugin/plugins/goodlayers-soccer.zip',
				'version'               => '1.0.0',
				'required' 				=> true,
				'force_activation' 		=> false,
				'force_deactivation' 	=> false, 
			),
			array(
				'name'     				=> 'Goodlayers Importer',
				'slug'     				=> 'goodlayers-importer', 
				'source'   				=> GDLR_LOCAL_PATH . '/include/plugin/plugins/goodlayers-importer.zip',
				'version'               => '1.0.0',
				'required' 				=> true,
				'force_activation' 		=> false,
				'force_deactivation' 	=> false, 
			),		
			array(
				'name'     				=> 'Goodlayers Shortcode',
				'slug'     				=> 'gdlr-shortcode', 
				'source'   				=> GDLR_LOCAL_PATH . '/include/plugin/plugins/gdlr-shortcode.zip',
				'required' 				=> true,
				'force_activation' 		=> false,
				'force_deactivation' 	=> false, 
			),
			array(
				'name'     				=> 'Goodlayers Portfolio',
				'slug'     				=> 'gdlr-portfolio', 
				'version'               => '1.0.0',
				'source'   				=> GDLR_LOCAL_PATH . '/include/plugin/plugins/gdlr-portfolio.zip',
				'required' 				=> true,
				'force_activation' 		=> false,
				'force_deactivation' 	=> false, 
			),
			array('name' => 'Contact Form 7', 'slug' => 'contact-form-7', 'required' => true),
			array('name' => 'Wp Google Maps', 'slug' => 'wp-google-maps', 'required' => false),
			array('name' => 'Category Order and Taxonomy Terms Order', 'slug' => 'taxonomy-terms-order', 'required' => true),
		);

		$config = array(
			'domain'       		=> 'gdlr_translate',         
			'default_path' 		=> '',                         
			'parent_menu_slug' 	=> 'themes.php', 			
			'parent_url_slug' 	=> 'themes.php', 			
			'menu'         		=> 'install-required-plugins', 
			'has_notices'      	=> true,                       
			'is_automatic'    	=> false,					   
			'message' 			=> '',						
			'strings'      		=> array(
				'page_title'                       			=> __('Install Required Plugins', 'gdlr_translate' ),
				'menu_title'                       			=> __('Install Plugins', 'gdlr_translate' ),
				'installing'                       			=> __('Installing Plugin: %s', 'gdlr_translate' ), 
				'oops'                             			=> __('Something went wrong with the plugin API.', 'gdlr_translate' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), 
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), 
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), 
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', 'gdlr_translate' ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'gdlr_translate' ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'gdlr_translate' ), 
				'nag_type'									=> 'updated'
			)
		);

		tgmpa( $plugins, $config );
	}
}
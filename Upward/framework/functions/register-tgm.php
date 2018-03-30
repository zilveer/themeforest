<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - TGM

		1.1 - Include
		1.2 - Hook

*/

/*= 1 ===========================================

	T G M
	Plugin activation class

===============================================*/

	/*-------------------------------------------
		1.1 - Include
	-------------------------------------------*/

	require_once dirname( __FILE__ ) . '/classes/class-tgm-plugin-activation.php';



	/*-------------------------------------------
		1.2 - Hook
	-------------------------------------------*/

	function st_register_required_plugins() {
	
		$plugins = array(
	
			array(
				'name'     				=> 'ST Kit',
				'slug'     				=> 'stkit',
				'source'   				=> 'http://strictthemes.com/to/download-stkit',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),

		);
	
		$config = array(
			'domain'       		=> 'strictthemes',
			'default_path' 		=> '',
			'parent_menu_slug' 	=> 'themes.php',
			'parent_url_slug' 	=> 'themes.php',
			'menu'         		=> 'install-required-plugins',
			'has_notices'      	=> true,
			'is_automatic'    	=> true,
			'message' 			=> '',
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', 'strictthemes' ),
				'menu_title'                       			=> __( 'Install Plugins', 'strictthemes' ),
				'installing'                       			=> __( 'Installing Plugin: %s', 'strictthemes' ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', 'strictthemes' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', 'strictthemes' ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'strictthemes' ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'strictthemes' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
	
		tgmpa( $plugins, $config );
	
	}

	add_action( 'tgmpa_register', 'st_register_required_plugins' );



?>
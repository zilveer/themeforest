<?php
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
						array(
							'name'                  => 'Slider Revolution', // The plugin name
							'slug'                  => 'revslider', // The plugin slug (typically the folder name)
							'source'                => THEME_INSTALLER . '/revslider.zip', // The plugin source
							'required'              => false, // If false, the plugin is only 'recommended' instead of required
							'version'               => '5.2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
							'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
							'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
							'external_url'          => '', // If set, overrides default API URL and points to an external URL
						), 						
		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		 
					$theme_text_domain = 'theme_admin';	 
					$config = array(
						'id'           => 'ttb_striking_r',  
						'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
						'default_path'      => '',                           // Default absolute path to pre-packaged plugins
						'parent_slug'  => 'themes.php',         // Default parent menu slug
						'menu'              => 'install-required-plugins',   // Menu slug
						'has_notices'       => true,                         // Show admin notices or not
						'is_automatic'      => false,            // Automatically activate plugins after installation or not
						'message'           => '',               // Message to output right before the plugins table
						'strings'           => array(
							'page_title'                                => __( 'Install Theme Plugins', 'theme_admin' ),
							'menu_title'                                => __( 'Install plugins', 'heme_admin' ),
							'installing'                                => __( 'Installing plugin: %s', 'theme_admin' ), // %1$s = plugin name
							'oops'                                      => __( 'Something went wrong with the plugin API.', 'theme_admin' ),
							'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'theme_admin' ), // %1$s = plugin name(s)
							'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'theme_admin' ), // %1$s = plugin name(s)
							'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'theme_admin' ), // %1$s = plugin name(s)
							'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'theme_admin' ), // %1$s = plugin name(s)
							'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'theme_admin' ), // %1$s = plugin name(s)
							'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'theme_admin' ), 
							'notice_ask_to_update'                      => __( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'theme_admin' ), 
							'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'theme_admin' ), // %1$s = plugin name(s)
							'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'theme_admin' ),
							'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'theme_admin' ),
							'return'                                    => __( 'Return to Theme Plugins Installer', 'theme_admin' ),
							'plugin_activated'                          => __( 'Plugin successfully activated.', 'theme_admin' ),
							'complete'                                  => __( 'All plugins installed and successfully activated. %s', 'theme_admin' ) // %1$s = dashboard link
						)
					);

		tgmpa( $plugins, $config );
?>
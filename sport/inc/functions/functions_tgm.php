<?php

/**************************************
TGM PLUGIN ACTIVATION
***************************************/

require_once dirname( __FILE__ ) . '/../lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'canon_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */


function canon_get_tgm_plugins_array() {
	
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(

		array(
			'name'     				=> 'Sport Core Plugin', // The plugin name
			'slug'     				=> 'sport-core-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/sport-core-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			
			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'sport-core-plugin/index.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'Theme Canon',
				'requires'				=> '3.0',
				'tested'				=> '4.3',
				'last_updated'			=> '2015-06-11',
				'sections' 				=> array(
					'description'	 		=> 'Core plugin bundled with Sport theme by Theme Canon.',
				),			
			),
		),

		array(
			'name'     				=> 'Sport Shortcodes Plugin', // The plugin name
			'slug'     				=> 'sport-shortcodes-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/sport-shortcodes-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'sport-shortcodes-plugin/index.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'Theme Canon',
				'requires'				=> '3.0',
				'tested'				=> '4.3',
				'last_updated'			=> '2015-06-11',
				'sections' 				=> array(
					'description'	 		=> 'Shortcodes plugin bundled with Sport theme by Theme Canon.',
				),			
			),
		),

		array(
			'name'     				=> 'Sport Widgets Plugin', // The plugin name
			'slug'     				=> 'sport-widgets-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/sport-widgets-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'sport-widgets-plugin/index.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'Theme Canon',
				'requires'				=> '3.0',
				'tested'				=> '4.3',
				'last_updated'			=> '2015-06-11',
				'sections' 				=> array(
					'description'	 		=> 'Widgets plugin bundled with Sport theme by Theme Canon.',
				),			
			),
		),

		array(
			'name'     				=> 'Envato WordPress Toolkit', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/envato-wordpress-toolkit.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'envato-wordpress-toolkit/index.php',
		),

		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			
			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'revslider/revslider.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'ThemePunch',
				'requires'				=> '3.0',
				'tested'				=> '4.3',
				'last_updated'			=> '2015-06-11',
				'sections' 				=> array(
					'description'	 		=> 'Revolution Slider plugin bundled with Sport theme by Theme Canon.',
				),			
			),
		),

		array(
			'name'     				=> 'Timetable', // The plugin name
			'slug'     				=> 'timetable', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/timetable.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			
			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'timetable/timetable.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'QuanticaLabs',
				'requires'				=> '3.0',
				'tested'				=> '4.3',
				'last_updated'			=> '2015-06-11',
				'sections' 				=> array(
					'description'	 		=> 'Timetable plugin bundled with Sport theme by Theme Canon.',
				),			
			),
		),

		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),


		// This is an example of how to include a plugin pre-packaged with a theme
		// array(
		// 	'name'     				=> 'TGM Example Plugin', // The plugin name
		// 	'slug'     				=> 'tgm-example-plugin', // The plugin slug (typically the folder name)
		// 	'source'   				=> get_template_directory_uri() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source
		// 	'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		// 	'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		// 	'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		// 	'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		// 	'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		// ),

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		// array(
		// 	'name' 		=> 'BuddyPress',
		// 	'slug' 		=> 'buddypress',
		// 	'required' 	=> false,
		// ),

	);

	return $plugins;

}


function canon_register_required_plugins() {

	// Get TGM plugins array
	$plugins = canon_get_tgm_plugins_array();

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'loc_canon';

	
	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'loc_canon' ),
			'menu_title'                      => __( 'Install Plugins', 'loc_canon' ),
			'installing'                      => __( 'Installing Plugin: %s', 'loc_canon' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'loc_canon' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'loc_canon'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'loc_canon'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'loc_canon'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'loc_canon'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'loc_canon' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'loc_canon' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'loc_canon' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'loc_canon' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'loc_canon' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'loc_canon' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'loc_canon' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
		*/
	);

	tgmpa( $plugins, $config );

}


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
function canon_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     				=> 'Kause Core Plugin', // The plugin name
			'slug'     				=> 'kause-core-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/kause-core-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Kause Shortcodes Plugin', // The plugin name
			'slug'     				=> 'kause-shortcodes-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/kause-shortcodes-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Kause Widgets Plugin', // The plugin name
			'slug'     				=> 'kause-widgets-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/kause-widgets-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
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
		),

		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.2.5.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
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
		'id'           => 'canon-kause-tgm',		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      	// Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', 	// Menu slug.
		'capability'   => 'edit_theme_options',    	// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    	// Show admin notices or not.
		'dismissable'  => true,                    	// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      	// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   	// Automatically activate plugins after installation or not.
		'message'      => '',                      	// Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'loc_canon' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'loc_canon' ),
			/* translators: %s: plugin name. * /
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'loc_canon' ),
			/* translators: %s: plugin name. * /
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'loc_canon' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'loc_canon' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'loc_canon'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'loc_canon'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'loc_canon'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'loc_canon'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'loc_canon'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'loc_canon'
			),
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
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'loc_canon' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'loc_canon' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'loc_canon' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'loc_canon' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'loc_canon' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'loc_canon' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'loc_canon' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'loc_canon' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'loc_canon' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );

}


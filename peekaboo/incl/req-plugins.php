<?php
/**
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Peekaboo for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */


//Require WP plugins
require_once get_template_directory() . '/lib/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pkb_register_required_plugins' );

function pkb_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'               => 'Envato Market',
			'slug'               => 'wp-envato-market',
			'source'             => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required'           => false,
			'version'            => '1.0.0-RC2',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => 'http://envato.github.io/wp-envato-market/',
		),

		array(
			'name'             => 'Contact Form 7',
			'slug'             => 'contact-form-7',
			'required'         => false,
			'force_activation' => false,
			'version'          => '4.4.2',
		),

		array(
			'name'             => 'CMB2',
			'slug'             => 'cmb2',
			'required'         => true,
			'force_activation' => false,
			'version'          => '2.2.2.1',
		),

		array(
			'name'             => 'iframe',
			'slug'             => 'iframe',
			'required'         => true,
			'force_activation' => false,
			'version'          => '4.3',
		),

		array(
			'name'             => 'WooCommerce',
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
			'version'          => '2.6.1',
		),

		array(
			'name'               => 'Peekaboo Add-ons',
			'slug'               => 'peekaboo-add-ons',
			'source'             => 'https://github.com/populationtwo/peekaboo-add-ons/archive/master.zip',
			'required'           => true,
			'external_url'       => 'https://github.com/populationtwo/peekaboo-add-ons',
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
	$config = array(
		'id'           => 'peekaboo',
		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',
		// Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',
		// Menu slug.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'peekaboo' ),
			'menu_title'                      => __( 'Install Plugins', 'peekaboo' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'peekaboo' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'peekaboo' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'peekaboo' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'peekaboo'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'peekaboo'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'peekaboo'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'peekaboo'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'peekaboo'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'peekaboo'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'peekaboo'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'peekaboo'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'peekaboo'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'peekaboo' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'peekaboo' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'peekaboo' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'peekaboo' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'peekaboo' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'peekaboo' ),
			'dismiss'                         => __( 'Dismiss this notice', 'peekaboo' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'peekaboo' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'peekaboo' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}

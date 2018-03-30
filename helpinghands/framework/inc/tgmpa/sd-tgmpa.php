<?php
/**
 * TGM Plugin Activation Options
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

require_once dirname( __FILE__ ) . '/plugin-activation.php';

if ( !function_exists( 'sd_required_plugins' ) ) {
	function sd_required_plugins() {
			$plugins = array(
				array(
					'name'     				=> 'Max Mega Menu',
					'slug'     				=> 'megamenu',
					'source'   				=> get_template_directory_uri() . '/framework/plugins/megamenu.zip',
					'required' 				=> true,
					'version' 				=> '',
					'force_activation' 		=> false,
					'force_deactivation' 	=> false,
					'external_url' 			=> '',
				),
				array(
					'name'               => 'Revolution Slider',
					'slug'               => 'revslider',
					'source'             => get_template_directory_uri() . '/framework/plugins/revslider.zip',
					'required'           => false,
					'version'            => '5.2.6',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url' 			=> '',
				),
				array(
					'name'               => 'Visual Composer',
					'slug'               => 'js_composer',
					'source'             => get_template_directory_uri() . '/framework/plugins/js_composer.zip',
					'required'           => true,
					'version'            => '4.12',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'               => 'Ultimate VC Addons',
					'slug'               => 'Ultimate_VC_Addons',
					'source'             => get_template_directory_uri() . '/framework/plugins/Ultimate_VC_Addons.zip',
					'required'           => true,
					'version'            => '3.16.5',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'               => 'SD Theme Functions Helping Hands',
					'slug'               => 'sd-theme-functions-helping-hands',
					'source'             => get_template_directory_uri() . '/framework/plugins/sd-theme-functions-helping-hands.zip',
					'required'           => true,
					'version'            => '1.0.1',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'               => 'Sidebar Generator',
					'slug'               => 'smk-sidebar-generator',
					'source'             => get_template_directory_uri() . '/framework/plugins/smk-sidebar-generator.zip',
					'required'           => true,
					'version'            => '',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'               => 'Easy Digital Downloads',
					'slug'               => 'easy-digital-downloads',
					'source'             => get_template_directory_uri() . '/framework/plugins/easy-digital-downloads.zip',
					'required'           => true,
					'version'            => '',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'               => 'SD Donation',
					'slug'               => 'sd-donations',
					'source'             => get_template_directory_uri() . '/framework/plugins/sd-donations.zip',
					'required'           => true,
					'version'            => '1.8.3',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'               => 'Contact Form 7',
					'slug'               => 'contact-form-7',
					'required'           => false,
				),
				array(
					'name'               => 'Really Simple CAPTCHA',
					'slug'               => 'really-simple-captcha',
					'required'           => false,
				),
		
			);
		
			/**
			 * Array of configuration settings. Amend each line as needed.
			 * If you want the default strings to be available under your own theme domain,
			 * leave the strings uncommented.
			 * Some of the strings are added into a sprintf, so see the comments at the
			 * end of each line for what each argument will be.
			 */
			$config = array(
				'default_path' => '',                      // Default absolute path to pre-packaged plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false,                   // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.
				'strings'      => array(
					'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
					'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
					'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
					'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
					'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.',  'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.',  'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.',  'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.',  'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.',  'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.',  'tgmpa' ), // %1$s = plugin name(s).
					'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',  'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.',  'tgmpa' ), // %1$s = plugin name(s).
					'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins',  'tgmpa' ),
					'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins',  'tgmpa' ),
					'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
					'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
					'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
					'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
				)
			);
		tgmpa($plugins, $config);
	}
	add_action('tgmpa_register', 'sd_required_plugins');
}
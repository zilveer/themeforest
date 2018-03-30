<?php
/*-----------------------------------------------------------------------------------*/
/* TGM Plugin Activation (LayerSlider, etc)
/*-----------------------------------------------------------------------------------*/
add_action( 'tgmpa_register', 'truethemes_register_required_plugins' );

function truethemes_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Include Premium Plugins:
		array(
			'name'     				=> 'LayerSlider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> 'http://s3.truethemes.net.s3.amazonaws.com/theme-included-plugins/layersliderwp.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> 'http://s3.truethemes.net.s3.amazonaws.com/theme-included-plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// Include Plugins from the WordPress Plugin Repository:
		array(
			'name' 		=> 'CU3ER 3D Slider',
			'slug' 		=> 'wpcu3er',
			'required' 	=> false,
		),
		
		array(
			'name' 		=> 'MailChimp List Subscribe Form',
			'slug' 		=> 'mailchimp',
			'required' 	=> false,
		),
		
		array(
			'name' 		=> 'Post Type Order',
			'slug' 		=> 'post-types-order',
			'required' 	=> false,
		),
		
		array(
			'name' 		=> 'WooCommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> false,
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'tt_theme_framework';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,      // Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                      // Default absolute path to pre-packaged plugins
		'menu'              => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'       => true,                    // Show admin notices or not.
        'dismissable'       => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'       => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic'      => true,                   // Automatically activate plugins after installation or not.
		'message' 			=> '<br /><h3>Frequently Asked Questions:</h3><ol style="padding:10px 0;"><li style="padding-bottom:12px;"><strong>How do I install the plugins listed below?</strong><br />Simply hover over each plugin that you\'d like to install and click <em>Install</em>. <a href="http://vimeopro.com/truethemes/karma-4" target="_blank">Detailed video instructions outlined here.</a></li><li><strong>I\'m receiving an Error when trying to install the LayerSlider or Slider Revolution Plugins?</strong><br />These premium plugins are hosted on our Secure Amazon S3 server. Certain web servers do not allow for direct installation of files from an outside server, resulting in the error. A workaround for this is to use the "Bulk Actions" dropdown below. Simply check the boxes next to all plugins, choose "Install" from the Bulk Actions dropdown and click "Apply".</li></ol><br />',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
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
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config ); ?>
<?php

require_once (TEMPLATEPATH . '/libraries/class-tgm-plugin-activation.php');

function om_register_required_plugins() {

	$plugins = array(

			// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'SIDEKICK',
			'slug'      => 'sidekick',
			'required'  => false,
		),
		
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'om_register_required_plugins' );

function om_tgmpa_style_fix() {
  echo '<style>#setting-error-tgmpa {display:block;}</style>';
}
add_action('admin_head', 'om_tgmpa_style_fix');
<?php
global $mango_settings;

/*
 * TGM Plugin Activation
 */

get_template_part('inc/plugins/class-tgm-plugin-activation');

add_action( 'tgmpa_register', 'mango_register_required_plugins' );
function mango_register_required_plugins() {
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		
		array(
            'name'						=> 'WPBakery Visual Composer',
            'slug'						=> 'js_composer',
            'source'					=> mango_plugins . '/js_composer.zip',
            'required'					=> true,
            'version'					=> '4.12.1',
            'force_activation'			=> true,
            'force_deactivation'		=> true,
            'external_url'				=> '',
        ),
        array(
            'name'						=> 'Ultimate VC Addons',
            'slug'						=> 'Ultimate_VC_Addons',
            'source'					=> mango_plugins . '/Ultimate_VC_Addons.zip',
            'version'					=> '3.16.7',
            'external_url'				=> '',
        ),
		array(
            'name'						=> 'Mango Core',
            'slug'						=> 'mango_core',
            'source'					=> mango_plugins . '/mango_core.zip',
            'required'					=> true, 
            'version'					=> '2.0.8',
            'force_activation'			=> true, 
            'force_deactivation'		=> true,
        ),
        array(
            'name'						=> 'Woocommerce',
            'slug'              		=> 'woocommerce',
            'required'          		=> true,
            'version'                   => '2.5.5'
        ),
		array(
			'name' 						=> 'Meta Box',		
			'slug' 						=> 'meta-box', 	
			'required' 					=> true,
            'version'                   => '4.8.7'
		),
		array(
            'name'               		=> 'Regenerate Thumbnails',
            'slug'              	    => 'regenerate-thumbnails',
            'required'           	  	=> false,
            'version'                   => '2.2.6'
        ),
		array(
			'name' 						=> 'Contact Form 7',		
			'slug' 						=> 'contact-form-7', 	
			'required' 					=> false,
            'version'                   => '4.4.2'
		),
        array(
            'name'						=> 'Iconize WordPress',
            'slug'						=> 'iconize',
            'source'					=> mango_plugins . '/iconize.zip',
            'required'					=> true,
            'version'					=> '1.1.4',
            'force_activation'			=> false,
            'force_deactivation'		=> false,
            'external_url'				=> '',
        ),
        array(
            'name'						=> 'Revolution Slider',
            'slug'						=> 'revslider',
            'source'					=> mango_plugins . '/revslider.zip',
            'required'					=> false,
            'version'					=> '5.2.6',
            'force_activation'			=> false,
            'force_deactivation'		=> false,
            'external_url'				=> '',
        ),
        
		array(
            'name'                  	=> 'Simple Custom Post Order',
            'slug'                	  	=> 'simple-custom-post-order',
            'required'           	  	=> false,
            'version'                   => '2.3'
        ),
        array(
            'name'                  	=> 'Font Awesome Share Icons',
            'slug'                	  	=> 'wp-font-awesome-share-icons',
            'required'           	  	=> false,
            'version'                   => '1.0.12'
        ),
        array(
            'name' 						=> 'Subscribe2',
            'slug' 						=> 'subscribe2',
			'source'					=> mango_plugins . '/subscribe2.zip',
            'required' 					=> false,
            'version'                   => '10.21',
			'force_activation'			=> false,
            'force_deactivation'		=> false,
            'external_url'				=> '',
        ),
        array(
            'name'               		=> 'YITH WooCommerce Ajax Search',
            'slug'               	  	=> 'yith-woocommerce-ajax-search',
            'required'            	  	=> false,
            'version'                  => '1.4.0'
        ),
        array(
            'name'               		=> 'YITH WooCommerce Ajax Navigation',
            'slug'               	  	=> 'yith-woocommerce-ajax-navigation',
            'required'            	  	=> false,
            'version'                  => ' 2.3.1'
        ),
        array(
            'name'                  	=> 'Yith Woocommerce Wishlist',
            'slug'                	  	=> 'yith-woocommerce-wishlist',
            'required'           	  	=> false,
            'version'                   => '2.0.15'
        ),

        array(
            'name'                  	=> 'Yith Woocommerce Compare',
            'slug'                	  	=> 'yith-woocommerce-compare',
            'required'           	  	=> false,
            'version'                   => '2.0.8'
        ),
        array(
            'name'                     => 'Envato Toolkit',
            'slug'                     => 'envato-wordpress-toolkit',
            'source'                   => mango_plugins . '/envato-wordpress-toolkit.zip',
            'required'                 => false,
            'version'                  => '1.7.3'
        ),
	);
 
	/**
	 * Array of configuration settings. Uncomment and amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * uncomment the strings and domain.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'mango' ),
            'menu_title'                      => __( 'Install Plugins', 'mango' ),
            'installing'                      => __( 'Installing Plugin: %s', 'mango'), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'mango' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'mango' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'mango' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'mango' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'mango' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'mango'  ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'mango' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'mango'  ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'mango'  ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'mango' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'mango'  ),
            'return'                          => __( 'Return to Required Plugins Installer', 'mango' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'mango' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'mango' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
	tgmpa( $plugins, $config );
 
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'mango_vcSetAsTheme' );
function mango_vcSetAsTheme() {
    // Set Visual Composer
    if (function_exists('vc_set_as_theme')) {
        vc_set_as_theme();
    }
}
if (function_exists('vc_disable_frontend')) {
 /*   vc_disable_frontend();*/
}
?>
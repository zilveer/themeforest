<?php

/**
 * TGM Init Class
 */
include_once ('class-tgm-plugin-activation.php');

function starter_plugin_register_required_plugins() {

	$plugins = array(
		array(
			'name' 		            => 'Redux Framework',
			'slug' 		            => 'redux-framework',
            //'source'                => get_stylesheet_directory() . '/lib/plugins/redux-framework.zip', // The plugin source.
            'required'              => true, // If false, the plugin is only 'recommended' instead of required.
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'          => '', // If set, overrides default API URL and points to an external URL.
		),

        array(
            'name' 		            => 'Visual Composer',
            'slug' 		            => 'js_composer',
            'source'                => get_stylesheet_directory() . '/lib/plugins/js_composer.zip', // The plugin source.
            'required'              => true, // If false, the plugin is only 'recommended' instead of required.
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'          => '', // If set, overrides default API URL and points to an external URL.
        ),

        array(
            'name' 		            => 'Revolution Slider',
            'slug' 		            => 'revslider',
            'source'                => get_stylesheet_directory() . '/lib/plugins/revslider.zip', // The plugin source.
            'required'              => true, // If false, the plugin is only 'recommended' instead of required.
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'          => '', // If set, overrides default API URL and points to an external URL.
        ),

        array(
            'name' 		            => 'Contact Form 7',
            'slug' 		            => 'contact-form-7',
            //'source'                => get_stylesheet_directory() . '/lib/plugins/contact-form-7.zip', // The plugin source.
            'required'              => true, // If false, the plugin is only 'recommended' instead of required.
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'          => '', // If set, overrides default API URL and points to an external URL.
        ),
        
        array(
            'name' 		            => 'WooCommerce',
            'slug' 		            => 'woocommerce',
            //'source'
            'required'              => false, // If false, the plugin is only 'recommended' instead of required.
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'          => '', // If set, overrides default API URL and points to an external URL.
        ),
	);

	$config = array(
		'domain'       		=> LANGUAGE_ZONE,         	    // Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'plugins.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'plugins.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'starter_plugin_register_required_plugins' );
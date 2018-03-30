<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Register the required plugins for this theme
*	--------------------------------------------------------------------- 
*/

add_action( 'tgmpa_register', 'theme_required_plugins' );

function theme_required_plugins() {

    
    // Array of plugin arrays.
    $plugins = array(

        array(
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => MNKY_PLUGINS . '/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '4.12.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => 'http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431', // If set, overrides default API URL and points to an external URL.
        ),        
		array(
            'name'               => 'MNKY Theme Core Extend', // The plugin name.
            'slug'               => 'core-extend', // The plugin slug (typically the folder name).
            'source'             => MNKY_PLUGINS . '/core-extend.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),	
		array(
            'name'               => 'Revolution Slider', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => MNKY_PLUGINS . '/revslider.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '5.2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => 'http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380', // If set, overrides default API URL and points to an external URL.
        ),
		array(
            'name'               => 'Timetable Responsive Schedule For WordPress', // The plugin name.
            'slug'               => 'timetable', // The plugin slug (typically the folder name).
            'source'             => MNKY_PLUGINS . '/timetable.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => 'http://codecanyon.net/item/timetable-responsive-schedule-for-wordpress/7010836', // If set, overrides default API URL and points to an external URL.
        ),
		array(
            'name'               => 'Contact Form 7', // The plugin name.
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '4.4.2',
        ),
		array(
            'name'               => 'Envato Toolkit', // The plugin name.
            'slug'               => 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name).
            'source'             => MNKY_PLUGINS . '/envato-wordpress-toolkit-master.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '1.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => 'https://github.com/envato/envato-wordpress-toolkit', // If set, overrides default API URL and points to an external URL.
        )
    );

    
    // Array of configuration settings.
    $config = array(
        'id'           => 'care',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

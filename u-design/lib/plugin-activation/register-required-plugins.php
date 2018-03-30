<?php
/**
 * This file includes the code that the U-Deisgn theme uses to register
 * the required plugins.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.0
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'udesign_register_required_plugins' );
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
function udesign_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
            
		// Include pre-packaged plugins with the "U-Design" theme
		array(
			'name'     		=> 'Revolution Slider', // The plugin name
			'slug'     		=> 'revslider', // The plugin slug (typically the folder name)
			'source'   		=> get_template_directory() . '/lib/plugins/revslider.zip', // The plugin source
			'required' 		=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 		=> '5.2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 		=> '', // If set, overrides default API URL and points to an external URL
		),
                
		array(
			'name'     		=> 'Essential Grid', // The plugin name
			'slug'     		=> 'essential-grid', // The plugin slug (typically the folder name)
			'source'   		=> get_template_directory() . '/lib/plugins/essential-grid.zip', // The plugin source
			'required' 		=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 		=> '2.1.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 		=> '', // If set, overrides default API URL and points to an external URL
		),
                
                array(
                        'name'                  => 'WPBakery Visual Composer', // The plugin name
                        'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
                        'source'                => get_template_directory() . '/lib/plugins/js_composer.zip', // The plugin source
                        'required'              => false, // If false, the plugin is only 'recommended' instead of required
                        'version'               => '4.12', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                        'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                        'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                        'external_url'          => '', // If set, overrides default API URL and points to an external URL
                ),
                
		array(
			'name'     		=> 'U-Design Shortcode Insert Button', // The plugin name
			'slug'     		=> 'udesign-shortcode-insert-button', // The plugin slug (typically the folder name)
			'source'   		=> get_template_directory() . '/lib/plugins/udesign-shortcode-insert-button.zip', // The plugin source
			'required' 		=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 		=> '1.1.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 		=> '', // If set, overrides default API URL and points to an external URL
		),
                
		array(
			'name'     		=> 'U-Design WooCommerce Integration', // The plugin name
			'slug'     		=> 'u-design-woocommerce', // The plugin slug (typically the folder name)
			'source'   		=> get_template_directory() . '/lib/plugins/u-design-woocommerce.zip', // The plugin source
			'required' 		=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 		=> '2.1.15', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 		=> '', // If set, overrides default API URL and points to an external URL
		),
                
		array(
			'name'     		=> 'flickrRSS', // The plugin name
			'slug'     		=> 'flickr-rss', // The plugin slug (typically the folder name)
			'source'   		=> get_template_directory() . '/lib/plugins/flickr-rss.zip', // The plugin source
			'required' 		=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 		=> '5.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 		=> '', // If set, overrides default API URL and points to an external URL
		),
                
                
		// Include plugins from the WordPress Plugin Repository
		array(
			'name' 		=> 'WP-PageNavi',
			'slug' 		=> 'wp-pagenavi',
			'required' 	=> true,
		),
                
		array(
			'name' 		=> 'Get The Image',
			'slug' 		=> 'get-the-image',
			'required' 	=> true,
		),
                
		array(
			'name' 		=> 'WP125',
			'slug' 		=> 'wp125',
			'required' 	=> false,
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
            'id'           => 'u-design-related-plugins',   // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                           // Default absolute path to bundled plugins.
            'menu'         => 'udesign_related_plugins',    // Menu slug.
            'parent_slug'  => 'udesign_options_page',       // Parent menu slug.
            'capability'   => 'edit_theme_options',         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                         // Show admin notices or not.
            'dismissable'  => true,                         // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                           // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true,                         // Automatically activate plugins after installation or not.
            'message'      => '',                           // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'udesign' ),
                'menu_title'                      => __( 'Related Plugins', 'udesign' ),
                'installing'                      => __( 'Installing Plugin: %s', 'udesign' ), // %s = plugin name.
                'oops'                            => __( 'Something went wrong with the plugin API.', 'udesign' ),
                'notice_can_install_required'     => _n_noop( 
                        'This theme requires the following plugin: %1$s.', 
                        'This theme requires the following plugins: %1$s.', 'udesign' 
                ), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop( 
                        'This theme offers the following optional plugin: %1$s.', 
                        'This theme offers the following optional plugins: %1$s.', 'udesign' 
                ), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop(
                        'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                        'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                        'udesign'
                ), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop(
                        'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                        'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                        'udesign'
                ), // %1$s = plugin name(s).
                'notice_ask_to_update_maybe'      => _n_noop(
                        'There is an update available for: %1$s.',
                        'There are updates available for the following plugins: %1$s.',
                        'udesign'
                ), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop(
                        'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                        'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                        'udesign'
                ), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop( 
                        'The following required plugin is currently inactive: %1$s.', 
                        'The following required plugins are currently inactive: %1$s.', 'udesign' 
                ), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 
                        'The following optional plugin is currently inactive: %1$s.', 
                        'The following optional plugins are currently inactive: %1$s.', 'udesign' 
                ), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop(
                        'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                        'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                        'udesign'
                ), // %1$s = plugin name(s).
                'install_link'                    => _n_noop( 
                        'Install the plugin', 
                        'Install the plugins', 
                        'udesign' 
                ),
                'update_link'                     => _n_noop(
                        'Update the plugin',
                        'Update the plugins',
                        'udesign'
                ),
                'activate_link'                   => _n_noop( 
                        'Activate the plugin', 
                        'Activate the plugins', 
                        'udesign' 
                ),
                'return'                          => __( 'Return to Required Plugins Installer', 'udesign' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'udesign' ),
                'activated_successfully'          => __( 'The following plugin was activated successfully:', 'udesign' ),
                'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'udesign' ),  // %1$s = plugin name(s).
                'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'udesign' ),  // %1$s = plugin name(s).
                'complete'                        => __( 'All plugins installed and activated successfully. %s', 'udesign' ), // %s = dashboard link.
                'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'udesign' ),
                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
	);

	tgmpa( $plugins, $config );

}




<?php
/**
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once BARCELONA_SERVER_PATH .'includes/classes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'barcelona_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function barcelona_register_required_plugins() {

	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'      => 'Envato Wordpress Toolkit', // The plugin name.
			'slug'      => 'envato-wordpress-toolkit', // The plugin slug (typically the folder name).
			'source'    => 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip',
			'required'  => false, // If false, the plugin is only 'recommended' instead of required.
		),
		array(
			'name'                  => 'Entry Views', // The plugin name
			'slug'                  => 'entry-views', // The plugin slug (typically the folder name)
			'source'                => BARCELONA_THEME_PATH . 'includes/plugins/entry-views.zip', // The plugin source
			'required'              => false, // If false, the plugin is only 'recommended' instead of required
			'version'               => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),
		array(
			'name'      => 'Force Regenerate Thumbnails',
			'slug'      => 'force-regenerate-thumbnails',
			'required'  => false
		),
		array(
			'name'                  => 'Barcelona. Shortcodes', // The plugin name
			'slug'                  => 'agg-barcelona-shortcodes', // The plugin slug (typically the folder name)
			'source'                => BARCELONA_THEME_PATH . 'includes/plugins/agg-barcelona-shortcodes.zip', // The plugin source
			'required'              => true, // If false, the plugin is only 'recommended' instead of required
			'version'               => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		),
		/*
		array(
			'name'                  => 'Flex ADS', // The plugin name
			'slug'                  => 'agg-flex-ads', // The plugin slug (typically the folder name)
			'source'                => BARCELONA_THEME_PATH . 'includes/plugins/agg-flex-ads.zip', // The plugin source
			'required'              => false, // If false, the plugin is only 'recommended' instead of required
			'version'               => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'                  => 'Smart GIF', // The plugin name
			'slug'                  => 'agg-smart-gif', // The plugin slug (typically the folder name)
			'source'                => BARCELONA_THEME_PATH . 'includes/plugins/agg-smart-gif.zip', // The plugin source
			'required'              => false, // If false, the plugin is only 'recommended' instead of required
			'version'               => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		)*/
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
		'id'           => 'aggressivemotions',          // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                           // Default absolute path to bundled plugins.
		'menu'         => 'install-required-plugins',   // Menu slug.
		'parent_slug'  => 'themes.php',                 // Parent menu slug.
		'capability'   => 'edit_theme_options',         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => false,                        // Show admin notices or not.
		'dismissable'  => true,                         // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                           // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                        // Automatically activate plugins after installation or not.
		'message'      => ''                            // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}
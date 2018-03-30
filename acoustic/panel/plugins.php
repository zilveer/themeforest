<?php
// For documentation of the TGM Plugin Activation class, see http://tgmpluginactivation.com/
get_template_part('panel/libraries/class-tgm-plugin-activation');

/*
 * This is an example of how the theme can suggest/require plugins.
 * It can also be done in a separate array, and then doing an array_merge()
 * Ideally, this code should go into /functions/template_hooks.php
 */

/*
	add_filter('ci_theme_required_plugins', 'ci_theme_add_required_plugins');
	if( !function_exists('ci_theme_add_required_plugins') ):
	function ci_theme_add_required_plugins($plugins)
	{
		// This is an example of how to include a plugin from the WordPress Plugin Repository
		$plugins[] = array(
			'name' => 'WordPress SEO by Yoast',
			'slug' => 'wordpress-seo',
			'required' => false
		);
	
		// This is an example of how to include a plugin pre-packaged with a theme
		$plugins[] = array(
			'name'     				=> 'TGM Example Plugin', // The plugin name
			'slug'     				=> 'tgm-example-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		);
	
		return $plugins;
	}
	endif;
*/


add_action( 'tgmpa_register', 'ci_theme_register_required_plugins' );
if( !function_exists('ci_theme_register_required_plugins') ):
function ci_theme_register_required_plugins() {

	// Default plugins are set via the hooked ci_theme_add_default_required_plugins()
	// If you need to remove a plugin from the defaults, you may want to override or unhook that function,
	// instead of traversing the array itself.
	$plugins = apply_filters( 'ci_theme_required_plugins', array() );
	
	$config = apply_filters( 'ci_theme_required_plugins_config', array(
		'id'           => 'ci_theme',              // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	));

	if ( count( $plugins ) > 0 ) {
		tgmpa( $plugins, $config );
	}

}
endif;

add_filter('ci_theme_required_plugins', 'ci_theme_add_default_required_plugins');
if( !function_exists('ci_theme_add_default_required_plugins') ):
function ci_theme_add_default_required_plugins($plugins)
{
	// Add our default recommended plugins here. Example:

	/*
	$plugins[] = array(
		'name' => 'WP-PageNavi',
		'slug' => 'wp-pagenavi',
		'required' => false
	);
	*/

	return $plugins;
}
endif;

?>
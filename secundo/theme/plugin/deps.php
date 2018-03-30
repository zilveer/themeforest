<?php
/**
 * Array of plugin arrays. Required keys are name and slug.
 * If the source is NOT from the .org repo, then source is also required.
 */
$plugins = array(

	// This is an example of how to include a plugin pre-packaged with a theme
	array(
		'name'               => 'Revolution Slider (included)', // The plugin name
		'slug'               => 'revslider', // The plugin slug (typically the folder name)
		'source'             => CT_THEME_DIR . '/vendor/revslider/revslider.zip', // The plugin source
		'required'           => false, // If false, the plugin is only 'recommended' instead of required
		'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	),
	array(
		'name'               => 'Multiple Sidebars', // The plugin name
		'slug'               => 'multiple-sidebars', // The plugin slug (typically the folder name)
		'source'             => CT_THEME_DIR . '/vendor/multiple-sidebars/multiple-sidebars.zip', // The plugin source
		'required'           => false, // If false, the plugin is only 'recommended' instead of required
		'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	),

);
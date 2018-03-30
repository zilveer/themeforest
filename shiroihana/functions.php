<?php

/* ==========================================================================
	Setup Global Vars
============================================================================= */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if( ! isset( $content_width ) ) {
	$content_width = 1020;
}

/* ==========================================================================
	Option Tree Setup
============================================================================= */

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', defined( 'WP_DEBUG' ) && WP_DEBUG ? '__return_true' : '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Optional: set 'ot_theme_options_parent_slug' filter to null.
 * This will move the Theme Options menu to the top level menu
 */
add_filter( 'ot_theme_options_parent_slug', '__return_null' );

/**
 * This will determine the Theme Options menu position
 */
add_filter( 'ot_theme_options_position', create_function( '', 'return 50;' ) );

/**
 * Optional: set 'ot_meta_boxes' filter to false.
 * This will disable the inclusion of OT_Meta_Box
 */
add_filter( 'ot_meta_boxes', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
require get_template_directory() . '/option-tree/ot-loader.php';

/**
 * Include OptionTree Theme Options.
 */
require get_template_directory() . '/theme-options.php';

/* ==========================================================================
	TGMPA Setup
============================================================================= */

if( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	require get_template_directory() . '/lib/vendor/tgmpa/class-tgm-plugin-activation.php';
}

add_action( 'tgmpa_register', 'shiroi_register_required_plugins' );

/**
 * Register the required/recommended plugins.
 */
function shiroi_register_required_plugins() {

	$plugins = array(
		array(
			'name'     => 'Youxi Builder', 
			'slug'     => 'youxi-builder', 
			'source'   => 'youxi-builder.zip', 
			'required' => false, 
			'version'  => '2.5'
		), 
		array(
			'name'     => 'Youxi Importer', 
			'slug'     => 'youxi-importer', 
			'source'   => 'youxi-importer.zip', 
			'required' => false, 
			'version'  => '1.0'
		), 
		array(
			'name'     => 'Youxi Post Format', 
			'slug'     => 'youxi-post-format', 
			'source'   => 'youxi-post-format.zip', 
			'required' => false, 
			'version'  => '1.2'
		), 
		array(
			'name'     => 'Youxi Shortcode', 
			'slug'     => 'youxi-shortcode', 
			'source'   => 'youxi-shortcode.zip', 
			'required' => false, 
			'version'  => '4.0'
		), 
		array(
			'name'     => 'Youxi Widgets', 
			'slug'     => 'youxi-widgets', 
			'source'   => 'youxi-widgets.zip', 
			'required' => false, 
			'version'  => '2.0'
		), 
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false
		)
	);

	tgmpa( $plugins, array(
		'id'           => 'shiroi', 
		'default_path' => trailingslashit( get_template_directory() . '/plugins' )
	) );
}

/* ==========================================================================
	Include Framework Classes
============================================================================= */

require get_template_directory() . '/lib/framework/core/class-core.php';

require get_template_directory() . '/lib/framework/font/class-font.php';

require get_template_directory() . '/lib/external-api/class-settings-page.php';

/* ==========================================================================
	Include Plugin Configurations
============================================================================= */

require get_template_directory() . '/plugins-config/config-contact-form-7.php';

require get_template_directory() . '/plugins-config/config-youxi-core.php';

require get_template_directory() . '/plugins-config/config-youxi-importer.php';

require get_template_directory() . '/plugins-config/config-youxi-page-builder.php';

require get_template_directory() . '/plugins-config/config-youxi-post-format.php';

require get_template_directory() . '/plugins-config/config-youxi-shortcodes.php';

require get_template_directory() . '/plugins-config/config-youxi-widgets.php';

/* ==========================================================================
	Include Theme Functions
============================================================================= */

require get_template_directory() . '/includes/shiroi-addthis.php';

require get_template_directory() . '/includes/shiroi-colors.php';

require get_template_directory() . '/includes/shiroi-comments.php';

require get_template_directory() . '/includes/shiroi-customizer.php';

require get_template_directory() . '/includes/shiroi-filters.php';

require get_template_directory() . '/includes/shiroi-fonts.php';

require get_template_directory() . '/includes/shiroi-icons.php';

require get_template_directory() . '/includes/shiroi-layout.php';

require get_template_directory() . '/includes/shiroi-media.php';

require get_template_directory() . '/includes/shiroi-nav-menu.php';

require get_template_directory() . '/includes/shiroi-post.php';

require get_template_directory() . '/includes/shiroi-template-tags.php';

require get_template_directory() . '/includes/shiroi-theme-options.php';

require get_template_directory() . '/includes/shiroi-wp.php';

/* EOF */

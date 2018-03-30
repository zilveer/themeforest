<?php
/**
 * Setup plugin settings
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Setup
 * @subpackage Setting
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'tgmpa_register', 'tokopress_register_required_plugins' );
function tokopress_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(

		/* Required Plugin */
		array(
			'name'		=> 'WooCommerce',
			'slug'		=> 'woocommerce',
			'required'	=> true,
		),

		array(
			'name' 		=> 'Regenerate Thumbnails',
			'slug' 		=> 'regenerate-thumbnails',
			'required' 	=> false,
		),
		
		array(
			'name' 		=> 'WordPress SEO by Yoast',
			'slug' 		=> 'wordpress-seo',
			'required' 	=> false,
		),

		array(
			'name'		=> 'WordPress Importer',
			'slug'		=> 'wordpress-importer',
			'required' 	=> false,
		),

		array(
			'name'		=> 'Widget Importer Exporter',
			'slug'		=> 'widget-importer-exporter',
			'required'	=> false,
		),

		array(
			'name' 		=> 'WooCommerce Grid / List toggle',
			'slug' 		=> 'woocommerce-grid-list-toggle',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Revolution Slider',
			'slug' 		=> 'revslider',
			'source'   	=> 'http://update.primathemes.com/bundles/revslider-v5.2.5.3.zip',
			'version'	=> '5.2.5.3',
			'required' 	=> false,
		),
		
	);

	$config = array(
		'id'           => 'primathemes-plugins',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'primathemes-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}

/* Set Revolution Slider as Theme part and disable Revolution Slider Updater */
if ( function_exists( 'set_revslider_as_theme' ) ) {
	set_revslider_as_theme();
}

add_action( 'admin_head', 'toko_fix_notice_position' );
function toko_fix_notice_position() {
	echo '<style>#update-nag, .update-nag { display: block; float: none; }</style>';
}

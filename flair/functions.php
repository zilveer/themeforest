<?php 

/**
 * Declare TommusRhodus Theme.
 * Then Declare TommusRhodus Theme support.
 * These are used by the TommusRhodus Theme Extras plugin to register the needed functions for this theme.
 * If the theme does not declare tommusrhodus-theme, then all items are loaded to avoid data loss when switching themes. Boom!
 * @since version 1.0.0
 * @author TommusRhodus
 */
if(!( function_exists('ebor_declare_theme_support') )){
	function ebor_declare_theme_support() {
		add_theme_support('tommusrhodus-theme');
		add_theme_support('tommusrhodus-portfolio');
		add_theme_support('tommusrhodus-team');
		add_theme_support('tommusrhodus-client');
		add_theme_support('tommusrhodus-testimonial');
	}
	add_action('after_setup_theme', 'ebor_declare_theme_support', 10);
}

/**
 * Ebor Framework
 * Queue Up Framework
 * @since version 1.0
 * @author TommusRhodus
 */
require_once ( "ebor_framework/init.php" );

/**
 * Queue up page builder elements
 */
require_once ( "page_builder_init.php" );

/**
 * Please use a child theme if you need to modify any aspect of the theme, if you need to, you can add code
 * below here if you need to add extra functionality.
 * Be warned! Any code added here will be overwritten on theme update!
 * Add & modify code at your own risk & always use a child theme instead for this!
 */
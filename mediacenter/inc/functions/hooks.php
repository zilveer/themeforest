<?php
/**
 * Hooks for general setup and extra functions
 */
add_action( 'after_setup_theme', 		'mc_theme_setup',				10 );
add_action( 'after_setup_theme', 		'mc_template_debug_mode', 		20 );
add_action( 'wp_enqueue_scripts', 		'mc_scripts',					10 );
add_action( 'tgmpa_register', 			'mc_register_required_plugins', 10 );
add_action( 'widgets_init', 			'mc_widgets_init', 				10 );
add_action( 'admin_enqueue_scripts', 	'mc_admin_styles',				10 );
add_action( 'template_redirect', 		'mc_content_width',				10 );
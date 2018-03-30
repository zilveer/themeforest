<?php

$theme_config = array(	
	// Theme Types
	'theme_types' => array( 'event', 'portfolio', 'slider', 'person', 'testimonial' ),
	
	// Theme Custom Meta
	'theme_custom_metas' => array( 'page-builder', 'general' ),
	
	// Theme Menus
	'theme_menus' => array(
			'primary' => __('Primary Navigation', 'theme_admin'),
			'footer' => __('Footer Navigation', 'theme_admin')
	),

	'theme_custom_libs' => array(
		'/breadcrumbs-plus/breadcrumbs-plus.php',
	),
	
	// Theme Sidebar
	'theme_sidebars' => array(
		array(
			'id' => 'page',
			'name' => __('Page - Sidebar', 'theme_admin'),
			'description' => __('Page - Sidebar Widget Area', 'theme_admin'),
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
		array(
			'id' => 'home',
			'name' => __('Home - Sidebar', 'theme_admin'),
			'description' => __('Home - Sidebar Widget Area', 'theme_admin'),
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
		array(
			'id' => 'blog',
			'name' => __('Blog - Sidebar', 'theme_admin'),
			'description' => __('Blog - Sidebar Widget Area', 'theme_admin'),
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
		array(
			'id' => 'footer_1',
			'name' => __('1st Footer', 'theme_admin'),
			'description' => __('1st Footer Widget Area', 'theme_admin'),
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
		array(
			'id' => 'footer_2',
			'name' => __('2nd Footer', 'theme_admin'),
			'description' => __('2nd Footer Widget Area', 'theme_admin'),
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
		array(
			'id' => 'footer_3',
			'name' => __('3rd Footer', 'theme_admin'),
			'description' => __('3rd Footer Widget Area', 'theme_admin'),
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
		array(
			'id' => 'footer_4',
			'name' => __('4th Footer', 'theme_admin'),
			'description' => __('4th Footer Widget Area', 'theme_admin'),
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		)
	),
	
	// Theme Shortcode
	'theme_shortcodes' => array('elements'),
	
	// Theme Options
	'theme_options' => array(
		'setup' 		=> array( 'name' => __('Setup', 'theme_admin'), 'icon' => 'download'),
		'branding' 		=> array( 'name' => __('Branding', 'theme_admin'), 'icon' => 'user'),
		'appearance' 	=> array( 'name' => __('Appearance', 'theme_admin'), 'icon' => 'magic'),
		'font' 			=> array( 'name' => __('Font', 'theme_admin'), 'icon' => 'font'),
		'header' 		=> array( 'name' => __('Header', 'theme_admin'), 'icon' => 'th'),
		'footer' 		=> array( 'name' => __('Footer', 'theme_admin'), 'icon' => 'th'),
		'sidebar' 		=> array( 'name' => __('Sidebar', 'theme_admin'), 'icon' => 'th'),
		'page' 		=> array( 'name' => __('Page', 'theme_admin'), 'icon' => 'file'),
		'blog' 			=> array( 'name' => __('Blog', 'theme_admin'), 'icon' => 'file'),
		// 'home' 			=> array( 'name' => __('Home', 'theme_admin'), 'icon' => 'home'),
		// 'apps' 			=> array( 'name' => __('Apps', 'theme_admin'), 'icon' => 'beaker'),
		'portfolio' 	=> array( 'name' => __('Portfolio', 'theme_admin'), 'icon' => 'suitcase'),
		'event' 	=> array( 'name' => __('Event', 'theme_admin'), 'icon' => 'calendar'),
		
		'advance' 		=> array( 'name' => __('Advance', 'theme_admin'), 'icon' => 'cog')
	),

	// Widgets
	'theme_widgets' => array(
		'ads-125',
		'twitter',
		'social',
		'flickr',
		'subnav',
		'contact-form',
		'contact-info',
	),
	
);


<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's demo-import settings
 *
 * @filter us_config_demo-import
 */
return array(
	'main' => array(
		'title' => 'Main Demo',
		'preview_url' => 'http://zephyr.us-themes.com/',
		'front_page' => 'Home',
		'nav_menu_locations' => array(
			'us_main_menu' => 'Main',
			'us_footer_menu' => 'Secondary',
		),		
		'sliders' => array(
			// Keep the order: second should go first because of VC's hiding default value
			'slider-second.zip',
			'slider-main.zip',
		),
		'woocommerce' => TRUE,
	),
);

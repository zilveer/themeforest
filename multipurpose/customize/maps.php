<?php
function multipurpose_customize_register_maps($wp_customize) {
	$wp_customize->add_section('maps', array(
		'title' => __('Maps', 'multipurpose'),
		'priority' => 60
	));
	
	/*
	 * Map customization settings
	 */

	$wp_customize->add_setting('map_api_key', array(
		'sanitize_callback' => 'multipurpose_sanitize_text'
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'map_api_key', array(
		'label' => __('API key:', 'multipurpose'),
		'section' => 'maps',
		'settings' => 'map_api_key'
	)));

}

add_action('customize_register', 'multipurpose_customize_register_maps');
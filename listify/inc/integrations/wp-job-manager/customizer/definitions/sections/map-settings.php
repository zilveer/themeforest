<?php
/**
 * Map Settings
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'map-settings', array(
	'title' => _x( 'Map Settings', 'customizer section title', 'listify' ),
	'panel' => 'listings',
	'priority' => 70
) );

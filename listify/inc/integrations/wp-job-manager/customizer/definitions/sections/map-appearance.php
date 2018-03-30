<?php
/**
 * Map Appearance
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'map-appearance', array(
	'title' => _x( 'Map Appearance', 'customizer section title', 'listify' ),
	'panel' => 'listings',
	'priority' => 60
) );

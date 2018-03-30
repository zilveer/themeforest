<?php
/**
 * Marker Icons
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'marker-icons', array(
	'title' => _x( 'Map Marker Icons', 'customizer section title', 'listify' ),
	'panel' => 'listings',
	'priority' => 90
) );

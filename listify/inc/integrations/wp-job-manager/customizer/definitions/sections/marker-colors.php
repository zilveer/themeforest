<?php
/**
 * Marker Colors
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'marker-colors', array(
	'title' => _x( 'Map Marker Colors', 'customizer section title', 'listify' ),
	'panel' => 'listings',
	'priority' => 80
) );

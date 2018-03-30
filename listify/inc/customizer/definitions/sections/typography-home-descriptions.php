<?php
/**
 * Homepage Descriptions Typography
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'typography-home-descriptions', array(
	'title' => _x( 'Homepage Widget Descriptions', 'customizer section title', 'listify' ),
	'panel' => 'typography',
	'priority' => 60
) );

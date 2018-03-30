<?php
/**
 * Home Headings Typography
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'typography-home-headings', array(
	'title' => _x( 'Homepage Widget Headings', 'customizer section title', 'listify' ),
	'panel' => 'typography',
	'priority' => 50
) );

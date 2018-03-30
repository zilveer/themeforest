<?php
/**
 * Content Headings Typography
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'typography-content-headings', array(
	'title' => _x( 'Content Box Headings', 'customizer section title', 'listify' ),
	'panel' => 'typography',
	'priority' => 40
) );

<?php
/**
 * Font Subset
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'font-subset', array(
	'title' => _x( 'Font Subset', 'customizer section title', 'listify' ),
	'panel' => 'typography',
	'priority' => 20
) );

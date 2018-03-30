<?php
/**
 * Font Pack
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'font-pack', array(
	'title' => _x( 'Font Pack', 'customizer section title', 'listify' ),
	'panel' => 'typography',
	'priority' => 10
) );

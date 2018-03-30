<?php
/**
 * Buttons Typography
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'typography-button', array(
	'title' => _x( 'Buttons', 'customizer section title', 'listify' ),
	'panel' => 'typography',
	'priority' => 70
) );

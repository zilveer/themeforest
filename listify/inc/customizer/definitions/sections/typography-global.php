<?php
/**
 * Global Typography
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'typography-global', array(
	'title' => _x( 'Global', 'customizer section title', 'listify' ),
	'panel' => 'typography',
	'priority' => 30
) );

<?php
/**
 * Global Content
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'content-global', array(
	'title' => _x( 'Global', 'customizer section title', 'listify' ),
	'panel' => 'content',
	'priority' => 10
) );

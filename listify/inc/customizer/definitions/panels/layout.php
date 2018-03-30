<?php
/**
 * Layout
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_panel( 'content', array(
	'title' => _x( 'Content', 'customizer panel title', 'listify' ),
	'priority' => 50
) );

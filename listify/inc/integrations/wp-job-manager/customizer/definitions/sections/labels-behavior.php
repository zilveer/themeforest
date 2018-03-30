<?php
/**
 * Labels & Behavior
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'labels', array(
	'title' => _x( 'Labels & Behavior', 'customizer section title', 'listify' ),
	'panel' => 'listings',
	'priority' => 10
) );

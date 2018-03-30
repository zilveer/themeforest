<?php
/**
 * Page Heading Typography
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'typography-page-headings', array(
	'title' => _x( 'Page Headings', 'customizer section title', 'listify' ),
	'panel' => 'typography',
	'priority' => 40
) );

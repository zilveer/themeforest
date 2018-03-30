<?php
/**
 * Blog Content
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_section( 'content-blog', array(
	'title' => _x( 'Blog', 'customizer section title', 'listify' ),
	'panel' => 'content',
	'priority' => 40
) );

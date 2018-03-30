<?php
/**
 * Blog Content
 *
 * @uses $wp_customize
 * @since 1.5.0
 */

// style
$wp_customize->add_setting( 'content-blog-style', array(
	'default' => 'default'
) );

$wp_customize->add_control( 'content-blog-style', array(
	'label' => __( 'Blog Style', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'default' => __( 'Default', 'listify' ),
		'grid-standard' => __( 'Grid', 'listify' ),
		'grid-cover' => __( 'Grid Cover', 'listify' ),
	),
	'section' => 'content-blog'
) );

// sidebar
$wp_customize->add_setting( 'content-sidebar-position', array(
	'default' => 'right'
) );

$wp_customize->add_control( 'content-sidebar-position', array(
	'label' => __( 'Blog Sidebar Position', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'none' => __( 'None', 'listify' ),
		'left' => __( 'Left', 'listify' ),
		'right' => __( 'Right', 'listify' ),
	),
	'section' => 'content-blog'
) );

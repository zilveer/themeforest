<?php
/**
 * Single listing
 *
 * Lazy in one file for now.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */

// hero style
$wp_customize->add_setting( 'listing-single-hero-style', array(
	'default' => 'default'
) );

$wp_customize->add_control( 'listing-single-hero-style', array(
	'label' => __( 'Header Style', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'default' => __( 'Featured Image', 'listify' ),
		'gallery' => __( 'Gallery Slider', 'listify' )
	),
	'priority' => 10,
	'section' => 'single-listing'
) );

// hero overlay
$wp_customize->add_setting( 'listing-single-hero-overlay-style', array(
	'default' => 'solid'
) );

$wp_customize->add_control( 'listing-single-hero-overlay-style', array(
	'label' => __( 'Header Overlay Style', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'solid' => __( 'Solid', 'listify' ),
		'gradient' => __( 'Gradient', 'listify' )
	),
	'priority' => 15,
	'section' => 'single-listing'
) );

// sidebar position
$wp_customize->add_setting( 'listing-single-sidebar-position', array(
	'default' => 'right'
) );

$wp_customize->add_control( 'listing-single-sidebar-position', array(
	'label' => __( 'Sidebar Position', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'none' => __( 'None', 'listify' ),
		'left' => __( 'Left', 'listify' ),
		'right' => __( 'Right', 'listify' )
	),
	'priority' => 20,
	'section' => 'single-listing'
) );

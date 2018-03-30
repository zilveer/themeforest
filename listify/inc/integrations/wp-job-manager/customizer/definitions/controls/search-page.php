<?php
/**
 * Listing Results
 *
 * Lazy in one file for now.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */

// output
$wp_customize->add_setting( 'listing-archive-output', array(
	'default' => 'map-results'
) );

$wp_customize->add_control( 'listing-archive-output', array(
	'label' => __( 'Display', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'results' => __( 'Results Only', 'listify' ),
		'map-results' => __( 'Map & Results', 'listify' )
	),
	'priority' => 10,
	'section' => 'listing-search'
) );

// position
$wp_customize->add_setting( 'listing-archive-map-position', array(
	'default' => 'side'
) );

$wp_customize->add_control( 'listing-archive-map-position', array(
	'label' => __( 'Map Position', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'side' => __( 'Left', 'listify' ),
		'right' => __( 'Right', 'listify' ),
		'top'  => __( 'Top', 'listify' )
	),
	'priority' => 20,
	'section' => 'listing-search'
) );

// mobile view
$wp_customize->add_setting( 'listing-archive-mobile-view-default', array(
	'default' => 'results'
) );

$wp_customize->add_control( 'listing-archive-mobile-view-default', array(
	'label' => __( 'Default Mobile View', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'results' => __( 'Results', 'listify' ),
		'map' => __( 'Map', 'listify' )
	),
	'priority' => 30,
	'section' => 'listing-search'
) );

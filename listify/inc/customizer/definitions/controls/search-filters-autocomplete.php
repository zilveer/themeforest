<?php
/**
 * Search Filters Autocomplete
 *
 * @uses $wp_customize
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( listify_has_integration( 'facetwp' ) ) {
	return;
}

$wp_customize->add_setting( 'search-filters-autocomplete', array(
	'default' => true
) );

$wp_customize->add_control( 'search-filters-autocomplete', array(
	'label' => __( 'Use Autocomplete for Addresses', 'listify' ),
	'type' => 'checkbox',
	'priority' => 15,
	'section' => 'search-filters'
) );

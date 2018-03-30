<?php
/**
 * Search Filters Reset
 *
 * @uses $wp_customize
 * @since 1.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( listify_has_integration( 'facetwp' ) ) {
	return;
}

$wp_customize->add_setting( 'search-filters-reset', array(
	'default' => true
) );

$wp_customize->add_control( 'search-filters-reset', array(
	'label' => __( 'Output Reset Link', 'listify' ),
	'type' => 'checkbox',
	'priority' => 22,
	'section' => 'search-filters'
) );

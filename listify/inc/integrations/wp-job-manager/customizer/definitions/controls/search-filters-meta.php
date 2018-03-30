<?php
/**
 * Search Filters Meta
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

$wp_customize->add_setting( 'search-filters-meta', array(
	'default' => true
) );

$wp_customize->add_control( 'search-filters-meta', array(
	'label' => __( 'Output Search Filters Meta', 'listify' ),
	'type' => 'checkbox',
	'priority' => 20,
	'section' => 'search-filters'
) );

<?php
/**
 * Search Filters RSS
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

$wp_customize->add_setting( 'search-filters-rss', array(
	'default' => true
) );

$wp_customize->add_control( 'search-filters-rss', array(
	'label' => __( 'Output RSS Link', 'listify' ),
	'type' => 'checkbox',
	'priority' => 21,
	'section' => 'search-filters'
) );

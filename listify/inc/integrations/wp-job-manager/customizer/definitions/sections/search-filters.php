<?php
/**
 * Search Filters
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_section( 'search-filters', array(
	'title' => __( 'Search Filters', 'listify' ),
	'panel' => 'listings',
	'priority' => 30
) );

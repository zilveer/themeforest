<?php
/**
 * Search Results
 *
 * @uses $wp_customize
 * @since 1.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_section( 'search-results', array(
	'title' => __( 'Search Results', 'listify' ),
	'panel' => 'listings',
	'priority' => 40
) );

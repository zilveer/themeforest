<?php
/**
 * Listings Results
 *
 * @uses $wp_customize
 * @since 1.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $listify_strings;

$wp_customize->add_section( 'listing-search', array(
	'title' => __( 'Search Page', 'listify' ),
	'panel' => 'listings',
	'priority' => 20
) );

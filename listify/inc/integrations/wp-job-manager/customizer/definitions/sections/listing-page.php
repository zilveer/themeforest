<?php
/**
 * Listing
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
global $listify_strings;

$wp_customize->add_section( 'single-listing', array(
	'title' => __( 'Listing Page', 'listify' ),
	'panel' => 'listings',
	'priority' => 50
) );

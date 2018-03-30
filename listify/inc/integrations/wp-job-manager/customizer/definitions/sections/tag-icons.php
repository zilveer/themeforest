<?php
/**
 * Tag Icons
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! listify_has_integration( 'wp-job-manager-tags' ) ) {
	return;
}

$wp_customize->add_section( 'tag-icons', array(
	'title' => _x( 'Tag Icons', 'customizer section title', 'listify' ),
	'panel' => 'listings',
	'priority' => 100
) );

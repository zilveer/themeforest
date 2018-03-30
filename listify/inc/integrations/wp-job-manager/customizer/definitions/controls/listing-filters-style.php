<?php
/**
 * FacetWP
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'listing-filters-style', array(
	'default' => 'content-box'
) );

$wp_customize->add_control( 'listing-filters-style', array(
	'label' => __( 'Display Style', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'content-box' => __( 'Content Box', 'listify' ),
		'boxless'  => __( 'Boxless', 'listify' )
	),
	'priority' => 10,
	'section' => 'search-filters'
) );

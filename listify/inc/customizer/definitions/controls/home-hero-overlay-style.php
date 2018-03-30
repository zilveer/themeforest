<?php
/**
 * Homepage Hero Overlay Style
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'home-hero-overlay-style', array(
	'default' => 'solid'
) );

$wp_customize->add_control( 'home-hero-overlay-style', array(
	'label' => __( 'Hero Overlay Style', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'solid' => __( 'Solid', 'listify' ),
		'gradient' => __( 'Gradient', 'listify' )
	),
	'priority' => 30,
	'section' => 'static_front_page'
) );

<?php
/**
 * As Seen On
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// as seen on title
$wp_customize->add_setting( 'as-seen-on-title', array(
	'default' => ''
) );

$wp_customize->add_control( 'as-seen-on-title', array(
	'label' => __( '"As Seen On" Title', 'listify' ),
	'type' => 'text',
	'priority' => 10,
	'section' => 'content-footer'
) );

// as seen on logos
$wp_customize->add_setting( 'as-seen-on-logos', array(
	'default' => ''
) );

$wp_customize->add_control( 'as-seen-on-logos', array(
	'label' => __( '"As Seen On" Logos', 'listify' ),
	'type' => 'textarea',
	'priority' => 20,
	'section' => 'content-footer'
) );

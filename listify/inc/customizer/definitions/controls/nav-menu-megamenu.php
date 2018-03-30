<?php
/**
 * Secondary/Mega Menu
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// secondary menu
$wp_customize->add_setting( 'nav-secondary', array(
	'default' => true,
	'transport' => 'postMessage'
) );

$wp_customize->add_control( 'nav-secondary', array(
	'label' => __( 'Display secondary menu', 'listify' ),
	'type' => 'checkbox',
	'priority' => 30,
	'section' => 'nav-menus',
) );

// megamenu
$wp_customize->add_setting( 'nav-megamenu', array(
	'default' => 'job_listing_category'
) );

$wp_customize->add_control( 'nav-megamenu', array(
	'label' => __( 'Secondary Mega Menu', 'listify' ),
	'type' => 'select',
	'choices' => array_merge( array( 'none' => __( 'None', 'listify' ) ), Listify_Customizer_Utils::get_taxonomy_choices() ),
	'priority' => 40,
	'section' => 'nav-menus'
) );

<?php
/**
 * Labels
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_setting( 'label-singular', array(
	'default' => 'Listing'
) );

$wp_customize->add_control( 'label-singular', array(
	'label' => __( 'Singular Label', 'listify' ),
	'priority' => 10,
	'section' => 'labels'
) );

$wp_customize->add_setting( 'label-plural', array(
	'default' => 'Listings'
) );

$wp_customize->add_control( 'label-plural', array(
	'label' => __( 'Plural Label', 'listify' ),
	'priority' => 20,
	'section' => 'labels'
) );

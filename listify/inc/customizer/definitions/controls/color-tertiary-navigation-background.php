<?php
/**
 * Tertiary Navigation Background Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-tertiary-navigation-background', array(
	'default' => listify_theme_color( 'color-tertiary-navigation-background' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-tertiary-navigation-background',
	array(
		'label' => __( 'Tertiary Navigation Background Color', 'listify' ),
		'priority' => 70,
		'section' => 'color-header-navigation'
	) 
) );

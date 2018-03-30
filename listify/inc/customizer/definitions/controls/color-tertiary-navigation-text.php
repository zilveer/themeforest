<?php
/**
 * Tertiary Navigation Text Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-tertiary-navigation-text', array(
	'default' => listify_theme_color( 'color-tertiary-navigation-text' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-tertiary-navigation-text',
	array(
		'label' => __( 'Tertiary Navigation Text Color', 'listify' ),
		'priority' => 60,
		'section' => 'color-header-navigation'
	) 
) );

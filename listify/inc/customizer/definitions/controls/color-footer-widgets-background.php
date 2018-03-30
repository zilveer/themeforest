<?php
/**
 * Footer Widgets Background Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-footer-widgets-background', array(
	'default' => listify_theme_color( 'color-footer-widgets-background' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-footer-widgets-background',
	array(
		'label' => __( 'Footer Widgets Background Color', 'listify' ),
		'priority' => 30,
		'section' => 'color-footer'
	) 
) );

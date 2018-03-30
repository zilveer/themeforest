<?php
/**
 * Content Box Accent Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-content-accent', array(
	'default' => listify_theme_color( 'color-content-accent' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-content-accent',
	array(
		'label' => __( 'Content Box Accent Color', 'listify' ),
		'priority' => 30,
		'section' => 'color-content'
	) 
) );


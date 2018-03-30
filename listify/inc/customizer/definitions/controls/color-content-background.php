<?php
/**
 * Content Box Background Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-content-background', array(
	'default' => listify_theme_color( 'color-content-background' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-content-background',
	array(
		'label' => __( 'Content Box Background Color', 'listify' ),
		'priority' => 10,
		'section' => 'color-content'
	) 
) );

<?php
/**
 * Input Box Background Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-input-background', array(
	'default' => listify_theme_color( 'color-input-background' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-input-background',
	array(
		'label' => __( 'Input Box Background Color', 'listify' ),
		'priority' => 20,
		'section' => 'color-input'
	) 
) );

<?php
/**
 * Input Box Text Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-input-text', array(
	'default' => listify_theme_color( 'color-input-text' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-input-text',
	array(
		'label' => __( 'Input Box Text Color', 'listify' ),
		'priority' => 10,
		'section' => 'color-input'
	) 
) );

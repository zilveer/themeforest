<?php
/**
 * Input Box Border Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-input-border', array(
	'default' => listify_theme_color( 'color-input-border' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-input-border',
	array(
		'label' => __( 'Input Box Border Color', 'listify' ),
		'priority' => 30,
		'section' => 'color-input'
	) 
) );

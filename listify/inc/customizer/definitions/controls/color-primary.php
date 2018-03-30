<?php
/**
 * Primary Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-primary', array(
	'default' => listify_theme_color( 'color-primary' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-primary',
	array(
		'label' => __( 'Primary Color', 'listify' ),
		'priority' => 20,
		'section' => 'color-global'
	) 
) );

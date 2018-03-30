<?php
/**
 * Header Background Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

// primary background
$wp_customize->add_setting( 'color-header-background', array(
	'default' => listify_theme_color( 'color-header-background' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-header-background',
	array(
		'label' => __( 'Header Background Color', 'listify' ),
		'priority' => 30,
		'section' => 'color-header-navigation'
	) 
) );

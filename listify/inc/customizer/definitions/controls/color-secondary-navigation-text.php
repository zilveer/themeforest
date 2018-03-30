<?php
/**
 * Secondary Navigation Text Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-secondary-navigation-text', array(
	'default' => listify_theme_color( 'color-secondary-navigation-text' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-secondary-navigation-text',
	array(
		'label' => __( 'Secondary Navigation Text Color', 'listify' ),
		'priority' => 40,
		'section' => 'color-header-navigation'
	) 
) );


<?php
/**
 * Body Text Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-body-text', array(
	'default' => listify_theme_color( 'color-body-text' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-body-text',
	array(
		'label' => __( 'Body Text Color', 'listify' ),
		'priority' => 40,
		'section' => 'color-global'
	) 
) );

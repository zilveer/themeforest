<?php
/**
 * Accent Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

// accent
$wp_customize->add_setting( 'color-accent', array(
	'default' => listify_theme_color( 'color-accent' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-accent',
	array(
		'label' => __( 'Accent Color', 'listify' ),
		'priority' => 30,
		'section' => 'color-global'
	) 
) );

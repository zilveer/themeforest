<?php
/**
 * "As Seen On" Background Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-as-seen-on-background', array(
	'default' => listify_theme_color( 'color-as-seen-on-background' )
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-as-seen-on-background',
	array(
		'label' => __( '"As Seen On" Background Color', 'listify' ),
		'priority' => 10,
		'section' => 'color-footer'
	) 
) );

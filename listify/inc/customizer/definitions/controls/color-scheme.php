<?php
/**
 * Color Scheme
 *
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-scheme', array(
	'default' => 'classic',
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new Listify_Customize_Control_ControlGroup_ColorScheme( 
	$wp_customize,
	'color-scheme', 
	array(
		'label' => _x( 'Color Scheme', 'customizer control title', 'listify' ),
		'section' => 'color-scheme',
		'priority' => 10
	)
) );

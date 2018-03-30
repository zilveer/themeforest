<?php
/**
 * Font Pack
 *
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'typography-font-pack', array(
	'default' => 'karla',
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new Listify_Customize_Control_ControlGroup_FontPack( 
	$wp_customize,
	'typography-font-pack', 
	array(
		'label' => _x( 'Font Pack', 'customizer control title', 'listify' ),
		'section' => 'font-pack',
		'priority' => 10
	)
) );

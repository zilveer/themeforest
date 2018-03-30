<?php
/**
 * Global Buttons
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_setting( 'content-button-style', array(
	'default' => 'solid',
	'transport' => 'postMessage'
) );

$wp_customize->add_control( 'content-button-style', array(
	'label' => __( 'Button Style', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'default' => __( 'Default', 'listify' ),
		'solid' => __( 'Solid', 'listify' ),
		'outline' => __( 'Outline', 'listify' )
	),
	'priority' => 20,
	'section' => 'content-global'
) );

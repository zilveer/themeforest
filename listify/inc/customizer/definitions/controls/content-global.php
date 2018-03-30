<?php
/**
 * Global Content 
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_setting( 'content-box-style', array(
	'default' => 'minimal',
	'transport' => 'postMessage'
) );

$wp_customize->add_control( 'content-box-style', array(
	'label' => __( 'Content Box & Widget Style', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'default' => __( 'Default', 'listify' ),
		'minimal' => __( 'Minimal', 'listify' ),
		'shadow' => __( 'Shadow', 'listify' )
	),
	'priority' => 10,
	'section' => 'content-global'
) );

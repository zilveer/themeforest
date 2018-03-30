<?php
/**
 * Map Appearance
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
global $listify_job_manager;

$wp_customize->add_setting( 'map-appearance-scheme', array(
	'default' => 'blue-water',
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new Listify_Customize_Control_ControlGroup_ColorScheme(
	$wp_customize,
	'map-appearance-scheme',
	array(
		'label' => __( 'Color Scheme', 'listify' ),
		'priority' => 20,
		'description' => sprintf( __( 'Some color schemes may show/hide extra information. Please <a href="%s">read more</a> about creating a custom scheme.', 'listify' ), 'http://listify.astoundify.com/article/805-create-a-custom-map-color-scheme' ),
		'section' => 'map-appearance'
	) 
) );

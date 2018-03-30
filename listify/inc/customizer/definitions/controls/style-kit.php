<?php
/**
 * Style Kit
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_setting( 'style-kit', array(
	'default' => 'classic'
) );

$wp_customize->add_control( new Listify_Customize_Control_ControlGroup_StyleKit( 
	$wp_customize,
	'style-kit', 
	array(
		'label' => _x( 'Style Kit', 'customizer control title', 'listify' ),
		'section' => 'style-kit',
		'priority' => 10
	)
) );

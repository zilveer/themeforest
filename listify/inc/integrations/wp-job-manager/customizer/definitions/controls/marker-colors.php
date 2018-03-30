<?php
/**
 * Map Markers Colors
 *
 * @uses $wp_customize
 * @since 1.5.0
 */

// add the control for choosing a color for terms
$taxonomy = listify_get_top_level_taxonomy();
$mods = Listify_Customizer_Utils::get_regex_theme_mods( 'marker-color-' );

$wp_customize->add_control( new Listify_Customize_Control_TermSearch_Colors(
	$wp_customize,
	'marker-term-colors', 
	array(
		'taxonomy' => $taxonomy,
		'existing_terms' => listify_get_decorated_mod_list( $mods ),

		'settings' => array(),
		'section' => 'marker-colors',
		'priority' => 10,
	)
) );

// add a setting for all
$wp_customize->add_setting( 'default-marker-color', array(
	'default' => '#555555'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'default-marker-color', 
	array(
		'label' => __( 'Default', 'listify' ),
		'section' => 'marker-colors',
		'priority' => 20
	)
) );

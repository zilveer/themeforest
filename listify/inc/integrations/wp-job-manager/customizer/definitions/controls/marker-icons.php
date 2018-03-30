<?php
/**
 * Map Markers Icons
 *
 * @uses $wp_customize
 * @since 1.5.0
 */

// add the control for choosing a color for terms
$taxonomy = listify_get_top_level_taxonomy();
$mods = Listify_Customizer_Utils::get_regex_theme_mods( 'listings-' . $taxonomy . '-(.*)-icon' );

$wp_customize->add_control( new Listify_Customize_Control_TermSearch_Icons(
	$wp_customize,
	'marker-term-icons-' . $taxonomy, 
	array(
		'taxonomy' => $taxonomy,
		'existing_terms' => listify_get_decorated_mod_list( $mods, $taxonomy, 'icons' ),
		'description' => __( 'Looking for the perfect icon? Visit the <a href="http://ionicons.com" target="_blank">Ionicons website</a> to easily browse available icons.', 'listify' ),

		'settings' => array(),
		'section' => 'marker-icons',
		'priority' => 10,
	)
) );

// add a setting for all
$wp_customize->add_setting( 'default-marker-icon', array(
	'default' => 'information-circled'
) );

$wp_customize->add_control( new Listify_Customize_Control_BigChoices(
	$wp_customize,
	'default-marker-icon', 
	array(
		'label' => __( 'Default', 'listify' ),
		'choices' => 'icons',
		'section' => 'marker-icons',
		'priority' => 20
	)
) );

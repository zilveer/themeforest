<?php
/**
 * Tag Icons
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! listify_has_integration( 'wp-job-manager-tags' ) ) {
	return;
}

// add the control for choosing a color for terms
$taxonomy = 'job_listing_tag';
$mods = Listify_Customizer_Utils::get_regex_theme_mods( 'listings-' . $taxonomy . '-(.*)-icon' );

$wp_customize->add_control( new Listify_Customize_Control_TermSearch_Icons(
	$wp_customize,
	'marker-term-icons-' . $taxonomy, 
	array(
		'taxonomy' => $taxonomy,
		'existing_terms' => listify_get_decorated_mod_list( $mods, $taxonomy, 'icons' ),
		'description' => __( 'Looking for the perfect icon? Visit the <a href="http://ionicons.com" target="_blank">Ionicons website</a> to easily browse available icons.', 'listify' ),

		'settings' => array(),
		'section' => 'tag-icons',
		'priority' => 10,
	)
) );

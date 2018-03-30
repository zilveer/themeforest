<?php
/**
 * Search Menu Icon
 *
 * @uses $wp_customize
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'nav-search', array(
	'default' => 'left',
	'transport' => 'postMessage'
) );

$wp_customize->add_control( 'nav-search', array(
	'label' => __( 'Search Icon', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'left' => __( 'Left', 'listify' ),
		'right' => __( 'Right', 'listify' ),
		'none' => __( 'None', 'listify' )
	),
	'priority' => 20,
	'section' => 'nav-menus'
) );

if ( ! isset( $wp_customize->selective_refresh ) ) {
	return;
}

$wp_customize->selective_refresh->add_partial( 'nav-search', array(
	'selector' => '.primary.nav-menu',
	'settings' => array( 'nav-search' ),
	'render_callback' => 'listify_partial_primary_nav_menu'
) );

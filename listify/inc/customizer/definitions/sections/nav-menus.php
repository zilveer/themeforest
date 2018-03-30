<?php
/**
 * Navigation Settings
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_section( 'nav-menus', array(
	'title' => _x( 'Settings', 'customizer section title', 'listify' ),
	'panel' => 'nav_menus',
	'priority' => 0
) );

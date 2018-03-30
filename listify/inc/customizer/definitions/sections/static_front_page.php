<?php
/**
 * Static Front Page
 *
 * Move this default section to a new panel and rename.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

if ( $wp_customize->get_section( 'static_front_page' ) ) {
	$wp_customize->get_section( 'static_front_page' )->panel = 'content';
	$wp_customize->get_section( 'static_front_page' )->priority = 30;
	$wp_customize->get_section( 'static_front_page' )->title = _x( 'Home', 'customizer section title', 'listify' );
}

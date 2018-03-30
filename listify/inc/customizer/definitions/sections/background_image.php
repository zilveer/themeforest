<?php
/**
 * Colors.
 *
 * Move this default section to a new panel.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->get_section( 'background_image' )->panel = 'content';

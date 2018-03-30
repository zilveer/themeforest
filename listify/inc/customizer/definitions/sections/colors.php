<?php
/**
 * Colors.
 *
 * Remove this default section. Listify uses a panel.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->remove_section( 'colors' );

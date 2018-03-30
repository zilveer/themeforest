<?php
/**
 * Page Background Color
 *
 * Move this default control to a new section and rename it.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

$wp_customize->get_control( 'background_color' )->section = 'color-global';
$wp_customize->get_control( 'background_color' )->label = __( 'Page Background Color', 'listify' );

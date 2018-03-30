<?php
/**
 * Header Text Color
 *
 * Move this default control.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

$wp_customize->get_control( 'header_textcolor' )->section = 'color-header-navigation';

<?php
/**
 * Content Box Headings
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

listify_font_style_options( 'typography-content-headings', 'content-headings', $wp_customize );

<?php
/**
 * Title & Tagline
 *
 * Move this default section to a new panel and rename.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->get_section( 'title_tagline' )->panel = 'content';
$wp_customize->get_section( 'title_tagline' )->title = _x( 'Header', 'customizer section title', 'listify' );

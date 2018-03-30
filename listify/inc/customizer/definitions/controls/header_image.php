<?php
/**
 * Title & Tagline
 *
 * Move this default control to a new panel and rename.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->get_control( 'header_image' )->section = 'title_tagline';
$wp_customize->get_control( 'header_image' )->label = __( 'Site Logo', 'listify' );

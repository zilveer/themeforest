<?php
/**
 * Page for Posts
 *
 * Move this default control to a new section and rename it.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$control = $wp_customize->get_control( 'page_for_posts' );

if ( ! $control ) {
	return;
}

$control->label = __( 'Page', 'listify' );
$control->section = 'content-blog';
$control->priority = 5;

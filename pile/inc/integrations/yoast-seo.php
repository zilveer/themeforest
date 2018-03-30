<?php
/**
 * Yoast SEO Compatibility File.
 *
 * @link https://wordpress.org/plugins/wordpress-seo/
 *
 * @package Pile
 * @since Pile 2.0
 */

/*
 * Move the Yoast settings box under our builder
 */
function pile_reduce_yoast_metabox_priority( $priority ) {
	return 'default';
}
add_filter( 'wpseo_metabox_prio', 'pile_reduce_yoast_metabox_priority' );
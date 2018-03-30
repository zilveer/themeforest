<?php
/**
 * Redirect location item permalink to page using Locations template
 */

// Get page using Locations template
$page = risen_get_page_by_template( 'tpl-locations.php' );
if ( ! empty( $page->ID ) ) {
	$url = get_permalink( $page->ID ) . '#' . $post->post_name;
}

// If none, send them to homepage
if ( empty( $url ) ) {
	$url = site_url();
}

// Redirect
wp_redirect( $url );

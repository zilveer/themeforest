<?php
/**
 * Redirect staff item permalink to page using Staff template
 */

// Get page using Staff template
$page = risen_get_page_by_template( 'tpl-staff.php' );
if ( ! empty( $page->ID ) ) {
	$url = get_permalink( $page->ID ) . '#' . $post->post_name;
}

// If none, send them to homepage
if ( empty( $url ) ) {
	$url = site_url();
}

// Redirect
wp_redirect( $url );

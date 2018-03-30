<?php

/**
 * Overload function for WordPress Gallery. ( Can be activated from admin )
 */
if ( '1' == blade_grve_option( 'wp_gallery_popup' ) ) {
	add_filter( 'attachment_link', 'blade_grve_wp_gallery_attachment_link', 10, 2 );
}

function blade_grve_wp_gallery_attachment_link( $link, $id ) {

	if ( is_feed() || is_admin() )
		return $link;

	$post = get_post( $id );
	if ( 'image/' == substr( $post->post_mime_type, 0, 6 ) ) {
		$full_src = wp_get_attachment_image_src( $id, 'blade-grve-fullscreen' );
		return $full_src[0];
	} else {
		return $link;
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.

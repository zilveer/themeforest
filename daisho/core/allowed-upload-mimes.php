<?php
/**
 * Adds more allowed file types to Media Library upload.
 *
 * @param array $existing_mimes A list of existing allowed extensions.
 * @return array The filtered list of allowed extensions.
 */
function flow_allowed_upload_mimes( $existing_mimes = array() ) {
	$existing_mimes['svg'] = 'image/svg+xml';
	$existing_mimes['svgz'] = 'image/svg+xml';
	$existing_mimes['weba'] = 'audio/webm';

	return $existing_mimes;
}
add_filter( 'upload_mimes', 'flow_allowed_upload_mimes' );

<?php

$thb_format = thb_get_post_format();

if( $thb_format === 'gallery' ) {
	thb_post_format_gallery( 'large-cropped', 'full', 'rsTHB thb-post-gallery' );
}

if ( thb_page_has_video( get_the_ID() ) || thb_page_has_audio( get_the_ID() ) ) {
	echo '<div class="format-embed-wrapper thb-single-embed">';
		if( $thb_format === 'video' ) {
			thb_post_format_video();
		} elseif ( $thb_format === 'audio' ) {
			thb_post_format_audio();
		}
	echo '</div>';
}
<?php if( $post_format_meta = shiroi_extract_post_format_meta() ) : ?>

<section class="entry-media entry-media-video"><?php

	switch( $post_format_meta['type'] ):

		case 'embed':
			global $wp_embed;
			if( is_a( $wp_embed, 'WP_Embed' ) ):
				echo $wp_embed->autoembed( $post_format_meta['embed'] );
			else:
				echo $post_format_meta['embed'];
			endif;
			break;

		case 'hosted':
			// Check if the attachment is a video
			if( wp_attachment_is( 'video', $post_format_meta['src'] ) ):

				$meta = wp_get_attachment_metadata( $post_format_meta['src'] );
				if( isset( $meta['width'], $meta['height'] ) ) {
					$video_ar = 100.0 * $meta['height'] / $meta['width'];
					printf( '<div class="wp-video-wrapper" style="padding-top: %s%%">', $video_ar );
				}

				echo wp_video_shortcode(array(
					'src' => wp_get_attachment_url( $post_format_meta['src'] ), 
					'poster' => wp_get_attachment_url( $post_format_meta['poster'] )
				));

				if( isset( $video_ar ) ) {
					echo '</div>';
				}
			endif;
			break;

	endswitch; ?>

</section>

<?php else:
	Youxi()->templates->get( 'media/media', null, 'post' );
endif; ?>

<?php if( $post_format_meta = shiroi_extract_post_format_meta() ) : ?>

<section class="entry-media entry-media-audio">

	<?php switch( $post_format_meta['type'] ):

		case 'embed':

			global $wp_embed;
			if( is_a( $wp_embed, 'WP_Embed' ) ):
				echo $wp_embed->autoembed( $post_format_meta['embed'] );
			else:
				echo $post_format_meta['embed'];
			endif;
			break;

		case 'hosted':
		
			if( has_post_thumbnail() ) : ?>
			<figure class="entry-media-image">
				<?php the_post_thumbnail( shiroi_thumbnail_size(), array( 'itemprop' => 'image' ) ); ?>
			</figure>
			<?php endif;

			if( wp_attachment_is( 'audio', $post_format_meta['src'] ) ):
				echo wp_audio_shortcode(array(
					'src' => wp_get_attachment_url( $post_format_meta['src'] )
				));
			endif;
			break;

	endswitch; ?>

</section>

<?php else:
	Youxi()->templates->get( 'media/media', null, 'post' );
endif; ?>

<?php if( $post_format_meta = shiroi_extract_post_format_meta() ) : ?>

<section class="entry-media entry-media-gallery">

	<?php if( 'slider' === $post_format_meta['type'] ):

		$max_ratio = 0;
		foreach( $post_format_meta['images'] as $attachment_id ) {
			if( $attachment = wp_get_attachment_image_src( $attachment_id, shiroi_thumbnail_size() ) ) {
				$max_ratio = max( $max_ratio, $attachment[1] / $attachment[2] );
			}
		}

		shiroi_fotorama( $post_format_meta['images'], array(
			'margin'             => 0, 
			'width'              => '100%', 
			'ratio'              => $max_ratio, 
			'nav'                => false, 
			'fit'                => $post_format_meta['ftmFit'], 
			'transition'         => $post_format_meta['ftmTransition'], 
			'loop'               => $post_format_meta['ftmLoop'], 
			'transitionduration' => $post_format_meta['ftmTransitionDuration'], 
			'show_caption'       => true, 
			'attachment_size'    => shiroi_thumbnail_size()
		));

	else:

		shiroi_justified_grid( $post_format_meta['images'], array(
			'margin'    => absint( $post_format_meta['jst_margin'] ), 
			'minwidth'  => absint( ( 3 / 4 ) * $post_format_meta['jst_minwidth'] ), 
			'minheight' => absint( ( 5 / 8 ) * $post_format_meta['jst_minheight'] )
		));

	endif; ?>

</section>

<?php else:
	Youxi()->templates->get( 'media/media', null, 'post', 'grid' );
endif; ?>

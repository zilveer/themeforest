<?php if( $post_format_meta = shiroi_extract_post_format_meta() ) : ?>

<section class="entry-media entry-media-quote">

	<blockquote>
		<?php echo wpautop( $post_format_meta['text'] );

		if( '' !== $post_format_meta['author'] ): ?>

		<small><?php 

			echo esc_html( $post_format_meta['author'] );

			if( '' !== $post_format_meta['source'] ):

				if( '' !== $post_format_meta['source_url'] ): 

				?><br><a href="<?php echo esc_url( $post_format_meta['source_url'] ) ?>" target="_blank"><?php echo esc_html( $post_format_meta['source'] ) ?></a>
				<?php else: 

				?><br><span><?php echo esc_html( $post_format_meta['source'] ) ?></span>
				<?php endif;

			endif;

		?></small>

		<?php endif; ?>

	</blockquote>

</section>

<?php else:
	Youxi()->templates->get( 'media/media', null, 'post' );
endif; ?>

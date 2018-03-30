<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php thb_post_before(); ?>
<section class="entry-attachment">
	<?php thb_post_start(); ?>
	<?php if ( wp_attachment_is_image() ) :
		$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
		foreach ( $attachments as $k => $attachment ) {
			if ( $attachment->ID == $post->ID )
				break;
		}
		$k++;
		// If there is more than 1 image attachment in a gallery
		if ( count( $attachments ) > 1 ) {
			if ( isset( $attachments[ $k ] ) )
				// get the URL of the next image attachment
				$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
			else
				// or get the URL of the first image attachment
				$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
		} else {
			// or, if there's only 1 image attachment, get the URL of the image
			$next_attachment_url = wp_get_attachment_url();
		}
	?>
	<p class="attachment item-thumb"><?php
		$attachment_size = apply_filters( 'twentyten_attachment_size', 940 );
		echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
	?></p>

	<?php else : ?>
		<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
	<?php endif; ?>

	<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>


	<div class="post-meta">
		<p><?php
			printf(__('<span class="%1$s">By</span> %2$s', 'thb_text_domain'),
				'meta-prep meta-prep-author',
				sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
					get_author_posts_url( get_the_author_meta( 'ID' ) ),
					sprintf( esc_attr__( 'View all posts by %s', 'thb_text_domain' ), get_the_author() ),
					get_the_author()
				)
			);
		?></p>
		<p><?php
			printf( __('<span class="%1$s">Published on</span> %2$s', 'thb_text_domain'),
				'meta-prep meta-prep-entry-date',
				sprintf( '<span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>',
					esc_attr( get_the_time() ),
					get_the_date()
				)
			);
		?></p>
		<p><?php
			if ( wp_attachment_is_image() ) {
				$metadata = wp_get_attachment_metadata();
				printf( __( 'Full size is %s pixels', 'thb_text_domain'),
					sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
						wp_get_attachment_url(),
						esc_attr( __('Link to full-size image', 'thb_text_domain') ),
						$metadata['width'],
						$metadata['height']
					)
				);
			}
		?></p>
	</div><!-- .post-meta -->
	<?php thb_post_end(); ?>
</section><!-- .entry-attachment -->
<?php thb_post_after(); ?>
<?php endwhile; endif; ?>
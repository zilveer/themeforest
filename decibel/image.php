<?php
/**
 * The template for displaying image attachments.
 *
 */
get_header();
?>
<div id="primary" class="content-area image-attachment">
	<main id="content" class="site-content clearfix" role="main">
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'wrap' ); ?>>
			<header class="entry-header">
				<div class="entry-meta">
					<?php
						$published_text  = __( '<span class="attachment-meta">Published on <time class="entry-date" datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a></span>', 'wolf' );
						$post_title = get_the_title( $post->post_parent );
						if ( empty( $post_title ) || 0 == $post->post_parent )
							$published_text  = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';

						printf( $published_text,
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() ),
							esc_url( get_permalink( $post->post_parent ) ),
							esc_attr( strip_tags( $post_title ) ),
							$post_title
						);

						$metadata = wp_get_attachment_metadata();
						printf( '<span class="attachment-meta full-size-link"><a class="lightbox" href="%1$s" title="%2$s">View full %3$s &times; %4$s resolution</a></span>',
							esc_url( wp_get_attachment_url() ),
							esc_attr( strip_tags( $post_title ) ),
							$metadata['width'],
							$metadata['height']
						);

						edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-meta -->

			</header><!-- .entry-header -->

			<div class="entry-content">

				<div class="entry-attachment">
					<div class="attachment">
						<?php
							/**
							 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
							 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
							 */
							$attachments = array_values(
								get_children( array(
								'post_parent'    => $post->post_parent,
								'postwolftatus'    => 'inherit',
								'post_type'      => 'attachment',
								'post_mime_type' => 'image',
								'order'          => 'ASC',
								'orderby'        => 'menu_order ID'
							) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID )
									break;
							}
							$k++;
							// If there is more than 1 attachment in a gallery
							if ( count( $attachments ) > 1 ) {
								if ( isset( $attachments[ $k ] ) )
									// get the URL of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								else
									// or get the URL of the first image attachment
									$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							} else {
								// or, if there's only 1 image, get the URL of the image
								$next_attachment_url = wp_get_attachment_url();
							}
						?>
						<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							$attachmentwolfize = apply_filters( 'wolf_attachmentwolfize', array( 1200, 1200 ) ); // Filterable image size.
							echo wp_get_attachment_image( $post->ID, $attachmentwolfize );
						?></a>
					</div><!-- .attachment -->

					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div><!-- .entry-caption -->
					<?php endif; ?>
				</div><!-- .entry-attachment -->

				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wolf' ), 'after' => '</div>' ) ); ?>

			</div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?> -->

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>

	<?php endwhile; // end of the loop. ?>
	</main><!-- main#content .site-content-->

	<nav id="image-navigation" class="navigation-image clearfix">
		<div class="prev"><?php previous_image_link( false, __( '&larr; Previous', 'wolf' ) ); ?></div>
		<div class="next"><?php next_image_link( false, __( 'Next &rarr;', 'wolf' ) ); ?></div>
	</nav><!-- #image-navigation -->
</div><!-- #primary .content-area -->
<?php get_footer(); ?>

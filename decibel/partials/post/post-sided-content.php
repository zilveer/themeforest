<?php
/**
 * The post loop
 */
$post_id = get_the_ID();
$format = get_post_format() ? get_post_format() : 'standard';
$media = wolf_post_media();
$views = wolf_format_number( absint( get_post_meta( $post_id, '_wolf_views', true ) ) );
$likes =wolf_format_number( absint( get_post_meta( $post_id, '_wolf_likes', true ) ) );
$comments = wolf_format_number( get_comments_number() );
$no_views = array( 'status', 'aside', 'link', 'quote' );
$bg = wolf_get_post_thumbnail_url( 'large' );
?>
<article <?php post_class( 'clearfix' ); ?>   id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-bg="<?php echo esc_url( $bg ); ?>">
	<?php if ( $format != 'aside' && $format != 'status' && $format != 'link' && $format != 'quote' && $media ) : ?>

	<div class="entry-media">
		<?php echo wolf_post_media(); ?>
	</div>
	<?php endif; ?>
	<?php if ( 'status' == $format ) : ?>
		<div class="entry-avatar text-center">
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
				<span class="author-name"><?php wolf_the_author(); ?></span>
			</a>
		</div><!-- .entry-avatar -->
	<?php endif; ?>
	<div class="entry-content">
		<div class="entry-container">
			<?php if ( $format != 'link' && $format != 'quote' ) : ?>
				<?php if ( $format != 'aside' && $format != 'status' && $format != 'link' && $format != 'quote' ) : ?>
					<h2 class="entry-title">
						<a class="entry-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				<?php endif; ?>
				<div class="entry-meta">
					<?php wolf_post_entry_meta(); ?>
					<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<?php if ( 'status' == $format || 'aside' == $format ) : ?>
					<?php the_content(); ?>
				<?php else : // normal formats ?>
					<?php wolf_excerpt_text(); ?>
				<?php endif; ?>

			<?php else : // normal formats ?>

				<?php echo wolf_post_media(); ?>

			<?php endif; ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wolf' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			<footer class="entry-meta icon-meta-container">
				<?php wolf_icon_meta(); ?>
			</footer>
		</div>
	</div>
</article>
<hr>
<?php
/**
 * This is the main post loop used for the masonry blog
 * We display each post differently depending on the post format
 */
$format = get_post_format() ? get_post_format() : 'standard';
$media = wolf_post_media();
$bg = wolf_get_post_thumbnail_url( 'large' );
?>
<article <?php post_class( 'clearfix post-item-container' ); ?>  id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-bg="<?php echo esc_url( $bg ); ?>">
	<div class="entry-frame entry-content">
		<div class="entry-container">
			<header class="entry-header">
				<?php if ( 'gallery' == $format && ! wolf_is_blog() ) : ?>
					<?php echo wolf_post_gallery_slider( 'classic-thumb' ); ?>
				<?php else : ?>
					<?php
					$media = wolf_post_media( true, 'masonry' );
					if ( $media && ! post_password_required() ) : ?>
						<div class="post-media-container" class="clearfix">
							<?php echo wolf_post_media( true, 'masonry' ); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</header><!-- header.entry-header -->

			<div class="entry-inner">

				<?php if ( $format != 'aside' && $format != 'status' && $format != 'link' && $format != 'quote' ) : ?>
					<h2 class="entry-title">
						<a class="entry-link" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				<?php endif; ?>

				<div class="entry-meta">
					<?php wolf_post_entry_meta(); ?>
					<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

				<div class="entry-content">
					<?php if ( $format != 'aside' && $format != 'status' && $format != 'link' && $format != 'quote' ) : ?>

						<?php wolf_excerpt(); ?>

					<?php elseif ( $format == 'aside' || $format == 'status' ) : ?>

						<?php the_content( wolf_more_text() ); ?>

					<?php endif; ?>
				</div><!-- .entry-content -->
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wolf' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

				<footer class="entry-meta icon-meta-container">
					<?php wolf_icon_meta(); ?>
				</footer>
			</div><!-- .entry-inner -->
		</div>
	</div><!-- .entry-frame -->
</article><!-- article -->
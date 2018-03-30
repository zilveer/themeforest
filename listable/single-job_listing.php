<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Listable
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/LocalBusiness">
			<?php

			if ( ! post_password_required() ) {
				$photos = listable_get_listing_gallery_ids();
				if ( ! empty( $photos ) ) : ?>

					<div class="entry-featured-carousel">
						<?php if ( count($photos) == 1 ):
							$myphoto = $photos[0];
							$image = wp_get_attachment_image_src($myphoto, 'listable-featured-image' );
							$src = $image[0];
						?>
							<div class="entry-cover-image" style="background-image: url(<?php echo listable_get_inline_background_image( $src ); ?>);"></div>
						<?php else: ?>
							<div class="entry-featured-gallery">
								<?php foreach ($photos as $key => $photo_id):
									$src = wp_get_attachment_image_src($photo_id, 'listable-carousel-image'); ?>
									<img class="entry-featured-image" src="<?php echo $src[0]; ?>" itemprop="image" />
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>

				<div>
					<?php
					$job_manager = $GLOBALS['job_manager'];

					remove_filter( 'the_content', array( $job_manager->post_types, 'job_content' ) );

					ob_start();

					do_action( 'job_content_start' );

					get_job_manager_template_part( 'content-single', 'job_listing' );

					do_action( 'job_content_end' );

					$content = ob_get_clean();

					add_filter( 'the_content', array( $job_manager->post_types, 'job_content' ) );

					echo apply_filters( 'job_manager_single_job_content', $content, $post );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'listable' ),
						'after'  => '</div>',
					) ); ?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php listable_entry_footer(); ?>
				</footer><!-- .entry-footer -->

			<?php
				listable_output_single_listing_icon();

			} else {
				echo '<div class="entry-content">';
				echo get_the_password_form();
				echo '</div>';
			} ?>
		</article><!-- #post-## -->

		<?php
		if ( ! post_password_required() ) the_post_navigation();
	endwhile; // End of the loop. ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
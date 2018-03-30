<?php
/**
 * The Template for displaying a single listing gallery.
 *
 * @package Listify
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<div id="primary" class="container">
		<div class="content-area">

			<main id="main" class="site-main" role="main">
				
				<?php if ( listify_has_integration( 'woocommerce' ) ) : ?>
					<?php wc_print_notices(); ?>
				<?php endif; ?>

				<p class="back-to-listing">
					<a href="<?php the_permalink(); ?>" class="ion-chevron-left"><?php printf( __( 'Back to %s', 'listify' ), get_the_title() ); ?></a>
				</p>

				<?php
					$gallery = Listify_WP_Job_Manager_Gallery::get( get_post()->ID, false );

					if ( empty( $gallery ) ) {
						$gallery = array(0);
					}

					$gallery = new WP_Query( array(
						'post__in' => $gallery,
						'post_type' => 'attachment',
						'post_status' => 'inherit',
						'nopaging' => true
					) );
				?>

				<?php if ( $gallery->have_posts() ) : ?>

				<div class="content-single-job_listing-gallery-wrapper row" data-columns>

					<?php while ( $gallery->have_posts() ) : $gallery->the_post(); ?>
						<?php get_template_part( 'content-job_listing', 'attachment' ); ?>
					<?php endwhile; ?>

				</div>

				<?php else : ?>

					<?php _e( 'No images found.', 'listify' ); ?>

				<?php endif; ?>

			</main>

		</div>
	</div>

	<?php endwhile; ?>

<?php get_footer(); ?>

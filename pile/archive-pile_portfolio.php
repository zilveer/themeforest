<?php
/**
 * The template for displaying Portfolio Category Archive pages.
 *
 * @package Pile
 * @since   Pile 1.0
 */

get_header(); ?>

<div id="djaxHero" <?php pile_hero_classes( 'djax-updatable  djax--hidden' ); ?>></div>

<?php do_action( 'pile_djax_container_start' ); ?>

	<div class="site-content  wrapper">
		<div class="content-width">

			<div class="page__header">
				<?php pile_the_archive_title(); ?>
			</div>

			<?php // The Loop
			if ( have_posts() ): ?>

			<div <?php pile_portfolio_classes( 'pile  pile--portfolio  pile--portfolio-archive  pile-aspect-ratio--' . pile_option( 'archive_thumbnails_aspect_ratio' ) ); ?>>

				<?php
				// initialize the item counter
				$pile_item_index = 0;

				while ( have_posts() ): the_post();
					//increase the counter beforehand since we start at 0
					$pile_item_index++;

					// wrap the project in a wrapper with the appropriate size and aspect ratio classes
					pile_wrap_content_portfolio_before( $pile_item_index );

					get_template_part( 'template-parts/content-portfolio' );

					// close the wrapper
					pile_wrap_content_portfolio_after( $pile_item_index ); ?>

				<?php endwhile; ?>

			</div><!-- .pile.pile-portfolio.pile-portfolio-archive -->

			<?php pile_the_next_prev_nav(); ?>

			<?php
			else:
				get_template_part( 'template-parts/content-none' );
			endif; ?>

		</div><!-- .content-width -->
	</div><!-- .site-content -->
<?php

do_action('pile_djax_container_end' );

get_footer();
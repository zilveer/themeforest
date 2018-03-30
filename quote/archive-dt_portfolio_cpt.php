<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package quote
 */

get_header(); ?>

	<section id="primary" class="container">
		<div class="gap"></div>

		<?php if ( have_posts() ) : ?>

			<div class="col-md-12 gap">

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'portfolio' );
					?>

				<?php endwhile; ?>

				<?php quote_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</div>

	</section><!-- #primary -->

<?php get_footer(); ?>

<?php
/**
 * The template for displaying search results pages.
 *
 * @package quote
 */

get_header(); ?>

	<div id="primary" class="container">
		<div class="gap"></div>

			<div class="col-md-9">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php quote_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			</div>

			<div class="col-md-3">
				<?php get_sidebar(); ?>
			</div>

	</div><!-- #primary -->

<?php get_footer(); ?>

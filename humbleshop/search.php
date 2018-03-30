<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package humbleshop
 */

get_header(); ?>

	<section id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">

			<div class="col-sm-8">
			<?php if ( have_posts() ) : ?>

				<!-- <header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'humbleshop' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header> -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php humbleshop_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>	
			</div>

			<?php get_sidebar(); ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
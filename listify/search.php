<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Listify
 */

// If searching for listings use the listings archive template
if ( isset( $_GET[ 'listings' ] ) ) {
	return locate_template( array( 'archive-job_listing.php' ), true );
}

get_header(); ?>

	<div <?php echo apply_filters( 'listify_cover', 'page-cover' ); ?>>
		<h1 class="page-title cover-wrapper"><?php printf( 'Search: %s', get_search_query() ); ?></h1>
	</div>

	<div id="primary" class="container">
		<div class="row content-area">

			<main id="main" class="site-main col-md-8 col-sm-7 col-xs-12" role="main">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content' ); ?>

					<?php endwhile; ?>

					<?php get_template_part( 'content', 'pagination' ); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</main>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>

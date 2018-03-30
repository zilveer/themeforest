<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<section id="primary">
			<div id="content" role="main">
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mega' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php if ( have_posts() ) : ?>
			
				<div id="hentry-wrapper">

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

					<?php endwhile; ?>
				
				</div><!-- #hentry-wrapper -->

				<?php
				/*
				 * Pagination.
				 */
				$blog_infinite_scroll = ot_get_option( 'blog_infinite_scroll' );
				?>
				<?php if ( $blog_infinite_scroll == 'load_more' ) : ?>
					<?php $total_posts = $wp_query->found_posts; ?>
					<?php mega_pagination_content_nav_load_more( 'nav-pagination-load-more' ); ?>
				<?php else : ?>
					<?php mega_content_nav( 'nav-below' ); ?>
				<?php endif; // End if ( $blog_infinite_scroll == 'Load more' ) ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">

					<div class="entry-content">
						<p><?php _e( 'Sorry, no posts matched your criteria. Please make sure all words are spelled correctly or try different keywords.', 'mega' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_footer(); ?>
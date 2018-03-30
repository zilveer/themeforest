<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Heat
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" role="main">
			<header class="entry-header">
				<h1 class="entry-title-lead"><?php echo the_title();?></h1>
			</header><!-- .entry-header -->
			
			<div id="hentry-wrapper">

				<?php if ( have_posts() ) : ?>

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
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mega' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive.', 'mega' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
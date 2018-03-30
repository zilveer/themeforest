<?php
/**
 * The template for displaying Search Results pages.
 */
	get_header();
?>

	<div class="page-width">
		<section id="primary" class="site-content">
			<div id="content" role="main">
			
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'liftoff' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php liftoff_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="content-list">
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div>
				<?php endwhile; ?>

				<?php liftoff_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'liftoff' ); ?></h1>
					</header>

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'liftoff' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>
	
<?php 	
	get_footer();
?>
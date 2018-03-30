<?php
/**
 * The Template for displaying an individual post.
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="row-fluid">

						<?php get_template_part( 'templates/post', get_post_format() ); ?>

					</div><!-- .row-fluid -->

					<?php 

					// Post Navigation (next/previous links)
					//................................................................
					$showPostNav = (get_options_data('blog-options', 'show-post-navigation')) ? true : false;
					
					if (isset($showPostNav) && $showPostNav == true) {
						// Show navigation
						next_and_previous_post_navigation();
					}
					
					// Show comments
					//................................................................
					comments_template( '', true ); ?>
				
				</article><!-- #post -->

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
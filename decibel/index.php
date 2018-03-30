<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();
wolf_page_before(); // before page hook ?>
	<div class="inner">
		<div id="primary" class="content-area">
			<main id="content" class="site-content clearfix" role="main">
			<?php if ( have_posts() ) : ?>

				<div id="posts-content" class="posts clearfix item-grid">
					<?php /* The loop */ ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<?php
							if ( ! is_search() ) {
								$blog_type =  wolf_get_blog_layout();
								/**
								 * The post content template
								 */
								get_template_part( 'partials/post/post', $blog_type . '-content' );

							} else {

								// standard search
								get_template_part( 'partials/post/post', 'search-content' );
							}
						?>
					<?php endwhile; ?>
				</div>
				<?php if (
					'masonry' == wolf_get_theme_option( 'blog_type' )
					&& wolf_get_theme_option( 'blog_infinite_scroll_trigger' )
					&& wolf_get_theme_option( 'blog_infinite_scroll' )
					&& ! is_search()
				) :
					global $wp_query;
					$max = $wp_query->max_num_pages;
						if ( 1 < $max ) : ?>
						<div class="trigger-container">
							<span id="post-trigger" class="trigger" data-max="<?php echo esc_attr( $max ); ?>">
								<?php next_posts_link( __( 'Load More', 'wolf' ), $max ); ?>
								<span class="trigger-spinner"></span>
							</span>
						</div>
						<?php endif; ?>
				<?php endif; ?>

			<?php else : ?>
				<?php get_template_part( 'partials/none', 'content' ); ?>
			<?php endif; ?>

			</main><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div>

<?php
wolf_page_after(); // after page hook
get_footer();
?>

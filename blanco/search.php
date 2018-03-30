<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header(); ?>
        <section id="main" class="columns2-left">
            <aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <div class="content">
<?php if ( have_posts() ) : ?>
				<p><?php printf( __( 'Search Results for: %s', ETHEME_DOMAIN ), '<em>' . get_search_query() . '</em>' ); ?></p>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', ETHEME_DOMAIN ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', ETHEME_DOMAIN ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->
            <div class="clear"></div>
		</section><!-- #container -->
<?php get_footer(); ?>

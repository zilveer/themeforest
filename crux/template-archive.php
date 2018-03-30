<?php
/**
 * Template Name: Archives
 */


get_header() ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main"<?php stag_markup_helper( array( 'context' => 'content' ) ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

			<div class="archive-lists">
				<?php the_widget( 'WP_Widget_Recent_Posts', array( 'title' =>  __( 'Last 10 Posts', 'stag' ) ) ); ?>

			    <?php the_widget( 'WP_Widget_Archives', array( 'title' =>  __( 'Archives by Month', 'stag' ), 'count' => 1 ) ); ?>

			    <?php the_widget( 'WP_Widget_Categories', array( 'title' =>  __( 'Archives by Subject', 'stag' ), 'count' => 1 ) ); ?>

			    <?php the_widget( 'WP_Widget_Search', array( 'title' => __( 'Search', 'stag' ) ) ); ?>
			</div><!-- .archive-lists -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

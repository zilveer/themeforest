<?php
/**
 * The template for displaying all single posts.
 *
 * @package WPCharming
 */

get_header(); ?>
	
	<?php wpcharming_breadcrumb(); ?>

	<div id="content-wrap" class="container <?php echo wpcharming_get_layout_class(); ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php echo wpcharming_get_sidebar(); ?>
	</div> <!-- /#content-wrap -->
<?php get_footer(); ?>

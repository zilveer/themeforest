<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header(); ?>

<div class="row content_row">

	<div class="large-9 columns">

		<div id="primary" class="content-area">
			
			<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

	</div><!-- .large-9 -->

	<?php get_sidebar(); ?>

</div> <!-- .row .content_row -->

<?php get_footer(); ?>
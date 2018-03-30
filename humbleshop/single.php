<?php
/**
 * The Template for displaying all single posts.
 *
 * @package humbleshop
 */

get_header(); ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">
		
		<?php if ( get_theme_mod('postlayout') == 'postright') : ?>
		<div class="col-sm-9">
		<?php elseif ( get_theme_mod('postlayout') == 'postleft') : ?>
		<?php get_sidebar(); ?>
		<div class="col-sm-9">
		<?php else : ?>
		<div class="col-xs-12">
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php humbleshop_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>	
		</div>

		<?php if ( get_theme_mod('postlayout') == 'postright') : ?>
		<?php get_sidebar(); ?>
		<?php endif; ?>

		</main><!-- #main -->
		
	</div><!-- #primary -->
<?php get_footer(); ?>
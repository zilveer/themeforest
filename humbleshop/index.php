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
 * @package humbleshop
 */

get_header(); ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">

			<?php if ( get_theme_mod('pagelayout') == 'pageright') : ?>
			<div class="col-sm-9">
			<?php elseif ( get_theme_mod('pagelayout') == 'pageleft') : ?>
			<?php get_sidebar(); ?>
			<div class="col-sm-9">
			<?php else : ?>
			<div class="col-xs-12">
			<?php endif; ?>

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php humbleshop_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>	
			</div>
			
			<?php if ( get_theme_mod('pagelayout') == 'pageright') : ?>
			<?php get_sidebar(); ?>
			<?php endif; ?>
				
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
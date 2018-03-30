<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package humbleshop
 */

get_header(); ?>

	<section id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">
			
			<?php if ( 'download' == get_post_type() ) : ?>
				<?php if ( get_theme_mod('shoplayout') == 'pageright') : ?>
				<div class="col-sm-9">
				<?php elseif ( get_theme_mod('shoplayout') == 'pageleft') : ?>
				<div class="col-sm-3"><?php dynamic_sidebar( 'shop' ); ?></div>
				<div class="col-sm-9">
				<?php else : ?>
				<div class="col-xs-12">
				<?php endif; ?>
				<!-- Archive -->
				<?php if ( 'download' == get_post_type() ) : echo '<div class="downloads row">'; endif; ?>
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
				<?php if ( 'download' == get_post_type() ) : echo '</div>'; endif; ?>
				<!-- Archive ends -->

				</div>
				
				<?php if ( get_theme_mod('shoplayout') == 'pageright') : ?>
				<div class="col-sm-3"><?php dynamic_sidebar( 'shop' ); ?></div>
				<?php endif; ?>
			<?php else : ?>
				<?php if ( get_theme_mod('pagelayout') == 'pageright') : ?>
				<div class="col-sm-9">
				<?php elseif ( get_theme_mod('pagelayout') == 'pageleft') : ?>
				<?php get_sidebar(); ?>
				<div class="col-sm-9">
				<?php else : ?>
				<div class="col-xs-12">
				<?php endif; ?>

				<!-- Archive -->
				<?php if ( 'download' == get_post_type() ) : echo '<div class="downloads row">'; endif; ?>
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
				<?php if ( 'download' == get_post_type() ) : echo '</div>'; endif; ?>
				<!-- Archive ends -->	
				</div>
				
				<?php if ( get_theme_mod('pagelayout') == 'pageright') : ?>
				<?php get_sidebar(); ?>
				<?php endif; ?>
			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>

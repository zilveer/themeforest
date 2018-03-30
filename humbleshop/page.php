<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package humbleshop
 */

get_header(); ?>

	<div id="primary" class="content-area container">
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

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>
					<?php echo do_shortcode('[downloads]'); ?>

				<?php endwhile; // end of the loop. ?>	
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

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>	
				</div>
				
				<?php if ( get_theme_mod('pagelayout') == 'pageright') : ?>
				<?php get_sidebar(); ?>
				<?php endif; ?>
			<?php endif; ?>
			

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_footer(); ?>
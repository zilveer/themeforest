<?php
/*
Template Name: Shop
*/
get_header(); ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">
			
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
				<?php //echo do_shortcode('[downloads]'); ?>

			<?php endwhile; // end of the loop. ?>	
			</div>
			
			<?php if ( get_theme_mod('shoplayout') == 'pageright') : ?>
			<div class="col-sm-3"><?php dynamic_sidebar( 'shop' ); ?></div>
			<?php endif; ?>
			
		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_footer(); ?>

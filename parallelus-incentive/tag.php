<?php
/**
 * The template for displaying Tag pages.
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
		<?php 

		if ( have_posts() ) : 
			get_template_part( 'templates/blog' );
		else : 
			get_template_part( 'content', 'none' ); 
		endif; 

		?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
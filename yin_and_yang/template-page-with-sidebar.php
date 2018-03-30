<?php
/*
Template Name: Page with Sidebar
*/
?>
<?php get_header(); ?>
	
	<?php if ( have_posts() ) : while ( have_posts()) : the_post(); ?>
			
		<div class="page-container group">	
			<section class="page-content the-content group">				
				<?php the_content(); ?>
			</section>
		
			<?php get_sidebar(); ?>
		</div><!-- /.page-container -->
		
	<?php endwhile; endif; ?>
	
<?php get_footer(); ?>
<?php
/**
 * Template Name: Page Full Width For Shortcode
 *
 * @package WordPress
 * @subpackage majesty
 * @since majesty 1.0
 */
 
get_header(); ?>

<?php get_template_part( 'page-templates/custom-header-bg'); ?>                      
	<div class="pad-top-bottom">
		<div class="blog-desc-single">
			<?php if ( have_posts() ) : ?>
								
				<?php while ( have_posts() ) : the_post(); ?>
								
					   <div class="blog-desc-single">
							
							<?php the_content(); ?>
					   </div>
						
				<?php endwhile; ?>
					
			<?php else : ?>
				
				<?php get_template_part( 'content', 'none' ); ?>
					
			<?php endif; ?>
		</div>
	</div>	
	<!-- # Content End #  -->
<?php get_footer(); ?>
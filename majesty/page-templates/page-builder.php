<?php
/**
 * Template Name: Page Builder With Slider 
 *
 * @package WordPress
 * @subpackage Majesty
 * @since Majesty 1.0
 */
 
get_header(); ?>
			
		<?php 
			if ( have_posts() ) :
							
				while ( have_posts() ) : the_post();
				
					the_content();
				
				endwhile;
				
			else :
				get_template_part( 'content', 'none' );
			endif;
		?>
		
<?php get_footer(); ?>
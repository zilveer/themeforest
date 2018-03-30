<?php
/**
 * Template Name: Fullwidth Dark
 *
 * The template to display Dark page template.
 * 
 * @package Toranj
 * @author owwwlab (Alireza Jahandideh & Ehsan Dalvand @owwwlab)
 */

?>

<?php get_header(); ?>

<!--Page main wrapper-->
<div id="main-content" class="dark-template remove-vc-spacing"> 
	<div class="page-wrapper">
		

		
			
			<?php while( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
			
		


	</div>
</div>
<!--/Page main wrapper-->

<?php get_footer(); ?>
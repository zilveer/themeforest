<?php 
/**
 * Template Name: Dark Absolute Page
 *
 * The template to display those layouts which need absolute positioning.
 *
 * @author owwwlab
 */
?>

<?php get_header(); ?>

<!--Page main wrapper-->
<div id="main-content" class="abs dark-template remove-vc-spacing"> 
	<!-- <div class="page-wrapper"> -->
		

		
			
			<?php while( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>

		


	<!-- </div> -->
</div>
<!--/Page main wrapper-->

<?php get_footer(); ?>
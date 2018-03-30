<?php 
/**
 * Template Name: Fullwidth Light
 *
 * The template to display those layouts which need absolute positioning.
 *
 * @author owwwlab
 */
?>

<?php get_header(); ?>

<!--Page main wrapper-->
<div id="main-content"> 
	<div class="page-wrapper regular-page full-width">
		

		
			
			<?php while( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>

		


	</div>
</div>
<!--/Page main wrapper-->

<?php get_footer(); ?>
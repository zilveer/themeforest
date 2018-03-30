<?php
// Template Name: Page Home
 ?>

<?php
get_header(); 
 
?>
 
<section id="content">	
		<div class="row home_content">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>	
		</div>		
</section>

<?php get_footer(); ?> 
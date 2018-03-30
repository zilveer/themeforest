<?php
/*
 * Template Name: Traditional Blog
*/

get_header(); 
?>


<!-- ============================================== -->


<!-- Super Container -->
<div class="super-container full-width main-content-area" id="section-content">


	<!-- 960 Container -->
	<div class="container">		
		
		
		<!-- CONTENT -->
		<div class="eleven columns content">
		
			
			<h1 class="title"><span><?php the_title(); ?></span></h1>
			
			<!-- Page Content (if it exists) -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
			<div class="eleven columns content alpha">
				<?php the_content(); ?>			
			</div>	
			<?php endwhile; ?>	
			
			<!-- ============================================== -->			
			
			
			<!-- CATEGORY QUERY + START OF THE LOOP -->
			<?php get_template_part( 'element', 'categoryfilterquery' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>							
			
				<?php get_template_part( 'element', 'excerpt' ); ?>					
							
			<?php endwhile; endif; ?>
			<!-- /STOP LOOP -->
			
			
			<!-- ============================================== -->		
			
		
			<?php get_template_part( 'element', 'pagination' ); ?>
			
		
		</div>	
		<!-- /CONTENT -->
		
		
		<!-- ============================================== -->
		
		
		<!-- SIDEBAR --> 
		<div class="five columns sidebar">
			
			<?php dynamic_sidebar( 'default-widget-area' ); ?>	
				
		</div>
		<!-- /SIDEBAR -->		
				

	</div>
	<!-- /End 960 Container -->
	
</div>
<!-- /End Super Container -->


<!-- ============================================== -->


<?php get_footer(); ?>
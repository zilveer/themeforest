<?php
/*
 * Template Name: Full Width (Dev Sandbox)
*/

get_header();
?>


<!-- ============================================== -->


<!-- Super Container -->
<div class="super-container full-width main-content-area" id="section-content">

	<!-- 960 Container -->
	<div class="container">
		
		<?php get_template_part( 'element', 'pagecaption' ); ?>
		
		<!-- CONTENT -->
		<div class="sixteen columns content">
			
			<!-- THE POST LOOP -->
			<?php while ( have_posts() ) : the_post(); ?>	
				
				<?php if(get_custom_field('hide_title') == 'on') : else : ?>
				<h1 class="title"><span><?php the_title(); ?></span></h1>
				<?php endif; ?>
		
		</div>
		<div class="content">
				<?php the_content(); ?>
				
			<?php endwhile; ?>	
			
		</div>	
		<!-- /CONTENT -->
		

	</div>
	<!-- /End 960 Container -->
	
</div>
<!-- /End Super Container -->


<!-- ============================================== -->


<?php get_footer(); ?>
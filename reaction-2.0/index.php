<?php get_header(); ?>


<!-- Super Container -->
<div class="super-container full-width main-content-area" id="section-content">


	<!-- 960 Container -->
	<div class="container">		
		
		
		<!-- CONTENT -->
		<div class="eleven columns content">
		
			
			
								
			<!-- TAG CONDITIONAL TITLE -->
			<?php if ( is_tag() ) :	?>			
				<h1 class="title"><span><?php single_tag_title(); ?></span></h1>
			<?php elseif ( is_category() ) :	?>			
				<h1 class="title"><span><?php single_cat_title(); ?></span></h1>
			<?php elseif ( is_archive() ) : ?>			
				<h1 class="title"><span><?php single_month_title(); ?></span></h1>
			<?php elseif ( is_author() ) : ?>			
				<h1 class="title"><span><?php the_author(); ?></span></h1>
			<?php endif; ?>	
			
			
			
			<!-- ============================================== -->
			
			
			<!-- QUERY + START OF THE LOOP -->
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<?php get_template_part( 'element', 'excerpt' ); ?>	
							
			<?php endwhile; ?>
			<?php endif; ?>
			<!-- /POST LOOP -->
			
			
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
<?php get_header(); ?>


<!-- Super Container -->
<div class="super-container full-width main-content-area" id="section-content">


	<!-- 960 Container -->
	<div class="container">		
		
		
		<!-- CONTENT -->
		<div class="eleven columns content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			
			<h2 class="title"><span>
				<!-- Search CONDITIONAL TITLE -->
				<?php if ( is_search() ) :	?>		
				<?php _e('Search Results for', 'skeleton') ?> "<?php the_search_query() ?>"
				<?php endif; ?>
				
				<!-- TAG CONDITIONAL TITLE -->
				<?php if ( is_tag() ) :	?>			
					<?php single_tag_title(); ?>
				<?php endif; ?>
							
				<!-- CATEGORY CONDITIONAL TITLE -->
				<?php if ( is_category() ) :	?>			
					<?php single_cat_title(); ?>
				<?php endif; ?>	
			</span></h2>
			
			
			<!-- ============================================== -->
			
			
			<!-- QUERY + START OF THE LOOP -->
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>				
					
				<?php get_template_part( 'element', 'excerpt' ); ?>		
							
			<?php endwhile; ?>
			<?php endif; ?>	
			<!-- /STOP LOOP -->
			
			
			<!-- ============================================== -->
			
			
		<!-- Previous / More Entries -->
		<div class="article_nav">
		<hr />
			<div class="p button"><?php next_posts_link(__('Previous Posts', 'skeleton')); ?></div>
			<div class="m button"><?php previous_posts_link(__('Next Posts', 'skeleton')); ?></div>
		</div>
		<!-- </Previous / More Entries -->
		
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
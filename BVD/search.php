<?php get_header(); ?>

<div id="main_content">
	<div class="center1 padding" id="top_light4">
	
   		<div class="center_box">
   		
		<?php get_sidebar(); ?>
   			
   			<div class="center_right">
				
				<?php if (have_posts()) : ?>
				
				<h2>Search Results</h2>
				
				<?php while (have_posts()) : the_post(); ?>
				
				<div id="post-<?php the_ID(); ?>">
				
	   				<h3 class="blog"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	   				
	   				<div class="publish">published on <?php the_time('d.m.Y'); ?> in <?php the_category(', '); ?></div>
	   				
	   				<div class="blog_p">
	   					<?php the_excerpt(); ?>
	   				</div>
   				
   				</div>   
   								
   				<div class="blog_line"></div>
   				
   				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
 				   				
   			</div><!-- end center_right-->
   			
   		</div><!-- end center_box-->
   		
    </div><!--end center 1 -->
</div><!-- end main content-->


<?php get_footer(); ?>
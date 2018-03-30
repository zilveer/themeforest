<?php /*
Template Name: Home Widget Template
*/ ?>
<?php get_header(); ?>

<div class="maincontainer">
	   		
			<div class="slider">
				
					<?php echo do_shortcode('[nivoslider slug="homepage-slider"]'); ?>
				
			<div class="sliderbottom"></div><!--Moon shape Slider shader-->
			</div>
				<div class="contentwrapper">
					 <div class="contentfull">
					   <?php if (have_posts()) : while (have_posts()) : the_post(); 
						the_content();
						?>
						<?php endwhile; ?>
						<?php else : ?>
							<p><?php _e('Sorry, no posts matched your criteria.', 'bw_themes'); ?></p>
						<?php endif; ?>
					</div><!-- contentfull -->
					
						
				</div><!-- contentwrapper -->
			<div class="footerwrapper">
				<?php get_footer(); ?>

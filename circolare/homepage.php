<?php
/*
Template Name: Home_Page
*/
?>
<?php get_header(); ?>

		<!-- Slider Begin -->
		<?php 
		if(of_get_option('slider_source') == "revolution") 
			putRevSlider("homepage");
		else 
			get_template_part( 'flexslider' ); ?>
			
		<div class="clear"></div>
		
		<div class="content-wrapper home-content-wrapper">
			<article>
			<?php if(of_get_option('homepage_layout', "wide") == "wide") { ?>
			<!-- Home Wide Sidebar -->
			<div class="home-wide">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_wide') ) : ?><?php endif; ?>
			</div>
			
			<div class="clear"></div><?php } ?>
			
			<!-- Narrow Sidebar 1 -->
			<div class="one-half float-left">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Narrow 1') ) : ?><?php endif; ?>
			</div>
			
			<!-- Narrow Sidebar 2 -->
			<div class="one-half last float-left">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Narrow 2') ) : ?><?php endif; ?>
			</div>
			
			<div class="clear"></div>
			
			<?php if(of_get_option('homepage_layout', "wide") != "wide") { ?>
			<!-- Home Wide Sidebar -->
			<div class="home-wide">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_wide') ) : ?><?php endif; ?>
			</div>
			
			<div class="clear"></div><?php } ?>
			
			<!-- Home Content -->
			<div id="home_special">
				<?php if ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php the_content(); ?>
				<div class="clear"></div>
				<?php endif; ?>
			</div>
			</article>
		</div>
	</div>
	
	<!-- Footer -->
	<?php get_footer(); ?>
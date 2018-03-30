<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

	<!-- Start Featured Under -->
  	<div id="featured_under">
	
	<div id="featured_under_h">
	<h1><?php echo get_option('cs_portfolio_header'); ?></h1>
	</div>
	
	</div>
	<!-- End Featured -->
	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
	<div id="content">
	
	<!-- Start Portfolio Wrapper -->
	<div id="content_portfolio_wrapper" class="content">
	
			<?php 
				$category = get_catid(get_option('cs_portfolio'));
				$posts = get_option('cs_portfolio_count');
			?>
		<?php $the_query = new WP_Query('showposts='.$posts.'&cat='.$category); while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<?php $thumb = get_post_meta($post->ID, 'thumb-large', true); ?>
		<!-- Start Content Left -->
	  <div class="content_portfolio_l">
		<h4><strong><?php the_title(); ?></strong></h4>
		<?php the_content(); ?>
	  </div>
		<!-- End Content Left -->
		
		<!-- Start Content Right -->
	   <div class="content_portfolio_r">
	     <p><a href="<?php echo $thumb; ?>" title="<?php the_title_attribute(); ?>" rel="lightbox"><img src="<?php echo $thumb; ?>" alt="" width="500" height="193" /></a></p>
	  </div>
		<!-- End Content Right -->
		
		<br style="clear:both" /> <!-- DO NOT REMOVE THIS LINE!!! -->	
		
		<div class="content_portfolio_sep"><img src="<?php bloginfo('template_url'); ?>/graphic/sep.gif" alt=""/></div>
		
		<?php endwhile; ?>
			
	</div>
	<!-- End Portfolio Wrapper -->	
			
	</div>
	<!-- End Content -->
	
	<!-- Start Content Rounded Corners Bottom -->
	<div id="content_rb"></div>
	<!-- End Content Rounded Corners Bottom -->

<?php get_footer(); ?>

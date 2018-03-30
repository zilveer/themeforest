<?php get_header(); ?>

	<!-- Start Featured Under -->
  	<div id="featured_under">
	
	<div id="featured_under_h">
	<h1><?php if (function_exists('the_subheading')) { the_subheading(); } else {  the_title(); } ?> </h1>
	</div>
	
	</div>
	<!-- End Featured -->
	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
	<div id="content">
	
		<!-- Start Content Left -->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	  <div id="content_left" class="content">
	  	<div class="content_left_h"><h3><?php the_title(); ?></h3></div>
		<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
		<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	 </div>
	 <?php endwhile; endif; ?>
		<!-- End Content Left -->
		
		<!-- Start Content Right -->
	 	<? if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Page Widget') ) : ?>
		
		<? endif; ?>
		<!-- End Content Right -->
		
		<br style="clear:both" /> <!-- DO NOT REMOVE THIS LINE!!! -->		
	</div>
	<!-- End Content -->
	
	<!-- Start Content Rounded Corners Bottom -->
	<div id="content_rb"></div>
	<!-- End Content Rounded Corners Bottom -->

	<?php get_footer(); ?>

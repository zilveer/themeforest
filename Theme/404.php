<?php get_header(); ?>

	<!-- Start Featured Under -->
  	<div id="featured_under">
	
	<div id="featured_under_h">
	<h1>Error</h1>
	</div>
	
	</div>
	<!-- End Featured -->
	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
	<div id="content">
	
		<!-- Start Content Left -->
	  <div id="content_left" class="content">
		<? if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Error Page Widget') ) : ?>
		
		<? endif; ?>
	 </div>
		<!-- End Content Left -->
		
		<!-- Start Content Right -->
	 	<? if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Error Page Side Widget') ) : ?>
		
		<? endif; ?>
		<!-- End Content Right -->
		
		<br style="clear:both" /> <!-- DO NOT REMOVE THIS LINE!!! -->		
	</div>
	<!-- End Content -->
	
	<!-- Start Content Rounded Corners Bottom -->
	<div id="content_rb"></div>
	<!-- End Content Rounded Corners Bottom -->

<?php get_footer(); ?>
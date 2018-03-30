<?php get_header(); ?>
	
	<!-- Start Featured Under -->
  	<div id="featured_under">
	
	<div id="featured_under_h">
	<h1>Search</h1>
	</div>
	
	</div>
	<!-- End Featured -->
	
	<?php if (have_posts()) : ?>
	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
	<div id="content">
	
	<?php while (have_posts()) : the_post(); ?>
	
	<!-- Start Portfolio Wrapper -->
	<div id="content_blog_wrapper" class="content">
		
		<!-- Start Content -->
	  <div class="content_blog">
		<h4><strong><?php the_title(); ?></strong></h4>
		<p><em><?php the_time('F jS, Y') ?></em></p>
		<?php the_excerpt(''); ?>
		<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Read more</a></p>
	  </div>
		<!-- End Content -->
		
				<br style="clear:both" /> <!-- DO NOT REMOVE THIS LINE!!! -->
				<div class="content_blog_sep"><img src="<?php bloginfo('template_url'); ?>/graphic/sep.gif" alt=""/></div>
	</div>
	<?php endwhile; ?>
	
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>  
	
	</div>
	<!-- End Portfolio Wrapper -->	
			
	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
	
	<!-- End Content -->
	
	<?php endif; ?>
	
	<!-- Start Content Rounded Corners Bottom -->
	<div id="content_rb"></div>
	<!-- End Content Rounded Corners Bottom -->

<?php get_footer(); ?>

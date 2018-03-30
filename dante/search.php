<?php get_header(); ?>

<?php 

	$options = get_option('sf_dante_options');
	$sidebar_config = $options['archive_sidebar_config'];
	$left_sidebar = strtolower($options['archive_sidebar_left']);
	$right_sidebar = strtolower($options['archive_sidebar_right']);
	$blog_type = $options['archive_display_type'];
	
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
	
	sf_set_sidebar_global($sidebar_config);

?>

<div class="container">

	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
	
		<!-- OPEN page -->
		<?php if ($sidebar_config == "left-sidebar" || $sidebar_config == "right-sidebar") { ?>
		<div class="archive-page col-sm-8 clearfix">
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
		<div class="archive-page col-sm-9 clearfix">
		<?php } else { ?>
		<div class="archive-page clearfix">
		<?php } ?>
		
			<?php if ($sidebar_config == "both-sidebars") { ?>
			<div class="row">
				<div class="page-content col-sm-8 clearfix">
				
					<?php if(have_posts()) : ?>
						
						<div class="blog-wrap">
						
							<!-- OPEN .blog-items -->
							<ul class="blog-items row search-items clearfix">
					
							<?php while (have_posts()) : the_post(); ?>
							
								<li <?php post_class('blog-item col-sm-12'); ?>>
									<?php echo sf_get_search_item($post->ID); ?>
								</li>
					
							<?php endwhile; ?>
									
							<!-- CLOSE .blog-items -->
							</ul>
						
						</div>
						
					<?php else: ?>
					
					<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
					
					<div class="no-results-text">
						<p><?php _e("Please use the form below to search again.", "swiftframework"); ?></p>
						<form method="get" class="search-form" action="<?php echo home_url(); ?>/">
							<input type="text" placeholder="<?php _e("Search", "swiftframework"); ?>" name="s" />
						</form>
						<p><?php _e("Alternatively, you can browse the sitemap below.", "swiftframework"); ?></p>
						<?php echo do_shortcode('[sf_sitemap]'); ?>
					</div>
						
					<?php endif; ?>
					
					<div class="pagination-wrap">
						<?php echo pagenavi($wp_query); ?>									
					</div>
					
				</div>
					
				<aside class="sidebar left-sidebar col-sm-4">
					<?php dynamic_sidebar($left_sidebar); ?>
				</aside>
			</div>
			<?php } else { ?>
			
			<div class="page-content clearfix">
	
				<?php if(have_posts()) : ?>
					
					<div class="blog-wrap">
					
						<!-- OPEN .blog-items -->
						<ul class="blog-items row search-items clearfix">
				
						<?php while (have_posts()) : the_post(); ?>
						
							<li <?php post_class('blog-item col-sm-12'); ?>>
								<?php echo sf_get_search_item($post->ID); ?>
							</li>
				
						<?php endwhile; ?>
								
						<!-- CLOSE .blog-items -->
						</ul>
						
					</div>
				
				<?php else: ?>
				
				<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
				
				<div class="no-results-text">
					<p><?php _e("Please use the form below to search again.", "swiftframework"); ?></p>
					<form method="get" class="search-form" action="<?php echo home_url(); ?>/">
						<input type="text" placeholder="<?php _e("Search", "swiftframework"); ?>" name="s" />
					</form>
					<p><?php _e("Alternatively, you can browse the sitemap below.", "swiftframework"); ?></p>
					<?php echo do_shortcode('[sf_sitemap]'); ?>
				</div>
				
				<?php endif; ?>
				
				<div class="pagination-wrap">
					<?php echo pagenavi($wp_query); ?>									
				</div>
				
			</div>
			
			<?php } ?>	
		
		<!-- CLOSE page -->
		</div>
		
		<?php if ($sidebar_config == "left-sidebar") { ?>
			
			<aside class="sidebar left-sidebar col-sm-4">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
	
		<?php } else if ($sidebar_config == "right-sidebar") { ?>
			
			<aside class="sidebar right-sidebar col-sm-4">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
	
			
			<aside class="sidebar right-sidebar col-sm-3">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
		
		<?php } ?>
			
	</div>

</div>

<!--// WordPress Hook //-->
<?php get_footer(); ?>
<?php get_header(); ?>
	
<?php 

	$options = get_option('sf_dante_options');
	$page_layout = $options['page_layout'];
	$sidebar_config = $options['archive_sidebar_config'];
	$left_sidebar = strtolower($options['archive_sidebar_left']);
	$right_sidebar = strtolower($options['archive_sidebar_right']);
	$blog_type = $options['archive_display_type'];
	$sidebar_width = $options['sidebar_width'];
	
	$page_wrap_class = $post_class_extra = $sidebar_class = '';
	if ($sidebar_config == "left-sidebar") {
		$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
		if ($sidebar_width == "reduced") {
			$post_class_extra = 'push-right col-sm-9';
			$sidebar_class = 'col-sm-3';
		} else {
			$post_class_extra = 'push-right col-sm-8';
			$sidebar_class = 'col-sm-4';
		}
	} else if ($sidebar_config == "right-sidebar") {
		$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
		if ($sidebar_width == "reduced") {
			$post_class_extra = 'col-sm-9';
			$sidebar_class = 'col-sm-3';
		} else {
			$post_class_extra = 'col-sm-8';
			$sidebar_class = 'col-sm-4';
		}
	} else if ($sidebar_config == "both-sidebars") {
		$page_wrap_class = 'has-both-sidebars row';
		$post_class_extra = 'col-sm-9';
		$sidebar_class = 'col-sm-3';
	} else {
		$page_wrap_class = 'has-no-sidebar';
	}
	
	$list_class = $item_class = $wrap_class = '';
	
	if ($blog_type == "mini") {
		$item_class = "col-sm-12";
	} else if ($blog_type == "masonry") {
		if ($sidebar_config == "both-sidebars") {
		$item_class = "col-sm-12";
		} else {
		$item_class = "col-sm-4";
		}
	} else if ($blog_type == "masonry-fw") { 
		$item_class = "col-sm-3";
	} else {
		$item_class = "col-sm-12";
	}
	
	if ($blog_type == "masonry") {
	$list_class .= 'masonry-items first-load grid effect-1';
	} else if ($blog_type == "masonry-fw") {
	$wrap_class .= "masonry-fw ";
	$list_class .= 'masonry-items first-load grid effect-1';
	} else if ($blog_type == "mini") {
	$list_class .= 'mini-items';
	} else {
	$list_class .= 'standard-items';
	}
	
	if ($blog_type == "masonry" || $blog_type == "masonry-fw") {
	global $sf_include_imagesLoaded;
	$sf_include_imagesLoaded = true;
	}
	
	global $sf_has_blog;
	$sf_has_blog = true;
	
	sf_set_sidebar_global($sidebar_config);

?>

<?php if ($blog_type != "masonry-fw" || $page_layout == "boxed") { ?>
<div class="container">
<?php } ?>

	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> blog-type-<?php echo $blog_type; ?> clearfix">
			
		<!-- OPEN page -->
		<?php if ($sidebar_config == "left-sidebar" || $sidebar_config == "right-sidebar") { ?>
		<div class="archive-page <?php echo $post_class_extra; ?>" clearfix">
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
		<div class="archive-page <?php echo $post_class_extra; ?>" clearfix">
		<?php } else { ?>
		<div class="archive-page clearfix">
		<?php } ?>
		
			<?php if ($sidebar_config == "both-sidebars") { ?>
				<div class="row">
				<div class="page-content col-sm-8 clearfix">
				
					<?php if(have_posts()) : ?>
						
						<div class="blog-wrap blog-items-wrap blog-<?php echo $blog_type; ?> <?php echo $wrap_class; ?>">
						
							<?php if ($blog_type == "standard") { ?>
								<div class="timeline"></div>
							<?php } ?>
						
							<!-- OPEN .blog-items -->
							<ul class="blog-items row <?php echo $list_class; ?> clearfix" id="blogGrid">
					
							<?php while (have_posts()) : the_post(); ?>
							
								<li <?php post_class('blog-item '.$item_class); ?>>
									<?php echo sf_get_post_item($post->ID, $blog_type); ?>
								</li>
					
							<?php endwhile; ?>
									
							<!-- CLOSE .blog-items -->
							</ul>
						
						</div>
						
					<?php else: ?>
						
					<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
				
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
					
					<div class="blog-wrap blog-items-wrap blog-<?php echo $blog_type; ?> <?php echo $wrap_class; ?>">
					
						<?php if ($blog_type == "standard") { ?>
							<div class="timeline"></div>
						<?php } ?>
					
						<!-- OPEN .blog-items -->
						<ul class="blog-items row <?php echo $list_class; ?> clearfix" id="blogGrid">
				
						<?php while (have_posts()) : the_post(); ?>
						
							<li <?php post_class('blog-item '.$item_class); ?>>
								<?php echo sf_get_post_item($post->ID, $blog_type); ?>
							</li>
				
						<?php endwhile; ?>
								
						<!-- CLOSE .blog-items -->
						</ul>
						
					</div>
			
				<?php else: ?>
					
				<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
			
				<?php endif; ?>
			
				<div class="pagination-wrap">
					<?php echo pagenavi($wp_query); ?>									
				</div>
				
			</div>
			
			<?php } ?>	
		
		<!-- CLOSE page -->
		</div>
		
		<?php if ($sidebar_config == "left-sidebar") { ?>
			
			<aside class="sidebar left-sidebar <?php echo $sidebar_class; ?>">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
	
		<?php } else if ($sidebar_config == "right-sidebar") { ?>
			
			<aside class="sidebar right-sidebar <?php echo $sidebar_class; ?>">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
	
			
			<aside class="sidebar right-sidebar col-sm-3">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
		
		<?php } ?>
	
	</div>

<?php if ($blog_type != "masonry-fw" || $page_layout == "boxed") { ?>
</div>
<?php } ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>
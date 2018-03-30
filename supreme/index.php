<?php get_header(); ?>

<?php 

	$options = get_option('sf_supreme_options');
	$sidebar_config = $options['archive_sidebar_config'];
	$left_sidebar = strtolower($options['archive_sidebar_left']);
	$right_sidebar = strtolower($options['archive_sidebar_right']);
	$blog_type = $options['archive_display_type'];
	
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar';
	} elseif ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar';
	} elseif ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
	
	$list_class = '';
	
	if ($blog_type == "masonry") {
	$list_class .= 'masonry-items';
	} else if ($blog_type == "mini") {
	$list_class .= 'mini-items';
	} else {
	$list_class .= 'standard-items';
	}
	
	if ($blog_type == "masonry") {
	global $include_isotope;
	$include_isotope = true;
	}
	
	global $has_blog;
	$has_blog = true;

?>

<?php if ( is_front_page() || is_home() ) : ?>

	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
	
		<!-- OPEN page -->
		<?php if ($sidebar_config == "left-sidebar") { ?>
		<div class="archive-page two-thirds column omega clearfix">
		<?php } elseif ($sidebar_config == "right-sidebar") { ?>
		<div class="archive-page two-thirds column alpha clearfix">
		<?php } else { ?>
		<div class="archive-page clearfix">
		<?php } ?>
		
			<?php if ($sidebar_config == "both-sidebars") { ?>
				
				<section class="page-content eight columns omega clearfix">
				
					<?php if(have_posts()) : ?>
						
						<div class="blog-wrap">
						
							<!-- OPEN .blog-items -->
							<ul class="blog-items <?php echo $list_class; ?> clearfix">
					
							<?php while (have_posts()) : the_post(); ?>
					
								<li class="blog-item">
								<?php // The following determines what the post format is and shows the correct file accordingly
									$format = get_post_format();
									if($format == 'quote') {
									get_template_part( 'includes/post-formats/quote' );
									} else {
									get_template_part( 'includes/post-formats/standard' );
									}
								?>
								</li>
					
							<?php endwhile; ?>
									
							<!-- CLOSE .blog-items -->
							</ul>
						
						</div>
						
					<?php else: ?>
					
					<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
						
					<?php endif; ?>
					
					<?php if ( has_previous_posts() || has_next_posts() ) { ?>
				
						<!-- OPEN .pagination-wrap .blog-pagination .clearfix -->
						<div class="pagination-wrap blog-pagination clearfix">
						
							<div class="nav-previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">Older Entries</span>', "swiftframework")); ?></div>
							<?php wp_link_pages(); ?>
							<div class="nav-next"><?php previous_posts_link(__('<span class="nav-text">Newer Entries</span><i class="icon-chevron-right"></i>', "swiftframework")); ?></div>		
							
						<!-- CLOSE .pagination-wrap .blog-pagination .clearfix -->
						</div>
				
					<?php } ?>
					
				</section>
					
				<aside class="sidebar left-sidebar four columns alpha">
					<?php dynamic_sidebar($left_sidebar); ?>
				</aside>
			
			<?php } else { ?>
			
			<div class="page-content clearfix">
	
				<?php if(have_posts()) : ?>
					
					<div class="blog-wrap">
					
						<!-- OPEN .blog-items -->
						<ul class="blog-items <?php echo $list_class; ?> clearfix">
				
						<?php while (have_posts()) : the_post(); ?>
				
							<li class="blog-item">
							<?php // The following determines what the post format is and shows the correct file accordingly
								$format = get_post_format();
								if($format == 'quote') {
								get_template_part( 'includes/post-formats/quote' );
								} else {
								get_template_part( 'includes/post-formats/standard' );
								}
							?>
							</li>
				
						<?php endwhile; ?>
								
						<!-- CLOSE .blog-items -->
						</ul>
						
					</div>
				
				<?php else: ?>
				
				<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
			
				<?php endif; ?>
				
				<?php if ( has_previous_posts() || has_next_posts() ) { ?>
			
					<!-- OPEN .pagination-wrap .blog-pagination .clearfix -->
					<div class="pagination-wrap blog-pagination clearfix">
					
						<div class="nav-previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">Older Entries</span>', "swiftframework")); ?></div>
						<?php wp_link_pages(); ?>
						<div class="nav-next"><?php previous_posts_link(__('<span class="nav-text">Newer Entries</span><i class="icon-chevron-right"></i>', "swiftframework")); ?></div>		
						
					<!-- CLOSE .pagination-wrap .blog-pagination .clearfix -->
					</div>
			
				<?php } ?>
				
			</div>
			
			<?php } ?>	
		
		<!-- CLOSE page -->
		</div>
		
		<?php if ($sidebar_config == "left-sidebar") { ?>
			
			<aside class="sidebar left-sidebar one-third column alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
	
		<?php } else if ($sidebar_config == "right-sidebar") { ?>
			
			<aside class="sidebar right-sidebar one-third column omega">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
	
			
			<aside class="sidebar right-sidebar four columns omega">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
		
		<?php } ?>
			
	</div>

<?php elseif (is_search()) : ?>
	
	<div class="page-heading clearfix">
	
		<?php $allsearch = new WP_Query("s=$s&showposts=-1"); $key = esc_html($s, 1); $count = $allsearch->post_count; _e('', "swiftframework"); wp_reset_query(); ?>
		<?php if ($count == 1) : ?>
			<?php printf(__('<h1>%1$s result for <span>%2$s</span></h1>', 'swiftframework'), $count, $key ); ?>
		<?php else : ?>
			<?php printf(__('<h1>%1$s results for <span>%2$s</span></h1>', 'swiftframework'), $count, $key ); ?>	
		<?php endif; ?>
		
		<?php if(function_exists('bcn_display')) { ?>	
		<div class="breadcrumbs-wrap">
			<div id="breadcrumbs">
				<?php bcn_display(); ?>
			</div>
		</div>
		<?php } ?>
		
		<div class="heading-divider"></div>
		
	</div>
	
	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix" id="search-results">
	
		<?php if ($count > 0) { ?>

		<!-- OPEN page -->
		<?php if ($sidebar_config == "left-sidebar") { ?>
		<div class="archive-page two-thirds column omega clearfix">
		<?php } elseif ($sidebar_config == "right-sidebar") { ?>
		<div class="archive-page two-thirds column alpha clearfix">
		<?php } else { ?>
		<div class="archive-page clearfix">
		<?php } ?>
		
			<?php if ($sidebar_config == "both-sidebars") { ?>
				
				<section class="page-content eight columns omega clearfix">
				
					<?php if(have_posts()) : ?>
						
						<div class="blog-wrap">
						
							<!-- OPEN .blog-items -->
							<ul class="blog-items <?php echo $list_class; ?> clearfix">
					
							<?php while (have_posts()) : the_post(); ?>
					
								<li class="blog-item">
								<?php // The following determines what the post format is and shows the correct file accordingly
									$format = get_post_format();
									if($format == 'quote') {
									get_template_part( 'includes/post-formats/quote' );
									} else {
									get_template_part( 'includes/post-formats/standard' );
									}
								?>
								</li>
					
							<?php endwhile; ?>
									
							<!-- CLOSE .blog-items -->
							</ul>
						
						</div>
						
					<?php else: ?>
					
					<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
						
					<?php endif; ?>
					
					<?php if ( has_previous_posts() || has_next_posts() ) { ?>
				
						<!-- OPEN .pagination-wrap .blog-pagination .clearfix -->
						<div class="pagination-wrap blog-pagination clearfix">
						
							<div class="nav-previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">Older Entries</span>', "swiftframework")); ?></div>
							<?php wp_link_pages(); ?>
							<div class="nav-next"><?php previous_posts_link(__('<span class="nav-text">Newer Entries</span><i class="icon-chevron-right"></i>', "swiftframework")); ?></div>		
							
						<!-- CLOSE .pagination-wrap .blog-pagination .clearfix -->
						</div>
				
					<?php } ?>
					
				</section>
					
				<aside class="sidebar left-sidebar four columns alpha">
					<?php dynamic_sidebar($left_sidebar); ?>
				</aside>
			
			<?php } else { ?>
			
			<section class="page-content clearfix">
	
				<?php if(have_posts()) : ?>
					
					<div class="blog-wrap">
					
						<!-- OPEN .blog-items -->
						<ul class="blog-items <?php echo $list_class; ?> clearfix">
				
						<?php while (have_posts()) : the_post(); ?>
				
							<li class="blog-item">
							<?php // The following determines what the post format is and shows the correct file accordingly
								$format = get_post_format();
								if($format == 'quote') {
								get_template_part( 'includes/post-formats/quote' );
								} else {
								get_template_part( 'includes/post-formats/standard' );
								}
							?>
							</li>
				
						<?php endwhile; ?>
								
						<!-- CLOSE .blog-items -->
						</ul>
						
					</div>
				
				<?php else: ?>
				
				<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
			
				<?php endif; ?>
				
				<?php if ( has_previous_posts() || has_next_posts() ) { ?>
			
					<!-- OPEN .pagination-wrap .blog-pagination .clearfix -->
					<div class="pagination-wrap blog-pagination clearfix">
					
						<div class="nav-previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">Older Entries</span>', "swiftframework")); ?></div>
						<?php wp_link_pages(); ?>
						<div class="nav-next"><?php previous_posts_link(__('<span class="nav-text">Newer Entries</span><i class="icon-chevron-right"></i>', "swiftframework")); ?></div>		
						
					<!-- CLOSE .pagination-wrap .blog-pagination .clearfix -->
					</div>
			
				<?php } ?>
				
			</section>
			
			<?php } ?>	
		
		<!-- CLOSE page -->
		</div>
		
		<?php if ($sidebar_config == "left-sidebar") { ?>
			
			<aside class="sidebar left-sidebar one-third column alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
	
		<?php } else if ($sidebar_config == "right-sidebar") { ?>
			
			<aside class="sidebar right-sidebar one-third column omega">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
	
			<aside class="sidebar right-sidebar four columns omega">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
		
		<?php } ?>
				
		<?php } else { ?>
		
		<div class="archive-page two-thirds column alpha clearfix">
			
			<article class="help-text">
				<?php _e("Sorry, but nothing matched your search criteria.", "swiftframework"); ?> 
				<br/>
				<?php _e("Please try again with some different keywords.", "swiftframework"); ?>
				<?php get_template_part('searchform'); ?>
			</article>
		
		</div>
		
		<aside class="sidebar left-sidebar one-third column omega">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>
		
		<?php } ?>

	</div>
		
<?php endif; ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>
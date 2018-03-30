<?php get_header(); ?>

<?php
	$options = get_option('sf_pinpoint_options');
	
	$page_layout = $options['page_layout'];
	if (isset($_GET['layout'])) {
		$page_layout = $_GET['layout'];
	}
	
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

<div class="page-heading full-width clearfix">
	<?php if ($page_layout == "fullwidth") { ?>
	<div class="container">
	<div class="sixteen columns">
	<?php } ?>
		<h1><?php single_cat_title(); ?></h1>
	<?php if ($page_layout == "fullwidth") { ?>
	</div>
	</div>
	<?php } ?>
</div>

<?php if ($page_layout == "fullwidth") { ?>
<div class="container">
<div class="sixteen columns">
<?php } ?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
	<!-- OPEN article -->
	<?php if ($sidebar_config == "left-sidebar") { ?>
	<div <?php post_class('archive-listings blog-wrap clearfix eleven columns omega'); ?> id="<?php the_ID(); ?>">
	<?php } elseif ($sidebar_config == "right-sidebar") { ?>
	<div <?php post_class('archive-listings blog-wrap clearfix eleven columns alpha'); ?> id="<?php the_ID(); ?>">
	<?php } else { ?>
	<div <?php post_class('archive-listings blog-wrap archive-page clearfix'); ?> id="<?php the_ID(); ?>">
	<?php } ?>
	
		<?php if ($sidebar_config == "both-sidebars") { ?>
			
			<div class="eight columns clearfix">
					
				<?php if(have_posts()) : ?>
					
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
			
				<?php endif; ?>
			
			<?php if ( has_previous_posts() || has_next_posts() ) { ?>
			
				<!-- OPEN .pagination-wrap .blog-pagination .full-width .clearfix -->
				<div class="pagination-wrap blog-pagination full-width clearfix">
				
					<div class="nav-previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">Older Entries</span>', "swiftframework")); ?></div>
					<?php wp_link_pages(); ?>
					<div class="nav-next"><?php previous_posts_link(__('<span class="nav-text">Newer Entries</span><i class="icon-chevron-right"></i>', "swiftframework")); ?></div>		
					
				<!-- CLOSE .pagination-wrap .blog-pagination .full-width .clearfix -->
				</div>
		
			<?php } ?>
				
			</div>	
				
			<aside class="sidebar left-sidebar four columns alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
		
		<?php } else { ?>
		
		<div class="blog-listings">
				
			<?php if(have_posts()) : ?>
				
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
		
			<?php endif; ?>
		
		<?php if ( has_previous_posts() || has_next_posts() ) { ?>
		
			<!-- OPEN .pagination-wrap .blog-pagination .full-width .clearfix -->
			<div class="pagination-wrap blog-pagination full-width clearfix">
			
				<div class="nav-previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">Older Entries</span>', "swiftframework")); ?></div>
				<?php wp_link_pages(); ?>
				<div class="nav-next"><?php previous_posts_link(__('<span class="nav-text">Newer Entries</span><i class="icon-chevron-right"></i>', "swiftframework")); ?></div>		
				
			<!-- CLOSE .pagination-wrap .blog-pagination .full-width .clearfix -->
			</div>
	
		<?php } ?>
			
		</div>
		
		<?php } ?>	
	
	<!-- CLOSE article -->
	</div>
	
	<?php if ($sidebar_config == "left-sidebar") { ?>
		
		<aside class="sidebar left-sidebar five columns alpha">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>

	<?php } else if ($sidebar_config == "right-sidebar") { ?>
		
		<aside class="sidebar right-sidebar five columns omega">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
		
	<?php } else if ($sidebar_config == "both-sidebars") { ?>

		
		<aside class="sidebar right-sidebar four columns omega">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
	
	<?php } ?>

</div>

<?php if ($page_layout == "fullwidth") { ?>
</div>
</div>
<?php } ?>


<!-- WordPress Hook -->
<?php get_footer(); ?>
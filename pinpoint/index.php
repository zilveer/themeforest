<?php get_header(); ?>

<?php
	$options = get_option('sf_pinpoint_options');
	$page_layout = $options['page_layout'];
?>
	
<?php if ( is_front_page() || is_home() ) : ?>

	<?php if ($page_layout == "fullwidth") { ?>
	<div class="container">
	<div class="sixteen columns">
	<?php } ?>

	<div class="inner-page-wrap has-one-sidebar has-right-sidebar clearfix" id="search-results">
		
		<!-- OPEN article -->
		<div class="archive-listings clearfix eleven columns alpha">
	
			<?php if(have_posts()) : ?>
				
				<!-- OPEN .blog-items -->
				<ul class="blog-items">

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

				<?php rewind_posts(); ?>

			<?php endif; ?>

			<?php if ( has_previous_posts() || has_next_posts() ) { ?>

				<div class="pagination-wrap blog-pagination full-width">
				
					<div class="nav-previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">Older Entries</span>', "swiftframework")); ?></div>
					<?php wp_link_pages(); ?>
					<div class="nav-next"><?php previous_posts_link(__('<span class="nav-text">Newer Entries</span><i class="icon-chevron-right"></i>', "swiftframework")); ?></div>		
					
				</div>

			<?php } ?>

		</div>

		<?php get_sidebar(); ?>
	
	</div>
	
	<?php if ($page_layout == "fullwidth") { ?>
	</div>
	</div>
	<?php } ?>

<?php elseif (is_search()) : ?>

	<div class="page-heading full-width clearfix">
		<?php if ($page_layout == "fullwidth") { ?>
		<div class="container">
		<div class="sixteen columns">
		<?php } ?>
		<?php $allsearch = new WP_Query("s=$s&showposts=-1"); $key = esc_html($s, 1); $count = $allsearch->post_count; _e('', "swiftframework"); wp_reset_query(); ?>
		<?php if ($count == 1) : ?>
			<?php printf(__('<h1>%1$s result for %2$s</h1>', 'swiftframework'), $count, $key ); ?>
		<?php else : ?>
			<?php printf(__('<h1>%1$s results for %2$s</h1>', 'swiftframework'), $count, $key ); ?>	
		<?php endif; ?>
		<?php if ($page_layout == "fullwidth") { ?>
		</div>
		</div>
		<?php } ?>
	</div>
	
	<?php if ($page_layout == "fullwidth") { ?>
	<div class="container">
	<div class="sixteen columns">
	<?php } ?>

	<div class="inner-page-wrap has-one-sidebar has-right-sidebar clearfix" id="search-results">
	
		<?php if ($count > 0) { ?>

		<div class="archive-listings clearfix eleven columns alpha">
			
			<?php if(have_posts()) : ?>
					
				<!-- OPEN .blog-items -->
				<ul class="blog-items">

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
				
				<div class="pagination-wrap search-pagination full-width clearfix">
					<div class="nav-previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">Older Entries</span>', 'swiftframework')); ?></div>
					<?php wp_link_pages(); ?>
					<div class="nav-next"><?php previous_posts_link(__('<span class="nav-text">Newer Entries</span><i class="icon-chevron-right"></i>', 'swiftframework')); ?></div>
				</div>

			<?php } ?>
			
		</div>
		
		<?php } else { ?>
		
		<article class="help-text eleven columns alpha">
			<?php _e("Sorry, but nothing matched your search criteria.", "swiftframework"); ?> 
			<br/>
			<?php _e("Please try again with some different keywords.", "swiftframework"); ?>
			<?php get_template_part('searchform'); ?>
		</article>
		
		<?php } ?>

		<?php get_sidebar(); ?>

	</div>
	
	<?php if ($page_layout == "fullwidth") { ?>
	</div>
	</div>
	<?php } ?>
		
<?php endif; ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>
<?php get_header(); ?>

<?php 

	$options = get_option('sf_neighborhood_options');

	$portfolio_archive_display_type = $portfolio_archive_columns = "";
	
	if (isset($options['portfolio_archive_display_type'])) {
	$portfolio_archive_display_type = $options['portfolio_archive_display_type'];
	} else {
	$portfolio_archive_display_type = "standard";
	}
	if (isset($options['portfolio_archive_columns'])) {
	$portfolio_archive_columns = $options['portfolio_archive_columns'];
	} else {
	$portfolio_archive_columns = 4;
	}
	
	$category_slug = get_query_var('portfolio-category');
?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
	<!-- OPEN page -->
	<div class="archive-page clearfix">

		<div class="page-content clearfix">

			<?php if(have_posts()) : ?>
				
				<div class="portfolio-wrap">
				
					<?php echo do_shortcode('[portfolio display_type="'.$portfolio_archive_display_type.'" columns="'.$portfolio_archive_columns.'" show_title="yes" show_subtitle="yes" show_excerpt="yes" excerpt_length="20" item_count="-1" category="'.$category_slug.'" exclude_categories="" portfolio_filter="no" pagination="yes" width="1/1" el_position="first last"]'); ?>
					
				</div>
			
			<?php else: ?>
			
			<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
		
			<?php endif; ?>
			
			<div class="pagination-wrap">
				<?php echo pagenavi($wp_query); ?>									
			</div>
			
		</div>
	
	<!-- CLOSE page -->
	</div>
	
</div>

<!--// WordPress Hook //-->
<?php get_footer(); ?>
<?php get_header(); ?>

<?php 
	$options = get_option('sf_pinpoint_options');
	
	$page_layout = $options['page_layout'];
	if (isset($_GET['layout'])) {
		$page_layout = $_GET['layout'];
	}
	
	$portfolio_archive_type = $portfolio_archive_display_type = $portfolio_archive_columns = "";
	
	if (isset($options['portfolio_archive_type'])) {
	$portfolio_archive_type = $options['portfolio_archive_type'];
	} else {
	$portfolio_archive_type = "masonry";
	}
	
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

<div class="inner-page-wrap top-spacing clearfix">
		
	<!-- OPEN page -->
	<div class="archive-page clearfix">

		<div class="page-content clearfix">

			<?php if(have_posts()) : ?>
				
				<div class="portfolio-wrap">
				
					<?php echo do_shortcode('[portfolio portfolio_type="'.$portfolio_archive_type.'" display_type="'.$portfolio_archive_display_type.'" columns="'.$portfolio_archive_columns.'" show_title="yes" show_subtitle="yes" show_excerpt="yes" excerpt_length="20" item_count="-1" category="'.$category_slug.'" exclude_categories="" portfolio_filter="no" pagination="yes" width="1/1" el_position="first last"]'); ?>
					
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

<?php if ($page_layout == "fullwidth") { ?>
</div>
</div>
<?php } ?>


<!-- WordPress Hook -->
<?php get_footer(); ?>
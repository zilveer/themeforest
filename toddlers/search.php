<?php
/*
Search Results
*/
get_header();
global $unf_options;
?>

<div id="content-wrapper" class="row clearfix search-wrapper">
	<div id="content" class="col-md-8 column">
		<div class="article clearfix">
			<h1 class="page-title">
				<?php _e("Search Results for",'toddlers' ); ?>: <?php echo esc_attr(get_search_query()); ?>
			</h1>
			<?php get_template_part( 'loop','compactlist' ); ?>
			<?php get_template_part('pagination'); ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
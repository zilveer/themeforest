<?php get_header(); ?>
	
<?php 
	global $sf_options;
	$blog_type = $sf_options['archive_display_type'];
	
	if ($blog_type == "masonry" || $blog_type == "masonry-fw") {
		global $sf_include_imagesLoaded;
		$sf_include_imagesLoaded = true;
	}
	
	global $sf_has_blog;
	$sf_has_blog = true;
?>

<?php if ($blog_type != "masonry-fw") { ?>
<div class="container">
<?php } ?>

	<?php sf_base_layout('archive'); ?>
	
<?php if ($blog_type != "masonry-fw") { ?>
</div>
<?php } ?>

<?php get_footer(); ?>
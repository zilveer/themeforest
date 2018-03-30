<?php
$blog_archive_pages_classes = flow_elated_blog_archive_pages_classes(flow_elated_get_default_blog_list());
?>
<?php get_header(); ?>
<?php flow_elated_get_title(); ?>
<div class="<?php echo esc_attr($blog_archive_pages_classes['holder']); ?>">
	<?php do_action('flow_elated_after_container_open'); ?>
	<div class="<?php echo esc_attr($blog_archive_pages_classes['inner']); ?>">
		<?php flow_elated_get_blog(flow_elated_get_default_blog_list()); ?>
	</div>
	<?php do_action('flow_elated_before_container_close'); ?>
</div>
<?php get_footer(); ?>

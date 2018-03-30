<?php
$blog_archive_pages_classes = suprema_qodef_blog_archive_pages_classes(suprema_qodef_get_default_blog_list());
?>
<?php get_header(); ?>
<?php suprema_qodef_get_title(); ?>
<div class="<?php echo esc_attr($blog_archive_pages_classes['holder']); ?>">
	<?php do_action('suprema_qodef_after_container_open'); ?>
	<div class="<?php echo esc_attr($blog_archive_pages_classes['inner']); ?>">
		<?php suprema_qodef_get_blog(suprema_qodef_get_default_blog_list()); ?>
	</div>
	<?php do_action('suprema_qodef_before_container_close'); ?>
</div>
<?php get_footer(); ?>

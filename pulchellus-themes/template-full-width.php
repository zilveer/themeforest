<?php
/*
Template Name: Full Width
*/	
?>
<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>

<?php 

	wp_reset_query();
	global $post;

?>
<!-- Content -->
 <div id="primary">
		<?php if (have_posts()) : ?>
				<?php the_content(); ?>
		<?php else: ?>
			<p><?php printf ( __('Sorry, no posts matched your criteria.' , THEME_NAME )); ?></p>
		<?php endif; ?>
</div>

</div>

<?php get_footer(); ?>
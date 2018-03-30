<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php libero_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="mkd-container">
		<?php do_action('libero_mikado_after_container_open'); ?>
		<div class="mkd-container-inner">
			<?php libero_mikado_get_blog_single(); ?>
		</div>
		<?php do_action('libero_mikado_before_container_close'); ?>
	</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
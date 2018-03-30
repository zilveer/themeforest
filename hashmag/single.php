<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('slider'); ?>
	<div class="mkdf-container">
        <?php hashmag_mikado_get_blog_single_breadcumbs(); ?>
		<?php do_action('hashmag_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner">
            <?php // rendering in blog single template - hashmag_mikado_get_title(); ?>
			<?php hashmag_mikado_get_blog_single(); ?>
		</div>
		<?php do_action('hashmag_mikado_before_container_close'); ?>
	</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
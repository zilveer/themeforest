<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<section class="main">
	<?php Website::title(); ?>
	<?php
		$gallery_query = new WP_Query(array(
			'post_parent'    => get_the_ID(),
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC'
		));
	?>
	<?php if (!post_password_required() && $gallery_query->have_posts()): ?>
		<div class="featured flexslider">
			<ul class="slides">
				<?php while ($gallery_query->have_posts()): ?>
					<?php $gallery_query->the_post(); ?>
					<li>
						<?php echo wp_get_attachment_image(get_the_ID(), 'post-image'); ?>
						<?php if (has_excerpt()): ?>
							<p class="flex-caption"><?php echo get_the_excerpt(); ?></p>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
	<?php get_template_part('content', 'portfolio-item'); ?>
</section>
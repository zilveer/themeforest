<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<section class="main clear">
	<?php if (!post_password_required() && has_post_thumbnail() && Website::to_('format_post/default/featured/visible')->value(is_singular() ? 'single' : 'list')): ?>
		<div class="featured">
			<?php if (is_singular() || Website::to('format_post/default/featured/link') == 'fancybox'): ?>
				<a href="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $img[0]; ?>" class="fancybox">
					<?php the_post_thumbnail('post-thumbnail'); ?>
				</a>
			<?php else: ?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('post-thumbnail'); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php Website::title(); ?>
	<?php get_template_part('content', 'post'); ?>
</section>
<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<section class="main">
	<?php Website::title(); ?>
	<?php if (!post_password_required() && has_post_thumbnail() && Website::to_('format_post/image/featured/visible')->value(is_singular() ? 'single' : 'list')): ?>
		<div class="featured">
			<?php if (is_singular() || Website::to('format_post/image/featured/link') == 'fancybox'): ?>
				<a href="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $img[0]; ?>" class="fancybox">
					<?php the_post_thumbnail('post-image'); ?>
				</a>
			<?php else: ?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('post-image'); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php get_template_part('content', 'post'); ?>
</section>
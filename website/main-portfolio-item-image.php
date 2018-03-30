<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<section class="main">
	<?php Website::title(); ?>
	<?php if (!post_password_required() && has_post_thumbnail()): ?>
		<div class="featured">
			<?php the_post_thumbnail('post-image'); ?>
		</div>
	<?php endif; ?>
	<?php get_template_part('content', 'portfolio-item'); ?>
</section>
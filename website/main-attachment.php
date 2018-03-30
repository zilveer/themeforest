<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<section class="main">
	<?php Website::title(); ?>
	<div class="content">
		<figure class="full-width-mobile <?php echo Website::to('appearance/image/border'); ?>">
			<?php echo wp_get_attachment_image(get_the_ID(), 'post-image-full'); ?>
			<?php if (has_excerpt()): ?>
				<figcaption><?php the_excerpt(); ?></figcaption>
			<?php endif; ?>
		</figure>
	</div>
</section>
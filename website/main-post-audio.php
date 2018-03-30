<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<section class="main">
	<?php Website::title(); ?>
	<?php if (!post_password_required() && Website::to_('format_post/audio/player/visible')->value(is_singular() ? 'single' : 'list')): ?>
		<div class="featured"><?php
			if (Website::po('audio/url')) {
				echo wp_audio_shortcode(array('src' => Website::po('audio/url'), 'width' => $GLOBALS['content_width']));
			}
		?></div>
	<?php endif; ?>
	<?php get_template_part('content', 'post'); ?>
</section>
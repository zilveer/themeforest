<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<section class="main">
	<?php Website::title(); ?>
	<?php if (!post_password_required()): ?>
		<div class="featured"><?php
			if (Website::po('video/method') == 'self' && Website::po('video/url')) {
				$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-image-full');
				$thumbnail = $thumbnail === false ? '' : $thumbnail[0];
				echo wp_video_shortcode(array('src' => Website::po('video/url'), 'poster' => $thumbnail, 'width' => $GLOBALS['content_width'], 'height' => round($GLOBALS['content_width']/Website::po('video/ratio'))));
			} else {
				echo Website::po('video/code');
			}
		?></div>
	<?php endif; ?>
	<?php get_template_part('content', 'portfolio-item'); ?>
</section>
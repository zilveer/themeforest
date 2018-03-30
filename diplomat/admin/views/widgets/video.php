<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_video">

	<?php
	if (!empty($instance['url'])){

		$attributes = array(
			'width' => 'width=""',
			'height' => 'height=""',
		);

		if (!empty($instance['height'])) {
			$attributes['width'] = 'width="100%"';
			$attributes['height'] = 'height="' . $instance['height'] . '"';
		}

		if (!empty($instance['video_cover_image'])) {
			$attributes[] = 'cover_image="' . esc_url($instance['video_cover_image']) . '"';

			if (!empty($instance['video_cover_image_on_mobiles'])) {
				$attributes[] = 'cover_image_on_mobiles="' . $instance['video_cover_image_on_mobiles'] . '"';
			}

		}

		echo do_shortcode('[tmm_video ' . implode(' ', $attributes) . ']'.$instance['url'].'[/tmm_video]');
		
	}
	?>

	<?php if (!empty($instance['title'])){ ?>
		<h4 class="widget-title"><?php echo esc_html($instance['title']); ?></h4>
	<?php } ?>

</div><!--/ .widget-container-->
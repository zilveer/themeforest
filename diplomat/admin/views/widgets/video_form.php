<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo esc_attr($widget->get_field_id('title')); ?>"><?php esc_html_e('Title', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('url')); ?>"><?php esc_html_e('Url', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('url')); ?>" name="<?php echo esc_attr($widget->get_field_name('url')); ?>" value="<?php echo esc_attr($instance['url']); ?>" />
	<a class="button button_upload_video" href="#" style="margin-top: 8px;"><?php esc_html_e('Browse', 'diplomat') ?></a>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('video_cover_image')); ?>"><?php esc_html_e('Cover Image for Self Hosted Video', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('video_cover_image')); ?>" name="<?php echo esc_attr($widget->get_field_name('video_cover_image')); ?>" value="<?php echo esc_attr($instance['video_cover_image']); ?>">
	<a class="button button_upload" href="#" style="margin-top: 8px;"><?php esc_html_e('Browse', 'diplomat'); ?></a>
</p>

<p>
	<label class="selectit">
		<input type="hidden" value="<?php echo esc_attr($instance['video_cover_image_on_mobiles']); ?>" name="<?php echo esc_attr($widget->get_field_name('video_cover_image_on_mobiles')); ?>">
		<?php $is_checked = intval($instance['video_cover_image_on_mobiles']); ?>
		<input type="checkbox" class="option_checkbox" value="1" <?php checked($is_checked, 1); ?>>
		<?php _e('Show Cover Image Only on Mobiles', 'diplomat'); ?>
	</label>
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('height')); ?>"><?php esc_html_e('Height', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('height')); ?>" name="<?php echo esc_attr($widget->get_field_name('height')); ?>" value="<?php echo esc_attr($instance['height']); ?>" />
</p>
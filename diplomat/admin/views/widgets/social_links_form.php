<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<p>
	<label for="<?php echo $widget->get_field_id('title'); ?>"><?php esc_html_e('Title', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<?php
$social_types = unserialize(TMM::get_option('social_types'));
if (!empty($social_types)){

	foreach ($social_types as $key => $type) {

		$type = $type['name'];

		?>

		<p>
			<label for="<?php echo esc_attr($widget->get_field_id($key . '_tooltip')); ?>"><?php echo $type . ' ' . esc_html__('Tooltip', 'diplomat'); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id($key . '_tooltip')); ?>" name="<?php echo esc_attr($widget->get_field_name($key . '_tooltip')); ?>" value="<?php echo esc_attr($instance[$key . '_tooltip']); ?>" />
		</p>

		<?php

		if ($key === 'rss') {
			?>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($widget->get_field_id($key . '_links')); ?>" name="<?php echo esc_attr($widget->get_field_name($key . '_links')); ?>" value="true" <?php checked($instance['rss_links'], 'true'); ?> />
				<label for="<?php echo esc_attr($widget->get_field_id($key . '_links')); ?>"><?php esc_html_e('Show RSS Link', 'diplomat') ?></label>
			</p>

			<?php
		} else {
			?>

			<p>
				<label for="<?php echo esc_attr($widget->get_field_id($key . '_links')); ?>"><?php echo $type . ' ' . esc_html__('Link', 'diplomat'); ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id($key . '_links')); ?>" name="<?php echo esc_attr($widget->get_field_name($key . '_links')); ?>" value="<?php echo esc_attr($instance[$key . '_links']); ?>" />
			</p>

			<?php
		}

	}

}
?>

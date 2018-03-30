<?php

/**
 * advertisement widget
 */
class ch_advertisement extends WP_Widget {

	private $max_ads = 6;

	public function ch_advertisement() {
		$widget_opts = array(
			'classname'   => 'ch_advertisement',
			'description' => __('Displays advertisement', 'ch')
		);
		parent::__construct('ch_advertisement', __('Believe - Advertisement', 'ch'), $widget_opts);
	}

	public function widget($args, $instance) {

		// Vars
		global $ch_is_in_sidebar;

		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$count = (int) $instance['count'];

		$class = 'class=""';
		if ($ch_is_in_sidebar === true) {
			$class = ' class="img-polaroid"';
		}

		echo $before_widget;
		if ($title) {
			echo $before_title . $title . $after_title;
		}

		for ($i = 1; $i <= $count; $i++) {
			$image = isset($instance['ad_image'][$i]) ? $instance['ad_image'][$i] : '';
			$link = isset($instance['ad_link'][$i]) ? $instance['ad_link'][$i] : '';
			?>
			<div class="advertisement-container">
				<a href="<?php echo $link ?>" rel="nofollow" target="_top" class="no_thickbox" title="<?php _e('Advertisement', 'ch') ?>">
					<img src="<?php echo $image; ?>" alt="<?php _e('Advertisement', 'ch') ?>"<?php echo $class; ?> />
				</a>
			</div>
			<?php
		}

		echo $after_widget;
	}

	public function update($new_instance, $old_instance) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = (int) $new_instance['count'];
		for ($i = 1; $i <= $instance['count']; $i++) {
			$instance['ad_image'][$i] = strip_tags($new_instance['ad_image_' . $i]);
			$instance['ad_link'][$i] = strip_tags($new_instance['ad_link_' . $i]);
		}
		return $instance;
	}

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 1;
		for ($i = 1; $i <= $this->max_ads; $i++) {
			$selected_ad_image[$i] = isset($instance['ad_image'][$i]) ? $instance['ad_image'][$i] : '';
			$selected_ad_link[$i]  = isset($instance['ad_link'][$i]) ? $instance['ad_link'][$i] : '';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many ads to display?', 'ch'); ?></label>
			<select id="<?php echo $this->get_field_id('count'); ?>" class="how_many" name="<?php echo $this->get_field_name('count'); ?>">
				<?php for ($i = 1; $i <= $this->max_ads; $i++): ?>
					<option <?php if ($i == $count) echo 'selected="selected"' ?>><?php echo $i; ?></option>
				<?php endfor ?>
			</select>
		</p>
		<div class="advertisement_container">
			<?php
			for ($i = 1; $i <= $this->max_ads; $i++) {
				$ad_image = "ad_image_$i";
				$ad_link  = "ad_link_$i";
				?>
				<div class="hidden_container" <?php if ($i > $count) { ?>style="display:none"<?php } ?>>
					<span class="adv_counter"><?php echo $i; ?>.</span>
					<p>
						<label for="<?php echo $this->get_field_id($ad_image); ?>"><?php _e('Image URL:', 'ch'); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id($ad_image); ?>" name="<?php echo $this->get_field_name($ad_image); ?>" type="text" value="<?php echo $selected_ad_image[$i]; ?>" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id($ad_link); ?>"><?php _e('Link:', 'ch'); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id($ad_link); ?>" name="<?php echo $this->get_field_name($ad_link); ?>" type="text" value="<?php echo $selected_ad_link[$i]; ?>" />
					</p>
					<p>
						<em><?php _e("Example: <code>http://www.example.com</code>", 'ch'); ?></em>
					</p>
				</div>

			<?php } ?>
		</div><?php
	}

}

register_widget('ch_advertisement');
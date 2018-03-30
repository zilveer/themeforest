<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="entry-content">
	<p>
		<label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
		<input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<?php
	$work_time_array = array();
	for ($h = 0; $h <= 23; $h++) {
		for ($m = 0; $m < 60; $m+=15) {
			$work_time_array[] = ($h < 10 ? "0" . $h : $h) . ':' . ($m < 10 ? "0" . $m : $m);
		}
	}
	?>

	<p>
		<label for="<?php echo $widget->get_field_id('mon_start'); ?>"><?php _e('Monday', 'cardealer') ?>:</label>
		<input type="checkbox" id="<?php echo $widget->get_field_id('mon_is_closed'); ?>" name="<?php echo $widget->get_field_name('mon_is_closed'); ?>" value="true" <?php checked($instance['mon_is_closed'], 'true', true); ?> />
		<label for="<?php echo $widget->get_field_id('mon_is_closed'); ?>"><?php _e('Closed', 'cardealer') ?></label>

		<select id="<?php echo $widget->get_field_id('mon_start'); ?>" name="<?php echo $widget->get_field_name('mon_start'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['mon_start'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select>&nbsp;-&nbsp;<select id="<?php echo $widget->get_field_id('mon_end'); ?>" name="<?php echo $widget->get_field_name('mon_end'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['mon_end'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select><br />
	</p>


	<p>
		<label for="<?php echo $widget->get_field_id('tue_start'); ?>"><?php _e('Tuesday', 'cardealer') ?>:</label>
		<input type="checkbox" id="<?php echo $widget->get_field_id('tue_is_closed'); ?>" name="<?php echo $widget->get_field_name('tue_is_closed'); ?>" value="true" <?php checked($instance['tue_is_closed'], 'true', true); ?> />
		<label for="<?php echo $widget->get_field_id('tue_is_closed'); ?>"><?php _e('Closed', 'cardealer') ?></label>

		<select id="<?php echo $widget->get_field_id('tue_start'); ?>" name="<?php echo $widget->get_field_name('tue_start'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['tue_start'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select>&nbsp;-&nbsp;<select id="<?php echo $widget->get_field_id('tue_end'); ?>" name="<?php echo $widget->get_field_name('tue_end'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['tue_end'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select><br />
	</p>



	<p>
		<label for="<?php echo $widget->get_field_id('wed_start'); ?>"><?php _e('Wednesday', 'cardealer') ?>:</label>
		<input type="checkbox" id="<?php echo $widget->get_field_id('wed_is_closed'); ?>" name="<?php echo $widget->get_field_name('wed_is_closed'); ?>" value="true" <?php checked($instance['wed_is_closed'], 'true', true); ?> />
		<label for="<?php echo $widget->get_field_id('wed_is_closed'); ?>"><?php _e('Closed', 'cardealer') ?></label>

		<select id="<?php echo $widget->get_field_id('wed_start'); ?>" name="<?php echo $widget->get_field_name('wed_start'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['wed_start'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select>&nbsp;-&nbsp;<select id="<?php echo $widget->get_field_id('wed_end'); ?>" name="<?php echo $widget->get_field_name('wed_end'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['wed_end'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select><br />
	</p>


	<p>
		<label for="<?php echo $widget->get_field_id('thu_start'); ?>"><?php _e('Thursday', 'cardealer') ?>:</label>
		<input type="checkbox" id="<?php echo $widget->get_field_id('thu_is_closed'); ?>" name="<?php echo $widget->get_field_name('thu_is_closed'); ?>" value="true" <?php checked($instance['thu_is_closed'], 'true', true); ?> />
		<label for="<?php echo $widget->get_field_id('thu_is_closed'); ?>"><?php _e('Closed', 'cardealer') ?></label>

		<select id="<?php echo $widget->get_field_id('thu_start'); ?>" name="<?php echo $widget->get_field_name('thu_start'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['thu_start'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select>&nbsp;-&nbsp;<select id="<?php echo $widget->get_field_id('thu_end'); ?>" name="<?php echo $widget->get_field_name('thu_end'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['thu_end'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select><br />
	</p>



	<p>
		<label for="<?php echo $widget->get_field_id('fri_start'); ?>"><?php _e('Friday', 'cardealer') ?>:</label>
		<input type="checkbox" id="<?php echo $widget->get_field_id('fri_is_closed'); ?>" name="<?php echo $widget->get_field_name('fri_is_closed'); ?>" value="true" <?php checked($instance['fri_is_closed'], 'true', true); ?> />
		<label for="<?php echo $widget->get_field_id('fri_is_closed'); ?>"><?php _e('Closed', 'cardealer') ?></label>

		<select id="<?php echo $widget->get_field_id('fri_start'); ?>" name="<?php echo $widget->get_field_name('fri_start'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['fri_start'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select>&nbsp;-&nbsp;<select id="<?php echo $widget->get_field_id('fri_end'); ?>" name="<?php echo $widget->get_field_name('fri_end'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['fri_end'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select><br />
	</p>



	<p>
		<label for="<?php echo $widget->get_field_id('sat_start'); ?>"><?php _e('Saturday', 'cardealer') ?>:</label>
		<input type="checkbox" id="<?php echo $widget->get_field_id('sat_is_closed'); ?>" name="<?php echo $widget->get_field_name('sat_is_closed'); ?>" value="true" <?php checked($instance['sat_is_closed'], 'true', true); ?> />
		<label for="<?php echo $widget->get_field_id('sat_is_closed'); ?>"><?php _e('Closed', 'cardealer') ?></label>

		<select id="<?php echo $widget->get_field_id('sat_start'); ?>" name="<?php echo $widget->get_field_name('sat_start'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['sat_start'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select>&nbsp;-&nbsp;<select id="<?php echo $widget->get_field_id('sat_end'); ?>" name="<?php echo $widget->get_field_name('sat_end'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['sat_end'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select><br />
	</p>



	<p>
		<label for="<?php echo $widget->get_field_id('sun_start'); ?>"><?php _e('Sunday', 'cardealer') ?>:</label>
		<input type="checkbox" id="<?php echo $widget->get_field_id('sun_is_closed'); ?>" name="<?php echo $widget->get_field_name('sun_is_closed'); ?>" value="true" <?php checked($instance['sun_is_closed'], 'true', true); ?> />
		<label for="<?php echo $widget->get_field_id('sun_is_closed'); ?>"><?php _e('Closed', 'cardealer') ?></label>

		<select id="<?php echo $widget->get_field_id('sun_start'); ?>" name="<?php echo $widget->get_field_name('sun_start'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['sun_start'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select>&nbsp;-&nbsp;<select id="<?php echo $widget->get_field_id('sun_end'); ?>" name="<?php echo $widget->get_field_name('sun_end'); ?>" class="widefat">
			<?php foreach ($work_time_array as $time) : ?>
				<option <?php echo($time == $instance['sun_end'] ? "selected" : "") ?> value="<?php echo $time ?>"><?php echo $time ?></option>
			<?php endforeach; ?>
		</select><br />
	</p>
</div>


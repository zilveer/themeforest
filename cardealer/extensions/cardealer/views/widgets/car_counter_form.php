<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
	<label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
	<input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>"
		   name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"/>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_last_hour_cell'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_last_hour_cell'); ?>"
		   name="<?php echo $widget->get_field_name('show_last_hour_cell'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_last_hour_cell'); ?>"><?php _e('Display "Last Hour" cell', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_last_day_cell'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_last_day_cell'); ?>"
		   name="<?php echo $widget->get_field_name('show_last_day_cell'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_last_day_cell'); ?>"><?php _e('Display "Last Day" cell', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_cars_total_cell'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_cars_total_cell'); ?>"
		   name="<?php echo $widget->get_field_name('show_cars_total_cell'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_cars_total_cell'); ?>"><?php _e('Display "Added cars total" cell', 'cardealer') ?></label>
</p>
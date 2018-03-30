<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('user_number'); ?>"><?php _e('User Number', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('user_number'); ?>" name="<?php echo $widget->get_field_name('user_number'); ?>" value="<?php echo $instance['user_number']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('order'); ?>"><?php _e('Display Order', 'cardealer') ?>:</label>
    <select id="<?php echo $widget->get_field_id('order'); ?>" name="<?php echo $widget->get_field_name('order'); ?>" class="widefat">
		<?php
		$order = array(
			'latest' => __('Latest', 'cardealer'),
			'random' => __('Random', 'cardealer')
		);
		?>
		<?php foreach ($order as $key => $type) : ?>
			<option <?php echo($key == $instance['order'] ? "selected" : "") ?> value="<?php echo $key ?>"><?php echo $type ?></option>
		<?php endforeach; ?>
    </select>
</p>

<p>
	<?php
	$packets = TMM_Cardealer_User::get_user_roles();
	$packets = array_merge($packets, array('administrator' => array('name' => __('Administrator', 'cardealer'))));
	?>
    <label for="<?php echo $widget->get_field_id('packet'); ?>"><?php _e('Account Status', 'cardealer') ?>:</label>
    <select id="<?php echo $widget->get_field_id('packet'); ?>" name="<?php echo $widget->get_field_name('packet'); ?>" class="widefat">
		<option value="0"><?php _e('All', 'cardealer') ?></option>
		<?php foreach ($packets as $key => $value) : ?>
			<option <?php echo($key == $instance['packet'] ? "selected" : "") ?> value="<?php echo $key ?>"><?php echo $value['name'] ?></option>
		<?php endforeach; ?>
    </select>
</p>

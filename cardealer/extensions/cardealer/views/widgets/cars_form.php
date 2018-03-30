<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
	<label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
	<input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>"
	       name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"/>
</p>

<p>
	<label for="<?php echo $widget->get_field_id('post_number'); ?>"><?php _e('Cars Number', 'cardealer') ?>:</label>
	<select id="<?php echo $widget->get_field_id('post_number'); ?>" name="<?php echo $widget->get_field_name('post_number'); ?>" class="widefat">
		<?php
		$range = range(1,12);

		foreach ($range as $value) {
			?>
			<option <?php selected($instance['post_number'], $value); ?> value="<?php echo $value ?>"><?php echo $value ?></option>
			<?php
		}
		?>
	</select>
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_only_featured_cars'); ?>"
	       name="<?php echo $widget->get_field_name('show_only_featured_cars'); ?>" value="true" <?php checked($instance['show_only_featured_cars'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_only_featured_cars'); ?>"><?php _e('Display only Featured cars', 'cardealer') ?></label>
</p>

<p>
	<label for="<?php echo $widget->get_field_id('order'); ?>"><?php _e('Display Order', 'cardealer') ?>:</label>
	<select id="<?php echo $widget->get_field_id('order'); ?>" name="<?php echo $widget->get_field_name('order'); ?>" class="widefat">
		<?php
		$order = array(
			'DESC' => __('Latest First', 'cardealer'),
			'ASC' => __('Oldest First', 'cardealer'),
			'random' => __('Random', 'cardealer')
		);

		foreach ($order as $key => $type) {
			?>
			<option <?php selected($instance['order'], $key); ?> value="<?php echo $key ?>"><?php echo $type ?></option>
			<?php
		}
		?>
	</select>
</p>

<p>
	<?php
	$packets = TMM_Cardealer_User::get_user_roles();
	$packets = array_merge($packets, array('administrator' => array('name' => __('Administrator', 'cardealer'))));
	?>
	<label for="<?php echo $widget->get_field_id('dealer_type'); ?>"><?php _e('Dealer Type', 'cardealer') ?>:</label>
	<select id="<?php echo $widget->get_field_id('dealer_type'); ?>" name="<?php echo $widget->get_field_name('dealer_type'); ?>" class="widefat widget_dealer_type">
		<option <?php selected($instance['dealer_type'], '0'); ?> value="0"><?php _e('All', 'cardealer') ?></option>
		<?php
		foreach ($packets as $key => $value) {
			?>
			<option <?php selected($instance['dealer_type'], $key); ?> value="<?php echo $key ?>"><?php echo $value['name'] ?></option>
			<?php
		}
		?>
	</select>
</p>

<p>
	<?php
	$users = get_users(array(
		'role' => $instance['dealer_type'],
		'fields' => array('ID', 'user_nicename')
	));
	?>
	<label for="<?php echo $widget->get_field_id('specific_dealer'); ?>"><?php _e('Specific Dealer', 'cardealer') ?>:</label>
	<select id="<?php echo $widget->get_field_id('specific_dealer'); ?>" name="<?php echo $widget->get_field_name('specific_dealer'); ?>" class="widefat widget_specific_dealer">
		<option <?php selected($instance['specific_dealer'], ''); ?> value=""><?php _e('All', 'cardealer') ?></option>
		<?php
		foreach ($users as $value) {
			?>
			<option <?php selected($instance['specific_dealer'], $value->ID); ?> value="<?php echo $value->ID ?>"><?php echo $value->user_nicename ?></option>
		<?php
		}
		?>
	</select>
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_see_all_button'); ?>"
	       name="<?php echo $widget->get_field_name('show_see_all_button'); ?>" value="true" <?php checked($instance['show_see_all_button'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_see_all_button'); ?>"><?php _e('Display "All Cars" button', 'cardealer') ?></label>
</p>


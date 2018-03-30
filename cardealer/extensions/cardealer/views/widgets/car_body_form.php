<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_name'); ?>"
	       name="<?php echo $widget->get_field_name('show_name'); ?>" value="true" <?php checked($instance['show_name'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_name'); ?>"><?php _e('Display Body Type Name', 'cardealer') ?></label>
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_count'); ?>"
	       name="<?php echo $widget->get_field_name('show_count'); ?>" value="true" <?php checked($instance['show_count'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_count'); ?>"><?php _e('Display Count of Cars Related to Body Type', 'cardealer') ?></label>
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('enable_link'); ?>"
	       name="<?php echo $widget->get_field_name('enable_link'); ?>" value="true" <?php checked($instance['enable_link'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('enable_link'); ?>"><?php _e('Enable Link to Car Listing', 'cardealer') ?></label>
</p>
<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
	<label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
	<input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>"
		   name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"/>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_dealers_name'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_dealers_name'); ?>"
		   name="<?php echo $widget->get_field_name('show_dealers_name'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_dealers_name'); ?>"><?php _e('Show dealers name', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_contact_person'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_contact_person'); ?>"
		   name="<?php echo $widget->get_field_name('show_contact_person'); ?>" value="true" <?php echo $checked; ?> />
	<label
		for="<?php echo $widget->get_field_id('show_contact_person'); ?>"><?php _e('Show contact person', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_address'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_address'); ?>"
		   name="<?php echo $widget->get_field_name('show_address'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_address'); ?>"><?php _e('Show address', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_phone'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_phone'); ?>"
		   name="<?php echo $widget->get_field_name('show_phone'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_phone'); ?>"><?php _e('Show phone', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_mobile'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_mobile'); ?>"
		   name="<?php echo $widget->get_field_name('show_mobile'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_mobile'); ?>"><?php _e('Show mobile', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_fax'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_fax'); ?>"
		   name="<?php echo $widget->get_field_name('show_fax'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_fax'); ?>"><?php _e('Show fax', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_email'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_email'); ?>"
		   name="<?php echo $widget->get_field_name('show_email'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_email'); ?>"><?php _e('Show email', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_skype'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_skype'); ?>"
		   name="<?php echo $widget->get_field_name('show_skype'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_skype'); ?>"><?php _e('Show skype', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_url'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_url'); ?>"
		   name="<?php echo $widget->get_field_name('show_url'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_url'); ?>"><?php _e('Show url', 'cardealer') ?></label>
</p>
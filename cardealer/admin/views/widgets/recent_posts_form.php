<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('category'); ?>"><?php _e('Posts Category', 'cardealer') ?>:</label>
	<?php
	$args = array(
		'hide_empty' => 0,
		'show_option_all' => __('All Categories', 'cardealer'),
		'echo' => 0,
		'selected' => $instance['category'],
		'hierarchical' => 0,
		'id' => $widget->get_field_id('category'),
		'name' => $widget->get_field_name('category'),
		'class' => 'widefat',
		'depth' => 0,
		'tab_index' => 0,
		'taxonomy' => 'category',
		'hide_if_empty' => false
	);
	echo wp_dropdown_categories($args);
	?>
</p>

<p>
    <label for="<?php echo $widget->get_field_id('post_number'); ?>"><?php _e('Post Number', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('post_number'); ?>" name="<?php echo $widget->get_field_name('post_number'); ?>" value="<?php echo $instance['post_number']; ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_thumbnail'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_thumbnail'); ?>" name="<?php echo $widget->get_field_name('show_thumbnail'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_thumbnail'); ?>"><?php _e('Display Thumbnail', 'cardealer') ?></label>
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('truncate_title'); ?>"
	       name="<?php echo $widget->get_field_name('truncate_title'); ?>" value="true" <?php checked($instance['truncate_title'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('truncate_title'); ?>"><?php _e('Excerpt Title', 'cardealer') ?></label>
</p>

<p>
	<label for="<?php echo $widget->get_field_id('truncate_title_symbols_count'); ?>"><?php _e('Title Excerpt symbol count', 'cardealer') ?>:</label>
	<input class="widefat" type="text" id="<?php echo $widget->get_field_id('truncate_title_symbols_count'); ?>" name="<?php echo $widget->get_field_name('truncate_title_symbols_count'); ?>" value="<?php echo $instance['truncate_title_symbols_count']; ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_exerpt'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_exerpt'); ?>" name="<?php echo $widget->get_field_name('show_exerpt'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_exerpt'); ?>"><?php _e('Display Excerpt', 'cardealer') ?></label>
</p>

<p>
    <label for="<?php echo $widget->get_field_id('exerpt_symbols_count'); ?>"><?php _e('Excerpt symbol count', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('exerpt_symbols_count'); ?>" name="<?php echo $widget->get_field_name('exerpt_symbols_count'); ?>" value="<?php echo $instance['exerpt_symbols_count']; ?>" />
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_comments_number'); ?>"
	       name="<?php echo $widget->get_field_name('show_comments_number'); ?>" value="true" <?php checked($instance['show_comments_number'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_comments_number'); ?>"><?php _e('Display Comments Number', 'cardealer') ?></label>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['exerpt_symbols_count'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_see_all_button'); ?>" name="<?php echo $widget->get_field_name('show_see_all_button'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_see_all_button'); ?>"><?php _e('Display "View all" button', 'cardealer') ?></label>
</p>
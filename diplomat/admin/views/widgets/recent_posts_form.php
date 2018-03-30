<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo esc_attr($widget->get_field_id('title')); ?>"><?php esc_html_e('Title', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('category')); ?>"><?php esc_html_e('Show posts from categories', 'diplomat') ?>:</label>
	<?php
              
	$args = array(
		'hide_empty' => 0,
		'show_option_all' => __('All Categories', 'diplomat'),
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

        $categories = get_categories($args);
               
        foreach ($categories as $category){
        ?>
        <p>
            <?php
            $checked = "";            
           
        if (isset($instance['category'][$category->slug]) && $instance['category'][$category->slug] ) {
                    $checked = 'checked="checked"';
            }
            ?>
            <input class="widefat" type="checkbox" id="<?php echo esc_attr($category->term_id); ?>" name="<?php echo esc_attr($widget->get_field_name('category') . '[' . $category->slug . ']'); ?>" value="<?php echo esc_attr($category->name); ?>" <?php echo $checked; ?> />
            <label for="<?php  echo esc_attr($category->term_id); ?>"><?php echo esc_html($category->name); ?></label>
        </p>
        <?php
        }
        
	?>
</p>
<p>
	<label for="<?php echo esc_attr($widget->get_field_id('number_category_posts')); ?>"><?php esc_html_e('Number of posts from categories to display', 'diplomat') ?>:</label>
	<select id="<?php echo esc_attr($widget->get_field_id('number_category_posts')); ?>" name="<?php echo esc_attr($widget->get_field_name('number_category_posts')); ?>" class="widefat">
		<?php

		for ($i=1; $i<=10; $i++){ ?>
			<option <?php echo($i == $instance['number_category_posts'] ? "selected" : "") ?> value="<?php echo esc_attr($i) ?>"><?php echo esc_html($i) ?></option>
		<?php } ?>
	</select>
</p>

<hr>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('number_popular_posts')); ?>"><?php esc_html_e('Number of Popular posts to display', 'diplomat') ?>:</label>
	<select id="<?php echo esc_attr($widget->get_field_id('number_popular_posts')); ?>" name="<?php echo esc_attr($widget->get_field_name('number_popular_posts')); ?>" class="widefat">
		<?php

		for ($i=1; $i<=10; $i++){ ?>
			<option <?php echo($i == $instance['number_popular_posts'] ? "selected" : "") ?> value="<?php echo esc_attr($i) ?>"><?php echo esc_html($i) ?></option>
		<?php } ?>
	</select>
</p>
<p>
    <label for="<?php echo esc_attr($widget->get_field_id('number_latest_posts')); ?>"><?php esc_html_e('Number of Latest posts to display', 'diplomat') ?>:</label>
	<select id="<?php echo esc_attr($widget->get_field_id('number_latest_posts')); ?>" name="<?php echo esc_attr($widget->get_field_name('number_latest_posts')); ?>" class="widefat">
		<?php
		for ($i=1; $i<=10; $i++){ ?>
			<option <?php echo($i == $instance['number_latest_posts'] ? "selected" : "") ?> value="<?php echo esc_attr($i) ?>"><?php echo esc_html($i) ?></option>
		<?php } ?>
	</select>
</p>
<p>
    <label for="<?php echo esc_attr($widget->get_field_id('number_comments_posts')); ?>"><?php esc_html_e('Number of Comments to display', 'diplomat') ?>:</label>
	<select id="<?php echo esc_attr($widget->get_field_id('number_comments_posts')); ?>" name="<?php echo esc_attr($widget->get_field_name('number_comments_posts')); ?>" class="widefat">
		<?php
		for ($i=1; $i<=10; $i++){ ?>
			<option <?php echo($i == $instance['number_comments_posts'] ? "selected" : "") ?> value="<?php echo esc_attr($i) ?>"><?php echo esc_html($i) ?></option>
		<?php } ?>
	</select>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_thumbnail'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo esc_attr($widget->get_field_id('show_thumbnail')); ?>" name="<?php echo esc_attr($widget->get_field_name('show_thumbnail')); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo esc_attr($widget->get_field_id('show_thumbnail')); ?>"><?php esc_html_e('Display Thumbnail', 'diplomat') ?></label>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_exerpt'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo esc_attr($widget->get_field_id('show_exerpt')); ?>" name="<?php echo esc_attr($widget->get_field_name('show_exerpt')); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo esc_attr($widget->get_field_id('show_exerpt')); ?>"><?php esc_html_e('Display Excerpt', 'diplomat') ?></label>
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('title_excerpt')); ?>"><?php esc_html_e('Truncate article title', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title_excerpt')); ?>" name="<?php echo esc_attr($widget->get_field_name('title_excerpt')); ?>" value="<?php echo esc_attr($instance['title_excerpt']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('exerpt_symbols_count')); ?>"><?php esc_html_e('Truncate article excerpt', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('exerpt_symbols_count')); ?>" name="<?php echo esc_attr($widget->get_field_name('exerpt_symbols_count')); ?>" value="<?php echo esc_attr($instance['exerpt_symbols_count']); ?>" />
</p>



<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo esc_attr($widget->get_field_id('title')); ?>"><?php esc_html_e('Title', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('postcount')); ?>"><?php esc_html_e('Number of tweets', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr(@$widget->get_field_id('postcount')); ?>" name="<?php echo esc_attr(@$widget->get_field_name('postcount')); ?>" value="<?php echo esc_attr(@$instance['postcount']); ?>" />
</p>


<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo esc_attr($widget->get_field_id('title')); ?>"><?php esc_html_e('Title', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('address')); ?>"><?php esc_html_e('Address', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('address')); ?>" name="<?php echo esc_attr($widget->get_field_name('address')); ?>" value="<?php echo esc_attr($instance['address']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('phone')); ?>"><?php esc_html_e('Phone', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('phone')); ?>" name="<?php echo esc_attr($widget->get_field_name('phone')); ?>" value="<?php echo esc_attr($instance['phone']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('email')); ?>"><?php esc_html_e('Email', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('email')); ?>" name="<?php echo esc_attr($widget->get_field_name('email')); ?>" value="<?php echo esc_attr($instance['email']); ?>" />
</p>



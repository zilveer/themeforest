<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$type = array(
    'mode1' => __('Show selected testimonial', 'diplomat'),
    'mode2' => __('Show all testimonials', 'diplomat'),
);

$tt = get_posts(array('numberposts' => -1, 'post_type' => TMM_Testimonial::$slug));
$testimonials = array();
if (!empty($tt)) {
    foreach ($tt as $value) {
        $testimonials[$value->ID] = $value->post_title . ". " . substr(strip_tags($value->post_content), 0, 90) . " ...";
    }
}

$orders = array(
    'ASC' => __('ASC', 'diplomat'),
    'DESC' => __('DESC', 'diplomat')
);

$ordersby = array(
    'none' => __('None', 'diplomat'),
    'ID' => __('ID', 'diplomat'),
    'author' => __('Author', 'diplomat'),
    'title' => __('Title', 'diplomat'),
    'name' => __('Name', 'diplomat'),
    'date' => __('Date', 'diplomat'),
    'modified' => __('Modified', 'diplomat'),
    'rand' => __('Rand', 'diplomat')
);

?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php esc_html_e('Title', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('show')); ?>"><?php esc_html_e('Show', 'diplomat') ?>:</label>

    <select id="<?php echo esc_attr($widget->get_field_id('show')); ?>" name="<?php echo esc_attr($widget->get_field_name('show')); ?>" class="widefat show_mode">
        <?php
        foreach ($type as $key => $mode){ ?>
            <option <?php echo($key == $instance['show'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($mode) ?></option>
        <?php } ?>
    </select>

</p>

<div class="selected_option">

    <p>
        <label for="<?php echo esc_attr($widget->get_field_id('content')); ?>"><?php esc_html_e('Testimonials', 'diplomat') ?>:</label>

        <select id="<?php echo esc_attr($widget->get_field_id('content')); ?>" name="<?php echo esc_attr($widget->get_field_name('content')); ?>" class="widefat">
            <?php
            foreach ($testimonials as $key => $testimonial){ ?>
                <option <?php echo($key == $instance['content'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($testimonial) ?></option>
            <?php } ?>
        </select>

    </p>

</div>

<div class="all_option">
    <p>
        <label for="<?php echo esc_attr($widget->get_field_id('count')); ?>"><?php esc_html_e('Count', 'diplomat') ?>:</label>

        <select id="<?php echo esc_attr($widget->get_field_id('count')); ?>" name="<?php echo esc_attr($widget->get_field_name('count')); ?>" class="widefat">
            <?php $key = '-1'; ?>
            <option <?php echo($key == $instance['count'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html_e('All', 'diplomat') ?></option>
            <?php
            for ($i=1; $i<=10; $i++){ ?>
                <option <?php echo($i == $instance['count'] ? "selected" : "") ?> value="<?php echo esc_attr($i) ?>"><?php echo esc_html($i) ?></option>
            <?php }
            ?>
        </select>

    </p>

    <p>
        <label for="<?php echo esc_attr($widget->get_field_id('order')); ?>"><?php esc_html_e('Order', 'diplomat') ?>:</label>

        <select id="<?php echo esc_attr($widget->get_field_id('order')); ?>" name="<?php echo esc_attr($widget->get_field_name('order')); ?>" class="widefat">
            <?php
            foreach ($orders as $key => $order){ ?>
                <option <?php echo($key == $instance['order'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($order) ?></option>
            <?php } ?>
        </select>

    </p>

    <p>
        <label for="<?php echo esc_attr($widget->get_field_id('orderby')); ?>"><?php esc_html_e('Order by', 'diplomat') ?>:</label>

        <select id="<?php echo esc_attr($widget->get_field_id('orderby')); ?>" name="<?php echo esc_attr($widget->get_field_name('orderby')); ?>" class="widefat">
            <?php
            foreach ($ordersby as $key => $orderby){ ?>
                <option <?php echo($key == $instance['orderby'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($orderby) ?></option>
            <?php } ?>
        </select>

    </p>
</div>
<p>
    <?php
    $checked = "";
    if ($instance['show_photo'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo esc_attr($widget->get_field_id('show_photo')); ?>" name="<?php echo esc_attr($widget->get_field_name('show_photo')); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo esc_attr($widget->get_field_id('show_photo')); ?>"><?php esc_html_e('Show / Hide Photo', 'diplomat') ?></label>
</p>
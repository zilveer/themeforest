<?php
/**
 * Plugin Name: Peekaboo Ad Widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/

add_action('widgets_init', 'pkb_widget_ad');

function pkb_widget_ad()
{
    register_widget('pkb_widget_ad');
}

class pkb_widget_ad extends WP_Widget
{

    function pkb_widget_ad()
    {

        $widget_ops = array(
            'classname' => 'pkb_widget_ad',
            'description' => __('A widget to display ad or image', 'peekaboo')
        );

        parent::__construct('pkb_widget_ad', __('Peekaboo Ad', 'peekaboo'), $widget_ops);

    }

//	Outputs the options form on admin

    function form($instance)
    {

        $defaults = array(
            'title' => '',
            'img_src' => '',
            'link' => '',
        );

        $instance = wp_parse_args((array)$instance, $defaults); ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"
                   type="text"/>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('img_src'); ?>"><?php _e('Image source URL:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_src'); ?>"
                   name="<?php echo $this->get_field_name('img_src'); ?>" value="<?php echo $instance['img_src']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Page URL:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>"
                   name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $instance['link']; ?>"
                   type="text"/>
        </p>

    <?php
    }


//	Processes widget options to be saved

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['img_src'] = $new_instance['img_src'];
        $instance['link'] = $new_instance['link'];

        return $instance;
    }

//	Outputs the content of the widget

    function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $img_src = $instance['img_src'];
        $link = $instance['link'];

        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        if ($link)
            echo '<a href="' . $link . '"><img class="shadow-light" src="' . $img_src . '" /></a>';
        elseif ($img_src)
            echo '<img class="shadow-light" src="' . $img_src . '" />';
        echo $after_widget;
    }

}

?>
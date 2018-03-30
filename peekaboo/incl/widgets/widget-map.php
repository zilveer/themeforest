<?php

/**
 * Plugin Name: Peekaboo Map Widget
 * Version: 1.1
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action('widgets_init', 'pkb_widget_map');

function pkb_widget_map()
{
    register_widget('pkb_widget_map');
}

class pkb_widget_map extends WP_Widget
{

    function pkb_widget_map()
    {

        $widget_ops = array(
            'classname'   => 'pkb_widget_map',
            'description' => __('Display map', 'peekaboo')
        );

        parent::__construct('pkb_widget_map', __('Peekaboo map', 'peekaboo'), $widget_ops);

    }


    //  Outputs the options form on admin

    function form($instance)
    {

        $defaults = array(
            'title'    => 'Directions',
            'subtitle' => 'to our centers',
            'address'  => '',
            'code'     => '',
        );

        $instance = wp_parse_args((array)$instance, $defaults); ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"
                   type="text"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('code'); ?>"><?php _e(
                    'Google Map embed code (without iframe):',
                    'peekaboo'
                ) ?></label>
            <textarea style="height:150px;" class="widefat" id="<?php echo $this->get_field_id('code'); ?>"
                      name="<?php echo $this->get_field_name('code'); ?>"><?php echo stripslashes(
                    htmlspecialchars(($instance['code']), ENT_QUOTES)
                ); ?></textarea>
        </p>

    <?php
    }

    //  Processes widget options to be saved

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title']    = strip_tags($new_instance['title']);
        $instance['subtitle'] = strip_tags($new_instance['subtitle']);
        $instance['code']     = stripslashes($new_instance['code']);
        return $instance;
    }

    //  Outputs the content of the widget

    function widget($args, $instance)
    {
        extract($args);

        $title = $instance['title'];
        $code  = $instance['code'];

        echo $before_widget;
        echo '<div class="directions">';
        echo '<h3 class="replace">';
		echo '<a class="direction pkb-modal" data-type="iframe" href="'.  $code.'&amp;output=embed">'. $title .'</a>';
        echo '</h3></div>';
        echo $after_widget;
    }

}

?>
<?php

/**
 * Plugin Name: Peekaboo Map Widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action('widgets_init', 'pkb_widget_download');

function pkb_widget_download()
{
    register_widget('pkb_widget_download');
}

class pkb_widget_download extends WP_Widget
{

    function pkb_widget_download()
    {

        $widget_ops = array(
            'classname' => 'pkb_widget_download',
            'description' => __('Display download link', 'peekaboo')
        );

        parent::__construct('pkb_widget_download', __('Peekaboo Download', 'peekaboo'), $widget_ops);

    }


//	Outputs the options form on admin

    function form($instance)
    {

        $defaults = array(
            'title' => 'Download',
            'subtitle' => 'our PDF brochure',
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
            <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>"
                   name="<?php echo $this->get_field_name('subtitle'); ?>" value="<?php echo $instance['subtitle']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('URL:', 'peekaboo') ?></label>
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
        $instance['subtitle'] = strip_tags($new_instance['subtitle']);
        $instance['link'] = stripslashes($new_instance['link']);

        return $instance;
    }

//	Outputs the content of the widget

    function widget($args, $instance)
    {
        extract($args);

        $title = $instance['title'];
        $subtitle = $instance['subtitle'];
        $link = $instance['link'];

        echo $before_widget;
        echo '<div class="download">';
        if ($subtitle)
            echo '<h3 class="replace"><a href="' . $link . '">' . $title . '<br/>
		<span>' . $subtitle . '</span> </a></h3>';
        else
            echo '<h3 class="replace"><a href="' . $link . '">' . $title . '</a></h3>';
        ?>
        </div>

        <?php
        echo $after_widget;
    }

}

?>
<?php

/**
 * Plugin Name: Peekaboo Single Post Widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action('widgets_init', 'pkb_widget_single_post');

function pkb_widget_single_post()
{
    register_widget('pkb_widget_single_post');
}

class pkb_widget_single_post extends WP_Widget
{

    function pkb_widget_single_post()
    {

        $widget_ops = array(
            'classname' => 'pkb_widget_single_post',
            'description' => __('Display text from any post / page', 'peekaboo')
        );

        parent::__construct('pkb_widget_single_post', __('Peekaboo Single Post', 'peekaboo'), $widget_ops);

    }


//	Outputs the options form on admin

    function form($instance)
    {

        $defaults = array(
            'title' => '',
            'id' => '',
            'type' => 'post'
        );

        $instance = wp_parse_args((array)$instance, $defaults); ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"
                   type="text"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type of content:', 'peekaboo') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('type'); ?>"
                    name="<?php echo $this->get_field_name('type'); ?>">
                <option <?php if ('p' == $instance['type']) echo 'selected="selected"'; ?>>Post</option>
                <option <?php if ('page_id' == $instance['type']) echo 'selected="selected"'; ?>>Page</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('ID:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>"
                   name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $instance['id']; ?>"
                   type="text"/>
        </p>

    <?php
    }


//	Processes widget options to be saved

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['id'] = strip_tags($new_instance['id']);
        $instance['type'] = strip_tags($new_instance['type']);

        return $instance;
    }

//	Outputs the content of the widget

    function widget($args, $instance)
    {
        extract($args);

        $title = $instance['title'];
        $id = $instance['id'];
        $type = $instance['type'];

        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        ?>

        <div class="pkb-post-list">
            <ul>
                <?php
                $query = new WP_Query();
                if ($type == 'Post')
                    $query->query('p=' . $id . '&posts_per_page=1');
                if ($type == 'Page')
                    $query->query('page_id=' . $id . '&posts_per_page=1');
                ?>
                <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <li>
                        <div class="clearfix">
                            <h5 class="replace"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <?php the_excerpt() ?>
                        </div>
                    </li>
                <?php endwhile; endif; ?>
                <?php wp_reset_query(); ?>
            </ul>
        </div>
        <?php
        echo $after_widget;
    }

}

?>
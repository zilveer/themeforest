<?php

/**
 * Plugin Name: Peekaboo Testimonial Widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action('widgets_init', 'pkb_widget_testimonial');

function pkb_widget_testimonial()
{
    register_widget('pkb_widget_testimonial');
}

class pkb_widget_testimonial extends WP_Widget
{

    function pkb_widget_testimonial()
    {

        $widget_ops = array(
            'classname' => 'pkb_widget_testimonial',
            'description' => __('Display testimonials posts', 'peekaboo')
        );

        parent::__construct('pkb_widget_testimonial', __('Peekaboo Testimonial', 'peekaboo'), $widget_ops);

    }


//	Outputs the options form on admin

    function form($instance)
    {

        $defaults = array(
            'title' => 'What they say',
            'count' => 1,
            'url' => ''
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
                for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of testimonials:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>"
                   name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>"
                   name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $instance['url']; ?>"
                   type="text"/>
        </p>

    <?php
    }


//	Processes widget options to be saved

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = strip_tags($new_instance['count']);
        $instance['url'] = stripslashes($new_instance['url']);


        return $instance;
    }

//	Outputs the content of the widget

    function widget($args, $instance)
    {
        extract($args);

        $title = $instance['title'];
        $count = $instance['count'];
        $url = $instance['url'];

        echo $before_widget;
        echo '<div class="testimonials-container">';
        if ($title)
            echo '<h3 class="replace"><a href="' . $url . '">' . $title . '</a></h3>';
        ?>
        <?php
        $query = new WP_Query();
        $query->query('post_type=testimonial&orderby=rand&posts_per_page=' . $count);
        ?>
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
        <div class="testimonials-content">
            <?php the_content(); ?>
            <span class="testimonial-name"><em>
                    <?php echo get_post_meta(get_the_ID(), 'pkb_author_name', true); ?></em></span>
        </div>
    <?php endwhile; endif; ?>
        </div>

        <?php
        echo $after_widget;
    }

}

?>
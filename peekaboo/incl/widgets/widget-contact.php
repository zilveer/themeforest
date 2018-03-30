<?php
/**
 * Plugin Name: Peekaboo Contact Widget
 * Version: 1.1
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action('widgets_init', 'pkb_widget_contact');

function pkb_widget_contact()
{
    register_widget('pkb_widget_contact');
}

class pkb_widget_contact extends WP_Widget
{

    function pkb_widget_contact()
    {

        $widget_ops = array(
            'classname'   => 'pkb_widget_contact',
            'description' => __('Display contact info with map', 'peekaboo')
        );

        parent::__construct('pkb_widget_contact', __('Peekaboo Contact', 'peekaboo'), $widget_ops);

    }


    //  Outputs the options form on admin

    function form($instance)
    {

        $defaults = array(
            'title'     => 'Contact',
            'content'   => '',
            'code'      => '',
            'map_id'    => '',
            'map_title' => 'Map It!'
        );

        $instance = wp_parse_args((array)$instance, $defaults); ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Contact info:', 'peekaboo') ?></label>
            <textarea style="height:120px;" class="widefat" id="<?php echo $this->get_field_id('content'); ?>"
                      name="<?php echo $this->get_field_name('content'); ?>"><?php echo stripslashes(
                    htmlspecialchars(($instance['content']), ENT_QUOTES)
                ); ?></textarea>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('code'); ?>"><?php _e(
                    'Google Map embed code (without iframe):',
                    'peekaboo'
                ) ?></label>
            <textarea style="height:80px;" class="widefat" id="<?php echo $this->get_field_id('code'); ?>"
                      name="<?php echo $this->get_field_name('code'); ?>"><?php echo stripslashes(
                    htmlspecialchars(($instance['code']), ENT_QUOTES)
                ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('map_title'); ?>"><?php _e('Map title:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('map_title'); ?>"
                   name="<?php echo $this->get_field_name('map_title'); ?>"
                   value="<?php echo $instance['map_title']; ?>" type="text"/>
        </p>

    <?php
    }


    //  Processes widget options to be saved

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title']     = strip_tags($new_instance['title']);
        $instance['content']   = stripslashes($new_instance['content']);
        $instance['code']      = stripslashes($new_instance['code']);
        $instance['map_title'] = stripslashes($new_instance['map_title']);

        return $instance;
    }

    //  Outputs the content of the widget

    function widget($args, $instance)
    {
        extract($args);

        $title     = $instance['title'];
        $content   = $instance['content'];
        $code      = $instance['code'];
        $map_title = $instance['map_title'];

        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        if ($content) {
            echo '<address>' . $content . '</address>';
        }
        if ($code) {
			echo	'<a class="modalmap pkb-modal" data-type="iframe" href="'.  $code.'&amp;output=embed">'. $map_title .'</a>';
        }
        ?>

        <?php
        echo $after_widget;
    }

}

?>
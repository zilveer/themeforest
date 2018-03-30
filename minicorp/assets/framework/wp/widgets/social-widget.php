<?php
/*
 * Plugin Name: Social icons
 * Plugin URI: http://www.ishyoboy.com
 * Description: A widget which displays social links
 * Version: 1.0
 * Author: IshYoBoy
 * Author URI: http://www.ishyoboy.com
 */
class Ishyoboy_Social_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 'description' => __( 'A widget which displays your social icons as set in the theme\'s options page', 'ishyoboy' ) );
        $control_ops = array( 'width' => 500, 'height' => 350 );
        parent::__construct( 'ishyoboy-social-widget', 'Ishyo Social widget', $widget_ops, $control_ops );

    }



    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget;

        ?>
        <!-- <div class="col6 social-icons-widget"> -->

        <?php
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }
        ?>

        <?php

        if (!isset($instance['socialicons'])){
            $instance['socialicons'] = '';
        }

        $social_icons = $instance['socialicons'];
        echo '<ul class="social">';

        $social_icons = explode("\n", $social_icons);

        foreach ($social_icons as $icon){
            echo '<li>' . do_shortcode($icon) . '</li>';
        }
        echo '</ul>';
        ?>
        <!-- </div>-->

        <?php

        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['socialicons'] = strip_tags( $new_instance['socialicons'] );

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        $username = 'ishyoboydotcom';

        // Default widget settings.
        $defaults = array(
            'title' => __('Social networks:', 'ishyoboy')
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <?php

            if (!isset($instance['socialicons'])){
                $instance['socialicons'] =
'[social icon="icon-mail" url="mailto:example@example.com" tooltip="Email us"]
[social icon="icon-twitter" url="http://www.twitter.com" tooltip="Twitter - Username"]
[social icon="icon-facebook" url="http://www.facebook.com" tooltip="Facebook - Username"]';
            }



            ?>

            <label for="<?php echo $this->get_field_id( 'socialicons' ); ?>"><?php _e('Social icons e.g. Use [social icon="" url=""]', 'ishyoboy') ?></label>
            <textarea class="widefat" rows="8" id="<?php echo $this->get_field_id( 'socialicons' ); ?>" name="<?php echo $this->get_field_name( 'socialicons' ); ?>" ><?php echo $instance['socialicons']; ?></textarea>
        </p>

        <p>
            <?php
            _e("Important: Enter each [social] shortcode in a separate line!.", 'ishyoboy');
            ?>
        </p>

    <?php
    }

}

add_action( 'widgets_init', create_function( '', 'register_widget( "Ishyoboy_Social_Widget" );' ) );
// register Twitter_Widget
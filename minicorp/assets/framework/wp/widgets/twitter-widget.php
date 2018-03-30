<?php
/*
 * Plugin Name: Latest Tweets
 * Plugin URI: http://www.ishyoboy.com
 * Description: A widget that displays your latest tweets
 * Version: 1.0
 * Author: IshYoBoy
 * Author URI: http://www.ishyoboy.com
 */
class Ishyoboy_Twitter_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'ishyoboy-twitter-widget', // Base ID
            'Ishyo Twitter widget', // Name
            array(
                'description' => __( 'A widget that displays your latest tweets', 'ishyoboy' ),
            )
        );
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

        wp_enqueue_script( 'twitter' );

        echo $before_widget;

        $ishyoboy_twitter_username = $instance['username'];
        $ishyoboy_twitter_postcount = $instance['postcount'];
        $twitter_text = $instance['tweettext'];
        ?>
            <?php
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }

            /*$opts = Array(
                'trim_user' => true,
                'exclude_replies' => true,
                'include_rts' => true);
            echo ishyoboy_get_tweets($ishyoboy_twitter_postcount, $ishyoboy_twitter_username, $opts);*/

            ?>

            <div class="tweets-<?php echo $ishyoboy_twitter_postcount; ?>" <?php echo ('' != $ishyoboy_twitter_username) ? 'data-username="' . esc_attr($ishyoboy_twitter_username) .'"' : '' ; ?> ></div>

            <?php if( !empty($twitter_text) ) { ?>
                <a class="btn-small" href="https://twitter.com/<?php echo $ishyoboy_twitter_username ?>"><?php echo $twitter_text; ?></a>
            <?php } ?>

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
        $instance['username'] = strip_tags( $new_instance['username'] );
        $instance['postcount'] = strip_tags( $new_instance['postcount'] );
        $instance['tweettext'] = strip_tags( $new_instance['tweettext'] );

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
            'title' => __( 'Latest Tweets', 'ishyoboy' ),
            'username' => $username,
            'postcount' => '3',
            'tweettext' => __( 'Follow us on Twitter', 'ishyoboy' ),
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username e.g. ishyoboydotcom', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (max 9)', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Button Text e.g. Follow us on Twitter', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
        </p>

        <p>
            <?php echo '<span style="color: #FF0000;"><strong>' . __( 'IMPORTANT:', 'ishyoboy' ) . '</strong></span><br>' . sprintf( __( 'Please make sure the access tokens and keys are saved in "Misc Options" in %1$s', 'ishyoboy' ), '<a href="themes.php?page=optionsframework" target="_blank">' . __( 'Theme Options', 'ishyoboy' ) . '</a>'); ?>
        </p>

        <?php
    }

}

require_once( locate_template( 'assets/framework/wp/includes/StormTwitter.class.php' ) );

// register Twitter_Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Ishyoboy_Twitter_Widget" );' ) );

add_action( 'wp_ajax_ishyoboy_get_tweets', 'ishyoboy_get_unparsed_tweets' );
add_action( 'wp_ajax_nopriv_ishyoboy_get_tweets', 'ishyoboy_get_unparsed_tweets' );
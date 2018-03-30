<?php
/*
 * Plugin Name: Latest Tweets
 * Plugin URI: http://www.ishyoboy.com
 * Description: A widget that displays your latest tweets
 * Version: 1.0
 * Author: IshYoBoy
 * Author URI: http://www.ishyoboy.com
 */
class Ishyoboy_Flickr_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'ishyoboy-flickr-widget', // Base ID
            'Ishyo Flickr images', // Name
            array(
                'description' => __( 'A widget that displays your latest flickr images.', 'ishyoboy' ),
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

        echo str_replace( 'class="', 'class="icon-flickr ', $before_widget);

        $flickr_userid = $instance['userid'];
        $flickr_username = $instance['username'];
        $flickr_postcount = $instance['postcount'];
        $flickr_text = $instance['buttontext'];
        ?>
            <?php
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }
            ?>

            <!-- Start of Flickr Badge -->
            <div id="flickr_badge_uber_wrapper">
                <div id="flickr_badge_wrapper" class="clearfix">
                    <!-- http://idgettr.com/ -->
                    <?php if( !empty($flickr_userid) ) { ?>
                        <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickr_postcount; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_userid; ?>"></script>
                    <?php } else { ?>
                        <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickr_postcount; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=all"></script>
                    <?php } ?>

                </div>
            </div>
            <!-- End of Flickr Badge -->

            <?php if( !empty($flickr_text) ) { ?>
                <?php if( !empty($flickr_username) ) { ?>
                    <a class="btn-small" href="http://www.flickr.com/photos/<?php echo $flickr_username ?>/"><?php echo $flickr_text; ?></a>
                <?php } else { ?>
                    <a class="btn-small" href="http://www.flickr.com/photos/"><?php echo $flickr_text; ?></a>
                <?php } ?>
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
        $instance['userid'] = strip_tags( $new_instance['userid'] );
        $instance['username'] = strip_tags( $new_instance['username'] );
        $instance['postcount'] = strip_tags( $new_instance['postcount'] );
        $instance['buttontext'] = strip_tags( $new_instance['buttontext'] );

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

        $username = 'ishyoboy';

        // Default widget settings.
        $defaults = array(
            'title' => __( 'Latest Flicks', 'ishyoboy' ),
            'username' => $username,
            'userid' => '88944596@N08',
            'postcount' => '9',
            'buttontext' => __( 'Follow us on Flickr', 'ishyoboy' ),
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Flickr Username e.g. ishyoboy', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'userid' ); ?>"><?php _e('Flickr ID e.g. 88944596@N08', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'userid' ); ?>" name="<?php echo $this->get_field_name( 'userid' ); ?>" value="<?php echo $instance['userid']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of images (max 9)', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'buttontext' ); ?>"><?php _e('Button Text e.g. Follow us on Flickr', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" value="<?php echo $instance['buttontext']; ?>" />
        </p>

        <?php
    }

}

// register Twitter_Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Ishyoboy_Flickr_Widget" );' ) );
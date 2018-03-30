<?php
/**
 * Your Inspiration Themes
 *
 * @package    WordPress
 * @subpackage Your Inspiration Themes
 * @author     Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! class_exists( 'teaser' ) ) :
    class teaser extends WP_Widget {
        function __construct() {
            $widget_ops = array(
                'classname'   => 'teaser',
                'description' => __( 'An image with a text linkable', 'yit' )
            );

            $control_ops = array( 'id_base' => 'teaser', 'width' => 430 );

            WP_Widget::__construct( 'teaser', __( 'Teaser', 'yit' ), $widget_ops, $control_ops );
        }

        function form( $instance ) {
            global $icons_name;

            /* Impostazioni di default del widget */
            $defaults = array(
                'title'           => '',
                'slogan'          => '',
                'subslogan'       => '',
                'slogan_position' => '',
                'image'           => '',
                'link'            => '',
                'button'          => ''
            );

            $instance = wp_parse_args( (array) $instance, $defaults ); ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ) ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'slogan' ); ?>"><?php _e( 'Slogan', 'yit' ) ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'slogan' ); ?>" name="<?php echo $this->get_field_name( 'slogan' ); ?>" value="<?php echo $instance['slogan']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'subslogan' ); ?>"><?php _e( 'Subslogan', 'yit' ) ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'subslogan' ); ?>" name="<?php echo $this->get_field_name( 'subslogan' ); ?>" value="<?php echo $instance['subslogan']; ?>" />
            </p>


            <p>
                <label for="<?php echo $this->get_field_id( 'slogan_position' ); ?>"><?php _e( 'Slogan Position', 'yit' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'slogan_position' ); ?>" name="<?php echo $this->get_field_name( 'slogan_position' ); ?>">
                    <option value="top" <?php selected( $instance['slogan_position'], 'top' ) ?>><?php _e( 'Top', 'yit' ) ?></option>
                    <option value="center" <?php selected( $instance['slogan_position'], 'center' ) ?>><?php _e( 'Center', 'yit' ) ?></option>
                    <option value="bottom" <?php selected( $instance['slogan_position'], 'bottom' ) ?>><?php _e( 'Bottom', 'yit' ) ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'button' ); ?>"><?php _e( 'Label Button', 'yit' ) ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" value="<?php echo $instance['button']; ?>" />
            </p>


            <p>
                <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image', 'yit' ) ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
                <input type="button" value="Upload" id="<?php echo $this->get_field_id( 'image' ); ?>-button" class="upload_button button" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link', 'yit' ) ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
            </p>
        <?php
        }

        function widget( $args, $instance ) {
            extract( $args );

            $title = apply_filters( 'widget_title', $instance['title'] );

            if ( strpos( $before_widget, 'widget-wrap' ) === false ) {
                $before_widget .= '<div class="widget-wrap">';
                $after_widget .= '</div>';
            }

            echo $before_widget;

            if ( isset( $title ) && $title != '' ) {
                echo $before_title . $title . $after_title;
            }

            echo do_shortcode( '[teaser title="' . $instance['slogan'] . '" subtitle="' . $instance['subslogan'] . '" image="' . $instance['image'] . '" link="' . $instance['link'] . '" button="'.$instance['button'].'" slogan_position="' . $instance['slogan_position'] . '" ]' );

            echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title'] = strip_tags( $new_instance['title'] );

            $instance['slogan'] = strip_tags( $new_instance['slogan'] );

            $instance['subslogan'] = strip_tags( $new_instance['subslogan'] );

            $instance['slogan_position'] = strip_tags( $new_instance['slogan_position'] );

            $instance['image'] = $new_instance['image'];

            $instance['link'] = esc_url( $new_instance['link'] );

            $instance['button'] =$new_instance['button'];

            return $instance;
        }

    }
endif;
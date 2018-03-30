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

if ( ! class_exists( 'YIT_Text_Image' ) ) :
    class YIT_Text_Image extends WP_Widget {
        function __construct() {
            $widget_ops = array(
                'classname'   => 'yit_text_image',
                'description' => __( 'Arbitrary text or HTML, with a simple image.', 'yit' )
            );

            $control_ops = array( 'id_base' => 'yit_text_image', 'width' => 430 );

            WP_Widget::__construct( 'yit_text_image', __( 'YIT Text With Image', 'yit' ), $widget_ops, $control_ops );

        }

        function form( $instance ) {
            global $icons_name;

            /* Impostazioni di default del widget */
            $defaults = array(
                'title' => '',
                'icon' => '',
                'image' => '',
                'align' => '',
                'link' => '',
                'text'  => '',
                'autop' => false
            );

            $icons = YIT_Plugin_Common::get_awesome_icons();


            $instance = wp_parse_args( (array) $instance, $defaults ); ?>

            <p>
                <label for="<?php $this->get_field_id( 'title' ) ?>"><?php _e( 'Title', 'yit' ) ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'icon' ) ?>"><?php _e( 'Icon', 'yit' ) ?></label>
                <select style="font-family: 'FontAwesome';" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>">
                    <?php foreach( $icons as $key => $icon ): ?>
                        <option value="<?php echo $icon ?>"<?php selected( $instance['icon'], $icon ); ?>><?php echo '&#x' . $key . '; ' . $icon ?></option>
                    <?php endforeach; ?>
                </select>
                <span><?php _e( 'If you set an image this field is invalid', 'yit' )?></span>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'image' ) ?>"><?php _e( 'Image', 'yit' ) ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
                <input type="button" value="Upload" id="<?php echo $this->get_field_id( 'image' ); ?>-button" class="upload_button button" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'align' ) ?>"><?php _e( 'Image Alignment', 'yit' ) ?></label>
                <select id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>">
                    <option value="left"<?php selected( $instance['align'], 'left' ); ?>>Left</option>
                    <option value="center"<?php selected( $instance['align'], 'center' ); ?>>Center</option>
                    <option value="right"<?php selected( $instance['align'], 'right' ); ?>>Right</option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link Image', 'yit' ) ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text ( you can use html )', 'yit' ); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="20" rows="16"><?php echo $instance['text']; ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'autop' ); ?>"><?php _e( 'Automatically add paragraphs', 'yit' ) ?></label>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'autop' ); ?>" name="<?php echo $this->get_field_name( 'autop' ); ?>" value="1"<?php if ( $instance['autop'] ) { echo 'checked="checked"'; } ?> />
            </p>

        <?php
        }

        function widget( $args, $instance ) {
            extract( $args );

            $title = apply_filters( 'widget_title', $instance['title'] );

            if ( strpos( $before_widget, 'widget-wrap' ) === false ) {
                if ( $title != '' ){
                    $before_widget .= '<div class="clearfix widget-wrap">';
                }
                else{
                    $before_widget .= '<div class="clearfix widget-wrap" style="margin-bottom: 20px;">';
                }
                $after_widget .= '</div>';
            }

            echo $before_widget;

            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            echo '<div>';

            if ( $instance['autop'] )
            {
                $instance['text'] = wpautop( apply_filters( 'widget_text', $instance['text'] ) );
            }

            $text = '<div class="clearfix widget_image ' . $instance['align'] . '">';

            if( isset( $instance[ 'link' ] ) && $instance['link'] != '' ) {
                $text .= '<a href ="' . $instance['link'] . '">';
            }

            if ( isset( $instance['icon'] ) && ( $instance['image'] == '' || ! isset( $instance['image'] ) ) ) {
                $text .= '<i class="fa fa-' . $instance['icon'] . '" ></i>';
            }
            elseif ( isset( $instance['image'] ) && $instance['image'] != '' ) {

                $text .= yit_image( "echo=no&src=". $instance['image'] ."&getimagesize=1&alt=" . $instance['title'] );
            }
            if( isset( $instance[ 'link' ] ) && $instance['link'] != '' ) {
                $text .= '</a>';
            }

            yit_wpml_register_string( 'Widgets', 'widget_text_yit_text_image' . sanitize_title( $instance['text'] ), $instance['text'] );
            $localized_text = yit_wpml_string_translate( 'Widgets', 'widget_text_yit_text_image' . sanitize_title( $instance['text'] ), $instance['text'] );

            $text .= '</div><div class="widget_text left">' . $localized_text;

            echo do_shortcode( $text );

            echo '</div></div>';

            echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title'] = strip_tags( $new_instance['title'] );

            $instance['icon'] = $new_instance['icon'];

            $instance['image'] = $new_instance['image'];

            $instance['align'] = $new_instance['align'];

            $instance['link'] = $new_instance['link'];

            $instance['text'] = $new_instance['text'];

            $instance['autop'] = $new_instance['autop'];

            return $instance;
        }

    }
endif;
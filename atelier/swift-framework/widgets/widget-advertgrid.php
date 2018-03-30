<?php

    /*
    *
    *	Custom Advert Grid Widget
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    class sf_advert_grid_widget extends WP_Widget {

        function __construct() {
            $widget_ops  = array(
                'classname'   => 'widget-advert-grid',
                'description' => 'Styled advert grid of up to eight 125x125 adverts'
            );
            $control_ops = array( 'width'   => 250,
                                  'height'  => 200,
                                  'id_base' => 'advert-grid-widget'
            ); //default width = 250
            parent::__construct( 'advert-grid-widget', 'Swift Framework Advert Grid Widget', $widget_ops, $control_ops );
        }

        function form( $instance ) {
            $defaults = array( 'title'       => '',
                               'image_1'     => '',
                               'image_1_url' => '',
                               'image_2'     => '',
                               'image_2_url' => '',
                               'image_3'     => '',
                               'image_3_url' => '',
                               'image_4'     => '',
                               'image_4_url' => '',
                               'image_5'     => '',
                               'image_5_url' => '',
                               'image_6'     => '',
                               'image_6_url' => '',
                               'image_7'     => '',
                               'image_7_url' => '',
                               'image_8'     => '',
                               'image_8_url' => ''
            );
            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>

            <p>
                <label><?php _e( 'Title', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"
                       class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 1 URL', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_1' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_1' )); ?>"
                       value="<?php echo esc_url($instance['image_1']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 1 Link', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_1_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_1_url' )); ?>"
                       value="<?php echo esc_url($instance['image_1_url']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 2 URL', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_2' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_2' )); ?>"
                       value="<?php echo esc_url($instance['image_2']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 2 Link', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_2_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_2_url' )); ?>"
                       value="<?php echo esc_url($instance['image_2_url']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 3 URL', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_3' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_3' )); ?>"
                       value="<?php echo esc_url($instance['image_3']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 3 Link', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_3_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_3_url' )); ?>"
                       value="<?php echo esc_url($instance['image_3_url']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 4 URL', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_4' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_4' )); ?>"
                       value="<?php echo esc_url($instance['image_4']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 4 Link', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_4_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_4_url' )); ?>"
                       value="<?php echo esc_url($instance['image_4_url']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 5 URL', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_5' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_5' )); ?>"
                       value="<?php echo esc_url($instance['image_5']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 5 Link', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_5_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_5_url' )); ?>"
                       value="<?php echo esc_url($instance['image_5_url']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 6 URL', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_6' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_6' )); ?>"
                       value="<?php echo esc_url($instance['image_6']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 6 Link', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_6_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_6_url' )); ?>"
                       value="<?php echo esc_url($instance['image_6_url']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 7 URL', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_7' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_7' )); ?>"
                       value="<?php echo esc_url($instance['image_7']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 7 Link', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_7_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_7_url' )); ?>"
                       value="<?php echo esc_url($instance['image_7_url']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 8 URL', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_8' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_8' )); ?>"
                       value="<?php echo esc_url($instance['image_8']); ?>" class="widefat" type="text"/>
            </p>
            <p>
                <label><?php _e( 'Image 8 Link', 'swiftframework' ); ?>:</label>
                <input id="<?php echo esc_attr($this->get_field_id( 'image_8_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'image_8_url' )); ?>"
                       value="<?php echo esc_url($instance['image_8_url']); ?>" class="widefat" type="text"/>
            </p>

        <?php
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title']       = strip_tags( $new_instance['title'] );
            $instance['image_1']     = strip_tags( $new_instance['image_1'] );
            $instance['image_1_url'] = strip_tags( $new_instance['image_1_url'] );
            $instance['image_2']     = strip_tags( $new_instance['image_2'] );
            $instance['image_2_url'] = strip_tags( $new_instance['image_2_url'] );
            $instance['image_3']     = strip_tags( $new_instance['image_3'] );
            $instance['image_3_url'] = strip_tags( $new_instance['image_3_url'] );
            $instance['image_4']     = strip_tags( $new_instance['image_4'] );
            $instance['image_4_url'] = strip_tags( $new_instance['image_4_url'] );
            $instance['image_5']     = strip_tags( $new_instance['image_5'] );
            $instance['image_5_url'] = strip_tags( $new_instance['image_5_url'] );
            $instance['image_6']     = strip_tags( $new_instance['image_6'] );
            $instance['image_6_url'] = strip_tags( $new_instance['image_6_url'] );
            $instance['image_7']     = strip_tags( $new_instance['image_7'] );
            $instance['image_7_url'] = strip_tags( $new_instance['image_7_url'] );
            $instance['image_8']     = strip_tags( $new_instance['image_8'] );
            $instance['image_8_url'] = strip_tags( $new_instance['image_8_url'] );

            return $instance;
        }

        function widget( $args, $instance ) {

            extract( $args );

            $title       = apply_filters( 'widget_title', $instance['title'] );
            $image_1     = $instance['image_1'];
            $image_1_url = $instance['image_1_url'];
            $image_2     = $instance['image_2'];
            $image_2_url = $instance['image_2_url'];
            $image_3     = $instance['image_3'];
            $image_3_url = $instance['image_3_url'];
            $image_4     = $instance['image_4'];
            $image_4_url = $instance['image_4_url'];
            $image_5     = $instance['image_5'];
            $image_5_url = $instance['image_5_url'];
            $image_6     = $instance['image_6'];
            $image_6_url = $instance['image_6_url'];
            $image_7     = $instance['image_7'];
            $image_7_url = $instance['image_7_url'];
            $image_8     = $instance['image_8'];
            $image_8_url = $instance['image_8_url'];

            $output = '';

            echo $before_widget;
            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            $output .= '<div class="sidebar-ad-grid"><ul class="clearfix">';

            if ( $image_1 != "" ) {
                $output .= '<li>';
                if ( $image_1_url != "" ) {
                    $output .= '<a href="' . $image_1_url . '" target="_blank">';
                    $output .= '<img src="' . $image_1 . '" alt="advert" />';
                    $output .= '</a>';
                } else {
                    $output .= '<img src="' . $image_1 . '" alt="advert" />';
                }
                $output .= '</li>';
            }

            if ( $image_2 != "" ) {
                $output .= '<li>';
                if ( $image_2_url != "" ) {
                    $output .= '<a href="' . $image_2_url . '" target="_blank">';
                    $output .= '<img src="' . $image_2 . '" alt="advert" />';
                    $output .= '</a>';
                } else {
                    $output .= '<img src="' . $image_2 . '" alt="advert" />';
                }
                $output .= '</li>';
            }

            if ( $image_3 != "" ) {
                $output .= '<li>';
                if ( $image_3_url != "" ) {
                    $output .= '<a href="' . $image_3_url . '" target="_blank">';
                    $output .= '<img src="' . $image_3 . '" alt="advert" />';
                    $output .= '</a>';
                } else {
                    $output .= '<img src="' . $image_3 . '" alt="advert" />';
                }
                $output .= '</li>';
            }

            if ( $image_4 != "" ) {
                $output .= '<li>';
                if ( $image_4_url != "" ) {
                    $output .= '<a href="' . $image_4_url . '" target="_blank">';
                    $output .= '<img src="' . $image_4 . '" alt="advert" />';
                    $output .= '</a>';
                } else {
                    $output .= '<img src="' . $image_4 . '" alt="advert" />';
                }
                $output .= '</li>';
            }

            if ( $image_5 != "" ) {
                $output .= '<li>';
                if ( $image_5_url != "" ) {
                    $output .= '<a href="' . $image_5_url . '" target="_blank">';
                    $output .= '<img src="' . $image_5 . '" alt="advert" />';
                    $output .= '</a>';
                } else {
                    $output .= '<img src="' . $image_5 . '" alt="advert" />';
                }
                $output .= '</li>';
            }

            if ( $image_6 != "" ) {
                $output .= '<li>';
                if ( $image_6_url != "" ) {
                    $output .= '<a href="' . $image_6_url . '" target="_blank">';
                    $output .= '<img src="' . $image_6 . '" alt="advert" />';
                    $output .= '</a>';
                } else {
                    $output .= '<img src="' . $image_6 . '" alt="advert" />';
                }
                $output .= '</li>';
            }

            if ( $image_7 != "" ) {
                $output .= '<li>';
                if ( $image_7_url != "" ) {
                    $output .= '<a href="' . $image_7_url . '" target="_blank">';
                    $output .= '<img src="' . $image_7 . '" alt="advert" />';
                    $output .= '</a>';
                } else {
                    $output .= '<img src="' . $image_7 . '" alt="advert" />';
                }
                $output .= '</li>';
            }

            if ( $image_8 != "" ) {
                $output .= '<li>';
                if ( $image_8_url != "" ) {
                    $output .= '<a href="' . $image_8_url . '" target="_blank">';
                    $output .= '<img src="' . $image_8 . '" alt="advert" />';
                    $output .= '</a>';
                } else {
                    $output .= '<img src="' . $image_8 . '" alt="advert" />';
                }
                $output .= '</li>';
            }

            $output .= '</ul></div>';

            echo $output;

            echo $after_widget;

        }

    }

    add_action( 'widgets_init', 'sf_load_advert_grid_widget' );

    function sf_load_advert_grid_widget() {
        register_widget( 'sf_advert_grid_widget' );
    }

?>

<?php
/**
 * Recent Reviews Widget
 *
 * Displays recent reviews widget
 *
 * @author        YIThemes
 * @extends    WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class YIT_Widget_Recent_Reviews extends WP_Widget {

    /**
     * constructor
     *
     * @access public
     * @return void
     */
    function __construct() {

        /* Widget variable settings. */
        $this->woo_widget_idbase = 'yit_recent_reviews';

        /* Widget settings. */
        $widget_ops = array( 'classname' => 'yit_recent_reviews', 'description' => __( 'Display a list of recent reviews.', 'yit' ) );

        /* Create the widget. */
        WP_Widget::__construct( 'yit-recent_reviews', 'YIT Recent Reviews', $widget_ops );
    }

    function widget( $args, $instance ) {

        extract( $args );

        wp_enqueue_script( 'owl-carousel' );

        $title = apply_filters('widget_title', apply_filters( 'yit_recent_reviews_widget_title', empty( $instance['title'] ) ? __( 'Recent reviews', 'yit' ) : $instance['title'] ) );

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        $id = ( isset( $instance['product'] ) && ($instance['product'] != '' || $instance['product'] != 'all' ) ) ? (int) $instance['product'] : 0;

        $attribute = array(
            'number' => $instance['number'],
            'type'   => 'comment',
            'status' => 'approve',
            'orderby' => 'date',
            'order' => 'DESC',
        );
        if ( $id != 0 ) {

            $id = yit_wpml_get_translated_id( $id, 'product' );
            $attribute['post_id'] = $id;
        }
        else {
            $attribute['post_type'] = 'product';
        }

        $reviews = get_comments( $attribute );

        ?>
        <div class="reviews_container_widget">

            <ul class="slides-reviews-widget" data-slidespeed="<?php echo $instance['slidespeed'] ?>" data-autoplay="<?php echo $instance['autoplay'] ?>">
                <?php foreach ( $reviews as $review ) : ?>
                    <li class="clearfix">

                        <?php if ( $instance['show_avatar'] == 'yes' ) : ?>
                            <div class="avatar-thumb">
                                <?php echo get_avatar( $review->comment_author_email, $size = '49' ); ?>
                            </div>
                        <?php endif ?>

                        <div class="clearfix meta">
                            <div itemprop="author"><?php echo $review->comment_author; ?></div>
                            <div class="product-review-link">
                                <a href="<?php echo get_permalink( $review->ID ) ?>"><?php _e( 'on ', 'yit' ); echo $review->post_title; ?></a>
                            </div>
                            <?php if ( $instance['show_rating'] == 'yes' ) :
                                $rating = esc_attr( get_comment_meta( $review->comment_ID, 'rating', true ) ); ?>
                                <div class="reviews-rating">
                                    <span class="star-empty"><span class="star" style="width: <?php echo $rating*20 ?>%;"></span></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clear"></div>

                        <div class="review-content <?php if ( $instance['show_avatar'] == 'yes' ) : ?>arrow<?php endif ?>">
                            <p itemprop="description" class="description"><?php yit_excerpt_text( strip_tags( $review->comment_content ), $instance['excerpt_length'], '...' ) ?></p>
                        </div>

                        <div class="clear"></div>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

        <div class="clear"></div>
        <?php

        echo $after_widget;

    }

    function form( $instance ) {

        $defaults = array(
            'title'          => __( 'Recent Reviews', 'yit' ),
            'product'        => '',
            'number'         => 5,
            'show_avatar'    => 'yes',
            'show_rating'    => 'yes',
            'excerpt_length' => 12,
            'autoplay' => 'yes',
            'slidespeed' => 500
        );

        $instance = wp_parse_args( ( array ) $instance, $defaults );

        //$products = get_posts( array( 'post_type' => 'product', 'numberposts' => - 1 ) );

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'product' ); ?>"><?php _e( 'Insert Product ID', 'yit' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'product' ) ?>" name="<?php echo $this->get_field_name( 'product' ) ?>" value="<?php echo $instance['product']?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of reviews to show', 'yit' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $instance['number']; ?>" size="3" />
        </p>

        <p><label for="<?php echo $this->get_field_id( 'show_avatar' ); ?>"><?php _e( 'Show avatar', 'yit' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'show_avatar' ); ?>" name="<?php echo $this->get_field_name( 'show_avatar' ); ?>">
                <option value="yes"<?php selected( $instance['show_avatar'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                <option value="no"<?php selected( $instance['show_avatar'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
            </select>
        </p>

        <p><label for="<?php echo $this->get_field_id( 'show_rating' ); ?>"><?php _e( 'Show rating', 'yit' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'show_rating' ); ?>" name="<?php echo $this->get_field_name( 'show_rating' ); ?>">
                <option value="yes"<?php selected( $instance['show_rating'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                <option value="no"<?php selected( $instance['show_rating'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Comments text length:', 'yit' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="text" value="<?php echo $instance['excerpt_length']; ?>" size="3" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Autoplay', 'yit' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>">
                <option value="true"<?php selected( $instance['autoplay'], true ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                <option value="false"<?php selected( $instance['autoplay'], false ) ?>><?php _e( 'No', 'yit' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'slidespeed' ); ?>"><?php _e('Speed Animation', 'yit' ) ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'slidespeed' ); ?>" name="<?php echo $this->get_field_name( 'slidespeed' ); ?>" value="<?php echo $instance['slidespeed']; ?>" size="4" />
        </p>


    <?php

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['product']        = $new_instance['product'];
        $instance['number']         = absint( $new_instance['number'] );
        $instance['show_avatar']    = $new_instance['show_avatar'];
        $instance['show_rating']    = $new_instance['show_rating'];
        $instance['excerpt_length'] = absint( $new_instance['excerpt_length'] );
        $instance['autoplay'] = $new_instance['autoplay'];
        $instance['slidespeed'] = absint( $new_instance['slidespeed'] );


        return $instance;
    }
}
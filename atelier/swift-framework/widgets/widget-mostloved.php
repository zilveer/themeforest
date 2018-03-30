<?php

    /**
     * Most Loved Widget Class
     */
    class lip_most_loved_widget extends WP_Widget {

        /** constructor */
        function __construct() {
            parent::__construct( false, $name = __( 'Most Loved Items', 'swiftframework' ), array( 'description' => __( 'Show the most loved items', 'swiftframework' ) ) );
        }

        /** @see WP_Widget::widget */
        function widget( $args, $instance ) {
            extract( $args );
            $title  = apply_filters( 'widget_title', $instance['title'] );
            $number = strip_tags( $instance['number'] );

            $loved_icon = apply_filters( 'sf_loved_icon', '<i class="ss-heart"></i>' );

            echo $before_widget;
            if ( $title ) {
                echo $before_title . $title . $after_title;
            } ?>
            <ul class="most-loved">
                <?php
                    $args       = array(
                        'post_type'   => 'any',
                        'numberposts' => $number,
                        'meta_key'    => '_li_love_count',
                        'orderby'     => 'meta_value_num',
                        'order'       => 'DESC'
                    );
                    $most_loved = get_posts( $args );
                    foreach ( $most_loved as $loved ) : ?>
                        <?php global $post;

                        	$post_id = $loved->ID;

                        	if ( function_exists( 'icl_object_id' ) ) {
                        		$post_id = icl_object_id( $post_id, 'post', true );
                        	}

                        	$author_id = get_post_field( 'post_author', $post_id );
                        	$author_name = get_the_author_meta( 'user_nicename', $author_id );

                        ?>

                        <li class="loved-item">
                            <a href="<?php echo get_permalink( $post_id ); ?>"></a>
                            <h5><?php echo get_the_title( $post_id ); ?></h5>
                            <span><?php echo sprintf( __( 'By %1$s', 'swiftframework' ), $author_name ); ?></span>

                            <div class="loved-count"><?php echo $loved_icon; ?><span><?php echo sf_get_post_meta( $post_id, '_li_love_count', true ); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
            </ul>
            <?php
            echo $after_widget;
        }

        /** @see WP_Widget::update */
        function update( $new_instance, $old_instance ) {
            $instance           = $old_instance;
            $instance['title']  = strip_tags( $new_instance['title'] );
            $instance['number'] = strip_tags( $new_instance['number'] );

            return $instance;
        }

        /** @see WP_Widget::form */
        function form( $instance ) {
            if ( isset( $instance['title'] ) ) {
                $title = esc_attr( $instance['title'] );
            } else {
                $title = __( "Most Loved", "swiftframework" );
            }
            if ( isset( $instance['number'] ) ) {
                $number = esc_attr( $instance['number'] );
            } else {
                $number = 5;
            }
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swiftframework' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                       value="<?php echo $title; ?>"/>
            </p>
            <p>
                <label
                    for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number to Show:', 'swiftframework' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>"
                       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
                       value="<?php echo $number; ?>"/>
            </p>
        <?php
        }
    }

    add_action( 'widgets_init', create_function( '', 'return register_widget("lip_most_loved_widget");' ) );

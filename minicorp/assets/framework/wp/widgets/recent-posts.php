<?php
/*
 * Plugin Name: Recent Posts
 * Plugin URI: http://www.ishyoboy.com
 * Description: A widget that displays your latest tweets
 * Version: 1.0
 * Author: IshYoBoy
 * Author URI: http://www.ishyoboy.com
 */
class Ishyoboy_Recent_Posts_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'ishyoboy-recent-portfolio-widget', // Base ID
            'Ishyo Recent (Blog, Portfolio)', // Name
            array(
                'description' => __( 'A widget which displays a list of your latest posts.', 'ishyoboy' ),
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

        echo str_replace( 'class="', 'class="icon-clock ', $before_widget);

        $post_type = $instance['post_type'];
        $postcount = $instance['postcount'];
        $buttontext = $instance['buttontext'];
        $buttonurl = $instance['buttonurl'];
        $show_images = (bool)$instance['show_images'];

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }


        $wpbp = new WP_Query( array(
                'post_type' =>  $post_type,
                'posts_per_page'  => $postcount,
                'post_status' => 'publish'
            )
        );

        if ($wpbp->have_posts()) {




            if ($show_images === true){
                // IMAGE TILES

                echo '<ul class="recent-projects-widget">';

                while ($wpbp->have_posts()) {


                    $wpbp->the_post();


                    if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {

                        echo '<li><a href="' . get_permalink() . '">';
                        the_post_thumbnail( 'thumbnail' );
                        echo '</a></li>';
                    }


                }

                echo '</ul>';

            }else{
                // POSTS LINKS

                echo '<ul>';

                while ($wpbp->have_posts()) {

                    $wpbp->the_post();
                    echo '<li><a href="' . get_permalink() . '">';
                    the_title();
                    echo '</a></li>';

                }

                echo '</ul>';

            }


        }
        else{
            echo '<p>' . __('No recent posts available', 'ishyoboy') . '</p>';
        }

        wp_reset_query();

        if( !empty($buttontext) ) { ?>
            <a class="btn-small" href="<?php echo esc_attr( apply_filters( 'ishyoboy_widget_button_url', $buttonurl ) ); ?>"><?php echo $buttontext; ?></a>
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
        $instance['post_type'] = strip_tags( $new_instance['post_type'] );
        $instance['postcount'] = strip_tags( $new_instance['postcount'] );
        $instance['buttontext'] = strip_tags( $new_instance['buttontext'] );
        $instance['buttonurl'] = strip_tags( $new_instance['buttonurl'] );
        $instance['show_images'] = strip_tags( $new_instance['show_images'] );

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

        $post_type = '';

        // Default widget settings.
        $defaults = array(
            'title' => __( 'Latest Posts', 'ishyoboy' ),
            'post_type' => $post_type,
            'postcount' => '5',
            'buttontext' => __( 'Go to Blog', 'ishyoboy' ),
            'buttonurl' => home_url(),
            'show_images' => false
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e('Posts type e.g. portfolio, ', 'ishyoboy') ?></label>
            <?php


                /*
                $args = array(
                    'public'   => true,
                    'capability_type' => 'post',
                    'publicly_queryable' => true,
                    'show_ui' => true
                );

                $post_types = get_post_types( $args, 'object' );
                */

                $post_types[] = get_post_type_object('post');
                $post_types[] = get_post_type_object('portfolio-post');

            ?>
            <select name="<?php echo $this->get_field_name( 'post_type' ); ?>" id="<?php echo $this->get_field_id( 'post_type' ); ?>" class="post-type-selector">

                <?php
                    foreach ($post_types  as $post_type ) {
                        echo '<option value="' . $post_type->name . '" ' . selected( $post_type->name, isset( $instance['post_type'] ) ? $instance['post_type'] : 'post', false ) . '>' . $post_type->labels->name . '</option>';
                    }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of posts', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'buttontext' ); ?>"><?php _e('Button Text e.g. Go to Blog', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" value="<?php echo $instance['buttontext']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'buttonurl' ); ?>"><?php _e('Button URL', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'buttonurl' ); ?>" name="<?php echo $this->get_field_name( 'buttonurl' ); ?>" value="<?php echo $instance['buttonurl']; ?>" />
        </p>

        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id( 'show_images' ); ?>" name="<?php echo $this->get_field_name( 'show_images' ); ?>" value="1" <?php checked( 1, isset( $instance['show_images'] ) ? $instance['show_images'] : 0, true ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_images' ); ?>"><?php _e('Use images instead of titles', 'ishyoboy') ?></label>
        </p>

        <?php
    }

}

// register Twitter_Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Ishyoboy_Recent_Posts_Widget" );' ) );
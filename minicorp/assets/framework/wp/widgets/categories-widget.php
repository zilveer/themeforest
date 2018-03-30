<?php
/*
 * Plugin Name: Blog Categories
 * Plugin URI: http://www.ishyoboy.com
 * Description: A widget that displays blog categories
 * Version: 1.0
 * Author: IshYoBoy
 * Author URI: http://www.ishyoboy.com
 */
class Ishyoboy_Categories_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'ishyoboy-categories-widget', // Base ID
            'Ishyo Categories widget', // Name
            array(
                'description' => __( 'List of categories.', 'ishyoboy' ),
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

        echo str_replace( 'class="', 'class="icon-reorder ', $before_widget);

        $widget_buttontext = $instance['buttontext'];
        $widget_buttonturl = $instance['buttonurl'];
        ?>
            <?php
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }
            ?>

            <nav>
                <ul class="categories">

                    <?php
                        $args = array(
                            'type'                     => 'post',
                            'child_of'                 => 0,
                            'parent'                   => '',
                            'orderby'                  => 'name',
                            'order'                    => 'ASC',
                            'hide_empty'               => 1,
                            'hierarchical'             => 1,
                            'exclude'                  => '',
                            'include'                  => '',
                            'number'                   => '',
                            'taxonomy'                 => 'category',
                            'pad_counts'               => false );

                    $categories = get_categories($args);

                    foreach ( $categories as $category ) {
                        echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'ishyoboy' ), $category->name ) . '" ' . '>' . $category->name.'</a> </li> ';
                    }


                    ?>
                </ul>
            </nav><br><br>

            <?php if( !empty($widget_buttontext) ) { ?>
                <a class="btn-small" href="<?php echo esc_attr( apply_filters( 'ishyoboy_widget_button_url', $widget_buttonturl ) ); ?>"><?php echo $widget_buttontext; ?></a>
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
        //$instance['postcount'] = strip_tags( $new_instance['postcount'] );
        $instance['buttontext'] = strip_tags( $new_instance['buttontext'] );
        $instance['buttonurl'] = strip_tags( $new_instance['buttonurl'] );

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

        // Default widget settings.
        $defaults = array(
            'title' => __( 'Blog categories', 'ishyoboy' ),
            'buttontext' => __( 'Go to blog', 'ishyoboy' ),
            'buttonurl' => 'http://',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'buttontext' ); ?>"><?php _e('Button Text e.g. Follow us on Flickr', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" value="<?php echo $instance['buttontext']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'buttonurl' ); ?>"><?php _e('Button url e.g. http://ishyoboy.com', 'ishyoboy') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'buttonurl' ); ?>" name="<?php echo $this->get_field_name( 'buttonurl' ); ?>" value="<?php echo $instance['buttonurl']; ?>" />
        </p>

        <?php
    }

}

// register Twitter_Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Ishyoboy_Categories_Widget" );' ) );
//add_action( 'widgets_init', create_function( '', 'unregister_widget( "WP_Widget_Categories" );' ) );

<?php
/**
 * Popular posts
 */
add_action( 'widgets_init', 'bd_popular' );
function bd_popular() {
    register_widget( 'bd_popular' );
}

class bd_popular extends WP_Widget {

    function bd_popular() {
        $widget_ops = array('classname' => 'bd-popular-posts', 'description' => '');
        $control_ops = array('id_base' => 'bd-popular-posts');
        $this->WP_Widget('bd-popular-posts', theme_name . ' - Popular Posts', $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title              = apply_filters('widget_title', $instance['title'] );
        $no_of_posts        = $instance['no_of_posts'];
        $popular_posts_by   = $instance['popular_posts_by'];

        echo $before_widget;
        if( $title ) {
            echo $before_title.$title.$after_title;
        }

        if( $popular_posts_by == 'comments' ){

            bd_popular_posts( $no_of_posts, true );

        } elseif( $popular_posts_by == 'views' ) {

            bd_popular_posts_views( $no_of_posts, true );

        }
        echo $after_widget;
    }


    function update( $new_instance, $old_instance ) {
        $instance                       = $old_instance;
        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['no_of_posts']        = strip_tags( $new_instance['no_of_posts'] );
        $instance['popular_posts_by']   = strip_tags( $new_instance['popular_posts_by'] );
        return $instance;
    }

    function form( $instance ) {
        $defaults = array( 'title' =>__( 'Popular Posts' , 'bd'), 'no_of_posts' => '5', 'popular_posts_by' => 'comments' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title :</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>">Number of posts to show: </label>
            <input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'popular_posts_by' ); ?>">Popular posts by : </label>
            <select id="<?php echo $this->get_field_id( 'popular_posts_by' ); ?>" name="<?php echo $this->get_field_name( 'popular_posts_by' ); ?>" >
                <option value="views" <?php if( !empty( $instance['popular_posts_by'] ) && $instance['popular_posts_by'] == 'views' ) echo "selected=\"selected\""; else echo ""; ?>>Views</option>
                <option value="comments" <?php if( !empty( $instance['popular_posts_by'] ) && $instance['popular_posts_by'] == 'comments' ) echo "selected=\"selected\""; else echo ""; ?>>Comments Count</option>
            </select>
        </p>
    <?php
    }
}
?>
<?php
add_action( 'widgets_init', 'bd_top_rate' );
function bd_top_rate() {
    register_widget( 'bd_top_rate' );
}
class bd_top_rate extends WP_Widget {
    function bd_top_rate() {
        $widget_ops = array('classname' => 'bd-toprate', 'description' => '');
        $control_ops = array('id_base' => 'bd-toprate');
        $this->WP_Widget('bd-toprate', theme_name . ' - Top Reviews', $widget_ops, $control_ops);
    }
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );
        $no_of_posts = $instance['no_of_posts'];
        echo $before_widget;
        if($title) {
            echo $before_title.$title.$after_title;
        }
        bd_review_posts($no_of_posts, true);
        echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
        return $instance;
    }
    function form( $instance ) {
        $defaults = array( 'title' =>__( 'Top Reviews' , 'bd'), 'no_of_posts' => '5');
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title : ','bd') ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e('Number of posts to show','bd') ?>: </label>
            <input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
        </p>
    <?php
    }

}

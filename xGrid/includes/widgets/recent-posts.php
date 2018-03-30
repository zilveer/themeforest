<?php
add_action( 'widgets_init', 'bd_recent_posts' );
function bd_recent_posts() {
    register_widget( 'bd_recent_posts' );
}
class bd_recent_posts extends WP_Widget {
function bd_recent_posts() {
    $widget_ops = array('classname' => 'bd-recent-posts', 'description' => '');
    $control_ops = array('id_base' => 'bd-recent-posts');
    $this->WP_Widget('bd-recent-posts', theme_name . ' - Recent Posts', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title'] );
    $no_of_posts = $instance['no_of_posts'];
    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
    bd_last_posts($no_of_posts, true);
    echo $after_widget;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'title' =>__( 'Recent Posts' , 'bd'), 'no_of_posts' => '5');
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title : ','bd')?></label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e('Number of posts to show','bd') ?>: </label>
        <input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
    </p>
<?php
}

}

<?php
add_action( 'widgets_init', 'bd_comments_widget' );
function bd_comments_widget() {
    register_widget( 'bd_comments_widget' );
}
class bd_comments_widget extends WP_Widget {
function bd_comments_widget() {
    $widget_ops = array('classname' => 'bd-comments-widget', 'description' => '');
    $control_ops = array('id_base' => 'bd-comments-widget');
    $this->WP_Widget('bd-comments-widget', theme_name . ' - Comments', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title'] );
    $c_number = $instance['c_number'];
    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
    bd_comments($c_number);
    echo $after_widget;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['c_number'] = strip_tags( $new_instance['c_number'] );
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'title' =>__( 'Comments' , 'bd'), 'c_number' => '5');
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','bd') ?> : </label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'c_number' ); ?>"><?php _e('Comments Number of posts to show:' , 'bd'); ?></label>
        <input id="<?php echo $this->get_field_id( 'c_number' ); ?>" name="<?php echo $this->get_field_name( 'c_number' ); ?>" value="<?php echo $instance['c_number']; ?>" size="3" />
    </p>
<?php
}
}
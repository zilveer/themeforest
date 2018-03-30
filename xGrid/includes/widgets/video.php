<?php
add_action('widgets_init','bd_video_widgets');
function bd_video_widgets() {
    register_widget('bd_video_widgets');
}
class bd_video_widgets extends WP_Widget {
function bd_video_widgets() {
    $widget_ops = array('classname' => 'bd-video-widget', 'description' => '');
    $control_ops = array('id_base' => 'bd-video-widget');
    $this->WP_Widget('bd-video-widget', theme_name . ' - Video Widget', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {

    extract( $args );
    $title = apply_filters('widget_title', $instance['title'] );
    $type = $instance['type'];
    $id = $instance['id'];

    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
?>
<?php if($type == 'Youtube') { ?>
<iframe width="310" height="235" src="http://www.youtube.com/embed/<?php echo $id; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
<?php } elseif($type == 'Vimeo') { ?>
<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" width="310" height="235" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<?php } elseif($type == 'Dialymotion') { ?>
<iframe frameborder="0" width="310" height="235" src="http://www.dailymotion.com/embed/video/<?php echo $id ?>?logo=0"></iframe>
<?php } ?>
<?php
    echo $after_widget;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['type'] = $new_instance['type'];
    $instance['id'] = $new_instance['id'];
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'title' => __('Video','bd'),);
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'bd') ?></label>
        <input style="width: 216px;" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"   />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('type', 'bd') ?></label>
        <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" >
            <option <?php if ( 'Youtube' == $instance['type'] ) echo 'selected="selected"'; ?>>Youtube</option>
            <option <?php if ( 'Vimeo' == $instance['type'] ) echo 'selected="selected"'; ?>>Vimeo</option>
            <option <?php if ( 'Dialymotion' == $instance['type'] ) echo 'selected="selected"'; ?>>Dialymotion</option>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Video ID:', 'bd') ?></label>
        <input style="width: 216px;" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>"  />
    </p>
<?php
}

}
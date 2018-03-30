<?php
add_action( 'widgets_init', 'bd_soundcloud' );
function bd_soundcloud() {
    register_widget( 'bd_soundcloud' );
}
class bd_soundcloud extends WP_Widget {
function bd_soundcloud() {
    $widget_ops = array('classname' => 'bd-soundcloud', 'description' => '');
    $control_ops = array('id_base' => 'bd-soundcloud');
    $this->WP_Widget('bd-soundcloud', theme_name . ' - Soundcloud', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title'] );
    $url = $instance['url'];
    $autoplay = $instance['autoplay'];
    $play = 'false';
    if( !empty( $autoplay )) $play = 'true';

    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
?>
<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $url; ?>&amp;auto_play=<?php echo $play; ?>&amp;show_artwork=true"></iframe>
<?php
    echo $after_widget;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['url'] = $new_instance['url'] ;
    $instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'title' => 'SoundCloud'  );
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'url' ); ?>">URL :</label>
        <input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" type="text" class="widefat" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>">Autoplay :</label>
        <input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="true" <?php if( $instance['autoplay'] ) echo 'checked="checked"'; ?> type="checkbox" />
    </p>
<?php
}

}
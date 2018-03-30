<?php 
add_action('widgets_init','bd_fb_likebox');
function bd_fb_likebox() {
    register_widget('bd_fb_likebox');
}
class bd_fb_likebox extends WP_Widget {
function bd_fb_likebox() {
    $widget_ops = array('classname' => 'bd-fb-likebox', 'description' => 'Facebook Like Box');
    $control_ops = array('id_base' => 'bd-fb-likebox');
    $this->WP_Widget('bd-fb-likebox', theme_name . ' - Facebook Like Box', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title'] );
    $width = $instance['width'];
    $height = $instance['height'];
    $background = $instance['background'];
    $borderc = $instance['borderc'];
    $page = $instance['page'];

    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
?>
<div class="like_box_footer" <?php if($background != '') { echo "style='background:#$background;'"; } ?>>
<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $page ; ?>&amp;width=<?php echo $width ; ?>&amp;colorscheme=light&amp;show_faces=true&amp;show_border=false&amp;stream=false&amp;header=false&amp;height=<?php echo $height ; ?>" scrolling="no" frameborder="0" style="overflow:hidden; border : 1px #<?php echo $borderc ; ?> solid; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
</div>
<?php 
    echo $after_widget;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['width'] = $new_instance['width'];
    $instance['height'] = $new_instance['height'];
    $instance['background'] = $new_instance['background'];
    $instance['borderc'] = $new_instance['borderc'];
    $instance['page'] = $new_instance['page'];
    return $instance;
}
function form( $instance ) {
    $defaults = array('title' =>__( 'Facebook' , 'bd') , 'page' => 'http://www.facebook.com/bdayhwp', 'width' => 280, 'height' => 250,'background' => 'FFFFFF', 'borderc' => 'FFFFFF', );
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'bd') ?></label>
        <input style="width: 216px;" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:', 'bd') ?></label>
        <input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" size="3"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'bd') ?></label>
        <input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" size="3"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'background' ); ?>"><?php _e('Background Color: (color code without #)','bd') ?></label>
        <input style="width: 216px;" id="<?php echo $this->get_field_id( 'background' ); ?>" name="<?php echo $this->get_field_name( 'background' ); ?>" value="<?php echo $instance['background']; ?>"   />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'borderc' ); ?>"><?php _e('Box border Color: (color code without #)', 'bd') ?></label>
        <input style="width: 216px;" id="<?php echo $this->get_field_id( 'borderc' ); ?>" name="<?php echo $this->get_field_name( 'borderc' ); ?>" value="<?php echo $instance['borderc']; ?>"   />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php _e('Facebook Page URL:', 'bd') ?></label>
        <input style="width: 216px;" id="<?php echo $this->get_field_id( 'page' ); ?>" name="<?php echo $this->get_field_name( 'page' ); ?>" value="<?php echo $instance['page']; ?>"   />
    </p>
<?php
}

}
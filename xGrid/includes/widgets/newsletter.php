<?php
add_action( 'widgets_init','bd_feedburner_widget' );
function bd_feedburner_widget() {
    register_widget( 'feedburner_widget' );
}
class feedburner_widget extends WP_Widget {
function feedburner_widget() {
    $widget_ops = array('classname' => 'bd-feedburner', 'description' => '');
    $control_ops = array('id_base' => 'bd-feedburner');
    $this->WP_Widget('bd-feedburner', theme_name . ' - Feedburner', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title'] );
    $text_code = $instance['text_code'];
    $feedburner = $instance['feedburner'];
    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
	echo '<div class="post-warpper"><p>'. $text_code .'</p>';
?>
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
    <input type="text" name="email" value="<?php _e( 'Enter your e-mail address' , 'bd') ; ?>" onfocus="if (this.value == '<?php _e( 'Enter your e-mail address' , 'bd') ; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Enter your e-mail address' , 'bd') ; ?>';}">
    <input type="hidden" value="<?php echo $feedburner ; ?>" name="uri">
    <input type="hidden" name="loc" value="en_US">
    <button value="<?php _e( 'Subscribe' , 'bd') ; ?>" name="Submit" type="submit" class="btn"><?php _e('Subscribe','bd') ?></button>
</form>
</div>
<?php
    echo $after_widget;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['text_code'] = $new_instance['text_code'] ;
    $instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'title' =>__( 'Newsletter Widget' , 'bd') , 'text_code' => __( 'Subscribe to our email newsletter.' , 'bd') );
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','bd') ?> : </label>
      <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(isset($instance['title'])){ echo $instance['title']; } ?>" class="widefat" type="text" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text_code' ); ?>"><?php _e('Paragraph','bd') ?> : </label>
      <textarea rows="5" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php if(isset($instance['text_code'])){ echo $instance['text_code']; } ?></textarea>
    </p>
    <p>
      <label >Feedburner ID : </label>
      <input name="<?php echo $this->get_field_name('feedburner'); ?>" value="<?php if(isset($instance['feedburner'])){ echo $instance['feedburner']; } ?>" class="widefat" type="text" />
      <small><?php _e('example','bd') ?> : <em>psdtuts</em></small>
    </p>
<?php
}

}


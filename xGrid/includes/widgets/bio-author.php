<?php
add_action( 'widgets_init', 'bd_author_bio' );
function bd_author_bio(){
    register_widget( 'bd_author_bio' );
}
class bd_author_bio extends WP_Widget {
function bd_author_bio() {
    $widget_ops     = array('classname' => 'bd-author-bio', 'description' => '');
    $control_ops    = array('id_base'   => 'bd-author-bio');
    $this->WP_Widget('bd-author-bio', theme_name . ' - Author Bio', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    if ( is_single() ) :
    $avatar     = $instance['avatar'];
    $social     = $instance['social'];
    echo $before_widget;
    echo $before_title;
    printf( __( 'About %s', 'bd' ), get_the_author() );
    echo $after_title;
    bd_author_box( $avatar , $social );
    echo $after_widget;
    endif;
}
function update( $new_instance, $old_instance ) {
    $instance           = $old_instance;
    $instance['avatar'] = strip_tags( $new_instance['avatar'] );
    $instance['social'] = strip_tags( $new_instance['social'] );
    return $instance;
}
function form( $instance ) {
    $defaults   = array( 'avatar' => 'true' , 'social' => 'true' );
    $instance   = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'avatar' ); ?>">Display author's avatar : </label>
        <input id="<?php echo $this->get_field_id( 'avatar' ); ?>" name="<?php echo $this->get_field_name( 'avatar' ); ?>" value="true" <?php if( $instance['avatar'] ) echo 'checked="checked"'; ?> type="checkbox" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'social' ); ?>">Display Social icons : </label>
        <input id="<?php echo $this->get_field_id( 'social' ); ?>" name="<?php echo $this->get_field_name( 'social' ); ?>" value="true" <?php if( $instance['social'] ) echo 'checked="checked"'; ?> type="checkbox" />
    </p>
<?php
}
}


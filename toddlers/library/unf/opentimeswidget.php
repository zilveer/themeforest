<?php

// I hereby declare..
class opentimes_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'opentimes_widget',

// Widget name will appear in UI
__('Opentimes Widget', 'toddlers'),

// Widget description
array( 'description' => __( 'Display the opentimes entered in the theme settings', 'toddlers' ), )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	extract( $args );
        $title = isset($instance['title']) ? $instance['title'] : '';
        // CHANGE COLOUR TO PURPLE
        //$before_widget = str_replace('orange', 'purple', $before_widget);
        echo $before_widget;
        echo $title ? ($before_title . $title . $after_title) : '';
?>
<div class="opentimesbox">
<?php get_template_part('library/unf/opentimestable');?>
</div>
<?php echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Open Times', 'toddlers' );
}
// Widget admin form=
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','toddlers' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class opentimes_widget ends here

// Register and load the widget
function opentimes_load_widget() {
	register_widget( 'opentimes_widget' );
}
add_action( 'widgets_init', 'opentimes_load_widget' );
<?php
/**
  * Comments Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_comments_widget_init' );

function van_comments_widget_init() {

	register_widget( 'van_comments_widget' );

}
class van_comments_widget extends WP_Widget {

	function van_comments_widget() {
		$options = array( 'classname' => 'widget-comments','description' => 'Recent comments with avatar' );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget-comments' );
		$this->WP_Widget( 'widget-comments','( ' .THEME_NAME .' ) - Recent comments', $options, $control );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title       = apply_filters('widget_title', $instance['title'] );
		$number   = $instance['number'];

		echo $before_widget;

			if ( !empty( $title ) ){ echo $before_title . $title . $after_title; }

        			van_comments( $number );
        			
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Recent Comments' , 'van'), 'number' => '3');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title : ","") ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of comments:  </label>
			<input style="35px" type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" />
		</p>

	<?php
	}
}
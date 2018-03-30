<?php
/**
  * Youtube Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_youtube_widget_init' );

function van_youtube_widget_init(){
	register_widget( 'youtube_widget' );
}

class youtube_widget extends WP_Widget {
	function youtube_widget() {
		$options = array( 'classname' => 'youtube-widget' );
		$this->WP_Widget( 'youtube-widget','( '. THEME_NAME .' ) - Youtube Widget', $options );
	}
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$username   = $instance['username'];

		echo "<div class=\"skip-content\">";
		echo $before_widget;
		if( $title ){echo $before_title . $title . $after_title;}
		?>
		<div class="youtube-widget">
			<?php echo van_embed_code('http://www.youtube.com/subscribe_widget?p=' . $username, '296', '105', 'overflow: hidden; height: 105px;  width: 100%;', ''); ?>
		</div>
		<?php
	 	 echo $after_widget;
	 	 echo "</div><!--.skip-content-->";
		
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Subscribe to our Channel' ,'van') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Channel username:</label>
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php if( isset( $instance['username'] ) ){ echo esc_attr( $instance['username'] ); } ?>" class="widefat" type="text" />
		</p>
	<?php
	}
}
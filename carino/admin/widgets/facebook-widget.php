<?php

/**
  * Facebook Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_facebook_widget_init' );

function van_facebook_widget_init() {

	register_widget( 'van_facebook_widget' );

}
class van_facebook_widget extends WP_Widget {

	function van_facebook_widget() {
		$options = array( 'classname' => 'facebook-widget' ,'description' => 'Facebook Like box'  );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'facebook-widget' );
		$this->WP_Widget( 'facebook-widget','( '.THEME_NAME .' ) - Faceboox', $options, $control );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title    = apply_filters('widget_title', $instance['title'] );
		$page_url = $instance['page_url'];

		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
			?>
			<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo esc_url( $page_url ); ?>&amp;width=292&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=121518931330729" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:258px;" allowTransparency="true"></iframe>
		    	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Find us on Facebook' , 'van') );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title : ","van") ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Page url : </label>
			<input class="widefat" type="text"  id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php if( isset( $instance['page_url'] ) ){ echo esc_attr( $instance['page_url'] ); } ?>" />
		</p>
	<?php
	}
}
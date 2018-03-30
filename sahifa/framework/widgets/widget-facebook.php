<?php

add_action( 'widgets_init', 'tie_acebook_widget_box' );
function tie_acebook_widget_box() {
	register_widget( 'tie_facebook_widget' );
}
class tie_facebook_widget extends WP_Widget {

	function tie_facebook_widget() {
		$widget_ops 	= array( 'classname' => 'facebook-widget' );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'facebook-widget' );
		parent::__construct( 'facebook-widget',THEME_NAME .' - '.__( 'Facebook' , 'tie' ) , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title 		= apply_filters('widget_title', $instance['title'] );
		$page_url 	= $instance['page_url'];
		$protocol 	= is_ssl() ? 'https' : 'http';

		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
			<div class="facebook-box">
				<iframe src="<?php echo $protocol ?>://www.facebook.com/plugins/likebox.php?href=<?php echo $page_url ?>&amp;width=300&amp;height=250&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:250px;" allowTransparency="true"></iframe>
			</div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['page_url'] 	= strip_tags( $new_instance['page_url'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Find us on Facebook' , 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>"><?php _e( 'Page URL :' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php if( !empty($instance['page_url']) ) echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>
	<?php
	}
}
?>
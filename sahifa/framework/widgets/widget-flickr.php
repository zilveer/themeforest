<?php

add_action( 'widgets_init', 'tie_flickr_photos_widget' );
function tie_flickr_photos_widget() {
	register_widget( 'tie_flickr_photos' );
}
class tie_flickr_photos extends WP_Widget {

	function tie_flickr_photos() {
		$widget_ops 	= array( 'classname' => 'flickr-widget' );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'flickr_photos-widget' );
		parent::__construct( 'flickr_photos-widget', THEME_NAME .' - '.__( 'Flickr' , 'tie') , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title 			= apply_filters('widget_title', $instance['title'] );
		$no_of_photos 	= $instance['no_of_photos'];
		$flickr_id 		= $instance['flickr_id'];
		$flickr_display = $instance['flickr_display'];
		$protocol 		= is_ssl() ? 'https' : 'http';

		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
		<script type="text/javascript" src="<?php echo $protocol ?>://www.flickr.com/badge_code_v2.gne?count=<?php echo $no_of_photos; ?>&amp;display=<?php echo $flickr_display; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>        
		<div class="clear"></div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance 					= $old_instance;
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['no_of_photos'] 	= strip_tags( $new_instance['no_of_photos'] );
		$instance['flickr_id'] 		= strip_tags( $new_instance['flickr_id'] );
		$instance['flickr_display'] = strip_tags( $new_instance['flickr_display'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Flickr' , 'tie'), 'no_of_photos' => '8' , 'flickr_display' => 'latest' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e( 'Flickr ID:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" value="<?php if( !empty($instance['flickr_id']) ) echo $instance['flickr_id']; ?>" class="widefat" type="text" />
			<small><?php _e( 'Find Your ID at' , 'tie') ?> (<a href="http://www.idgettr.com">idGettr</a>)</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_photos' ); ?>"><?php _e( 'Number of photos to show:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'no_of_photos' ); ?>" name="<?php echo $this->get_field_name( 'no_of_photos' ); ?>" value="<?php if( !empty($instance['no_of_photos']) ) echo $instance['no_of_photos']; ?>" type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_display' ); ?>"><?php _e( 'Photos Order:' , 'tie') ?></label>
			<select id="<?php echo $this->get_field_id( 'flickr_display' ); ?>" name="<?php echo $this->get_field_name( 'flickr_display' ); ?>" >
				<option value="latest" <?php if( !empty($instance['flickr_display']) && $instance['flickr_display'] == 'latest' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Most recent' , 'tie') ?></option>
				<option value="random" <?php if( !empty($instance['flickr_display']) && $instance['flickr_display'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Random' , 'tie') ?></option>
			</select>
		</p>

	<?php
	}
}
?>
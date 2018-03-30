<?php
/* video */
add_action( 'widgets_init', 'widget_video_widget' );
function widget_video_widget() {
	register_widget( 'Widget_Video' );
}
class Widget_Video extends WP_Widget {

	function Widget_Video() {
		$widget_ops = array( 'classname' => 'video-widget'  );
		$control_ops = array( 'id_base' => 'video-widget' );
		parent::__construct( 'video-widget','Ask me - video', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		= apply_filters('widget_title', $instance['title'] );
		$video_type = esc_attr($instance['video_type']);
		$video_id   = esc_attr($instance['video_id']);
		$embed_code = esc_attr($instance['embed_code']);
		$width		= 'width="100%"';
		$height		= esc_attr($instance['height']);
		$embed_code = preg_replace('/width="([3-9][0-9]{2,}|[1-9][0-9]{3,})"/',$width,$embed_code);
		$embed_code = preg_replace( '/height="([0-9]*)"/' , $height , $embed_code );
		$width1		= 'width: 100%';
		$height1	= 'height: 170';
		$embed_code = preg_replace('/width:"([3-9][0-9]{2,}|[1-9][0-9]{3,})"/',$width1,$embed_code);
		$embed_code = preg_replace( '/height: ([0-9]*)/' , $height1 , $embed_code );  
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;
			if ( $embed_code ):
				echo $embed_code;
			else:
				if ($video_type == 'youtube') {
					$type = "http://www.youtube.com/embed/".$video_id;
				}else if ($video_type == 'vimeo') {
					$type = "http://player.vimeo.com/video/".$video_id;
				}else if ($video_type == 'daily') {
					$type = "http://www.dailymotion.com/swf/video/".$video_id;
				}
				echo '<div class="video_embed"><iframe '.$width.' height="'.$height.'" src="'.$type.'"></iframe></div>';
			endif;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance				= $old_instance;
		$instance['title']		= strip_tags( $new_instance['title'] );
		$instance['embed_code'] = $new_instance['embed_code'];
		$instance['video_type'] = $new_instance['video_type'];
		$instance['video_id']	= $new_instance['video_id'];
		$instance['height']		= $new_instance['height'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Video','height' => '200' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">Height : </label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo (isset($instance['height'])?esc_attr($instance['height']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'embed_code' ); ?>">Embed Code : </label>
			<textarea id="<?php echo $this->get_field_id( 'embed_code' ); ?>" name="<?php echo $this->get_field_name( 'embed_code' ); ?>" class="widefat"><?php echo (isset($instance['embed_code'])?esc_attr($instance['embed_code']):""); ?></textarea>
		</p>
		<em style="display:block; border-bottom:1px solid #CCC; margin-bottom:15px;">OR</em>

		<p>
			<label for="<?php echo $this->get_field_id( 'video_type' ); ?>">Video Type : </label>
			<select id="<?php echo $this->get_field_id( 'video_type' ); ?>" name="<?php echo $this->get_field_name( 'video_type' ); ?>">
				<option value="youtube" <?php if( isset($instance['video_type']) && $instance['video_type'] == 'youtube' ) echo "selected=\"selected\""; else echo ""; ?>>Youtube</option>
				<option value="vimeo" <?php if( isset($instance['video_type']) && $instance['video_type'] == 'vimeo' ) echo "selected=\"selected\""; else echo ""; ?>>Vimeo</option>
				<option value="daily" <?php if( isset($instance['video_type']) && $instance['video_type'] == 'daily' ) echo "selected=\"selected\""; else echo ""; ?>>Dialymotion</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'video_id' ); ?>"></label>
			<input id="<?php echo $this->get_field_id( 'video_id' ); ?>" name="<?php echo $this->get_field_name( 'video_id' ); ?>" value="<?php echo (isset($instance['video_id'])?esc_attr($instance['video_id']):""); ?>" class="widefat" type="text">
			<br>
			Put here the video id : http://www.youtube.com/watch?v=sdUUx5FdySs EX : "sdUUx5FdySs"
		</p>
	<?php
	}
}
?>
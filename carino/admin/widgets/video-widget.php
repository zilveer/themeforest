<?php

/**
  * Video Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'video_widget_init' );
function video_widget_init() {
	register_widget( 'van_video_widget' );
}
class van_video_widget extends WP_Widget {

	function van_video_widget() {
		$options = array( 'classname' => 'video-widget', 'description' => 'video widget'  );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'video-widget' );
		$this->WP_Widget( 'video-widget','( '.THEME_NAME .' ) - Video', $options, $control );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title        = apply_filters('widget_title', $instance['title'] );
		$video_url     = $instance['video_url'];
		$embed_code   = $instance['embed_code'];

		echo "<div class=\"skip-content\">";
		echo $before_widget;
		
			if ( $title ){
				echo $before_title . $title . $after_title;
			}
			echo '<div class="short-resp-container" style="margin-bottom:0;"><div class="short-resp">';
			if($video_url){
				echo van_video_embed_url('300','195',$video_url);
			}elseif ($embed_code){
				echo van_video_embed_code('300','195',$embed_code);
			}
			echo '</div></div>';
		echo $after_widget;
		echo "</div><!--.skip-content-->";
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['video_url']  = strip_tags( $new_instance['video_url'] );
		$instance['embed_code'] = $new_instance['embed_code'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__(' Featured Video', 'van') );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title : ","van") ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'video_url' ); ?>">Video url : </label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'video_url' ); ?>" name="<?php echo $this->get_field_name( 'video_url' ); ?>" value="<?php if( isset( $instance['video_url'] ) ){ echo esc_attr( $instance['video_url'] ); } ?>"  />
		<small>Enter a url from: Youtube,vimeo,dailymotion or blip.tv</small>
		</p>
		<span style="display:block; padding:4px; border-top:2px solid #cacaca">Or</span>
		<p>
		<label for="<?php echo $this->get_field_id( 'embed_code' ); ?>">Embed Code : </label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'embed_code' ); ?>" name="<?php echo $this->get_field_name( 'embed_code' ); ?>"  ><?php if( isset( $instance['embed_code'] ) ){ echo $instance['embed_code']; } ?></textarea>
		</p>
		<?php
	}
}
<?php

add_action( 'widgets_init', 'tie_video_widget_box' );
function tie_video_widget_box() {
	register_widget( 'tie_video_widget' );
}
class tie_video_widget extends WP_Widget {

	function tie_video_widget() {
		$widget_ops 	= array( 'classname' => 'video-widget', 'description' => ''  );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'video-widget' );
		parent::__construct( 'video-widget', THEME_NAME .' - '.__( 'Video' , 'tie') , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;
		echo $before_title;
		echo $title ; 
		echo $after_title; 
			$protocol = is_ssl() ? 'https' : 'http';

			if (!empty( $instance['embed_code'] ) ){
				echo $instance['embed_code'];

			}elseif( !empty( $instance['video_url'] ) ){
				$wp_embed = new WP_Embed();
				$video_url = $instance['video_url'] ;
				$video_output = $wp_embed->run_shortcode('[embed width="320" height="180"]'.$video_url.'[/embed]');
				if( $video_output == '<a href="'.$video_url.'">'.$video_url.'</a>' ){
					$width  = '320' ;
					$height = '180';
					$video_link = @parse_url($video_url);
					if ( $video_link['host'] == 'www.youtube.com' || $video_link['host']  == 'youtube.com' ) {
						parse_str( @parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
						$video =  $my_array_of_vars['v'] ;
						$video_output ='<iframe width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
					}
					elseif( $video_link['host'] == 'www.youtu.be' || $video_link['host']  == 'youtu.be' ){
						$video = substr(@parse_url($video_url, PHP_URL_PATH), 1);
						$video_output ='<iframe width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
					}elseif( $video_link['host'] == 'www.vimeo.com' || $video_link['host']  == 'vimeo.com' ){
						$video = (int) substr(@parse_url($video_url, PHP_URL_PATH), 1);
						$video_output='<iframe src="'.$protocol.'://player.vimeo.com/video/'.$video.'?wmode=opaque" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
					}
					elseif( $video_link['host'] == 'www.dailymotion.com' || $video_link['host']  == 'dailymotion.com' ){
						$video = substr(@parse_url($video_url, PHP_URL_PATH), 7);
						$video_id = strtok($video, '_');
						$video_output='<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.dailymotion.com/embed/video/'.$video_id.'"></iframe>';
					}
				}
				
				if( !empty($video_output) ) echo $video_output;
			}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['embed_code'] = $new_instance['embed_code'] ;
		$instance['video_url'] 	= strip_tags( $new_instance['video_url'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Featured Video', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'embed_code' ); ?>"><?php _e( 'Embed Code' , 'tie') ?></label>
			<textarea id="<?php echo $this->get_field_id( 'embed_code' ); ?>" name="<?php echo $this->get_field_name( 'embed_code' ); ?>" class="widefat" ><?php if( !empty( $instance['embed_code'] ) ) echo $instance['embed_code']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'video_url' ); ?>"><?php _e( 'Video URL' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'video_url' ); ?>" name="<?php echo $this->get_field_name( 'video_url' ); ?>" value="<?php if( !empty( $instance['video_url'] ) ) echo $instance['video_url']; ?>" class="widefat" type="text" />
		</p>
	<?php
	}
}
?>
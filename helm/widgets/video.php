<?php
class mTheme_Video_Widget extends WP_Widget {

	function mTheme_Video_Widget() {
		$widget_ops = array('classname' => 'mtheme_video_widget', 'description' => __( 'Video embed widget', 'mthemelocal') );
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('video_details',MTHEME_NAME .' - '. __('Video', 'mthemelocal'), $widget_ops,$control_ops);
		
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Video', 'mthemelocal') : $instance['title'], $instance, $this->id_base);
		$text = $instance['text'];
		
		
		echo $before_widget;
		if ( $title)
			echo $before_title . $title . $after_title;
		
		?>
		
		<?php if(!empty($text)):?>
		<div class="ajax-video-wrapper">
		<div class="ajax-video-container">
		<?php echo $text;?>
		</div>
		</div>	
		<?php endif;?>
		
		<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = stripslashes_deep($new_instance['text']);
		

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$text = isset($instance['text']) ? esc_attr($instance['text']) : '';
	?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Video Embed Code:', 'mthemelocal'); ?></label>
		<textarea class="widefat" cols="20" rows="16" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" ><?php echo $text; ?></textarea></p>
		
<?php
	}

}
register_widget('mTheme_Video_Widget');
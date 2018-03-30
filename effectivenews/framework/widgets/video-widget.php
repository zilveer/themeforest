<?php 

add_action('widgets_init','mom_video_widget');

function mom_video_widget() {
	register_widget('mom_video_widget');
	
	}

class mom_video_widget extends WP_Widget {
	function mom_video_widget() {
			
		$widget_ops = array('classname' => 'momizat-video','description' => __('Widget display viddeo support Youtube, vimeo and dailymotion','theme'));
		parent::__construct('momizatVideo',__('Effective - Video','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$type = $instance['type'];
		$id = $instance['id'];
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
<div class="mom-video-widget">
	<?php if($type == 'youtube') { ?>
	<iframe src="http://www.youtube.com/embed/<?php echo $id; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($type == 'vimeo') { ?>
	<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($type == 'daily') { ?>
	<iframe frameborder="0" src="http://www.dailymotion.com/embed/video/<?php echo $id ?>?logo=0" allowfullscreen></iframe>
	<?php } ?>
</div>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['id'] = $new_instance['id'];
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Video','theme'), 
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
	
	$id = isset($instance['id']) ? $instance['id'] : '';
	$type = isset($instance['type']) ? $instance['type'] : '';

		?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'theme') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('type', 'theme') ?></label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
			<option value="youtube" <?php selected($type, 'youtube'); ?>><?php _e('Youtube', 'theme'); ?></option>
			<option value="vimeo" <?php selected($type, 'vimeo'); ?>><?php _e('Vimeo', 'theme'); ?></option>
			<option value="daily" <?php selected($type, 'daily'); ?>><?php _e('Dailymotion', 'theme'); ?></option>
			</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Video ID:', 'theme') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $id; ?>" class="widefat" />
		</p>


        
   <?php 
}
	} //end class
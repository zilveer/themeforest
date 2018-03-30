<?php

// Widget class
class PixFlow_Video_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		THEME_SLUG . '_Video_Widget', // Base ID
			THEME_SLUG . ' - Video', // Name
			array( 'description' => __( 'A widget that displays your YouTube or Vimeo Video.', TEXTDOMAIN ) ) // Args
		);
	}
		
	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$type  = $instance['type'];
		$vid   = $instance['vid'];
		$desc   = $instance['desc'];
		
		// Before widget (defined by theme functions file)
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;

		?>
		
		<?php if($desc != ''){?>
		<div><?php echo $desc; ?></div><br/>
		<?php } ?>
		
		<div class="post_video">
		<?php
		if($type == 'youtube')
		{
		?>
			<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $vid; ?>" frameborder="0" allowfullscreen></iframe>
		<?php
		}
		else
		{?>
			<iframe src="http://player.vimeo.com/video/<?php echo $vid; ?>?color=f0e400" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		<?php
		}
		?>
		</div>	
		<?php

		// After widget (defined by theme functions file)
		echo $after_widget;
	}

		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags to remove HTML (important for text inputs)
		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['vid']     = strip_tags( $new_instance['vid'] );
		$instance['desc']    = strip_tags( $new_instance['desc'] );
		$instance['type']    = $new_instance['type'];
		
		return $instance;
	}
		 
	function form( $instance ) {

		// Set up some default widget settings
		$defaults = array(
			'title' => 'My Video',
			'vid' => '',
			'type' => 'vimeo',
			'desc' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', TEXTDOMAIN) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Video Type: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>">Type:</label>
			<select name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>" class="widefat">
				<option value="youtube"<?php selected($instance['type'],'youtube');?>>Youtube</option>
				<option value="vimeo"<?php selected($instance['type'],'vimeo');?>>Vimeo</option>
			</select>
		</p>
		
		<!-- Video ID: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'vid' ); ?>"><?php _e('Video ID:', TEXTDOMAIN) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'vid' ); ?>" name="<?php echo $this->get_field_name( 'vid' ); ?>" value="<?php echo $instance['vid']; ?>" />
		</p>
		
		<!-- Video Description: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Video Info:', TEXTDOMAIN) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo $instance['desc']; ?>" />
		</p>
		<?php
		}
}

// register widget
add_action( 'widgets_init', create_function( '', 'register_widget( "PixFlow_Video_Widget" );' ) );

?>
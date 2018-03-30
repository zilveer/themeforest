<?php

/*-----------------------------------------------------------------------------------

 	Plugin Name: Custom Video Widget
 	Description: A widget that displays your latest video
 
-----------------------------------------------------------------------------------*/


add_action( 'widgets_init', 'icy_video_widgets' );

function icy_video_widgets() {
	register_widget( 'icy_Video_Widget' );
}

class icy_video_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function icy_Video_Widget() {

	$widget_ops = array(
		'classname' => 'icy_video_widget',
		'description' => __('A widget that displays your YouTube or Vimeo Video.', 'framework')
	);

	$control_ops = array(
		'width' => 220,
		'height' => 220,
		'id_base' => 'icy_video_widget'
	);

	$this->WP_Widget( 'icy_video_widget', __('Custom Video Widget', 'framework'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters('widget_title', $instance['title'] );
	$embed = $instance['embed'];
	$desc = $instance['desc'];

	echo $before_widget;

	if ( $title )
		echo $before_title . $title . $after_title;

	?>
		
		<div class="icy_video">
		<?php echo $embed ?>
		</div>
		
		<?php if($desc != '') { ?><p class="icy_video_desc"><?php echo $desc ?></p><?php } ?>
	
	<?php

	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags( $new_instance['title'] );
	
	$instance['desc'] = stripslashes( $new_instance['desc']);
	$instance['embed'] = stripslashes( $new_instance['embed']);

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	$defaults = array(
		'title' => 'My Latest Video',
		'embed' => stripslashes( '<iframe src="http://player.vimeo.com/video/7585127?title=0&amp;portrait=0&amp;color=ff9933" width="220" height="220" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'),
		'desc' => '',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e('Embed Code:', 'framework') ?></label>
		<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['embed'] ), ENT_QUOTES)); ?></textarea>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Short Description:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>
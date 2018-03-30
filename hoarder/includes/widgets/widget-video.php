<?php

/*-----------------------------------------------------------------------------------

 	Plugin Name: Custom Video Widget
 	Plugin URI: http://www.themezilla.com
 	Description: A widget that displays your latest video
 	Version: 1.0
 	Author: ThemeZilla
 	Author URI: http://www.themezilla.com
 
-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Create the widget
/*-----------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'zilla_video_widgets' );

function zilla_video_widgets() {
	register_widget( 'zilla_Video_Widget' );
}

/*-----------------------------------------------------------------------------------*/
/*  Widget class
/*-----------------------------------------------------------------------------------*/
class zilla_video_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
function zilla_Video_Widget() {

	/* Widget settings --------------------------------------------------------------*/
	$widget_ops = array(
		'classname' => 'zilla_video_widget',
		'description' => __('A widget that displays your YouTube or Vimeo Video.', 'zilla')
	);

    /* Widget control settings ------------------------------------------------------*/
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'zilla_video_widget'
	);

    /* Create the widget ------------------------------------------------------------*/
	$this->WP_Widget( 'zilla_video_widget', __('Custom Video Widget', 'zilla'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
function widget( $args, $instance ) {
	extract( $args );

	/* Our variables from the widget settings ---------------------------------------*/
	$title = apply_filters('widget_title', $instance['title'] );
	$embed = $instance['embed'];
	$desc = $instance['desc'];

	/* Display widget ---------------------------------------------------------------*/
	echo $before_widget;

	if ( $title ) { echo $before_title . $title . $after_title; }

	echo '<div class="zilla_video">';
    echo $embed;
	echo '</div>';
		
	if($desc != '') {
		echo '<p class="zilla_video_desc">' . $desc . '</p>';
    }
	
	echo $after_widget;
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Strip tags to remove HTML (important for text inputs) ------------------------*/
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	/* Stripslashes for html inputs -------------------------------------------------*/
	$instance['desc'] = stripslashes( $new_instance['desc']);
	$instance['embed'] = stripslashes( $new_instance['embed']);

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
function form( $instance ) {

	/* Set up some default widget settings ------------------------------------------*/
	$defaults = array(
		'title' => 'My Video',
		'embed' => stripslashes( '<iframe src="http://player.vimeo.com/video/25541923?color=c9161f" width="260" height="195" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'),
		'desc' => 'This is my latest video, pretty cool huh!',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); 
	
	/* Build our form ---------------------------------------------------------------*/
	?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e('Embed Code:', 'zilla') ?></label>
		<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['embed'] ), ENT_QUOTES)); ?></textarea>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Short Description:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>
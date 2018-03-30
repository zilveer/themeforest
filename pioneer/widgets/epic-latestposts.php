<?php
/**
 * Plugin Name: Epic - Latest posts
 * Plugin URI: http://epicthemes.net
 * Description: Displays the latest post from a chosen posttype
 * Version: 1.0
 * Author: Epic Media Labs Ltd.
 * Author URI: http://epicmedialab.com */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'epic_latestposts_load_widgets' );

/**
 * Register our widget.
 * 'Epic_Latestposts_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function epic_latestposts_load_widgets() {
	register_widget( 'Epic_Latestposts_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Epic_Latestposts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Epic_Latestposts_Widget() {
		/* Widget settings. */
		$epiclatestpostswidget_ops = array( 'classname' => 'epic', 'description' => __('Displays a list of recent posts', 'epic') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'epiclatestposts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'epiclatestposts-widget', __('Epic - Latest posts', 'epic'), $epiclatestpostswidget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$newscount = $instance['newscount'];
		$myposttype = $instance['myposttype'];
		$showimage = $instance['showimage'];
		
		
		$tmp_post = $post;
		
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		
		
		
		global $post;
		
		
		
		if($myposttype == 'Portfolio'){$setPosttype = 'portfolio';}
		elseif($myposttype == 'Posts'){$setPosttype = 'post';}
				

		$myposts = get_posts('showposts='.$newscount.'&post_type='.$setPosttype.'');
		
		foreach($myposts as $post):
		setup_postdata($post);
		
		$customtitle = get_post_meta($post->ID,'epic_customtitle',true);
				?>
		
		<div class="epic_latestposts">
		<?php if($showimage):?>
		<?php echo epic_image($post->ID,'Micro', 'permalink');?>
		<?php endif;?>
		<h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
		<?php echo get_the_date();?>
		</div>
	
		
		
		<?php
				

		/* After widget (defined by themes). */
		endforeach;
		wp_reset_query();
		
		
		
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['newscount'] = strip_tags( $new_instance['newscount'] );
		$instance['myposttype'] = $new_instance['myposttype'];
		$instance['showimage'] = ( isset( $new_instance['imagedisplay'] ) ? 1 : 0 ); 
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		
		$defaults = array( 'title' => __('Latest posts', 'epic'), 'newscount' => '5', 'myposttype' => 'epicPortfolio', 'showexcerpt' => 'checked', 'showimage' => 'checked' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
?>




		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'epic'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Number of posts:', 'epic'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'newscount' ); ?>" value="<?php echo $instance['newscount']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'myposttype' ); ?>">Post type:</label>
			<select id="<?php echo $this->get_field_id( 'myposttype' ); ?>" name="<?php echo $this->get_field_name( 'myposttype' ); ?>" class="widefat" style="width:100%;">
				
				<option <?php if ( 'Posts' == $instance['myposttype'] ) echo 'selected="selected"'; ?>>Posts</option>
				<option <?php if ( 'Portfolio' == $instance['myposttype'] ) echo 'selected="selected"'; ?>>Portfolio</option>
													
			</select>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['showimage'], true ); ?> id="<?php echo $this->get_field_id( 'imagedisplay' ); ?>" name="<?php echo $this->get_field_name( 'imagedisplay' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'imagedisplay' ); ?>"><?php _e('Show image', 'epic'); ?></label>
		</p>

		
		

	<?php
	}
}

?>
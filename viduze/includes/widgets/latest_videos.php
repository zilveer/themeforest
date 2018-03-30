<?php
/**
 * Plugin Name: CrunchPress Video Widet
 * Author: Nasir Hayat
 * Description: A widget that show latest galleries
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'latest_video_widget' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function latest_video_widget() {
	register_widget( 'latest_videos' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class latest_videos extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function latest_videos() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'cp_recentpost-widget', 'description' => __('A widget that show last posts', 'crunchpress') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'cp_recentpost-widget' );

		/* Create the widget. */
		parent::__construct( 'cp_recentpost-widget', __(THEME_NAME. ' - Latest Videos', 'crunchpress'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('Recent Projects', $instance['title'] );
		$post_cat = $instance['post_cat'];
		if($post_cat == "All"){ $post_cat = ''; }
		$show_num = $instance['show_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		if($title)
			echo $before_title . $title . $after_title;
			
		/* Display the widget title if one was input (before and after defined by themes). */
		wp_reset_query();

	    	$custom_posts = get_posts('post_type=post&showposts='.$show_num.'&orderby=comment_count');
		if( !empty($custom_posts) ){ 
		    echo '<div class="widget-papuler-video">';
			echo "<ul>";
			foreach($custom_posts as $custom_post) { 	
			setup_postdata( $custom_post ); ?> 
		          <li>
                         <a href="<?php echo get_permalink( $custom_post->ID ); ?>">
							<?php
								$thumbnail_id = get_post_thumbnail_id( $custom_post->ID );				
								$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '57x57' );	
								$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
								if( !empty($thumbnail) ){
									echo '<img src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>';
								}else{
								echo '<img style="width:57px; height:57px; " src="' .CP_THEME_PATH_URL.'/images/footer-gallery2.png" width="53px" height="53px" alt="no image"/>';	
								}
							?>
						</a>
                  </li>
				<?php 
			}
			echo "</ul>";
			echo '</div>';
		}
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_cat'] = strip_tags( $new_instance['post_cat'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Latest Videos', 'crunchpress'), 'post_cat' => __('All', 'crunchpress'), 'show_num' => '9');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title :', 'crunchpress'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<!-- Your Name: Text Input -->


		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count :', 'crunchpress'); ?></label>
			<input id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" value="<?php echo $instance['show_num']; ?>" class="width100" />
		</p>

	<?php
	}
}

?>
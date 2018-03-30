<?php
/**
 * Plugin Name: Goodlayers Popular Post
 * Description: A widget that show popular posts( Specified by cat-id ).
 * Version: 1.0
 * Author: Sittipol Sunthornpiyakul
 * Author URI: http://www.saintdo.me
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'popular_post_widget' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function popular_post_widget() {
	register_widget( 'Popular_Post' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Popular_Post extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  Popular_Post() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'popularpost-widget', 'description' => __('A widget that show popular posts', 'gdl_back_office') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'popularpost-widget' );

		/* Create the widget. */
		parent::__construct('popularpost-widget', __('Popular Posts (Goodlayers)', 'gdl_back_office'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('Popular Posts', $instance['title'] );
		$show_num = $instance['show_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
			echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
		}

		/* Display the widget title if one was input (before and after defined by themes). */

		$custom_posts = get_posts('showposts='.$show_num.'&suppress_filters=0&orderby=comment_count');
		if( !empty($custom_posts) ){ 
			echo "<div class='gdl-recent-post-widget'>";
			foreach($custom_posts as $custom_post) { 	
				?>
				<div class="recent-post-widget">
					<?php
						$thumbnail_id = get_post_thumbnail_id( $custom_post->ID );				
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '50x50' );	
						$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
						if( !empty($thumbnail) ){
							echo '<div class="recent-post-widget-thumbnail">';
							echo '<a href="' . get_permalink( $custom_post->ID ) . '">';
							echo '<img src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>';
							echo '</a>';
							echo '</div>';
						}
					?>				
					<div class="recent-post-widget-context">
						<div class="recent-post-widget-title no-cufon">
							<a href="<?php echo get_permalink( $custom_post->ID ); ?>"> 
								<?php echo $custom_post->post_title; ?> 
							</a>
						</div>
						<div class="recent-post-widget-comment-num post-info-color">
							<?php 
								$comments_num = get_comments_number( $custom_post->ID ); 
							if( $comments_num > 1 ){
								echo  $comments_num . __(' Comments','gdl_front_end');
							}else if( $comments_num == 1 ){
								echo __('1 Comment','gdl_front_end');
							}else{
								echo __('No Responses.','gdl_front_end');
							}
							
							?>   
						</div>
					</div>
					<div class="clear"></div>
				</div>						
				<?php 
				
			}
			echo "</div>";
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
		$defaults = array( 'title' => __('Popular Posts Widget', 'gdl_back_office'), 'post_cat' => __('0', 'gdl_back_office'), 'show_num' => '3');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<!-- Your Name: Text Input -->

		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" value="<?php echo $instance['show_num']; ?>" class="width100" />
		</p>

	<?php
	}
}

?>
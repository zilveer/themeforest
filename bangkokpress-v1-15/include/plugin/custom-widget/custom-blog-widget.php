<?php
/**
 * Plugin Name: Goodlayers Recent Post
 * Description: A widget that show recent posts( Specified by cat-id ).
 * Version: 1.0
 * Author: Sittipol Sunthornpiyakul
 * Author URI: http://www.goodlayers.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'recent_post_widget' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function recent_post_widget() {
	register_widget( 'Recent_Post' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Recent_Post extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Recent_Post() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'recentpost-widget', 'description' => __('A widget that show last posts', 'gdl_back_office') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recentpost-widget' );

		/* Create the widget. */
		parent::__construct('recentpost-widget', __('Recent Posts (Goodlayers)', 'gdl_back_office'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('Recent Posts', $instance['title'] );
		$post_cat = $instance['post_cat'];
		if($post_cat == "All"){ $post_cat = ''; }
		$show_num = $instance['show_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
			echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
		}
			
		/* Display the widget title if one was input (before and after defined by themes). */
		$custom_posts = get_posts('showposts='.$show_num.'&suppress_filters=0&cat='.get_cat_ID($post_cat));
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
						<div class="recent-post-widget-date post-info-color">
							<?php echo get_the_time('M d, Y', $custom_post->ID); ?>
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
		$defaults = array( 'title' => __('Recent Posts Widget', 'gdl_back_office'), 'post_cat' => __('All', 'gdl_back_office'), 'show_num' => '3');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title :', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_cat' ); ?>"><?php _e('Category :', 'gdl_back_office'); ?></label>		
			<select name="<?php echo $this->get_field_name( 'post_cat' ); ?>" id="<?php echo $this->get_field_id( 'post_cat' ); ?>">
				
			<?php 	
			$category_list = get_category_list( 'category' ); 
			foreach($category_list as $category ){
			?>
				<option value="<?php echo $category; ?>" <?php if (  $instance['post_cat'] == $category ) echo ' selected="selected"'; ?>><?php echo $category; ?></option>				
			<?php } ?>	
			</select> 
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count :', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" value="<?php echo $instance['show_num']; ?>" class="width100" />
		</p>

	<?php
	}
}

?>
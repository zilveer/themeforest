<?php
/**
 * Plugin Name: Goodlayers Flickr Widget
 * Description: A widget that show recent posts( Specified by cat-id ).
 * Version: 1.0
 * Author: Sittipol Sunthornpiyakul
 * Author URI: http://www.saintdo.me
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'flickr_widget' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function flickr_widget() {
	register_widget( 'flickr' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class flickr extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function flickr() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'flickr-widget', 'description' => __('A widget that show last flickr photo streams', 'gdl_back_office') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr-widget' );

		/* Create the widget. */
		parent::__construct('flickr-widget', __('Flickr (Goodlayers)', 'gdl_back_office'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('Flickr Widget', $instance['title'] );
		$id = $instance['id'];
		$how = $instance['how'];
		$show_num = $instance['show_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		if($title)
			echo $before_title . $title . $after_title;
		/* Display the widget title if one was input (before and after defined by themes). */
		?>
			
			<div class="flickr-widget">
			<?php echo'<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$show_num.'&amp;display='.$how.'&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$id.'"></script>'; ?>
			</div>
		<?php 
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
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );
		$instance['how'] = strip_tags( $new_instance['how'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Flickr Widget', 'gdl_back_office'), 'id' => __('0', 'gdl_back_office'), 'show_num' => '6', 'how' => 'lastest');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Flickr id', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" class="width100" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" value="<?php echo $instance['show_num']; ?>" class="width100" />
			<label><?php _e('Max is "10"', 'gdl_back_office'); ?></label>
		</p>
		
        <p>
			<label for="<?php echo $this->get_field_id( 'how' ); ?>"><?php _e('What pictures to display','gdl_back_office'); ?></label><br />
			<select id="<?php echo $this->get_field_id( 'how' ); ?>" name="<?php echo $this->get_field_name( 'how' ); ?>" class="width100">
				<option <?php if ( 'latest' == $instance['how'] ) echo 'selected="selected"'; ?> value="latest">latest</option>            
				<option <?php if ( 'random' == $instance['how'] ) echo 'selected="selected"'; ?> value="random">random</option>                  
			</select>
		</p>     

	<?php
	}
}

?>
<?php
/**
 * Flickr Photos Widget
 *
 * @description: A simple widget to display your flickr photos.
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// The widget class
class sd_flickr_widget extends WP_Widget {
	
	// Widget Settings
	function sd_flickr_widget() {
	
		$widget_ops = array( 'classname' => 'sd_flickr_widget', 'description' => __( 'A widget that displays your flickr photos.', 'sd-framework' ) );
		$control_ops = "";
		parent::__construct( 'sd_flickr_widget', __( 'Flickr Photos', 'sd-framework' ), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before the widget
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
		echo $before_title . $title . $after_title;
		
		// Display Flickr Photos
		?>

<div class="sd-flickr"> 
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo esc_attr( $instance['how_many'] ); ?>&amp;display=<?php echo esc_attr( $instance['display'] ); ?>&amp;size=s&amp;layout=x&amp;source=<?php echo esc_attr( $instance['type'] ); ?>&amp;<?php echo esc_attr( $instance['type'] ); ?>=<?php echo esc_attr( $instance['flickrID'] ); ?>"></script> 
</div>
<?php 
		// After the widget
		echo $after_widget;
	}
	// Update the widget		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];
		$instance['how_many'] = $new_instance['how_many'];

		return $instance;
	}

	// Widget panel settings
	function form( $instance ) {

	// Default widgets settings
		$defaults = array(
			'title' => 'Photostream',
			'flickrID' => '52821721@N00',
			'type' => 'user',
			'how_many' => '6',
			'display' => 'random',
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

<!-- Widget Title: Text Input -->
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">
		<?php _e('Title:', 'sd-framework') ?>
	</label>
	<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<!-- Flickr ID: Text Input -->
<p>
	<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>">
		<?php _e('Flickr ID:', 'sd-framework') ?>
		(<a href="http://idgettr.com/">idGettr</a>)</label>
	<input class="widefat" type="text"  id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
</p>

<!-- Type: Select Box -->
<p>
	<label for="<?php echo $this->get_field_id( 'type' ); ?>">
		<?php _e('Type (user or group):', 'sd-framework') ?>
	</label>
	<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
		<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
		<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
	</select>
</p>

<!-- Display: Select Box -->
<p>
	<label for="<?php echo $this->get_field_id( 'display' ); ?>">
		<?php _e('Display (random or latest):', 'sd-framework') ?>
	</label>
	<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
		<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
		<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
	</select>
</p>

<!-- Number of items: Text Input -->
<p>
	<label for="<?php echo $this->get_field_id( 'how_many' ); ?>">
		<?php _e('Number of images to display:', 'sd-framework') ?>
	</label>
	<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'how_many' ); ?>" name="<?php echo $this->get_field_name( 'how_many' ); ?>" value="<?php echo $instance['how_many']; ?>" />
</p>
<?php
	}
}
// Register and load the widget
function sd_flickr_widget() {
	register_widget( 'sd_flickr_widget' );
}
add_action( 'widgets_init', 'sd_flickr_widget' );
?>

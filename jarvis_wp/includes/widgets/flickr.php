<?php

class widget_flickr extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		$widget_ops = array('description' => __('Display your latest Flickr Photos','rocknrolla') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr' );
		WP_Widget::__construct( 'flickr', __('RocknRolla Flickr','rocknrolla'), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );

		$username = $instance['username'];
		$pics = $instance['pics'];
		
		// ------
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		echo '<div id="flickr_tab" class="clearfix">';
		echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$pics.'&display=latest&size=s&layout=x&source=user&user='.$username.'"></script>';
		echo '</div>';

		echo $after_widget;
		// ------
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['pics'] = strip_tags( $new_instance['pics'] );

		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array( 'title' => 'Flickr Widget', 'pics' => '9', 'username' => '' ); // Default Values
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Flickr ID:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" /><br /><a href="<?php echo esc_url_raw( 'http://idgettr.com/' ); ?>" target="_blank"><?php _e('Flickr idGettr','rocknrolla'); ?></a>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'pics' ); ?>">Number of Photos:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'pics' ); ?>" name="<?php echo $this->get_field_name( 'pics' ); ?>" value="<?php echo $instance['pics']; ?>" />
		</p>
		
    <?php }
}

// Add Widget
function widget_flickr_init() {
	register_widget('widget_flickr');
}
add_action('widgets_init', 'widget_flickr_init');

?>
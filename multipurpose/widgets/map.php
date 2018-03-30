<?php
add_action('widgets_init', 'map_widget_register');

function map_widget_register() {
	register_widget('Map_Widget');
}

class Map_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'map_widget',
			__('MultiPurpose Map Widget', 'multipurpose'),
			array('description' => __('Widget with a Google map inside', 'multipurpose'))
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters('widget_title', $instance['title']); 
	    $location = $instance['location']; 
	    $addresses = json_encode(explode("\n", $location));

	    echo $args['before_widget'];  
	    if (!empty($title)) {
	    	echo $args['before_title'] . $title . $args['after_title'];  
	    }  
	    if (!empty($location)) {
	    	echo '<div class="gmap" id="map" data-addresses=\'' . $addresses . '\'></div>';
	    }  
	    echo $args['after_widget'];  
	}

	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('Map', 'multipurpose');
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'multipurpose'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php 
		if (isset($instance['location'])) {
			$location = $instance['location'];
		} else {
			$location = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('location'); ?>"><?php _e('Location (one address per line):', 'multipurpose'); ?></label> 
		<textarea class="widefat" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" rows="5" cols="30"><?php echo esc_attr($location); ?></textarea>
		</p>
		<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['location'] = ( ! empty( $new_instance['location'] ) ) ? strip_tags( $new_instance['location'] ) : '';
		return $instance;
	}

	
}






?>
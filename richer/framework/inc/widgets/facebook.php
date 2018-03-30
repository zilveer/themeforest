<?php

class widget_facebook extends WP_Widget { 
	
	// Widget Settings
	function widget_facebook() {
		$widget_ops = array('description' => __('Display Facebook Like Box', 'richer') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'facebook' );
		$this->__construct( 'facebook', __('richer-Facebook', 'richer'), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$page_url = $instance['page_url'];
		$width = $instance['width'];
		$color_scheme = $instance['color_scheme'];
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$show_stream = isset($instance['show_stream']) ? 'true' : 'false';
		$show_header = isset($instance['show_header']) ? 'true' : 'false';
		$height = '65';
		
		if($show_faces == 'true') {
			$height = '273';
		}
		
		if($show_stream == 'true') {
			$height = '600';
		}
		
		if($show_header == 'true') {
			$height = '600';
		}
		
		// ------
		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}
		
		if($page_url): 
		$protocol = is_ssl() ? 'https' : 'http'; ?>
		<iframe src="<?php echo $protocol; ?>://www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($page_url); ?>&amp;width=<?php echo $width; ?>&amp;colorscheme=<?php echo $color_scheme; ?>&amp;show_faces=<?php echo $show_faces; ?>&amp;stream=<?php echo $show_stream; ?>&amp;header=<?php echo $show_header; ?>&amp;height=<?php echo $height; ?>&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width; ?>px; height: <?php echo $height; ?>px;" allowTransparency="true"></iframe>
		<?php endif;
		echo $after_widget;
		// ------
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['page_url'] = $new_instance['page_url'];
		$instance['width'] = $new_instance['width'];
		$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['show_stream'] = $new_instance['show_stream'];
		$instance['show_header'] = $new_instance['show_header'];

		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => 'Find us on Facebook', 'page_url' => '', 'width' => '220', 'color_scheme' => 'light', 'show_faces' => 'on', 'show_stream' => false, 'show_header' => false);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
			<input type="text" class="widefat" style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('page_url')); ?>">Facebook Page URL:</label>
			<input type="text" class="widefat" style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('page_url')); ?>" name="<?php echo esc_attr($this->get_field_name('page_url')); ?>" value="<?php echo esc_attr($instance['page_url']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('width')); ?>">Width:</label>
			<input type="text" class="widefat" style="width: 60px;" id="<?php echo esc_attr($this->get_field_id('width')); ?>" name="<?php echo esc_attr($this->get_field_name('width')); ?>" value="<?php echo esc_attr($instance['width']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('color_scheme')); ?>">Color Scheme:</label> 
			<select id="<?php echo esc_attr($this->get_field_id('color_scheme')); ?>" name="<?php echo esc_attr($this->get_field_name('color_scheme')); ?>" class="widefat" style="width:100%;">
				<option <?php if ('light' == $instance['color_scheme']) echo 'selected="selected"'; ?>>light</option>
				<option <?php if ('dark' == $instance['color_scheme']) echo 'selected="selected"'; ?>>dark</option>
			</select>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_faces')); ?>" name="<?php echo esc_attr($this->get_field_name('show_faces')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('show_faces')); ?>">Show faces</label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_stream'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_stream')); ?>" name="<?php echo esc_attr($this->get_field_name('show_stream')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('show_stream')); ?>">Show stream</label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_header'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_header')); ?>" name="<?php echo esc_attr($this->get_field_name('show_header')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('show_header')); ?>">Show facebook header</label>
		</p>
		
    <?php }
}

// Add Widget
function widget_facebook_init() {
	register_widget('widget_facebook');
}
add_action('widgets_init', 'widget_facebook_init');

?>
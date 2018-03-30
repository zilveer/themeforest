<?php

// Connect With Us: data provided through theme options
class TB_Connect_With_Us extends WP_Widget {
	
	function TB_Connect_With_Us() {
		$widget_ops = array('classname' => 'tb_about_us', 'description' => __( 'All about campaign and your team', 'the-cause') );		
		$this->WP_Widget('TB_Connect_With_Us', __('TB Connect With Us', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Connect With Us', 'the-cause') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		$titleIndex = 1;
		
		while ($titleIndex < 5) {
			$currentTitleS = 'tb_cwu_title' . $titleIndex;
			$currentTitle = get_option($currentTitleS);
			
			if (!empty($currentTitle)) {
				$currentImg = get_option('tb_cwu_photo' . $titleIndex);
				$currentURL = get_option('tb_cwu_url' . $titleIndex);
				$currentText = get_option('tb_cwu_text' . $titleIndex);
				echo '<div class="cwu"><div>';
				
				if ($currentImg) {
					echo '<div>';
					echo '<img src="' . $currentImg . '" alt="' . $currentTitle . '">';
					echo '</div>';
				}
				
				echo '<h4>' . $currentTitle . '</h4>';
				
				if ($currentText) {
					echo '<p>' . $currentText . '</p>';
				}
				
				if ($currentURL) {
					echo '<a href="' . esc_url($currentURL) . '">' . $currentTitle . '</a>';
				}				
				
				echo '</div></div>';
			}
			
			$titleIndex++;
		}
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Connect With Us' ) );
		$title = strip_tags($instance['title']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
	<?php
	}
}

function tb_register_connect_with_us() {
	
	register_widget('TB_Connect_With_Us');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_connect_with_us', 1);

?>
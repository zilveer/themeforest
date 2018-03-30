<?php

// About Us: data provided through theme options
class TB_About_Us extends WP_Widget {
	
	function TB_About_Us() {
		$widget_ops = array('classname' => 'tb_about_us', 'description' => __( 'All about campaign and your team', 'the-cause') );		
		$this->WP_Widget('TB_About_Us', __('TB About Us', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('About Us', 'the-cause') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

        $aboutUs = get_option('tb_about_us');
		$aboutUsId = get_option('tb_page_about_us');
		
		if (!empty($aboutUs)) {
			
			echo wpautop(stripslashes($aboutUs));
			
						
			if (!empty($aboutUsId)) {
				echo '<p class="nomargin">';
				echo '<a href="' . get_permalink($aboutUsId) . '">Read more &raquo;</a>';
				echo '</p>';
			}		
			
		}
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => 'About Us' ) );
		$title = strip_tags($instance['title']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
	<?php
	}
}

function tb_register_about_us() {
	
	register_widget('TB_About_Us');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_about_us', 1);

?>
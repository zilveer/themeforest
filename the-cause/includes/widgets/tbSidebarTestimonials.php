<?php

class TB_Sidebar_Testimonials extends WP_Widget {
	
	function TB_Sidebar_Testimonials() {
		$widget_ops = array('classname' => 'tb_sidebar_testimonials', 'description' => __( 'Displays testimonials.', 'the-cause') );
		$this->WP_Widget('TB_Sidebar_Testimonials', __('TB Sidebar Testimonials', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Quotes', 'the-cause') : $instance['title'], $instance, $this->id_base);
	  	
		$display = (int) strip_tags($instance['display']);

		$args = array();
		
		$args['post_type'] = 'testimonial';
		$args['post_status'] = 'publish';
		$args['posts_per_page'] = 1;
		if ($display) { $args['orderby'] = 'rand'; }
		
		$tbQuery = new WP_Query($args);
		
		?>

    	<?php if ($tbQuery->have_posts()) { ?>
		
		
		<div class="widget box">
		
			<?php if (!$title) $title = 'Quotes'; ?>
			<h3><?php echo $title; ?></h3>
		
			<?php while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>
				
				<div class="quote">
				<?php the_content(); ?>
	            </div>
				
			<?php endwhile; ?>
			
		</div>  
	    
	    <?php } ?>
		
		<div class="clear nodisplay"></div>
	    
	    <?php wp_reset_postdata();
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['display'] = (int) strip_tags($new_instance['display']);
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title'=>'Quotes', 'display' => 0 ) );
		$display =  (int) strip_tags($instance['display']);
		$title =  strip_tags($instance['title']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>"<?php checked( $display ); ?> value="1" />
            <label for="<?php echo $this->get_field_id('display'); ?>"><?php _e( 'Random order', 'the-cause' ); ?></label>
		</p>
	<?php
	}
}

function tb_register_sidebar_testimonials() {

	register_widget('TB_Sidebar_Testimonials');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_sidebar_testimonials', 1);

?>
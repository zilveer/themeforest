<?php

// Category: simple widget
class TB_Categories extends WP_Widget {
	
	function TB_Categories() {
		$widget_ops = array('classname' => 'tb_categories', 'description' => __( 'Simple widget: shows categories', 'the-cause') );		
		$this->WP_Widget('TB_Categories', __('TB Categories', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('About Us', 'the-cause') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		$number  = (int) $instance['number'];
		$count  = (int) $instance['count'];
		
		$args = array('echo' => 0, 'show_count' => 1, 'title_li' => '');
		
		if ($number) $args['number '] = $number ;
		if ($count) $args['orderby'] = 'count';
		
		echo '<ul class="widgetList">';
		echo str_replace(')</li>', ' posts)</span></li>', str_replace('(1)', '(1 post)</span>', str_replace('</a> ', '</a> <span>', str_replace("\n", "", wp_list_categories( $args )))));
		echo '</ul>';
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['number'] = (int) strip_tags($new_instance['number']);
		$instance['count'] = (int) strip_tags($new_instance['count']);
		$instance['title'] =  strip_tags($new_instance['title']);
		
		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'number' => 3, 'title'=>'Categories', 'count' => 0 ) );
		$number = (int) strip_tags($instance['number']);
		$count =  (int) strip_tags($instance['count']);
		$title =  strip_tags($instance['title']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Categories:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo absint($number); ?>" />
        </p>
            
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> value="1" />
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Order by count of posts?', 'the-cause' ); ?></label></p>
        </p>
	<?php
	}
}

function tb_register_categories() {
	
	register_widget('TB_Categories');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_categories', 1);

?>
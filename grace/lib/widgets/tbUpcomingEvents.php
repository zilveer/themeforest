<?php

// Latest posts with thumbs
class TB_Upcoming_Events extends WP_Widget {
	
	function TB_Upcoming_Events() {
		$widget_ops = array('classname' => 'tb_upcoming_events', 'description' => __( 'Upcoming events', 'grace') );		
		$this->WP_Widget('TB_Upcoming_Events', __('ThemeBlossom: Upcoming Events', 'grace'), $widget_ops);	
	}
	
	function widget( $args, $instance ) {
		
		extract($args);
		
		$number_of_posts  = (int) $instance['number_of_posts'];
        
       	echo $before_widget;
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Upcoming Events', 'grace') : $instance['title'], $instance, $this->id_base);		
		if ( $title ) echo $before_title . $title . $after_title;

		// use WP timezone	
		// $timezone = get_option('timezone_string');
		
		// if (isset($timezone) && $timezone) date_default_timezone_set($timezone);
			
		$today = strtotime("today");
		
		$args = array();
		
		$args['post_type'] = TB_EVENT_CPT;
		$args['post_status'] = 'publish';
		$args['posts_per_page'] = $number_of_posts;
		$args['no_found_rows'] = true;
		$args['order'] = 'ASC';
		$args['orderby'] = 'meta_value';
		$args['meta_key'] = '_tb_start_date';
		$args['meta_query'] = array(
			array(
				'key'		=> '_tb_start_date',
				'value'		=> $today,
				'compare'	=> '>',
				'type'		=> 'numeric'
			)
		);

		$events = new WP_Query($args);
		
		if ($events->have_posts()) { ?>
        
		<?php  while ($events->have_posts()) : $events->the_post(); ?>
        <?php
		$postID = get_the_ID();
		$postTitle = get_the_title();
		$postPermalink = get_permalink();
		$postCustom = get_post_custom();

		$startDate = isset($postCustom['_tb_start_date'][0]) ? $postCustom['_tb_start_date'][0] : FALSE;
		
		?>        
		<div class="listPost">
			
			<?php			
			if ($startDate) {
			?>
				
				<div class="tb_date_box">
					<span class="day"><?php echo date('d', $startDate); ?></span>
					<span class="month"><?php echo date('M', $startDate); ?></span>
				</div>
				
			<?php } ?>
			
        	<h4><a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a></h4>
							
			<?php
			if ($startDate) {
				echo '<p class="widget-info-box">' . date_i18n(get_option('date_format'), $startDate) . '</p>';
			}			
			?>
			
			<a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>" class="fulld"><?php echo $postTitle; ?></a>
			
        </div>
		<?php endwhile; ?>
		
		<?php
		
		} else {
		
		?>      
		<div class="listPost">
			
        	<p>No upcoming events scheduled...</p>
			
		</div>
		
		<?php
		
		}
		
		wp_reset_postdata();
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['number_of_posts'] = (int) strip_tags($new_instance['number_of_posts']);
		$instance['title'] =  strip_tags($new_instance['title']);
		
		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'number_of_posts' => 2, 'title'=>'Upcoming Events' ) );
		$number_of_posts = (int) strip_tags($instance['number_of_posts']);
		$title =  strip_tags($instance['title']);
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('Number of events:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('number_of_posts'); ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" type="text" value="<?php echo absint($number_of_posts); ?>" />
        </p>
	<?php
	}
}

function tb_register_upcoming_events() {
	
	register_widget('TB_Upcoming_Events');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_upcoming_events', 1);

?>
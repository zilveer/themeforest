<?php

// Latest posts with thumbs
class TB_Upcoming_Events extends WP_Widget {
	
	function TB_Upcoming_Events() {
		$widget_ops = array('classname' => 'TB_Upcoming_Events', 'description' => __( 'Upcoming events', 'the-cause') );		
		$this->WP_Widget('TB_Upcoming_Events', __('TB Upcoming Events', 'the-cause'), $widget_ops);	
	}
	
	function widget( $args, $instance ) {
		
		extract($args);
		
		$number_of_posts  = (int) $instance['number_of_posts'];
        
       	echo str_replace('widget', 'widget latestPosts postList', $before_widget);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Upcoming Events', 'the-cause') : $instance['title'], $instance, $this->id_base);		
		if ( $title ) echo $before_title . $title . $after_title;

		$todayArray = getdate();
		$today = $todayArray['year'] . '-';
		$today .= str_pad($todayArray['mon'], 2, 0, STR_PAD_LEFT) . '-';
		$today .= str_pad($todayArray['mday'], 2, 0, STR_PAD_LEFT);
		
		$args = array();
		
		$args['post_type'] = 'event';
		$args['post_status'] = 'publish';
		$args['posts_per_page'] = $number_of_posts;
		$args['no_found_rows'] = true;
		$args['order'] = 'ASC';
		$args['orderby'] = 'meta_value';
		$args['meta_key'] = '_start_date';
		$args['meta_query'] = array(
			array(
				'key'		=> '_start_date',
				'value'		=> $today,
				'compare'	=> '>'
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

		$location = $postCustom['_location'][0];
		$startDate = $postCustom['_start_date'][0];
		$time = $postCustom['_time'][0];
		
		?>        
		<div class="listPost">
			
        	<h4><a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a></h4>
			
			<p>
			
			<?php
			if ($location) echo "LOCATION: <strong>$location</strong><br>";
			
			if ($startDate) {
				$startDateArray = tb_get_date($startDate);
				echo 'START DATE: <strong>' . $startDateArray['monthname'] . ' ' . $startDateArray['day'] . $startDateArray['sufix'] . ', ' . $startDateArray['year'] . '</strong><br>';
			}
			
			if ($time) {
				echo 'TIME: <strong>' . date("g:ia", strtotime($time)) . '</strong><br>';
			}
			?>
			
			</p>
			
			<p class="center">
				<a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>" class="tinyButton roundButton">Details</a> <a href="<?php tb_write_link('tb_page_contact') ?>?msgSubject=<?php echo $postID; ?>" class="tinyButton roundButton">Attend</a>
			</p>
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
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('Number of events:', 'the-cause'); ?></label>
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
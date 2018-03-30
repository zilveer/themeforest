<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_events");'));

class OT_events extends WP_Widget {
	function OT_events() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Upcoming Events');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
		 $count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php  printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php  printf ( __( 'Count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$counter=1;
		if(!$count) $count=3;
		$now = time();
		
		$my_query = new WP_Query(
			array(
				'post_type' => 'events-item', 
				'posts_per_page' => $count, 
				'order' => 'ASC',
				'orderby'	=> 'meta_value_num',
				'meta_key'	=> THEME_NAME.'_datepicker',
				'meta_query' => array(
				    array(
				        'key' => THEME_NAME.'_datepicker',
				        'value'   => $now,
				        'compare'   => '>='
				    )
				),
			)
		); 


		
        ?>
        <?php echo $before_widget; ?>
			<?php if($title) echo $before_title.$title.$after_title; ?>
			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<?php $date = get_post_meta ($my_query->post->ID, THEME_NAME."_datepicker", true ); ?>
				<div class="widget-event">
					<a href="<?php the_permalink();?>" class="event-wdget-date left">
						<strong><?php echo date("d",$date);?></strong>
						<span><?php echo date("M",$date);?></span>
					</a>
					<div class="event-content">
						<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<div class="article-icons">
							<span class="article-icon"><span class="icon-text">&#128340;</span><?php echo date("F d, Y, H:i",$date);?></span>
						</div>
						<a href="<?php the_permalink();?>" class="button-link"><?php _e("View More Info" , THEME_NAME);?><span class="icon-text">&#9656;</span></a>
					</div>
				</div>
			<?php $counter++; ?>
			<?php endwhile; ?>
			<?php endif; ?>	
		<?php echo $after_widget; ?>	
        <?php
	}
}
?>

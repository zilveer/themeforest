<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_latest_posts");'));

class DF_latest_posts extends WP_Widget {
	function DF_latest_posts() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Latest Posts');	
	}

	function form($instance) {

		 $title = esc_attr($instance['title']);
		 $count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

			
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Post count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

		
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

		$args=array(
			'posts_per_page'=> $count
		);
		$the_query = new WP_Query($args);
		$counter = 1;
		
		$totalCount = $the_query->found_posts;
		
		$blogID = get_option('page_for_posts');
		

?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
				<ul class="latest-posts">
					<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<?php $image = get_post_thumb($the_query->post->ID,50,50); ?>	
                    <!-- Post -->
                    <li>
						<a href="<?php the_permalink();?>"> <img src="<?php echo $image['src'];?>" alt="<?php the_title();?>"></a>
                        <div class="meta">
                            <h4>
								<a href="<?php the_permalink();?>"><?php the_title();?></a>
							</h4>
								<small><?php echo get_the_date("d M, Y");?></small>
                        </div>
                    </li>
					<?php endwhile; else: ?>
						<p><?php  _e( 'No posts where found' , THEME_NAME);?></p>
					<?php endif; ?>
				</ul>
	<?php echo $after_widget; ?>
		
	
      <?php
	}
}
?>

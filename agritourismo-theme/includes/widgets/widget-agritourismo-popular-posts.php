<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_popular_posts");'));

class OT_popular_posts extends WP_Widget {
	function OT_popular_posts() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Popular Posts');	
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
			'posts_per_page' => $count,
			'order' => 'DESC',
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> THEME_NAME.'_post_views_count',
			'post_type'=> 'post'
		);

		$the_query = new WP_Query($args);
		$counter = 1;
		
		$totalCount = $the_query->found_posts;
		
		$blogID = get_option('page_for_posts');
		

?>		
		<?php echo $before_widget; ?>
			<?php if($title) echo $before_title.$title.$after_title; ?>
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php 
					$image = get_post_thumb($the_query->post->ID,78,78); 
				?>
					<div class="widget-article <?php if($image['show']!=true) { ?> without-photo<?php } ?>">
						<?php if($image['show']==true) { ?>
							<div class="article-photo">
								<a href="<?php the_permalink();?>" class="photo-border-1">
									<img src="<?php echo $image["src"];?>" alt="<?php the_title();?>" />
								</a>
							</div>
						<?php } ?>
						<div class="article-content">
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<div class="article-icons">
								<?php if ( comments_open() ) { ?>
									<a href="<?php the_permalink();?>#comments" class="article-icon">
										<span class="icon-text">&#59160;</span><?php comments_number("0","1","%"); ?>
									</a>
								<?php } ?>
								<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" class="article-icon">
									<span class="icon-text">&#128340;</span><?php the_time("F d, Y");?>
								</a>
							</div>
							<a href="<?php the_permalink();?>" class="button-link"><?php _e("Read More", THEME_NAME);?><span class="icon-text">&#9656;</span></a>
						</div>
					</div>
				<?php endwhile; else: ?>
					<p><?php  _e( 'No posts where found' , THEME_NAME);?></p>
				<?php endif; ?>

		
		<?php echo $after_widget; ?>
		
	
      <?php
	}
}
?>

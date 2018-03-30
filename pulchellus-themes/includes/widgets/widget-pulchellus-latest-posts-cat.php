<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_latest_posts_cat");'));

class DF_latest_posts_cat extends WP_Widget {
	function DF_latest_posts_cat() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Latest Posts by Categories');	
	}

	function form($instance) {
		 $cat = esc_attr($instance['cat']);
		 $title = esc_attr($instance['title']);
		 $count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

			
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
			<?php
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'taxonomy'                 => 'category');
				$args = get_categories( $args ); 
			?> 	
			<select name="<?php echo $this->get_field_name('cat'); ?>" style="width: 100%; clear: both; margin: 0;">
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo $ar->cat_name; ?>" <?php if($ar->cat_name==$cat)  {echo 'selected="selected"';} ?>><?php echo $ar->cat_name; ?></option>
				<?php } ?>
			</select>
		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['cat'] = strip_tags($new_instance['cat']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$cat = $instance['cat'];
		$category_id = get_cat_ID($cat);
		$args=array(
			'cat'=> $category_id,
			'posts_per_page'=> $count
		);
		
		$the_query = new WP_Query($args);
		$counter = 1;
		

		

?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
				<ul class="latest-posts">
					<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<?php $image = get_post_thumb($the_query->post->ID,50,50); ?>	
                    <!-- Post -->
                    <li>
                        <a href="<?php the_permalink();?>"><img src="<?php echo $image['src'];?>" alt="<?php the_title();?>"></a>
                        <div class="meta">
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
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

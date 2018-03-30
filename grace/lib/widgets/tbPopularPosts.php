<?php

// Popular posts
class TB_Popular_Posts extends WP_Widget {
	
	function TB_Popular_Posts() {
		$widget_ops = array('classname' => 'tb_popular_posts', 'description' => __( 'Popular posts with thumbnails', 'grace') );		
		$this->WP_Widget('TB_Popular_Posts', __('ThemeBlossom: Popular Posts', 'grace'), $widget_ops);	
	}
	
	function widget( $args, $instance ) {
		
		extract($args);
		
		$number_of_posts  = (int) $instance['number_of_posts'];
		$number_of_words  = (int) $instance['number_of_words'];

		$popularPosts = new WP_Query(array('posts_per_page' => $number_of_posts, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true,	'orderby' => 'comment_count', 'order' => DESC));
		
		if ($popularPosts->have_posts()) : ?>
        
		<?php
        echo $before_widget;
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Posts', 'grace') : $instance['title'], $instance, $this->id_base);		
		if ( $title ) echo $before_title . $title . $after_title;
		?>
        
		<?php  while ($popularPosts->have_posts()) : $popularPosts->the_post(); ?>
        <?php
		$postID = get_the_ID();
		$postTitle = get_the_title($postID);		
		$postExcerpt = tb_max_words(str_replace("<p>", "", str_replace("</p>", "", apply_filters('wp_trim_excerpt', get_the_excerpt()))), $number_of_words);
		$postPermalink = get_permalink($postID);
		?>        
		<div class="listPost">
		
        	<?php if (has_post_thumbnail()) { ?>
        	<a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>">
			<?php echo get_the_post_thumbnail($postID, 'thumbnail', array('class' => 'imageBorder alignleft tb_widget_image')); ?>
			</a>
            <?php } ?>
			
        	<h4><a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a></h4>
                        
            <?php if ($postExcerpt) {echo $postExcerpt;} ?>
        </div>
		<?php endwhile; ?>
		
		<?php
		
		endif;
		
		wp_reset_postdata();
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['number_of_posts'] = (int) strip_tags($new_instance['number_of_posts']);
		$instance['number_of_words'] = (int) strip_tags($new_instance['number_of_words']);
		$instance['title'] =  strip_tags($new_instance['title']);
		
		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'number_of_posts' => 2, 'title'=>'Popular Posts', 'number_of_words' => 10 ) );
		$number_of_posts = (int) strip_tags($instance['number_of_posts']);
		$title =  strip_tags($instance['title']);
		$number_of_words = (int) strip_tags($instance['number_of_words']);
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('Number of Posts:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('number_of_posts'); ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" type="text" value="<?php echo absint($number_of_posts); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('number_of_words'); ?>"><?php _e('Number of words:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('number_of_words'); ?>" name="<?php echo $this->get_field_name('number_of_words'); ?>" type="text" value="<?php echo absint($number_of_words); ?>" />
        </p>
	<?php
	}
}

function tb_register_popular_posts() {
	
	register_widget('TB_Popular_Posts');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_popular_posts', 1);

?>
<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_latest_comments");'));

class DF_latest_comments extends WP_Widget {
	function DF_latest_comments() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Latest Comments');	
	}

	function form($instance) {

		 $title = esc_attr($instance['title']);
		 $count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

			
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Comment count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

		
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
				<ul class="latest-comments">
						<?php
							$args =	array(
								'status' => 'approve', 
								'order' => 'DESC',
								'number' => $count
							);	
											
							$comments = get_comments($args);
							$totalCount = count($comments);
							$counter = 1;
										
							foreach($comments as $comment) {
							if($comment->user_id && $comment->user_id!="0") {
								$authorName = get_the_author_meta('display_name',$comment->user_id );	
							} else {
								$authorName = $comment->comment_author;
							}		
				
						?>
                    <!-- Post -->
                    <li>
                        <a href="<?php echo get_page_link($comment->comment_post_ID);?>#comment-<?php echo $comment->comment_ID;?>">
							<img src="<?php echo get_gravatar($comment->comment_author_email , '60', THEME_IMAGE_URL.'50x50.gif', 'G', false, $atts = array() );?>" alt="<?php echo $authorName; ?>">
						</a>
                        <div class="meta">
                            <h4><a href="<?php echo get_page_link($comment->comment_post_ID);?>#comment-<?php echo $comment->comment_ID;?>"><?php echo WordLimiter($comment->comment_content,3); ?></a></h4>
                            <small><?php echo $authorName; ?></small>
                        </div>
                    </li>
							<?php $counter++; ?>
						<?php } ?>
				</ul>

	
	<?php echo $after_widget; ?>
		
	
      <?php
	}
}
?>

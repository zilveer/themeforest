<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_latest_comments");'));

class OT_latest_comments extends WP_Widget {
	function OT_latest_comments() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Latest Comments');	
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
		$count = $instance['count'];
		$title = $instance['title'];

	
		if(!$count) $count = 4;
		$widget_id = $args['widget_id'];
		

?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
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
				<div class="widget-comment">
					<div class="comment-photo">
						<a href="<?php echo get_page_link($comment->comment_post_ID);?>#comment-<?php echo $comment->comment_ID;?>" class="photo-border-1">
							<img src="<?php echo get_gravatar($comment->comment_author_email , '50', THEME_IMAGE_URL.'no-avatar-50x50.jpg', 'G', false, $atts = array() );?>" alt="<?php echo $authorName; ?>" />
						</a>
					</div>
					<div class="comment-content">
						<h4><?php echo $authorName; ?></h4>
						<p><?php comment_excerpt($comment->comment_ID);?></p>

						<div class="article-icons">
							<span class="article-icon"><span class="icon-text">&#128340;</span><?php echo date("F d, Y, H:i",strtotime($comment->comment_date));?></span>
						</div>
						<a href="<?php echo get_page_link($comment->comment_post_ID);?>#comments" class="button-link"><?php _e("View This Article", THEME_NAME);?><span class="icon-text">&#9656;</span></a>
					</div>
				</div>



			<?php } ?>
	
	<?php echo $after_widget; ?>
		
	
      <?php
	}
}
?>

<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_triple_box");'));

class OT_triple_box extends WP_Widget {
	function OT_triple_box() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Popular Posts & Comments');	
	}

	function form($instance) {
		 $count = esc_attr($instance['count']);
		 $comentcount = esc_attr($instance['comentcount']);
		 $title = esc_attr($instance['title']);

        ?>
          			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Widget Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
          			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Post count:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
          			<p><label for="<?php echo $this->get_field_id('comentcount'); ?>"><?php printf ( __( 'Comment count:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('comentcount'); ?>" name="<?php echo $this->get_field_name('comentcount'); ?>" type="text" value="<?php echo $comentcount; ?>" /></label></p>
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['comentcount'] = strip_tags($new_instance['comentcount']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$count = $instance['count'];
		$title = $instance['title'];
		$comentcount = $instance['comentcount'];
		
		if(!$comentcount) $comentcount = 4;
		if(!$count) $count = 4;
		$widget_id = $args['widget_id'];
		
		$blogID = get_option('page_for_posts');
        ?>
			
		<?php echo $before_widget; ?>
				<?php echo $before_title.$title.$after_title;?>
					<div class="tab-container">
						<ul class="tabs">
							<li class="tab"><a href="#tab-1-div"><?php _e("Latest Comments", THEME_NAME);?></a></li>
							<li class="tab"><a href="#that-other-tab"><?php _e("Popular Posts", THEME_NAME);?></a></li>
						</ul>
									
						<div class="panel-container">
							<div id="tab-1-div">
								<ul class="latest-comments">
									<?php
										$args =	array(
											'status' => 'approve', 
											'order' => 'DESC',
											'number' => $comentcount
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
										<!-- Comments -->
										<li>
											<a href="<?php echo get_page_link($comment->comment_post_ID);?>#comment-<?php echo $comment->comment_ID;?>">
												<img src="<?php echo get_gravatar($comment->comment_author_email , '60', THEME_IMAGE_URL.'50x50.gif', 'G', false, $atts = array() );?>" alt="<?php echo $authorName; ?>">
											</a>
											<div class="meta">
												<h4><a href="<?php echo get_page_link($comment->comment_post_ID);?>#comment-<?php echo $comment->comment_ID;?>"><?php echo WordLimiter($comment->comment_content,3); ?></a></h4><small><?php echo $authorName; ?></small>
											</div>
										</li>


										<?php $counter++; ?>
									<?php } ?>
								</ul>		
							</div>		
							<div id="that-other-tab">
								<ul class="latest-posts">
									<?php
										//add_filter( 'posts_where', 'filter_where' );
										$args=array(
											'posts_per_page' => $count,
											'order' => 'DESC',
											'orderby'	=> 'meta_value_num',
											'meta_key'	=> THEME_NAME.'_post_views_count',
											'post_type'=> 'post'
										);
										$the_query = new WP_Query($args);
										$myposts = get_posts( $args );	
										$totalCount = $the_query->post_count;
										$counter = 1;
										remove_filter( 'posts_where', 'filter_where' );
									?>
									<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
										<?php $image = get_post_thumb($the_query->post->ID,50,50); ?>		
										<!-- Post -->
										<li>
											<a href="<?php the_permalink();?>">
												<img src="<?php echo $image['src'];?>" alt="<?php the_title();?>">
											</a>
											<div class="meta">
												<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4><small><?php echo get_the_date("d M, Y");?></small>
											</div>
										</li>
										<?php $counter++; ?>
									<?php endwhile; else: ?>
										<p><?php _e( 'No posts where found' , THEME_NAME );?></p>
									<?php endif; ?>	

								</ul>
							</div>

					  </div>
					</div>
		
					<?php echo $after_widget; ?>
        <?php
	}
}
?>
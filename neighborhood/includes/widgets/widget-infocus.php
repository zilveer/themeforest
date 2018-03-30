<?php

	/*
	*
	*	Custom In Focus Widget
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	// Register widget
	add_action( 'widgets_init', 'init_sf_infocus' );
	function init_sf_infocus() { return register_widget('sf_infocus'); }
	
	class sf_infocus extends WP_Widget {
	
		function __construct() {
			parent::__construct( 'sf_infocus_widget', $name = 'Swift Framework In Focus' );
		}
	
		function widget( $args, $instance ) {
			global $post;
			extract($args);
	
			// Widget Options
			$title 	 = apply_filters('widget_title', $instance['title'] ); // Title		
			$post_id = $instance['post_id']; // Post ID
			
			echo $before_widget;
			
		    if ( $title ) echo $before_title . $title . $after_title;
				
			$infocus_post = get_post($post_id);
			
			?>
			
			<div class="infocus-item">
				
				<?php 
					$post_title = $infocus_post->post_title;
					$post_permalink = get_post_permalink($infocus_post);
					
					$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full', $post_id);
					$thumb_video = sf_get_post_meta($post_id, 'sf_thumbnail_video_url', true);
					
					foreach ($thumb_image as $detail_image) {
						$thumb_img_url = $detail_image['url'];
						break;
					}
													
					if (!$thumb_image) {
						$thumb_image = get_post_thumbnail_id( $post_id );
						$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
					}
					
					$image = aq_resize( $thumb_img_url, 300, 225, true, false);
				?>
				<figure>
					<?php if ($thumb_video != "") { ?>
						<?php echo video_embed($thumb_video, 300, 200); ?>
					<?php } else if ($image) { ?>
					<a href="<?php echo $post_permalink; ?>" class="infocus-image">
						<div class="overlay">
							<div class="thumb-info">
								<i class="fa-file-o"></i>
							</div>
						</div>
						<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" />
					</a>
					<?php } ?>
				</figure>
								
				<div class="infocus-title clearfix">
					<h5><a href="<?php echo $post_permalink; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></h5>
					<div class="comments-likes">
					<?php if (function_exists( 'lip_love_it_link' )) {
						echo lip_love_it_link($post_id, '<i class="fa-heart"></i>', '<i class="fa-heart"></i>', false);
					} ?>
					</div>
				</div>
				
			</div>
							
			<?php
			
			echo $after_widget;
		}
	
		/* Widget control update */
		function update( $new_instance, $old_instance ) {
			$instance    = $old_instance;
				
			$instance['title']  = strip_tags( $new_instance['title'] );
			$instance['post_id'] = strip_tags( $new_instance['post_id'] );
			return $instance;
		}
		
		/* Widget settings */
		function form( $instance ) {	
		
			    // Set defaults if instance doesn't already exist
			    if ( $instance ) {
					$title  = $instance['title'];
			        $post_id = $instance['post_id'];
			    } else {
				    // Defaults
					$title  = '';
			        $post_id = 0;
			    }
				
				// The widget form
				?>
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:' ); ?></label>
					<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('post_id'); ?>"><?php echo __( 'Post ID:' ); ?></label>
					<input id="<?php echo $this->get_field_id('post_id'); ?>" name="<?php echo $this->get_field_name('post_id'); ?>" type="text" value="<?php echo $post_id; ?>" size="widefat" />
				</p>
		<?php 
		}
	
	}

?>
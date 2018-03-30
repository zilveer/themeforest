<?php
/*
Plugin Name: Better Recent Posts Widget
Plugin URI: http://pippinspages.com/better-recent-posts-widget
Description: Provides a better recent posts widget, including thumbnails and number options
Version: 1.0
Author: Pippin Williamson
Author URI: http://pippinspages.com
*/

/**
 * Recent Posts Widget Class
 */
if ( !class_exists( 'pippin_recent_posts' ) ) {
	class pippin_recent_posts extends WP_Widget {


		/** constructor */
		function pippin_recent_posts() {
			parent::__construct (false, $name = 'CUSTOM - Recent Posts');	
		}

		/** @see WP_Widget::widget */
		function widget($args, $instance) {	
			extract( $args );
			global $posttypes;
			$title 			= apply_filters('widget_title', $instance['title']);
			$cat 			= apply_filters('widget_title', $instance['cat']);
			$number 		= apply_filters('widget_title', $instance['number']);
			$offset 		= apply_filters('widget_title', $instance['offset']);
			$thumbnail_size = apply_filters('widget_title', $instance['thumbnail_size']);
			$thumbnail 		= $instance['thumbnail'];
			$posttype 		= $instance['posttype'];
			?>
				  <?php echo $before_widget; ?>
					  <?php if ( $title )
							echo $before_title . $title . $after_title; ?>
								<ul class="no-bullets">
								<?php
									global $post;
									$tmp_post = $post;
									
									// get the category IDs and place them in an array
									if($cat) {
										$args = 'posts_per_page=' . $number . '&offset=' . $offset . '&post_type=' . $posttype . '&cat=' . $cat;
									} else {
										$args = 'posts_per_page=' . $number . '&offset=' . $offset . '&post_type=' . $posttype;
									}
									$myposts = get_posts( $args );
									foreach( $myposts as $post ) : setup_postdata($post); ?>
										<li class="recent_post_widget" >
										<div class="recent_post_widget_img">
											<?php if($thumbnail == true) { ?>
												<?php the_post_thumbnail(array($thumbnail_size, $thumbnail_size));?>
											<?php } ?>
										</div>
										<div class="recent_post_widget_meta">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br/>
											<span class="recent_post_widget_link_time"><?php echo (get_the_time('F j, Y')) ; ?></span>
										</div>
										<div class="clear"></div>
										</li>
									<?php endforeach; ?>
									<?php $post = $tmp_post; ?>
								</ul>
				  <?php echo $after_widget; ?>
			<?php
		}

		/** @see WP_Widget::update */
		function update($new_instance, $old_instance) {		
			global $posttypes;
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['cat'] = strip_tags($new_instance['cat']);
			$instance['number'] = strip_tags($new_instance['number']);
			$instance['offset'] = strip_tags($new_instance['offset']);
			$instance['thumbnail_size'] = strip_tags($new_instance['thumbnail_size']);
			$instance['thumbnail'] = $new_instance['thumbnail'];
			$instance['posttype'] = $new_instance['posttype'];
			return $instance;
		}

		/** @see WP_Widget::form */
		function form($instance) {	

			$posttypes = get_post_types('', 'objects');
		
			if(empty($instance['title'])){$instance['title'] = '';}
			if(empty($instance['cat'])){$instance['cat'] = '';}
			if(empty($instance['number'])){$instance['number'] = '';}
			if(empty($instance['offset'])){$instance['offset'] = '';}
			if(empty($instance['thumbnail_size'])){$instance['thumbnail_size'] = '';}
			if(empty($instance['thumbnail'])){$instance['thumbnail'] = '';}
			if(empty($instance['posttype'])){$instance['posttype'] = '';}

			$title = esc_attr($instance['title']);
			$cat = esc_attr($instance['cat']);
			$number = esc_attr($instance['number']);
			$offset = esc_attr($instance['offset']);
			$thumbnail_size = esc_attr($instance['thumbnail_size']);
			$thumbnail = esc_attr($instance['thumbnail']);
			$posttype	= esc_attr($instance['posttype']);
			?>
			 <p>
			  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mnky-admin'); ?></label> 
			  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<p>
			  <label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category IDs, separated by commas', 'mnky-admin'); ?></label> 
			  <input class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $cat; ?>" />
			</p>
			<p>
			  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number to Show:', 'mnky-admin'); ?></label> 
			  <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
			</p>
			<p>
			  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Offset (the number of posts to skip):', 'mnky-admin'); ?></label> 
			  <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo $offset; ?>" />
			</p>
			<p>
			  <input id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="checkbox" value="1" <?php checked( '1', $thumbnail ); ?>/>
			  <label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php _e('Display thumbnails?', 'mnky-admin'); ?></label> 
			</p>
			<p>
			  <label for="<?php echo $this->get_field_id('thumbnail_size'); ?>"><?php _e('Size of the thumbnails, e.g. <em>80</em> = 80px x 80px', 'mnky-admin'); ?></label> 
			  <input class="widefat" id="<?php echo $this->get_field_id('thumbnail_size'); ?>" name="<?php echo $this->get_field_name('thumbnail_size'); ?>" type="text" value="<?php echo $thumbnail_size; ?>" />
			</p>
			<p>	
				<label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e('Choose the Post Type to display', 'mnky-admin'); ?></label> 
				<select name="<?php echo $this->get_field_name('posttype'); ?>" id="<?php echo $this->get_field_id('posttype'); ?>" class="widefat">
					<?php
					foreach ($posttypes as $option) {
						echo '<option value="' . $option->name . '" id="' . $option->name . '"', $posttype == $option->name ? ' selected="selected"' : '', '>', $option->name, '</option>';
					}
					?>
				</select>		
			</p>
			<?php 
		}


	} // class utopian_recent_posts
	// register Recent Posts widget
	add_action('widgets_init', create_function('', 'return register_widget("pippin_recent_posts");'));
}
?>
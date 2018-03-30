<?php
/**
 * Plugin Name: Goodlayers Last Minute Package
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show last minute package( Specified by category ).
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'last_minute_package_widget' );
function last_minute_package_widget() {
	register_widget( 'Last_Minute_Package' );
}

class Last_Minute_Package extends WP_Widget {

	// Initialize the widget
	function Last_Minute_Package() {
		parent::__construct('last-minute-package-widget', __('Last Minute Package Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('A widget that show last minute packages', 'gdl_back_office')));  
	}

	// Output of the widget
	function widget( $args, $instance ) {
		global $gdl_widget_date_format, $blog_port_widget_size;
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$post_cat = $instance['post_cat'];
		$show_num = $instance['show_num'];
		
		if($post_cat == "All"){ $post_cat = ''; }
		
		// Opening of widget
		echo $before_widget;
		
		// Open of title tag
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
			
		// Widget Content
		wp_reset_query();
		$current_post = array(get_the_ID());		
		$custom_posts = get_posts( array('post_type'=>'package', 'showposts'=>$show_num, 'package-category'=>$post_cat, 'post__not_in'=>$current_post, 
				'meta_query'=>array(array( 'key'=>'package-type', 'value'=> 'Last Minute', 'compare' => '=')), 'suppress_filters'=>0
				) 
			);
		
		if( !empty($custom_posts) ){ 
			echo "<div class='gdl-recent-post-widget'>";
			foreach($custom_posts as $custom_post) { 
				?>
				<div class="recent-post-widget">
					<?php
						$thumbnail_id = get_post_thumbnail_id( $custom_post->ID );				
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $blog_port_widget_size );
						if( $thumbnail_id ){
							echo '<div class="recent-post-widget-thumbnail">';
							echo '<a href="' . get_permalink( $custom_post->ID ) . '">';
							$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
							if( !empty($thumbnail) ){
								echo '<img src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>';
							}	
							echo '</a>';
							echo '</div>';
						}
					?>
					
					<div class="recent-post-widget-context">
						<h4 class="recent-post-widget-title">
							<a href="<?php echo get_permalink( $custom_post->ID ); ?>"> 
								<?php _e( $custom_post->post_title, 'gdl_front_end'); ?> 
							</a>
						</h4>
						<div class="recent-post-widget-info">
							<div class="recent-post-widget-date">
							<?php
							
								// package price
								$package_type = get_post_meta($custom_post->ID, 'package-type', true);
								$price = get_post_meta($custom_post->ID, 'package-price',true);
								if($package_type == 'Last Minute'){
									echo '<div class="package-info"><i class="icon-tag"></i>';
									
									echo '<span class="normal-price">';
									echo do_shortcode($price);
									echo '</span>';
									
									echo '<span class="discount-text">';
									echo get_post_meta($custom_post->ID, 'package-type-text', true);
									echo '</span><span class="separator"> : </span>';
									
									echo '<span class="discount-price">';
									echo get_post_meta($custom_post->ID, 'package-last-minute-widget-text', true);
									echo '</span>';
									
									echo '</div>';
								}else if($package_type == 'Learn More'){
									if(!empty($price)){
										echo '<div class="package-info"><i class="icon-tag"></i>';
										echo do_shortcode($price);
										echo '</div>';
									}
								}							
							?>
							</div>						
						</div>
					</div>
					<div class="clear"></div>
				</div>						
				<?php 
				
			}
			echo "</div>";
		}
		
		// Closing of widget
		echo $after_widget;		
	}

	// Widget Form
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$post_cat = esc_attr( $instance[ 'post_cat' ] );
			$show_num = esc_attr( $instance[ 'show_num' ] );
		} else {
			$title = '';
			$post_cat = '';
			$show_num = '3';
		}
		?>

		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>		

		<!-- Post Category -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_cat' ); ?>"><?php _e('Category :', 'gdl_back_office'); ?></label>		
			<select class="widefat" name="<?php echo $this->get_field_name( 'post_cat' ); ?>" id="<?php echo $this->get_field_id( 'post_cat' ); ?>">
			<?php 	
			$category_list = get_category_list( 'package-category' ); 
			foreach($category_list as $category){ 
			?>
				<option value="<?php echo $category; ?>" <?php if ( $post_cat == $category ) echo ' selected="selected"'; ?>><?php echo $category; ?></option>				
			<?php } ?>	
			</select> 
		</p>
			
		<!-- Show Num --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" type="text" value="<?php echo $show_num; ?>" />
		</p>

	<?php
	}
	
	// Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_cat'] = strip_tags( $new_instance['post_cat'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );

		return $instance;
	}	
}

?>
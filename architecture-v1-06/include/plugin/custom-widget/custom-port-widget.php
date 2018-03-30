<?php
/**
 * Plugin Name: Goodlayers Recent Portfolio
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show recent portfolio( Specified by portfolio-category ).
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'recent_port_widget' );
function recent_port_widget() {
	register_widget( 'Recent_Port' );
}

class Recent_Port extends WP_Widget {

	// Initialize the widget
	function Recent_Port() {
		parent::__construct('recent-port-widget', __('Recent Portfolio Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('A widget that show last portfolio', 'gdl_back_office')));  	
	}

	// Output of the widget
	function widget( $args, $instance ) {
		global $gdl_widget_date_format;
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$port_cat = $instance['port_cat'];
		$show_num = $instance['show_num'];		
		
		if($port_cat == "All"){ $port_cat = ''; }

		// Opening of widget
		echo $before_widget;
		
		// Open of title tag
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
			
		// Widget Content
		wp_reset_query();
		$current_post = array(get_the_ID());	
		$custom_posts = get_posts( array('post_type'=>'portfolio', 'suppress_filters' => 0, 'showposts'=>$show_num, 
			'portfolio-category'=>$port_cat, 'post__not_in'=>$current_post) );

		if( !empty($custom_posts) ){ 
			echo "<div class='gdl-recent-post-widget'>";
			foreach($custom_posts as $custom_post) { 
				?>
				<div class="recent-post-widget">
					<?php
						$thumbnail_id = get_post_thumbnail_id( $custom_post->ID );				
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '90x60' );
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
								<?php echo get_the_time($gdl_widget_date_format, $custom_post->ID); ?>
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
			$port_cat = esc_attr( $instance[ 'port_cat' ] );
			$show_num = esc_attr( $instance[ 'show_num' ] );
		} else {
			$title = '';
			$port_cat = '';
			$show_num = '3';
		}
		?>

		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>		

		<!-- Port Category -->
		<p>
			<label for="<?php echo $this->get_field_id( 'port_cat' ); ?>"><?php _e('Category :', 'gdl_back_office'); ?></label>		
			<select class="widefat" name="<?php echo $this->get_field_name( 'port_cat' ); ?>" id="<?php echo $this->get_field_id( 'port_cat' ); ?>">
			<?php 	
			$category_list = get_category_list( 'portfolio-category' ); 
			foreach($category_list as $category){ 
			?>
				<option value="<?php echo $category; ?>" <?php if ( $port_cat == $category ) echo ' selected="selected"'; ?>><?php echo $category; ?></option>				
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
		$instance['port_cat'] = strip_tags( $new_instance['port_cat'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );

		return $instance;
	}	
}

?>
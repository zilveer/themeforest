<?php
/**
 * Plugin Name: Goodlayers Personnal Widget
 * Plugin URI: http://goodlayers.com/ 
 * Description: A widget that show personnal posts( Specified by cat-id ).
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'personnal_widget' );
function personnal_widget() {
	register_widget( 'Goodlayers_Personnal' );
}

class Goodlayers_Personnal extends WP_Widget {

	// Initialize the widget
	function Goodlayers_Personnal() {
		parent::__construct('personnal-widget', __('Personnal Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('A widget that show personnal information', 'gdl_back_office')));  
	}

	// Output of the widget
	function widget( $args, $instance ) {
		global $gdl_widget_date_format;
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$personnal_cat = $instance['personnal_cat'];
		$show_num = $instance['show_num'];
		
		if($personnal_cat == "All"){ $personnal_cat = ''; }
		
		// Opening of widget
		echo $before_widget;
		
		// Open of title tag
		if ( $title ){ 
			echo $before_title;
			echo $title;
			echo '<div class="personnal-widget-navigation">';
			echo '<div class="personnal-widget-prev"></div>';
			echo '<div class="personnal-widget-next"></div>';
			echo '</div>';				
			echo $after_title; 		
		}
			
		// Widget Content
		wp_reset_query();	
		
		$custom_posts = get_posts( array('post_type'=>'personnal', 'showposts'=>$show_num, 'personnal-category'=>$personnal_cat) );
		
		if( !empty($custom_posts) ){ 
			echo "<div class='gdl-personnal-widget'>";
			foreach($custom_posts as $custom_post) { 
				?>
				<div class="personnal-widget-item">
					<?php
						$thumbnail_id = get_post_thumbnail_id( $custom_post->ID );				
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '300x200' );
						if( $thumbnail_id ){
							echo '<div class="personnal-widget-thumbnail">';
							$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
							if( !empty($thumbnail) ){
								echo '<img src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>';
							}	
							echo '</div>'; // personnal-widget-thumbnail
						}
					?>
					
					<div class="personnal-widget-context">
						<div class="personnal-widget-info">
							<div class="personnal-name">
								<?php 
									echo $custom_post->post_title; 
									$personnal_position = get_post_meta( $custom_post->ID, 'personnal-option-position', true);
									if( !empty( $personnal_position ) ){
										echo ', <span class="personnal-position">' . __( $personnal_position, 'gdl_front_end' ) . '</span>';
									}
								?>
							</div>						
						</div>
						<div class="personnal-widget-content">
							<?php 
							echo do_shortcode( apply_filters('the_content', $custom_post->post_content) ); 
							?>					
						</div>
					</div>
					<div class="clear"></div>
				</div>	<!-- personnal widget item -->				
				<?php 
				
			}
			echo "</div>";
		}
		
		// Closing of widget
		echo $after_widget;
		
		wp_deregister_script('jquery-cycle');
		wp_register_script('jquery-cycle', GOODLAYERS_PATH.'/javascript/jquery.cycle.js', false, '1.0', true);
		wp_enqueue_script('jquery-cycle');			
	}

	// Widget Form
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$personnal_cat = esc_attr( $instance[ 'personnal_cat' ] );
			$show_num = esc_attr( $instance[ 'show_num' ] );
		} else {
			$title = '';
			$personnal_cat = '';
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
			<label for="<?php echo $this->get_field_id( 'personnal_cat' ); ?>"><?php _e('Category :', 'gdl_back_office'); ?></label>		
			<select class="widefat" name="<?php echo $this->get_field_name( 'personnal_cat' ); ?>" id="<?php echo $this->get_field_id( 'personnal_cat' ); ?>">
			<?php 	
			$category_list = get_category_list( 'personnal-category' ); 
			foreach($category_list as $category){ 
			?>
				<option value="<?php echo $category; ?>" <?php if ( $personnal_cat == $category ) echo ' selected="selected"'; ?>><?php echo $category; ?></option>				
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
		$instance['personnal_cat'] = strip_tags( $new_instance['personnal_cat'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );

		return $instance;
	}	
}

?>
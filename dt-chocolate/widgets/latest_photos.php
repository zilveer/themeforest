<?php
function dt_photos_parents_where( $where ) {
	global $wpdb, $dt_where_filter_param;
	$query = $dt_where_filter_param;
	if( $query ) { 
		$where .= sprintf( " AND %s.post_parent IN(%s)", $wpdb->posts, $query );
	}
	return $where;
}

/* Register the widget */
function dt_latest_photo_register() {
	register_widget( 'DT_latest_photo_Widget' );
}

/* Begin Widget Class */
class DT_latest_photo_Widget extends WP_Widget {

	/* Widget setup  */
	function DT_latest_photo_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'description' => __('A widget with photos from your albums', LANGUAGE_ZONE) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 250, 'id_base' => 'dt-latest-photo-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'dt-latest-photo-widget', __(THEME_TITLE.' Photos', LANGUAGE_ZONE), $widget_ops, $control_ops );
	}

	/* Display the widget  */
	function widget( $args, $instance ) {
		extract( $args );
		
		$defaults = array( 
			'title' => '',
			'order' => 'rand',
			'show' => 3
		);
			
		$instance = wp_parse_args( (array) $instance, $defaults );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$show = $instance['show'];
		$order = $instance['order'];
		
		global $wpdb, $dt_where_filter_param;
		$dt_where_filter_param = sprintf( 'SELECT ID FROM %s WHERE post_type="%s" AND post_status="publish" AND post_password=""', $wpdb->posts, 'dt_gallery_plus' );
		
		$args = array(
					'numberposts'		=>$show,
					'posts_per_page'	=>$show,
					'post_type'			=>'attachment',
					'post_mime_type'	=>'image',
					'post_status' 		=>'inherit'
				);
		if ( 'rand' == $order ) {
			$args['orderby'] = 'rand';
		}
		
		add_filter( 'posts_where' , 'dt_photos_parents_where' );
		$p_query = new Wp_Query( $args );
		remove_filter( 'posts_where' , 'dt_photos_parents_where' );
		
		echo $before_widget ;

		// start
		echo ''
              .$before_title.$instance['title'].$after_title;
			
		echo '<div class="flickr">';
		
		if ( !empty($p_query->posts) ) {
			foreach ( $p_query->posts as $photo ) {
				$img = wp_get_attachment_image_src($photo->ID, 'large');

				$tmp_src = dt_clean_thumb_url($img[0]);

				$photo_t_src = get_template_directory_uri()."/thumb.php?src={$tmp_src}&w=47&h=47&zc=1";
				
				$photo_b_src = esc_url($img[0]);
				printf( '<a href="%1$s" class="%2$s" title="%3$s"><img width="%4$d" height="%5$d" src="%6$s"/><i></i></a>',
					esc_url($photo_b_src),
					'alignleft prettyPhoto',
					esc_attr( $photo->post_excerpt ),
					47, 47,
					esc_attr($photo_t_src)
				);
			}
		}
		
		echo '</div>';
	
		echo $after_widget;
	}

	/* Update the widget settings  */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['show'] = $new_instance['show'];
		$instance['order'] = $new_instance['order'];
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => '',
			'order' => 'rand',
			'show' => 3
		);
			
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', LANGUAGE_ZONE); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:85%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Show:', LANGUAGE_ZONE); ?></label><br />
			<label>
   			<input id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" value="rand" type="radio" <?php if ('rand' == $instance['order']) echo ' checked="checked"'; ?> /> Random photos
			</label><br />
			<label>
   			<input id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" value="latest" type="radio" <?php if ('latest' == $instance['order']) echo ' checked="checked"'; ?> /> Latest photos
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show' ); ?>"><?php _e('How many:', LANGUAGE_ZONE); ?></label><br />
   		<select id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>">
   		   <?php
   		      for ($i=1; $i<=12; $i++)
   		      {
   		         if ($i % 3 != 0) continue;
   		         echo '<option value="'.$i.'"'.( $instance['show'] == $i ? ' selected="selected"' : '' ).'>'.$i.'</option>';
   		      }
   		   ?>
   		</select>
	   </p>
		
		<div style="clear: both;"></div>
	<?php
	}
}

/* Load the widget */
add_action( 'widgets_init', 'dt_latest_photo_register' );

?>

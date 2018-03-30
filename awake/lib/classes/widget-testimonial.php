<?php
/**
 *
 */

class MySite_Testimonial_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function MySite_Testimonial_Widget() {
		$widget_ops = array( 'classname' => 'mysite_testimonial_widget', 'description' => __( 'Pulls in your testimonials', MYSITE_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'testimonialwidget', sprintf( __( '%1$s - Testimonials', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget( $args, $instance ) {
		global $wpdb, $mysite;
		
        extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Testimonial', MYSITE_TEXTDOMAIN ) : $instance['title'], $instance, $this->id_base );
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		# Testimonal Widget
		$query = array(
			'post_type' => 'testimonial',
			'showposts' => $number,
			'nopaging' => 0,
			'ignore_sticky_posts' => 1
		);
		
		if( !empty( $instance['cat'] ) ) {
			$query['tax_query'] = array(
				'relation' => 'IN',
				array(
					'taxonomy' => 'testimonial_category',
					'field' => 'slug',
					'terms' => $instance['cat']
				)
			);
		}
			
		$testimonials_query = new WP_Query( $query );
		
		$out = '<div class="widget_testimonial_module">';
		
		if( $testimonials_query->have_posts() ) : while( $testimonials_query->have_posts() ) : $testimonials_query->the_post();

		$post_id = get_the_ID();
		$custom_fields = get_post_custom( $post_id );
		foreach( $custom_fields as $key => $value )
			$testimonial[$post_id][$key] = $value[0];		

		endwhile;

		$i=1;
		foreach( $testimonial as $key => $value ) {

			$out .= '<div class="widget_testimonial_wrap"' . ( $i == 1 ? '' : ' style="display:none;"' ) . '>';

			$out .= '<div id="testimonial_' . $key . '" class="widget_single_testimonial">' . $value['_testimonial'] . '</div>';
			
			if( isset( $value['_image'] ) || !empty( $value['_name'] ) || !empty( $value['_website_url'] ) ) {
				$out .= '<span class="widget_testimonial_author">';

				if( isset( $value['_image'] ) && $value['_image'] == 'upload_picture' && !empty( $value['_custom_image'] ) ) {
					$out .= '<span class="testimonial_image">'
					. mysite_display_image(array(
						'src' => $value['_custom_image'],
						'title' => '', 'alt' => '',
						'height' => 44,
						'width' => 44,
						'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
					))
					. '</span>';
				}

				if( isset( $value['_image'] ) && $value['_image'] == 'use_gravatar' )
					$out .= '<span class="testimonial_image">' . get_avatar( ( isset($value['_email']) ? $value['_email'] : 'sjm6g1LW@sjm6g1LW.com' ), apply_filters( 'testimonial_widget_gravatar_size', '40' ), THEME_IMAGES_ASSETS . '/testimonial_widget_gravatar_default.png' ) . '</span>';
					
				if( !empty( $value['_name'] ) || !empty( $value['_website_url'] ) ) {
					$out .= '<span class="testimonial_meta">';

					if( !empty( $value['_name'] ) )
						$out .= '<span class="testimonial_author_name">' . $value['_name'] . '</span>';

					if( !empty( $value['_website_url'] ) )
						$out .= '<span class="testimonial_author_website"><a target="_blank" href="' . $value['_website_url'] . '">' . ( !empty( $value['_website_name'] ) ? $value['_website_name'] : $value['_website_url'] ) . '</a></span>';

					$out .= '</span>';
				}
				
				$out .= '</span>';
			}
			
			$out .= '</div>';

			$i++;
		}
		
		if( count( $testimonial ) > 1 ) {
			$out .= '<span class="testimonial_nav">';
			$out .= '<span class="testimonial_prev">Prev</span>';
			$out .= '<span class="testimonial_next">Next</span>';
			$out .= '</span>';
		}
		
		wp_reset_postdata();
		
		else :
		
			$out .= __( 'No testimonials were found', MYSITE_TEXTDOMAIN );
			
			if( current_user_can( 'edit_post' ) )
				$out .= '<br /><a href="' . esc_url(admin_url( 'post-new.php?post_type=testimonial' )) . '">' . __( 'Click here to add testimonials', MYSITE_TEXTDOMAIN ) . '</a>';
		
		endif;
		
		$out .= '</div>';
		
		if( isset( $instance['testimonial_sc'] ) )
			echo '<!--start_raw-->' . $out . '<!--end_raw-->';
		else
			echo $out;
			
		echo $after_widget;
    }

	/**
	 *
	 */
    function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
				
        return $instance;
    }

	/**
	 *
	 */
    function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$cat = isset( $instance['cat'] ) ? $instance['cat'] : array();
		if ( !isset( $instance['number'] ) || !$number = (int) $instance['number'] )
			$number = 3;
			
		$categories = get_terms('testimonial_category','orderby=name&hide_empty=0');
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( "Enter the number of testimonials you'd like to display:", MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
		
		<?php if( !empty( $categories ) ) : ?>
			<p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e( 'Categories:' , MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
			<select style="height:5.5em" name="<?php echo $this->get_field_name('cat'); ?>[]" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat" multiple="multiple">
			<?php foreach( $categories as $category ) : ?>
				<option value="<?php echo $category->name;?>"<?php echo in_array($category->name, $cat)? ' selected="selected"':'';?>><?php echo $category->name;?></option>
			<?php endforeach; ?>
			</select></p>
		
        <?php endif;
    }

}

?>
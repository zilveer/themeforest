<?php
/**
 *
 */

class MySite_RecentPost_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function MySite_RecentPost_Widget() {
		$widget_ops = array( 'classname' => 'mysite_recent_widget', 'description' => __( 'Custom recent post widget with post preview image', MYSITE_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'recentposts', sprintf( __( '%1$s - Recent Post', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops);
    }

	/**
	 *
	 */
    function widget($args, $instance) {
		global $wpdb, $shortname, $mysite;
		$prefix = MYSITE_PREFIX;
		
        extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Recent Posts', MYSITE_TEXTDOMAIN ) : $instance['title'], $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			
		$out = $before_widget;
		$out .= $before_title . $title . $after_title;
		
		$disable_thumb = $instance['disable_thumb'] ? '1' : '0';
		
		$recent_query = new WP_Query(array(
			'showposts' => $number,
			'nopaging' => 0,
			'post_status' => 'publish',
			'category__in' => ( isset( $instance['category'] ) && $instance['category'] != 'all' ? (int) $instance['category'] : null ),
			'category__not_in' => array( mysite_exclude_category_string( $minus = false ) ),
			'ignore_sticky_posts' => 1
		));
		
		if ( $recent_query->have_posts() ) {
			$out .= '<ul class="post_list small_post_list">';
			
			while ( $recent_query->have_posts() ) {
				$recent_query->the_post();
			
				$out .= '<li class="post_list_module">';
			
				if( !$disable_thumb ) {
					$widget_thumb_img = $mysite->layout['big_sidebar_images']['small_post_list'];
					$out .= mysite_get_post_image(array(
						'width' => $widget_thumb_img[0],
						'height' => $widget_thumb_img[1],
						'img_class' => 'post_list_image',
						'preload' => false,
						'placeholder' => true,
						'echo' => false,
						'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
					));
				}
				
				$out .= '<div class="post_list_content">';
				
				$out .= '<p class="post_title">';
				$out .= '<a rel="bookmark" href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a>';
				$out .= '</p>';
			
				$get_year = get_the_time( 'Y', get_the_ID() );
				$get_month = get_the_time( 'm', get_the_ID() );
				
				$out .= '<p class="post_meta">';
				$out .= apply_filters( 'mysite_widget_meta', do_shortcode( '[post_date]' ) );
				$out .= '</p>';
				
				$out .= '</div>';
			
				$out .= '</li>';
			}
			
			$out .= '</ul>';
		}
		
		$out .= $after_widget;
		
		wp_reset_postdata();
		echo $out;
    }

	/**
	 *
	 */
    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['disable_thumb'] = !empty($new_instance['disable_thumb']) ? 1 : 0;
				
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {
		$categories = get_categories(); 			
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$category = isset($instance['category']) ? esc_attr($instance['category']) : 'all';
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( "Number of posts to display:", MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

		<?php if( !empty( $categories ) ) : ?>
			<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e( "Select which category to use:", MYSITE_ADMIN_TEXTDOMAIN ); ?></label><br />
			<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
			<option value="all"<?php selected($category,'all');?>><?php _e( "All Categories", MYSITE_ADMIN_TEXTDOMAIN ); ?></option>
			<?php foreach( $categories as $cat ) : ?>
				<option value="<?php echo $cat->cat_ID;?>"<?php selected($category,$cat->cat_ID);?>><?php echo $cat->name;?></option>
			<?php endforeach; ?>
			</select></p>
		<?php endif; ?>
		
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name('disable_thumb'); ?>"<?php checked( $disable_thumb ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail?', MYSITE_ADMIN_TEXTDOMAIN ); ?></label></p>

        <?php 
    }

}

?>
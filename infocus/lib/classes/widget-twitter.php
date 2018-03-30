<?php
/**
 *
 */

class MySite_Twitter_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function MySite_Twitter_Widget() {
		$widget_ops = array( 'classname' => 'mysite_twitter_widget', 'description' => __( 'Pulls in your most recent tweet from Twitter', MYSITE_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'twitter', sprintf( __( '%1$s - Twitter', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops);
    }

	/**
	 *
	 */
    function widget($args, $instance) {
		global $shortname;
		
        	extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Recent Tweets', MYSITE_TEXTDOMAIN ) : $instance['title'], $instance, $this->id_base);
		$id = $instance['id'];
		
		if ( !$number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 40 )
			$number = 40;
		
		$username = !empty( $instance['id'] ) ? trim( $instance['id'] ) : mysite_get_setting( 'twitter_id' );
		$limit = $number;
		$type = 'widget';
		?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title;
				?><div class="twitter_bird"></div><ul><?php
					echo Mysitemyway_Twitter::get_instance()->display_tweets( $username, $limit, $type );
				?></ul><?php
				echo $after_widget;
    }

	/**
	 *
	 */
    function update($new_instance, $old_instance) {	
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['number'] = (int) $new_instance['number'];
				
        return $instance;
	
				
    }

	/**
	 *
	 */
    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e( 'Enter your twitter username:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" /></p>
			
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( "Enter the number of tweets you'd like to display:", MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

        <?php 
    }

}

?>
<?php
/**
 *
 */

class MySite_Flickr_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function MySite_Flickr_Widget() {
		$widget_ops = array('classname' => 'mysite_flickr_widget', 'description' => __( 'Pulls in images from your Flickr account', MYSITE_ADMIN_TEXTDOMAIN ) );
		$control_ops = array('width' => 400, 'height' => 200);
		$this->WP_Widget( 'flickr', sprintf( __( '%1$s - Flickr', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {	
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Photos on flickr', MYSITE_TEXTDOMAIN ) : $instance['title'], $instance, $this->id_base);
		$id = $instance['id'];
		$display = $instance['display'];
		$size = $instance['size'];
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		?>

			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				<div class="flickr_wrap">
					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $display; ?>&amp;size=<?php echo $size; ?>&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script> 
				</div>
			<?php echo $after_widget; ?>

		<?php
    }

	/**
	 *
	 */
    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['display'] = strip_tags($new_instance['display']);
		$instance['size'] = strip_tags($new_instance['size']);

		return $instance;
    }

	/**
	 *
	 */
    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
		$display = isset($instance['display']) ? $instance['display'] : 'latest';
		$size = isset($instance['size']) ? $instance['size'] : 's';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e( 'Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" /></p>
			
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of photos:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('display'); ?>"><?php _e( 'Display:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<select name="<?php echo $this->get_field_name('display'); ?>" id="<?php echo $this->get_field_id('display'); ?>" class="widefat">
		<option value="latest"<?php selected($display,'latest');?>>Latest</option>
		<option value="random"<?php selected($display,'random');?>>Random</option>
		</select></p>
		
		<div style="display:none;">
		<p><label for="<?php echo $this->get_field_id('size'); ?>"><?php _e( 'Size:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<select name="<?php echo $this->get_field_name('size'); ?>" id="<?php echo $this->get_field_id('size'); ?>" class="widefat">
		<option value="s"<?php selected($size,'square');?>><?php _e( 'Square', MYSITE_ADMIN_TEXTDOMAIN ); ?></option>
		<option value="t"<?php selected($size,'thumbnail');?>><?php _e( 'Thumbnail', MYSITE_ADMIN_TEXTDOMAIN ); ?></option>
		<option value="m"<?php selected($size,'medium');?>><?php _e( 'Medium', MYSITE_ADMIN_TEXTDOMAIN ); ?></option>
		</select></p>
		</div>

	<?php 
    }

}

?>
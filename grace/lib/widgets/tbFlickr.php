<?php

// get flickr images
class TB_Flickr extends WP_Widget {
	
	function TB_Flickr() {
		$widget_ops = array('classname' => 'tb_flickr',	'description' => __( 'Displays images from your Flickr account.', 'grace') );
		$this->WP_Widget('TB_Flickr', __('ThemeBlossom:  Flickr', 'grace'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Flickr Photo Stream', 'grace') : $instance['title'], $instance, $this->id_base);
	  	$number = (int) strip_tags($instance['number']);
	  	
		$display = (int) strip_tags($instance['display']);
		if ($display) {$display = 'random';} else {$display = 'latest';}
		
	  	$id = strip_tags($instance['id']);
	  	$url = strip_tags($instance['url']);
		$button =  esc_attr($instance['button']);
		$buttonColor =  esc_attr($instance['button_color']);
		$buttonSize =  esc_attr($instance['button_size']);
		$buttonTarget =  esc_attr($instance['button_target']);
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

		?>
        <div class="flickrWidget">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $display; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>
            <div class="clear"></div>
        
		<?php
		
		if (empty($url)) {
        	$url = 'http://www.flickr.com/photos/' . $id .'/sets';
        } ?>
		
		<?php echo do_shortcode("[button size='$buttonSize' link='$url' align='center' color='$buttonColor' target='$buttonTarget']$button" . '[/button]'); ?>
		
        </div>
		
		<?php
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['number'] = (int) strip_tags($new_instance['number']);
		$instance['display'] = (int) strip_tags($new_instance['display']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['button'] =  esc_attr($new_instance['button']);
		$instance['button_color'] =  esc_attr($new_instance['button_color']);
		$instance['button_size'] =  esc_attr($new_instance['button_size']);
		$instance['button_target'] =  esc_attr($new_instance['button_target']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'number' => 9, 'title'=>'Flickr Photo Stream', 'display' => 0, 'id' => '', 'button' => 'View more', 'button_color' => 'custom', 'button_size' => 'small', 'button_target' => '_self' ) );
		$number = (int) strip_tags($instance['number']);
		$display =  (int) strip_tags($instance['display']);
		$title =  strip_tags($instance['title']);
		$id =  strip_tags($instance['id']);
		$url =  strip_tags($instance['url']);
		$button =  esc_attr($instance['button']);
		$buttonColor =  esc_attr($instance['button_color']);
		$buttonSize =  esc_attr($instance['button_size']);
		$buttonTarget =  esc_attr($instance['button_target']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID:', 'grace'); ?> (<a href="http://www.idgettr.com" target="_blank">idGettr</a>)</label>
	        <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo esc_attr($id); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Flickr URL:', 'grace'); ?> (leave blank if you want to show photosets of user with above entered id)</label>
	        <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Photos:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo absint($number); ?>" />
        </p>
            
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>"<?php checked( $display ); ?> value="1" />
            <label for="<?php echo $this->get_field_id('display'); ?>"><?php _e( 'Random order', 'grace' ); ?></label>
		</p>
	
        <p>
        	<label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Button Title:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo esc_attr($button); ?>" />
        </p>
        
        <p>
        	<select id="<?php echo $this->get_field_id('button_color'); ?>" name="<?php echo $this->get_field_name('button_color'); ?>">
            
            	<?php $colorArray = array('Custom', 'White', 'Gray', 'Black', 'Light Blue', 'Blue', 'Dark Blue', 'Light Green', 'Green', 'Dark Green', 'Light Red', 'Red', 'Dark Red', 'Yellow', 'Orange', 'Brown'); ?>
                <?php
					foreach ($colorArray as $color) {
						$colorVal = strtolower(str_replace(' ', '', $color));
				?>
                    	<option value="<?php echo $colorVal; ?>" <?php if ($colorVal == $buttonColor) {echo 'selected="selected"';} ?>><?php echo $color; ?></option>
                    	<?php
					}
				?>
            </select>
            <label for="<?php echo $this->get_field_id('button_color'); ?>"><?php _e( 'Choose button color', 'grace' ); ?></label>
        </p>
        
        <p>
        	<select id="<?php echo $this->get_field_id('button_size'); ?>" name="<?php echo $this->get_field_name('button_size'); ?>">
            
            	<?php $sizeArray = array('Small', 'Medium', 'Large'); ?>
                <?php
					foreach ($sizeArray as $size) {
						$sizeVal = strtolower(str_replace(' ', '', $size));
				?>
                    	<option value="<?php echo $sizeVal; ?>" <?php if ($sizeVal == $buttonSize) {echo 'selected="selected"';} ?>><?php echo $size; ?></option>
                    	<?php
					}
				?>
            </select>
            <label for="<?php echo $this->get_field_id('button_size'); ?>"><?php _e( 'Choose button size', 'grace' ); ?></label>
        </p>
        
        <p>
        	<select id="<?php echo $this->get_field_id('button_target'); ?>" name="<?php echo $this->get_field_name('button_target'); ?>">
            
            	<?php $targetArray = array('_self' => 'Same Window', '_blank' => 'New Window'); ?>
                <?php
					foreach ($targetArray as $key => $value) { ?>
                    	<option value="<?php echo $key; ?>" <?php if ($key == $buttonTarget) {echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                    	<?php
					}
				?>
            </select>
            <label for="<?php echo $this->get_field_id('button_target'); ?>"><?php _e( 'Choose button target', 'grace' ); ?></label>
        </p>
	<?php
	}
}

function tb_register_flickr() {

	register_widget('TB_Flickr');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_flickr', 1);

?>
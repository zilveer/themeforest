<?php

// Home page widget
class TB_Highlight extends WP_Widget {
	
	function TB_Highlight() {
		$widget_ops = array('classname' => 'tb_highlight', 'description' => __( 'Show higlights of your work/services/campaign with this widget', 'grace') );		
		$this->WP_Widget('TB_Highlight', __('ThemeBlossom: Highlight', 'grace'), $widget_ops);	
	}
	
	function widget( $args, $instance ) {
		
		extract($args);
		
		$text =  esc_attr($instance['text']);
		$img =  esc_url($instance['img']);
		$typeOfLink = intval($instance['type']);
		$pageLink = intval($instance['pageLink']);
		$manual =  esc_url($instance['manual']);
		$button =  esc_attr($instance['button']);
		$buttonColor =  esc_attr($instance['button_color']);
		$buttonSize =  esc_attr($instance['button_size']);
		$buttonTarget =  esc_attr($instance['button_target']);
		$frame = intval($instance['frame']);
		
		echo $before_widget;

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Home Page Widget', 'grace') : $instance['title'], $instance, $this->id_base);	
		
		if ($typeOfLink == 0) {
			$url = get_permalink($pageLink);
		} else {
			$url = $manual;
		}

		if ( $title ) echo $before_title . $title . $after_title;
		
		if ($img) { ?>
			<a href="<?php echo $url; ?>" class="thumb"><img src="<?php echo $img; ?>" alt="<?php echo $title; ?>" <?php if ($frame) echo 'class="imageBorder tb_widget_image"'; ?>></a>
		<?php
		}
        
		?>
        
        <?php echo apply_filters('the_content', $text); ?>
		
		<?php echo do_shortcode("[button size='$buttonSize' link='$url' align='center' color='$buttonColor' target='$buttonTarget']$button" . '[/button]'); ?>
        
        <?php
			
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['title'] =  esc_attr($new_instance['title']);
		$instance['text'] =  esc_attr($new_instance['text']);
		$instance['img'] =  esc_attr($new_instance['img']);
		$instance['type'] = intval($new_instance['type']);
		$instance['pageLink'] = intval($new_instance['pageLink']);
		$instance['manual'] =  esc_url($new_instance['manual']);
		$instance['button'] =  esc_attr($new_instance['button']);
		$instance['button_color'] =  esc_attr($new_instance['button_color']);
		$instance['button_size'] =  esc_attr($new_instance['button_size']);
		$instance['button_target'] =  esc_attr($new_instance['button_target']);
		$instance['frame'] = intval($new_instance['frame']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title'=>'Home Page Widget', 'text' => '', 'img' => '', 'type' => '0', 'pageLink' => '0', 'manual' => '', 'button' => 'Read more', 'button_color' => 'custom', 'button_size' => 'small', 'button_target' => '_self', 'frame' => '1' ) );
		
		$title =  esc_attr($instance['title']);
		$text =  esc_attr($instance['text']);
		$img =  esc_attr($instance['img']);
		$typeOfLink = intval($instance['type']);
		$pageLink = intval($instance['pageLink']);
		$manual =  esc_url($instance['manual']);
		$button =  esc_attr($instance['button']);
		$buttonColor =  esc_attr($instance['button_color']);
		$buttonSize =  esc_attr($instance['button_size']);
		$buttonTarget =  esc_attr($instance['button_target']);
		$frame = intval($instance['frame']);
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        
        <p>
	        <textarea style="width: 226px; height: 100px; overflow: hidden;" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text');?>"><?php echo esc_attr($text); ?></textarea>
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('img'); ?>"><?php _e('Image URL:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" type="text" value="<?php echo esc_attr($img); ?>" />
		</p>
        
        <p>
        	<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
            
            	<?php $typeArray = array('Page', 'Manual Link'); ?>
                <?php $typeValue = 0; ?>
                <?php
					while ($typeValue < 2) { ?>
                    	<option value="<?php echo $typeValue; ?>" <?php if ($typeValue == $typeOfLink) {echo 'selected="selected"';} ?>><?php echo $typeArray[$typeValue]; ?></option>
                    	<?php
						$typeValue++;
					}
				?>
            </select>
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Choose type of link', 'grace' ); ?></label>
        </p>
        
        <p>
        	<?php $tbPages = tb_get_pages('page', 'widget'); ?>
            <select id="<?php echo $this->get_field_id('pageLink'); ?>" name="<?php echo $this->get_field_name('pageLink'); ?>"
            	<option value="0" <?php if (!$pageLink) { echo 'selected="selected"'; } ?>>Choose Page...</option>
            	<?php
				foreach ($tbPages as $key => $value) {
					$tbPageID = $key;
					$tbPageTitle = $value;
					?>
					
					<option value="<?php echo $tbPageID; ?>" <?php if ($pageLink == $tbPageID) { echo 'selected="selected"'; } ?>><?php echo $tbPageTitle; ?></option>
                    
                <?php
				} ?>
            </select>
            <label for="<?php echo $this->get_field_id('pageLink'); ?>"><?php _e( 'Choose page', 'grace' ); ?></label>
        </p>
	
        <p>
        	<label for="<?php echo $this->get_field_id('manual'); ?>"><?php _e('Manual Link:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('manual'); ?>" name="<?php echo $this->get_field_name('manual'); ?>" type="text" value="<?php echo esc_url($manual); ?>" />
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
        
        <p>
        	<select id="<?php echo $this->get_field_id('frame'); ?>" name="<?php echo $this->get_field_name('frame'); ?>">
            
            	<?php $frameArray = array('No frame', 'With frame'); ?>
                <?php $frameValue = 0; ?>
                <?php
					while ($frameValue < 2) { ?>
                    	<option value="<?php echo $frameValue; ?>" <?php if ($frameValue == $frame) {echo 'selected="selected"';} ?>><?php echo $frameArray[$frameValue]; ?></option>
                    	<?php
						$frameValue++;
					}
				?>
            </select>
            <label for="<?php echo $this->get_field_id('frame'); ?>"><?php _e( 'Do you want a frame?', 'grace' ); ?></label>
        </p>
	<?php
	}
}

function tb_register_home_page_widget() {
	
	register_widget('TB_Highlight');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_home_page_widget', 1);

?>
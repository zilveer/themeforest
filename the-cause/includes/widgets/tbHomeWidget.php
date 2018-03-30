<?php

// Home page widget
class TB_Home_Page_Widget extends WP_Widget {
	
	function TB_Home_Page_Widget() {
		$widget_ops = array('classname' => 'tb_home_page_widget', 'description' => __( 'Show higlights of your work/services/campaign with this widget', 'the-cause') );		
		$this->WP_Widget('TB_Home_Page_Widget', __('TB Home Page Widget', 'the-cause'), $widget_ops);	
	}
	
	function widget( $args, $instance ) {
		
		extract($args);
		
		$text =  esc_attr($instance['text']);
		$img =  esc_url($instance['img']);
		$typeOfLink = intval($instance['type']);
		$pageLink = intval($instance['pageLink']);
		$manual =  esc_url($instance['manual']);
		$button =  esc_attr($instance['button']);
		$frame = intval($instance['frame']);
		
		echo $before_widget;

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Home Page Widget', 'the-cause') : $instance['title'], $instance, $this->id_base);	
		
		if ($typeOfLink == 0) {
			$url = get_permalink($pageLink);
		} else {
			$url = $manual;
		}
		
		if ($img) { ?>
		<div class="center">
		<?php
			if ($frame) {
			?>
			<a href="<?php echo $url; ?>" style="background-image: url('<?php echo $img; ?>');" class="highlightImage"><?php echo $title; ?>"></a>
			<?php
			} else {
			?>
			<a href="<?php echo $url; ?>"><img src="<?php echo $img; ?>" alt="<?php echo $title; ?>"></a>
			<?php			
			} ?>
		</div>
		<?php
		}

		if ( $title ) echo $before_title . '<a href="' . $url . '" title="' . $title . '">' . $title . '</a>' . $after_title;
        
		?>
        
        <p><?php echo $text; ?></p>
        
        <p class="center"><a href="<?php echo $url ?>" title="<?php echo $button; ?>" class="tinyButton"><?php echo $button; ?></a></p>
        
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
		$instance['frame'] = intval($new_instance['frame']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title'=>'Home Page Widget', 'text' => '', 'img' => '', 'type' => '0', 'pageLink' => '0', 'manual' => '', 'button' => 'Read more', 'frame' => '0' ) );
		
		$title =  esc_attr($instance['title']);
		$text =  esc_attr($instance['text']);
		$img =  esc_attr($instance['img']);
		$typeOfLink = intval($instance['type']);
		$pageLink = intval($instance['pageLink']);
		$manual =  esc_url($instance['manual']);
		$button =  esc_attr($instance['button']);
		$frame = intval($instance['frame']);
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        
        <p>
	        <textarea style="width: 226px; height: 100px; overflow: hidden;" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text');?>"><?php echo esc_attr($text); ?></textarea>
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('img'); ?>"><?php _e('Image URL:', 'the-cause'); ?></label>
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
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Choose type of link', 'the-cause' ); ?></label>
        </p>
        
        <p>
        	<?php $tbPages = tb_get_pages(); ?>
            <select id="<?php echo $this->get_field_id('pageLink'); ?>" name="<?php echo $this->get_field_name('pageLink'); ?>"
            	<option value="0" <?php if (!$pageLink) { echo 'selected="selected"'; } ?>>Choose Page...</option>
            	<?php
				foreach ($tbPages as $tbPage) {
					$tbPageID = $tbPage->ID;
					$tbPageTitle = $tbPage->post_title;
					?>
					
					<option value="<?php echo $tbPageID; ?>" <?php if ($pageLink == $tbPageID) { echo 'selected="selected"'; } ?>><?php echo $tbPageTitle; ?></option>
                    
                <?php
				} ?>
            </select>
            <label for="<?php echo $this->get_field_id('pageLink'); ?>"><?php _e( 'Choose page', 'the-cause' ); ?></label>
        </p>
	
        <p>
        	<label for="<?php echo $this->get_field_id('manual'); ?>"><?php _e('Manual Link:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('manual'); ?>" name="<?php echo $this->get_field_name('manual'); ?>" type="text" value="<?php echo esc_url($manual); ?>" />
        </p>
	
        <p>
        	<label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Button Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo esc_attr($button); ?>" />
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
            <label for="<?php echo $this->get_field_id('frame'); ?>"><?php _e( 'Do you want a frame?', 'the-cause' ); ?></label>
        </p>
	<?php
	}
}

function tb_register_home_page_widget() {
	
	register_widget('TB_Home_Page_Widget');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_home_page_widget', 1);

?>
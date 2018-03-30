<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_toggles");'));

class DF_toggles extends WP_Widget {
	function DF_toggles() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Toggles Widget');	
	}

	function form($instance) {

		 $title = esc_attr($instance['title']);
		 $toggletitle = esc_attr($instance['toggletitle']);
		 $text = esc_attr($instance['text']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Widget Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('toggletitle'); ?>"><?php printf ( __( 'Toggle Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('toggletitle'); ?>" name="<?php echo $this->get_field_name('toggletitle'); ?>" type="text" value="<?php echo $toggletitle; ?>" /></label></p>

			
			<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php  printf ( __( 'Text:' , THEME_NAME )); ?> <textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></label></p>

		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['toggletitle'] = strip_tags($new_instance['toggletitle']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$text = $instance['text'];
		$toggletitle = $instance['toggletitle'];
		
?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
                  <div class="toggle">
                      <h4 class="title"><?php echo $toggletitle;?></h4>
                      <div class="togglebox">
                          <div>
                              <p><?php echo stripslashes($text);?></p>
                          </div>
                      </div>
                  </div>
	<?php echo $after_widget; ?>
		
	
      <?php
	}
}
?>

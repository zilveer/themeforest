<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_flickr");'));

class DF_flickr extends WP_Widget {
	function DF_flickr() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Flickr Widget');	
	}

	function form($instance) {

		 $title = esc_attr($instance['title']);
		 $flickr = esc_attr($instance['flickr']);
		 $count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

			<p>Flickr Id form in your photostream of flickr profile. You can find it here <a href="http://idgettr.com/" target="_blank">http://idgettr.com/</a></p>
			<p><label for="<?php echo $this->get_field_id('flickr'); ?>"><?php printf ( __( 'Flickr ID:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $flickr; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Count:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr'] = strip_tags($new_instance['flickr']);
		$instance['count'] = strip_tags($new_instance['count']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$flickr = $instance['flickr'];
		$count = $instance['count'];
		if(!$count) $count = 8;
?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
			<div class="flickr <?php echo $args['widget_id'];?>"></div>
			<script>
				// Flickr Feed
				jQuery('.<?php echo $args['widget_id'];?>').jflickrfeed({
					limit: <?php echo $count;?>,
					qstrings: {
						id: '<?php echo $flickr;?>'
					}
				});			
			</script>
	<?php echo $after_widget; ?>
		
	
      <?php
	}
}
?>

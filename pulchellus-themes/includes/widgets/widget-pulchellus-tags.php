<?php
add_action('widgets_init', create_function('', 'return register_widget("adeodatus_tags");'));

class adeodatus_tags extends WP_Widget {
	function adeodatus_tags() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Tags');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
		 $count = esc_attr($instance['count']);

        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:', THEME_NAME); ?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $count = apply_filters('widget_title', $instance['count']);

        ?>
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
        <ul class="tags">
			<?php
				$posttags = get_tags();
				$html ="";
				if ($posttags) {
					$c=1;
					foreach($posttags as $tag) {
						
						$tag_link = get_tag_link($tag->term_id);
														
						$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
						$html .= "{$tag->name}</a></li>";
						if($c==$count) break;
						$c++;
						
					}
				}
									
				echo $html;
			?>
		</ul>
	<?php echo $after_widget; ?>

        <?php
	}
}
?>
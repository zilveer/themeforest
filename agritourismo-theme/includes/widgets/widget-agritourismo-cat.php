<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_cats");'));

class OT_cats extends WP_Widget {
	function OT_cats() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Categories');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
 

        ?>
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
			<ul>
				<?php
					$posttags = get_categories(array('type'=> 'post','taxonomy' => 'category'));
					if ($posttags) {
						foreach($posttags as $tag) {
							$tag_link = get_category_link($tag->term_id);
							$titleColor = ot_title_color($tag->term_id, "category", false);
							if($tag->count>0) {			
								echo '<li>
										<div class="seperator"></div>';
										if($tag->count<=1) {	
											echo '<span class="right">'.$tag->count.__(" article", THEME_NAME).'</span>';
										} else {
											echo '<span class="right">'.$tag->count.__(" articles", THEME_NAME).'</span>';
										}
										echo '<a href="'.$tag_link.'">'.$tag->name.'</a>
									</li>';
							}	
							
						}
					}
								

				?>
			</ul>


	
	<?php echo $after_widget; ?>
        <?php
	}
}
?>
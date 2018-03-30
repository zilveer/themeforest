<?php
class obox_facebook_widget extends WP_Widget {
    /** constructor */
    function obox_facebook_widget() {
        parent::WP_Widget(false, $name = __('(Obox) Facebook Like Box', 'ocmx'), $widget_options = __('Display a Facebook Like Box.','ocmx'));	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        if(isset($instance["title"]))
			$title = esc_attr($instance["title"]);
		if(isset($instance["facebookpage"]))
			$facebookpage = esc_attr($instance["facebookpage"]);
		if(isset($instance["height"]))
			$height = esc_attr($instance["height"]);
		if(isset($instance["faces"]))
			$faces = esc_attr($instance["faces"]);
		if(isset($instance["colorscheme"]))
			$colorscheme = esc_attr($instance["colorscheme"]);
		if(isset($instance["stream"]))
			$stream = esc_attr($instance["stream"]);
		if(isset($instance["border"]))
			$border = esc_attr($instance["border"]);
        
        
		echo $before_widget; ?>
			<?php echo $before_title; ?>
            	<a href="https://www.facebook.com/<?php echo $facebookpage; ?>" target="_blank"><?php echo $instance['title']; ?></a>
            <?php echo $after_title; ?>
		
            <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo $facebookpage; ?>&amp;width=300&amp;height=<?php echo $height; ?>&amp;show_faces=<?php echo $faces; ?>&amp;colorscheme=light&amp;stream=<?php echo $stream; ?>&amp;border_color&amp;header=false&amp;appId=289052711225982" scrolling="no" frameborder="0" style="width:100%; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
           
        <?php echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        if(isset($instance["title"]))
			$title = esc_attr($instance["title"]);
		if(isset($instance["facebookpage"]))
			$facebookpage = esc_attr($instance["facebookpage"]);
		if(isset($instance["height"]))
			$height = esc_attr($instance["height"]);
		if(isset($instance["faces"]))
			$faces = esc_attr($instance["faces"]);
		if(isset($instance["colorscheme"]))
			$colorscheme = esc_attr($instance["colorscheme"]);
		if(isset($instance["stream"]))
			$stream = esc_attr($instance["stream"]);
		if(isset($instance["border"]))
			$border = esc_attr($instance["border"]);
		
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            
            <p>
            	<label for="<?php echo $this->get_field_id('facebookpage'); ?>">
                	Facebook Page Name
                	<input class="widefat" id="<?php echo $this->get_field_id('facebookpage'); ?>" name="<?php echo $this->get_field_name('facebookpage'); ?>" type="text" value="<?php echo $facebookpage; ?>" />
	                <small class="obox-widget-tip">Example: Obox Themes</small>
				</label>
			</p>
            
            <p>
            	<label for="<?php echo $this->get_field_id('height'); ?>">
	                Height (in pixels)
            		<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
	                <small class="obox-widget-tip">Example: 300</small>
            	</label>
            </p>
			
			<p>
            	<label for="<?php echo $this->get_field_id('faces'); ?>">Show Faces
	                <select size="1" class="widefat" id="<?php echo $this->get_field_id('faces'); ?>" name="<?php echo $this->get_field_name('faces'); ?>">
	                    <option <?php if($faces == "true") : ?>selected="selected"<?php endif; ?> value="true">Yes</option>
	                    <option <?php if($faces == "false") : ?>selected="selected"<?php endif; ?> value="false">No</option>
	                </select>
                </label>
			</p>
			
			<p>
            	<label for="<?php echo $this->get_field_id('stream'); ?>">Show Stream
	                <select size="1" class="widefat" id="<?php echo $this->get_field_id('stream'); ?>" name="<?php echo $this->get_field_name('stream'); ?>">
	                    <option <?php if($stream == "true") : ?>selected="selected"<?php endif; ?> value="true">Yes</option>
	                    <option <?php if($stream == "false") : ?>selected="selected"<?php endif; ?> value="false">No</option>
	                </select>
                </label>
			</p>	

        <?php 
    }

} // class FooWidget

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("obox_facebook_widget");'));
?>
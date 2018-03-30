<?php
class footer_box_widget extends WP_Widget 
{
	/** constructor */
    function footer_box_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'footer_box_widget',
			'description' => 'Displays Box with some content'
		);
		$control_options = array('width' => 332);
        parent::__construct('gymbase_footer_box', __('Footer Box', 'gymbase'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
		global $themename;
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : "";
		$title_color = isset($instance['title_color']) ? $instance['title_color'] : "";
		$url = isset($instance['url']) ? $instance['url'] : "";
		$subtitle = isset($instance['subtitle']) ? $instance['subtitle'] : "";
		$subtitle_color = isset($instance['subtitle_color']) ? $instance['subtitle_color'] : "";
		$color = isset($instance['color']) ? $instance['color'] : "";
		$custom_color = isset($instance['custom_color']) ? $instance['custom_color'] : "";
		$icon = isset($instance['icon']) ? $instance['icon'] : "";

		echo $before_widget;
		?>
		<li class="footer_banner_box <?php echo $color; ?>"<?php echo ($custom_color!="" ? ' style="background-color: #' . $custom_color . '"' : ''); ?>>
			<?php if($icon!=""): ?>
			<span class="banner_icon <?php echo $icon; ?>"></span>
			<?php endif; ?>
			<div class="content">
				<?php
				if($title) 
				{
					if($title_color!="")
						$before_title = str_replace(">", " style='color: #" . $title_color . ";'>",$before_title);
					echo $before_title . ($url!="" ? '<a href="' . esc_attr($url) . '"' . ($title_color!="" ? ' style="color: #' . $title_color . ';"' : '') . ' title="' . $title . '">' : '') . $title . ($url!="" ? '</a>' : '') . $after_title;
				}
				?>
				<?php if($subtitle!=""): ?>
				<h3<?php echo ($subtitle_color!="" ? " style='color: #" . $subtitle_color . ";'" : ""); ?>><?php echo $subtitle; ?></h3>
				<?php endif; ?>
			</div>
		</li>
		<?php
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
		$instance['title_color'] = isset($new_instance['title_color']) ? strip_tags($new_instance['title_color']) : '';
		$instance['url'] = isset($new_instance['url']) ? strip_tags($new_instance['url']) : '';
		$instance['subtitle'] = isset($new_instance['subtitle']) ? strip_tags($new_instance['subtitle']) : '';
		$instance['subtitle_color'] = isset($new_instance['subtitle_color']) ? strip_tags($new_instance['subtitle_color']) : '';
		$instance['color'] = isset($new_instance['color']) ? strip_tags($new_instance['color']) : '';
		$instance['custom_color'] = isset($new_instance['custom_color']) ? strip_tags($new_instance['custom_color']) : '';
		$instance['icon'] = isset($new_instance['icon']) ? strip_tags($new_instance['icon']) : '';
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$title_color = isset($instance['title_color']) ? esc_attr($instance['title_color']) : '';
		$url = isset($instance['url']) ? esc_attr($instance['url']) : '';
		$subtitle = isset($instance['subtitle']) ? esc_attr($instance['subtitle']) : '';
		$subtitle_color = isset($instance['subtitle_color']) ? esc_attr($instance['subtitle_color']) : '';
		$color = isset($instance['color']) ? esc_attr($instance['color']) : '';
		$custom_color = isset($instance['custom_color']) ? esc_attr($instance['custom_color']) : '';
		$icon = isset($instance['icon']) ? esc_attr($instance['icon']) : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Title color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('title_color'); ?>" name="<?php echo $this->get_field_name('title_color'); ?>" type="text" value="<?php echo $title_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Url', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('subtitle_color'); ?>"><?php _e('Subtitle color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('subtitle_color'); ?>" name="<?php echo $this->get_field_name('subtitle_color'); ?>" type="text" value="<?php echo $subtitle_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color', 'gymbase'); ?></label>
			<select id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>">
				<option <?php echo ($color=='super_light_green' ? ' selected="selected"':'');?> value='super_light_green'><?php _e("super_light_green", 'gymbase'); ?></option>
				<option <?php echo ($color=='light_green' ? ' selected="selected"':'');?> value='light_green'><?php _e("light_green", 'gymbase'); ?></option>
				<option <?php echo ($color=='green' ? ' selected="selected"':'');?> value='green'><?php _e("green", 'gymbase'); ?></option>
			</select>
			<?php _e('or pick custom one: ', 'gymbase'); ?>
			<input type="text" class="regular-text color" value="<?php echo $custom_color; ?>" id="<?php echo $this->get_field_id('custom_color'); ?>" name="<?php echo $this->get_field_name('custom_color'); ?>" data-default-color="FFFFFF">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon', 'gymbase'); ?></label>
			<select id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>">
				<option <?php echo ($icon=='-' ? ' selected="selected"':'');?> value='-'>-</option>
				<option <?php echo ($icon=='calendar' ? ' selected="selected"':'');?> value='calendar'><?php _e("calendar", 'gymbase'); ?></option>
				<option <?php echo ($icon=='hand' ? ' selected="selected"':'');?> value='hand'><?php _e("hand", 'gymbase'); ?></option>
				<option <?php echo ($icon=='note' ? ' selected="selected"':'');?> value='note'><?php _e("note", 'gymbase'); ?></option>
				<option <?php echo ($icon=='phone' ? ' selected="selected"':'');?> value='phone'><?php _e("phone", 'gymbase'); ?></option>
			</select>
		</p>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$("[id$='<?php echo $this->id; ?>'] .color").ColorPicker({
				onChange: function(hsb, hex, rgb, el) {
					$(el).val(hex);
				},
				onSubmit: function(hsb, hex, rgb, el){
					$(el).val(hex);
					$(el).ColorPickerHide();
				},
				onBeforeShow: function (){
					var color = (this.value!="" ? this.value : $(this).attr("data-default-color"));
					console.log(color);
					$(this).ColorPickerSetColor(color);
				}
			}).on('keyup', function(event, param){
				$(this).ColorPickerSetColor(this.value);
			});
		});
		</script>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("footer_box_widget");'));
?>
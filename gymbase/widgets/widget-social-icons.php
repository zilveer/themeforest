<?php
class social_icons_widget extends WP_Widget 
{
	/** constructor */
    function social_icons_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'social_icons_widget',
			'description' => 'Displays Social Icons'
		);
		$control_options = array('width' => 460);
        parent::__construct('gymbase_social_icons', __('Social Icons', 'gymbase'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
		global $themename;
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : '';
		$icon_type = isset($instance['icon_type']) ? $instance["icon_type"] : '';
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : '';
		$icon_target = isset($instance['icon_target']) ? $instance["icon_target"] : '';

		echo $before_widget;
		if($title) 
		{
			echo $before_title . $title . $after_title;
		} 
		$arrayEmpty = true;
		for($i=0; $i<count($icon_type); $i++)
		{
			if($icon_type[$i]!="")
				$arrayEmpty = false;
		}
		if(!$arrayEmpty):
		?>
		<ul class="social_icons clearfix">
			<?php
			for($i=0; $i<count($icon_type); $i++)
			{
				if($icon_type[$i]!=""):
			?>
			<li><a <?php echo ($icon_target[$i]=="new_window" ? " target='_blank'" : ""); ?>href="<?php echo $icon_value[$i];?>" class="social_icon <?php echo $icon_type[$i]; ?>"></a></li>
			<?php
				endif;
			}
			?>
		</ul>
		<?php
		endif;
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? $new_instance['title'] : '';
		$instance['icon_type'] = isset($new_instance['icon_type']) ? $new_instance['icon_type'] : '';
		$instance['icon_value'] = isset($new_instance['icon_value']) ? $new_instance['icon_value'] : '';
		$instance['icon_target'] = isset($new_instance['icon_target']) ? $new_instance['icon_target'] : '';
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$icon_type = isset($instance['icon_type']) ? $instance["icon_type"] : '';
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : '';
		$icon_target = isset($instance['icon_target']) ? $instance["icon_target"] : '';
		$icons = array(
			"facebook",
			"google",
			"skype",
			"twitter",
			"instagram",
			"linkedin",
			"mail",
			"reddit",
			"stumbleupon",
			"tumblr",
			"pinterest",
		);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php
		for($i=0; $i<4; $i++)
		{
		?>
		<p>
			<label for="<?php echo $this->get_field_id('icon_type') . $i; ?>"><?php _e('Icon type', 'gymbase'); ?></label>
			<select id="<?php echo $this->get_field_id('icon_type') . $i; ?>" name="<?php echo $this->get_field_name('icon_type'); ?>[]">
				<option value="">-</option>
				<?php for($j=0; $j<count($icons); $j++)
				{
				?>
				<option value="<?php echo $icons[$j]; ?>"<?php echo (isset($icon_type[$i]) && $icons[$j]==$icon_type[$i] ? " selected='selected'" : "") ?>><?php echo $icons[$j]; ?></option>
				<?php
				}
				?>
			</select>
			<input style="width: 220px;" type="text" class="regular-text" value="<?php echo isset($icon_type[$i]) ? $icon_value[$i] : ''; ?>" name="<?php echo $this->get_field_name('icon_value'); ?>[]">
			<select name="<?php echo $this->get_field_name('icon_target'); ?>[]">
				<option value="same_window"<?php echo (isset($icon_target[$i]) && $icon_target[$i]=="same_window" ? " selected='selected'" : ""); ?>>same window</option>
				<option value="new_window"<?php echo (isset($icon_target[$i]) && $icon_target[$i]=="new_window" ? " selected='selected'" : ""); ?>>new window</option>
			</select>
		</p>
		<?php
		}
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("social_icons_widget");'));
?>
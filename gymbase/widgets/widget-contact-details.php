<?php
class contact_details_widget extends WP_Widget 
{
	/** constructor */
    function contact_details_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'contact_details_widget',
			'description' => 'Displays Contact Details Box'
		);
		$control_options = array('width' => 460);
        parent::__construct('gymbase_contact_details', __('Contact Details Box', 'gymbase'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
		global $themename;
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : '';
		$address_line_1 = isset($instance['address_line_1']) ? $instance['address_line_1'] : '';
		$address_line_2 = isset($instance['address_line_2']) ? $instance['address_line_2'] : '';
		$address_line_3 = isset($instance['address_line_3']) ? $instance['address_line_3'] : '';
		$contact_line_1 = isset($instance['contact_line_1']) ? $instance['contact_line_1'] : '';
		$contact_line_2 = isset($instance['contact_line_2']) ? $instance['contact_line_2'] : '';
		$contact_line_3 = isset($instance['contact_line_3']) ? $instance['contact_line_3'] : '';
		$icon_type = isset($instance['icon_type']) ? $instance["icon_type"] : '';
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : '';
		$icon_target = isset($instance['icon_target']) ? $instance["icon_target"] : '';

		echo $before_widget;
		if($title) 
		{
			echo $before_title . $title . $after_title;
		}
		?>
		<ul class="footer_contact_info_container clearfix">
			<li class="footer_contact_info_row">
				<div class="footer_contact_info_left">
					<?php echo $address_line_1; ?>
				</div>
				<div class="footer_contact_info_right">
					<?php echo $contact_line_1; ?>
				</div>
			</li>
			<li class="footer_contact_info_row">
				<div class="footer_contact_info_left">
					<?php echo $address_line_2; ?>
				</div>
				<div class="footer_contact_info_right">
					<?php echo $contact_line_2; ?>
				</div>
			</li>
			<li class="footer_contact_info_row">
				<div class="footer_contact_info_left">
					<?php echo $address_line_3; ?>
				</div>
				<div class="footer_contact_info_right">
					<?php echo $contact_line_3; ?>
				</div>
			</li>
		</ul>
		<?php 
		$arrayEmpty = true;
		for($i=0; $i<count($icon_type); $i++)
		{
			if($icon_type[$i]!="")
				$arrayEmpty = false;
		}
		if(!$arrayEmpty):
		?>
		<ul class="footer_social_icons clearfix">
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
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
		$instance['address_line_1'] = isset($new_instance['address_line_1']) ? $new_instance['address_line_1'] : '';
		$instance['address_line_2'] = isset($new_instance['address_line_2']) ? $new_instance['address_line_2'] : '';
		$instance['address_line_3'] = isset($new_instance['address_line_3']) ? $new_instance['address_line_3'] : '';
		$instance['contact_line_1'] = isset($new_instance['contact_line_1']) ? $new_instance['contact_line_1'] : '';
		$instance['contact_line_2'] = isset($new_instance['contact_line_2']) ? $new_instance['contact_line_2'] : '';
		$instance['contact_line_3'] = isset($new_instance['contact_line_3']) ? $new_instance['contact_line_3'] : '';
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
		$address_line_1 = isset($instance['address_line_1']) ? esc_attr($instance['address_line_1']) : '';
		$address_line_2 = isset($instance['address_line_2']) ? esc_attr($instance['address_line_2']) : '';
		$address_line_3 = isset($instance['address_line_3']) ? esc_attr($instance['address_line_3']) : '';
		$contact_line_1 = isset($instance['contact_line_1']) ? esc_attr($instance['contact_line_1']) : '';
		$contact_line_2 = isset($instance['contact_line_2']) ? esc_attr($instance['contact_line_2']) : '';
		$contact_line_3 = isset($instance['contact_line_3']) ? esc_attr($instance['contact_line_3']) : '';
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
		<p>
			<label for="<?php echo $this->get_field_id('address_line_1'); ?>"><?php _e('address_line_1', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address_line_1'); ?>" name="<?php echo $this->get_field_name('address_line_1'); ?>" type="text" value="<?php echo $address_line_1; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address_line_2'); ?>"><?php _e('address_line_2', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address_line_2'); ?>" name="<?php echo $this->get_field_name('address_line_2'); ?>" type="text" value="<?php echo $address_line_2; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address_line_3'); ?>"><?php _e('address_line_3', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address_line_3'); ?>" name="<?php echo $this->get_field_name('address_line_3'); ?>" type="text" value="<?php echo $address_line_3; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contact_line_1'); ?>"><?php _e('contact_line_1', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('contact_line_1'); ?>" name="<?php echo $this->get_field_name('contact_line_1'); ?>" type="text" value="<?php echo $contact_line_1; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contact_line_2'); ?>"><?php _e('contact_line_2', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('contact_line_2'); ?>" name="<?php echo $this->get_field_name('contact_line_2'); ?>" type="text" value="<?php echo $contact_line_2; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contact_line_3'); ?>"><?php _e('contact_line_3', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('contact_line_3'); ?>" name="<?php echo $this->get_field_name('contact_line_3'); ?>" type="text" value="<?php echo $contact_line_3; ?>" />
		</p>
		<?php
		for($i=0; $i<4; $i++)
		{
		?>
		<p>
			<label for="<?php echo $this->get_field_id('icon_type') . $i; ?>"><?php _e('Icon type', 'gymbase'); ?></label>			
			<select id="<?php echo $this->get_field_id('icon_type') . $i; ?>" name="<?php echo $this->get_field_name('icon_type'); ?>[]">
				<option value="">-</option>
				<?php
				for($j=0; $j<count($icons); $j++)
				{
				?>
				<option value="<?php echo $icons[$j]; ?>"<?php echo (isset($icon_type[$i]) && $icons[$j]==$icon_type[$i] ? " selected='selected'" : "") ?>><?php echo $icons[$j]; ?></option>
				<?php
				}
				?>
			</select>
			<input style="width: 220px;" type="text" class="regular-text" value="<?php echo isset($icon_value[$i]) ? $icon_value[$i] : ''; ?>" name="<?php echo $this->get_field_name('icon_value'); ?>[]">
			<select name="<?php echo $this->get_field_name('icon_target'); ?>[]">
				<option value="same_window"<?php echo (isset($icon_type[$i]) && $icon_target[$i]=="same_window" ? " selected='selected'" : ""); ?>><?php _e("same window", 'gymbase'); ?></option>
				<option value="new_window"<?php echo (isset($icon_type[$i]) && $icon_target[$i]=="new_window" ? " selected='selected'" : ""); ?>><?php _e("new window", 'gymbase'); ?></option>
			</select>
		</p>
		<?php
		}
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("contact_details_widget");'));
?>
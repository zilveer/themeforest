<?php
class mc_cart_icon_widget extends WP_Widget 
{
	/** constructor */
    function mc_cart_icon_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'mc_cart_icon_widget',
			'description' => 'Displays Shop Cart Icon'
		);
        parent::__construct('medicenter_cart_icon', __('Woocommerce Shop Cart Icon', 'medicenter'), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$icon_color = (isset($instance["icon_color"]) ? $instance["icon_color"] : "blue_light");
		$cart_items_number = (isset($instance["cart_items_number"]) ? $instance["cart_items_number"] : "");
		$icon_target = (isset($instance["icon_target"]) ? $instance["icon_target"] : "");

		echo $before_widget;
		echo do_shortcode("[mc_cart_icon icon_color='{$icon_color}' cart_items_number='{$cart_items_number}' icon_target='{$icon_target}']");
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['icon_color'] = (isset($new_instance["icon_color"]) ? $new_instance['icon_color'] : "");
		$instance['cart_items_number'] = (isset($new_instance["cart_items_number"]) ? strip_tags($new_instance['cart_items_number']) : "");
		$instance['icon_target'] = (isset($new_instance["icon_target"]) ? $new_instance['icon_target'] : "");
		
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{
		$icon_color = (isset($instance["icon_color"]) ? $instance["icon_color"] : "");
		$cart_items_number = (isset($instance["cart_items_number"]) ? esc_attr($instance["cart_items_number"]) : "");
		$icon_target = (isset($instance["icon_target"]) ? $instance["icon_target"] : "");
		?>
		<p>
			<label for="<?php echo $this->get_field_id('icon_color'); ?>"><?php _e('Icon style', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('icon_color'); ?>" name="<?php echo $this->get_field_name('icon_color'); ?>">
				<option value="blue_light"<?php echo (isset($icon_color) && $icon_color=="blue_light" ? ' selected="selected"' : ''); ?>><?php _e('light blue', 'medicenter'); ?></option>
				<option value="blue"<?php echo (isset($icon_color) && $icon_color=="blue" ? ' selected="selected"' : ''); ?>><?php _e('blue', 'medicenter'); ?></option>
				<option value="blue_dark"<?php echo (isset($icon_color) && $icon_color=="blue_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark blue', 'medicenter'); ?></option>
				<option value="black"<?php echo (isset($icon_color) && $icon_color=="black" ? ' selected="selected"' : ''); ?>><?php _e('black', 'medicenter'); ?></option>
				<option value="gray"<?php echo (isset($icon_color) && $icon_color=="gray" ? ' selected="selected"' : ''); ?>><?php _e('gray', 'medicenter'); ?></option>
				<option value="gray_dark"<?php echo (isset($icon_color) && $icon_color=="gray_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark gray', 'medicenter'); ?></option>
				<option value="gray_light"<?php echo (isset($icon_color) && $icon_color=="gray_light" ? ' selected="selected"' : ''); ?>><?php _e('light gray', 'medicenter'); ?></option>
				<option value="green"<?php echo (isset($icon_color) && $icon_color=="green" ? ' selected="selected"' : ''); ?>><?php _e('green', 'medicenter'); ?></option>
				<option value="green_dark"<?php echo (isset($icon_color) && $icon_color=="green_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark green', 'medicenter'); ?></option>
				<option value="green_light"<?php echo (isset($icon_color) && $icon_color=="green_light" ? ' selected="selected"' : ''); ?>><?php _e('light green', 'medicenter'); ?></option>
				<option value="orange"<?php echo (isset($icon_color) && $icon_color=="orange" ? ' selected="selected"' : ''); ?>><?php _e('orange', 'medicenter'); ?></option>
				<option value="orange_dark"<?php echo (isset($icon_color) && $icon_color=="orange_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark orange', 'medicenter'); ?></option>
				<option value="orange_light"<?php echo (isset($icon_color) && $icon_color=="orange_light" ? ' selected="selected"' : ''); ?>><?php _e('light orange', 'medicenter'); ?></option>
				<option value="red"<?php echo (isset($icon_color) && $icon_color=="red" ? ' selected="selected"' : ''); ?>><?php _e('red', 'medicenter'); ?></option>
				<option value="red_dark"<?php echo (isset($icon_color) && $icon_color=="red_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark red', 'medicenter'); ?></option>
				<option value="red_light"<?php echo (isset($icon_color) && $icon_color=="red_light" ? ' selected="selected"' : ''); ?>><?php _e('light red', 'medicenter'); ?></option>
				<option value="turquoise"<?php echo (isset($icon_color) && $icon_color=="turquoise" ? ' selected="selected"' : ''); ?>><?php _e('turquoise', 'medicenter'); ?></option>
				<option value="turquoise_dark"<?php echo (isset($icon_color) && $icon_color=="turquoise_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark turquoise', 'medicenter'); ?></option>
				<option value="turquoise_light"<?php echo (isset($icon_color) && $icon_color=="turquoise_light" ? ' selected="selected"' : ''); ?>><?php _e('light turquoise', 'medicenter'); ?></option>
				<option value="violet"<?php echo (isset($icon_color) && $icon_color=="violet" ? ' selected="selected"' : ''); ?>><?php _e('violet', 'medicenter'); ?></option>
				<option value="violet_dark"<?php echo (isset($icon_color) && $icon_color=="violet_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark violet', 'medicenter'); ?></option>
				<option value="violet_light"<?php echo (isset($icon_color) && $icon_color=="violet_light" ? ' selected="selected"' : ''); ?>><?php _e('light violet', 'medicenter'); ?></option>
				<option value="white"<?php echo (isset($icon_color) && $icon_color=="white" ? ' selected="selected"' : ''); ?>><?php _e('white', 'medicenter'); ?></option>
				<option value="yellow"<?php echo (isset($icon_color) && $icon_color=="yellow" ? ' selected="selected"' : ''); ?>><?php _e('yellow', 'medicenter'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cart_items_number'); ?>"><?php _e('Show cart items number', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('cart_items_number'); ?>" name="<?php echo $this->get_field_name('cart_items_number'); ?>">
				<option value="yes"<?php echo ($cart_items_number=="yes" ? ' selected="selected"' : ''); ?>><?php _e('yes', 'medicenter'); ?></option>
				<option value="no"<?php echo ($cart_items_number=="no" ? ' selected="selected"' : ''); ?>><?php _e('no', 'medicenter'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('icon_target'); ?>"><?php _e('Icon target', 'medicenter'); ?></label>
			<select name="<?php echo $this->get_field_name('icon_target'); ?>">
				<option value="same_window"<?php echo ($icon_target=="same_window" ? " selected='selected'" : ""); ?>><?php _e('same window', 'medicenter'); ?></option>
				<option value="new_window"<?php echo ($icon_target=="new_window" ? " selected='selected'" : ""); ?>><?php _e('new window', 'medicenter'); ?></option>
			</select>
		</p>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("mc_cart_icon_widget");'));
?>
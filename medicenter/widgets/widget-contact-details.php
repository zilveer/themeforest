<?php
class contact_details_widget extends WP_Widget 
{
	/** constructor */
    function contact_details_widget() 
	{
		$widget_options = array(
			'classname' => 'contact_details_widget',
			'description' => 'Displays Contact Details Box'
		);
		$control_options = array('width' => 665);
        parent::__construct('medicenter_contact_details', __('Contact Details Box', 'medicenter'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : "";
		$animation = isset($instance['animation']) ? $instance['animation'] : "";
		$content = isset($instance['content']) ? $instance['content'] : "";
		$address_line_1 = isset($instance['address_line_1']) ? $instance['address_line_1'] : "";
		$address_line_2 = isset($instance['address_line_2']) ? $instance['address_line_2'] : "";
		$address_line_3 = isset($instance['address_line_3']) ? $instance['address_line_3'] : "";
		$address_line_4 = isset($instance['address_line_4']) ? $instance['address_line_4'] : "";
		$contact_line_1 = isset($instance['contact_line_1']) ? $instance['contact_line_1'] : "";
		$contact_line_2 = isset($instance['contact_line_2']) ? $instance['contact_line_2'] : "";
		$contact_line_3 = isset($instance['contact_line_3']) ? $instance['contact_line_3'] : "";
		$contact_line_4 = isset($instance['contact_line_4']) ? $instance['contact_line_4'] : "";
		$icon_type = isset($instance['icon_type']) ? $instance["icon_type"] : "";
		$icon_color = isset($instance['icon_color']) ? $instance["icon_color"] : "";
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : "";
		$icon_target = isset($instance['icon_target']) ? $instance["icon_target"] : "";

		echo $before_widget;
		if($title) 
		{
			echo ((int)$animation ? str_replace("box_header", "box_header animation-slide", $before_title) : str_replace("animation-slide", "", $before_title)) . apply_filters("widget_title", $title) . $after_title;
		}
		if($content!='')
			echo '<p class="info">' . do_shortcode(apply_filters("widget_text", $content)) . '</p>';
		if($address_line_1!="" || $contact_line_1!="" || $address_line_2!="" || $contact_line_2!="" || $address_line_3!="" || $contact_line_3!="" || $address_line_4!="" || $contact_line_4!=""):
		?>
		<ul class="footer_contact_info_container clearfix">
			<?php if($address_line_1!="" || $contact_line_1!=""):?>
			<li class="footer_contact_info_row">
				<div class="footer_contact_info_left">
					<?php echo $address_line_1; ?>
				</div>
				<div class="footer_contact_info_right">
					<?php echo $contact_line_1; ?>
				</div>
			</li>
			<?php endif;
			if($address_line_2!="" || $contact_line_2!=""):?>
			<li class="footer_contact_info_row">
				<div class="footer_contact_info_left">
					<?php echo $address_line_2; ?>
				</div>
				<div class="footer_contact_info_right">
					<?php echo $contact_line_2; ?>
				</div>
			</li>
			<?php endif;
			if($address_line_3!="" || $contact_line_3!=""):?>
			<li class="footer_contact_info_row">
				<div class="footer_contact_info_left">
					<?php echo $address_line_3; ?>
				</div>
				<div class="footer_contact_info_right">
					<?php echo $contact_line_3; ?>
				</div>
			</li>
			<?php endif;
			if($address_line_4!="" || $contact_line_4!=""):?>
			<li class="footer_contact_info_row">
				<div class="footer_contact_info_left">
					<?php echo $address_line_4; ?>
				</div>
				<div class="footer_contact_info_right">
					<?php echo $contact_line_4; ?>
				</div>
			</li>
			<?php endif; ?>
		</ul>
		<?php 
		endif;
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
			<li><a<?php echo ($icon_target[$i]=="new_window" ? " target='_blank'" : ""); ?> href="<?php echo $icon_value[$i];?>" class="social_icon" style="background-image: url('<?php echo get_template_directory_uri() . "/images/social_footer/" . $icon_color[$i] . "/" . $icon_type[$i] . ".png');"; ?>"></a></li>
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
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : "";
		$instance['animation'] = isset($new_instance['animation']) ? strip_tags($new_instance['animation']) : "";
		$instance['content'] = isset($new_instance['content']) ? $new_instance['content'] : "";
		$instance['address_line_1'] = isset($new_instance['address_line_1']) ? $new_instance['address_line_1'] : "";
		$instance['address_line_2'] = isset($new_instance['address_line_2']) ? $new_instance['address_line_2'] : "";
		$instance['address_line_3'] = isset($new_instance['address_line_3']) ? $new_instance['address_line_3'] : "";
		$instance['address_line_4'] = isset($new_instance['address_line_4']) ? $new_instance['address_line_4'] : "";
		$instance['contact_line_1'] = isset($new_instance['contact_line_1']) ? $new_instance['contact_line_1'] : "";
		$instance['contact_line_2'] = isset($new_instance['contact_line_2']) ? $new_instance['contact_line_2'] : "";
		$instance['contact_line_3'] = isset($new_instance['contact_line_3']) ? $new_instance['contact_line_3'] : "";
		$instance['contact_line_4'] = isset($new_instance['contact_line_4']) ? $new_instance['contact_line_4'] : "";
		$icon_type = isset($new_instance['icon_type']) ? (array)$new_instance['icon_type'] : array("");
		while(end($icon_type)==="")
			array_pop($icon_type);
		$instance['icon_type'] = isset($icon_type) ? $icon_type : "";
		$instance['icon_color'] = isset($new_instance['icon_color']) ? $new_instance['icon_color'] : "";
		$instance['icon_value'] = isset($new_instance['icon_value']) ? $new_instance['icon_value'] : "";
		$instance['icon_target'] = isset($new_instance['icon_target']) ? $new_instance['icon_target'] : "";
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		if(!isset($instance["icon_type"])):
		?>
			<input type="hidden" id="widget-contact-details-button_id" value="<?php echo $this->get_field_id('add_new_button'); ?>">
		<?php
		endif;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : "";
		$animation = isset($instance['animation']) ? esc_attr($instance['animation']) : "";
		$content = isset($instance['content']) ? esc_attr($instance['content']) : "";
		$address_line_1 = isset($instance['address_line_1']) ? esc_attr($instance['address_line_1']) : "";
		$address_line_2 = isset($instance['address_line_2']) ? esc_attr($instance['address_line_2']) : "";
		$address_line_3 = isset($instance['address_line_3']) ? esc_attr($instance['address_line_3']) : "";
		$address_line_4 = isset($instance['address_line_4']) ? esc_attr($instance['address_line_4']) : "";
		$contact_line_1 = isset($instance['contact_line_1']) ? esc_attr($instance['contact_line_1']) : "";
		$contact_line_2 = isset($instance['contact_line_2']) ? esc_attr($instance['contact_line_2']) : "";
		$contact_line_3 = isset($instance['contact_line_3']) ? esc_attr($instance['contact_line_3']) : "";
		$contact_line_4 = isset($instance['contact_line_4']) ? esc_attr($instance['contact_line_4']) : "";
		$icon_type = isset($instance['icon_type']) ? $instance["icon_type"] : "";
		$icon_color = isset($instance['icon_color']) ? $instance["icon_color"] : "";
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : "";
		$icon_target = isset($instance['icon_target']) ? $instance["icon_target"] : "";
		$icons = array(
			"blogger",
			"cart",
			"deviantart",
			"dribbble",
			"envato",
			"facebook",
			"flickr",
			"form",
			"forrst",
			"googleplus",
			"instagram",
			"linkedin",
			"mail",
			"myspace",
			"phone",
			"picasa",
			"pinterest",
			"rss",
			"skype",
			"soundcloud",
			"stumbleupon",
			"tumblr",
			"twitter",
			"vimeo",
			"xing",
			"youtube"
		);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Title border animation', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>">
				<option value="0"><?php _e('no', 'medicenter'); ?></option>
				<option value="1"<?php echo ((int)$animation==1 ? ' selected="selected"' : ''); ?>><?php _e('yes', 'medicenter'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content', 'medicenter'); ?></label>
			<textarea rows="10" class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address_line_1'); ?>"><?php _e('address_line_1', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address_line_1'); ?>" name="<?php echo $this->get_field_name('address_line_1'); ?>" type="text" value="<?php echo $address_line_1; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address_line_2'); ?>"><?php _e('address_line_2', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address_line_2'); ?>" name="<?php echo $this->get_field_name('address_line_2'); ?>" type="text" value="<?php echo $address_line_2; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address_line_3'); ?>"><?php _e('address_line_3', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address_line_3'); ?>" name="<?php echo $this->get_field_name('address_line_3'); ?>" type="text" value="<?php echo $address_line_3; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address_line_4'); ?>"><?php _e('address_line_4', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address_line_4'); ?>" name="<?php echo $this->get_field_name('address_line_4'); ?>" type="text" value="<?php echo $address_line_4; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contact_line_1'); ?>"><?php _e('contact_line_1', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('contact_line_1'); ?>" name="<?php echo $this->get_field_name('contact_line_1'); ?>" type="text" value="<?php echo $contact_line_1; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contact_line_2'); ?>"><?php _e('contact_line_2', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('contact_line_2'); ?>" name="<?php echo $this->get_field_name('contact_line_2'); ?>" type="text" value="<?php echo $contact_line_2; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contact_line_3'); ?>"><?php _e('contact_line_3', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('contact_line_3'); ?>" name="<?php echo $this->get_field_name('contact_line_3'); ?>" type="text" value="<?php echo $contact_line_3; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contact_line_4'); ?>"><?php _e('contact_line_4', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('contact_line_4'); ?>" name="<?php echo $this->get_field_name('contact_line_4'); ?>" type="text" value="<?php echo $contact_line_4; ?>" />
		</p>
		<?php
		for($i=0; $i<(count($icon_type)<4 ? 4 : count($icon_type)); $i++)
		{
		?>
		<p>
			<label for="<?php echo $this->get_field_id('icon_type') . $i; ?>"><?php _e('Icon type', 'medicenter'); ?></label>
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
			<label for="<?php echo $this->get_field_id('icon_color') . $i; ?>"><?php _e('color', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('icon_color') . $i; ?>" name="<?php echo $this->get_field_name('icon_color'); ?>[]">
				<option value="blue_light"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="blue_light" ? ' selected="selected"' : ''); ?>><?php _e('light blue', 'medicenter'); ?></option>
				<option value="blue"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="blue" ? ' selected="selected"' : ''); ?>><?php _e('blue', 'medicenter'); ?></option>
				<option value="blue_dark"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="blue_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark blue', 'medicenter'); ?></option>
				<option value="black"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="black" ? ' selected="selected"' : ''); ?>><?php _e('black', 'medicenter'); ?></option>
				<option value="gray"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="gray" ? ' selected="selected"' : ''); ?>><?php _e('gray', 'medicenter'); ?></option>
				<option value="gray_dark"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="gray_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark gray', 'medicenter'); ?></option>
				<option value="gray_light"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="gray_light" ? ' selected="selected"' : ''); ?>><?php _e('light gray', 'medicenter'); ?></option>
				<option value="green"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="green" ? ' selected="selected"' : ''); ?>><?php _e('green', 'medicenter'); ?></option>
				<option value="green_dark"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="green_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark green', 'medicenter'); ?></option>
				<option value="green_light"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="green_light" ? ' selected="selected"' : ''); ?>><?php _e('light green', 'medicenter'); ?></option>
				<option value="orange"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="orange" ? ' selected="selected"' : ''); ?>><?php _e('orange', 'medicenter'); ?></option>
				<option value="orange_dark"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="orange_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark orange', 'medicenter'); ?></option>
				<option value="orange_light"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="orange_light" ? ' selected="selected"' : ''); ?>><?php _e('light orange', 'medicenter'); ?></option>
				<option value="red"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="red" ? ' selected="selected"' : ''); ?>><?php _e('red', 'medicenter'); ?></option>
				<option value="red_dark"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="red_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark red', 'medicenter'); ?></option>
				<option value="red_light"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="red_light" ? ' selected="selected"' : ''); ?>><?php _e('light red', 'medicenter'); ?></option>
				<option value="turquoise"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="turquoise" ? ' selected="selected"' : ''); ?>><?php _e('turquoise', 'medicenter'); ?></option>
				<option value="turquoise_dark"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="turquoise_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark turquoise', 'medicenter'); ?></option>
				<option value="turquoise_light"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="turquoise_light" ? ' selected="selected"' : ''); ?>><?php _e('light turquoise', 'medicenter'); ?></option>
				<option value="violet"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="violet" ? ' selected="selected"' : ''); ?>><?php _e('violet', 'medicenter'); ?></option>
				<option value="violet_dark"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="violet_dark" ? ' selected="selected"' : ''); ?>><?php _e('dark violet', 'medicenter'); ?></option>
				<option value="violet_light"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="violet_light" ? ' selected="selected"' : ''); ?>><?php _e('light violet', 'medicenter'); ?></option>
				<option value="white"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="white" ? ' selected="selected"' : ''); ?>><?php _e('white', 'medicenter'); ?></option>
				<option value="yellow"<?php echo (isset($icon_color[$i]) && $icon_color[$i]=="yellow" ? ' selected="selected"' : ''); ?>><?php _e('yellow', 'medicenter'); ?></option>
			</select>
			<input style="width: 220px;" type="text" class="regular-text" value="<?php echo isset($icon_value[$i]) ? $icon_value[$i] : ""; ?>" name="<?php echo $this->get_field_name('icon_value'); ?>[]">
			<select name="<?php echo $this->get_field_name('icon_target'); ?>[]">
				<option value="same_window"<?php echo (isset($icon_target[$i]) && $icon_target[$i]=="same_window" ? " selected='selected'" : ""); ?>>same window</option>
				<option value="new_window"<?php echo (isset($icon_target[$i]) && $icon_target[$i]=="new_window" ? " selected='selected'" : ""); ?>>new window</option>
			</select>
		</p>
		<?php
		}
		?>
		<p>
			<input type="button" class="button" name="<?php echo $this->get_field_name('add_new_button'); ?>" id="<?php echo $this->get_field_id('add_new_button'); ?>" value="<?php esc_attr_e('Add icon', 'medicenter'); ?>" />
		</p>
		<script type="text/javascript">
		jQuery(document).ajaxStop(function(){
			var selector = "#<?php echo $this->get_field_id('add_new_button'); ?>";
			if(jQuery(".widgets-holder-wrap #widget-contact-details-button_id").length)
			{
				selector = "#" + jQuery(jQuery(".widgets-holder-wrap #widget-contact-details-button_id")[1]).val();
				jQuery(".widgets-holder-wrap #widget-contact-details-button_id").remove();
			}
			jQuery(selector).off("click");
			jQuery(selector).on("click", function(){
				jQuery(this).parent().before(jQuery(this).parent().prev().clone().wrap('<div>').parent().html());
				jQuery(this).parent().prev().find("input").val('');
				jQuery(this).parent().prev().find("select").each(function(){
					jQuery(this).val(jQuery(this).children("option:first").val());
				});
			});
		});
		jQuery(document).ready(function($){
			$("#<?php echo $this->get_field_id('add_new_button'); ?>").click(function(){
				$(this).parent().before($(this).parent().prev().clone().wrap('<div>').parent().html());
				$(this).parent().prev().find("input, select").val('');
			});
		});
		</script>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("contact_details_widget");'));
?>
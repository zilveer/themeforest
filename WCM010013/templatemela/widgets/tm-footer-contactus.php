<?php  // Reference:  http://codex.wordpress.org/Widgets_API
class FooterContactUsWidget extends WP_Widget
{
    function FooterContactUsWidget(){
		$widget_settings = array('description' => 'Footer Contact Us Widget', 'classname' => 'widgets-footercontact');
		parent::__construct(false,$name='TM - Footer Contact Us Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Contact Us' : $instance['title']);
		$text = empty($instance['text']) ? '' : $instance['text'];
		$address = empty($instance['address']) ? '' : $instance['address'];
		$email_title = empty($instance['email_title']) ? '' : $instance['email_title'];
		$linkURL = empty($instance['linkURL']) ? '' : $instance['linkURL'];
		$is_template_path = isset($instance['is_template_path']) ? $instance['is_template_path'] : false;
	    $window_target = isset($instance['window_target']) ? $instance['window_target'] : false;
		$ph_no = empty($instance['ph_no']) ? '' : $instance['ph_no'];
		echo $before_widget; 
		
		echo $before_title;			
		if($title)
		echo $title;
		echo $after_title; 
		?>
		<ul>
			<li> 
				<div class="contact_wrapper">
					<div class="address">
						<i class="fa fa-map-marker"></i>	
							<div class="address_content">
								<?php if(!empty($text)) : ?>			
									<div class="contact_title">
										<?php echo $text; ?>
									</div>
								<?php endif; ?>
								<?php if(!empty($address)) : ?>
									<div class="contact_address"><?php echo $address; ?></div>
								<?php endif; ?>	
							</div>
					</div>
					<div class="phone">
						<i class="fa fa-mobile"></i>
						<?php if(!empty($ph_no)) : ?>
							<div class="contact_phone"><?php echo $ph_no; ?></div>
						<?php endif; ?>	
					</div>
				<div class="email">
					<i class="fa fa-envelope "></i>
					<?php if(!empty($email_title)) : ?>
						<div class="contact_email"><a href="<?php if($linkURL == ""): echo home_url( '/' ) ; else:?>
							<?php echo $linkURL; endif;?>" <?php if($window_target == true) echo 'target="_blank"'; ?>>
							<?php echo $email_title;  ?></a>
						</div>
					<?php endif; ?>
				</div>
				</div>
			</li>
		</ul>
		<?php
		echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;		
		$instance['window_target'] = false;
		$instance['is_template_path'] = false;
		if (isset($new_instance['window_target'])) $instance['window_target'] = true;
		if (isset($new_instance['is_template_path'])) $instance['is_template_path'] = true;
		$instance['title'] =($new_instance['title']);
		$instance['text'] =($new_instance['text']);
		$instance['address'] =($new_instance['address']);
		$instance['email_title'] =($new_instance['email_title']);
		$instance['linkURL'] = strip_tags($new_instance['linkURL']);
		$instance['ph_no'] =($new_instance['ph_no']);
		return $instance;
	}
    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'title'=>'Contact Us', 
		'text'=>'Megnor Comp Pvt Limited,',
		'address'=>'507-Union Trade Centre, Beside Apple Hospital, Udhana Darwaja, Ring Road, Surat, India', 
		'email_title'=>'support@templatemela.com',
		'linkURL'=>'#',
		'ph_no'=>'(91)-261 3023333',
		'window_target'=> true) );	
					
		$title = esc_attr($instance['title']);
		$text = esc_attr($instance['text']);
		$address = esc_attr($instance['address']);
		$email_title = esc_attr($instance['email_title']);
		$ph_no = esc_attr($instance['ph_no']);
		$linkURL = esc_attr($instance['linkURL']);
		?>
		<p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'templatemela'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p>
		<p><label for="<?php echo $this->get_field_id('text');?>"><?php _e('Text:', 'templatemela'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('text');?>" name="<?php echo $this->get_field_name('text');?>" ><?php echo $text;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('address');?>"><?php _e('Adress:', 'templatemela'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('address');?>" name="<?php echo $this->get_field_name('address');?>" ><?php echo $address;?></textarea></p>	
		<p><label for="<?php echo $this->get_field_id('email_title');?>"><?php _e('E-mail:', 'templatemela'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('email_title');?>" name="<?php echo $this->get_field_name('email_title');?>" type="text" value="<?php echo $email_title;?>" /></p>	
		<p><label for="<?php echo $this->get_field_id('linkURL');?>"><?php _e('Link URL:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL');?>" name="<?php echo $this->get_field_name('linkURL');?>" type="text" value="<?php echo $linkURL;?>" />
		<label>(e.g. mailto:support@templatemela.com)</label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['window_target'], true) ?> id="<?php echo $this->get_field_id('window_target'); ?>" name="<?php echo $this->get_field_name('window_target'); ?>" /><label for="<?php echo $this->get_field_id('window_target'); ?>"><?php _e('Open Link In New Window', 'templatemela'); ?></label></p>		
		<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
		
		<p><label for="<?php echo $this->get_field_id('ph_no');?>"><?php _e('Phone No:', 'templatemela'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('ph_no');?>" name="<?php echo $this->get_field_name('ph_no');?>" type="text" value="<?php echo $ph_no;?>" /></p>	
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("FooterContactUsWidget");'));
// end BlogWidget
?>
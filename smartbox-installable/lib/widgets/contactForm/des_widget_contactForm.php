<?php

class ContactForm_Widget extends WP_Widget {
	function ContactForm_Widget() {
		$widget_ops = array('classname' => 'contact_form_widget', 'description' => __('Minimalist contact form.', 'smartbox'));
		parent::__construct(false, 'DESIGNARE _ Contact Form', $widget_ops);
	}
function form($instance) {

	if (isset($instance['title'])){
		$title = esc_attr($instance['title']); 
	} else $title = "";
		
	if (isset($instance['emailto'])){
		$emailto = esc_attr($instance['emailto']);  
	} else $emailto = "";
	
	if (isset($instance['emailsubject'])){
		$emailsubject = esc_attr($instance['emailsubject']); 
	} else $emailsubject = "";
	
	if (isset($instance['invalidname'])){
		$invalidname = esc_attr($instance['invalidname']); 
	} else $invalidname = "";

	if (isset($instance['invalidmail'])){
		$invalidmail = esc_attr($instance['invalidmail']); 
	} else $invalidmail = "";

	if (isset($instance['invalidmsg'])){
		$invalidmsg = esc_attr($instance['invalidmsg']); 
	} else $invalidmsg = "";

	if (isset($instance['successmessage'])){
		$successmessage = esc_attr($instance['successmessage']);
	} else $successmessage = "";
		
	if (isset($instance['errormessage'])){
		$errormessage = esc_attr($instance['errormessage']);
	} else $errormessage = "";
		
?>  
        
       <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Title', 'smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p> 
       <p><label for="<?php echo $this->get_field_id('emailto'); ?>">&#8212; <?php _e('Email To', 'smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('emailto'); ?>" name="<?php echo $this->get_field_name('emailto'); ?>" type="text" value="<?php echo $emailto; ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('emailsubject'); ?>">&#8212; <?php _e('Email Subject','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('emailsubject'); ?>" name="<?php echo $this->get_field_name('emailsubject'); ?>" type="text" value="<?php echo $emailsubject; ?>" /><br></label></p>
       <p><label for="<?php echo $this->get_field_id('invalidname'); ?>">&#8212; <?php _e('Invalid Name','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('invalidname'); ?>" name="<?php echo $this->get_field_name('invalidname'); ?>" type="text" value="<?php echo $invalidname; ?>" /><br></label></p>
       <p><label for="<?php echo $this->get_field_id('invalidmail'); ?>">&#8212; <?php _e('Invalid Email','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('invalidmail'); ?>" name="<?php echo $this->get_field_name('invalidmail'); ?>" type="text" value="<?php echo $invalidmail; ?>" /><br></label></p>
       <p><label for="<?php echo $this->get_field_id('invalidmsg'); ?>">&#8212; <?php _e('Invalid Message','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('invalidmsg'); ?>" name="<?php echo $this->get_field_name('invalidmsg'); ?>" type="text" value="<?php echo $invalidmsg; ?>" /><br></label></p>
       <p><label for="<?php echo $this->get_field_id('successmessage'); ?>">&#8212; <?php _e('Successful Email Message','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('successmessage'); ?>" name="<?php echo $this->get_field_name('successmessage'); ?>" type="text" value="<?php echo $successmessage; ?>" /><br></label></p>
       <p><label for="<?php echo $this->get_field_id('errormessage'); ?>">&#8212; <?php _e('Error Email Message','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('errormessage'); ?>" name="<?php echo $this->get_field_name('errormessage'); ?>" type="text" value="<?php echo $errormessage; ?>" /><br></label></p>
        
<?php
	}
function update($new_instance, $old_instance) {
	// processes widget options to be saved
	$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['emailto'] = $new_instance['emailto'];
    $instance['emailsubject'] = $new_instance['emailsubject'];
    $instance['invalidname'] = $new_instance['invalidname'];
    $instance['invalidmail'] = $new_instance['invalidmail'];
    $instance['invalidmsg'] = $new_instance['invalidmsg'];
    $instance['successmessage'] = $new_instance['successmessage'];
    $instance['errormessage'] = $new_instance['errormessage'];
		return $instance;
	}
	
function widget($args, $instance) {
		
	extract($args);
    $title = apply_filters('widget_title', $instance['title'], $instance);
    $emailto = $instance['emailto'];
    $emailsubject = $instance['emailsubject'];
    $invalidname = $instance['invalidname'];
    $invalidmail = $instance['invalidmail'];
    $invalidmsg = $instance['invalidmsg'];
    $successmessage = $instance['successmessage'];
    $errormessage = $instance['errormessage'];
    
    echo $before_widget;
    
    ?>
    
    <?php if (!empty($title)) { ?>
			<div class="contact-widget-container">	
				<div class="title"><h4><?php echo $title; ?></h4><hr></div><?php  } ?>
    
				<div class="contact-form">
					<div class="message_success form_success"></div>
					<form method="post" action="#" class="validateform">
						<ul class="forms">
							<li>
								<input type="text" name="name" class="yourname txt corner-input" onfocus="if ($(this).val() === '<?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_name'), 'smartbox'); ?>') $(this).val(''); checkerror(this);" onblur="if ($(this).val() === '') $(this).val('<?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_name'), 'smartbox'); ?>');  var v = $(this).val(); $('.yourname_val').html(v);" value="<?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_name'), "smartbox"); ?>">
								<div class="yourname_val"></div>
								<div class="yourname_error smartbox_helper_div"><?php echo $invalidname; ?></div>
							</li>
							<li>
								<input style="margin: 10px 0;" type="text" name="email" class="youremail txt corner-input" onfocus="if ($(this).val() === '<?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_email'), 'smartbox'); ?>') $(this).val(''); checkerror(this);" onblur="if ($(this).val() === '') $(this).val('<?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_email'), 'smartbox'); ?>'); var v = $(this).val(); $('.youremail_val').html(v);" value="<?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_email'), "smartbox"); ?>">
								<div class="youremail_val"></div>
								<div class="youremail_error smartbox_helper_div"><?php echo $invalidmail; ?></div>
							</li>
							<li>
								<textarea name="message" class="yourmessage textarea message corner-input" rows=20 cols=30 onfocus="if ($(this).html() === '<?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_message'), 'smartbox'); ?>') $(this).html(''); checkerror(this);" onblur="if ($(this).html() === '') $(this).html('<?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_message'), 'smartbox'); ?>');  var v = $(this).html(); $('.yourmessage_val').html(v);"><?php _e(get_option(DESIGNARE_SHORTNAME.'_cf_message'), 'smartbox'); ?></textarea>
								<div class="yourmessage_val"></div>
								<div class="yourmessage_error smartbox_helper_div"><?php echo $invalidmsg; ?></div>
							</li>
							<li>
								<a id="send-comment" href="javascript:;" onclick="sendemail($(this),'<?php echo $emailto; ?>', '<?php echo $emailsubject; ?>', '', '', '', '<?php echo $successmessage; ?>', '<?php echo $errormessage; ?>')" class="submit"><?php echo __(get_option(DESIGNARE_SHORTNAME."_cf_send"), "smartbox"); ?></a>
							</li>
						</ul>
					</form>
				</div>
			</div>
    <?php
  
    echo $after_widget;
	}
}
register_widget('ContactForm_Widget');

?>

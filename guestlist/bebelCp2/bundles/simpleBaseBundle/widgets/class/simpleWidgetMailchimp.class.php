<?php

/**
 * We take the great mailchip widget from James Lafferty but override the output method to apply our styling.
 */
class SimpleWidgetMailchimp 
{
    /*
    public function __construct () {
		$this->default_failure_message = __('There was a problem processing your submission.');
		$this->default_signup_text = __('Join now!');
		$this->default_success_message = __('Thank you for joining our mailing list. Please check your email for a confirmation link.');
		$this->default_title = __('Sign up for our mailing list.');
		$widget_options = array('classname' => 'widget_ns_mailchimp', 'description' => __( "Displays a sign-up form for a MailChimp mailing list.", 'mailchimp-widget'));
		$this->WP_Widget('bebel_widget_mailchimp', __('Guestlist Mailchimp', 'mailchimp-widget'), $widget_options);
		$this->ns_mc_plugin = NS_MC_Plugin::get_instance();
        
		$this->default_loader_graphic = get_bloginfo('wpurl') . $this->default_loader_graphic;
		add_action('init', array(&$this, 'add_scripts'));
		add_action('parse_request', array(&$this, 'process_submission'));
	}
 
    
    /**
	 * overrides the widget method
	 * 
	 
	
	public function widget ($args, $instance) {
		
        $settings = BebelSingleton::getInstance('BebelSettings');
		extract($args);
		
		if ((isset($_COOKIE[$this->id_base . '-' . $this->number]) && $this->hash_mailing_list_id($this->number) == $_COOKIE[$this->id_base . '-' . $this->number]) || false == $this->ns_mc_plugin->get_mcapi()) {
			
			return 0;
			
		} else {
			
			echo "<h2>".$instance['title']."</h2>";
			
			if ($this->successful_signup) {
				echo $this->signup_success_message;
			} else {
				?>	
				<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="<?php echo $this->id_base . '_form-' . $this->number; ?>" method="post">
					<?php echo $this->subscribe_errors;?>
					<?php	
						if ($instance['collect_first']) {
					?>	
                    
                    <div class="inputframe">
                        <input type="text" onfocus="if(this.value=='<?php echo __('First Name', $settings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('First Name', $settings->getPrefix()); ?>';" value="<?php echo __('First Name', $settings->getPrefix()); ?>" name="<?php echo $this->id_base . '_first_name'; ?>" size="10">
                    </div>
					<br />
					<?php
						}
						if ($instance['collect_last']) {
					?>	
					
                    <div class="inputframe">
                        <input type="text" onfocus="if(this.value=='<?php echo __('Last Name', $settings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Last Name', $settings->getPrefix()); ?>';" value="<?php echo __('Last Name', $settings->getPrefix()); ?>" name="<?php echo $this->id_base . '_last_name'; ?>" size="10">
                    </div>
					<?php	
						}
					?>
						<input type="hidden" name="ns_mc_number" value="<?php echo $this->number; ?>" />
                        
                    <div class="inputframe">
                        <input id="<?php echo $this->id_base; ?>-email-<?php echo $this->number; ?>" type="text" onfocus="if(this.value=='<?php echo __('Email', $settings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Email', $settings->getPrefix()); ?>';" value="<?php echo __('Email', $settings->getPrefix()); ?>"  name="<?php echo $this->id_base; ?>_email" size="10">
                    </div>
					
						
						
						<input type="submit" class="submit" value="<?php echo __($instance['signup_text'], 'mailchimp-widget'); ?>" name="<?php echo __($instance['signup_text'], 'mailchimp-widget'); ?>" />
					</form>
						<script>jQuery('#<?php echo $this->id_base; ?>_form-<?php echo $this->number; ?>').ns_mc_widget({"url" : "<?php echo $_SERVER['PHP_SELF']; ?>", "cookie_id" : "<?php echo $this->id_base; ?>-<?php echo $this->number; ?>", "cookie_value" : "<?php echo $this->hash_mailing_list_id(); ?>", "loader_graphic" : "<?php echo $this->default_loader_graphic; ?>"}); </script>
				<?php
			}
			
		}
		
	}
    */
}
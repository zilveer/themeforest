<?php
/**
 * @package LMS
 * @copyright Copyright (c) 2014, Chimp Studio 
 */
 
/** 
 * @Mailchimp List
 */
if ( ! function_exists( 'cs_mailchimp_list' ) ) {
	function cs_mailchimp_list($apikey){
		global $cs_theme_option;
		$MailChimp = new MailChimp($apikey);
		$mailchimp_list = $MailChimp->call('lists/list');
		return $mailchimp_list;
	}
}

/** 
 * @custom mail chimp form
 */
if ( ! function_exists( 'cs_custom_mailchimp' ) ) {
	function cs_custom_mailchimp(){
		global $cs_theme_option;
		$counter = 1;
		?>
			  <form action="javascript:cs_mailchimp_submit('<?php echo get_template_directory_uri()?>','<?php echo esc_js($counter); ?>','<?php echo admin_url('admin-ajax.php'); ?>')" id="mcform_<?php echo intval($counter);?>" method="post">
				<div id="newsletter_mess_<?php echo intval($counter);?>" class="newsletter_message" style="display:none"></div>
				   <input id="cs_list_id" type="hidden" name="cs_list_id" value="<?php if(isset($cs_theme_option['cs_mailchimp_list'])){ echo esc_attr($cs_theme_option['cs_mailchimp_list']); }?>" />
                  <label>
					 <input id="mc_email" type="text" class="form-control" name="mc_email" value="" placeholder="<?php _e('Signup weekly newsletter','lassic');?>
"  />
                  </label>
				  <label class="cs-btn">
                  	<input class="btn cs-bg-color" type="submit" id="btn_newsletter_<?php echo intval($counter);?>" name="submit" value="<?php _e('Subscribe', 'lassic'); ?>"  />
                  </label>
				  <div id="process_<?php echo intval($counter);?>"></div>
			  </form>
		<?php
		$counter++;
	}
}
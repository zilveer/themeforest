<div class="subscribe_section">
<?php if(st_get_setting('subcribe_form_type','f')!='m'): ?>
<form target="_blank" method="post" action="http://feedburner.google.com/fb/a/mailverify" id="subscribe_form">
     <label for="email_subscribe"><?php _e('Sign up to receive Special Offers:','smooththemes'); ?>&nbsp;&nbsp;</label>
     <input type="email" required="required" class="subs_email_input" id="email_subscribe" name="email" value="" placeholder="<?php _e('Enter your e-mail address','smooththemes') ?>">
     <input type="hidden" name="uri" value="<?php echo esc_attr(st_get_setting("feedburner_urli")); ?>">
     <input type="hidden" value="en_US" name="loc">
    <input type="submit" name="" value="<?php _e('Subscribe','smooththemes'); ?>" class="btn btn_green">
</form>
<?php else: ?>    
<!-- Begin MailChimp Signup Form -->
<form id="subscribe_form" action="<?php echo esc_url(st_get_setting('mailchimp_action','')); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
  <label for="mce-EMAIL"><?php _e('Sign up to receive Special Offers:','smooththemes'); ?>&nbsp;&nbsp;</label>
 <input type="email" value="" name="EMAIL" class="email subs_email_input" id="mce-EMAIL" placeholder="<?php _e('Enter your e-mail address','smooththemes') ?>" required="true">
  <input type="submit" name="subscribe" value="<?php _e('Subscribe','smooththemes'); ?>" class="btn btn_green">
</form>
<!--End mc_embed_signup-->    
<?php endif; ?>         
</div>
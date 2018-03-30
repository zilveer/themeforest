<?php 
$pexeto_captcha = get_opt( '_captcha' )=='on' ? true : false;

if ( $pexeto_captcha ) {
	pexeto_print_captcha_options_script();
} ?>
<form method="post" id="submit-form" class="pexeto-contact-form">
<div class="error-box error-message"><?php echo pex_text('_contact_error'); ?></div>
<div class="error-box fail-message">An error occurred. Message not sent.</div>
<div class="error-box captcha-fail-message"><?php echo pex_text('_wrong_captcha_error_text'); ?></div>
<div class="info-box sent-message"><?php echo pex_text('_message_sent_text'); ?></div>
 <div class="contact-form-input contact-input-wrapper">
 <label class="contact-label"><?php echo pex_text('_name_text');?><span class="mandatory">*</span></label>
  <input type="text" name="name" class="required" />
  </div>
  
  <div class="contact-form-input contact-input-wrapper">
  <label class="contact-label"><?php echo pex_text('_your_email_text');?> <span class="mandatory">*</span> </label>
  <input type="text" name="email" class="required email" />
 	</div>
 
 <div class="contact-form-textarea contact-input-wrapper">
  <label class="contact-label"><?php echo pex_text('_question_text');?><span class="mandatory">*</span></label>
  <textarea name="question" rows="" cols="" class="required"></textarea>
  </div>
  
<?php if($pexeto_captcha){
	pexeto_load_captcha_lib();
	$publickey = get_opt( '_captcha_public_key' );

	?>
	<label class="contact-label"><?php echo pex_text( '_captcha_text' );?>
		<span class="mandatory">*</span>
	</label>
	<div class="contact-captcha-container">
		<div id="recaptcha_image"></div><div class="recaptcha-reload">
			<a title="<?php echo pex_text( '_refresh_btn_text' ); ?>" href="javascript:Recaptcha.reload()"></a>
		</div>
		<div class="recaptcha-input-wrap contact-input-wrapper">
			<input type="text" name="recaptcha_response_field" id="recaptcha_response_field" />
				<div id="recaptcha_widget" style="display:none"></div>
			<span class="recaptcha-link alignright"><a href="http://www.google.com/recaptcha">powered by reCAPTCHA</a></span>
		</div>

		<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $publickey; ?>"></script>
	</div>
<?php } ?>

  <a class="button send-button"><span><?php echo pex_text('_send_text');?></span></a>
 <div class="contact-loader"></div>
 <div class="clear"></div>
</form>



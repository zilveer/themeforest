<?php if ( pexeto_option( 'captcha' ) ) {
	pexeto_print_captcha_options_script();
} ?>
<form method="post" id="submit-form" class="pexeto-contact-form">
	<div class="error-box error-message"></div>
	<div class="info-box sent-message"></div>
	<div class="contact-form-input contact-input-wrapper">
		<label class="contact-label">
			<?php _e( 'Name', 'pexeto' );;?>
			<span class="mandatory">*</span>
		</label>
		<input type="text" name="name" class="required" />
	</div>

	<div class="contact-form-input contact-input-wrapper">
		<label class="contact-label">
			<?php _e( 'E-mail address', 'pexeto' );?>
			<span class="mandatory">*</span>
		</label>
		<input type="text" name="email" class="required email" />
	</div>

	<div class="contact-form-textarea contact-input-wrapper">
		<label class="contact-label">
			<?php _e( 'Your message', 'pexeto' ); ?>
			<span class="mandatory">*</span>
		</label>
		<textarea name="question" class="required"></textarea>
	</div>

	<?php if ( pexeto_option( 'captcha' ) ) {
		//print the reCAPTCHA widget

		pexeto_load_captcha_lib();
		$publickey = pexeto_option( 'captcha_public_key' );
	?>

	<label class="contact-label"><?php _e( 'Insert the text from the image', 'pexeto' );;?>
		<span class="mandatory">*</span>
	</label>
	<div class="contact-captcha-container">
		<div id="recaptcha_image"></div><div class="recaptcha-reload">
			<a title="<?php _e( 'Get a new challenge', 'pexeto' ); ?>" href="javascript:Recaptcha.reload()"></a>
		</div>
		<div class="recaptcha-input-wrap">
			<input type="text" name="recaptcha_response_field" id="recaptcha_response_field" />
				<div id="recaptcha_widget" style="display:none"></div>
			<span class="recaptcha-link alignright"><a href="http://www.google.com/recaptcha">powered by reCAPTCHA</a></span>
		</div>
		
		<?php $protocol = is_ssl() ? 'https' : 'http';  ?>
		<script type="text/javascript" src="<?php echo $protocol; ?>://www.google.com/recaptcha/api/challenge?k=<?php echo $publickey; ?>"></script>
	</div>
	
	<?php } ?>

	<a class="button send-button">
		<span><?php _e( 'Send Message', 'pexeto' ); ?></span>
	</a>
	<div class="contact-loader"></div>
	<div class="clear"></div>
</form>

<?php
function webnus_contactform_shortcode($attributes, $content){
	extract(shortcode_atts(array(
		'type'=>'1',
		'email_address'=>'',
		'captcha'=>false,
	), $attributes));
	
GLOBAL $webnus_options;
$recaptcha_desire = false;

if ( $webnus_options->webnus_recaptcha_site_key() && $webnus_options->webnus_recaptcha_secret_key() && $captcha ) : 
	require_once get_template_directory() . '/inc/helpers/recaptchalib.php';
	// Register API keys at https://www.google.com/recaptcha/admin
	$siteKey = $webnus_options->webnus_recaptcha_site_key();
	$secret = $webnus_options->webnus_recaptcha_secret_key();

	// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
	$lang = get_bloginfo ( 'language' );

	// The response from reCAPTCHA
	$resp = null;
	// The error code from reCAPTCHA, if any
	$error = null;

	$reCaptcha = new ReCaptcha($secret);

	
	$recaptcha_desire = true;
	
endif;

$errors = array();
$isError = false;

$errorName = esc_html__( 'Please enter your name.', 'WEBNUS_TEXT_DOMAIN' );
$errorEmail = esc_html__( 'Please enter a valid email address.', 'WEBNUS_TEXT_DOMAIN' );
$errorMessage = esc_html__( 'Please enter the message.', 'WEBNUS_TEXT_DOMAIN' );
if ( $recaptcha_desire ) { $errorreCaptcha = esc_html__( 'Please enter the valid captcha.', 'WEBNUS_TEXT_DOMAIN' ); }

// Get the posted variables and validate them.
if ( isset( $_POST['is-submitted'] ) ) {
	$name    = $_POST['cName'];
	$email   = $_POST['cEmail'];
	$subject   = $_POST['cSubject'];
	$message = $_POST['cMessage'];

	// Check the name
	if ( ! webnus_validate_length( $name, 2 ) ) {
		$isError             = true;
		$errors['errorName'] = $errorName;
	}

	// Check the email
	if ( ! is_email( $email ) ) {
		$isError              = true;
		$errors['errorEmail'] = $errorEmail;
	}

	// Check the message
	if ( ! webnus_validate_length( $message, 2 ) ) {
		$isError                = true;
		$errors['errorMessage'] = $errorMessage;
	}

	if ( $recaptcha_desire ) :
		$recaptcha = $_POST["g-recaptcha-response"];

		// Check the recaptcha
		if ( ! webnus_validate_length( $recaptcha, 2 ) ) {
			$isError                = true;
			$errors['errorreCaptcha'] = $errorreCaptcha;
		}

		// Was there a reCAPTCHA response?
		if ( $_POST["g-recaptcha-response"] ) {
		    $resp = $reCaptcha->verifyResponse(
		        $_SERVER["REMOTE_ADDR"],
		        $_POST["g-recaptcha-response"]
		    );
		}
	endif;


	// If there's no error, send email
	if ( ! $isError ) {

		// Get email address
		$emailReceiver = ( $email_address ) ? $email_address : get_option( 'admin_email' ) ;

		$emailSubject = sprintf( esc_html__( 'You have been contacted by %s', 'WEBNUS_TEXT_DOMAIN' ), $name );
		$emailBody    = sprintf( esc_html__( 'Subject: %1$s', 'WEBNUS_TEXT_DOMAIN' ), $subject ) . PHP_EOL . PHP_EOL;
		$emailBody    .= sprintf( esc_html__( 'You have been contacted by %1$s. Their message is:', 'WEBNUS_TEXT_DOMAIN' ), $name ) . PHP_EOL . PHP_EOL;
		$emailBody    .= $message . PHP_EOL . PHP_EOL;
		$emailBody    .= sprintf( esc_html__( 'You can contact %1$s via email at %2$s', 'WEBNUS_TEXT_DOMAIN' ), $name, $email );
		$emailBody    .= PHP_EOL . PHP_EOL;
		
		$emailHeaders[] = "Reply-To: $email" . PHP_EOL;

		add_filter( 'wp_mail_from_name', 'custom_wp_mail_from_name' );
			function custom_wp_mail_from_name( $name ) {
				return 'Webnus Contact form';
		}


		$emailIsSent = wp_mail( $emailReceiver, $emailSubject, $emailBody, $emailHeaders );
	}
}

ob_start(); ?>

<div class="contact-form">
	<form action="#" method="POST" id="contact-form" class="frmContact container" role="form" novalidate>
		<?php if ( $type == 2 ) { echo '<div class="col-md-6">'; } ?>
			
			<input type="text" name="cName" id="txtName" placeholder="<?php esc_html_e( 'Name','WEBNUS_TEXT_DOMAIN' ); ?>" value="<?php if ( isset( $_POST['cName'] ) ) { echo esc_html( $_POST['cName'] ); } ?>" />
			<?php if ( isset( $errors['errorName'] ) ) : ?>
				<span class="bad-field"><?php echo esc_html( $errors['errorName'] ); ?></span>
			<?php endif; ?>

			<input  type="text" name="cEmail" id="txtEmail" placeholder="<?php esc_html_e( 'Email','WEBNUS_TEXT_DOMAIN' ); ?>" value="<?php if ( isset( $_POST['cEmail'] ) ) { echo esc_html( $_POST['cEmail'] ); } ?>" />
			<?php if ( isset( $errors['errorEmail'] ) ) : ?>
				<span class="bad-field"><?php echo esc_html( $errors['errorEmail'] ); ?></span>
			<?php endif; ?>

			<input name="cSubject" type="text" id="txtSubject" placeholder="<?php esc_html_e( 'Subject','WEBNUS_TEXT_DOMAIN' ); ?>" value="<?php if ( isset( $_POST['cSubject'] ) ) { echo esc_html( $_POST['cSubject'] ); } ?>" />

		<?php if ( $type == 2 ) { echo '</div><div class="col-md-6">'; } ?>
		 
			<textarea name="cMessage" id="txtText" placeholder="<?php esc_html_e( 'Message','WEBNUS_TEXT_DOMAIN' ); ?>" cols="40" rows="10"><?php if ( isset( $_POST['cMessage'] ) ) { echo esc_html( $_POST['cMessage'] ); } ?></textarea>
			<?php if ( isset( $errors['errorMessage'] ) ) : ?>
				<span class="bad-field"><?php echo esc_html( $errors['errorMessage'] ); ?></span>
			<?php endif; ?>

			<?php if ( $recaptcha_desire ) : ?>
				<?php if ( isset( $errors['errorreCaptcha'] ) ) : ?>
					<span class="bad-field captcha"><?php echo esc_html( $errors['errorreCaptcha'] ); ?></span>
				<?php endif; ?>
				<div class="g-recaptcha" data-sitekey="<?php echo esc_html( $siteKey );?>"></div>
				<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo esc_html( $lang );?>"></script>
			<?php endif; ?>

			<input type="hidden" name="is-submitted" id="is-submitted" value="true">
			<button type="submit" class="btnSend" ><?php esc_html_e( 'Send Your Message','WEBNUS_TEXT_DOMAIN' ); ?></button>

			<?php if ( isset( $emailIsSent ) && $emailIsSent ) { ?>
				<div class="alert alert-success">
					<?php esc_html_e( 'Your message has been sucessfully sent, thank you!', 'WEBNUS_TEXT_DOMAIN' ); ?>
				</div> <!-- end alert -->
			<?php } elseif ( isset( $isError ) && $isError ) { ?>
				<div class="alert-alert-danger">
					<?php esc_html_e( 'Sorry, it seems there was an error.', 'WEBNUS_TEXT_DOMAIN' ); ?>
				</div> <!-- end alert -->
			<?php } ?>

		<?php if ( $type == 2 ) { echo '</div>'; } ?>
	</form>
</div>

<?php
$output = ob_get_contents();
ob_end_clean();
return $output;

} // end function
add_shortcode('contactform','webnus_contactform_shortcode'); ?>
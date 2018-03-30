<?php
/**
 * Contact Form
 *
 * This outputs the contact form HTML via [contact_form] shortcode
 */

// reCAPTCHA spam protection
$recaptcha_public_key = risen_option( 'recaptcha_public_key' ); // keys provided in theme options
$recaptcha_private_key = risen_option( 'recaptcha_private_key' );
$recaptcha_lang = get_locale();
wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js?hl= ' . $recaptcha_lang, false, null );

// "To" contacts from Theme Options
$contacts = risen_contacts();
if ( empty( $contacts ) ) {
	_e( '<p><b>Error:</b> Provide at least one contact in Theme Options</p>', 'risen' );
}

?>

<div id="contact-form-result"></div>

<form id="contact-form" method="post" class="p">

	<?php if ( count( $contacts ) == 1 ) : // we have only one contact, don't show "To" ?>
	<input type="hidden" name="to" value="<?php echo md5( array_shift( array_values( $contacts ) ) ); // first and only contact ina rray ?>">
	<?php else : // show "To" selector for multiple contacts ?>
	<div class="contact-field">
		<label class="contact-label"><?php _ex( 'To', 'contact form', 'risen' ); ?></label>
		<select name="to">
			<option value=""></option>
			<?php
			$selected_contact = isset( $_GET['contact'] ) ? $_GET['contact'] : '';
			echo risen_contact_options( $selected_contact );
			?>
		</select>
	</div>
	<?php endif; ?>

	<div class="contact-field">
		<label class="contact-label"><?php _ex( 'Name', 'contact form', 'risen' ); ?></label>
		<input type="text" name="name">
	</div>

	<div class="contact-field">
		<label class="contact-label"><?php _ex( 'E-mail', 'contact form', 'risen' ); ?></label>
		<input type="email" name="email">
	</div>

	<div class="contact-field">
		<textarea name="message"></textarea>
	</div>

	<?php if ( $recaptcha_public_key && $recaptcha_private_key ) : ?>
	<div id="contact-recaptcha" class="contact-field">
		<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_public_key; ?>"></div>
	</div>
	<?php endif; ?>

	<div>
		<a href="#" class="button" id="contact-button"><?php _ex( 'Send Message', 'contact form', 'risen' ); ?></a>
	</div>

</form>